// assets/js/app.js

// Module loader for components
function loadComponent(src) {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
}

/* --------------------------- Login Screen --------------------------- */

const LoginScreen = (() => {
    let loginScreen = null;
    let desktop = null;
    let appsInitialised = false;

    function completeLogin(onLogin, event) {
        if (event) {
            event.preventDefault();
        }
        if (!loginScreen || !desktop) return;

        desktop.classList.remove("desktop--locked");
        desktop.classList.add("desktop--unlocked");

        loginScreen.classList.add("login-screen--hidden");

        if (typeof onLogin === "function" && !appsInitialised) {
            appsInitialised = true;
            onLogin();
        }
    }

    function init(onLogin) {
        loginScreen = document.getElementById("login-screen");
        desktop = document.getElementById("desktop");

        // If there is no login screen, just start immediately
        if (!loginScreen || !desktop) {
            if (typeof onLogin === "function") {
                onLogin();
            }
            return;
        }

        const loginButton = document.getElementById("login-button");
        const form = loginScreen.querySelector(".login-screen__form");

        if (loginButton) {
            loginButton.addEventListener("click", (event) => completeLogin(onLogin, event));
        }

        if (form) {
            form.addEventListener("submit", (event) => completeLogin(onLogin, event));
        }
    }

    function show() {
        if (!loginScreen || !desktop) return;
        desktop.classList.remove("desktop--unlocked");
        desktop.classList.add("desktop--locked");
        loginScreen.classList.remove("login-screen--hidden");
    }

    return { init, show };
})();

async function startDesktopApps() {
    // Load components dynamically
    try {
        await loadComponent('./assets/js/components/file-explorer.js');
        await loadComponent('./assets/js/components/snake.js');
        await loadComponent('./assets/js/components/invaders.js');
        await loadComponent('./assets/js/components/clippy.js');
        await loadComponent('./assets/js/components/browser-tour.js');
        await loadComponent('./assets/js/components/sticky-notes.js');
        await loadComponent('./assets/js/components/osrs-hiscores.js');

        // Initialize after components are loaded
        Desktop.init();
        if (typeof FileExplorer !== 'undefined') {
            FileExplorer.init();
        }
        if (typeof SnakeGame !== 'undefined') {
            SnakeGame.init();
        }
        if (typeof SpaceInvaders !== 'undefined') {
            SpaceInvaders.init();
        }
        Browser.init();
        if (typeof BrowserTour !== 'undefined') {
            BrowserTour.init();
        }
        if (typeof OsrsHiscores !== 'undefined') {
            OsrsHiscores.init();
        }
        Projects.init();
        if (typeof Clippy !== 'undefined') {
            Clippy.init();
        }
        if (typeof StickyNotes !== 'undefined') {
            StickyNotes.init();
        }
    } catch (error) {
        console.error('Error loading components:', error);
    }
}

function initMobileZoomLock() {
    if (!window.matchMedia("(max-width: 768px)").matches) return;

    const blockGesture = (event) => event.preventDefault();

    document.addEventListener("gesturestart", blockGesture, { passive: false });
    document.addEventListener("gesturechange", blockGesture, { passive: false });
    document.addEventListener("gestureend", blockGesture, { passive: false });

    document.addEventListener(
        "touchmove",
        (event) => {
            if (event.touches.length > 1) {
                event.preventDefault();
            }
        },
        { passive: false }
    );
}

document.addEventListener("DOMContentLoaded", () => {
    initMobileZoomLock();
    LoginScreen.init(startDesktopApps);
});

/* ------------------ Desktop + Windows + Taskbar ------------------ */

