<?php
if (!function_exists('portfolio_core_skills')) {
    require_once __DIR__ . '/skills-data.php';
}
$coreSkills = portfolio_core_skills();
?>
<div class="window window--hidden" id="window-skills" style="left:260px;top:170px;width:620px;height:520px;">
    <div class="window__titlebar" data-app-drag>
        <div class="window__title">Skills</div>
        <div class="window__controls">
            <button class="window__btn window__btn--min">–</button>
            <button class="window__btn window__btn--close">×</button>
        </div>
    </div>
    <div class="window__body">
        <h2>Core Skills</h2>
        <ul class="skills-core-list">
            <?php foreach ($coreSkills as $skill) : ?>
                <li><?php echo htmlspecialchars($skill, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
