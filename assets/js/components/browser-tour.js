// assets/js/components/browser-tour.js — guided tour for the portfolio browser window

const BrowserTour = (() => {
    const STORAGE_KEY = "portfolio-browser-tour-done";
    const OPEN_DELAY_MS = 500;

    const steps = [
        {
            id: "welcome",
            message:
                "Welcome to the portfolio browser! Here is a quick guide to the controls around this window.",
            target: null
        },
        {
            id: "close",
            message:
                "Click the red <strong>×</strong> at the top right to close this browser window.",
            target: ".window__btn--close"
        },
        {
            id: "minimise",
            message:
                "Use the <strong>–</strong> button to minimise the window — it stays on the taskbar until you open it again.",
            target: ".window__btn--min"
        },
        {
            id: "history",
            message:
                "Use the <strong>←</strong> and <strong>→</strong> arrows to go back and forward through pages you have visited.",
            target: ".browser__nav-buttons"
        },
        {
            id: "site-nav",
            message:
                "Use the navigation links at the top of the site to jump between <strong>Home</strong>, <strong>About</strong>, <strong>Skills</strong>, <strong>Projects</strong>, and <strong>Contact</strong>.",
            target: ".portfolio-site__top-nav"
        },
        {
            id: "help",
            message:
                "You are all set! Tap the <strong>i</strong> button in the corner anytime to see this tour again.",
            target: "#browser-tour-help"
        }
    ];

    let browserWindow = null;
    let tourRoot = null;
    let ring = null;
    let popover = null;
    let messageEl = null;
    let stepEl = null;
    let nextBtn = null;
    let skipBtn = null;
    let helpBtn = null;
    let stepIndex = 0;
    let active = false;
    let scheduledOpen = null;
    let firstOpenChecked = false;

    function hasCompletedTour() {
        try {
            return localStorage.getItem(STORAGE_KEY) === "1";
        } catch {
            return false;
        }
    }

    function markTourComplete() {
        try {
            localStorage.setItem(STORAGE_KEY, "1");
        } catch {
            /* ignore */
        }
    }

    function isBrowserVisible() {
        if (!browserWindow) return false;
        return (
            !browserWindow.classList.contains("window--hidden") &&
            !browserWindow.classList.contains("window--minimised")
        );
    }

    function queryTarget(selector) {
        if (!selector || !browserWindow) return null;
        return browserWindow.querySelector(selector);
    }

    function hideRing() {
        if (!ring) return;
        ring.classList.add("browser-tour__ring--hidden");
        ring.style.width = "0";
        ring.style.height = "0";
    }

    function positionRing(target) {
        if (!ring || !browserWindow) return;

        if (!target) {
            hideRing();
            return;
        }

        const winRect = browserWindow.getBoundingClientRect();
        const rect = target.getBoundingClientRect();
        const pad = 6;

        ring.style.top = `${rect.top - winRect.top - pad}px`;
        ring.style.left = `${rect.left - winRect.left - pad}px`;
        ring.style.width = `${rect.width + pad * 2}px`;
        ring.style.height = `${rect.height + pad * 2}px`;
        ring.classList.remove("browser-tour__ring--hidden");
    }

    function positionPopover(target) {
        if (!popover || !browserWindow) return;

        const winRect = browserWindow.getBoundingClientRect();
        const margin = 12;
        const popRect = popover.getBoundingClientRect();
        const maxWidth = Math.max(180, winRect.width - margin * 2);

        popover.style.maxWidth = `${maxWidth}px`;

        if (!target) {
            popover.style.left = "50%";
            popover.style.top = "50%";
            popover.style.right = "auto";
            popover.style.bottom = "auto";
            popover.style.transform = "translate(-50%, -50%)";
            return;
        }

        const rect = target.getBoundingClientRect();
        let left = rect.left - winRect.left;
        let top = rect.bottom - winRect.top + margin;

        if (top + popRect.height > winRect.height - margin) {
            top = rect.top - winRect.top - popRect.height - margin;
        }

        left = Math.max(margin, Math.min(left, winRect.width - popRect.width - margin));
        top = Math.max(margin, Math.min(top, winRect.height - popRect.height - margin));

        popover.style.left = `${left}px`;
        popover.style.top = `${top}px`;
        popover.style.right = "auto";
        popover.style.bottom = "auto";
        popover.style.transform = "none";
    }

    function refreshLayout() {
        if (!active) return;
        const step = steps[stepIndex];
        const target = step ? queryTarget(step.target) : null;
        positionRing(target);
        positionPopover(target);
    }

    function renderStep(index) {
        const step = steps[index];
        if (!step || !messageEl || !stepEl) return;

        stepIndex = index;
        messageEl.innerHTML = step.message;
        stepEl.textContent = `Step ${index + 1} of ${steps.length}`;

        if (nextBtn) {
            nextBtn.textContent = index < steps.length - 1 ? "Next" : "Done";
        }

        const target = queryTarget(step.target);

        if (step.id === "site-nav") {
            const content = browserWindow.querySelector("#browser-content");
            if (content) content.scrollTop = 0;
        }

        positionRing(target);
        requestAnimationFrame(() => positionPopover(target));
    }

    function endTour(markComplete) {
        active = false;
        if (tourRoot) {
            tourRoot.classList.add("browser-tour--hidden");
            tourRoot.setAttribute("aria-hidden", "true");
        }
        hideRing();
        if (markComplete) {
            markTourComplete();
        }
    }

    function startTour(index = 0) {
        if (!tourRoot || !isBrowserVisible()) return;

        active = true;
        tourRoot.classList.remove("browser-tour--hidden");
        tourRoot.setAttribute("aria-hidden", "false");
        renderStep(Math.max(0, Math.min(index, steps.length - 1)));
    }

    function scheduleFirstOpenTour() {
        if (firstOpenChecked || hasCompletedTour() || !isBrowserVisible()) return;
        firstOpenChecked = true;

        if (scheduledOpen) clearTimeout(scheduledOpen);
        scheduledOpen = setTimeout(() => {
            scheduledOpen = null;
            if (!hasCompletedTour() && isBrowserVisible()) {
                startTour(0);
            }
        }, OPEN_DELAY_MS);
    }

    function watchBrowserVisibility() {
        if (!browserWindow) return;

        const observer = new MutationObserver(() => {
            if (isBrowserVisible()) {
                scheduleFirstOpenTour();
            }
        });

        observer.observe(browserWindow, {
            attributes: true,
            attributeFilter: ["class"]
        });
    }

    function init() {
        browserWindow = document.getElementById("window-browser");
        tourRoot = document.getElementById("browser-tour");
        ring = document.getElementById("browser-tour-ring");
        popover = document.getElementById("browser-tour-popover");
        messageEl = document.getElementById("browser-tour-message");
        stepEl = document.getElementById("browser-tour-step");
        helpBtn = document.getElementById("browser-tour-help");

        if (!browserWindow || !tourRoot || !popover || !messageEl) return;

        nextBtn = tourRoot.querySelector(".browser-tour__btn--next");
        skipBtn = tourRoot.querySelector(".browser-tour__btn--skip");
        const closeBtn = tourRoot.querySelector(".browser-tour__popover-close");

        if (nextBtn) {
            nextBtn.addEventListener("click", () => {
                if (stepIndex < steps.length - 1) {
                    renderStep(stepIndex + 1);
                    return;
                }
                endTour(true);
            });
        }

        if (skipBtn) {
            skipBtn.addEventListener("click", () => endTour(true));
        }

        if (closeBtn) {
            closeBtn.addEventListener("click", () => endTour(true));
        }

        if (helpBtn) {
            helpBtn.addEventListener("click", () => startTour(0));
        }

        window.addEventListener("resize", refreshLayout);

        const resizeObserver = new ResizeObserver(() => refreshLayout());
        resizeObserver.observe(browserWindow);

        watchBrowserVisibility();

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && active) {
                endTour(true);
            }
        });
    }

    return { init, startTour };
})();
