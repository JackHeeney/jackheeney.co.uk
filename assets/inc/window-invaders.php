<div class="window window--hidden" id="window-invaders" style="left:400px;top:80px;width:600px;height:700px;">
    <div class="window__titlebar" data-app-drag>
        <div class="window__title">Space Invaders</div>
        <div class="window__controls">
            <button class="window__btn window__btn--min">–</button>
            <button class="window__btn window__btn--close">×</button>
        </div>
    </div>
    <div class="window__body invaders">
        <div class="invaders__loading" id="invaders-loading">
            <div class="invaders__loading-content" id="invaders-loading-content">
                <div class="invaders__loading-icon">🚀</div>
                <div class="invaders__loading-text">Loading Space Invaders...</div>
                <div class="invaders__loading-bar">
                    <div class="invaders__loading-progress" id="invaders-loading-progress"></div>
                </div>
            </div>
            <div class="invaders__loading-image" id="invaders-loading-image" style="display: none;">
                <div class="invaders__loading-icon" style="font-size: 64px; margin-bottom: 20px;">🚀</div>
                <div class="invaders__loading-text" style="font-size: 18px; color: #cbd5e1;">Space Invaders Ready!</div>
            </div>
        </div>
        <div class="invaders__menu" id="invaders-menu" style="display: none;">
            <div class="invaders__menu-content">
                <div class="invaders__menu-title">SPACE INVADERS</div>
                <div class="invaders__menu-buttons">
                    <button class="invaders__menu-btn" id="invaders-start-btn">START GAME</button>
                    <button class="invaders__menu-btn" id="invaders-hiscore-btn">HI-SCORE</button>
                </div>
            </div>
            <div class="invaders__menu-background">
                <canvas id="invaders-menu-canvas"></canvas>
            </div>
        </div>
        <div class="invaders__game-content" id="invaders-game-content" style="display: none;">
            <div class="invaders__header">
                <div>Score: <span id="invaders-score">0</span></div>
                <div>Level: <span id="invaders-level">1</span></div>
                <div>Lives: <span id="invaders-lives">3</span></div>
                <button class="invaders__reset" id="invaders-reset">⟳ Reset</button>
            </div>
            <div class="invaders__canvas-container">
                <canvas id="invaders-canvas"></canvas>
            </div>
            <div class="invaders__info" id="invaders-info">
                <div>Use arrow keys or A/D to move, Space to shoot</div>
                <div class="invaders__sub">Destroy all invaders!</div>
            </div>
            <div class="invaders__mobile-controls" id="invaders-mobile-controls">
                <div class="invaders__controls-row">
                    <button class="invaders__control-btn" data-action="left">←</button>
                    <button class="invaders__control-btn invaders__control-btn--shoot" data-action="shoot">🔫</button>
                    <button class="invaders__control-btn" data-action="right">→</button>
                </div>
            </div>
        </div>
        <div class="invaders__hiscore-modal" id="invaders-hiscore-modal" style="display: none;">
            <div class="invaders__hiscore-content">
                <div class="invaders__hiscore-title">HIGH SCORES</div>
                <div class="invaders__hiscore-list" id="invaders-hiscore-list"></div>
                <button class="invaders__hiscore-close" id="invaders-hiscore-close">CLOSE</button>
            </div>
        </div>
        <div class="invaders__name-entry" id="invaders-name-entry" style="display: none;">
            <div class="invaders__name-entry-content">
                <div class="invaders__name-entry-title">NEW HIGH SCORE!</div>
                <div class="invaders__name-entry-subtitle">Enter Your Initials</div>
                <div class="invaders__name-entry-input">
                    <input type="text" id="invaders-name-1" maxlength="1" class="invaders__name-char" />
                    <input type="text" id="invaders-name-2" maxlength="1" class="invaders__name-char" />
                    <input type="text" id="invaders-name-3" maxlength="1" class="invaders__name-char" />
                </div>
                <div class="invaders__name-entry-score">Score: <span id="invaders-name-score">0</span></div>
                <button class="invaders__name-entry-submit" id="invaders-name-submit">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
