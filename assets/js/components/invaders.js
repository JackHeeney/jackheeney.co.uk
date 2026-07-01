/* ------------------------------ Space Invaders ------------------------------ */

const SpaceInvaders = (() => {
    const HIGH_SCORE_API_URL = "./assets/api/invaders-highscores.php";
    const MIN_CANVAS_WIDTH = 220;
    const MIN_CANVAS_HEIGHT = 120;
    const MAX_CANVAS_INIT_RETRIES = 12;
    const TARGET_ENEMY_DROPS = 9;
    const MIN_ENEMY_DROP = 8;
    const MAX_ENEMY_DROP = 22;
    const MOBILE_SPEED_FACTOR = 0.5;
    const MOBILE_TARGET_DROPS = 12;
    const MOBILE_MIN_ENEMY_DROP = 6;
    const MOBILE_MAX_ENEMY_DROP = 14;
    let canvas, ctx, menuCanvas, menuCtx, gameWindow, loadingEl, gameContentEl, menuEl, mobileControlsEl;
    let scoreEl, livesEl, levelEl, infoEl, resetBtn, startBtn, hiscoreBtn, hiscoreModal, hiscoreList, hiscoreClose;
    let nameEntryEl, nameInputs, nameSubmitBtn, nameScoreEl;
    
    // Game state
    let gameState = 'loading'; // loading, menu, playing, paused, gameOver, nameEntry, highScores
    let score = 0;
    let lives = 3;
    let currentLevel = 1;
    let maxLevel = 10;
    let animationId = null;
    let menuAnimationId = null;
    let highScores = [];
    let isResizing = false;
    
    // Player
    let player = {
        x: 0,
        y: 0,
        width: 40,
        height: 30,
        speed: 5,
        color: '#4ade80'
    };
    
    // Bullets
    let bullets = [];
    let enemyBullets = [];
    let lastShot = 0;
    let shotCooldown = 300; // ms
    
    // Enemies
    let enemies = [];
    let enemyRows = 5;
    let enemyCols = 10;
    let enemyWidth = 30;
    let enemyHeight = 25;
    let enemySpeed = 0.5;
    let enemyDirection = 1; // 1 = right, -1 = left
    let enemyDropDistance = 20;
    let enemyShootChance = 0.002;
    
    // Input
    let keys = {};
    let mobileHoldTimers = {
        left: null,
        right: null,
        shoot: null
    };
    let nameEntryIndex = 0;
    
    function isMobile() {
        if (window.matchMedia && window.matchMedia("(pointer: coarse)").matches) {
            return true;
        }
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Mobile/i.test(navigator.userAgent) ||
            window.innerWidth <= 768;
    }

    function updateMobileControlsVisibility() {
        const body = gameWindow?.querySelector(".window__body.invaders");
        if (!body) return;

        if (isMobile()) {
            body.classList.add("invaders--touch");
        } else {
            body.classList.remove("invaders--touch");
        }
    }

    function setMobileActionState(action, isPressed) {
        if (action === 'left') {
            keys['ArrowLeft'] = isPressed;
        } else if (action === 'right') {
            keys['ArrowRight'] = isPressed;
        } else if (action === 'shoot') {
            keys[' '] = isPressed;
        }
    }

    function runMobileAction(action) {
        if (gameState !== 'playing' || !canvas) return;
        if (action === 'left') {
            player.x = Math.max(0, player.x - player.speed);
        } else if (action === 'right') {
            player.x = Math.min(canvas.width - player.width, player.x + player.speed);
        } else if (action === 'shoot') {
            const now = Date.now();
            if (now - lastShot > shotCooldown) {
                shoot();
                lastShot = now;
            }
        }
    }

    function clearMobileHoldTimer(action) {
        if (!mobileHoldTimers[action]) return;
        clearInterval(mobileHoldTimers[action]);
        mobileHoldTimers[action] = null;
    }

    function clearAllMobileInputs() {
        setMobileActionState('left', false);
        setMobileActionState('right', false);
        setMobileActionState('shoot', false);
        clearMobileHoldTimer('left');
        clearMobileHoldTimer('right');
        clearMobileHoldTimer('shoot');
    }

    function ensureGameplayStarted() {
        if (gameState === 'playing') return;
        if (gameState === 'loading' || gameState === 'nameEntry' || gameState === 'highScores') return;

        if (menuEl && menuEl.style.display !== "none") {
            hideMenu();
            return;
        }

        if (gameContentEl && gameContentEl.style.display !== "none") {
            startGame();
        }
    }
    
    function normaliseHighScores(entries) {
        if (!Array.isArray(entries)) {
            return [];
        }
        return entries
            .map((entry) => {
                const rawName = String(entry?.name || '').toUpperCase().replace(/[^A-Z]/g, '');
                const name = rawName.padEnd(3, 'A').slice(0, 3);
                const scoreValue = Number(entry?.score);
                const levelValue = Number(entry?.level);
                return {
                    name,
                    score: Number.isFinite(scoreValue) ? Math.max(0, Math.floor(scoreValue)) : 0,
                    level: Number.isFinite(levelValue) ? Math.max(1, Math.floor(levelValue)) : 1,
                    date: entry?.date || new Date().toISOString()
                };
            })
            .sort((a, b) => b.score - a.score)
            .slice(0, 10);
    }

    async function loadHighScores() {
        try {
            const response = await fetch(HIGH_SCORE_API_URL, {
                headers: { Accept: "application/json" }
            });
            const payload = await response.json();
            if (!response.ok || !payload.ok) {
                throw new Error(payload.error || "Could not load highscores.");
            }
            highScores = normaliseHighScores(payload.highScores || []);
            return highScores;
        } catch (error) {
            console.error('Failed to load shared highscores:', error);
        }

        try {
            const stored = localStorage.getItem('spaceInvadersHighScores');
            if (stored) {
                highScores = normaliseHighScores(JSON.parse(stored));
            } else {
                highScores = [];
            }
        } catch (e) {
            highScores = [];
        }
        return highScores;
    }
    
    async function saveHighScore(name, score, level) {
        const highScoreEntry = {
            name: String(name || '').toUpperCase().replace(/[^A-Z]/g, '').padEnd(3, 'A').slice(0, 3),
            score: Math.max(0, Math.floor(Number(score) || 0)),
            level: Math.max(1, Math.floor(Number(level) || 1))
        };

        try {
            const response = await fetch(HIGH_SCORE_API_URL, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json"
                },
                body: JSON.stringify(highScoreEntry)
            });
            const payload = await response.json();
            if (!response.ok || !payload.ok) {
                throw new Error(payload.error || "Could not save high score.");
            }
            highScores = normaliseHighScores(payload.highScores || []);
            return true;
        } catch (error) {
            console.error('Failed to save shared high score:', error);
        }

        highScores.push({ ...highScoreEntry, date: new Date().toISOString() });
        highScores = normaliseHighScores(highScores);
        try {
            localStorage.setItem('spaceInvadersHighScores', JSON.stringify(highScores));
        } catch (e) {
            console.error('Failed to save high score:', e);
        }
        return false;
    }
    
    function checkHighScore(score) {
        if (highScores.length < 10) return true;
        return score > highScores[highScores.length - 1].score;
    }
    
    function calculateScore(enemy) {
        const row = Number.isFinite(enemy?.row) ? enemy.row : 0;

        // Top 2 rows (red): 30 points
        if (row < 2) return 30;
        // Middle 2 rows (orange): 20 points
        if (row < 4) return 20;
        // Bottom row (blue): 10 points
        return 10;
    }
    
    function getLevelDifficulty(level) {
        const speed = 0.5 + (level - 1) * 0.2;
        const shootChance = 0.002 + (level - 1) * 0.001;
        const shotCooldown = Math.max(100, 300 - (level - 1) * 10);

        if (isMobile()) {
            return {
                speed: speed * MOBILE_SPEED_FACTOR,
                shootChance: shootChance * 0.75,
                shotCooldown: Math.min(450, shotCooldown + 80)
            };
        }

        return { speed, shootChance, shotCooldown };
    }

    function getTargetEnemyDrops() {
        return isMobile() ? MOBILE_TARGET_DROPS : TARGET_ENEMY_DROPS;
    }

    function getEnemyDropBounds() {
        if (isMobile()) {
            return { min: MOBILE_MIN_ENEMY_DROP, max: MOBILE_MAX_ENEMY_DROP };
        }
        return { min: MIN_ENEMY_DROP, max: MAX_ENEMY_DROP };
    }

    function calculateEnemyDropDistance(runway) {
        const { min, max } = getEnemyDropBounds();

        if (runway <= 0) {
            return min;
        }

        return Math.max(
            min,
            Math.min(max, Math.round(runway / getTargetEnemyDrops()))
        );
    }
    
    function showLoadingAnimation() {
        const loadingProgress = document.getElementById("invaders-loading-progress");
        const loadingContent = document.getElementById("invaders-loading-content");
        const loadingImage = document.getElementById("invaders-loading-image");
        if (!loadingProgress || !loadingEl || !loadingContent || !loadingImage) return;
        
        loadingProgress.style.width = "0%";
        loadingContent.style.display = "block";
        loadingImage.style.display = "none";
        
        loadingEl.style.display = "flex";
        if (menuEl) menuEl.style.display = "none";
        if (gameContentEl) gameContentEl.style.display = "none";
        
        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 15 + 5;
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval);
                loadingContent.style.display = "none";
                loadingImage.style.display = "flex";
                
                setTimeout(() => {
                    if (loadingEl && menuEl) {
                        loadingEl.style.display = "none";
                        showMenu();
                    }
                }, 1500);
            }
            if (loadingProgress) {
                loadingProgress.style.width = `${progress}%`;
            }
        }, 100);
    }
    
    function showMenu() {
        if (!menuEl) return;
        
        gameState = 'menu';
        loadingEl.style.display = "none";
        menuEl.style.display = "flex";
        if (gameContentEl) gameContentEl.style.display = "none";
        
        // Initialize menu canvas after a brief delay to ensure dimensions are set
        setTimeout(() => {
            if (menuCanvas && menuCtx && gameState === 'menu') {
                initMenuCanvas();
                initMenuGame();
                startMenuLoop();
            }
        }, 100);
    }
    
    function hideMenu() {
        if (!menuEl) return;
        
        // Stop menu loop first
        if (menuAnimationId) {
            cancelAnimationFrame(menuAnimationId);
            menuAnimationId = null;
        }
        
        // Hide menu and show game content
        menuEl.style.display = "none";
        if (gameContentEl) {
            gameContentEl.style.display = "flex";
        }
        
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                startGame();
            });
        });
    }
    
    function initMenuCanvas() {
        if (!menuCanvas || !menuCtx) return;
        
        // Get the window body dimensions (not the canvas parent)
        const windowBody = gameWindow?.querySelector('.window__body');
        if (!windowBody) return;
        
        // Force reflow
        windowBody.offsetHeight;
        
        // Get actual dimensions of the window body
        const rect = windowBody.getBoundingClientRect();
        const finalWidth = rect.width;
        const finalHeight = rect.height;
        
        // Set canvas size to match window body exactly
        if (finalWidth > 0 && finalHeight > 0) {
            menuCanvas.width = finalWidth;
            menuCanvas.height = finalHeight;
            menuCanvas.style.width = `${finalWidth}px`;
            menuCanvas.style.height = `${finalHeight}px`;
        }
    }
    
    function initMenuGame() {
        if (!menuCanvas) return;
        
        // Reset game state for menu background
        bullets = [];
        enemyBullets = [];
        enemyDirection = 1;
        const difficulty = getLevelDifficulty(1);
        enemySpeed = difficulty.speed;
        enemyShootChance = difficulty.shootChance;
        
        // Initialize enemies
        enemies = [];
        const startX = 50;
        const startY = 50;
        const spacing = 10;
        
        for (let row = 0; row < enemyRows; row++) {
            for (let col = 0; col < enemyCols; col++) {
                enemies.push({
                    x: startX + col * (enemyWidth + spacing),
                    y: startY + row * (enemyHeight + spacing),
                    width: enemyWidth,
                    height: enemyHeight,
                    alive: true,
                    color: row < 2 ? '#ef4444' : row < 4 ? '#f59e0b' : '#3b82f6'
                });
            }
        }
        
        // Set player position
        if (menuCanvas.width > 0 && menuCanvas.height > 0) {
            player.x = Math.max(0, Math.min(menuCanvas.width / 2 - player.width / 2, menuCanvas.width - player.width));
            player.y = menuCanvas.height - player.height - 20;
        }
    }
    
    function startMenuLoop() {
        let lastFrameTime = 0;
        const frameDelay = 100; // Slow down menu animation (update every 100ms)
        
        function menuLoop(timestamp) {
            if (gameState !== 'menu') {
                if (menuAnimationId) {
                    cancelAnimationFrame(menuAnimationId);
                    menuAnimationId = null;
                }
                return;
            }
            
            // Throttle updates to prevent excessive rendering
            if (timestamp - lastFrameTime >= frameDelay) {
                // Update enemies (muted - no input, but they move slowly)
                updateEnemiesForMenu();
                updateBulletsForMenu();
                
                // Draw on menu canvas
                drawMenu();
                
                lastFrameTime = timestamp;
            }
            
            menuAnimationId = requestAnimationFrame(menuLoop);
        }
        menuAnimationId = requestAnimationFrame(menuLoop);
    }
    
    function updateEnemiesForMenu() {
        if (!menuCanvas || enemies.length === 0) {
            // Reset enemies when all destroyed in menu
            initMenuGame();
            return;
        }
        
        // Use slower speed for menu background
        const menuSpeed = enemySpeed * 0.3; // Much slower
        
        let shouldDrop = false;
        let maxX = 0;
        let minX = menuCanvas.width;
        
        enemies.forEach(enemy => {
            if (enemy.alive) {
                maxX = Math.max(maxX, enemy.x + enemy.width);
                minX = Math.min(minX, enemy.x);
            }
        });
        
        if ((enemyDirection === 1 && maxX >= menuCanvas.width - 10) ||
            (enemyDirection === -1 && minX <= 10)) {
            shouldDrop = true;
            enemyDirection *= -1;
        }
        
        enemies.forEach(enemy => {
            if (enemy.alive) {
                enemy.x += menuSpeed * enemyDirection;
                if (shouldDrop) {
                    enemy.y += enemyDropDistance;
                }
            }
        });
        
        // Much less frequent shooting in menu
        if (Math.random() < enemyShootChance * 0.1 && enemies.some(e => e.alive)) {
            const aliveEnemies = enemies.filter(e => e.alive);
            if (aliveEnemies.length > 0) {
                const shooter = aliveEnemies[Math.floor(Math.random() * aliveEnemies.length)];
                enemyBullets.push({
                    x: shooter.x + shooter.width / 2 - 2,
                    y: shooter.y + shooter.height,
                    width: 4,
                    height: 10,
                    speed: 2, // Slower bullets in menu
                    color: '#f59e0b'
                });
            }
        }
    }
    
    function updateBulletsForMenu() {
        bullets = bullets.filter(bullet => {
            bullet.y -= bullet.speed;
            return bullet.y > 0;
        });
        
        enemyBullets = enemyBullets.filter(bullet => {
            bullet.y += bullet.speed;
            return bullet.y < menuCanvas.height;
        });
    }
    
    function drawMenu() {
        if (!menuCtx || !menuCanvas) return;
        
        // Clear canvas
        menuCtx.fillStyle = '#020617';
        menuCtx.fillRect(0, 0, menuCanvas.width, menuCanvas.height);
        
        // Draw player (centered, not moving)
        if (menuCanvas.width > 0 && menuCanvas.height > 0) {
            const playerX = Math.max(0, Math.min(menuCanvas.width / 2 - player.width / 2, menuCanvas.width - player.width));
            const playerY = menuCanvas.height - player.height - 20;
            
            menuCtx.fillStyle = player.color;
            menuCtx.fillRect(playerX, playerY, player.width, player.height);
            
            menuCtx.fillStyle = '#16a34a';
            menuCtx.fillRect(playerX + 5, playerY, player.width - 10, 5);
            menuCtx.fillRect(playerX + player.width / 2 - 5, playerY - 5, 10, 5);
        }
        
        // Draw enemies
        enemies.forEach(enemy => {
            if (enemy.alive) {
                menuCtx.fillStyle = enemy.color;
                menuCtx.fillRect(enemy.x, enemy.y, enemy.width, enemy.height);
                
                menuCtx.fillStyle = '#1e293b';
                menuCtx.fillRect(enemy.x + 5, enemy.y + 5, enemy.width - 10, 5);
                menuCtx.fillRect(enemy.x + 5, enemy.y + enemy.height - 10, enemy.width - 10, 5);
            }
        });
        
        // Draw bullets
        bullets.forEach(bullet => {
            menuCtx.fillStyle = bullet.color;
            menuCtx.fillRect(bullet.x, bullet.y, bullet.width, bullet.height);
        });
        
        enemyBullets.forEach(bullet => {
            menuCtx.fillStyle = bullet.color;
            menuCtx.fillRect(bullet.x, bullet.y, bullet.width, bullet.height);
        });
    }
    
    function measureCanvasContainer() {
        const container = canvas?.parentElement;
        if (!container) return null;

        container.offsetHeight;

        const rect = container.getBoundingClientRect();
        let width = container.clientWidth;
        let height = container.clientHeight;

        if (width <= 0) width = rect.width;
        if (height <= 0) height = rect.height;

        return {
            width: Math.floor(Math.max(1, width)),
            height: Math.floor(Math.max(1, height))
        };
    }

    function initCanvas() {
        if (!canvas) return false;

        const measured = measureCanvasContainer();
        if (!measured) {
            console.error('Canvas container not found');
            return false;
        }

        let finalWidth = measured.width;
        let finalHeight = measured.height;

        if (isMobile()) {
            finalWidth = Math.max(finalWidth, Math.floor(window.innerWidth * 0.94));
            finalHeight = Math.max(finalHeight, estimatePlayfieldHeight());
        }

        if (finalWidth < MIN_CANVAS_WIDTH || finalHeight < MIN_CANVAS_HEIGHT) {
            const body = gameWindow?.querySelector(".window__body");
            const bodyRect = body?.getBoundingClientRect();
            if (bodyRect) {
                finalWidth = Math.max(finalWidth, Math.floor(bodyRect.width * (isMobile() ? 0.96 : 0.9)));
                finalHeight = Math.max(
                    finalHeight,
                    isMobile() ? estimatePlayfieldHeight() : Math.floor(bodyRect.height * 0.55)
                );
            }
        }

        finalWidth = Math.max(MIN_CANVAS_WIDTH, finalWidth);
        finalHeight = Math.max(MIN_CANVAS_HEIGHT, finalHeight);

        if (finalWidth <= 0 || finalHeight <= 0) {
            console.error('Invalid canvas dimensions:', finalWidth, finalHeight);
            return false;
        }

        canvas.width = finalWidth;
        canvas.height = finalHeight;
        canvas.style.width = `${finalWidth}px`;
        canvas.style.height = `${finalHeight}px`;
        canvas.style.maxWidth = "100%";
        canvas.style.maxHeight = "100%";
        return true;
    }

    function ensureCanvasReady(attempt, onReady) {
        if (initCanvas()) {
            onReady?.();
            return;
        }

        if (attempt >= MAX_CANVAS_INIT_RETRIES) {
            const fallbackWidth = Math.max(
                MIN_CANVAS_WIDTH,
                Math.floor(window.innerWidth * (isMobile() ? 0.94 : 0.88))
            );
            const fallbackHeight = Math.max(
                MIN_CANVAS_HEIGHT,
                isMobile()
                    ? estimatePlayfieldHeight()
                    : Math.floor((window.innerHeight - getTaskbarHeightEstimate()) * 0.55)
            );
            canvas.width = fallbackWidth;
            canvas.height = fallbackHeight;
            canvas.style.width = `${fallbackWidth}px`;
            canvas.style.height = `${fallbackHeight}px`;
            onReady?.();
            return;
        }

        requestAnimationFrame(() => ensureCanvasReady(attempt + 1, onReady));
    }

    function getTaskbarHeightEstimate() {
        const taskbar = document.querySelector(".taskbar");
        if (!taskbar) return 46;
        return Math.max(46, Math.round(taskbar.getBoundingClientRect().height));
    }
    
    function getLayoutMetrics() {
        return {
            topPadding: isMobile() ? 8 : 12,
            sidePadding: isMobile() ? 12 : 24,
            bottomMargin: isMobile() ? 4 : 8,
            spacing: isMobile() ? 6 : 10
        };
    }

    function estimatePlayfieldHeight() {
        const taskbar = getTaskbarHeightEstimate();
        const viewportHeight = Math.max(window.innerHeight, document.documentElement.clientHeight || 0);
        const titlebar = gameWindow?.querySelector(".window__titlebar")?.getBoundingClientRect().height ?? 40;
        const header = gameContentEl?.querySelector(".invaders__header")?.getBoundingClientRect().height ?? 48;
        const info = infoEl?.getBoundingClientRect().height ?? 44;
        const controls = (isMobile() && mobileControlsEl)
            ? mobileControlsEl.getBoundingClientRect().height
            : 0;
        const bodyPadding = isMobile() ? 16 : 40;
        const containerPadding = isMobile() ? 8 : 20;

        return Math.max(
            MIN_CANVAS_HEIGHT,
            Math.floor(viewportHeight - taskbar - titlebar - header - info - controls - bodyPadding - containerPadding)
        );
    }

    function updateEnemyDropDistance(rows, startY, spacing) {
        if (!canvas || rows < 1) {
            enemyDropDistance = 20;
            return;
        }

        const { bottomMargin } = getLayoutMetrics();
        const playerY = canvas.height - player.height - bottomMargin;
        const lastEnemyBottom = startY + (rows - 1) * (enemyHeight + spacing) + enemyHeight;
        const runway = Math.max(0, playerY - lastEnemyBottom);

        enemyDropDistance = calculateEnemyDropDistance(runway);
    }

    function refreshEnemyDropDistanceFromState() {
        if (!canvas || enemies.length === 0) return;

        const aliveEnemies = enemies.filter((enemy) => enemy.alive);
        if (aliveEnemies.length === 0) return;

        const lowestEnemyBottom = aliveEnemies.reduce(
            (lowest, enemy) => Math.max(lowest, enemy.y + enemy.height),
            0
        );
        const { bottomMargin } = getLayoutMetrics();
        const playerY = canvas.height - player.height - bottomMargin;
        const runway = Math.max(0, playerY - lowestEnemyBottom);

        enemyDropDistance = calculateEnemyDropDistance(runway);
    }

    function getFormationLayout() {
        const { topPadding, sidePadding, bottomMargin, spacing } = getLayoutMetrics();
        const minGapAbovePlayer = isMobile() ? 32 : 48;
        const playerY = canvas.height - player.height - bottomMargin;
        const maxEnemyBottom = playerY - minGapAbovePlayer;
        const availableWidth = Math.max(160, canvas.width - sidePadding * 2);
        const availableHeight = Math.max(40, maxEnemyBottom - topPadding);
        const rowStride = enemyHeight + spacing;

        const cols = Math.min(
            enemyCols,
            Math.max(4, Math.floor((availableWidth + spacing) / (enemyWidth + spacing)))
        );
        const rows = Math.min(
            enemyRows,
            Math.max(1, Math.floor((availableHeight + spacing) / rowStride))
        );
        const formationWidth = cols * enemyWidth + (cols - 1) * spacing;
        const startX = Math.max(8, (canvas.width - formationWidth) / 2);
        const startY = topPadding;

        return { cols, rows, spacing, startX, startY };
    }

    function initEnemies() {
        enemies = [];
        const { cols, rows, spacing, startX, startY } = getFormationLayout();
        
        const difficulty = getLevelDifficulty(currentLevel);
        enemySpeed = difficulty.speed;
        enemyShootChance = difficulty.shootChance;
        shotCooldown = difficulty.shotCooldown;
        updateEnemyDropDistance(rows, startY, spacing);
        
        for (let row = 0; row < rows; row++) {
            for (let col = 0; col < cols; col++) {
                enemies.push({
                    x: startX + col * (enemyWidth + spacing),
                    y: startY + row * (enemyHeight + spacing),
                    width: enemyWidth,
                    height: enemyHeight,
                    alive: true,
                    color: row < 2 ? '#ef4444' : row < 4 ? '#f59e0b' : '#3b82f6',
                    row: row
                });
            }
        }
    }
    
    function startGame() {
        if (!canvas || !ctx) {
            console.error('Canvas or context not available');
            return;
        }
        
        // Stop any existing animations
        if (animationId) {
            cancelAnimationFrame(animationId);
            animationId = null;
        }
        if (menuAnimationId) {
            cancelAnimationFrame(menuAnimationId);
            menuAnimationId = null;
        }
        
        // Reset game state
        bullets = [];
        enemyBullets = [];
        score = 0;
        lives = 3;
        currentLevel = 1;
        gameState = 'playing';
        enemyDirection = 1;
        lastShot = 0;
        
        // Ensure game content is visible
        if (gameContentEl) {
            gameContentEl.style.display = "flex";
        }
        if (menuEl) {
            menuEl.style.display = "none";
        }
        
        requestAnimationFrame(() => {
            ensureCanvasReady(0, launchPlayingState);
        });
    }
    
    function setupPlayer() {
        if (canvas && canvas.width > 0 && canvas.height > 0) {
            const { bottomMargin } = getLayoutMetrics();
            player.x = Math.max(0, Math.min(canvas.width / 2 - player.width / 2, canvas.width - player.width));
            player.y = Math.max(0, canvas.height - player.height - bottomMargin);
        }
    }
    
    function verifyGameSetup() {
        if (!canvas || canvas.width <= 0 || canvas.height <= 0) return false;
        if (player.y <= 0) return false;
        if (enemies.length === 0) return false;

        const minSafeDistance = isMobile() ? 28 : 40;
        for (const enemy of enemies) {
            if (enemy.alive && enemy.y + enemy.height >= player.y - minSafeDistance) {
                return false;
            }
        }

        return true;
    }

    function launchPlayingState() {
        setupPlayer();
        initEnemies();

        if (!verifyGameSetup()) {
            console.warn("Invaders layout still tight; continuing with current formation.");
        }

        updateUI();
        draw();
        gameLoop();
    }
    
    function nextLevel() {
        currentLevel++;
        
        if (currentLevel > maxLevel) {
            // Game completed!
            gameState = 'gameOver';
            if (infoEl) {
                infoEl.innerHTML = `<div class="invaders__info-main invaders__info-main--success">Congratulations!</div>
                                    <div class="invaders__info-sub">You completed all ${maxLevel} levels!</div>`;
            }
            checkAndShowHighScore();
            return;
        }
        
        // Show level transition
        if (infoEl) {
            infoEl.innerHTML = `<div class="invaders__info-main">Level ${currentLevel}</div>
                                <div class="invaders__info-sub">Get ready!</div>`;
        }
        
        // Reset for next level
        bullets = [];
        enemyBullets = [];
        enemyDirection = 1;
        lastShot = 0;
        
        // Add level bonus
        const levelBonus = currentLevel * 100;
        score += levelBonus;
        
        setTimeout(() => {
            initEnemies();
            updateUI();
            
            if (canvas.width > 0 && canvas.height > 0) {
                const { bottomMargin } = getLayoutMetrics();
                player.x = Math.max(0, Math.min(canvas.width / 2 - player.width / 2, canvas.width - player.width));
                player.y = canvas.height - player.height - bottomMargin;
            }
            
            gameState = 'playing';
            if (infoEl) {
                const controlHint = isMobile() ? "Use buttons below" : "Arrow keys/A/D to move, Space to shoot";
                infoEl.innerHTML = `<div class="invaders__info-main">${controlHint}</div>
                                    <div class="invaders__info-sub">Destroy all invaders!</div>`;
            }
        }, 2000);
    }
    
    function updateUI() {
        if (scoreEl) scoreEl.textContent = score;
        if (livesEl) livesEl.textContent = lives;
        if (levelEl) levelEl.textContent = currentLevel;
        
        if (gameState === 'gameOver') {
            if (infoEl) {
                const controlHint = isMobile() ? "Tap Reset to play again" : "Press Reset to play again";
                infoEl.innerHTML = `<div class="invaders__info-main invaders__info-main--danger">Game Over!</div>
                                    <div class="invaders__info-sub">${controlHint}</div>`;
            }
        } else if (gameState === 'playing' && enemies.length === 0) {
            // Level complete
            nextLevel();
        } else if (gameState === 'playing') {
            if (infoEl) {
                const controlHint = isMobile() ? "Use buttons below" : "Arrow keys/A/D to move, Space to shoot";
                infoEl.innerHTML = `<div class="invaders__info-main">${controlHint}</div>
                                    <div class="invaders__info-sub">Destroy all invaders!</div>`;
            }
        }
    }
    
    function handleInput() {
        if (gameState !== 'playing') return;
        
        if (keys['ArrowLeft'] || keys['a'] || keys['A']) {
            player.x = Math.max(0, player.x - player.speed);
        }
        if (keys['ArrowRight'] || keys['d'] || keys['D']) {
            player.x = Math.min(canvas.width - player.width, player.x + player.speed);
        }
        
        if (keys[' '] || keys['Space']) {
            const now = Date.now();
            if (now - lastShot > shotCooldown) {
                shoot();
                lastShot = now;
            }
        }
    }
    
    function shoot() {
        bullets.push({
            x: player.x + player.width / 2 - 2,
            y: player.y,
            width: 4,
            height: 10,
            speed: 7,
            color: '#60a5fa'
        });
    }
    
    function updateEnemies() {
        if (enemies.length === 0) return;
        
        let shouldDrop = false;
        let maxX = 0;
        let minX = canvas.width;
        
        enemies.forEach(enemy => {
            if (enemy.alive) {
                maxX = Math.max(maxX, enemy.x + enemy.width);
                minX = Math.min(minX, enemy.x);
            }
        });
        
        if ((enemyDirection === 1 && maxX >= canvas.width - 10) ||
            (enemyDirection === -1 && minX <= 10)) {
            shouldDrop = true;
            enemyDirection *= -1;
        }
        
        enemies.forEach(enemy => {
            if (enemy.alive) {
                enemy.x += enemySpeed * enemyDirection;
                if (shouldDrop) {
                    enemy.y += enemyDropDistance;
                }
            }
        });
        
        if (Math.random() < enemyShootChance && enemies.some(e => e.alive)) {
            const aliveEnemies = enemies.filter(e => e.alive);
            if (aliveEnemies.length > 0) {
                const shooter = aliveEnemies[Math.floor(Math.random() * aliveEnemies.length)];
                enemyBullets.push({
                    x: shooter.x + shooter.width / 2 - 2,
                    y: shooter.y + shooter.height,
                    width: 4,
                    height: 10,
                    speed: 4,
                    color: '#f59e0b'
                });
            }
        }
        
        // Check if enemies reached player (skip during resize to prevent false game over)
        // Only check if canvas and player are properly initialized
        if ((typeof isResizing === 'undefined' || !isResizing) && canvas && canvas.width > 0 && canvas.height > 0 && player.y > 0) {
            enemies.forEach(enemy => {
                if (enemy.alive && enemy.y + enemy.height >= player.y) {
                    gameOver();
                    return; // Exit early once game over is triggered
                }
            });
        }
    }
    
    function updateBullets() {
        bullets = bullets.filter(bullet => {
            bullet.y -= bullet.speed;
            
            for (let enemy of enemies) {
                if (enemy.alive &&
                    bullet.x < enemy.x + enemy.width &&
                    bullet.x + bullet.width > enemy.x &&
                    bullet.y < enemy.y + enemy.height &&
                    bullet.y + bullet.height > enemy.y) {
                    enemy.alive = false;
                    const points = calculateScore(enemy);
                    score += points;
                    enemies = enemies.filter(e => e !== enemy);
                    updateUI();
                    return false;
                }
            }
            
            return bullet.y > 0;
        });
        
        enemyBullets = enemyBullets.filter(bullet => {
            bullet.y += bullet.speed;
            
            if (bullet.x < player.x + player.width &&
                bullet.x + bullet.width > player.x &&
                bullet.y < player.y + player.height &&
                bullet.y + bullet.height > player.y) {
                lives--;
                updateUI();
                if (lives <= 0) {
                    gameOver();
                }
                return false;
            }
            
            return bullet.y < canvas.height;
        });
    }
    
    function gameOver() {
        gameState = 'gameOver';
        updateUI();
        checkAndShowHighScore();
    }
    
    async function checkAndShowHighScore() {
        await loadHighScores();
        if (checkHighScore(score)) {
            showNameEntry();
        }
    }
    
    function showNameEntry() {
        if (!nameEntryEl) return;
        
        gameState = 'nameEntry';
        nameEntryIndex = 0;
        if (nameScoreEl) nameScoreEl.textContent = score;
        
        // Clear inputs
        if (nameInputs && nameInputs.length >= 3) {
            nameInputs[0].value = '';
            nameInputs[1].value = '';
            nameInputs[2].value = '';
            nameInputs[0].focus();
        }
        
        nameEntryEl.style.display = "flex";
    }
    
    function hideNameEntry() {
        if (!nameEntryEl) return;
        nameEntryEl.style.display = "none";
    }
    
    async function submitName() {
        if (!nameInputs || nameInputs.length < 3) return;
        
        const name = (nameInputs[0].value || 'A') + 
                     (nameInputs[1].value || 'A') + 
                     (nameInputs[2].value || 'A');
        
        if (name.length === 3) {
            if (nameSubmitBtn) {
                nameSubmitBtn.disabled = true;
            }
            await saveHighScore(name, score, currentLevel);
            hideNameEntry();
            await updateHighScoreList();
            if (nameSubmitBtn) {
                nameSubmitBtn.disabled = false;
            }
        }
    }
    
    async function showHighScores() {
        if (!hiscoreModal) return;
        
        gameState = 'highScores';
        await updateHighScoreList();
        hiscoreModal.style.display = "flex";
    }
    
    function hideHighScores() {
        if (!hiscoreModal) return;
        hiscoreModal.style.display = "none";
        if (gameState === 'highScores') {
            gameState = 'menu';
        }
    }
    
    async function updateHighScoreList() {
        if (!hiscoreList) return;
        
        await loadHighScores();
        
        if (highScores.length === 0) {
            hiscoreList.innerHTML = '<div class="invaders__hiscore-empty">No high scores yet!</div>';
            return;
        }
        
        let html = '<div class="invaders__hiscore-header"><span>RANK</span><span>NAME</span><span>SCORE</span><span>LEVEL</span></div>';
        highScores.forEach((entry, index) => {
            html += `<div class="invaders__hiscore-item">
                        <span>${index + 1}</span>
                        <span>${entry.name}</span>
                        <span>${entry.score}</span>
                        <span>${entry.level}</span>
                     </div>`;
        });
        
        hiscoreList.innerHTML = html;
    }
    
    function draw() {
        if (!ctx || !canvas) return;
        
        // Clear canvas
        ctx.fillStyle = '#020617';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        if (gameState !== 'playing' && gameState !== 'paused') {
            // Still draw background even if not playing
            return;
        }
        
        ctx.fillStyle = player.color;
        ctx.fillRect(player.x, player.y, player.width, player.height);
        
        ctx.fillStyle = '#16a34a';
        ctx.fillRect(player.x + 5, player.y, player.width - 10, 5);
        ctx.fillRect(player.x + player.width / 2 - 5, player.y - 5, 10, 5);
        
        enemies.forEach(enemy => {
            if (enemy.alive) {
                ctx.fillStyle = enemy.color;
                ctx.fillRect(enemy.x, enemy.y, enemy.width, enemy.height);
                
                ctx.fillStyle = '#1e293b';
                ctx.fillRect(enemy.x + 5, enemy.y + 5, enemy.width - 10, 5);
                ctx.fillRect(enemy.x + 5, enemy.y + enemy.height - 10, enemy.width - 10, 5);
            }
        });
        
        bullets.forEach(bullet => {
            ctx.fillStyle = bullet.color;
            ctx.fillRect(bullet.x, bullet.y, bullet.width, bullet.height);
        });
        
        enemyBullets.forEach(bullet => {
            ctx.fillStyle = bullet.color;
            ctx.fillRect(bullet.x, bullet.y, bullet.width, bullet.height);
        });
    }
    
    function gameLoop() {
        try {
            if (gameState === 'playing') {
                handleInput();
                updateEnemies();
                updateBullets();
            }
            
            draw();
            
            if (gameState === 'playing' || (gameState === 'gameOver' && enemies.length === 0)) {
                animationId = requestAnimationFrame(gameLoop);
            }
        } catch (error) {
            console.error('Error in game loop:', error);
            // Continue loop even on error to prevent game from freezing
            if (gameState === 'playing' || gameState === 'gameOver') {
                animationId = requestAnimationFrame(gameLoop);
            }
        }
    }
    
    function reset() {
        // Stop all animations
        if (animationId) {
            cancelAnimationFrame(animationId);
            animationId = null;
        }
        if (menuAnimationId) {
            cancelAnimationFrame(menuAnimationId);
            menuAnimationId = null;
        }
        
        // Hide modals if open
        if (hiscoreModal) {
            hiscoreModal.style.display = "none";
        }
        if (nameEntryEl) {
            nameEntryEl.style.display = "none";
        }
        
        // Reset game state
        bullets = [];
        enemyBullets = [];
        score = 0;
        lives = 3;
        currentLevel = 1;
        gameState = 'menu';
        
        // Hide game content and show menu
        if (gameContentEl) {
            gameContentEl.style.display = "none";
        }
        if (menuEl) {
            menuEl.style.display = "flex";
        }
        
        // Reinitialize menu game background
        setTimeout(() => {
            if (menuCanvas && menuCtx && gameState === 'menu') {
                initMenuCanvas();
                initMenuGame();
                startMenuLoop();
            }
        }, 100);
    }
    
    function handleWindowOpen() {
        if (!gameWindow) {
            gameWindow = document.getElementById("window-invaders");
        }
        if (!gameWindow || gameWindow.classList.contains("window--hidden")) return;

        if (window.DesktopApp && typeof window.DesktopApp.fitGameWindow === "function") {
            window.DesktopApp.fitGameWindow(gameWindow);
        }

        updateMobileControlsVisibility();

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                showLoadingAnimation();
            });
        });
    }
    
    window.SpaceInvadersApp = window.SpaceInvadersApp || {};
    window.SpaceInvadersApp.handleWindowOpen = handleWindowOpen;
    
    function init() {
        canvas = document.getElementById("invaders-canvas");
        menuCanvas = document.getElementById("invaders-menu-canvas");
        if (!canvas || !menuCanvas) return;
        
        ctx = canvas.getContext("2d");
        menuCtx = menuCanvas.getContext("2d");
        scoreEl = document.getElementById("invaders-score");
        livesEl = document.getElementById("invaders-lives");
        levelEl = document.getElementById("invaders-level");
        infoEl = document.getElementById("invaders-info");
        resetBtn = document.getElementById("invaders-reset");
        loadingEl = document.getElementById("invaders-loading");
        gameContentEl = document.getElementById("invaders-game-content");
        menuEl = document.getElementById("invaders-menu");
        mobileControlsEl = document.getElementById("invaders-mobile-controls");
        gameWindow = document.getElementById("window-invaders");
        
        startBtn = document.getElementById("invaders-start-btn");
        hiscoreBtn = document.getElementById("invaders-hiscore-btn");
        hiscoreModal = document.getElementById("invaders-hiscore-modal");
        hiscoreList = document.getElementById("invaders-hiscore-list");
        hiscoreClose = document.getElementById("invaders-hiscore-close");
        
        nameEntryEl = document.getElementById("invaders-name-entry");
        nameInputs = [
            document.getElementById("invaders-name-1"),
            document.getElementById("invaders-name-2"),
            document.getElementById("invaders-name-3")
        ];
        nameSubmitBtn = document.getElementById("invaders-name-submit");
        nameScoreEl = document.getElementById("invaders-name-score");
        
        loadHighScores();
        
        if (loadingEl) {
            loadingEl.style.display = "flex";
        }
        if (menuEl) {
            menuEl.style.display = "none";
        }
        if (gameContentEl) {
            gameContentEl.style.display = "none";
        }
        
        updateMobileControlsVisibility();
        
        // Menu buttons
        if (startBtn) {
            startBtn.addEventListener("click", () => {
                hideMenu();
            });
        }
        
        if (hiscoreBtn) {
            hiscoreBtn.addEventListener("click", async () => {
                await showHighScores();
            });
        }
        
        if (hiscoreClose) {
            hiscoreClose.addEventListener("click", () => {
                hideHighScores();
            });
        }
        
        // Name entry
        if (nameInputs && nameInputs.length >= 3) {
            nameInputs.forEach((input, index) => {
                input.addEventListener("input", (e) => {
                    const value = e.target.value.toUpperCase().replace(/[^A-Z]/g, '');
                    e.target.value = value;
                    
                    if (value && index < 2) {
                        nameInputs[index + 1].focus();
                    }
                });
                
                input.addEventListener("keydown", (e) => {
                    if (e.key === "Backspace" && !e.target.value && index > 0) {
                        nameInputs[index - 1].focus();
                    } else if (e.key === "Enter") {
                        submitName();
                    }
                });
            });
        }
        
        if (nameSubmitBtn) {
            nameSubmitBtn.addEventListener("click", async () => {
                await submitName();
            });
        }
        
        if (gameWindow) {
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        const isHidden = gameWindow.classList.contains("window--hidden");
                        if (!isHidden) {
                            handleWindowOpen();
                        }
                    }
                });
            });
            
            observer.observe(gameWindow, { attributes: true, attributeFilter: ['class'] });
            
            if (!gameWindow.classList.contains("window--hidden")) {
                handleWindowOpen();
            }
        }
        
        document.addEventListener("keydown", e => {
            if (gameWindow && gameWindow.classList.contains("window--hidden")) return;
            if (gameState === 'nameEntry') {
                // Handle name entry keys
                return;
            }
            keys[e.key] = true;
            if (gameState === 'playing') {
                e.preventDefault();
            }
        });
        
        document.addEventListener("keyup", e => {
            keys[e.key] = false;
        });
        
        if (mobileControlsEl) {
            mobileControlsEl.querySelectorAll(".invaders__control-btn").forEach(btn => {
                const action = btn.dataset.action;
                if (!action) return;

                const press = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    if (btn.dataset.pressed === "1") return;
                    ensureGameplayStarted();
                    btn.dataset.pressed = "1";
                    setMobileActionState(action, true);
                    runMobileAction(action);
                    clearMobileHoldTimer(action);
                    const repeatDelay = action === "shoot" ? 140 : 45;
                    mobileHoldTimers[action] = setInterval(() => {
                        runMobileAction(action);
                    }, repeatDelay);
                };
                const release = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    btn.dataset.pressed = "0";
                    setMobileActionState(action, false);
                    clearMobileHoldTimer(action);
                };

                btn.addEventListener("touchstart", press, { passive: false });
                btn.addEventListener("touchend", release, { passive: false });
                btn.addEventListener("touchcancel", release, { passive: false });
                btn.addEventListener("pointerdown", press);
                btn.addEventListener("pointerup", release);
                btn.addEventListener("pointercancel", release);
                btn.addEventListener("mousedown", press);
                btn.addEventListener("mouseup", release);
                btn.addEventListener("mouseleave", release);
                btn.addEventListener("click", (e) => {
                    e.preventDefault();
                    ensureGameplayStarted();
                    if (action === "shoot") {
                        runMobileAction(action);
                    }
                });
            });
        }

        document.addEventListener("touchend", () => {
            clearAllMobileInputs();
            if (mobileControlsEl) {
                mobileControlsEl.querySelectorAll(".invaders__control-btn").forEach((btn) => {
                    btn.dataset.pressed = "0";
                });
            }
        }, { passive: true });

        document.addEventListener("pointerup", clearAllMobileInputs);
        document.addEventListener("visibilitychange", () => {
            if (document.hidden) {
                clearAllMobileInputs();
            }
        });
        window.addEventListener("blur", clearAllMobileInputs);

        if (canvas) {
            const wakeUpGame = () => {
                ensureGameplayStarted();
            };
            canvas.addEventListener("touchstart", wakeUpGame, { passive: true });
            canvas.addEventListener("pointerdown", wakeUpGame);
            canvas.addEventListener("mousedown", wakeUpGame);
        }
        
        if (resetBtn) {
            resetBtn.addEventListener("click", reset);
        }
        
        let resizeTimeout;
        const handleResize = () => {
            if (gameWindow?.classList.contains("window--hidden")) return;
            updateMobileControlsVisibility();
            clearTimeout(resizeTimeout);
            isResizing = true;
            resizeTimeout = setTimeout(() => {
                if (gameState === 'menu' && menuCanvas) {
                    // Resize menu canvas
                    initMenuCanvas();
                    // Reset menu game if needed
                    if (enemies.length === 0) {
                        initMenuGame();
                    }
                } else if (gameState === 'playing' || gameState === 'paused' || gameState === 'gameOver') {
                    if (!canvas) return;
                    const oldWidth = canvas.width;
                    const oldHeight = canvas.height;
                    
                    initCanvas();
                    
                    if (canvas.width !== oldWidth || canvas.height !== oldHeight) {
                        const { bottomMargin } = getLayoutMetrics();
                        player.x = Math.min(canvas.width - player.width, Math.max(0, player.x));
                        player.y = Math.min(canvas.height - player.height - bottomMargin, Math.max(0, player.y));
                        
                        if (oldWidth > 0 && oldHeight > 0) {
                            const scaleX = canvas.width / oldWidth;
                            const scaleY = canvas.height / oldHeight;
                            
                            enemies.forEach(enemy => {
                                if (enemy.alive) {
                                    enemy.x = Math.min(enemy.x * scaleX, canvas.width - enemy.width);
                                    enemy.y = Math.min(enemy.y * scaleY, canvas.height - enemy.height);
                                }
                            });
                            
                            bullets = bullets.filter(bullet => 
                                bullet.x >= 0 && bullet.x < canvas.width && 
                                bullet.y >= 0 && bullet.y < canvas.height
                            );
                            enemyBullets = enemyBullets.filter(bullet => 
                                bullet.x >= 0 && bullet.x < canvas.width && 
                                bullet.y >= 0 && bullet.y < canvas.height
                            );
                        }

                        refreshEnemyDropDistanceFromState();
                    }
                }
                isResizing = false;
            }, 150);
        };
        
        window.addEventListener("resize", handleResize);
        
        if (gameWindow) {
            const resizeObserver = new ResizeObserver(() => {
                handleResize();
            });
            resizeObserver.observe(gameWindow);
            
            // Observe window body for menu canvas sizing
            const windowBody = gameWindow.querySelector('.window__body');
            if (windowBody) {
                resizeObserver.observe(windowBody);
            }
            
            if (canvas && canvas.parentElement) {
                resizeObserver.observe(canvas.parentElement);
            }
        }
    }
    
    return { init };
})();
