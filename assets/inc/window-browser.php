<div class="window window--hidden" id="window-browser" style="left:200px;top:100px;width:900px;height:600px;">
    <div class="window__titlebar" data-app-drag>
        <div class="window__title">Browser</div>
        <div class="window__controls">
            <button class="window__btn window__btn--min">–</button>
            <button class="window__btn window__btn--close">×</button>
        </div>
    </div>
    <div class="window__body browser">
        <!-- Browser Toolbar -->
        <div class="browser__toolbar">
            <div class="browser__nav-buttons">
                <button class="browser__nav-btn" id="browser-back" title="Back">←</button>
                <button class="browser__nav-btn" id="browser-forward" title="Forward">→</button>
                <button class="browser__nav-btn" id="browser-refresh" title="Refresh">⟳</button>
            </div>
            <div class="browser__address-bar">
                <span class="browser__lock-icon">🔒</span>
                <input type="text" class="browser__url" id="browser-url" value="https://jackheeney.dev" readonly>
            </div>
        </div>
        
        <!-- Browser Content (Portfolio Website) -->
        <div class="browser__content" id="browser-content">
            <div class="portfolio-site">
                <!-- Header Navigation -->
                <header class="portfolio-site__top-header">
                    <div class="portfolio-site__logo">Jack Heeney</div>
                    <nav class="portfolio-site__top-nav">
                        <a href="#home" class="portfolio-site__top-nav-link portfolio-site__top-nav-link--active" data-page="home">Home</a>
                        <a href="#about" class="portfolio-site__top-nav-link" data-page="about">About</a>
                        <a href="#skills" class="portfolio-site__top-nav-link" data-page="skills">Skills</a>
                        <a href="#projects" class="portfolio-site__top-nav-link" data-page="projects">Works</a>
                        <a href="#contact" class="portfolio-site__top-nav-link" data-page="contact">Contact</a>
                    </nav>
                </header>
                
                <!-- Home Page -->
                <div class="portfolio-site__page portfolio-site__page--active" id="page-home">
                    <div class="portfolio-site__hero">
                        <div class="portfolio-site__hero-content">
                            <div class="portfolio-site__hero-text">
                                <div class="portfolio-site__hero-greeting">Hi,</div>
                                <div class="portfolio-site__hero-name">
                                    I'am <span class="portfolio-site__hero-name-highlight">Jack Heeney</span>
                                </div>
                                <div class="portfolio-site__hero-title">Digital Products & Operations</div>
                                <button class="portfolio-site__hero-button" data-page="contact">Contact</button>
                            </div>
                            <div class="portfolio-site__hero-image">
                                <div class="portfolio-site__hero-blob"></div>
                                <div class="portfolio-site__hero-photo">
                                    <div class="portfolio-site__hero-photo-placeholder">👤</div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-site__social">
                            <a href="#" class="portfolio-site__social-link" title="LinkedIn">in</a>
                            <a href="#" class="portfolio-site__social-link" title="Behance">Bē</a>
                            <a href="#" class="portfolio-site__social-link" title="GitHub">🐙</a>
                        </div>
                    </div>
                </div>
                
                <!-- About Page -->
                <div class="portfolio-site__page" id="page-about">
                    <main class="portfolio-site__main">
                        <section class="portfolio-site__section">
                            <h2 class="portfolio-site__section-title">About Me</h2>
                            <div class="portfolio-site__about-content">
                                <p>Hello! I'm Jack Heeney, a passionate developer and creative professional dedicated to building innovative digital experiences.</p>
                                <p>With expertise in modern web technologies, I create seamless, user-friendly applications that solve real-world problems.</p>
                                <p>I believe in continuous learning and pushing the boundaries of what's possible with code.</p>
                            </div>
                        </section>
                    </main>
                </div>
                
                <!-- Skills Page -->
                <div class="portfolio-site__page" id="page-skills">
                    <main class="portfolio-site__main">
                        <section class="portfolio-site__section">
                            <h2 class="portfolio-site__section-title">Technical Skills</h2>
                            <div class="portfolio-site__skills-grid">
                                <div class="portfolio-site__skill-category">
                                    <h3 class="portfolio-site__skill-category-title">Frontend</h3>
                                    <div class="portfolio-site__skill-tags">
                                        <span class="portfolio-site__skill-tag">HTML5</span>
                                        <span class="portfolio-site__skill-tag">CSS3</span>
                                        <span class="portfolio-site__skill-tag">JavaScript</span>
                                        <span class="portfolio-site__skill-tag">TypeScript</span>
                                        <span class="portfolio-site__skill-tag">React</span>
                                        <span class="portfolio-site__skill-tag">Next.js</span>
                                        <span class="portfolio-site__skill-tag">Tailwind CSS</span>
                                    </div>
                                </div>
                                
                                <div class="portfolio-site__skill-category">
                                    <h3 class="portfolio-site__skill-category-title">Backend</h3>
                                    <div class="portfolio-site__skill-tags">
                                        <span class="portfolio-site__skill-tag">Node.js</span>
                                        <span class="portfolio-site__skill-tag">Express</span>
                                        <span class="portfolio-site__skill-tag">PHP</span>
                                        <span class="portfolio-site__skill-tag">REST APIs</span>
                                        <span class="portfolio-site__skill-tag">MySQL</span>
                                        <span class="portfolio-site__skill-tag">MongoDB</span>
                                    </div>
                                </div>
                                
                                <div class="portfolio-site__skill-category">
                                    <h3 class="portfolio-site__skill-category-title">Tools & Technologies</h3>
                                    <div class="portfolio-site__skill-tags">
                                        <span class="portfolio-site__skill-tag">Git</span>
                                        <span class="portfolio-site__skill-tag">GitHub</span>
                                        <span class="portfolio-site__skill-tag">Docker</span>
                                        <span class="portfolio-site__skill-tag">VS Code</span>
                                        <span class="portfolio-site__skill-tag">CI/CD</span>
                                        <span class="portfolio-site__skill-tag">Agile</span>
                                    </div>
                                </div>
                                
                                <div class="portfolio-site__skill-category">
                                    <h3 class="portfolio-site__skill-category-title">Other</h3>
                                    <div class="portfolio-site__skill-tags">
                                        <span class="portfolio-site__skill-tag">UI/UX Design</span>
                                        <span class="portfolio-site__skill-tag">Testing</span>
                                        <span class="portfolio-site__skill-tag">Performance</span>
                                        <span class="portfolio-site__skill-tag">Scrum</span>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
                
                <!-- Projects Page -->
                <div class="portfolio-site__page" id="page-projects">
                    <main class="portfolio-site__main">
                        <section class="portfolio-site__section">
                            <h2 class="portfolio-site__section-title">My Projects</h2>
                            <div class="portfolio-site__projects-grid">
                                <div class="portfolio-site__project-card">
                                    <h3 class="portfolio-site__project-title">E-Commerce Platform</h3>
                                    <div class="portfolio-site__project-tech">React, Node.js, MongoDB</div>
                                    <p class="portfolio-site__project-desc">A full-stack e-commerce solution with real-time inventory management and integrated payments.</p>
                                </div>
                                <div class="portfolio-site__project-card">
                                    <h3 class="portfolio-site__project-title">Task Management App</h3>
                                    <div class="portfolio-site__project-tech">React, Firebase, Tailwind CSS</div>
                                    <p class="portfolio-site__project-desc">An intuitive task manager with drag-and-drop boards and real-time team collaboration.</p>
                                </div>
                                <div class="portfolio-site__project-card">
                                    <h3 class="portfolio-site__project-title">Weather Dashboard</h3>
                                    <div class="portfolio-site__project-tech">JavaScript, REST APIs</div>
                                    <p class="portfolio-site__project-desc">Real-time weather data visualisation with interactive maps and multi-day forecasts.</p>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
                
                <!-- Contact Page -->
                <div class="portfolio-site__page" id="page-contact">
                    <main class="portfolio-site__main">
                        <section class="portfolio-site__section">
                            <h2 class="portfolio-site__section-title">Get in Touch</h2>
                            <div class="portfolio-site__contact-content">
                                <p>Feel free to reach out if you'd like to work together or just say hello!</p>
                                <div class="portfolio-site__contact-info">
                                    <div class="portfolio-site__contact-item">
                                        <strong>Email:</strong> your.email@example.com
                                    </div>
                                    <div class="portfolio-site__contact-item">
                                        <strong>LinkedIn:</strong> <a href="#" class="portfolio-site__contact-link">View Profile</a>
                                    </div>
                                    <div class="portfolio-site__contact-item">
                                        <strong>GitHub:</strong> <a href="#" class="portfolio-site__contact-link">View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>

