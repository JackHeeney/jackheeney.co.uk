/* ------------------------------ Space Invaders ------------------------------ */

const SpaceInvaders = (() => {
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
    let nameEntryIndex = 0;
    
    function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
            (window.innerWidth <= 768);
    }
    
    function loadHighScores() {
        try {
            const stored = localStorage.getItem('spaceInvadersHighScores');
            if (stored) {
                highScores = JSON.parse(stored);
            } else {
                highScores = [];
            }
            // Sort by score descending
            highScores.sort((a, b) => b.score - a.score);
        } catch (e) {
            highScores = [];
        }
    }
    
    function saveHighScore(name, score, level) {
        highScores.push({ name: name.toUpperCase(), score, level, date: new Date().toISOString() });
        highScores.sort((a, b) => b.score - a.score);
        highScores = highScores.slice(0, 10); // Keep top 10
        try {
            localStorage.setItem('spaceInvadersHighScores', JSON.stringify(highScores));
        } catch (e) {
            console.error('Failed to save high score:', e);
        }
    }
    
    function checkHighScore(score) {
        if (highScores.length < 10) return true;
        return score > highScores[highScores.length - 1].score;
    }
    
    function calculateScore(enemy) {
        // Find which row the enemy is in
        const startY = 50;
        const spacing = 10;
        const rowHeight = enemyHeight + spacing;
        const row = Math.floor((enemy.y - startY) / rowHeight);
        
        // Top 2 rows (red): 30 points
        if (row < 2) return 30;
        // Middle 2 rows (orange): 20 points
        if (row < 4) return 20;
        // Bottom row (blue): 10 points
        return 10;
    }
    
    function getLevelDifficulty(level) {
        return {
            speed: 0.5 + (level - 1) * 0.2,
            shootChance: 0.002 + (level - 1) * 0.001,
            shotCooldown: Math.max(100, 300 - (level - 1) * 10)
        };
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
        
        // Start actual game after a brief delay to ensure DOM updates
        setTimeout(() => {
            startGame();
        }, 150);
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
    
    function initCanvas() {
        if (!canvas) return;
        
        const container = canvas.parentElement;
        if (!container) {
            console.error('Canvas container not found');
            return;
        }
        
        // Force reflow to ensure dimensions are calculated
        container.offsetHeight;
        
        // Get container dimensions
        const rect = container.getBoundingClientRect();
        const computedStyle = window.getComputedStyle(container);
        const paddingX = parseFloat(computedStyle.paddingLeft) + parseFloat(computedStyle.paddingRight) || 0;
        const paddingY = parseFloat(computedStyle.paddingTop) + parseFloat(computedStyle.paddingBottom) || 0;
        
        // Calculate available space INSIDE the padding (clientWidth/Height already excludes padding)
        // clientWidth/clientHeight already account for padding, so use them directly
        let availableWidth = container.clientWidth;
        let availableHeight = container.clientHeight;
        
        // Fallback if clientWidth/Height are 0 or invalid
        if (availableWidth <= 0) {
            availableWidth = Math.max(rect.width - paddingX, 300);
        }
        if (availableHeight <= 0) {
            availableHeight = Math.max(rect.height - paddingY, 200);
        }
        
        // Ensure minimum dimensions
        const finalWidth = Math.max(availableWidth, 300);
        const finalHeight = Math.max(availableHeight, 200);
        
        if (finalWidth > 0 && finalHeight > 0) {
            // Set canvas internal resolution (this is the drawing area)
            canvas.width = finalWidth;
            canvas.height = finalHeight;
            
            // Set CSS size to match exactly (ensures it fits within container padding)
            // The container is now properly sized by flexbox, so use calculated dimensions
            canvas.style.width = `${finalWidth}px`;
            canvas.style.height = `${finalHeight}px`;
            canvas.style.maxWidth = '100%';
            canvas.style.maxHeight = '100%';
        } else {
            console.error('Invalid canvas dimensions:', finalWidth, finalHeight);
        }
    }
    
    function initEnemies() {
        enemies = [];
        const startX = 50;
        const startY = 50;
        const spacing = 10;
        
        const difficulty = getLevelDifficulty(currentLevel);
        enemySpeed = difficulty.speed;
        enemyShootChance = difficulty.shootChance;
        shotCooldown = difficulty.shotCooldown;
        
        for (let row = 0; row < enemyRows; row++) {
            for (let col = 0; col < enemyCols; col++) {
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
        
        // Initialize canvas - wait a bit for DOM to update
        setTimeout(() => {
            initCanvas();
            
            // Double-check canvas has valid dimensions
            if (canvas.width <= 0 || canvas.height <= 0) {
                console.error('Canvas dimensions invalid:', canvas.width, canvas.height);
                // Try again with a delay
                setTimeout(() => {
                    initCanvas();
                    if (canvas.width > 0 && canvas.height > 0) {
                        initEnemies();
                        setupPlayer();
                        // Verify player and enemies don't overlap before starting
                        if (verifyGameSetup()) {
                            updateUI();
                            gameLoop();
                        }
                    }
                }, 200);
                return;
            }
            
            initEnemies();
            setupPlayer();
            
            // Verify game setup is valid before starting
            if (verifyGameSetup()) {
                updateUI();
                gameLoop();
            } else {
                console.error('Game setup invalid - enemies and player overlapping');
                // Retry initialization
                setTimeout(() => {
                    initCanvas();
                    initEnemies();
                    setupPlayer();
                    if (verifyGameSetup()) {
                        updateUI();
                        gameLoop();
                    }
                }, 100);
            }
        }, 100);
    }
    
    function setupPlayer() {
        if (canvas && canvas.width > 0 && canvas.height > 0) {
            // Position player near bottom but ensure it's visible within canvas bounds
            const bottomMargin = 20;
            player.x = Math.max(0, Math.min(canvas.width / 2 - player.width / 2, canvas.width - player.width));
            player.y = Math.max(0, canvas.height - player.height - bottomMargin);
            
            // Ensure player is always visible and well above the bottom
            if (player.y + player.height > canvas.height - 10) {
                player.y = canvas.height - player.height - 10;
            }
        }
    }
    
    function verifyGameSetup() {
        if (!canvas || canvas.width <= 0 || canvas.height <= 0) return false;
        if (player.y <= 0) return false;
        if (enemies.length === 0) return false;
        
        // Check that no enemies are overlapping with player position
        // Enemies should be well above the player
        const minSafeDistance = 50; // Minimum safe distance between enemies and player
        for (let enemy of enemies) {
            if (enemy.alive && enemy.y + enemy.height >= player.y - minSafeDistance) {
                // Enemy too close to player - this shouldn't happen at game start
                console.warn('Enemy too close to player at start:', enemy.y, player.y);
                return false;
            }
        }
        
        return true;
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
                player.x = Math.max(0, Math.min(canvas.width / 2 - player.width / 2, canvas.width - player.width));
                player.y = canvas.height - player.height - 20;
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
    
    function checkAndShowHighScore() {
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
    
    function submitName() {
        if (!nameInputs || nameInputs.length < 3) return;
        
        const name = (nameInputs[0].value || 'A') + 
                     (nameInputs[1].value || 'A') + 
                     (nameInputs[2].value || 'A');
        
        if (name.length === 3) {
            saveHighScore(name, score, currentLevel);
            hideNameEntry();
            updateHighScoreList();
        }
    }
    
    function showHighScores() {
        if (!hiscoreModal) return;
        
        gameState = 'highScores';
        updateHighScoreList();
        hiscoreModal.style.display = "flex";
    }
    
    function hideHighScores() {
        if (!hiscoreModal) return;
        hiscoreModal.style.display = "none";
        if (gameState === 'highScores') {
            gameState = 'menu';
        }
    }
    
    function updateHighScoreList() {
        if (!hiscoreList) return;
        
        loadHighScores();
        
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
        
        setTimeout(() => {
            showLoadingAnimation();
        }, 120);
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
        
        if (mobileControlsEl) {
            if (isMobile()) {
                mobileControlsEl.style.display = "flex";
            } else {
                mobileControlsEl.style.display = "none";
            }
        }
        
        // Menu buttons
        if (startBtn) {
            startBtn.addEventListener("click", () => {
                hideMenu();
            });
        }
        
        if (hiscoreBtn) {
            hiscoreBtn.addEventListener("click", () => {
                showHighScores();
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
            nameSubmitBtn.addEventListener("click", submitName);
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
                btn.addEventListener("touchstart", (e) => {
                    e.preventDefault();
                    const action = btn.dataset.action;
                    if (action === 'left') {
                        keys['ArrowLeft'] = true;
                    } else if (action === 'right') {
                        keys['ArrowRight'] = true;
                    } else if (action === 'shoot') {
                        keys[' '] = true;
                    }
                });
                
                btn.addEventListener("touchend", (e) => {
                    e.preventDefault();
                    const action = btn.dataset.action;
                    if (action === 'left') {
                        keys['ArrowLeft'] = false;
                    } else if (action === 'right') {
                        keys['ArrowRight'] = false;
                    } else if (action === 'shoot') {
                        keys[' '] = false;
                    }
                });
                
                btn.addEventListener("mousedown", (e) => {
                    e.preventDefault();
                    const action = btn.dataset.action;
                    if (action === 'left') {
                        keys['ArrowLeft'] = true;
                    } else if (action === 'right') {
                        keys['ArrowRight'] = true;
                    } else if (action === 'shoot') {
                        keys[' '] = true;
                    }
                });
                
                btn.addEventListener("mouseup", (e) => {
                    e.preventDefault();
                    const action = btn.dataset.action;
                    if (action === 'left') {
                        keys['ArrowLeft'] = false;
                    } else if (action === 'right') {
                        keys['ArrowRight'] = false;
                    } else if (action === 'shoot') {
                        keys[' '] = false;
                    }
                });
            });
        }
        
        if (resetBtn) {
            resetBtn.addEventListener("click", reset);
        }
        
        let resizeTimeout;
        const handleResize = () => {
            if (gameWindow?.classList.contains("window--hidden")) return;
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
                        player.x = Math.min(canvas.width - player.width, Math.max(0, player.x));
                        player.y = Math.min(canvas.height - player.height - 20, Math.max(0, player.y));
                        
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
