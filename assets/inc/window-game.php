<div class="window window--hidden" id="window-game" style="left:380px;top:70px;width:480px;height:560px;">
    <div class="window__titlebar" data-app-drag>
        <div class="window__title">Snake Game</div>
        <div class="window__controls">
            <button class="window__btn window__btn--min">–</button>
            <button class="window__btn window__btn--close">×</button>
        </div>
    </div>
    <div class="window__body snake">
        <div class="snake__loading" id="snake-loading">
            <div class="snake__loading-content" id="snake-loading-content">
                <div class="snake__loading-icon">🎮</div>
                <div class="snake__loading-text">Loading Snake Game...</div>
                <div class="snake__loading-bar">
                    <div class="snake__loading-progress" id="snake-loading-progress"></div>
                </div>
            </div>
            <div class="snake__loading-image" id="snake-loading-image" style="display: none;">
                <img src="assets/img/loading/snake-loading-image.jpeg" alt="Snake Game" />
            </div>
        </div>
        <div class="snake__game-content" id="snake-game-content" style="display: none;">
            <div class="snake__header">
                <div>Score: <span id="snake-score">0</span></div>
                <button class="snake__reset" id="snake-reset">⟳ Reset</button>
            </div>
            <div class="snake__board" id="snake-board"></div>
            <div class="snake__info" id="snake-info">
                <div>Use arrow keys to move</div>
                <div class="snake__sub">Don't hit the walls or yourself!</div>
            </div>
            <div class="snake__mobile-controls" id="snake-mobile-controls">
                <div class="snake__controls-row">
                    <button class="snake__control-btn" data-direction="UP">↑</button>
                </div>
                <div class="snake__controls-row">
                    <button class="snake__control-btn" data-direction="LEFT">←</button>
                    <button class="snake__control-btn" data-direction="DOWN">↓</button>
                    <button class="snake__control-btn" data-direction="RIGHT">→</button>
                </div>
            </div>
        </div>
    </div>
</div>