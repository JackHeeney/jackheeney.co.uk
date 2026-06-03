<?php
// Basic PHP config – extend later (e.g. contact form, routing)
$yourName      = "Jack Heeney";
$emailAddress  = "jackheeney1@googlemail.com";
$linkedinUrl   = "https://www.linkedin.com/in/jack-heeney/";
$githubUrl     = "https://github.com/JackHeeney";
$facebookUrl   = "https://www.facebook.com/heeneyog";
$instagramUrl  = "https://www.instagram.com/heeneyog/";

require_once __DIR__ . '/assets/inc/docs-helper.php';
$recentDocuments = portfolio_get_recent_documents(3);
$cvDocument = null;
foreach (portfolio_get_documents() as $doc) {
    if (stripos($doc['name'], 'cv') !== false || stripos($doc['filename'], 'cv') !== false) {
        $cvDocument = $doc;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $yourName; ?> – Desktop Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">
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

                <p class="login-screen__hint">Click <strong>Log-in</strong> to view the portfolio.</p>

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

            <div class="desktop-icon" data-app="files" style="left:140px;top:380px;">
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

            <div class="desktop-icon" data-app="runescape-hiscores" style="left:260px;top:20px;">
                <div class="desktop-icon__icon">
                    <img
                        src="./assets/img/Old_School_RuneScape_Mobile_icon.webp"
                        alt="Old School RuneScape Hiscores"
                        class="desktop-icon__icon-image"
                        width="28"
                        height="28"
                        decoding="async">
                </div>
                <div class="desktop-icon__label">OSRS Hiscores</div>
            </div>

            <?php if ($cvDocument) : ?>
                <div
                    class="desktop-icon desktop-icon--file"
                    data-pdf-url="<?php echo htmlspecialchars($cvDocument['url'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-pdf-name="<?php echo htmlspecialchars($cvDocument['name'], ENT_QUOTES, 'UTF-8'); ?>"
                    style="left:260px;top:140px;">
                    <div class="desktop-icon__icon">📄</div>
                    <div class="desktop-icon__label"><?php echo htmlspecialchars($cvDocument['name'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
            <?php endif; ?>
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
                        <button class="start-menu__app" data-app="runescape-hiscores">
                            <div class="start-menu__app-icon">
                                <img
                                    src="./assets/img/Old_School_RuneScape_Mobile_icon.webp"
                                    alt=""
                                    class="start-menu__app-icon-image"
                                    width="32"
                                    height="32"
                                    decoding="async">
                            </div>
                            <div class="start-menu__app-label">OSRS Hiscores</div>
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
                                    data-pdf-name="<?php echo htmlspecialchars($doc['name'], ENT_QUOTES, 'UTF-8'); ?>">
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

        <!-- Desktop-level overlays (above taskbar; below focused app windows when minimised) -->
        <aside id="sticky-notes" class="sticky-notes sticky-notes--collapsed" aria-label="Sticky notes">
            <button type="button" class="sticky-notes__peek" aria-label="Open sticky notes">
                <span class="sticky-notes__peek-icon" aria-hidden="true">📝</span>
                <span class="sticky-notes__peek-label">Notes</span>
            </button>

            <div class="sticky-notes__panel">
                <header class="sticky-notes__titlebar">
                    <span class="sticky-notes__title">Sticky Notes</span>
                    <div class="sticky-notes__titlebar-actions">
                        <button type="button" class="sticky-notes__collapse" aria-expanded="false" aria-label="Expand sticky notes">▸</button>
                        <button type="button" class="sticky-notes__close" aria-label="Close sticky notes">×</button>
                    </div>
                </header>

                <div class="sticky-notes__body">
                    <p class="sticky-notes__hint">Leave a note for the next visitor — up to 3 at a time; newer notes replace the oldest. You can remove only notes you posted here.</p>

                    <div class="sticky-notes__list" role="list" aria-live="polite"></div>

                    <form class="sticky-notes__form">
                        <label class="sticky-notes__field">
                            <span class="sticky-notes__label">Your name <span class="sticky-notes__optional">(optional)</span></span>
                            <input
                                type="text"
                                class="sticky-notes__author"
                                name="author"
                                maxlength="32"
                                placeholder="Guest"
                                autocomplete="nickname">
                        </label>
                        <label class="sticky-notes__field">
                            <span class="sticky-notes__label">Your note</span>
                            <textarea
                                class="sticky-notes__text"
                                name="text"
                                rows="3"
                                maxlength="280"
                                placeholder="Say hi, share a thought, or leave feedback…"
                                required></textarea>
                            <span class="sticky-notes__counter">0/280</span>
                        </label>
                        <button type="submit" class="sticky-notes__submit">Add note</button>
                        <p class="sticky-notes__status" role="status"></p>
                    </form>
                </div>
            </div>
        </aside>

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