/* ------------------------------ Snake ------------------------------ */

const SnakeGame = (() => {
    const GRID_SIZE = 20;
    const STEP_MS = 150;
    const MIN_CANVAS_SIZE = 120;
    const MAX_INIT_RETRIES = 12;
    const COLORS = {
        board: "#020617",
        head: "#4ade80",
        body: "#16a34a",
        food: "#ef4444"
    };

    let canvas, ctx, boardWrapEl, scoreEl, infoEl, infoMainEl, infoSubEl, resetBtn;
    let gameWindow, loadingEl, gameContentEl, mobileControlsEl;
    let snake = [[10, 10]];
    let direction = "RIGHT";
    let queuedDirection = "RIGHT";
    let food = [5, 5];
    let score = 0;
    let gameOver = false;
    let isPlaying = false;
    let timer = null;
    let isLoading = false;
    let lastInfoState = "";
    let lastCanvasSize = 0;
    let openDebounceTimer = null;

    function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
            window.innerWidth <= 768;
    }

    function isSnakeWindowActive() {
        if (!gameWindow || gameWindow.classList.contains("window--hidden")) return false;

        const snakeZ = parseInt(gameWindow.style.zIndex, 10) || 0;
        let maxZ = 0;

        document.querySelectorAll(".window:not(.window--hidden)").forEach((win) => {
            const z = parseInt(win.style.zIndex, 10) || 0;
            if (z > maxZ) maxZ = z;
        });

        return snakeZ >= maxZ;
    }

    function isGameContentVisible() {
        return gameContentEl && getComputedStyle(gameContentEl).display !== "none";
    }

    function updateMobileControlsVisibility() {
        const body = gameWindow?.querySelector(".window__body.snake");
        if (!body) return;

        body.classList.toggle("snake--touch", isMobile());
        lastInfoState = "";
        updateInfoText();
    }

    function measureBoardSize() {
        if (!boardWrapEl) return 0;

        boardWrapEl.offsetHeight;

        let width = boardWrapEl.clientWidth;
        let height = boardWrapEl.clientHeight;

        if (width <= 0 || height <= 0) {
            const rect = boardWrapEl.getBoundingClientRect();
            width = Math.max(width, rect.width);
            height = Math.max(height, rect.height);
        }

        return Math.floor(Math.min(width, height));
    }

    function initCanvas() {
        if (!canvas || !boardWrapEl) return false;

        const size = measureBoardSize();
        if (size < MIN_CANVAS_SIZE) return false;

        if (size !== lastCanvasSize) {
            lastCanvasSize = size;
            canvas.width = size;
            canvas.height = size;
            canvas.style.width = `${size}px`;
            canvas.style.height = `${size}px`;
        }

        draw();
        return true;
    }

    function ensureCanvasReady(attempt, onReady) {
        if (initCanvas()) {
            onReady?.();
            return;
        }

        if (attempt >= MAX_INIT_RETRIES) {
            const fallback = Math.max(
                MIN_CANVAS_SIZE,
                Math.floor(Math.min(window.innerWidth, window.innerHeight) * 0.45)
            );
            lastCanvasSize = fallback;
            canvas.width = fallback;
            canvas.height = fallback;
            canvas.style.width = `${fallback}px`;
            canvas.style.height = `${fallback}px`;
            draw();
            onReady?.();
            return;
        }

        requestAnimationFrame(() => ensureCanvasReady(attempt + 1, onReady));
    }

    function cellSize() {
        if (!canvas || !canvas.width) return 0;
        return canvas.width / GRID_SIZE;
    }

    function resetGameState() {
        const startPos = Math.floor(GRID_SIZE / 2);
        snake = [[startPos, startPos]];
        direction = "RIGHT";
        queuedDirection = "RIGHT";
        food = randomFood();
        score = 0;
        gameOver = false;
        lastInfoState = "";
    }

    function randomFood() {
        let nextFood;
        do {
            nextFood = [
                Math.floor(Math.random() * GRID_SIZE),
                Math.floor(Math.random() * GRID_SIZE)
            ];
        } while (snake.some(([x, y]) => x === nextFood[0] && y === nextFood[1]));
        return nextFood;
    }

    function drawCell(x, y, color, round = false) {
        const size = cellSize();
        if (size <= 0) return;

        const gap = 1;
        const inset = gap / 2;
        const px = x * size + inset;
        const py = y * size + inset;
        const side = Math.max(1, size - gap);

        ctx.fillStyle = color;
        if (round) {
            ctx.beginPath();
            ctx.arc(px + side / 2, py + side / 2, side / 2, 0, Math.PI * 2);
            ctx.fill();
            return;
        }

        ctx.fillRect(px, py, side, side);
    }

    function draw() {
        if (!ctx || !canvas || canvas.width <= 0) return;

        ctx.fillStyle = COLORS.board;
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        drawCell(food[0], food[1], COLORS.food, true);

        snake.forEach(([x, y], index) => {
            drawCell(x, y, index === 0 ? COLORS.head : COLORS.body);
        });
    }

    function updateInfoText() {
        if (!infoMainEl || !infoSubEl) return;

        const infoState = `${gameOver ? "over" : "playing"}-${isMobile() ? "mobile" : "desktop"}`;
        if (infoState === lastInfoState) return;
        lastInfoState = infoState;

        const controlHint = isMobile() ? "Use the buttons below" : "Use arrow keys";

        infoMainEl.textContent = gameOver ? "Game Over!" : `${controlHint} to move`;
        infoMainEl.classList.toggle("snake__info-main--danger", gameOver);
        infoSubEl.textContent = gameOver ? `${controlHint} to play again` : "Don't hit the walls or yourself!";
    }

    function updateBoard() {
        if (scoreEl) scoreEl.textContent = score;
        updateInfoText();
        draw();
    }

    function commitDirection(newDirection) {
        if (newDirection === "UP" && queuedDirection !== "DOWN") queuedDirection = "UP";
        if (newDirection === "DOWN" && queuedDirection !== "UP") queuedDirection = "DOWN";
        if (newDirection === "LEFT" && queuedDirection !== "RIGHT") queuedDirection = "LEFT";
        if (newDirection === "RIGHT" && queuedDirection !== "LEFT") queuedDirection = "RIGHT";
    }

    function step() {
        if (!isPlaying || gameOver) return;

        direction = queuedDirection;

        const head = snake[0].slice();
        if (direction === "UP") head[1] -= 1;
        if (direction === "DOWN") head[1] += 1;
        if (direction === "LEFT") head[0] -= 1;
        if (direction === "RIGHT") head[0] += 1;

        if (head[0] < 0 || head[0] >= GRID_SIZE || head[1] < 0 || head[1] >= GRID_SIZE) {
            gameOver = true;
            updateBoard();
            return;
        }

        if (snake.slice(1).some(([x, y]) => x === head[0] && y === head[1])) {
            gameOver = true;
            updateBoard();
            return;
        }

        snake.unshift(head);

        if (head[0] === food[0] && head[1] === food[1]) {
            score += 10;
            food = randomFood();
        } else {
            snake.pop();
        }

        updateBoard();
    }

    function reset() {
        resetGameState();
        lastCanvasSize = 0;
        initCanvas();
        updateBoard();
    }

    function startPlaying() {
        ensureCanvasReady(0, () => {
            isPlaying = true;
            resetGameState();
            updateBoard();
            gameContentEl?.focus({ preventScroll: true });
        });
    }

    function changeDirection(newDirection) {
        if (!isPlaying && !gameOver) return;

        if (gameOver) {
            reset();
            commitDirection(newDirection);
            return;
        }

        commitDirection(newDirection);
    }

    function finishLoading() {
        if (!loadingEl || !gameContentEl) return;

        loadingEl.style.display = "none";
        gameContentEl.style.display = "flex";
        updateMobileControlsVisibility();

        requestAnimationFrame(() => {
            lastCanvasSize = 0;
            startPlaying();
        });
    }

    function showLoadingAnimation() {
        if (isLoading) return;
        isLoading = true;
        isPlaying = false;

        const loadingProgress = document.getElementById("snake-loading-progress");
        const loadingContent = document.getElementById("snake-loading-content");
        const loadingImage = document.getElementById("snake-loading-image");
        if (!loadingProgress || !loadingEl || !gameContentEl || !loadingContent || !loadingImage) {
            isLoading = false;
            return;
        }

        loadingProgress.style.width = "0%";
        loadingContent.style.display = "block";
        loadingImage.style.display = "none";
        loadingEl.style.display = "flex";
        gameContentEl.style.display = "none";

        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 15 + 5;
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval);
                loadingContent.style.display = "none";
                loadingImage.style.display = "flex";

                setTimeout(() => {
                    finishLoading();
                    isLoading = false;
                }, 1500);
            }
            loadingProgress.style.width = `${progress}%`;
        }, 100);
    }

    function handleWindowOpen() {
        if (!gameWindow) {
            gameWindow = document.getElementById("window-game");
        }
        if (!gameWindow || gameWindow.classList.contains("window--hidden")) return;

        if (window.DesktopApp && typeof window.DesktopApp.fitGameWindow === "function") {
            window.DesktopApp.fitGameWindow(gameWindow);
        }

        updateMobileControlsVisibility();

        clearTimeout(openDebounceTimer);
        openDebounceTimer = setTimeout(() => {
            if (!isLoading) {
                showLoadingAnimation();
            }
        }, 120);
    }

    function handleArrowKey(e) {
        if (!e.key.startsWith("Arrow")) return;
        if (!isSnakeWindowActive()) return;

        e.preventDefault();

        if (e.key === "ArrowUp") changeDirection("UP");
        if (e.key === "ArrowDown") changeDirection("DOWN");
        if (e.key === "ArrowLeft") changeDirection("LEFT");
        if (e.key === "ArrowRight") changeDirection("RIGHT");
    }

    window.SnakeGameApp = window.SnakeGameApp || {};
    window.SnakeGameApp.handleWindowOpen = handleWindowOpen;

    function init() {
        canvas = document.getElementById("snake-board");
        if (!canvas) return;

        ctx = canvas.getContext("2d");
        boardWrapEl = canvas.closest(".snake__board-wrap");
        scoreEl = document.getElementById("snake-score");
        infoEl = document.getElementById("snake-info");
        infoMainEl = infoEl?.querySelector(".snake__info-main");
        infoSubEl = infoEl?.querySelector(".snake__info-sub");
        resetBtn = document.getElementById("snake-reset");
        loadingEl = document.getElementById("snake-loading");
        gameContentEl = document.getElementById("snake-game-content");
        mobileControlsEl = document.getElementById("snake-mobile-controls");
        gameWindow = document.getElementById("window-game");

        if (loadingEl) loadingEl.style.display = "flex";
        if (gameContentEl) gameContentEl.style.display = "none";

        updateMobileControlsVisibility();

        if (gameWindow) {
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === "attributes" && mutation.attributeName === "class") {
                        if (gameWindow.classList.contains("window--hidden")) {
                            isPlaying = false;
                        } else {
                            handleWindowOpen();
                        }
                    }
                });
            });

            observer.observe(gameWindow, { attributes: true, attributeFilter: ["class"] });

            if (!gameWindow.classList.contains("window--hidden")) {
                handleWindowOpen();
            }

            gameWindow.addEventListener("mousedown", () => {
                gameContentEl?.focus({ preventScroll: true });
            });
        }

        document.addEventListener("keydown", handleArrowKey);

        if (mobileControlsEl) {
            mobileControlsEl.querySelectorAll(".snake__control-btn").forEach((btn) => {
                const triggerDirectionChange = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    changeDirection(btn.dataset.direction);
                };

                btn.addEventListener("touchstart", triggerDirectionChange, { passive: false });
                btn.addEventListener("pointerdown", triggerDirectionChange);
                btn.addEventListener("click", (e) => {
                    e.preventDefault();
                });
            });
        }

        resetBtn?.addEventListener("click", reset);

        let resizeTimeout;
        const handleResize = () => {
            if (!canvas || gameWindow?.classList.contains("window--hidden")) return;
            if (!isGameContentVisible()) return;

            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                const prevSize = lastCanvasSize;
                initCanvas();
                if (lastCanvasSize !== prevSize && isPlaying) {
                    draw();
                }
            }, 150);
        };

        window.addEventListener("resize", handleResize);

        if (boardWrapEl) {
            const resizeObserver = new ResizeObserver(handleResize);
            resizeObserver.observe(boardWrapEl);
        }

        if (gameContentEl) {
            const contentObserver = new ResizeObserver(handleResize);
            contentObserver.observe(gameContentEl);
        }

        timer = setInterval(step, STEP_MS);
    }

    return { init };
})();