const Desktop = (() => {
    const appIds = ["about", "projects", "skills", "contact", "files", "game", "invaders", "browser"];
    const externalAppLinks = {
        "azure-webinar": "https://azure-webinar.com/",
        "cyber-webinar": "https://cyber-webinar.com/",
        "data-webinar": "https://data-webinar.org/",
        "ai-webinar": "https://ai-webinar.co.uk/",
        "robustittraining": "https://www.robustittraining.com/",
        "getglitched": "https://www.getglitched.co.uk/",
        "bindertrader-live": "https://bindertrader.vercel.app/"
    };
    /** Desktop apps that open a portfolio page inside the browser window */
    const portfolioBrowserPages = {
        about: "about",
        skills: "skills",
        contact: "contact",
        "runescape-hiscores": "osrs-hiscores"
    };
    const windows = {};
    const taskButtons = {};
    let nextZ = 100;

    const taskbarWindows = document.getElementById("taskbar-windows");
    const startBtn = document.getElementById("start-button");
    const startMenu = document.getElementById("start-menu");
    const desktop = document.getElementById("desktop");

    function initWindows() {
        appIds.forEach(id => {
            const win = document.getElementById(`window-${id}`);
            if (!win) return;
            windows[id] = win;

            const titlebar = win.querySelector("[data-app-drag]");
            const controls = win.querySelector(".window__controls");
            const btnMin = win.querySelector(".window__btn--min");
            const btnClose = win.querySelector(".window__btn--close");

            // Add maximize button if it doesn't exist
            let btnMax = win.querySelector(".window__btn--max");
            if (!btnMax) {
                btnMax = document.createElement("button");
                btnMax.className = "window__btn window__btn--max";
                btnMax.textContent = "□";
                controls.insertBefore(btnMax, btnClose);
            }

            // Store original position and size for restore
            let originalState = {
                left: null,
                top: null,
                width: null,
                height: null
            };

            // Add resize handles if they don't exist
            if (!win.querySelector(".window__resize-handle")) {
                const handles = [
                    { class: "window__resize-handle--n", cursor: "n-resize" },
                    { class: "window__resize-handle--s", cursor: "s-resize" },
                    { class: "window__resize-handle--e", cursor: "e-resize" },
                    { class: "window__resize-handle--w", cursor: "w-resize" },
                    { class: "window__resize-handle--ne", cursor: "ne-resize" },
                    { class: "window__resize-handle--nw", cursor: "nw-resize" },
                    { class: "window__resize-handle--se", cursor: "se-resize" },
                    { class: "window__resize-handle--sw", cursor: "sw-resize" }
                ];
                handles.forEach(handle => {
                    const el = document.createElement("div");
                    el.className = `window__resize-handle ${handle.class}`;
                    win.appendChild(el);
                });
            }

            // drag with viewport constraints (mouse and touch)
            let dragging = false, offsetX = 0, offsetY = 0;

            function startDrag(e) {
                if (e.target.closest(".window__controls")) return;
                if (e.target.closest(".window__resize-handle")) return;
                if (win.classList.contains("window--maximised")) return;
                e.preventDefault();
                e.stopPropagation();
                dragging = true;
                bringToFront(id);
                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;
                offsetX = clientX - win.offsetLeft;
                offsetY = clientY - win.offsetTop;

                // Add event listeners when dragging starts
                document.addEventListener("mousemove", onMove);
                document.addEventListener("mouseup", onUp);
                document.addEventListener("touchmove", onMove, { passive: false });
                document.addEventListener("touchend", onUp);
            }

            function onMove(ev) {
                if (!dragging) return;
                ev.preventDefault();
                const clientX = ev.touches ? ev.touches[0].clientX : ev.clientX;
                const clientY = ev.touches ? ev.touches[0].clientY : ev.clientY;
                const newX = clientX - offsetX;
                const newY = clientY - offsetY;
                const winRect = win.getBoundingClientRect();
                const viewportWidth = window.innerWidth;
                const viewportHeight = window.innerHeight;
                const taskbarHeight = getTaskbarHeight();

                // Constrain X position
                let constrainedX = newX;
                if (newX < 0) constrainedX = 0;
                if (newX + winRect.width > viewportWidth) {
                    constrainedX = viewportWidth - winRect.width;
                }

                // Constrain Y position (above taskbar)
                let constrainedY = newY;
                if (newY < 0) constrainedY = 0;
                if (newY + winRect.height > viewportHeight - taskbarHeight) {
                    constrainedY = viewportHeight - taskbarHeight - winRect.height;
                }

                win.style.left = `${constrainedX}px`;
                win.style.top = `${constrainedY}px`;
            }

            function onUp() {
                if (!dragging) return;
                dragging = false;
                document.removeEventListener("mousemove", onMove);
                document.removeEventListener("mouseup", onUp);
                document.removeEventListener("touchmove", onMove);
                document.removeEventListener("touchend", onUp);
            }

            titlebar.addEventListener("mousedown", startDrag);
            titlebar.addEventListener("touchstart", startDrag, { passive: false });

            function bindControlTap(button, handler) {
                if (!button) return;
                button.addEventListener("click", (e) => {
                    e.stopPropagation();
                    handler();
                });
                button.addEventListener("touchend", (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    handler();
                });
            }

            function toggleMaximise() {
                if (win.classList.contains("window--maximised")) {
                    win.classList.remove("window--maximised");
                    if (originalState.left !== null) {
                        win.style.left = `${originalState.left}px`;
                        win.style.top = `${originalState.top}px`;
                        win.style.width = `${originalState.width}px`;
                        win.style.height = `${originalState.height}px`;
                    }
                    btnMax.textContent = "□";
                } else {
                    originalState.left = parseInt(win.style.left) || win.offsetLeft;
                    originalState.top = parseInt(win.style.top) || win.offsetTop;
                    originalState.width = parseInt(win.style.width) || win.offsetWidth;
                    originalState.height = parseInt(win.style.height) || win.offsetHeight;

                    win.classList.add("window--maximised");
                    btnMax.textContent = "❐";
                }
                constrainWindowToViewport(win);
            }

            bindControlTap(btnMax, toggleMaximise);

            function closeWindow() {
                win.classList.add("window--hidden");
                win.classList.remove("window--minimised", "window--maximised");
                if (taskButtons[id]) {
                    taskButtons[id].remove();
                    delete taskButtons[id];
                }
            }

            bindControlTap(btnClose, closeWindow);

            bindControlTap(btnMin, () => {
                win.classList.add("window--minimised");
                win.classList.remove("window--maximised");
                if (taskButtons[id]) taskButtons[id].classList.add("taskbar-item--minimised");
            });

            // Resize functionality
            let resizing = false;
            let resizeHandle = null;
            let startX = 0, startY = 0;
            let startWidth = 0, startHeight = 0;
            let startLeft = 0, startTop = 0;

            win.querySelectorAll(".window__resize-handle").forEach(handle => {
                handle.addEventListener("mousedown", (e) => {
                    if (win.classList.contains("window--maximised")) return;
                    e.preventDefault();
                    e.stopPropagation();
                    resizing = true;
                    resizeHandle = handle;
                    bringToFront(id);

                    startX = e.clientX;
                    startY = e.clientY;
                    startWidth = win.offsetWidth;
                    startHeight = win.offsetHeight;
                    startLeft = win.offsetLeft;
                    startTop = win.offsetTop;

                    document.addEventListener("mousemove", onResizeMove);
                    document.addEventListener("mouseup", onResizeEnd);
                });
            });

            function onResizeMove(e) {
                if (!resizing || !resizeHandle) return;

                const deltaX = e.clientX - startX;
                const deltaY = e.clientY - startY;
                const viewportWidth = window.innerWidth;
                const viewportHeight = window.innerHeight;
                const taskbarHeight = getTaskbarHeight();
                const minWidth = 300;
                const minHeight = 200;

                let newWidth = startWidth;
                let newHeight = startHeight;
                let newLeft = startLeft;
                let newTop = startTop;

                const handleClass = resizeHandle.className;

                // Handle different resize directions
                if (handleClass.includes("--e") || handleClass.includes("--ne") || handleClass.includes("--se")) {
                    newWidth = Math.max(minWidth, Math.min(startWidth + deltaX, viewportWidth - startLeft));
                }
                if (handleClass.includes("--w") || handleClass.includes("--nw") || handleClass.includes("--sw")) {
                    const widthChange = Math.max(minWidth - startWidth, Math.min(deltaX, startLeft));
                    newWidth = startWidth - widthChange;
                    newLeft = startLeft + widthChange;
                }
                if (handleClass.includes("--s") || handleClass.includes("--se") || handleClass.includes("--sw")) {
                    newHeight = Math.max(minHeight, Math.min(startHeight + deltaY, viewportHeight - taskbarHeight - startTop));
                }
                if (handleClass.includes("--n") || handleClass.includes("--ne") || handleClass.includes("--nw")) {
                    const heightChange = Math.max(minHeight - startHeight, Math.min(deltaY, startTop));
                    newHeight = startHeight - heightChange;
                    newTop = startTop + heightChange;
                }

                // Constrain to viewport
                if (newLeft < 0) {
                    newWidth += newLeft;
                    newLeft = 0;
                }
                if (newLeft + newWidth > viewportWidth) {
                    newWidth = viewportWidth - newLeft;
                }
                if (newTop < 0) {
                    newHeight += newTop;
                    newTop = 0;
                }
                if (newTop + newHeight > viewportHeight - taskbarHeight) {
                    newHeight = viewportHeight - taskbarHeight - newTop;
                }

                win.style.width = `${Math.max(minWidth, newWidth)}px`;
                win.style.height = `${Math.max(minHeight, newHeight)}px`;
                win.style.left = `${newLeft}px`;
                win.style.top = `${newTop}px`;
            }

            function onResizeEnd() {
                resizing = false;
                resizeHandle = null;
                document.removeEventListener("mousemove", onResizeMove);
                document.removeEventListener("mouseup", onResizeEnd);
            }

            win.addEventListener("mousedown", () => bringToFront(id));
        });
    }

    function bringToFront(id) {
        const win = windows[id];
        if (!win) return;
        nextZ++;
        win.style.zIndex = nextZ;
    }

    function isMobileViewport() {
        return window.innerWidth <= 768;
    }

    function getTaskbarHeight() {
        const taskbar = document.querySelector(".taskbar");
        if (!taskbar) return 46;
        return Math.max(46, Math.round(taskbar.getBoundingClientRect().height));
    }

    function fitGameWindow(win) {
        if (!win) return;

        const btnMax = win.querySelector(".window__btn--max");

        if (isMobileViewport()) {
            if (!win.classList.contains("window--maximised") && btnMax) {
                btnMax.click();
            }
        } else if (win.classList.contains("window--maximised") && btnMax) {
            btnMax.click();
        } else {
            constrainWindowToViewport(win);
        }
    }

    function fitBrowserWindow(win) {
        if (!win) return;

        const btnMax = win.querySelector(".window__btn--max");
        if (!win.classList.contains("window--maximised") && btnMax) {
            btnMax.click();
        }
    }

    function constrainWindowToViewport(win) {
        const winRect = win.getBoundingClientRect();
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;
        const taskbarHeight = getTaskbarHeight();
        const currentLeft = parseInt(win.style.left) || win.offsetLeft;
        const currentTop = parseInt(win.style.top) || win.offsetTop;

        let newLeft = currentLeft;
        let newTop = currentTop;

        // Constrain horizontally
        if (currentLeft < 0) newLeft = 0;
        if (currentLeft + winRect.width > viewportWidth) {
            newLeft = viewportWidth - winRect.width;
        }

        // Constrain vertically (above taskbar)
        if (currentTop < 0) newTop = 0;
        if (currentTop + winRect.height > viewportHeight - taskbarHeight) {
            newTop = viewportHeight - taskbarHeight - winRect.height;
        }

        // Ensure window doesn't exceed viewport size
        const maxWidth = viewportWidth - 20;
        const maxHeight = viewportHeight - taskbarHeight - 20;
        if (winRect.width > maxWidth) {
            win.style.width = `${maxWidth}px`;
        }
        if (winRect.height > maxHeight) {
            win.style.height = `${maxHeight}px`;
        }

        win.style.left = `${newLeft}px`;
        win.style.top = `${newTop}px`;
    }

    function openPortfolioInBrowser(pageName) {
        openWindow("browser");
        if (window.BrowserApp && typeof window.BrowserApp.navigateToPage === "function") {
            window.BrowserApp.navigateToPage(pageName);
        }
    }

    function openWindow(id) {
        if (portfolioBrowserPages[id]) {
            openPortfolioInBrowser(portfolioBrowserPages[id]);
            return;
        }

        if (externalAppLinks[id]) {
            const externalUrl = externalAppLinks[id];
            openWindow("browser");
            if (window.BrowserApp && typeof window.BrowserApp.navigateToExternalUrl === "function") {
                window.BrowserApp.navigateToExternalUrl(externalUrl);
            }
            return;
        }

        const win = windows[id];
        if (!win) return;

        const wasHidden = win.classList.contains("window--hidden");
        win.classList.remove("window--hidden", "window--minimised");

        if (id === "game" || id === "invaders") {
            fitGameWindow(win);
        } else if (id === "browser") {
            fitBrowserWindow(win);
        } else {
            constrainWindowToViewport(win);
        }

        if (!taskButtons[id]) {
            const btn = document.createElement("button");
            btn.className = "taskbar-item";
            btn.dataset.app = id;

            const icon = document.createElement("span");
            icon.className = "taskbar-item__icon";
            icon.textContent = iconForApp(id);

            const label = document.createElement("span");
            label.className = "taskbar-item__label";
            label.textContent = titleForApp(id);

            const closeBtn = document.createElement("button");
            closeBtn.className = "taskbar-item__close";
            closeBtn.textContent = "×";
            closeBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                win.classList.add("window--hidden");
                win.classList.remove("window--minimised", "window--maximised");
                btn.remove();
                delete taskButtons[id];
            });

            btn.appendChild(icon);
            btn.appendChild(label);
            btn.appendChild(closeBtn);

            btn.addEventListener("click", () => {
                if (win.classList.contains("window--minimised")) {
                    win.classList.remove("window--minimised");
                    btn.classList.remove("taskbar-item--minimised");
                    if (id === "game" || id === "invaders") {
                        fitGameWindow(win);
                    } else if (id === "browser") {
                        fitBrowserWindow(win);
                    } else {
                        constrainWindowToViewport(win);
                    }
                    bringToFront(id);
                } else {
                    bringToFront(id);
                }
            });
            taskButtons[id] = btn;
            taskbarWindows.appendChild(btn);
        } else {
            taskButtons[id].classList.remove("taskbar-item--minimised");
        }

        bringToFront(id);

        if (isMobileViewport() && typeof StickyNotes !== "undefined" && typeof StickyNotes.collapse === "function") {
            StickyNotes.collapse();
        }

        if (id === "game" && wasHidden && window.SnakeGameApp && typeof window.SnakeGameApp.handleWindowOpen === "function") {
            window.SnakeGameApp.handleWindowOpen();
        }

        if (id === "invaders" && wasHidden && window.SpaceInvadersApp && typeof window.SpaceInvadersApp.handleWindowOpen === "function") {
            window.SpaceInvadersApp.handleWindowOpen();
        }
    }

    function titleForApp(id) {
        const map = {
            about: "About Me",
            projects: "My Projects",
            skills: "Skills",
            contact: "Contact",
            files: "My Files",
            game: "Snake Game",
            invaders: "Space Invaders",
            browser: "Browser"
        };
        return map[id] || id;
    }

    function iconForApp(id) {
        const map = {
            about: "👤",
            projects: "💼",
            skills: "💻",
            contact: "📧",
            files: "📁",
            game: "🎮",
            invaders: "🚀",
            browser: "🌐"
        };
        return map[id] || "📦";
    }

    function openPdfDocument(url, name) {
        openWindow("files");
        if (typeof FileExplorer !== "undefined" && typeof FileExplorer.openPdf === "function") {
            FileExplorer.openPdf(url, name);
        }
    }

    function openDesktopIcon(icon) {
        if (icon.dataset.pdfUrl) {
            openPdfDocument(icon.dataset.pdfUrl, icon.dataset.pdfName);
            return;
        }
        openWindow(icon.dataset.app);
    }

    function initDesktopIcons() {
        document.querySelectorAll(".desktop-icon").forEach(icon => {
            const appId = icon.dataset.app;
            const isExternalApp = Boolean(externalAppLinks[appId]);

            // Desktop: double-click to open
            icon.addEventListener("dblclick", () => openDesktopIcon(icon));

            // External links also support single-click open for convenience
            if (isExternalApp) {
                icon.addEventListener("click", (event) => {
                    event.preventDefault();
                    event.stopPropagation();
                    openWindow(appId);
                });
                return;
            }

            // Mobile: single tap to open (handled in touch events)
            let dragging = false;
            let offsetX = 0, offsetY = 0;
            let startX = 0, startY = 0;
            let hasMoved = false;
            let touchStartTime = 0;

            // Mouse events (desktop)
            icon.addEventListener("mousedown", e => {
                dragging = true;
                hasMoved = false;
                offsetX = e.clientX - icon.offsetLeft;
                offsetY = e.clientY - icon.offsetTop;
                startX = e.clientX;
                startY = e.clientY;

                function constrainIconPosition() {
                    const iconRect = icon.getBoundingClientRect();
                    const viewportWidth = window.innerWidth;
                    const viewportHeight = window.innerHeight;
                    const taskbarHeight = getTaskbarHeight();
                    const iconWidth = iconRect.width;
                    const iconHeight = iconRect.height;
                    let newLeft = parseInt(icon.style.left) || icon.offsetLeft;
                    let newTop = parseInt(icon.style.top) || icon.offsetTop;

                    // Constrain horizontally
                    if (newLeft < 0) newLeft = 0;
                    if (newLeft + iconWidth > viewportWidth) {
                        newLeft = viewportWidth - iconWidth;
                    }

                    // Constrain vertically (above taskbar)
                    if (newTop < 0) newTop = 0;
                    if (newTop + iconHeight > viewportHeight - taskbarHeight) {
                        newTop = viewportHeight - taskbarHeight - iconHeight;
                    }

                    icon.style.left = `${newLeft}px`;
                    icon.style.top = `${newTop}px`;
                }

                function onMove(ev) {
                    if (!dragging) return;
                    const deltaX = Math.abs(ev.clientX - startX);
                    const deltaY = Math.abs(ev.clientY - startY);
                    if (deltaX > 5 || deltaY > 5) {
                        hasMoved = true;
                    }
                    icon.style.left = `${ev.clientX - offsetX}px`;
                    icon.style.top = `${ev.clientY - offsetY}px`;
                    constrainIconPosition();
                }
                function onUp() {
                    if (!hasMoved) {
                        // Single click on desktop (if not dragging)
                        openDesktopIcon(icon);
                    }
                    dragging = false;
                    hasMoved = false;
                    constrainIconPosition();
                    document.removeEventListener("mousemove", onMove);
                    document.removeEventListener("mouseup", onUp);
                }

                document.addEventListener("mousemove", onMove);
                document.addEventListener("mouseup", onUp);
            });

            // Touch events (mobile)
            icon.addEventListener("touchstart", e => {
                e.preventDefault();
                dragging = true;
                hasMoved = false;
                touchStartTime = Date.now();
                const touch = e.touches[0];
                offsetX = touch.clientX - icon.offsetLeft;
                offsetY = touch.clientY - icon.offsetTop;
                startX = touch.clientX;
                startY = touch.clientY;

                function constrainIconPosition() {
                    const iconRect = icon.getBoundingClientRect();
                    const viewportWidth = window.innerWidth;
                    const viewportHeight = window.innerHeight;
                    const taskbarHeight = getTaskbarHeight();
                    const iconWidth = iconRect.width;
                    const iconHeight = iconRect.height;
                    let newLeft = parseInt(icon.style.left) || icon.offsetLeft;
                    let newTop = parseInt(icon.style.top) || icon.offsetTop;

                    // Constrain horizontally
                    if (newLeft < 0) newLeft = 0;
                    if (newLeft + iconWidth > viewportWidth) {
                        newLeft = viewportWidth - iconWidth;
                    }

                    // Constrain vertically (above taskbar)
                    if (newTop < 0) newTop = 0;
                    if (newTop + iconHeight > viewportHeight - taskbarHeight) {
                        newTop = viewportHeight - taskbarHeight - iconHeight;
                    }

                    icon.style.left = `${newLeft}px`;
                    icon.style.top = `${newTop}px`;
                }

                function onMove(ev) {
                    if (!dragging || !ev.touches || ev.touches.length === 0) return;
                    ev.preventDefault();
                    const touch = ev.touches[0];
                    const deltaX = Math.abs(touch.clientX - startX);
                    const deltaY = Math.abs(touch.clientY - startY);
                    if (deltaX > 10 || deltaY > 10) {
                        hasMoved = true;
                    }
                    if (hasMoved) {
                        icon.style.left = `${touch.clientX - offsetX}px`;
                        icon.style.top = `${touch.clientY - offsetY}px`;
                        constrainIconPosition();
                    }
                }
                function onUp(ev) {
                    if (!dragging) return;
                    const touchTime = Date.now() - touchStartTime;
                    // If it was a quick tap without movement, open the app
                    if (!hasMoved && touchTime < 300) {
                        openDesktopIcon(icon);
                    }
                    dragging = false;
                    hasMoved = false;
                    constrainIconPosition();
                    document.removeEventListener("touchmove", onMove);
                    document.removeEventListener("touchend", onUp);
                    document.removeEventListener("touchcancel", onUp);
                }

                document.addEventListener("touchmove", onMove, { passive: false });
                document.addEventListener("touchend", onUp);
                document.addEventListener("touchcancel", onUp);
            }, { passive: false });
        });
    }

    function initStartMenu() {
        startBtn.addEventListener("click", () => {
            startMenu.classList.toggle("start-menu--hidden");
        });

        // Handle pinned app clicks
        document.querySelectorAll(".start-menu__app").forEach(app => {
            app.addEventListener("click", () => {
                openWindow(app.dataset.app);
                startMenu.classList.add("start-menu--hidden");
            });
        });

        // Handle recommended file clicks — open PDF directly in the viewer
        document.querySelectorAll(".start-menu__file[data-pdf-url]").forEach(file => {
            file.addEventListener("click", () => {
                openPdfDocument(file.dataset.pdfUrl, file.dataset.pdfName);
                startMenu.classList.add("start-menu--hidden");
            });
        });

        const logoutBtn = document.getElementById("start-logout");
        if (logoutBtn) {
            logoutBtn.addEventListener("click", () => {
                startMenu.classList.add("start-menu--hidden");
                if (typeof LoginScreen !== "undefined" && LoginScreen && typeof LoginScreen.show === "function") {
                    LoginScreen.show();
                }
            });
        }

        desktop.addEventListener("click", e => {
            if (!e.target.closest("#start-menu") && !e.target.closest("#start-button")) {
                startMenu.classList.add("start-menu--hidden");
            }
        });
    }

    function initClock() {
        const clockEl = document.getElementById("taskbar-clock");
        function renderClock() {
            const now = new Date();
            clockEl.textContent = now.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
        }
        renderClock();
        setInterval(renderClock, 1000);
    }

    function init() {
        initWindows();
        initDesktopIcons();
        initStartMenu();
        initClock();

        // Handle window resize to constrain all open windows
        let resizeTimeout;
        window.addEventListener("resize", () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                appIds.forEach(id => {
                    const win = windows[id];
                    if (win && !win.classList.contains("window--hidden") && !win.classList.contains("window--minimised")) {
                        if (id === "game" || id === "invaders") {
                            fitGameWindow(win);
                        } else if (id === "browser") {
                            fitBrowserWindow(win);
                        } else {
                            constrainWindowToViewport(win);
                        }
                    }
                });
            }, 100);
        });

        // expose if you want to trigger from elsewhere
        window.DesktopApp = { openWindow, openPortfolioInBrowser, fitGameWindow, openPdfDocument };
    }

    return { init, openWindow };
})();


