// assets/js/components/clippy.js — Office-style desktop assistant

const Clippy = (() => {
    const STORAGE_KEY = "portfolio-clippy-dismissed";
    const TIP_DELAY_MS = 1200;
    const BETWEEN_TIPS_MS = 45000;

    const tips = [
        {
            id: "welcome",
            message:
                "It looks like you're trying to explore a portfolio! I'm Clippy, and I can point you to everything on this desktop.",
            highlight: null,
            action: { label: "Show me around", next: true }
        },
        {
            id: "projects",
            message:
                "Want to see Jack's work? Double-click the <strong>My Projects</strong> icon on the left — that's where case studies and project details live.",
            highlight: '[data-app="projects"]',
            action: { label: "Open My Projects", app: "projects" }
        },
        {
            id: "about",
            message:
                "<strong>About Me</strong> is at the top of the left column. Open it in the browser for a quick intro to who Jack is and what he does.",
            highlight: '[data-app="about"]',
            action: { label: "Open About Me", app: "about" }
        },
        {
            id: "skills",
            message:
                "Technical skills and tools are in the <strong>Skills</strong> section — open the laptop icon below About Me to view them in the browser.",
            highlight: '[data-app="skills"]',
            action: { label: "Open Skills", app: "skills" }
        },
        {
            id: "contact",
            message:
                "Need to get in touch? The <strong>Contact</strong> icon opens email and social links in the browser, ready to copy.",
            highlight: '[data-app="contact"]',
            action: { label: "Open Contact", app: "contact" }
        },
        {
            id: "files",
            message:
                "<strong>My Files</strong> is like a mini file explorer — your CV and other documents are in there (and in the Start menu under Recommended).",
            highlight: '[data-app="files"]',
            action: { label: "Open My Files", app: "files" }
        },
        {
            id: "start-menu",
            message:
                "You can launch any app from the <strong>Start</strong> button on the taskbar — same icons as the desktop, plus quick access to PDFs.",
            highlight: "#start-button",
            action: { label: "Open Start menu", startMenu: true }
        },
        {
            id: "browser",
            message:
                "The <strong>Browser</strong> icon opens Jack's full portfolio site inside a window — great for browsing case studies without leaving the desktop.",
            highlight: '[data-app="browser"]',
            action: { label: "Open Browser", app: "browser" }
        },
        {
            id: "games",
            message:
                "Fancy a break? <strong>Snake Game</strong> and <strong>Space Invaders</strong> are on the right side of the desktop — double-click to play.",
            highlight: '[data-app="game"]',
            action: null
        },
        {
            id: "osrs-hiscore",
            message:
                "One for fun outside work: click the <strong>OSRS Hiscores</strong> icon to open Jack's Old School RuneScape profile and stats.",
            highlight: '[data-app="runescape-hiscores"]',
            action: { label: "Open OSRS Hiscores", app: "runescape-hiscores" }
        },
        {
            id: "taskbar",
            message:
                "When you open apps, they appear on the taskbar at the bottom. Click a button to bring a minimised window back, or use the × to close it.",
            highlight: "#taskbar",
            action: null
        }
    ];

    let root = null;
    let bubble = null;
    let messageEl = null;
    let tipIndex = 0;
    let tipTimer = null;
    let cycleTimer = null;
    let highlightedEl = null;
    let isMinimised = false;
    let tourComplete = false;

    function clampToViewport() {
        if (!root) return;
        const taskbar = 56;
        const pad = 8;
        const rect = root.getBoundingClientRect();
        const computed = window.getComputedStyle(root);

        let right = Number.parseFloat(computed.right);
        let bottom = Number.parseFloat(computed.bottom);
        if (!Number.isFinite(right)) right = 24;
        if (!Number.isFinite(bottom)) bottom = 58;

        const maxRight = Math.max(pad, window.innerWidth - rect.width - pad);
        const maxBottom = Math.max(taskbar, window.innerHeight - rect.height - pad);
        right = Math.max(pad, Math.min(right, maxRight));
        bottom = Math.max(taskbar, Math.min(bottom, maxBottom));

        root.style.right = `${right}px`;
        root.style.bottom = `${bottom}px`;
        root.style.left = "auto";
        root.style.top = "auto";
    }

    function isDismissed() {
        try {
            return localStorage.getItem(STORAGE_KEY) === "1";
        } catch {
            return false;
        }
    }

    function setDismissed() {
        try {
            localStorage.setItem(STORAGE_KEY, "1");
        } catch {
            /* ignore */
        }
    }

    function clearHighlight() {
        if (highlightedEl) {
            highlightedEl.classList.remove("clippy-target--highlight");
            highlightedEl = null;
        }
    }

    function shouldScrollToHighlight(el) {
        if (!el) return false;
        const style = window.getComputedStyle(el);
        if (style.position === "fixed" || style.position === "absolute") {
            return false;
        }
        return true;
    }

    function applyHighlight(selector) {
        clearHighlight();
        if (!selector) return;
        const el = document.querySelector(selector);
        if (!el) return;
        highlightedEl = el;
        el.classList.add("clippy-target--highlight");
        if (shouldScrollToHighlight(el)) {
            el.scrollIntoView({ block: "nearest", behavior: "smooth" });
        }
    }

    function renderTourComplete() {
        if (!messageEl) return;
        clearHighlight();
        messageEl.innerHTML =
            "That's the full tour! If you want another look around the desktop, you can start the tour again anytime.";
        const actions = bubble.querySelector(".clippy__actions");
        actions.innerHTML = "";

        const restartBtn = document.createElement("button");
        restartBtn.type = "button";
        restartBtn.className = "clippy__btn clippy__btn--primary";
        restartBtn.textContent = "Take tour again";
        restartBtn.addEventListener("click", () => restartTour());
        actions.appendChild(restartBtn);

        const closeBtn = document.createElement("button");
        closeBtn.type = "button";
        closeBtn.className = "clippy__btn clippy__btn--secondary";
        closeBtn.textContent = "Got it";
        closeBtn.addEventListener("click", () => hideBubble());
        actions.appendChild(closeBtn);
    }

    function restartTour() {
        tourComplete = false;
        showTip(0);
    }

    function finishTour() {
        tourComplete = true;
        renderTourComplete();
    }

    function renderTip(index) {
        const tip = tips[index];
        if (!tip || !messageEl) return;

        tourComplete = false;
        tipIndex = index;
        messageEl.innerHTML = tip.message;
        applyHighlight(tip.highlight);

        const actions = bubble.querySelector(".clippy__actions");
        actions.innerHTML = "";

        const nextBtn = document.createElement("button");
        nextBtn.type = "button";
        nextBtn.className = "clippy__btn clippy__btn--secondary";
        nextBtn.textContent = index < tips.length - 1 ? "Next tip" : "Got it";
        nextBtn.addEventListener("click", () => {
            if (index < tips.length - 1) {
                showTip(index + 1);
            } else {
                finishTour();
            }
        });
        actions.appendChild(nextBtn);

        if (tip.action) {
            const actionBtn = document.createElement("button");
            actionBtn.type = "button";
            actionBtn.className = "clippy__btn clippy__btn--primary";
            actionBtn.textContent = tip.action.label;

            actionBtn.addEventListener("click", () => {
                if (tip.action.app && window.DesktopApp) {
                    window.DesktopApp.openWindow(tip.action.app);
                }
                if (tip.action.startMenu) {
                    const menu = document.getElementById("start-menu");
                    if (menu) menu.classList.remove("start-menu--hidden");
                }
                if (tip.action.next) {
                    showTip(1);
                    return;
                }
                if (tip.action.app || tip.action.startMenu) {
                    hideBubble();
                }
            });

            actions.insertBefore(actionBtn, nextBtn);
        }
    }

    function showTip(index) {
        if (!root || isDismissed()) return;
        isMinimised = false;
        root.classList.remove("clippy--minimised");
        bubble.classList.remove("clippy__bubble--hidden");
        clampToViewport();
        renderTip(index);
    }

    function hideBubble() {
        if (!bubble) return;
        clearHighlight();
        bubble.classList.add("clippy__bubble--hidden");
        isMinimised = true;
    }

    function showBubble() {
        if (!bubble || isDismissed()) return;
        isMinimised = false;
        root.classList.remove("clippy--minimised");
        bubble.classList.remove("clippy__bubble--hidden");
        clampToViewport();
        if (tourComplete) {
            renderTourComplete();
        } else {
            renderTip(tipIndex);
        }
    }

    function dismissForever() {
        setDismissed();
        clearHighlight();
        if (root) root.classList.add("clippy--hidden");
        clearTimers();
    }

    function clearTimers() {
        if (tipTimer) clearTimeout(tipTimer);
        if (cycleTimer) clearInterval(cycleTimer);
        tipTimer = null;
        cycleTimer = null;
    }

    function scheduleWelcome() {
        tipTimer = setTimeout(() => {
            if (!isDismissed()) showTip(0);
        }, TIP_DELAY_MS);
    }

    function scheduleTipCycle() {
        cycleTimer = setInterval(() => {
            if (isDismissed() || !isMinimised || tourComplete) return;
            const next = (tipIndex + 1) % tips.length;
            showTip(next);
        }, BETWEEN_TIPS_MS);
    }

    function initDrag() {
        const character = root.querySelector(".clippy__character");
        let dragging = false;
        let didMove = false;
        let startX = 0;
        let startY = 0;
        let startRight = 0;
        let startBottom = 0;

        function onStart(clientX, clientY) {
            dragging = true;
            didMove = false;
            const rect = root.getBoundingClientRect();
            startX = clientX;
            startY = clientY;
            startRight = window.innerWidth - rect.right;
            startBottom = window.innerHeight - rect.bottom;
            root.style.right = `${startRight}px`;
            root.style.bottom = `${startBottom}px`;
            root.style.left = "auto";
            root.style.top = "auto";
        }

        function onMove(clientX, clientY) {
            if (!dragging) return;
            const dx = clientX - startX;
            const dy = clientY - startY;
            if (Math.abs(dx) > 4 || Math.abs(dy) > 4) didMove = true;
            const taskbar = 56;
            const pad = 8;
            const w = root.offsetWidth;
            const h = root.offsetHeight;
            let newRight = startRight - dx;
            let newBottom = startBottom - dy;
            newRight = Math.max(pad, Math.min(newRight, window.innerWidth - w - pad));
            newBottom = Math.max(taskbar, Math.min(newBottom, window.innerHeight - h - pad));
            root.style.right = `${newRight}px`;
            root.style.bottom = `${newBottom}px`;
        }

        function onEnd() {
            dragging = false;
            document.removeEventListener("mousemove", onMouseMove);
            document.removeEventListener("mouseup", onPointerEnd);
            document.removeEventListener("touchmove", onTouchMove);
            document.removeEventListener("touchend", onPointerEnd);
        }

        function onMouseMove(e) {
            onMove(e.clientX, e.clientY);
        }
        function onTouchMove(e) {
            e.preventDefault();
            onMove(e.touches[0].clientX, e.touches[0].clientY);
        }

        function onPointerEnd() {
            if (!didMove && bubble.classList.contains("clippy__bubble--hidden")) {
                showBubble();
            }
            onEnd();
        }

        character.addEventListener("mousedown", (e) => {
            if (e.button !== 0) return;
            e.preventDefault();
            onStart(e.clientX, e.clientY);
            document.addEventListener("mousemove", onMouseMove);
            document.addEventListener("mouseup", onPointerEnd);
        });

        character.addEventListener("touchstart", (e) => {
            e.preventDefault();
            onStart(e.touches[0].clientX, e.touches[0].clientY);
            document.addEventListener("touchmove", onTouchMove, { passive: false });
            document.addEventListener("touchend", onPointerEnd);
        });
    }

    function init() {
        root = document.getElementById("clippy-assistant");
        if (!root) return;

        bubble = root.querySelector(".clippy__bubble");
        messageEl = root.querySelector(".clippy__message");

        if (isDismissed()) {
            root.classList.add("clippy--hidden");
            return;
        }

        const character = root.querySelector(".clippy__character");
        const closeBubble = root.querySelector(".clippy__bubble-close");
        const dismissBtn = root.querySelector(".clippy__dismiss");

        closeBubble.addEventListener("click", () => hideBubble());
        dismissBtn.addEventListener("click", () => dismissForever());

        initDrag();
        clampToViewport();

        window.addEventListener("resize", () => {
            // Keep Clippy visible after rotation/orientation/layout changes on mobile.
            clampToViewport();
        });
        scheduleWelcome();
        scheduleTipCycle();

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && !bubble.classList.contains("clippy__bubble--hidden")) {
                hideBubble();
            }
        });
    }

    return { init, showTip, restartTour, dismissForever };
})();
