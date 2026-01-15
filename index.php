<?php
// Basic PHP config – extend later (e.g. contact form, routing)
$yourName      = "Jack Heeney";
$emailAddress  = "your.email@example.com";
$linkedinUrl   = "https://www.linkedin.com/in/yourprofile";
$githubUrl     = "https://github.com/yourusername";
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
    <div id="desktop" class="desktop">

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

            <div class="desktop-icon" data-app="browser" style="left:140px;top:140px;">
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
                        <button class="start-menu__file" data-file="cv">
                            <div class="start-menu__file-icon">📄</div>
                            <div class="start-menu__file-info">
                                <div class="start-menu__file-name">CV - Jack Heeney</div>
                                <div class="start-menu__file-meta">PDF Document</div>
                            </div>
                        </button>
                        <button class="start-menu__file" data-file="portfolio">
                            <div class="start-menu__file-icon">📄</div>
                            <div class="start-menu__file-info">
                                <div class="start-menu__file-name">Portfolio Overview</div>
                                <div class="start-menu__file-meta">PDF Document</div>
                            </div>
                        </button>
                        <button class="start-menu__file" data-file="resume">
                            <div class="start-menu__file-icon">📄</div>
                            <div class="start-menu__file-info">
                                <div class="start-menu__file-name">Resume</div>
                                <div class="start-menu__file-meta">PDF Document</div>
                            </div>
                        </button>
                    </div>
                </div>
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