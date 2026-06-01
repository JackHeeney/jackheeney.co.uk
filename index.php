<?php
// Basic PHP config – extend later (e.g. contact form, routing)
$yourName      = "Jack Heeney";
$emailAddress  = "jackheeney1@googlemail.com";
$linkedinUrl   = "https://www.linkedin.com/in/jack-heeney/";
$githubUrl     = "https://github.com/JackHeeney";

require_once __DIR__ . '/assets/inc/docs-helper.php';
$recentDocuments = portfolio_get_recent_documents(3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $yourName; ?> – Desktop Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main stylesheet -->
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <!-- Windows-style Login Screen -->
    <div id="login-screen" class="login-screen">
        <div class="login-screen__background"></div>

        <div class="login-screen__content">
            <div class="login-screen__top-bar">
                <div class="login-screen__language">EN</div>
            </div>

            <div class="login-screen__card">
                <div class="login-screen__avatar">
                    <span class="login-screen__avatar-icon">🔒</span>
                </div>
                <div class="login-screen__username">JackHeeney</div>

                <form class="login-screen__form">
                    <label class="login-screen__field">
                        <span class="login-screen__field-label">User name</span>
                        <input id="login-username" class="login-screen__input" type="text" value="JackHeeney" readonly>
                    </label>

                    <label class="login-screen__field">
                        <span class="login-screen__field-label">Password</span>
                        <input id="login-password" class="login-screen__input" type="password" value="Password123!" readonly>
                    </label>

                    <button id="login-button" type="submit" class="login-screen__button">
                        Log-in
                    </button>
                </form>
            </div>

            <div class="login-screen__bottom-bar">
                <div class="login-screen__brand">Jack Heeney's Portfolio 2026</div>
                <div class="login-screen__actions">
                    <button class="login-screen__icon-button" type="button" aria-label="Network (decorative)">
                        🛜
                    </button>
                    <button class="login-screen__icon-button" type="button" aria-label="Accessibility (decorative)">
                        ♿
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div id="desktop" class="desktop desktop--locked">

        <!-- Desktop Icons -->
        <div id="desktop-icons">
            <div class="desktop-icon" data-app="about" style="left:20px;top:20px;">
                <div class="desktop-icon__icon">👤</div>
                <div class="desktop-icon__label">About Me</div>
            </div>

            <div class="desktop-icon" data-app="projects" style="left:20px;top:140px;">
                <div class="desktop-icon__icon">💼</div>
                <div class="desktop-icon__label">My Projects</div>
            </div>

            <div class="desktop-icon" data-app="skills" style="left:20px;top:260px;">
                <div class="desktop-icon__icon">💻</div>
                <div class="desktop-icon__label">Skills</div>
            </div>

            <div class="desktop-icon" data-app="contact" style="left:20px;top:380px;">
                <div class="desktop-icon__icon">📧</div>
                <div class="desktop-icon__label">Contact</div>
            </div>

            <div class="desktop-icon" data-app="files" style="left:20px;top:500px;">
                <div class="desktop-icon__icon">📁</div>
                <div class="desktop-icon__label">My Files</div>
            </div>

            <div class="desktop-icon" data-app="game" style="left:140px;top:20px;">
                <div class="desktop-icon__icon">🎮</div>
                <div class="desktop-icon__label">Snake Game</div>
            </div>

            <div class="desktop-icon" data-app="invaders" style="left:140px;top:140px;">
                <div class="desktop-icon__icon">🚀</div>
                <div class="desktop-icon__label">Space Invaders</div>
            </div>

            <div class="desktop-icon" data-app="browser" style="left:140px;top:260px;">
                <div class="desktop-icon__icon">🌐</div>
                <div class="desktop-icon__label">Browser</div>
            </div>
        </div>

        <!-- Windows (modular, via includes) -->
        <div id="windows-container">
            <?php include 'assets/inc/window-about.php'; ?>
            <?php include 'assets/inc/window-projects.php'; ?>
            <?php include 'assets/inc/window-skills.php'; ?>
            <?php include 'assets/inc/window-contact.php'; ?>
            <?php include 'assets/inc/window-files.php'; ?>
            <?php include 'assets/inc/window-game.php'; ?>
            <?php include 'assets/inc/window-invaders.php'; ?>
            <?php include 'assets/inc/window-browser.php'; ?>
        </div>

        <!-- Clippy assistant -->
        <aside id="clippy-assistant" class="clippy" aria-label="Desktop assistant">
            <div class="clippy__bubble clippy__bubble--hidden" role="dialog" aria-live="polite" aria-labelledby="clippy-title">
                <button type="button" class="clippy__bubble-close" aria-label="Close tip">×</button>
                <p id="clippy-title" class="clippy__title">Clippy says:</p>
                <p class="clippy__message"></p>
                <div class="clippy__actions"></div>
                <button type="button" class="clippy__dismiss">Don't show Clippy again</button>
            </div>
            <button type="button" class="clippy__character" aria-label="Ask Clippy for help">
                <img
                    src="./assets/img/clippy.png"
                    alt="Clippy, the Office assistant"
                    width="620"
                    height="465"
                    draggable="false"
                    decoding="async">
            </button>
        </aside>

        <!-- Taskbar -->
        <div id="taskbar" class="taskbar">
            <button id="start-button" class="taskbar__start">
                <span class="taskbar__start-icon">☰</span>
                <span class="taskbar__start-label">Start</span>
            </button>

            <div id="taskbar-windows" class="taskbar__windows"></div>
            <div id="taskbar-clock" class="taskbar__clock"></div>
        </div>

        <!-- Start Menu -->
        <div id="start-menu" class="start-menu start-menu--hidden">
            <div class="start-menu__header">
                <div class="start-menu__title"><?php echo $yourName; ?>'s Portfolio</div>
            </div>
            <div class="start-menu__content">
                <!-- Pinned Section -->
                <div class="start-menu__section">
                    <div class="start-menu__section-header">
                        <span class="start-menu__section-title">Pinned</span>
                        <button class="start-menu__section-more">All ></button>
                    </div>
                    <div class="start-menu__pinned">
                        <button class="start-menu__app" data-app="about">
                            <div class="start-menu__app-icon">👤</div>
                            <div class="start-menu__app-label">About Me</div>
                        </button>
                        <button class="start-menu__app" data-app="projects">
                            <div class="start-menu__app-icon">💼</div>
                            <div class="start-menu__app-label">My Projects</div>
                        </button>
                        <button class="start-menu__app" data-app="skills">
                            <div class="start-menu__app-icon">💻</div>
                            <div class="start-menu__app-label">Skills</div>
                        </button>
                        <button class="start-menu__app" data-app="contact">
                            <div class="start-menu__app-icon">📧</div>
                            <div class="start-menu__app-label">Contact</div>
                        </button>
                        <button class="start-menu__app" data-app="files">
                            <div class="start-menu__app-icon">📁</div>
                            <div class="start-menu__app-label">My Files</div>
                        </button>
                        <button class="start-menu__app" data-app="game">
                            <div class="start-menu__app-icon">🎮</div>
                            <div class="start-menu__app-label">Snake Game</div>
                        </button>
                        <button class="start-menu__app" data-app="invaders">
                            <div class="start-menu__app-icon">🚀</div>
                            <div class="start-menu__app-label">Space Invaders</div>
                        </button>
                        <button class="start-menu__app" data-app="browser">
                            <div class="start-menu__app-icon">🌐</div>
                            <div class="start-menu__app-label">Browser</div>
                        </button>
                    </div>
                </div>

                <!-- Recommended Section -->
                <div class="start-menu__section">
                    <div class="start-menu__section-header">
                        <span class="start-menu__section-title">Recommended</span>
                        <button class="start-menu__section-more">More ></button>
                    </div>
                    <div class="start-menu__recommended">
                        <?php if (empty($recentDocuments)) : ?>
                            <p class="start-menu__empty">No documents yet</p>
                        <?php else : ?>
                            <?php foreach ($recentDocuments as $doc) : ?>
                                <button
                                    type="button"
                                    class="start-menu__file"
                                    data-pdf-url="<?php echo htmlspecialchars($doc['url'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-pdf-name="<?php echo htmlspecialchars($doc['name'], ENT_QUOTES, 'UTF-8'); ?>"
                                >
                                    <div class="start-menu__file-icon">📄</div>
                                    <div class="start-menu__file-info">
                                        <div class="start-menu__file-name"><?php echo htmlspecialchars($doc['name'], ENT_QUOTES, 'UTF-8'); ?></div>
                                        <div class="start-menu__file-meta"><?php echo htmlspecialchars($doc['type'], ENT_QUOTES, 'UTF-8'); ?></div>
                                    </div>
                                </button>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="start-menu__footer">
                <button id="start-logout" class="start-menu__logout" type="button">
                    Log out
                </button>
            </div>
        </div>
    </div>

    <script>
        window.PORTFOLIO_CONFIG = {
            email: "<?php echo $emailAddress; ?>",
            linkedin: "<?php echo $linkedinUrl; ?>",
            github: "<?php echo $githubUrl; ?>",
            name: "<?php echo $yourName; ?>"
        };
    </script>
    <script src="./assets/js/app.js" defer></script>
</body>

</html>