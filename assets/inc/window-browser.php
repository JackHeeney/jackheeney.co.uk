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

        <!-- Browser viewport: scrollable site + fixed lightbox overlay -->
        <div class="browser__stage">
            <div class="browser__content" id="browser-content">
                <div class="portfolio-site">
                    <!-- Header Navigation -->
                    <header class="portfolio-site__top-header">
                        <div class="portfolio-site__logo">Jack Heeney</div>
                        <nav class="portfolio-site__top-nav">
                            <a href="#home" class="portfolio-site__top-nav-link portfolio-site__top-nav-link--active" data-page="home">Home</a>
                            <a href="#about" class="portfolio-site__top-nav-link" data-page="about">About</a>
                            <a href="#skills" class="portfolio-site__top-nav-link" data-page="skills">Skills</a>
                            <a href="#projects" class="portfolio-site__top-nav-link" data-page="projects">Projects</a>
                            <a href="#contact" class="portfolio-site__top-nav-link" data-page="contact">Contact</a>
                        </nav>
                    </header>

                    <!-- Home Page -->
                    <div class="portfolio-site__page portfolio-site__page--active" id="page-home">
                        <div class="portfolio-site__hero">
                            <div class="portfolio-site__hero-content">
                                <div class="portfolio-site__hero-text">
                                    <div class="portfolio-site__hero-greeting">
                                        Hi 👋🏻 I'm <span class="portfolio-site__hero-name-highlight">Jack Heeney</span>.
                                    </div>
                                    <div class="portfolio-site__hero-title">
                                        A <span class="portfolio-site__hero-title-past">web developer, marketer, graphic designer,</span>
                                        <span class="portfolio-site__hero-title-role">Product &amp; Growth Manager</span>
                                    </div>
                                    <button class="portfolio-site__hero-button" data-page="contact">Contact</button>
                                </div>
                                <div class="portfolio-site__hero-image">
                                    <div class="portfolio-site__hero-blob"></div>
                                    <div class="portfolio-site__hero-photo">
                                        <div class="portfolio-site__hero-photo-placeholder">👤</div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (!function_exists('portfolio_social_icon_svg')) {
                                require_once __DIR__ . '/social-icons.php';
                            }
                            ?>
                            <div class="portfolio-site__social">
                                <a href="<?php echo htmlspecialchars($linkedinUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-site__social-link" aria-label="LinkedIn"><?php echo portfolio_social_icon_svg('linkedin'); ?></a>
                                <a href="<?php echo htmlspecialchars($facebookUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-site__social-link" aria-label="Facebook"><?php echo portfolio_social_icon_svg('facebook'); ?></a>
                                <a href="<?php echo htmlspecialchars($instagramUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-site__social-link" aria-label="Instagram"><?php echo portfolio_social_icon_svg('instagram'); ?></a>
                                <a href="<?php echo htmlspecialchars($githubUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-site__social-link" aria-label="GitHub"><?php echo portfolio_social_icon_svg('github'); ?></a>
                            </div>
                        </div>
                    </div>

                    <!-- About Page -->
                    <div class="portfolio-site__page" id="page-about">
                        <main class="portfolio-site__main">
                            <section class="portfolio-site__section">
                                <h2 class="portfolio-site__section-title">About Me</h2>
                                <div class="portfolio-site__about-content">
                                    <p>Digital Product, Growth &amp; UX professional with 8+ years of experience leading website platforms, user journeys, digital campaigns, and operational systems across education and technology-focused environments.</p>
                                    <p>Experienced in improving conversion, engagement, and usability through UX-led thinking, analytics, experimentation, and hands-on implementation. Strong background bridging product, marketing, design, and technical teams to deliver scalable digital experiences and business improvements.</p>
                                    <p>Technically hands-on with strong HTML/CSS and web implementation experience, supported by working knowledge of PHP, SQL, JavaScript, APIs, and React. Comfortable managing projects end-to-end, from discovery and UX planning through to launch, optimisation, and ongoing iteration.</p>
                                </div>
                            </section>
                        </main>
                    </div>

                    <!-- Skills Page -->
                    <?php
                    if (!function_exists('portfolio_core_skills')) {
                        require_once __DIR__ . '/skills-data.php';
                    }
                    $coreSkills = portfolio_core_skills();
                    ?>
                    <div class="portfolio-site__page" id="page-skills">
                        <main class="portfolio-site__main">
                            <section class="portfolio-site__section">
                                <h2 class="portfolio-site__section-title portfolio-site__section-title--skills">
                                    <span class="portfolio-site__section-title-icon" aria-hidden="true">💡</span>
                                    Core Skills
                                </h2>
                                <ul class="portfolio-site__core-skills">
                                    <?php foreach ($coreSkills as $skill) : ?>
                                        <li class="portfolio-site__core-skill"><?php echo htmlspecialchars($skill, ENT_QUOTES, 'UTF-8'); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </section>
                        </main>
                    </div>

                    <!-- Projects Page -->
                    <div class="portfolio-site__page" id="page-projects">
                        <main class="portfolio-site__main">
                            <section class="portfolio-site__section portfolio-site__projects-intro">
                                <h2 class="portfolio-site__section-title">Projects</h2>
                                <p class="portfolio-site__case-studies-lead">
                                    Case studies and live websites from product, growth, engineering, and creative work.
                                </p>
                            </section>

                            <section class="portfolio-site__section portfolio-site__external-websites">
                                <h3 class="portfolio-site__subsection-title">Live Websites</h3>
                                <p class="portfolio-site__external-websites-copy">Websites and landing pages I have worked on — open in the browser to explore:</p>
                                <div class="portfolio-site__external-websites-list">
                                    <a href="https://azure-webinar.com/" class="portfolio-site__external-link" data-external-url="https://azure-webinar.com/">azure-webinar.com</a>
                                    <a href="https://cyber-webinar.com/" class="portfolio-site__external-link" data-external-url="https://cyber-webinar.com/">cyber-webinar.com</a>
                                    <a href="https://data-webinar.org/" class="portfolio-site__external-link" data-external-url="https://data-webinar.org/">data-webinar.org</a>
                                    <a href="https://ai-webinar.co.uk/" class="portfolio-site__external-link" data-external-url="https://ai-webinar.co.uk/">ai-webinar.co.uk</a>
                                    <a href="https://www.robustittraining.com/" class="portfolio-site__external-link" data-external-url="https://www.robustittraining.com/">robustittraining.com</a>
                                    <a href="https://www.getglitched.co.uk/" class="portfolio-site__external-link" data-external-url="https://www.getglitched.co.uk/">getglitched.co.uk</a>
                                    <a href="https://bindertrader.vercel.app/" class="portfolio-site__external-link" data-external-url="https://bindertrader.vercel.app/">bindertrader.vercel.app</a>
                                </div>
                            </section>

                            <section class="portfolio-site__section portfolio-site__case-studies-intro">
                                <h3 class="portfolio-site__subsection-title">Case Studies</h3>
                                <p class="portfolio-site__case-studies-lead">
                                    A focused collection of digital product, growth, and creative projects delivered across technical implementation,
                                    operational systems, and conversion-led marketing.
                                </p>
                            </section>

                            <section class="portfolio-site__section">
                                <div class="portfolio-site__case-studies-grid">
                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Digital Product + Growth</div>
                                        <h3 class="portfolio-site__case-card-title">IT Training Route Decision Platform & Conversion Funnel</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Digital Product & Growth Lead</p>
                                        <p class="portfolio-site__case-card-desc">Restructured route-selection and webinar funnels to reduce friction, improve clarity, and strengthen lead intent.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-it-training-route">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Marketing Systems</div>
                                        <h3 class="portfolio-site__case-card-title">Webinar Marketing System & Email Campaign Optimisation</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Marketing Strategy & Campaign Lead</p>
                                        <p class="portfolio-site__case-card-desc">Built a repeatable webinar and email system with segmentation and performance-led iteration.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-webinar-marketing">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Product Architecture</div>
                                        <h3 class="portfolio-site__case-card-title">BinderTrader Platform Architecture & Product Development</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Founder, Product Designer, Full-Stack Developer</p>
                                        <p class="portfolio-site__case-card-desc">Designed a trade-first card platform with robust lifecycle logic, scalable backend systems, and trust-first UX.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-bindertrader">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Operations + Delivery</div>
                                        <h3 class="portfolio-site__case-card-title">Digital Operations & Cross-Department Systems Management</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Digital Product & Operations Lead</p>
                                        <p class="portfolio-site__case-card-desc">Improved organisational execution by bridging technical implementation with operational workflows.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-digital-ops">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Education Product</div>
                                        <h3 class="portfolio-site__case-card-title">Student Mock Exam Platform Redesign & System Modernisation</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Product Lead, UX Designer, Frontend Developer</p>
                                        <p class="portfolio-site__case-card-desc">Modernised an internal exam platform with cleaner UX, better structure, and stronger long-term scalability.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-mock-exam">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Creative Performance</div>
                                        <h3 class="portfolio-site__case-card-title">Social Media Campaign Creative & Performance Design</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Creative Lead & Digital Designer</p>
                                        <p class="portfolio-site__case-card-desc">Produced conversion-focused social assets across webinar, paid, and organic campaign streams.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-social-creative">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Print + Event Design</div>
                                        <h3 class="portfolio-site__case-card-title">Event Banner, Flyer & Exhibition Design</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Creative Designer, Brand & Marketing Support</p>
                                        <p class="portfolio-site__case-card-desc">Delivered high-impact print assets built for visibility, speed of comprehension, and consistent brand delivery.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-event-design">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Brand Identity</div>
                                        <h3 class="portfolio-site__case-card-title">Deep Dissonance Podcast Brand Identity & Creative Direction</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Brand Designer & Creative Director</p>
                                        <p class="portfolio-site__case-card-desc">Created a complete visual identity system for a drum and bass podcast concept with scalable social applications.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-deep-dissonance">Open case study</button>
                                    </article>
                                </div>
                            </section>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-it-training-route">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 1</p>
                                    <h2 class="portfolio-site__case-title">IT Training Route Decision Platform & Conversion Funnel</h2>
                                    <p class="portfolio-site__case-subtitle">Designed and implemented a conversion-focused route decision journey for an IT training provider.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Digital Product & Growth Lead</span>
                                        <span class="portfolio-site__case-chip">Focus: UX strategy + conversion optimisation</span>
                                        <span class="portfolio-site__case-chip">Delivery: Funnel architecture + analytics</span>
                                    </div>
                                </header>
                                <section class="portfolio-site__case-section">
                                    <h3>The Challenge</h3>
                                    <p>Users were struggling to choose the right training route, pages were dense, and webinar sign-up paths lacked strong intent structure, especially on mobile.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Responsibilities</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>UX strategy and landing page architecture</li>
                                        <li>Conversion optimisation and CTA hierarchy testing</li>
                                        <li>Analytics and attribution setup across GA4 and campaign channels</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Approach</h3>
                                    <p>Reframed content around user intent with guided route selection, comparison modules, simplified calls to action, and above-the-fold webinar prompts.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>GA4, GTM, MailerLite, Ahrefs, Hotjar, Microsoft Clarity, HTML, CSS, JavaScript, WordPress.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Results & Impact</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Higher engagement with route selectors and comparison blocks</li>
                                        <li>Improved mobile landing-page interaction quality</li>
                                        <li>Better visibility into behavioural drop-off patterns</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Visual Showcase</h3>
                                    <div class="portfolio-site__media-grid">
                                        <div class="portfolio-site__media-placeholder">Landing page before/after</div>
                                        <div class="portfolio-site__media-placeholder">Funnel decision flow</div>
                                        <div class="portfolio-site__media-placeholder">Mobile CTA placement</div>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-webinar-marketing">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-webinar-marketing">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 2</p>
                                    <h2 class="portfolio-site__case-title">Webinar Marketing System & Email Campaign Optimisation</h2>
                                    <p class="portfolio-site__case-subtitle">Built a repeatable webinar campaign engine with segmented journeys and performance-led iteration.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Marketing Strategy & Campaign Lead</span>
                                        <span class="portfolio-site__case-chip">Focus: segmentation + lifecycle automation</span>
                                        <span class="portfolio-site__case-chip">Delivery: multi-stage email workflows</span>
                                    </div>
                                </header>
                                <section class="portfolio-site__case-section">
                                    <h3>The Challenge</h3>
                                    <p>Webinar performance was inconsistent with generic follow-up, weak segmentation, and limited visibility into user intent.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Responsibilities</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Campaign strategy and email journey design</li>
                                        <li>Audience segmentation and optimisation cadence</li>
                                        <li>Creative consistency, tracking, and reporting</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Approach</h3>
                                    <p>Introduced reusable registration-to-follow-up sequences with click and attendance-based branching, then iterated weekly on subject lines, timing, and CTA structure.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>MailerLite, GA4, GTM, UTM tracking, HTML email development, CRM systems, Excel, Google Sheets.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Results & Impact</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>More consistent webinar registration outcomes</li>
                                        <li>Stronger visibility into engagement quality and intent</li>
                                        <li>Lower manual setup through reusable campaign frameworks</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Visual Showcase</h3>
                                    <div class="portfolio-site__media-grid">
                                        <div class="portfolio-site__media-placeholder">Webinar campaign timeline</div>
                                        <div class="portfolio-site__media-placeholder">Email sequence preview</div>
                                        <div class="portfolio-site__media-placeholder">Performance dashboard</div>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-bindertrader">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-bindertrader">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 3</p>
                                    <h2 class="portfolio-site__case-title">BinderTrader Platform Architecture & Product Development</h2>
                                    <p class="portfolio-site__case-subtitle">Designed and built a trade-first platform concept for transparent, community-driven card exchanges.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Founder + Full-Stack Developer</span>
                                        <span class="portfolio-site__case-chip">Focus: architecture + trust-centric UX</span>
                                        <span class="portfolio-site__case-chip">Delivery: trade lifecycle system</span>
                                    </div>
                                </header>
                                <section class="portfolio-site__case-section">
                                    <h3>The Challenge</h3>
                                    <p>Most existing platforms prioritised sales over trading, while reliable inventory sync and transparent settlement states remained difficult to achieve.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Responsibilities</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Product architecture and UX design</li>
                                        <li>Database design and backend trade logic</li>
                                        <li>Authentication, deployment, and operations planning</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Approach</h3>
                                    <p>Migrated from Supabase to a PostgreSQL and Prisma stack with Docker and Next.js, then implemented lifecycle, ownership, settlement, and notification systems with race-condition handling.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>Next.js, React, TypeScript, PostgreSQL, Prisma ORM, Docker, Vercel, Auth.js, HTML, CSS, JavaScript.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Results & Impact</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Established a scalable production-ready platform foundation</li>
                                        <li>Reduced sync and persistence issues from earlier architecture</li>
                                        <li>Improved trust through clearer trade status and confirmations</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any screenshot to view it full size.</p>
                                    <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/binderTrader/dashboard.png" alt="BinderTrader dashboard overview" loading="lazy">
                                            <figcaption>Dashboard overview</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/binderTrader/trading-matching-page.png" alt="BinderTrader trading matching page" loading="lazy">
                                            <figcaption>Trading matching page</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/binderTrader/matches.png" alt="BinderTrader trade matches list" loading="lazy">
                                            <figcaption>Trade matches</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/binderTrader/messaging.png" alt="BinderTrader in-app messaging screen" loading="lazy">
                                            <figcaption>In-app messaging</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/binderTrader/custom-binder-collections.png" alt="Custom binder collections in BinderTrader" loading="lazy">
                                            <figcaption>Custom binder collections</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/binderTrader/selecting-cards-for-binders.png" alt="Selecting cards for binders in BinderTrader" loading="lazy">
                                            <figcaption>Selecting cards for binders</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/binderTrader/user-profile.png" alt="BinderTrader user profile screen" loading="lazy">
                                            <figcaption>User profile</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/binderTrader/other-user-profiles.png" alt="Viewing other user profiles in BinderTrader" loading="lazy">
                                            <figcaption>Other user profiles</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/binderTrader/login-page-with-google-login.png" alt="BinderTrader login page with Google sign-in" loading="lazy">
                                            <figcaption>Login with Google</figcaption>
                                        </figure>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-digital-ops">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-digital-ops">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 4</p>
                                    <h2 class="portfolio-site__case-title">Digital Operations & Cross-Department Systems Management</h2>
                                    <p class="portfolio-site__case-subtitle">Led cross-functional digital and operational execution across marketing, systems, and training workflows.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Digital Product & Operations Lead</span>
                                        <span class="portfolio-site__case-chip">Focus: process clarity + execution speed</span>
                                        <span class="portfolio-site__case-chip">Delivery: multi-team operational support</span>
                                    </div>
                                </header>
                                <section class="portfolio-site__case-section">
                                    <h3>The Challenge</h3>
                                    <p>Responsibilities were distributed across small teams, creating fragmented workflows, inconsistent systems, and high manual coordination overhead.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Responsibilities</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Website systems and campaign implementation</li>
                                        <li>Operational coordination for training and webinars</li>
                                        <li>Cross-team delivery support and process improvement</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Approach</h3>
                                    <p>Created reusable campaign structures, improved reporting visibility, and introduced clearer handover workflows between technical and non-technical teams.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>WordPress, CRM systems, MailerLite, GA4, HTML, CSS, Excel, Google Sheets, webinar platforms, Stripe, API integrations.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Results & Impact</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Improved operational visibility and consistency</li>
                                        <li>Reduced manual workload across repeated tasks</li>
                                        <li>Increased speed and confidence of campaign deployment</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Visual Showcase</h3>
                                    <div class="portfolio-site__media-grid">
                                        <div class="portfolio-site__media-placeholder">Process workflow map</div>
                                        <div class="portfolio-site__media-placeholder">Coordination dashboard</div>
                                        <div class="portfolio-site__media-placeholder">System integration overview</div>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-mock-exam">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-mock-exam">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 5</p>
                                    <h2 class="portfolio-site__case-title">Student Mock Exam Platform Redesign & System Modernisation</h2>
                                    <p class="portfolio-site__case-subtitle">Redesigned an internal exam platform to improve usability, consistency, and long-term maintainability.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Product Lead + Frontend Developer</span>
                                        <span class="portfolio-site__case-chip">Focus: educational UX + responsive delivery</span>
                                        <span class="portfolio-site__case-chip">Delivery: modernised student journey</span>
                                    </div>
                                </header>
                                <section class="portfolio-site__case-section">
                                    <h3>The Challenge</h3>
                                    <p>The legacy system had fragmented interaction patterns, weak responsiveness, and structure that made content growth difficult to manage.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Responsibilities</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>UX planning and interaction redesign</li>
                                        <li>Frontend implementation and interface modernisation</li>
                                        <li>Content structuring for future pathway expansion</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Approach</h3>
                                    <p>Introduced cleaner layout systems, stronger hierarchy, clearer progress visibility, and mobile-first question flow patterns to reduce revision friction.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>HTML, CSS, JavaScript, responsive design methods, UX design workflows, CMS and content systems.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Results & Impact</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Significantly improved clarity and navigation quality</li>
                                        <li>Stronger scalability for future content expansion</li>
                                        <li>More consistent learner experience across devices</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any screenshot to view it full size.</p>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Quiz experience</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--compare">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/student-mocks/screenshot-old-quiz-layout.png" alt="Previous mock exam quiz layout" loading="lazy">
                                                <figcaption>Previous quiz layout</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/student-mocks/screenshot-new-quiz-layout.png" alt="Redesigned mock exam quiz layout" loading="lazy">
                                                <figcaption>Redesigned quiz layout</figcaption>
                                            </figure>
                                        </div>
                                        <div class="portfolio-site__media-grid">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/student-mocks/screenshot-new-quiz-review-features.png" alt="In-quiz review and navigation features" loading="lazy">
                                                <figcaption>In-quiz review and navigation</figcaption>
                                            </figure>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Results and feedback</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--compare">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/student-mocks/screenshot-old-results-layout.png" alt="Previous mock exam results summary" loading="lazy">
                                                <figcaption>Previous results summary</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/student-mocks/screenshot-new-results-layout.png" alt="Redesigned mock exam results summary" loading="lazy">
                                                <figcaption>Redesigned results summary</figcaption>
                                            </figure>
                                        </div>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/student-mocks/screenshot-new-results-questions-layout.png" alt="Per-question results breakdown" loading="lazy">
                                                <figcaption>Per-question results breakdown</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/student-mocks/screenshot-new-results-layout-dark-mode.png" alt="Results summary in dark mode" loading="lazy">
                                                <figcaption>Results summary (dark mode)</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/student-mocks/screenshot-new-results-questions-layout-dark-mode.png" alt="Question breakdown in dark mode" loading="lazy">
                                                <figcaption>Question breakdown (dark mode)</figcaption>
                                            </figure>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Case study content</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/student-mocks/screenshot-new-case-studies-1.png" alt="Case study listing layout" loading="lazy">
                                                <figcaption>Case study listing</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/student-mocks/screenshot-new-case-studies--2.png" alt="Case study detail layout" loading="lazy">
                                                <figcaption>Case study detail view</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/student-mocks/screenshot-new-case-studies-3.png" alt="Case study content structure" loading="lazy">
                                                <figcaption>Structured case study content</figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-social-creative">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-social-creative">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 6</p>
                                    <h2 class="portfolio-site__case-title">Social Media Campaign Creative & Performance Design</h2>
                                    <p class="portfolio-site__case-subtitle">Delivered high-performing digital creative for webinar, paid social, and promotional campaign outputs.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Creative Lead + Growth Design Support</span>
                                        <span class="portfolio-site__case-chip">Focus: clarity-driven visual conversion</span>
                                        <span class="portfolio-site__case-chip">Delivery: scalable campaign assets</span>
                                    </div>
                                </header>
                                <section class="portfolio-site__case-section">
                                    <h3>The Challenge</h3>
                                    <p>The team needed consistent creative output that balanced speed, visual quality, and conversion performance across different campaign channels.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Responsibilities</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Campaign creative direction and production</li>
                                        <li>Design optimisation for mobile-first ad placements</li>
                                        <li>Brand consistency across social and landing assets</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Approach</h3>
                                    <p>Designed around attention hierarchy, CTA clarity, and message relevance, then iterated layout and headline structures to improve performance.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>Adobe Creative Suite, Canva, Figma, Photoshop, Illustrator, Meta Ads, LinkedIn campaign tooling.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Results & Impact</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Higher consistency across paid and organic channels</li>
                                        <li>Built reusable creative systems for faster deployment</li>
                                        <li>Improved readability and engagement in mobile placements</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Visual Showcase</h3>
                                    <div class="portfolio-site__media-grid">
                                        <div class="portfolio-site__media-placeholder">Social ad concept panel</div>
                                        <div class="portfolio-site__media-placeholder">Creative test variants</div>
                                        <div class="portfolio-site__media-placeholder">Campaign visual system</div>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-event-design">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-event-design">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 7</p>
                                    <h2 class="portfolio-site__case-title">Event Banner, Flyer & Exhibition Design</h2>
                                    <p class="portfolio-site__case-subtitle">Produced large-format and print collateral for exhibitions, open days, and training recruitment campaigns.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Creative Designer</span>
                                        <span class="portfolio-site__case-chip">Focus: high-visibility communication design</span>
                                        <span class="portfolio-site__case-chip">Delivery: print-ready branded assets</span>
                                    </div>
                                </header>
                                <section class="portfolio-site__case-section">
                                    <h3>The Challenge</h3>
                                    <p>Event environments required instant clarity and strong visibility while maintaining brand consistency across multiple audiences and print formats.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Responsibilities</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Large-format banner and signage design</li>
                                        <li>Flyer, leaflet, and print collateral production</li>
                                        <li>Print preparation, bleed setup, and supplier-ready exports</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Approach</h3>
                                    <p>Designed for distance readability with strict hierarchy, concise messaging, and repeatable visual structures suitable for fast-turnaround events.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>Adobe Photoshop, Adobe Illustrator, Canva, print production workflows, typography and layout systems.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Results & Impact</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Improved consistency and professionalism of event materials</li>
                                        <li>Strengthened lead-generation support at exhibitions</li>
                                        <li>Created reusable print design systems for future campaigns</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Visual Showcase</h3>
                                    <div class="portfolio-site__media-grid">
                                        <div class="portfolio-site__media-placeholder">Exhibition banner mock-up</div>
                                        <div class="portfolio-site__media-placeholder">Flyer layout set</div>
                                        <div class="portfolio-site__media-placeholder">Print-ready production files</div>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-deep-dissonance">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-deep-dissonance">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 8</p>
                                    <h2 class="portfolio-site__case-title">Deep Dissonance Podcast Brand Identity & Creative Direction</h2>
                                    <p class="portfolio-site__case-subtitle">Created a complete visual identity and social direction for a drum and bass podcast concept.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Brand Designer + Creative Director</span>
                                        <span class="portfolio-site__case-chip">Focus: identity systems + scalable application</span>
                                        <span class="portfolio-site__case-chip">Delivery: logo, typography, and social concepts</span>
                                    </div>
                                </header>
                                <section class="portfolio-site__case-section">
                                    <h3>The Challenge</h3>
                                    <p>The brand needed to stand out in a saturated market while preserving adaptability across podcast artwork, social posts, and promotional formats.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Responsibilities</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Logo exploration and identity system design</li>
                                        <li>Mood boarding, art direction, and visual language definition</li>
                                        <li>Social concept development and implementation guidance</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Approach</h3>
                                    <p>Developed a dark, high-contrast visual system with recognisable type treatment and structured social templates for consistency and flexibility.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>Adobe Illustrator, Adobe Photoshop, Figma, typography systems, layout design and social mock-up workflows.</p>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Results & Impact</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Delivered a complete and scalable brand identity system</li>
                                        <li>Established a recognisable visual language for digital channels</li>
                                        <li>Created reusable templates for ongoing content production</li>
                                    </ul>
                                </section>
                                <section class="portfolio-site__case-section">
                                    <h3>Visual Showcase</h3>
                                    <div class="portfolio-site__media-grid">
                                        <div class="portfolio-site__media-placeholder">Logo evolution concepts</div>
                                        <div class="portfolio-site__media-placeholder">Mood board and type direction</div>
                                        <div class="portfolio-site__media-placeholder">Social post mock-ups</div>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="home">Return to home</button>
                                </footer>
                            </article>
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
                                            <strong>Email:</strong>
                                            <a href="mailto:<?php echo htmlspecialchars($emailAddress, ENT_QUOTES, 'UTF-8'); ?>" class="portfolio-site__contact-link"><?php echo htmlspecialchars($emailAddress, ENT_QUOTES, 'UTF-8'); ?></a>
                                        </div>
                                        <div class="portfolio-site__contact-item">
                                            <strong>LinkedIn:</strong>
                                            <a href="<?php echo htmlspecialchars($linkedinUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-site__contact-link">View Profile</a>
                                        </div>
                                        <div class="portfolio-site__contact-item">
                                            <strong>GitHub:</strong>
                                            <a href="<?php echo htmlspecialchars($githubUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-site__contact-link">View Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-osrs-hiscores">
                        <main class="portfolio-site__main osrs-hiscores">
                            <section class="portfolio-site__section">
                                <header class="osrs-hiscores__header">
                                    <h2 class="portfolio-site__section-title osrs-hiscores__title">Old School RuneScape Hiscores</h2>
                                    <p class="osrs-hiscores__player-name" aria-live="polite">IM_KOFI</p>
                                    <div class="osrs-hiscores__overall-meta" aria-live="polite"></div>
                                    <p class="osrs-hiscores__notice">
                                        Jagex no longer allows this site to be embedded in a frame. Stats are loaded from the official API instead.
                                        <a class="osrs-hiscores__official-link" href="https://secure.runescape.com/m=hiscore_oldschool/hiscorepersonal?user1=IM_KOFI" target="_blank" rel="noopener noreferrer">Open full profile on runescape.com</a>
                                    </p>
                                </header>
                                <p class="osrs-hiscores__status" role="status"></p>
                                <div class="osrs-hiscores__table-wrap">
                                    <table class="osrs-hiscores__table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Skill</th>
                                                <th scope="col">Rank</th>
                                                <th scope="col">Level</th>
                                                <th scope="col">XP</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </section>
                        </main>
                    </div>
                </div>
            </div>

            <div class="portfolio-site__lightbox" id="portfolio-site-lightbox" aria-hidden="true">
                <button type="button" class="portfolio-site__lightbox-backdrop" data-lightbox-close aria-label="Close enlarged image"></button>
                <div class="portfolio-site__lightbox-panel" role="dialog" aria-modal="true" aria-labelledby="portfolio-site-lightbox-caption">
                    <button type="button" class="portfolio-site__lightbox-close" data-lightbox-close aria-label="Close">×</button>
                    <div class="portfolio-site__lightbox-stage">
                        <button type="button" class="portfolio-site__lightbox-nav portfolio-site__lightbox-nav--prev" id="portfolio-site-lightbox-prev" aria-label="Previous image" hidden>‹</button>
                        <img class="portfolio-site__lightbox-img" id="portfolio-site-lightbox-img" alt="">
                        <button type="button" class="portfolio-site__lightbox-nav portfolio-site__lightbox-nav--next" id="portfolio-site-lightbox-next" aria-label="Next image" hidden>›</button>
                    </div>
                    <p class="portfolio-site__lightbox-caption" id="portfolio-site-lightbox-caption"></p>
                    <p class="portfolio-site__lightbox-counter" id="portfolio-site-lightbox-counter" aria-hidden="true"></p>
                </div>
            </div>

            <div class="browser__external browser__external--hidden" id="browser-external">
                <iframe class="browser__external-frame" id="browser-external-frame" title="External website preview" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>