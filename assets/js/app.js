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

document.addEventListener("DOMContentLoaded", async () => {
    // Load components dynamically
    try {
        await loadComponent('./assets/js/components/file-explorer.js');
        await loadComponent('./assets/js/components/snake.js');
        await loadComponent('./assets/js/components/invaders.js');

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
    } catch (error) {
        console.error('Error loading components:', error);
    }
});

/* ------------------ Desktop + Windows + Taskbar ------------------ */

const Desktop = (() => {
    const appIds = ["about", "projects", "skills", "contact", "files", "game", "invaders", "browser"];
    const windows = {};
    const taskButtons = {};
    let nextZ = 10;

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
                const taskbarHeight = 46;

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

            // minimise
            btnMin.addEventListener("click", () => {
                win.classList.add("window--minimised");
                win.classList.remove("window--maximised");
                if (taskButtons[id]) taskButtons[id].classList.add("taskbar-item--minimised");
            });

            // maximize/restore
            btnMax.addEventListener("click", () => {
                if (win.classList.contains("window--maximised")) {
                    // Restore
                    win.classList.remove("window--maximised");
                    if (originalState.left !== null) {
                        win.style.left = `${originalState.left}px`;
                        win.style.top = `${originalState.top}px`;
                        win.style.width = `${originalState.width}px`;
                        win.style.height = `${originalState.height}px`;
                    }
                    btnMax.textContent = "□";
                } else {
                    // Maximize
                    originalState.left = parseInt(win.style.left) || win.offsetLeft;
                    originalState.top = parseInt(win.style.top) || win.offsetTop;
                    originalState.width = parseInt(win.style.width) || win.offsetWidth;
                    originalState.height = parseInt(win.style.height) || win.offsetHeight;

                    win.classList.add("window--maximised");
                    btnMax.textContent = "❐";
                }
                constrainWindowToViewport(win);
            });

            // close
            btnClose.addEventListener("click", () => {
                win.classList.add("window--hidden");
                win.classList.remove("window--minimised", "window--maximised");
                if (taskButtons[id]) {
                    taskButtons[id].remove();
                    delete taskButtons[id];
                }
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
                const taskbarHeight = 46;
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

    function constrainWindowToViewport(win) {
        const winRect = win.getBoundingClientRect();
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;
        const taskbarHeight = 46;
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

    function openWindow(id) {
        const win = windows[id];
        if (!win) return;

        const wasHidden = win.classList.contains("window--hidden");
        win.classList.remove("window--hidden", "window--minimised");

        // Special handling for game windows - skip constrainWindowToViewport
        // as they may handle their own sizing
        if (id !== "game" && id !== "invaders") {
            // Ensure window fits within viewport
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
                    constrainWindowToViewport(win);
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

    function initDesktopIcons() {
        document.querySelectorAll(".desktop-icon").forEach(icon => {
            const appId = icon.dataset.app;

            // Desktop: double-click to open
            icon.addEventListener("dblclick", () => openWindow(appId));

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
                    const taskbarHeight = 46;
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
                        openWindow(appId);
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
                    const taskbarHeight = 46;
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
                        openWindow(appId);
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

        // Handle recommended file clicks
        document.querySelectorAll(".start-menu__file").forEach(file => {
            file.addEventListener("click", () => {
                const fileType = file.dataset.file;
                // Open files window and potentially navigate to specific file
                openWindow("files");
                startMenu.classList.add("start-menu--hidden");
                // You can extend this to open specific files if needed
            });
        });

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
                        // Skip game windows if they're in full screen mode
                        if ((id === "game" || id === "invaders") && win.classList.contains("window--maximised")) {
                            return;
                        }
                        constrainWindowToViewport(win);
                    }
                });
            }, 100);
        });

        // expose if you want to trigger from elsewhere
        window.DesktopApp = { openWindow };
    }

    return { init, openWindow };
})();


/* --------------------------- Browser --------------------------- */

const Browser = (() => {
    let currentPage = 'home';
    const history = ['home'];
    let historyIndex = 0;

    function showPage(pageName) {
        // Hide all pages
        document.querySelectorAll('.portfolio-site__page').forEach(page => {
            page.classList.remove('portfolio-site__page--active');
        });

        // Show selected page
        const page = document.getElementById(`page-${pageName}`);
        if (page) {
            page.classList.add('portfolio-site__page--active');
            currentPage = pageName;

            // Update URL
            const urlInput = document.getElementById('browser-url');
            if (urlInput) {
                urlInput.value = `https://jackheeney.dev/${pageName === 'home' ? '' : pageName}`;
            }

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
            }
        }
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
        document.querySelectorAll('.portfolio-site__top-nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const page = link.getAttribute('data-page');
                if (page) {
                    // Add to history
                    historyIndex++;
                    history.splice(historyIndex);
                    history.push(page);
                    showPage(page);
                }
            });
        });

        // Contact button in hero
        const heroButton = document.querySelector('.portfolio-site__hero-button');
        if (heroButton) {
            heroButton.addEventListener('click', () => {
                historyIndex++;
                history.splice(historyIndex);
                history.push('contact');
                showPage('contact');
            });
        }

        // Browser navigation buttons
        if (backBtn) {
            backBtn.addEventListener("click", () => {
                if (historyIndex > 0) {
                    historyIndex--;
                    showPage(history[historyIndex]);
                }
            });
        }

        if (forwardBtn) {
            forwardBtn.addEventListener("click", () => {
                if (historyIndex < history.length - 1) {
                    historyIndex++;
                    showPage(history[historyIndex]);
                }
            });
        }

        if (refreshBtn) {
            refreshBtn.addEventListener("click", () => {
                const content = document.getElementById("browser-content");
                if (content) {
                    content.scrollTop = 0;
                }
            });
        }

        // Initialize to home page
        showPage('home');
    }

    return { init };
})();

/* --------------------------- File Explorer --------------------------- */
// FileExplorer is now loaded from ./assets/js/components/file-explorer.js
