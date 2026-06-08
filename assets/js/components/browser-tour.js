// assets/js/components/browser-tour.js — guided tour for the portfolio browser window

const BrowserTour = (() => {
    const STORAGE_KEY = "portfolio-browser-tour-done";
    const OPEN_DELAY_MS = 600;
    const COMPACT_BREAKPOINT = 768;

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
                "Tap the red <strong>×</strong> at the top right to close this browser window.",
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
            target: ".portfolio-site__top-header"
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
    let scrim = null;
    let shades = {};
    let ring = null;
    let popover = null;
    let messageEl = null;
    let stepEl = null;
    let nextBtn = null;
    let skipBtn = null;
    let helpBtn = null;
    let browserContent = null;
    let stepIndex = 0;
    let active = false;
    let scheduledOpen = null;
    let scrollLocked = false;

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

    function isCompactTour() {
        if (!browserWindow) return window.innerWidth <= COMPACT_BREAKPOINT;
        return browserWindow.offsetWidth <= COMPACT_BREAKPOINT || window.innerWidth <= COMPACT_BREAKPOINT;
    }

    function queryTarget(selector) {
        if (!selector || !browserWindow) return null;
        return browserWindow.querySelector(selector);
    }

    function lockBrowserScroll() {
        if (!browserContent || scrollLocked) return;
        browserContent.classList.add("browser__content--scroll-locked");
        scrollLocked = true;
    }

    function unlockBrowserScroll() {
        if (!browserContent || !scrollLocked) return;
        browserContent.classList.remove("browser__content--scroll-locked");
        scrollLocked = false;
    }

    function hideHighlight() {
        if (ring) {
            ring.classList.add("browser-tour__ring--hidden");
            ring.style.width = "0";
            ring.style.height = "0";
        }
        if (scrim) {
            scrim.classList.add("browser-tour__scrim--hidden");
        }
        if (helpBtn) {
            helpBtn.classList.remove("browser-tour__help--spotlight");
        }
    }

    function ensureTargetVisible(target) {
        if (!target || !browserWindow) return;

        const content = browserWindow.querySelector("#browser-content");
        if (!content) return;

        if (target.closest("#browser-content")) {
            const contentRect = content.getBoundingClientRect();
            const targetRect = target.getBoundingClientRect();
            const margin = 16;

            if (targetRect.top < contentRect.top + margin) {
                content.scrollTop += targetRect.top - contentRect.top - margin;
            } else if (targetRect.bottom > contentRect.bottom - margin) {
                content.scrollTop += targetRect.bottom - contentRect.bottom + margin;
            }
        }
    }

    function getTargetRect(target) {
        const winRect = browserWindow.getBoundingClientRect();
        const rect = target.getBoundingClientRect();
        return {
            top: rect.top - winRect.top,
            left: rect.left - winRect.left,
            right: rect.right - winRect.left,
            bottom: rect.bottom - winRect.top,
            width: rect.width,
            height: rect.height,
            centerX: (rect.left + rect.right) / 2 - winRect.left,
            centerY: (rect.top + rect.bottom) / 2 - winRect.top
        };
    }

    function clearPopoverInlinePosition() {
        if (!popover) return;
        popover.style.left = "";
        popover.style.right = "";
        popover.style.top = "";
        popover.style.bottom = "";
        popover.style.width = "";
        popover.style.maxWidth = "";
        popover.style.transform = "";
    }

    function setLayoutMode(stepId) {
        if (!tourRoot) return;

        const compact = isCompactTour();
        tourRoot.classList.toggle("browser-tour--welcome", stepId === "welcome");
        tourRoot.classList.toggle("browser-tour--mobile", compact);
        tourRoot.classList.toggle("browser-tour--centered", compact && stepId !== "help");
        tourRoot.classList.toggle("browser-tour--top", compact && stepId === "help");
    }

    function rectsOverlap(a, b, gap) {
        return !(
            a.left + a.width + gap <= b.left ||
            b.left + b.width + gap <= a.left ||
            a.top + a.height + gap <= b.top ||
            b.top + b.height + gap <= a.top
        );
    }

    function fitsInWindow(pos, popW, popH, winW, winH, margin) {
        return (
            pos.left >= margin &&
            pos.top >= margin &&
            pos.left + popW <= winW - margin &&
            pos.top + popH <= winH - margin
        );
    }

    function buildPlacementOrder(rel, winH) {
        const relativeY = rel.centerY / winH;
        if (relativeY > 0.6) {
            return ["above", "left", "right", "below"];
        }
        if (relativeY < 0.35) {
            return ["below", "right", "left", "above"];
        }
        return ["below", "above", "right", "left"];
    }

    function computePlacement(placement, rel, popW, popH, gap, winW, winH, margin) {
        let left;
        let top;

        switch (placement) {
            case "above":
                top = rel.top - popH - gap;
                left = rel.centerX - popW / 2;
                break;
            case "below":
                top = rel.bottom + gap;
                left = rel.centerX - popW / 2;
                break;
            case "left":
                left = rel.left - popW - gap;
                top = rel.centerY - popH / 2;
                break;
            case "right":
                left = rel.right + gap;
                top = rel.centerY - popH / 2;
                break;
            default:
                return null;
        }

        left = Math.max(margin, Math.min(left, winW - popW - margin));
        top = Math.max(margin, Math.min(top, winH - popH - margin));
        return { left, top, width: popW, height: popH };
    }

    function centerPopoverDesktop(winW, winH, popW, popH, margin) {
        popover.style.left = `${Math.max(margin, (winW - popW) / 2)}px`;
        popover.style.top = `${Math.max(margin, (winH - popH) / 2)}px`;
        popover.style.transform = "none";
    }

    function positionPopoverDesktop(target, winW, winH, margin, gap) {
        popover.style.maxWidth = `${Math.max(180, winW - margin * 2)}px`;
        popover.style.width = "";

        const popW = popover.offsetWidth;
        const popH = popover.offsetHeight;

        if (!target) {
            centerPopoverDesktop(winW, winH, popW, popH, margin);
            return;
        }

        const rel = getTargetRect(target);
        const targetBox = { left: rel.left, top: rel.top, width: rel.width, height: rel.height };
        const placements = buildPlacementOrder(rel, winH);

        for (const placement of placements) {
            const pos = computePlacement(placement, rel, popW, popH, gap, winW, winH, margin);
            if (!pos) continue;

            if (rectsOverlap(pos, targetBox, gap)) continue;
            if (!fitsInWindow(pos, popW, popH, winW, winH, margin)) continue;

            popover.style.left = `${pos.left}px`;
            popover.style.top = `${pos.top}px`;
            popover.style.transform = "none";
            return;
        }

        centerPopoverDesktop(winW, winH, popW, popH, margin);
    }

    function positionRing(target) {
        if (!ring || !browserWindow) return;

        if (!target) {
            ring.classList.add("browser-tour__ring--hidden");
            return;
        }

        const rel = getTargetRect(target);
        const pad = isCompactTour() ? 4 : 6;

        ring.style.top = `${rel.top - pad}px`;
        ring.style.left = `${rel.left - pad}px`;
        ring.style.width = `${rel.width + pad * 2}px`;
        ring.style.height = `${rel.height + pad * 2}px`;
        ring.classList.remove("browser-tour__ring--hidden");
    }

    function positionScrim(target) {
        if (!scrim || !browserWindow) return;

        const winRect = browserWindow.getBoundingClientRect();
        const width = winRect.width;
        const height = winRect.height;

        if (!target) {
            Object.values(shades).forEach((shade) => {
                shade.style.top = "0";
                shade.style.left = "0";
                shade.style.width = "100%";
                shade.style.height = "100%";
            });
            scrim.classList.remove("browser-tour__scrim--hidden");
            return;
        }

        const rel = getTargetRect(target);
        const pad = isCompactTour() ? 4 : 6;
        const holeTop = Math.max(0, rel.top - pad);
        const holeLeft = Math.max(0, rel.left - pad);
        const holeRight = Math.min(width, rel.right + pad);
        const holeBottom = Math.min(height, rel.bottom + pad);
        const holeHeight = Math.max(0, holeBottom - holeTop);

        shades.top.style.top = "0";
        shades.top.style.left = "0";
        shades.top.style.width = `${width}px`;
        shades.top.style.height = `${holeTop}px`;

        shades.left.style.top = `${holeTop}px`;
        shades.left.style.left = "0";
        shades.left.style.width = `${holeLeft}px`;
        shades.left.style.height = `${holeHeight}px`;

        shades.right.style.top = `${holeTop}px`;
        shades.right.style.left = `${holeRight}px`;
        shades.right.style.width = `${Math.max(0, width - holeRight)}px`;
        shades.right.style.height = `${holeHeight}px`;

        shades.bottom.style.top = `${holeBottom}px`;
        shades.bottom.style.left = "0";
        shades.bottom.style.width = `${width}px`;
        shades.bottom.style.height = `${Math.max(0, height - holeBottom)}px`;

        scrim.classList.remove("browser-tour__scrim--hidden");
    }

    function layoutStep(target, stepId) {
        setLayoutMode(stepId);

        if (helpBtn) {
            helpBtn.classList.toggle("browser-tour__help--spotlight", stepId === "help");
        }

        clearPopoverInlinePosition();

        if (!isCompactTour() && popover && browserWindow) {
            const winRect = browserWindow.getBoundingClientRect();
            const margin = 12;
            positionPopoverDesktop(target, winRect.width, winRect.height, margin, 12);
        }

        positionRing(target);
        positionScrim(target);

        requestAnimationFrame(() => {
            if (!isCompactTour() && popover && browserWindow) {
                const winRect = browserWindow.getBoundingClientRect();
                positionPopoverDesktop(target, winRect.width, winRect.height, 12, 12);
            }
            positionRing(target);
            positionScrim(target);
        });
    }

    function refreshLayout() {
        if (!active) return;
        const step = steps[stepIndex];
        const target = step ? queryTarget(step.target) : null;
        layoutStep(target, step?.id);
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

        let target = queryTarget(step.target);

        if (step.id === "site-nav") {
            if (browserContent) browserContent.scrollTop = 0;
            ensureTargetVisible(target);
        }

        layoutStep(target, step.id);
    }

    function endTour(markComplete) {
        active = false;
        unlockBrowserScroll();
        if (tourRoot) {
            tourRoot.classList.add("browser-tour--hidden");
            tourRoot.classList.remove(
                "browser-tour--welcome",
                "browser-tour--mobile",
                "browser-tour--centered",
                "browser-tour--top"
            );
            tourRoot.setAttribute("aria-hidden", "true");
        }
        clearPopoverInlinePosition();
        hideHighlight();
        if (markComplete) {
            markTourComplete();
        }
    }

    function startTour(index = 0) {
        if (!tourRoot || !isBrowserVisible()) return;

        active = true;
        lockBrowserScroll();
        tourRoot.classList.remove("browser-tour--hidden");
        tourRoot.setAttribute("aria-hidden", "false");
        renderStep(Math.max(0, Math.min(index, steps.length - 1)));
    }

    function handleBrowserOpen() {
        if (hasCompletedTour() || active) return;

        if (scheduledOpen) clearTimeout(scheduledOpen);

        scheduledOpen = setTimeout(() => {
            scheduledOpen = null;
            if (!hasCompletedTour() && isBrowserVisible() && !active) {
                startTour(0);
            }
        }, OPEN_DELAY_MS);
    }

    function init() {
        browserWindow = document.getElementById("window-browser");
        tourRoot = document.getElementById("browser-tour");
        scrim = document.getElementById("browser-tour-scrim");
        ring = document.getElementById("browser-tour-ring");
        popover = document.getElementById("browser-tour-popover");
        messageEl = document.getElementById("browser-tour-message");
        stepEl = document.getElementById("browser-tour-step");
        helpBtn = document.getElementById("browser-tour-help");
        browserContent = document.getElementById("browser-content");

        shades = {
            top: document.getElementById("browser-tour-shade-top"),
            left: document.getElementById("browser-tour-shade-left"),
            right: document.getElementById("browser-tour-shade-right"),
            bottom: document.getElementById("browser-tour-shade-bottom")
        };

        if (!browserWindow || !tourRoot || !popover || !messageEl || !scrim) return;

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
        if (popover) resizeObserver.observe(popover);

        if (browserContent) {
            browserContent.addEventListener("scroll", refreshLayout, { passive: true });
        }

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && active) {
                endTour(true);
            }
        });
    }

    return { init, startTour, handleBrowserOpen };
})();

window.BrowserTour = BrowserTour;
