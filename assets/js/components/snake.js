/* ------------------------------ Snake ------------------------------ */

const SnakeGame = (() => {
    let gridSize = 20;
    let boardEl, scoreEl, infoEl, resetBtn, gameWindow, loadingEl, gameContentEl, mobileControlsEl;
    let cells = [];
    let snake = [[5, 5]];
    let direction = "RIGHT";
    let food = [10, 10];
    let score = 0;
    let gameOver = false;
    let timer = null;
    let isLoading = false;
    let isFullScreen = false;

    function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
            (window.innerWidth <= 768);
    }

    function showLoadingAnimation() {
        if (isLoading) return;
        isLoading = true;

        const loadingProgress = document.getElementById("snake-loading-progress");
        const loadingContent = document.getElementById("snake-loading-content");
        const loadingImage = document.getElementById("snake-loading-image");
        if (!loadingProgress || !loadingEl || !gameContentEl || !loadingContent || !loadingImage) return;

        // Reset progress bar and show loading content
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
                // Hide progress bar content and show image
                loadingContent.style.display = "none";
                loadingImage.style.display = "flex";

                // Show image briefly (1.5 seconds), then show game
                setTimeout(() => {
                    if (loadingEl && gameContentEl) {
                        loadingEl.style.display = "none";
                        gameContentEl.style.display = "block";

                        // Recalculate grid size after game content is shown
                        setTimeout(() => {
                            if (boardEl) {
                                // Force a reflow to ensure dimensions are updated
                                boardEl.offsetHeight;
                                gridSize = calculateGridSize();
                                initBoard();
                                updateBoard();
                            }
                        }, 100);
                    }
                    isLoading = false;
                }, 1500);
            }
            if (loadingProgress) {
                loadingProgress.style.width = `${progress}%`;
            }
        }, 100);
    }

    function goFullScreen() {
        if (isFullScreen) return;

        gameWindow = document.getElementById("window-game");
        if (!gameWindow) return;

        // Store original state
        const originalState = {
            left: gameWindow.style.left,
            top: gameWindow.style.top,
            width: gameWindow.style.width,
            height: gameWindow.style.height
        };
        gameWindow.dataset.originalState = JSON.stringify(originalState);

        // Maximize to full screen
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;
        const taskbarHeight = 46;

        // Set full screen dimensions
        gameWindow.style.left = "0px";
        gameWindow.style.top = "0px";
        gameWindow.style.width = `${viewportWidth}px`;
        gameWindow.style.height = `${viewportHeight - taskbarHeight}px`;
        gameWindow.classList.add("window--maximised");

        // Force a reflow to ensure styles are applied
        gameWindow.offsetHeight;

        // Recalculate grid after fullscreen
        setTimeout(() => {
            if (boardEl) {
                boardEl.offsetHeight;
                gridSize = calculateGridSize();
                initBoard();
                updateBoard();
            }
        }, 100);

        isFullScreen = true;
    }

    function calculateGridSize() {
        if (!boardEl) return 20;

        // Get the actual board dimensions (including padding)
        const boardRect = boardEl.getBoundingClientRect();
        const padding = 20; // Padding from CSS (10px on each side)
        const gap = 1; // Gap between cells from CSS
        const minCellSize = 8; // Minimum cell size for very small windows
        const maxCellSize = 20; // Maximum cell size for very large windows

        // Calculate available space
        const availableWidth = boardRect.width - padding;
        const availableHeight = boardRect.height - padding;

        if (availableWidth <= 0 || availableHeight <= 0) return 20;

        // Calculate how many cells can fit based on minimum cell size
        const cols = Math.floor((availableWidth + gap) / (minCellSize + gap));
        const rows = Math.floor((availableHeight + gap) / (minCellSize + gap));

        // Use the smaller dimension to keep it square and ensure all cells fit
        const calculatedSize = Math.min(cols, rows);

        // Ensure minimum size and reasonable maximum
        return Math.max(10, Math.min(calculatedSize, 100)) || 20;
    }

    function calculateCellSize() {
        if (!boardEl) return 15;

        const boardRect = boardEl.getBoundingClientRect();
        const padding = 20;
        const gap = 1;

        const availableWidth = boardRect.width - padding;
        const availableHeight = boardRect.height - padding;

        if (availableWidth <= 0 || availableHeight <= 0) return 15;

        // Calculate cell size based on grid size and available space
        // Formula: (availableSize + gap) / gridSize - gap
        const cellWidth = (availableWidth + gap) / gridSize - gap;
        const cellHeight = (availableHeight + gap) / gridSize - gap;

        // Use the smaller dimension to ensure cells fit
        return Math.max(8, Math.min(cellWidth, cellHeight, 20));
    }

    function initBoard() {
        if (!boardEl) return;

        // Calculate grid size based on actual board dimensions
        gridSize = calculateGridSize();
        const cellSize = calculateCellSize();

        // Update CSS grid to match calculated size with flexible cell sizing
        boardEl.style.gridTemplateColumns = `repeat(${gridSize}, ${cellSize}px)`;
        boardEl.style.gridAutoRows = `${cellSize}px`;

        boardEl.innerHTML = "";
        cells = [];
        for (let y = 0; y < gridSize; y++) {
            for (let x = 0; x < gridSize; x++) {
                const cell = document.createElement("div");
                cell.className = "snake__cell";
                cell.dataset.x = x;
                cell.dataset.y = y;
                boardEl.appendChild(cell);
                cells.push(cell);
            }
        }

        // Reset snake and food to valid positions
        const startPos = Math.floor(gridSize / 2);
        snake = [[startPos, startPos]];
        food = randomFood();
    }

    function cellAt(x, y) {
        return cells.find(c => Number(c.dataset.x) === x && Number(c.dataset.y) === y);
    }

    function randomFood() {
        let newFood;
        do {
            newFood = [
                Math.floor(Math.random() * gridSize),
                Math.floor(Math.random() * gridSize)
            ];
        } while (snake.some(([x, y]) => x === newFood[0] && y === newFood[1]));
        return newFood;
    }

    function updateBoard() {
        cells.forEach(c => c.className = "snake__cell");

        snake.forEach(([x, y], i) => {
            const c = cellAt(x, y);
            if (!c) return;
            if (i === 0) c.classList.add("snake__cell--head");
            else c.classList.add("snake__cell--body");
        });

        const foodCell = cellAt(food[0], food[1]);
        if (foodCell) foodCell.classList.add("snake__cell--food");

        scoreEl.textContent = score;

        if (gameOver) {
            const controlHint = isMobile() ? "Tap the buttons below" : "Use arrow keys";
            infoEl.innerHTML = `<div class="snake__info-main snake__info-main--danger">Game Over!</div>
                                <div class="snake__info-sub">${controlHint} to play again</div>`;
        } else {
            const controlHint = isMobile() ? "Use the buttons below" : "Use arrow keys";
            infoEl.innerHTML = `<div class="snake__info-main">${controlHint} to move</div>
                                <div class="snake__info-sub">Don't hit the walls or yourself!</div>`;
        }
    }

    function step() {
        if (gameOver) return;

        const head = snake[0].slice();
        if (direction === "UP") head[1] -= 1;
        if (direction === "DOWN") head[1] += 1;
        if (direction === "LEFT") head[0] -= 1;
        if (direction === "RIGHT") head[0] += 1;

        // wall
        if (head[0] < 0 || head[0] >= gridSize || head[1] < 0 || head[1] >= gridSize) {
            gameOver = true;
            updateBoard();
            return;
        }

        // self (check against body only, excluding current head)
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
        // Recalculate grid size in case window was resized
        if (boardEl) {
            boardEl.offsetHeight; // Force reflow
        }
        gridSize = calculateGridSize();
        const startPos = Math.floor(gridSize / 2);
        snake = [[startPos, startPos]];
        direction = "RIGHT";
        food = randomFood();
        score = 0;
        gameOver = false;
        initBoard(); // Reinitialize board to update grid
        updateBoard();
    }

    function changeDirection(newDirection) {
        if (gameOver) {
            reset();
            return;
        }

        // Prevent reversing into itself
        if (newDirection === "UP" && direction !== "DOWN") direction = "UP";
        if (newDirection === "DOWN" && direction !== "UP") direction = "DOWN";
        if (newDirection === "LEFT" && direction !== "RIGHT") direction = "LEFT";
        if (newDirection === "RIGHT" && direction !== "LEFT") direction = "RIGHT";
    }

    function handleWindowOpen() {
        if (!gameWindow) {
            gameWindow = document.getElementById("window-game");
        }
        if (!gameWindow || gameWindow.classList.contains("window--hidden")) return;

        // Don't go full screen - keep window at reasonable size
        // if (!isFullScreen) {
        //     goFullScreen();
        // }

        // Give the window a moment to render before showing loading animation
        setTimeout(() => {
            if (!isLoading) {
                showLoadingAnimation();
            }
        }, 120);
    }

    // Expose handleWindowOpen early so Desktop can use it
    window.SnakeGameApp = window.SnakeGameApp || {};
    window.SnakeGameApp.handleWindowOpen = handleWindowOpen;

    function init() {
        boardEl = document.getElementById("snake-board");
        if (!boardEl) return;

        scoreEl = document.getElementById("snake-score");
        infoEl = document.getElementById("snake-info");
        resetBtn = document.getElementById("snake-reset");
        loadingEl = document.getElementById("snake-loading");
        gameContentEl = document.getElementById("snake-game-content");
        mobileControlsEl = document.getElementById("snake-mobile-controls");
        gameWindow = document.getElementById("window-game");

        // Initialize loading screen - make sure it's visible when window opens
        if (loadingEl) {
            loadingEl.style.display = "flex";
        }
        if (gameContentEl) {
            gameContentEl.style.display = "none";
        }

        // Show/hide mobile controls based on device
        if (mobileControlsEl) {
            if (isMobile()) {
                mobileControlsEl.style.display = "flex";
            } else {
                mobileControlsEl.style.display = "none";
            }
        }

        // Watch for window opening/closing
        if (gameWindow) {
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        const isHidden = gameWindow.classList.contains("window--hidden");
                        if (isHidden) {
                            // Reset full screen state when window is closed
                            isFullScreen = false;
                        } else {
                            // Window opened - handle it
                            handleWindowOpen();
                        }
                    }
                });
            });

            observer.observe(gameWindow, { attributes: true, attributeFilter: ['class'] });

            // Also check initial state
            if (!gameWindow.classList.contains("window--hidden") && !isFullScreen) {
                handleWindowOpen();
            }
        }

        initBoard();
        updateBoard();

        // Desktop keyboard controls
        document.addEventListener("keydown", e => {
            if (gameWindow && gameWindow.classList.contains("window--hidden")) return;
            if (e.key === "ArrowUp") changeDirection("UP");
            if (e.key === "ArrowDown") changeDirection("DOWN");
            if (e.key === "ArrowLeft") changeDirection("LEFT");
            if (e.key === "ArrowRight") changeDirection("RIGHT");
        });

        // Mobile touch controls
        if (mobileControlsEl) {
            mobileControlsEl.querySelectorAll(".snake__control-btn").forEach(btn => {
                btn.addEventListener("click", (e) => {
                    e.preventDefault();
                    const dir = btn.dataset.direction;
                    changeDirection(dir);
                });

                // Prevent default touch behaviour
                btn.addEventListener("touchstart", (e) => {
                    e.preventDefault();
                    const dir = btn.dataset.direction;
                    changeDirection(dir);
                });
            });
        }

        resetBtn.addEventListener("click", reset);

        // Handle window resize to recalculate grid
        let resizeTimeout;
        const handleResize = () => {
            if (!boardEl || gameWindow?.classList.contains("window--hidden")) return;
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                // Force a reflow to ensure dimensions are updated
                if (boardEl) {
                    boardEl.offsetHeight;
                }
                const newGridSize = calculateGridSize();
                // Always reinitialize board on resize to update cell sizes
                if (newGridSize !== gridSize || !gameOver) {
                    gridSize = newGridSize;
                    initBoard();
                    updateBoard();
                }
            }, 150);
        };

        window.addEventListener("resize", handleResize);

        // Also observe the game window for size changes (handles manual resizing)
        if (gameWindow) {
            const resizeObserver = new ResizeObserver(() => {
                handleResize();
            });
            resizeObserver.observe(gameWindow);
            resizeObserver.observe(boardEl);
        }

        timer = setInterval(step, 150);
    }

    return { init };
})();