/* --------------------------- Browser --------------------------- */

const Browser = (() => {
    let currentPage = 'home';
    let currentView = { type: 'internal', pageName: 'home' };
    const history = [{ type: 'internal', pageName: 'home' }];
    let historyIndex = 0;
    const caseStudyPages = new Set([
        'case-study-it-training-route',
        'case-study-webinar-marketing',
        'case-study-bindertrader',
        'case-study-digital-ops',
        'case-study-mock-exam',
        'case-study-social-creative',
        'case-study-deep-dissonance',
        'case-study-audiogrooves',
        'case-study-kengai-records'
    ]);

    function pageToUrl(pageName) {
        if (pageName === 'home') {
            return 'https://jackheeney.dev/';
        }
        if (pageName === 'osrs-hiscores') {
            return 'https://secure.runescape.com/m=hiscore_oldschool/hiscorepersonal?user1=IM_KOFI';
        }
        if (caseStudyPages.has(pageName)) {
            return `https://jackheeney.dev/projects/${pageName}`;
        }
        return `https://jackheeney.dev/${pageName}`;
    }

    function setAddressBarValue(value) {
        const urlInput = document.getElementById('browser-url');
        if (urlInput) {
            urlInput.value = value;
        }
    }

    function setInternalViewVisible() {
        const content = document.getElementById('browser-content');
        const externalView = document.getElementById('browser-external');
        if (content) {
            content.style.display = '';
        }
        if (externalView) {
            externalView.classList.add('browser__external--hidden');
        }
    }

    function setExternalViewVisible() {
        const content = document.getElementById('browser-content');
        const externalView = document.getElementById('browser-external');
        if (content) {
            content.style.display = 'none';
        }
        if (externalView) {
            externalView.classList.remove('browser__external--hidden');
        }
    }

    function pushHistory(entry) {
        historyIndex++;
        history.splice(historyIndex);
        history.push(entry);
    }

    function navigateToPage(pageName) {
        const nextEntry = { type: 'internal', pageName };
        pushHistory(nextEntry);
        showHistoryEntry(nextEntry);
    }

    function navigateToExternalUrl(url) {
        const nextEntry = { type: 'external', url };
        pushHistory(nextEntry);
        showHistoryEntry(nextEntry);
    }

    function showInternalPage(pageName) {
        setInternalViewVisible();

        // Hide all pages
        document.querySelectorAll('.portfolio-site__page').forEach(page => {
            page.classList.remove('portfolio-site__page--active');
        });

        // Show selected page
        const page = document.getElementById(`page-${pageName}`);
        if (page) {
            page.classList.add('portfolio-site__page--active');
            currentPage = pageName;
            currentView = { type: 'internal', pageName };

            // Update URL
            setAddressBarValue(pageToUrl(pageName));

            // Update active nav link
            document.querySelectorAll('.portfolio-site__top-nav-link').forEach(link => {
                link.classList.remove('portfolio-site__top-nav-link--active');
            });
            const activeLink = document.querySelector(`[data-page="${pageName}"]`);
            if (activeLink) {
                activeLink.classList.add('portfolio-site__top-nav-link--active');
            }

            // Scroll to top
            const content = document.getElementById('browser-content');
            if (content) {
                content.scrollTop = 0;
                content.classList.remove('browser__content--scroll-locked');
                delete content.dataset.scrollTop;
            }

            const lightbox = document.getElementById('portfolio-site-lightbox');
            if (lightbox) {
                lightbox.classList.remove('portfolio-site__lightbox--open');
                lightbox.setAttribute('aria-hidden', 'true');
            }

            if (pageName === 'osrs-hiscores' && typeof OsrsHiscores !== 'undefined') {
                OsrsHiscores.load(OsrsHiscores.DEFAULT_PLAYER);
            }
        }
    }

    function showExternalPage(url) {
        const externalFrame = document.getElementById('browser-external-frame');
        if (!externalFrame) return;

        setExternalViewVisible();
        externalFrame.src = url;
        setAddressBarValue(url);
        currentView = { type: 'external', url };
    }

    function showHistoryEntry(entry) {
        if (!entry || !entry.type) return;

        if (entry.type === 'external') {
            showExternalPage(entry.url);
            return;
        }

        showInternalPage(entry.pageName);
    }

    function updateResponsiveClasses() {
        const browserWindow = document.getElementById("window-browser");
        const portfolioSite = browserWindow?.querySelector('.portfolio-site');
        if (!browserWindow || !portfolioSite) return;

        const width = browserWindow.offsetWidth;

        // Remove all responsive classes
        browserWindow.classList.remove('browser-window--mobile', 'browser-window--tablet');
        portfolioSite.classList.remove('portfolio-site--mobile', 'portfolio-site--tablet');

        // Add appropriate class based on browser window width
        if (width <= 480) {
            browserWindow.classList.add('browser-window--mobile');
            portfolioSite.classList.add('portfolio-site--mobile');
        } else if (width <= 768) {
            browserWindow.classList.add('browser-window--tablet');
            portfolioSite.classList.add('portfolio-site--tablet');
        }
    }

    function init() {
        const browserWindow = document.getElementById("window-browser");
        if (!browserWindow) return;

        const backBtn = document.getElementById("browser-back");
        const forwardBtn = document.getElementById("browser-forward");
        const refreshBtn = document.getElementById("browser-refresh");

        // Set up responsive class updates
        updateResponsiveClasses();

        // Use ResizeObserver to watch for browser window size changes
        const resizeObserver = new ResizeObserver(() => {
            updateResponsiveClasses();
        });
        resizeObserver.observe(browserWindow);

        // Navigation link handlers
        document.querySelectorAll('[data-page]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const page = link.getAttribute('data-page');
                if (page) {
                    navigateToPage(page);
                }
            });
        });

        document.querySelectorAll('[data-external-url]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const externalUrl = link.getAttribute('data-external-url');
                if (externalUrl) {
                    navigateToExternalUrl(externalUrl);
                }
            });
        });

        // Browser navigation buttons
        if (backBtn) {
            backBtn.addEventListener("click", () => {
                if (historyIndex > 0) {
                    historyIndex--;
                    showHistoryEntry(history[historyIndex]);
                }
            });
        }

        if (forwardBtn) {
            forwardBtn.addEventListener("click", () => {
                if (historyIndex < history.length - 1) {
                    historyIndex++;
                    showHistoryEntry(history[historyIndex]);
                }
            });
        }

        if (refreshBtn) {
            refreshBtn.addEventListener("click", () => {
                if (currentView.type === 'external') {
                    const externalFrame = document.getElementById('browser-external-frame');
                    if (externalFrame && currentView.url) {
                        externalFrame.src = currentView.url;
                    }
                    return;
                }

                if (currentView.type === 'internal' && currentView.pageName === 'osrs-hiscores' && typeof OsrsHiscores !== 'undefined') {
                    OsrsHiscores.load(OsrsHiscores.DEFAULT_PLAYER);
                    return;
                }

                const content = document.getElementById("browser-content");
                if (content) {
                    content.scrollTop = 0;
                }
            });
        }

        initMediaLightbox(browserWindow);
        initMediaCarousels(browserWindow);

        browserWindow.addEventListener('click', (e) => {
            const pdfBtn = e.target.closest('[data-pdf-url]');
            if (!pdfBtn || !browserWindow.contains(pdfBtn)) return;

            e.preventDefault();
            if (window.DesktopApp && typeof window.DesktopApp.openPdfDocument === 'function') {
                window.DesktopApp.openPdfDocument(pdfBtn.dataset.pdfUrl, pdfBtn.dataset.pdfName || 'Document');
            }
        });

        // Initialize to home page
        showInternalPage('home');
    }

    function initMediaCarousels(browserWindow) {
        if (!browserWindow) return;

        browserWindow.querySelectorAll('[data-media-carousel]').forEach((carousel) => {
            const viewport = carousel.querySelector('[data-carousel-viewport]');
            const track = carousel.querySelector('[data-carousel-track]');
            const slides = Array.from(carousel.querySelectorAll('[data-carousel-slide]'));
            const prevBtn = carousel.querySelector('[data-carousel-prev]');
            const nextBtn = carousel.querySelector('[data-carousel-next]');
            const dotsContainer = carousel.querySelector('[data-carousel-dots]');
            const counter = carousel.querySelector('[data-carousel-counter]');

            if (!viewport || !track || !slides.length) return;

            let activeIndex = 0;

            function getSlideOffsets() {
                return slides.map((slide) => slide.offsetLeft);
            }

            function getActiveIndex() {
                const offsets = getSlideOffsets();
                const scrollLeft = viewport.scrollLeft;
                let closestIndex = 0;
                let closestDistance = Number.POSITIVE_INFINITY;

                offsets.forEach((offset, index) => {
                    const distance = Math.abs(offset - scrollLeft);
                    if (distance < closestDistance) {
                        closestDistance = distance;
                        closestIndex = index;
                    }
                });

                return closestIndex;
            }

            function updateCarouselState() {
                activeIndex = getActiveIndex();

                if (prevBtn) {
                    prevBtn.disabled = activeIndex <= 0;
                }

                if (nextBtn) {
                    nextBtn.disabled = activeIndex >= slides.length - 1;
                }

                if (dotsContainer) {
                    dotsContainer.querySelectorAll('[data-carousel-dot]').forEach((dot, index) => {
                        const isActive = index === activeIndex;
                        dot.classList.toggle('portfolio-site__insta-carousel-dot--active', isActive);
                        dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
                        dot.setAttribute('tabindex', isActive ? '0' : '-1');
                    });
                }

                if (counter) {
                    counter.textContent = `${activeIndex + 1} / ${slides.length}`;
                }
            }

            function scrollToSlide(index) {
                const target = slides[index];
                if (!target) return;

                viewport.scrollTo({
                    left: target.offsetLeft,
                    behavior: 'smooth'
                });
            }

            if (dotsContainer) {
                dotsContainer.innerHTML = '';
                slides.forEach((_, index) => {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = 'portfolio-site__insta-carousel-dot';
                    dot.dataset.carouselDot = String(index);
                    dot.setAttribute('role', 'tab');
                    dot.setAttribute('aria-label', `Go to slide ${index + 1}`);
                    dot.setAttribute('aria-selected', index === 0 ? 'true' : 'false');
                    dot.setAttribute('tabindex', index === 0 ? '0' : '-1');
                    dot.addEventListener('click', () => scrollToSlide(index));
                    dotsContainer.appendChild(dot);
                });
            }

            prevBtn?.addEventListener('click', () => {
                scrollToSlide(Math.max(0, getActiveIndex() - 1));
            });

            nextBtn?.addEventListener('click', () => {
                scrollToSlide(Math.min(slides.length - 1, getActiveIndex() + 1));
            });

            viewport.addEventListener('scroll', () => {
                window.requestAnimationFrame(updateCarouselState);
            }, { passive: true });

            viewport.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    scrollToSlide(Math.max(0, getActiveIndex() - 1));
                    return;
                }

                if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    scrollToSlide(Math.min(slides.length - 1, getActiveIndex() + 1));
                }
            });

            updateCarouselState();
        });
    }

    function initMediaLightbox(browserWindow) {
        const lightbox = document.getElementById('portfolio-site-lightbox');
        const lightboxImg = document.getElementById('portfolio-site-lightbox-img');
        const lightboxCaption = document.getElementById('portfolio-site-lightbox-caption');
        const lightboxCounter = document.getElementById('portfolio-site-lightbox-counter');
        const lightboxPrev = document.getElementById('portfolio-site-lightbox-prev');
        const lightboxNext = document.getElementById('portfolio-site-lightbox-next');
        const browserContent = document.getElementById('browser-content');
        const browserStage = browserWindow?.querySelector('.browser__stage');
        if (!lightbox || !lightboxImg || !lightboxCaption || !browserWindow) return;

        let galleryItems = [];
        let galleryIndex = 0;

        if (browserContent) {
            browserContent.classList.remove('browser__content--scroll-locked');
            browserContent.style.overflow = '';
        }

        function setLightboxImageMaxHeight() {
            const stageHeight = browserStage?.clientHeight || browserContent?.clientHeight || 0;
            if (!stageHeight) return;
            const maxImageHeight = Math.max(200, stageHeight - 120);
            lightboxImg.style.maxHeight = `${maxImageHeight}px`;
        }

        function getGalleryItems(section) {
            if (!section) return [];

            return Array.from(section.querySelectorAll('.portfolio-site__media-figure')).map((figure) => {
                const img = figure.querySelector('img');
                if (!img) return null;

                return {
                    src: img.currentSrc || img.src,
                    alt: img.alt || '',
                    caption: figure.querySelector('figcaption')?.textContent?.trim() || img.alt || ''
                };
            }).filter(Boolean);
        }

        function updateGalleryNav() {
            const hasMultiple = galleryItems.length > 1;

            if (lightboxPrev) {
                lightboxPrev.hidden = !hasMultiple;
                lightboxPrev.disabled = galleryIndex <= 0;
            }

            if (lightboxNext) {
                lightboxNext.hidden = !hasMultiple;
                lightboxNext.disabled = galleryIndex >= galleryItems.length - 1;
            }

            if (lightboxCounter) {
                if (hasMultiple) {
                    lightboxCounter.textContent = `${galleryIndex + 1} / ${galleryItems.length}`;
                    lightboxCounter.removeAttribute('aria-hidden');
                } else {
                    lightboxCounter.textContent = '';
                    lightboxCounter.setAttribute('aria-hidden', 'true');
                }
            }
        }

        function showGalleryItem(index) {
            const item = galleryItems[index];
            if (!item) return;

            galleryIndex = index;
            lightboxImg.src = item.src;
            lightboxImg.alt = item.alt;
            lightboxCaption.textContent = item.caption;
            setLightboxImageMaxHeight();
            updateGalleryNav();
        }

        function openLightbox(items, startIndex) {
            galleryItems = items;
            galleryIndex = startIndex;

            lightbox.setAttribute('aria-hidden', 'false');
            lightbox.classList.add('portfolio-site__lightbox--open');
            showGalleryItem(startIndex);

            if (browserContent) {
                browserContent.dataset.scrollTop = String(browserContent.scrollTop);
                browserContent.classList.add('browser__content--scroll-locked');
            }
        }

        function closeLightbox() {
            lightbox.setAttribute('aria-hidden', 'true');
            lightbox.classList.remove('portfolio-site__lightbox--open');
            lightboxImg.removeAttribute('src');
            lightboxImg.style.maxHeight = '';
            lightboxImg.alt = '';
            lightboxCaption.textContent = '';
            galleryItems = [];
            galleryIndex = 0;
            updateGalleryNav();

            if (browserContent) {
                browserContent.classList.remove('browser__content--scroll-locked');
                if (browserContent.dataset.scrollTop) {
                    browserContent.scrollTop = Number(browserContent.dataset.scrollTop);
                    delete browserContent.dataset.scrollTop;
                }
            }
        }

        function stepGallery(direction) {
            if (galleryItems.length <= 1) return;

            const nextIndex = galleryIndex + direction;
            if (nextIndex < 0 || nextIndex >= galleryItems.length) return;

            showGalleryItem(nextIndex);
        }

        browserWindow.addEventListener('click', (e) => {
            const figure = e.target.closest('.portfolio-site__case-study .portfolio-site__media-figure');
            if (!figure) return;

            const img = figure.querySelector('img');
            if (!img || !e.target.closest('img, figcaption')) return;

            e.preventDefault();

            const section = figure.closest('.portfolio-site__case-section');
            const items = getGalleryItems(section);
            const startIndex = Math.max(0, Array.from(section.querySelectorAll('.portfolio-site__media-figure')).indexOf(figure));

            if (!items.length) return;

            openLightbox(items, startIndex);
        });

        lightbox.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        lightbox.querySelectorAll('[data-lightbox-close]').forEach((el) => {
            el.addEventListener('click', (e) => {
                e.stopPropagation();
                closeLightbox();
            });
        });

        lightboxPrev?.addEventListener('click', (e) => {
            e.stopPropagation();
            stepGallery(-1);
        });

        lightboxNext?.addEventListener('click', (e) => {
            e.stopPropagation();
            stepGallery(1);
        });

        document.addEventListener('keydown', (e) => {
            if (!lightbox.classList.contains('portfolio-site__lightbox--open')) return;

            if (e.key === 'Escape') {
                closeLightbox();
                return;
            }

            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                stepGallery(-1);
                return;
            }

            if (e.key === 'ArrowRight') {
                e.preventDefault();
                stepGallery(1);
            }
        });

        updateGalleryNav();
    }

    return { init, navigateToPage, navigateToExternalUrl, showPage: showInternalPage };
})();

/* --------------------------- Projects (case study launcher) --------------------------- */

const Projects = (() => {
    function openCaseStudy(pageName) {
        if (window.DesktopApp && typeof window.DesktopApp.openWindow === 'function') {
            window.DesktopApp.openWindow('browser');
        }
        if (window.BrowserApp && typeof window.BrowserApp.navigateToPage === 'function') {
            window.BrowserApp.navigateToPage(pageName);
        }
    }

    function init() {
        const projectsWindow = document.getElementById('window-projects');
        if (!projectsWindow) return;

        projectsWindow.querySelectorAll('[data-open-case-study]').forEach(btn => {
            btn.addEventListener('click', () => {
                const page = btn.getAttribute('data-open-case-study');
                if (page) openCaseStudy(page);
            });
        });
    }

    return { init, openCaseStudy };
})();

window.BrowserApp = Browser;

/* --------------------------- File Explorer --------------------------- */
// FileExplorer is now loaded from ./assets/js/components/file-explorer.js
