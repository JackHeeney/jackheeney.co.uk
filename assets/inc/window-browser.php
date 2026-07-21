<div class="window window--hidden" id="window-browser" style="left:max(0px,calc(50% - 640px));top:max(0px,calc((100vh - 46px - 750px) / 2));width:1280px;height:750px;">
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
                        <div class="portfolio-site__container portfolio-site__top-header-inner">
                            <div class="portfolio-site__logo">Jack Heeney</div>
                            <nav class="portfolio-site__top-nav">
                                <a href="#home" class="portfolio-site__top-nav-link portfolio-site__top-nav-link--active" data-page="home">Home</a>
                                <a href="#about" class="portfolio-site__top-nav-link" data-page="about">About</a>
                                <a href="#skills" class="portfolio-site__top-nav-link" data-page="skills">Skills</a>
                                <a href="#projects" class="portfolio-site__top-nav-link" data-page="projects">Projects</a>
                                <a href="#contact" class="portfolio-site__top-nav-link" data-page="contact">Contact</a>
                            </nav>
                        </div>
                    </header>

                    <!-- Home Page -->
                    <div class="portfolio-site__page portfolio-site__page--active" id="page-home">
                        <div class="portfolio-site__hero">
                            <?php
                            if (!function_exists('portfolio_social_icon_svg')) {
                                require_once __DIR__ . '/social-icons.php';
                            }
                            ?>
                            <div class="portfolio-site__container portfolio-site__hero-inner">
                            <div class="portfolio-site__hero-hub">
                                <div class="portfolio-site__hero-quadrant portfolio-site__hero-quadrant--tl">
                                    <div class="portfolio-site__hero-greeting">
                                        Hi 👋 I'm <span class="portfolio-site__hero-name-highlight">Jack Heeney</span>.
                                    </div>
                                    <div class="portfolio-site__hero-title">Digital Product &amp; Content Strategy</div>
                                    <p class="portfolio-site__hero-tagline">I design, build and scale digital products that improve customer experience, solve business problems and drive measurable growth.</p>
                                </div>

                                <div class="portfolio-site__hero-center">
                                    <div class="portfolio-site__hero-image">
                                        <div class="portfolio-site__hero-blob"></div>
                                        <div class="portfolio-site__hero-photo">
                                            <div class="portfolio-site__hero-photo-placeholder">👤</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="portfolio-site__hero-quadrant portfolio-site__hero-quadrant--tr">
                                    <div class="portfolio-site__hero-exp">
                                        <span class="portfolio-site__hero-exp-value">8+</span>
                                        <span class="portfolio-site__hero-exp-label">years' experience</span>
                                    </div>
                                    <div class="portfolio-site__hero-tags" aria-label="Focus areas">
                                        <span class="portfolio-site__hero-tag">Product</span>
                                        <span class="portfolio-site__hero-tag">UX</span>
                                        <span class="portfolio-site__hero-tag">Growth</span>
                                        <span class="portfolio-site__hero-tag">AI</span>
                                        <span class="portfolio-site__hero-tag">Full-Stack Development</span>
                                    </div>
                                </div>

                                <div class="portfolio-site__hero-quadrant portfolio-site__hero-quadrant--bl">
                                    <span class="portfolio-site__hero-social-label">Socials</span>
                                    <div class="portfolio-site__social" aria-label="Social links">
                                        <a href="<?php echo htmlspecialchars($linkedinUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-site__social-link" aria-label="LinkedIn"><?php echo portfolio_social_icon_svg('linkedin'); ?></a>
                                        <a href="<?php echo htmlspecialchars($facebookUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-site__social-link" aria-label="Facebook"><?php echo portfolio_social_icon_svg('facebook'); ?></a>
                                        <a href="<?php echo htmlspecialchars($instagramUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-site__social-link" aria-label="Instagram"><?php echo portfolio_social_icon_svg('instagram'); ?></a>
                                        <a href="<?php echo htmlspecialchars($githubUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-site__social-link" aria-label="GitHub"><?php echo portfolio_social_icon_svg('github'); ?></a>
                                    </div>
                                </div>

                                <div class="portfolio-site__hero-quadrant portfolio-site__hero-quadrant--br">
                                    <div class="portfolio-site__hero-actions">
                                        <button type="button" class="portfolio-site__hero-button" data-page="projects">View Projects</button>
                                        <?php if (!empty($cvDocument)) : ?>
                                            <a href="<?php echo htmlspecialchars($cvDocument['url'], ENT_QUOTES, 'UTF-8'); ?>" class="portfolio-site__hero-button portfolio-site__hero-button--secondary" download="<?php echo htmlspecialchars($cvDocument['filename'], ENT_QUOTES, 'UTF-8'); ?>">Download CV</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- About Page -->
                    <div class="portfolio-site__page" id="page-about">
                        <main class="portfolio-site__main">
                            <section class="portfolio-site__section">
                                <h2 class="portfolio-site__section-title">About Me</h2>
                                <div class="portfolio-site__about-content">
                                    <p>I'm a Digital Content Strategy, Product &amp; Growth professional with 8+ years' experience leading digital content, customer journeys and product experiences within technology-focused businesses. Throughout my career I've taken ownership of the strategy, development and continuous optimisation of websites, learning platforms, marketing content and digital products, ensuring every initiative supports measurable business objectives.</p>
                                    <p>I specialise in building content ecosystems that improve discoverability, engagement and conversion across the entire customer journey. Combining UX research, analytics, SEO, AI Optimisation (AIO), experimentation and user behaviour insights, I've delivered content strategies that improve search visibility, increase customer engagement and drive commercial growth.</p>
                                    <p>Working across Product, Marketing, Sales, Learning &amp; Development, Technical Support and leadership teams, I've aligned digital content with wider business priorities, reduced duplication, improved consistency and helped deliver scalable customer experiences. I'm comfortable coordinating stakeholders with different priorities and translating business goals into practical digital solutions.</p>
                                    <p>Alongside strategy, I'm a hands-on technical practitioner with experience using HTML, CSS, JavaScript, PHP, SQL, React and APIs. This enables me to move seamlessly between strategic planning and implementation, whether launching new digital products, optimising conversion funnels, developing internal systems or improving digital experiences through continuous iteration.</p>
                                    <p>My approach is highly data-driven. I use analytics, user research and performance insights to identify opportunities, measure impact and continually refine content and product performance. I enjoy solving complex business problems, simplifying customer journeys and building digital experiences that create measurable commercial value.</p>
                                    <p>Outside work, I enjoy strength training, hiking, mountain climbing and badminton. After nearly ten years playing rugby, I've developed a collaborative, resilient and continuously improving mindset that I bring to every project and team I work with.</p>
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
                            <!-- <section class="portfolio-site__section portfolio-site__projects-intro">
                                <h2 class="portfolio-site__section-title">Projects</h2>
                                <p class="portfolio-site__case-studies-lead">
                                    Case studies and live websites from product, growth, engineering, and creative work.
                                </p>
                            </section> -->

                            <section class="portfolio-site__section portfolio-site__external-websites">
                                <h3 class="portfolio-site__subsection-title">Live Websites</h3>
                                <p class="portfolio-site__external-websites-copy">Websites and landing pages I have worked on — open in the browser to explore:</p>
                                <div class="portfolio-site__external-websites-list">
                                    <a href="https://www.robustittraining.com/" class="portfolio-site__external-link" data-external-url="https://www.robustittraining.com/">robustittraining.com</a>
                                    <a href="https://www.skills-nest.com/" class="portfolio-site__external-link" data-external-url="https://www.skills-nest.com/">skills-nest.com</a>
                                    <a href="https://getglitchedcouk.vercel.app/" class="portfolio-site__external-link" data-external-url="https://getglitchedcouk.vercel.app/">getglitched.co.uk</a>
                                    <a href="https://bindertrader.vercel.app/" class="portfolio-site__external-link" data-external-url="https://bindertrader.vercel.app/">bindertrader.vercel.app</a>
                                    <a href="https://creatureprints3d.vercel.app/" class="portfolio-site__external-link" data-external-url="https://creatureprints3d.vercel.app/">creatureprints3d.vercel.app</a>
                                    <a href="https://squirrelsbrox.vercel.app/" class="portfolio-site__external-link" data-external-url="https://squirrelsbrox.vercel.app/">squirrelsbrox.vercel.app</a>
                                    <a href="https://azure-webinar.com/" class="portfolio-site__external-link" data-external-url="https://azure-webinar.com/">azure-webinar.com</a>
                                    <a href="https://cyber-webinar.com/" class="portfolio-site__external-link" data-external-url="https://cyber-webinar.com/">cyber-webinar.com</a>
                                    <a href="https://data-webinar.org/" class="portfolio-site__external-link" data-external-url="https://data-webinar.org/">data-webinar.org</a>
                                    <a href="https://ai-webinar.co.uk/" class="portfolio-site__external-link" data-external-url="https://ai-webinar.co.uk/">ai-webinar.co.uk</a>
                                </div>
                            </section>

                            <section class="portfolio-site__section portfolio-site__case-studies-intro">
                                <h3 class="portfolio-site__subsection-title">Case Studies</h3>
                                <p class="portfolio-site__case-studies-lead">
                                    Each write-up follows a Google-style STAR structure — Situation, Task, Action, and Result —
                                    with measurable impact, stakeholder context, and key learnings where relevant.
                                </p>
                            </section>

                            <section class="portfolio-site__section portfolio-site__case-studies-group">
                                <h4 class="portfolio-site__case-studies-group-title">Work</h4>
                                <div class="portfolio-site__case-studies-grid">
                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Digital Product + Growth</div>
                                        <h3 class="portfolio-site__case-card-title">IT Training Route Platform</h3>
                                        <p class="portfolio-site__case-card-meta">Digital Product & Growth Lead</p>
                                        <p class="portfolio-site__case-card-desc">Decision-support UX across Cloud, Cyber, Data and AI pathways to reduce ambiguity and improve enquiry quality.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-it-training-route">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Product + UX</div>
                                        <h3 class="portfolio-site__case-card-title">Customer Journey Optimisation</h3>
                                        <p class="portfolio-site__case-card-meta">Product & UX Lead</p>
                                        <p class="portfolio-site__case-card-desc">Behavioural analytics across email, landing pages, webinars and CRM to improve segmentation and funnel visibility.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-webinar-marketing">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Operations + Delivery</div>
                                        <h3 class="portfolio-site__case-card-title">Digital Operations & Cross-Department Systems Management</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Digital Product & Operations Lead</p>
                                        <p class="portfolio-site__case-card-desc">STAR: streamlined operations during restructuring while preserving revenue-critical digital work.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-digital-ops">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Education Product</div>
                                        <h3 class="portfolio-site__case-card-title">Student Training Platform UX</h3>
                                        <p class="portfolio-site__case-card-meta">Product Lead, UX Designer & Frontend Developer</p>
                                        <p class="portfolio-site__case-card-desc">Modernised the mock exam, results and revision journey to help students progress with clearer feedback and less manual support.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-mock-exam">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Education + Frontend</div>
                                        <h3 class="portfolio-site__case-card-title">SkillsNest Learning Platform Website</h3>
                                        <p class="portfolio-site__case-card-meta">Web Designer &amp; Frontend Developer</p>
                                        <p class="portfolio-site__case-card-desc">Responsive course and subscription website connecting learners with training, practice exams and a dedicated student portal.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-skills-nest">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Creative Performance</div>
                                        <h3 class="portfolio-site__case-card-title">Social Media Campaign Creative & Performance Design</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Creative Lead & Digital Designer</p>
                                        <p class="portfolio-site__case-card-desc">Produced conversion-focused social assets across webinar, paid, and organic campaign streams.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-social-creative">Open case study</button>
                                    </article>
                                </div>
                            </section>

                            <section class="portfolio-site__section portfolio-site__case-studies-group">
                                <h4 class="portfolio-site__case-studies-group-title">Friends &amp; Side Projects</h4>
                                <div class="portfolio-site__case-studies-grid">
                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Web Design + CMS</div>
                                        <h3 class="portfolio-site__case-card-title">Squirrels Nursery Website &amp; Admin Portal</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Product Designer &amp; Full-Stack Developer</p>
                                        <p class="portfolio-site__case-card-desc">Redesigned an existing nursery website around clearer parent journeys and built a secure admin portal for fast, independent content updates.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-squirrels-nursery">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">E-commerce + Frontend</div>
                                        <h3 class="portfolio-site__case-card-title">Creature Print 3D Stripe Storefront</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Product Designer &amp; Full-Stack Developer</p>
                                        <p class="portfolio-site__case-card-desc">Designed and built an owned storefront for a friend's established Etsy shop, creating a path to Stripe checkout and lower marketplace fees.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-creature-print-3d">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Brand Identity</div>
                                        <h3 class="portfolio-site__case-card-title">Deep Dissonance Podcast Brand Identity & Creative Direction</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Brand Designer & Creative Director</p>
                                        <p class="portfolio-site__case-card-desc">Created a complete visual identity system for a drum and bass podcast concept with scalable social applications.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-deep-dissonance">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Music + Events</div>
                                        <h3 class="portfolio-site__case-card-title">AudioGrooves Event Marketing, Creative Design & After-Party Content</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Graphic Designer & Marketing & Creative Lead</p>
                                        <p class="portfolio-site__case-card-desc">STAR: designed the label logo and produced event advertising, posters, social graphics, and after-party films.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-audiogrooves">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Music + Events</div>
                                        <h3 class="portfolio-site__case-card-title">Kengai Records Label Release Art, Event Creative & Social Campaigns</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Graphic Designer & Creative Lead</p>
                                        <p class="portfolio-site__case-card-desc">STAR: release artwork, event flyers, and connected Instagram carousel posts for label campaigns.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-kengai-records">Open case study</button>
                                    </article>
                                </div>
                            </section>

                            <section class="portfolio-site__section portfolio-site__case-studies-group">
                                <h4 class="portfolio-site__case-studies-group-title">Personal Projects</h4>
                                <div class="portfolio-site__case-studies-grid">
                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Product Architecture</div>
                                        <h3 class="portfolio-site__case-card-title">BinderTrader Platform Architecture & Product Development</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Founder, Product Designer, Full-Stack Developer</p>
                                        <p class="portfolio-site__case-card-desc">Designed a trade-first card platform with robust lifecycle logic, scalable backend systems, and trust-first UX.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-bindertrader">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Portfolio + Frontend</div>
                                        <h3 class="portfolio-site__case-card-title">Desktop Portfolio Website & Interactive UX Experience</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Product Designer, Frontend Developer & Creative Lead</p>
                                        <p class="portfolio-site__case-card-desc">STAR: built a Windows-style desktop portfolio with guided tours, STAR case studies, and live site previews.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-desktop-portfolio">Open case study</button>
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
                                    <h2 class="portfolio-site__case-title">Designing an IT Training Route Decision Platform</h2>
                                    <p class="portfolio-site__case-subtitle">Improving the route-selection journey across Cloud, Cyber, Data and AI pathways by helping prospective students compare options, understand outcomes and enquire with more confidence.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Product Management</span>
                                        <span class="portfolio-site__case-chip">UX Design</span>
                                        <span class="portfolio-site__case-chip">Student Journey Mapping</span>
                                        <span class="portfolio-site__case-chip">Conversion Funnel</span>
                                        <span class="portfolio-site__case-chip">Route Decision Platform</span>
                                        <span class="portfolio-site__case-chip">Behavioural UX</span>
                                        <span class="portfolio-site__case-chip">Campaign Alignment</span>
                                        <span class="portfolio-site__case-chip">Frontend Development</span>
                                        <span class="portfolio-site__case-chip">Growth Strategy</span>
                                    </div>
                                    <p class="portfolio-site__case-intro">I approached this project as a decision-support and conversion funnel challenge. Prospective students were interested in IT training, but many struggled to understand which pathway matched their goals. The aim was to reduce ambiguity, improve confidence and create a clearer journey from campaign click through to enquiry.</p>
                                </header>

                                <div class="portfolio-site__case-body">
                                    <section class="portfolio-site__case-section">
                                        <h3>The Opportunity</h3>
                                        <p>The existing journey introduced several training options but did not give users enough support when comparing Cloud, Cyber, Data and AI pathways. This created friction at a key decision point, where users needed reassurance, route clarity and outcome-focused guidance before making an enquiry.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Users needed clearer guidance on which pathway suited their goals.</li>
                                            <li>Course options needed to be easier to compare.</li>
                                            <li>Marketing campaigns needed a stronger landing journey.</li>
                                            <li>Sales needed better-quality enquiries from users with clearer intent.</li>
                                            <li>The route-selection experience needed to scale across future campaigns.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Who the Experience Needed to Support</h3>
                                        <div class="portfolio-site__insight-grid">
                                            <article class="portfolio-site__insight-card">
                                                <h4>Prospective Students</h4>
                                                <p>Needed a simple way to compare routes, understand career outcomes and choose a starting point without feeling overwhelmed.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Sales Team</h4>
                                                <p>Needed enquiries from users who had already started thinking about their goals and preferred training route.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Marketing Team</h4>
                                                <p>Needed a landing journey that connected email, paid ads, route messaging and enquiry forms.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Business</h4>
                                                <p>Needed a scalable funnel that could support multiple training pathways without creating disconnected landing pages.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Mapping the Route Decision Journey</h3>
                                        <div class="portfolio-site__journey-flow">
                                            <div class="portfolio-site__journey-row">
                                                <article class="portfolio-site__journey-card">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg></span>
                                                        <span class="portfolio-site__journey-num">1</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Campaign Click</h4>
                                                    <p class="portfolio-site__journey-question">Does the user understand what problem this page solves?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/></svg></span>
                                                        <span class="portfolio-site__journey-num">2</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Route Awareness</h4>
                                                    <p class="portfolio-site__journey-question">Can the user quickly see the main training routes available?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="18" rx="1"/><rect x="14" y="3" width="7" height="18" rx="1"/></svg></span>
                                                        <span class="portfolio-site__journey-num">3</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Pathway Comparison</h4>
                                                    <p class="portfolio-site__journey-question">Can the user compare Cloud, Cyber, Data and AI in a simple way?</p>
                                                </article>
                                            </div>
                                            <div class="portfolio-site__journey-connector portfolio-site__journey-connector--third" aria-hidden="true">
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--v"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg></span>
                                            </div>
                                            <div class="portfolio-site__journey-row portfolio-site__journey-row--snake">
                                                <article class="portfolio-site__journey-card" style="--mobile-order: 9">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
                                                        <span class="portfolio-site__journey-num">6</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Sales Follow-Up</h4>
                                                    <p class="portfolio-site__journey-question">Does the enquiry give the team enough context to have a better conversation?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h portfolio-site__journey-arrow--left" style="--mobile-order: 8" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m11 6-6 6 6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card" style="--mobile-order: 7">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2 11 13"/><path d="M22 2 15 22 11 13 2 9l20-7z"/></svg></span>
                                                        <span class="portfolio-site__journey-num">5</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Enquiry Intent</h4>
                                                    <p class="portfolio-site__journey-question">Is the user confident enough to take the next step?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h portfolio-site__journey-arrow--left" style="--mobile-order: 6" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m11 6-6 6 6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card" style="--mobile-order: 5">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg></span>
                                                        <span class="portfolio-site__journey-num">4</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Decision Support</h4>
                                                    <p class="portfolio-site__journey-question">Does the content help the user choose the best route?</p>
                                                </article>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Product Discovery &amp; UX Thinking</h3>
                                        <p>I reviewed how users moved from campaign traffic into the training route page and identified that the biggest issue was not just visual design. It was decision confidence. Users needed clearer information architecture, stronger comparison content and more reassuring calls to action before they were ready to enquire.</p>
                                        <div class="portfolio-site__insight-grid">
                                            <article class="portfolio-site__insight-card">
                                                <h4>Pathway clarity</h4>
                                                <p>Users needed to understand the difference between pathways quickly.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Decision fatigue</h4>
                                                <p>The page needed to reduce decision fatigue.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Helpful CTAs</h4>
                                                <p>CTAs needed to feel helpful, not overly sales-led.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Campaign continuity</h4>
                                                <p>Campaign messaging and landing page content needed to feel connected.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Sales context</h4>
                                                <p>The sales team benefited from users arriving with clearer route intent.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Reusable funnel</h4>
                                                <p>The funnel needed a reusable structure for future training campaigns.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Problems Identified</h3>
                                        <div class="portfolio-site__problem-grid">
                                            <article class="portfolio-site__problem-card">
                                                <h4>Too much ambiguity</h4>
                                                <p>Users were shown several IT training options but not enough guidance on how to choose between them.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Weak comparison journey</h4>
                                                <p>The experience needed clearer differences between pathways, certifications, outcomes and career routes.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Low-confidence enquiries</h4>
                                                <p>Users could enquire before fully understanding the best route, creating extra explanation work for the sales team.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Disconnected campaign flow</h4>
                                                <p>Email, ads, landing pages and enquiry forms needed to feel like one joined-up journey.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Product &amp; UX Decisions</h3>
                                        <p>I redesigned the route-selection experience around clarity, comparison and guided decision-making. The objective was not just to improve the layout, but to help users understand what each pathway meant and what action to take next.</p>
                                        <div class="portfolio-site__decision-list">
                                            <div class="portfolio-site__decision-item">
                                                <h4>Clearer pathway positioning</h4>
                                                <p>Each route was reframed around learner goals, career outcomes and certification direction.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Comparison-led content</h4>
                                                <p>The page helped users compare routes side by side instead of forcing them to interpret separate course pages.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Decision-focused CTAs</h4>
                                                <p>Calls to action were positioned around helping users choose a route, rather than immediately pushing a generic enquiry.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Joined-up funnel thinking</h4>
                                                <p>The journey connected ads, email campaigns, route selection, enquiry and sales follow-up into one clearer flow.</p>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>The Solution</h3>
                                        <p>The redesigned experience created a clearer route decision platform that helped prospective students understand their options, compare pathways and enquire with more confidence.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Reworked the information architecture around student decision-making.</li>
                                            <li>Improved pathway messaging across Cloud, Cyber, Data and AI routes.</li>
                                            <li>Created comparison-led content to reduce confusion.</li>
                                            <li>Connected landing page UX with campaign and enquiry journeys.</li>
                                            <li>Designed a more scalable structure for future pathway campaigns.</li>
                                            <li>Improved the page flow from first click to enquiry.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Product Impact</h3>
                                        <div class="portfolio-site__insight-grid">
                                            <article class="portfolio-site__insight-card">
                                                <h4>Clearer student decision-making</h4>
                                                <p>Users had a simpler way to understand which pathway best matched their goals.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Better enquiry quality</h4>
                                                <p>The sales team received enquiries from users with stronger route awareness and clearer intent.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Improved campaign alignment</h4>
                                                <p>The route page created a stronger bridge between paid ads, email campaigns and enquiry forms.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Scalable funnel foundation</h4>
                                                <p>The structure could be reused across multiple campaigns and future training pathways.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card portfolio-site__insight-card--span">
                                                <h4>Reduced ambiguity</h4>
                                                <p>The experience helped answer key questions earlier in the journey before users reached the enquiry stage.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Tools &amp; Technologies</h3>
                                        <p>GA4, GTM, MailerLite, Ahrefs, Hotjar, Microsoft Clarity, HTML, CSS, JavaScript, WordPress.</p>
                                    </section>

                                    <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                        <h3>What I Learned</h3>
                                        <p>The biggest lesson was that conversion problems are often decision problems. Users did not just need a better-looking page — they needed clearer context, comparison and reassurance before taking action. Improving the journey meant aligning UX, content, campaign messaging and sales follow-up around the same user decision.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Route clarity matters before conversion.</li>
                                            <li>Comparison-led content can reduce hesitation.</li>
                                            <li>CTAs work better when they match the user's stage of confidence.</li>
                                            <li>Campaign journeys need continuity from advert or email through to enquiry.</li>
                                            <li>Product thinking can improve both user experience and internal sales conversations.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>What I'd Do Next</h3>
                                        <ul class="portfolio-site__case-list">
                                            <li>Add route-selection analytics to track which pathways users compare most.</li>
                                            <li>Track CTA clicks by route, traffic source and user intent.</li>
                                            <li>Create personalised follow-up emails based on selected route.</li>
                                            <li>Add a guided quiz to recommend Cloud, Cyber, Data or AI pathways.</li>
                                            <li>Measure enquiry quality by route source and campaign type.</li>
                                            <li>Add heatmap analysis to identify where users hesitate or drop off.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                        <h3>Visual Showcase</h3>
                                        <p class="portfolio-site__media-hint">Select any screenshot to view it full size.</p>

                                        <div class="portfolio-site__media-subsection">
                                            <h4>Before &amp; After: Landing Page Experience</h4>
                                            <p>The previous page introduced the training offer, but the redesigned version focused more directly on helping users choose the right route.</p>
                                            <div class="portfolio-site__media-grid portfolio-site__media-grid--compare">
                                                <figure class="portfolio-site__media-figure">
                                                    <img src="assets/img/projects/route-selector/route-selector-case-study-old-landing.png" alt="Previous IT training landing page before route decision redesign" loading="lazy">
                                                    <figcaption>Previous landing page</figcaption>
                                                </figure>
                                                <figure class="portfolio-site__media-figure">
                                                    <img src="assets/img/projects/route-selector/route-selector-case-study-updated-landing.png" alt="Redesigned IT training landing page with clearer pathway positioning" loading="lazy">
                                                    <figcaption>Redesigned route decision landing page</figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                    </section>
                                </div>

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
                                    <h2 class="portfolio-site__case-title">Customer Journey Optimisation Through Behavioural Analytics</h2>
                                    <p class="portfolio-site__case-subtitle">Improving how prospective learners moved from email engagement to webinar registration, attendance and sales follow-up.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Product Thinking</span>
                                        <span class="portfolio-site__case-chip">UX Research</span>
                                        <span class="portfolio-site__case-chip">Email Segmentation</span>
                                        <span class="portfolio-site__case-chip">Behavioural Analytics</span>
                                        <span class="portfolio-site__case-chip">Funnel Optimisation</span>
                                        <span class="portfolio-site__case-chip">MailerLite</span>
                                        <span class="portfolio-site__case-chip">Zoom Webinars</span>
                                        <span class="portfolio-site__case-chip">CRM Journey Mapping</span>
                                        <span class="portfolio-site__case-chip">UTM Tracking</span>
                                    </div>
                                    <p class="portfolio-site__case-intro">I approached this project as a customer journey optimisation challenge rather than a standalone email marketing task. The goal was to understand how prospective learners moved from first campaign touchpoint through landing pages, webinar registration, attendance and CRM follow-up, then use that insight to improve segmentation, messaging and user experience across the funnel.</p>
                                </header>

                                <div class="portfolio-site__case-body">
                                    <section class="portfolio-site__case-section">
                                        <h3>The Opportunity</h3>
                                        <p>Campaign activity was generating engagement, but the full journey was difficult to understand. Email performance, webinar registration, attendance and CRM outcomes sat across separate tools, making it harder to see where users dropped off, which audiences were most engaged and which follow-up journeys were most relevant.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Email engagement alone did not explain customer intent.</li>
                                            <li>Different audiences needed more relevant messaging.</li>
                                            <li>Webinar registrations and attendance needed to be understood as part of the wider journey.</li>
                                            <li>Data existed across multiple systems rather than one connected reporting layer.</li>
                                            <li>Better segmentation could improve the relevance of information being sent.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Mapping the Customer Journey</h3>
                                        <div class="portfolio-site__journey-flow">
                                            <div class="portfolio-site__journey-row">
                                                <article class="portfolio-site__journey-card">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 7 10-7"/></svg></span>
                                                        <span class="portfolio-site__journey-num">1</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Marketing Email</h4>
                                                    <p class="portfolio-site__journey-question">Was the message relevant to this audience?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg></span>
                                                        <span class="portfolio-site__journey-num">2</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Landing Page</h4>
                                                    <p class="portfolio-site__journey-question">Did the page answer the user's questions quickly?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M19 8v6"/><path d="M22 11h-6"/></svg></span>
                                                        <span class="portfolio-site__journey-num">3</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Webinar Registration</h4>
                                                    <p class="portfolio-site__journey-question">Was the next step obvious and low friction?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg></span>
                                                        <span class="portfolio-site__journey-num">4</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Reminder Journey</h4>
                                                    <p class="portfolio-site__journey-question">Did the user receive useful information before attending?</p>
                                                </article>
                                            </div>
                                            <div class="portfolio-site__journey-connector" aria-hidden="true">
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--v"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg></span>
                                            </div>
                                            <div class="portfolio-site__journey-row portfolio-site__journey-row--snake">
                                                <article class="portfolio-site__journey-card" style="--mobile-order: 11">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg></span>
                                                        <span class="portfolio-site__journey-num">8</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Customer Decision</h4>
                                                    <p class="portfolio-site__journey-question">Was the user supported with the right next step?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h portfolio-site__journey-arrow--left" style="--mobile-order: 10" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m11 6-6 6 6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card" style="--mobile-order: 9">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
                                                        <span class="portfolio-site__journey-num">7</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Sales Conversation</h4>
                                                    <p class="portfolio-site__journey-question">Could the team understand previous intent?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h portfolio-site__journey-arrow--left" style="--mobile-order: 8" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m11 6-6 6 6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card" style="--mobile-order: 7">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14a9 3 0 0 0 18 0V5"/><path d="M3 12a9 3 0 0 0 18 0"/></svg></span>
                                                        <span class="portfolio-site__journey-num">6</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">CRM / FLG Follow-up</h4>
                                                    <p class="portfolio-site__journey-question">Was the lead source and journey visible?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h portfolio-site__journey-arrow--left" style="--mobile-order: 6" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m11 6-6 6 6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card" style="--mobile-order: 5">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"/><rect x="2" y="6" width="14" height="12" rx="2"/></svg></span>
                                                        <span class="portfolio-site__journey-num">5</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Live Webinar</h4>
                                                    <p class="portfolio-site__journey-question">Did the session build trust and explain the route clearly?</p>
                                                </article>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Research &amp; Behavioural Insight</h3>
                                        <p>I reviewed campaign performance, landing page behaviour, UTM-tagged journeys, webinar registration data and available CRM information to understand where engagement was strong and where the journey became unclear.</p>
                                        <div class="portfolio-site__insight-grid">
                                            <article class="portfolio-site__insight-card">
                                                <h4>Opens vs intent</h4>
                                                <p>Opens showed awareness, but not necessarily intent.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Clicks &amp; CTOR</h4>
                                                <p>Clicks and CTOR were stronger indicators of message relevance.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Landing page friction</h4>
                                                <p>Landing page behaviour helped expose friction, especially on mobile.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Webinar attendance</h4>
                                                <p>Webinar attendance created a stronger signal of buying intent.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card portfolio-site__insight-card--span">
                                                <h4>Attribution gaps</h4>
                                                <p>CRM attribution was limited because email, webinar and sales data were not fully connected.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Problems Identified</h3>
                                        <div class="portfolio-site__problem-grid">
                                            <article class="portfolio-site__problem-card">
                                                <h4>Generic communication</h4>
                                                <p>Large audiences could receive similar messages even when their interests, intent level or previous behaviour differed.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Journey drop-off</h4>
                                                <p>Users could engage with an email but fail to progress through the landing page or registration journey.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Limited attribution visibility</h4>
                                                <p>MailerLite, Zoom and CRM data were useful individually, but they did not provide a single end-to-end view of the customer journey.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Follow-up relevance</h4>
                                                <p>Without clearer segmentation, follow-up communication risked being less relevant to where the user actually was in their decision-making process.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>What I Changed</h3>
                                        <div class="portfolio-site__decision-list">
                                            <div class="portfolio-site__decision-item">
                                                <h4>Segmentation</h4>
                                                <p>I grouped users based on engagement behaviour, campaign interaction and intent signals so future emails could be more relevant.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Messaging</h4>
                                                <p>I adjusted email content and CTAs to focus on user questions, trust-building and clearer next steps rather than generic promotion.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Landing page experience</h4>
                                                <p>I reviewed landing page behaviour and improved page structure, CTA placement, mobile usability and clarity around the webinar journey.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Tracking</h4>
                                                <p>I used UTM-tagged links to understand which emails, CTAs and audience segments were driving visits and registrations.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Reporting</h4>
                                                <p>I reviewed MailerLite, Zoom and CRM data to understand how users moved across the journey and where the business lacked a complete view.</p>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Measuring Customer Behaviour</h3>
                                        <p>The visuals below are self-made, anonymised summaries designed for portfolio presentation. They represent the types of behavioural and campaign signals I monitored without exposing internal reports or confidential data.</p>
                                        <div class="portfolio-site__metrics-grid">
                                            <article class="portfolio-site__metric-card">
                                                <span class="portfolio-site__metric-value">99%+</span>
                                                <span class="portfolio-site__metric-label">delivery rate maintained</span>
                                            </article>
                                            <article class="portfolio-site__metric-card">
                                                <span class="portfolio-site__metric-value">~20%</span>
                                                <span class="portfolio-site__metric-label">typical CTOR across core campaign groups</span>
                                            </article>
                                            <article class="portfolio-site__metric-card">
                                                <span class="portfolio-site__metric-value">&lt;0.05%</span>
                                                <span class="portfolio-site__metric-label">typical spam complaint rate</span>
                                            </article>
                                            <article class="portfolio-site__metric-card">
                                                <span class="portfolio-site__metric-value">280k+</span>
                                                <span class="portfolio-site__metric-label">peak weekly delivered volume</span>
                                            </article>
                                        </div>
                                        <?php /* Portfolio-safe representative data, not raw company export data. */ ?>
                                        <div class="portfolio-site__chart-grid">
                                            <figure class="portfolio-site__chart-card">
                                                <figcaption>Delivered volume trend</figcaption>
                                                <svg class="portfolio-site__chart" viewBox="0 0 320 140" role="img" aria-label="Anonymised bar chart showing delivered email volume trending upward with a peak above 280 thousand per week">
                                                    <line x1="36" y1="110" x2="300" y2="110" stroke="#cbd5e1" stroke-width="1"/>
                                                    <line x1="36" y1="20" x2="36" y2="110" stroke="#cbd5e1" stroke-width="1"/>
                                                    <rect x="48" y="72" width="24" height="38" rx="3" fill="#93c5fd"/>
                                                    <rect x="80" y="58" width="24" height="52" rx="3" fill="#93c5fd"/>
                                                    <rect x="112" y="48" width="24" height="62" rx="3" fill="#93c5fd"/>
                                                    <rect x="144" y="32" width="24" height="78" rx="3" fill="#2563eb"/>
                                                    <rect x="176" y="38" width="24" height="72" rx="3" fill="#93c5fd"/>
                                                    <rect x="208" y="28" width="24" height="82" rx="3" fill="#2563eb"/>
                                                    <rect x="240" y="35" width="24" height="75" rx="3" fill="#93c5fd"/>
                                                    <rect x="272" y="42" width="24" height="68" rx="3" fill="#93c5fd"/>
                                                    <text x="60" y="126" font-size="9" fill="#64748b" text-anchor="middle">W1</text>
                                                    <text x="92" y="126" font-size="9" fill="#64748b" text-anchor="middle">W2</text>
                                                    <text x="124" y="126" font-size="9" fill="#64748b" text-anchor="middle">W3</text>
                                                    <text x="156" y="126" font-size="9" fill="#64748b" text-anchor="middle">W4</text>
                                                    <text x="188" y="126" font-size="9" fill="#64748b" text-anchor="middle">W5</text>
                                                    <text x="220" y="126" font-size="9" fill="#64748b" text-anchor="middle">W6</text>
                                                    <text x="252" y="126" font-size="9" fill="#64748b" text-anchor="middle">W7</text>
                                                    <text x="284" y="126" font-size="9" fill="#64748b" text-anchor="middle">W8</text>
                                                    <text x="8" y="34" font-size="8" fill="#64748b">280k</text>
                                                    <text x="8" y="72" font-size="8" fill="#64748b">200k</text>
                                                    <text x="8" y="110" font-size="8" fill="#64748b">120k</text>
                                                </svg>
                                            </figure>
                                            <figure class="portfolio-site__chart-card">
                                                <figcaption>Delivery rate stability</figcaption>
                                                <svg class="portfolio-site__chart" viewBox="0 0 320 140" role="img" aria-label="Anonymised line chart showing delivery rate holding steady above 99 percent">
                                                    <line x1="36" y1="110" x2="300" y2="110" stroke="#cbd5e1" stroke-width="1"/>
                                                    <line x1="36" y1="20" x2="36" y2="110" stroke="#cbd5e1" stroke-width="1"/>
                                                    <line x1="36" y1="45" x2="300" y2="45" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="4 4"/>
                                                    <polyline points="48,42 80,40 112,43 144,39 176,41 208,38 240,40 272,39" fill="none" stroke="#2563eb" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <circle cx="48" cy="42" r="3" fill="#2563eb"/>
                                                    <circle cx="144" cy="39" r="3" fill="#2563eb"/>
                                                    <circle cx="208" cy="38" r="3" fill="#2563eb"/>
                                                    <circle cx="272" cy="39" r="3" fill="#2563eb"/>
                                                    <text x="8" y="48" font-size="8" fill="#64748b">99.6%</text>
                                                    <text x="8" y="80" font-size="8" fill="#64748b">99.3%</text>
                                                    <text x="8" y="112" font-size="8" fill="#64748b">99.0%</text>
                                                    <text x="156" y="126" font-size="9" fill="#64748b" text-anchor="middle">8-week period</text>
                                                </svg>
                                            </figure>
                                            <figure class="portfolio-site__chart-card">
                                                <figcaption>CTOR by campaign group</figcaption>
                                                <svg class="portfolio-site__chart" viewBox="0 0 320 140" role="img" aria-label="Anonymised horizontal bar chart showing click-to-open rates around 20 percent for core campaign groups">
                                                    <text x="8" y="38" font-size="9" fill="#334155">Core webinars</text>
                                                    <rect x="110" y="28" width="160" height="14" rx="3" fill="#2563eb"/>
                                                    <text x="276" y="38" font-size="9" fill="#64748b">20%</text>
                                                    <text x="8" y="62" font-size="9" fill="#334155">Nurture</text>
                                                    <rect x="110" y="52" width="144" height="14" rx="3" fill="#93c5fd"/>
                                                    <text x="276" y="62" font-size="9" fill="#64748b">18%</text>
                                                    <text x="8" y="86" font-size="9" fill="#334155">Re-engagement</text>
                                                    <rect x="110" y="76" width="176" height="14" rx="3" fill="#2563eb"/>
                                                    <text x="276" y="86" font-size="9" fill="#64748b">22%</text>
                                                    <text x="8" y="110" font-size="9" fill="#334155">Sales follow-up</text>
                                                    <rect x="110" y="100" width="120" height="14" rx="3" fill="#93c5fd"/>
                                                    <text x="276" y="110" font-size="9" fill="#64748b">15%</text>
                                                </svg>
                                            </figure>
                                            <figure class="portfolio-site__chart-card">
                                                <figcaption>Spam complaint rate</figcaption>
                                                <svg class="portfolio-site__chart" viewBox="0 0 320 140" role="img" aria-label="Anonymised bar chart showing spam complaint rates below 0.05 percent">
                                                    <line x1="36" y1="110" x2="300" y2="110" stroke="#cbd5e1" stroke-width="1"/>
                                                    <line x1="36" y1="20" x2="36" y2="110" stroke="#cbd5e1" stroke-width="1"/>
                                                    <rect x="56" y="98" width="22" height="12" rx="2" fill="#93c5fd"/>
                                                    <rect x="92" y="96" width="22" height="14" rx="2" fill="#93c5fd"/>
                                                    <rect x="128" y="94" width="22" height="16" rx="2" fill="#93c5fd"/>
                                                    <rect x="164" y="97" width="22" height="13" rx="2" fill="#93c5fd"/>
                                                    <rect x="200" y="95" width="22" height="15" rx="2" fill="#93c5fd"/>
                                                    <rect x="236" y="96" width="22" height="14" rx="2" fill="#93c5fd"/>
                                                    <rect x="272" y="98" width="22" height="12" rx="2" fill="#93c5fd"/>
                                                    <text x="8" y="50" font-size="8" fill="#64748b">0.05%</text>
                                                    <text x="8" y="80" font-size="8" fill="#64748b">0.03%</text>
                                                    <text x="8" y="110" font-size="8" fill="#64748b">0.01%</text>
                                                    <text x="164" y="126" font-size="9" fill="#64748b" text-anchor="middle">Weekly sends</text>
                                                </svg>
                                            </figure>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Benchmarking Performance</h3>
                                        <p>To make the metrics meaningful, I compared the anonymised campaign indicators against common email marketing benchmark ranges.</p>
                                        <div class="portfolio-site__benchmark-grid">
                                            <article class="portfolio-site__benchmark-card">
                                                <div class="portfolio-site__benchmark-card-head">
                                                    <span class="portfolio-site__benchmark-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-6l-2 3H10l-2-3H2"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg></span>
                                                    <div class="portfolio-site__benchmark-card-titles">
                                                        <h4 class="portfolio-site__benchmark-metric">Delivery rate</h4>
                                                        <span class="portfolio-site__benchmark-value">99%+</span>
                                                    </div>
                                                </div>
                                                <div class="portfolio-site__benchmark-range">
                                                    <span class="portfolio-site__benchmark-range-label">Common benchmark</span>
                                                    <span class="portfolio-site__benchmark-range-text">95%+ often considered strong</span>
                                                </div>
                                                <p class="portfolio-site__benchmark-insight"><span class="portfolio-site__benchmark-insight-icon" aria-hidden="true">✓</span> Sender reputation was protected</p>
                                            </article>
                                            <article class="portfolio-site__benchmark-card">
                                                <div class="portfolio-site__benchmark-card-head">
                                                    <span class="portfolio-site__benchmark-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M15 15l-2 5L9 9l11 4-5 2z"/><path d="M22 22 2 2"/></svg></span>
                                                    <div class="portfolio-site__benchmark-card-titles">
                                                        <h4 class="portfolio-site__benchmark-metric">CTOR</h4>
                                                        <span class="portfolio-site__benchmark-value">~20%</span>
                                                    </div>
                                                </div>
                                                <div class="portfolio-site__benchmark-range">
                                                    <span class="portfolio-site__benchmark-range-label">Common benchmark</span>
                                                    <span class="portfolio-site__benchmark-range-text">10–25% commonly seen across marketing campaigns</span>
                                                </div>
                                                <p class="portfolio-site__benchmark-insight"><span class="portfolio-site__benchmark-insight-icon" aria-hidden="true">✓</span> Openers were engaging with the content</p>
                                            </article>
                                            <article class="portfolio-site__benchmark-card">
                                                <div class="portfolio-site__benchmark-card-head">
                                                    <span class="portfolio-site__benchmark-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span>
                                                    <div class="portfolio-site__benchmark-card-titles">
                                                        <h4 class="portfolio-site__benchmark-metric">Spam complaints</h4>
                                                        <span class="portfolio-site__benchmark-value">&lt;0.05%</span>
                                                    </div>
                                                </div>
                                                <div class="portfolio-site__benchmark-range">
                                                    <span class="portfolio-site__benchmark-range-label">Common benchmark</span>
                                                    <span class="portfolio-site__benchmark-range-text">Under 0.1% generally considered healthy</span>
                                                </div>
                                                <p class="portfolio-site__benchmark-insight"><span class="portfolio-site__benchmark-insight-icon" aria-hidden="true">✓</span> List quality and relevance were maintained</p>
                                            </article>
                                            <article class="portfolio-site__benchmark-card">
                                                <div class="portfolio-site__benchmark-card-head">
                                                    <span class="portfolio-site__benchmark-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg></span>
                                                    <div class="portfolio-site__benchmark-card-titles">
                                                        <h4 class="portfolio-site__benchmark-metric">CTR</h4>
                                                        <span class="portfolio-site__benchmark-value portfolio-site__benchmark-value">1-3%</span>
                                                    </div>
                                                </div>
                                                <div class="portfolio-site__benchmark-range">
                                                    <span class="portfolio-site__benchmark-range-label">Common benchmark</span>
                                                    <span class="portfolio-site__benchmark-range-text">2–5% often considered a good range</span>
                                                </div>
                                                <p class="portfolio-site__benchmark-insight"><span class="portfolio-site__benchmark-insight-icon" aria-hidden="true">✓</span> Click rate needed to be interpreted by audience warmth and intent</p>
                                            </article>
                                        </div>
                                        <p class="portfolio-site__benchmark-note">Benchmarks are indicative and vary by industry, list quality, audience intent and campaign type.</p>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>The Bigger Product Insight</h3>
                                        <p>The most important discovery was that the journey could not be fully understood from one system. Email engagement, webinar attendance, CRM activity and commercial outcomes existed across separate tools. This made it difficult to answer product and marketing questions such as which audience converted best, which webinar journeys created the strongest intent, and where follow-up should be prioritised.</p>
                                        <aside class="portfolio-site__callout">
                                            <p>This revealed an opportunity for a unified <strong>Marketing Intelligence Dashboard</strong> that could connect MailerLite, Zoom and CRM data into one view of the customer journey.</p>
                                        </aside>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Outcome</h3>
                                        <p>The project improved the way campaign performance was understood. Instead of treating emails as isolated sends, the work reframed email activity as part of a wider product journey involving segmentation, behavioural signals, landing page UX, webinar attendance and CRM follow-up.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Improved understanding of user behaviour across the webinar journey.</li>
                                            <li>Created more structured segmentation for campaign planning.</li>
                                            <li>Used engagement data to make follow-up communication more relevant.</li>
                                            <li>Maintained strong deliverability and low complaint rates during high-volume campaign activity.</li>
                                            <li>Identified a larger reporting gap that led to the concept for a Marketing Intelligence Dashboard.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                        <h3>What I'd Do Next</h3>
                                        <p>If continuing this project, I would prioritise a connected reporting layer that combines email engagement, webinar behaviour, CRM progression and revenue outcomes. This would make it easier to understand the complete customer journey and support better product, marketing and sales decisions.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Build a unified attribution dashboard.</li>
                                            <li>Track journey stages from email click to webinar attendance and CRM outcome.</li>
                                            <li>Segment audiences by intent level and course interest.</li>
                                            <li>Create automated follow-up journeys based on behaviour.</li>
                                            <li>Use dashboard insights to guide future landing page and campaign experiments.</li>
                                        </ul>
                                    </section>

                                    <?php /* Related project: Marketing Intelligence Dashboard — route pending (case-study-marketing-intelligence-dashboard)
                                    <section class="portfolio-site__case-section">
                                        <h3>Related Project</h3>
                                        <article class="portfolio-site__related-card">
                                            <h4>Marketing Intelligence Dashboard</h4>
                                            <p>This customer journey work exposed a larger reporting opportunity: a dashboard that connects campaign engagement, webinar attendance and CRM outcomes into a single marketing intelligence layer.</p>
                                            <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-marketing-intelligence-dashboard">View Dashboard Project</button>
                                        </article>
                                    </section>
                                    */ ?>
                                </div>

                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-digital-ops">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-skills-nest">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Work Project</p>
                                    <h2 class="portfolio-site__case-title">SkillsNest Learning Platform Website</h2>
                                    <p class="portfolio-site__case-subtitle">A responsive education-commerce experience that brings course discovery, certification practice, subscription pricing and student access into one clear journey.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Web Designer + Frontend Developer</span>
                                        <span class="portfolio-site__case-chip">Focus: education + subscriptions</span>
                                        <span class="portfolio-site__case-chip">Delivery: responsive light + dark UI</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>SkillsNest needed a public-facing home for a broad training catalogue spanning professional soft skills, IT courses and certification practice exams, with a clear route into its separate learning portal.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>Create a coherent, responsive website that could communicate the breadth of the library, explain the subscription model, establish learner trust and guide visitors toward courses, pricing or student login.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>Designed a modular page system around oversized gradient typography, structured course cards, practice-exam features, learner testimonials, subscription steps, pricing comparisons and FAQs. Light and dark themes preserve the same visual language while supporting different viewing preferences.</p>
                                        <p>Built connected homepage, catalogue, pricing and individual-course experiences, using reusable content patterns and prominent calls to action to keep course exploration and subscription decisions easy to follow.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>Delivered a live, content-rich learning website that presents courses and practice exams in a consistent brand system, makes plan differences easy to compare and connects prospective and existing students to the right next step.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Key Experience Features</h3>
                                    <ul class="portfolio-site__case-list">
                                        <li>Filterable course catalogue and detailed individual-course pages.</li>
                                        <li>Practice-exam showcase and subscription plan comparisons.</li>
                                        <li>Social proof, FAQs and a simple three-step subscription journey.</li>
                                        <li>Responsive light and dark themes with a consistent gradient-led identity.</li>
                                        <li>Direct routes to course exploration, pricing, affiliates and student login.</li>
                                    </ul>
                                    <p><a href="https://www.skills-nest.com/" class="portfolio-site__external-link" data-external-url="https://www.skills-nest.com/">Explore the live SkillsNest website</a></p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                    <h3>What I Learned</h3>
                                    <p>A large learning catalogue needs more than strong visuals: visitors need repeated orientation points that clarify what is available, how access works and whether an individual course or library subscription is the right next step.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any screenshot to view it full size.</p>
                                    <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                        <?php
                                        $skillsNestScreens = [
                                            ['01.png', 'Homepage hero in dark mode', 'SkillsNest homepage hero, navigation and scrolling course catalogue in dark mode'],
                                            ['02.png', 'Learning statistics and partners', 'SkillsNest partner logos and learning platform statistics'],
                                            ['03.png', 'Learning portal preview', 'Gradient-framed preview of the SkillsNest student learning portal'],
                                            ['04.png', 'Featured practice exams', 'Featured certification practice exam cards'],
                                            ['05.png', 'Student testimonials', 'SkillsNest student testimonial wall'],
                                            ['06.png', 'Subscription process', 'Three-step SkillsNest subscription process'],
                                            ['07.png', 'Homepage pricing', 'SkillsNest Mock, Course and Full Library subscription cards'],
                                            ['08.png', 'FAQs and trial call to action', 'SkillsNest FAQ accordion, portal video and free-trial call to action'],
                                            ['09.png', 'Soft skills course page', 'Ten Soft Skills You Need course page hero'],
                                            ['10.png', 'Course inclusions', 'Course statistics covering video, case studies, modules, resources and certificate'],
                                            ['11.png', 'Course curriculum', 'Locked module list for the soft skills course'],
                                            ['12.png', 'Course pricing options', 'Subscription pricing options on an individual course page'],
                                            ['13.png', 'Homepage in light mode', 'SkillsNest homepage hero and course ticker in light mode'],
                                            ['14.png', 'Course catalogue', 'SkillsNest filterable course catalogue in light mode'],
                                            ['15.png', 'Plans and pricing page', 'SkillsNest plans and pricing page in light mode'],
                                        ];
                                        foreach ($skillsNestScreens as [$file, $caption, $alt]) :
                                        ?>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/skills-nest/<?php echo htmlspecialchars($file, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($alt, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                                                <figcaption><?php echo htmlspecialchars($caption, ENT_QUOTES, 'UTF-8'); ?></figcaption>
                                            </figure>
                                        <?php endforeach; ?>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-squirrels-nursery">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-squirrels-nursery">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Friends &amp; Side Project</p>
                                    <h2 class="portfolio-site__case-title">Squirrels Nursery Website &amp; Admin Portal</h2>
                                    <p class="portfolio-site__case-subtitle">A complete redesign of an existing nursery website, pairing a professional, child-friendly public experience with a secure content platform the nursery team can update themselves.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Product Designer + Full-Stack Developer</span>
                                        <span class="portfolio-site__case-chip">Focus: information architecture + content operations</span>
                                        <span class="portfolio-site__case-chip">Delivery: responsive website + secure CMS</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>The nursery's existing website made important information difficult for parents to find, and its forms were causing problems. Routine updates also depended on another person, so publishing time-sensitive information could be slow.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>Redesign the full public experience to feel professional, clean, child-friendly and visibly high quality, while giving the nursery team direct control over the information families rely on.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I rebuilt the information architecture around the questions and actions parents need most: learning and care, fees, menus, nursery guidance, visits and applications. I created clear desktop and mobile navigation, focused calls to action and purpose-built contact and application forms.</p>
                                        <p>I also designed and developed a secure admin portal where authorised staff can publish alerts, maintain the rotating food menu, write formatted news posts and knowledge-base guides, upload accessible gallery images, schedule content and manage publishing workflows.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>Delivered a responsive, high-quality digital presence that makes nursery information easier to discover and gives staff a much faster route from an operational update to published parent-facing content. The same system now connects alerts, menus, news, guides and gallery content across the admin and public website.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools &amp; Technologies</h3>
                                    <p>Next.js, React, TypeScript, Supabase, PostgreSQL, secure authentication, role-based content management, rich-text editing, responsive UX, accessible form design, image management, SEO and Vercel.</p>
                                    <p><a href="https://squirrelsbrox.vercel.app/" class="portfolio-site__external-link" data-external-url="https://squirrelsbrox.vercel.app/">Explore the live Squirrels Nursery website</a></p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                    <h3>Client Handover</h3>
                                    <p>After completing the build, I created a 12-page owner presentation to explain what the new website can do, show how admin updates appear to families, outline publishing roles and safeguards, and leave the nursery with a practical monthly maintenance routine.</p>
                                    <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/squirrels-nursery/owner-handover-presentation-cover.jpg" alt="Cover of the Squirrels Nursery website owner handover presentation" loading="lazy">
                                            <figcaption>Website owner presentation — created for the client after delivery</figcaption>
                                        </figure>
                                        <p class="portfolio-site__media-pdf-action">
                                            <button type="button" class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-pdf-url="assets/img/projects/squirrels-nursery/owner-handover-presentation.pdf" data-pdf-name="Squirrels Nursery Website Owner Presentation">Open the client handover PDF</button>
                                        </p>
                                    </div>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                    <h3>What I Learned</h3>
                                    <p>A successful redesign has to improve the organisation behind the website as well as the pages visitors see. Giving staff safe, structured publishing tools means clearer information for parents and less delay whenever the nursery needs to communicate.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any screenshot to view it full size.</p>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Secure content management</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <?php
                                            $squirrelsAdminScreens = [
                                                ['01.png', 'Admin dashboard', 'Squirrels Nursery secure admin dashboard with publishing shortcuts and recent content'],
                                                ['02.png', 'Publishing an alert', 'Admin form for creating and scheduling an important nursery alert'],
                                                ['04.png', 'Food menu management', 'Admin interface for maintaining the nursery three-week food menu and allergens'],
                                                ['06.png', 'Rich news editor', 'Rich text editor for writing, formatting and scheduling nursery news'],
                                                ['08.png', 'Knowledge-base management', 'Published parent guides managed from the secure knowledge base'],
                                                ['09.png', 'Creating a parent guide', 'Admin editor for a searchable parent knowledge-base guide'],
                                                ['12.png', 'Accessible gallery upload', 'Gallery upload form with alternative text, caption, credit and publishing controls'],
                                            ];
                                            foreach ($squirrelsAdminScreens as [$file, $caption, $alt]) :
                                            ?>
                                                <figure class="portfolio-site__media-figure">
                                                    <img src="assets/img/projects/squirrels-nursery/<?php echo htmlspecialchars($file, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($alt, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                                                    <figcaption><?php echo htmlspecialchars($caption, ENT_QUOTES, 'UTF-8'); ?></figcaption>
                                                </figure>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Connected parent-facing content</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <?php
                                            $squirrelsContentScreens = [
                                                ['03.png', 'Live alert on the homepage', 'Nursery homepage displaying a newly published important alert'],
                                                ['05.png', 'Three-week food menu', 'Parent-facing food menu with daily meals and listed allergens'],
                                                ['07.png', 'Published news story', 'Formatted nursery news story published from the admin editor'],
                                                ['10.png', 'Searchable knowledge hub', 'Parent knowledge hub with categories, search and practical nursery guides'],
                                                ['11.png', 'Permanent parent guidance', 'Detailed fees and funded childcare guide with sharing and print tools'],
                                                ['13.png', 'Nursery gallery', 'Public nursery gallery displaying an uploaded image with caption and credit'],
                                            ];
                                            foreach ($squirrelsContentScreens as [$file, $caption, $alt]) :
                                            ?>
                                                <figure class="portfolio-site__media-figure">
                                                    <img src="assets/img/projects/squirrels-nursery/<?php echo htmlspecialchars($file, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($alt, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                                                    <figcaption><?php echo htmlspecialchars($caption, ENT_QUOTES, 'UTF-8'); ?></figcaption>
                                                </figure>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Before and after the redesign</h4>
                                        <p class="portfolio-site__media-hint">The original homepage used a narrow, visually busy layout with fragmented content and competing navigation. The rebuild creates a clearer hierarchy around the information and actions parents need most.</p>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--compare">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/squirrels-nursery/before-homepage.png" alt="Original Squirrels Nursery homepage before the redesign, with a narrow multi-coloured layout and dense navigation" loading="lazy">
                                                <figcaption>Before — original nursery homepage</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/squirrels-nursery/14.png" alt="Redesigned Squirrels Nursery homepage with a clear hero, parent journeys and high-quality responsive visual system" loading="lazy">
                                                <figcaption>After — redesigned homepage</figcaption>
                                            </figure>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>High-quality public experience</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <?php
                                            $squirrelsPublicScreens = [
                                                ['15.png', 'About the nursery', 'About page describing the nursery, Ofsted result and areas of focus'],
                                                ['16.png', 'Learning and care', 'Learning and care landing page with structured routes into key information'],
                                                ['17.png', 'News and menus', 'Nursery news landing page with latest story and food-menu route'],
                                                ['19.png', 'Contact journey', 'Contact page with easy-to-find details and a structured enquiry form'],
                                                ['20.png', 'Application journey', 'Online nursery application form for child, parent and preferred-hours details'],
                                            ];
                                            foreach ($squirrelsPublicScreens as [$file, $caption, $alt]) :
                                            ?>
                                                <figure class="portfolio-site__media-figure">
                                                    <img src="assets/img/projects/squirrels-nursery/<?php echo htmlspecialchars($file, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($alt, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                                                    <figcaption><?php echo htmlspecialchars($caption, ENT_QUOTES, 'UTF-8'); ?></figcaption>
                                                </figure>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Responsive mobile design</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--compare">
                                            <figure class="portfolio-site__media-figure portfolio-site__media-figure--mobile">
                                                <img src="assets/img/projects/squirrels-nursery/21.png" alt="Responsive Squirrels Nursery homepage on a mobile screen" loading="lazy">
                                                <figcaption>Mobile homepage</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure portfolio-site__media-figure--mobile">
                                                <img src="assets/img/projects/squirrels-nursery/22.png" alt="Mobile navigation drawer with grouped nursery information" loading="lazy">
                                                <figcaption>Mobile navigation</figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-creature-print-3d">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-creature-print-3d">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 9</p>
                                    <h2 class="portfolio-site__case-title">Creature Print 3D Stripe Storefront</h2>
                                    <p class="portfolio-site__case-subtitle">Designed and built an immersive, independent e-commerce experience for a friend's established Etsy store, giving the business a path toward an owned Stripe storefront with lower marketplace fees.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Product Designer + Full-Stack Developer</span>
                                        <span class="portfolio-site__case-chip">Project: friend + side project</span>
                                        <span class="portfolio-site__case-chip">Focus: brand, e-commerce, Stripe</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>A friend's Creature Print 3D business had built an audience and strong review history on Etsy, but marketplace fees and platform dependence limited how much control the store had over its customer experience and future growth.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>As a side project, I set out to turn the store's reptile-keeping expertise and 3D-printed products into a distinctive owned website that could support direct Stripe payments without losing the trust, product discovery, or personality established on Etsy.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I designed a highly visual brand experience around real habitats, keeper knowledge, and product-in-use photography. The site combines cinematic storytelling, responsive product discovery, category and animal filters, customer proof, and detailed craft messaging.</p>
                                        <p>I built the storefront as a modern responsive web app, created reusable product and navigation patterns, and developed the Stripe-ready commerce flow so the business can move toward direct ownership of checkout and customer relationships.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>Delivered a polished live storefront that gives Creature Print 3D an independent home beyond Etsy, communicates the specialist value behind the products, and establishes the foundation for direct Stripe sales with fewer marketplace costs.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools &amp; Technologies</h3>
                                    <p>Next.js, React, TypeScript, responsive CSS, Stripe Checkout, product catalogue architecture, Vercel, UX design, visual direction, and e-commerce content strategy.</p>
                                    <p><a href="https://creatureprints3d.vercel.app/" class="portfolio-site__external-link" data-external-url="https://creatureprints3d.vercel.app/">Explore the live Creature Print 3D website</a></p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                    <h3>What I Learned</h3>
                                    <p>Moving a marketplace business toward its own storefront is not just a checkout migration. The independent site has to replace Etsy's built-in discovery and trust signals with stronger product storytelling, proof, navigation, and brand confidence.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any screenshot to view it full size.</p>
                                    <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                        <?php
                                        $creaturePrintScreens = [
                                            ['01.png', 'Homepage hero', 'Creature Print 3D homepage with immersive habitat photography and collection call to action'],
                                            ['02.png', 'Keeper-led story', 'Homepage section explaining that products are designed by experienced animal keepers'],
                                            ['03.png', 'Animal care meets 3D design', 'Brand story connecting animal care with 3D product design'],
                                            ['04.png', 'Real-habitat product testing', 'Product testing message shown alongside a mushroom tortoise hide'],
                                            ['05.png', 'Collection transition', 'Homepage transition into the creature favourites product collection'],
                                            ['06.png', 'Featured product storytelling', 'Cinematic featured section for the mushroom tortoise hide'],
                                            ['07.png', 'Customer review', 'Large-format verified Etsy customer review'],
                                            ['08.png', 'Newsletter and footer', 'Collection call to action, keeper notes signup and footer'],
                                            ['09.png', 'Our Craft hero', 'Our Craft page hero showing the 3D printing workshop and habitat setting'],
                                            ['10.png', 'Keeper-first process', 'Our Craft process section pairing keeper knowledge with product design'],
                                            ['11.png', 'Packaging story', 'Packaging section explaining thoughtful fulfilment choices'],
                                            ['12.png', 'Reviews overview', 'Reviews page with Etsy rating, review count and order proof'],
                                            ['13.png', 'Review card', 'Customer review card and store performance figures'],
                                            ['14.png', 'Responsive review layout', 'Wide review presentation on the dark green brand canvas'],
                                            ['15.png', 'Product catalogue', 'Filterable product catalogue with animal categories, search, sorting and price control'],
                                        ];
                                        foreach ($creaturePrintScreens as [$file, $caption, $alt]) :
                                        ?>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/creature-print-3d/<?php echo htmlspecialchars($file, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($alt, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                                                <figcaption><?php echo htmlspecialchars($caption, ENT_QUOTES, 'UTF-8'); ?></figcaption>
                                            </figure>
                                        <?php endforeach; ?>
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
                                    <p class="portfolio-site__case-kicker">Case Study 10</p>
                                    <h2 class="portfolio-site__case-title">BinderTrader Platform Architecture & Product Development</h2>
                                    <p class="portfolio-site__case-subtitle">Designed and built a trade-first platform concept for transparent, community-driven card exchanges.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Founder + Full-Stack Developer</span>
                                        <span class="portfolio-site__case-chip">Focus: architecture + trust-centric UX</span>
                                        <span class="portfolio-site__case-chip">Delivery: trade lifecycle system</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>Most existing card platforms prioritised sales over trading, while reliable inventory sync and transparent settlement states remained difficult to achieve at scale.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>As founder and lead developer, I was responsible for product architecture, trust-centric UX, database design, backend trade logic, and production deployment.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I migrated from Supabase to a PostgreSQL and Prisma stack with Docker and Next.js, then personally implemented lifecycle, ownership, settlement, and notification systems with race-condition handling.</p>
                                        <p>I designed trade-matching flows, in-app messaging, binder collections, and profile systems so users could follow trade status end to end without ambiguity.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>Established a scalable, production-ready platform foundation, reduced sync and persistence issues from the earlier architecture, and improved user trust through clearer trade status and confirmations.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>Next.js, React, TypeScript, PostgreSQL, Prisma ORM, Docker, Vercel, Auth.js, HTML, CSS, JavaScript.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                    <h3>What I Learned</h3>
                                    <p>Trust in marketplaces is a product problem as much as a technical one — explicit state transitions and reliable data ownership matter more than feature breadth early on.</p>
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
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-desktop-portfolio">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-digital-ops">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 3</p>
                                    <h2 class="portfolio-site__case-title">Operational Systems Mapping &amp; Digital Capability Protection</h2>
                                    <p class="portfolio-site__case-subtitle">Mapping cross-department workflows to separate routine operational overhead from specialist digital work linked to marketing, CRM, UX, automation and revenue-supporting systems.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Product Operations</span>
                                        <span class="portfolio-site__case-chip">Systems Mapping</span>
                                        <span class="portfolio-site__case-chip">Workflow Design</span>
                                        <span class="portfolio-site__case-chip">Digital Capability</span>
                                        <span class="portfolio-site__case-chip">Stakeholder Alignment</span>
                                        <span class="portfolio-site__case-chip">Resource Prioritisation</span>
                                        <span class="portfolio-site__case-chip">CRM &amp; Automation</span>
                                        <span class="portfolio-site__case-chip">Marketing Operations</span>
                                        <span class="portfolio-site__case-chip">Business Continuity</span>
                                    </div>
                                    <p class="portfolio-site__case-intro">I approached this project as a product operations and systems-mapping challenge. During a period of business restructuring, the key issue was not simply reducing workload — it was understanding which activities were routine overhead, which were specialist digital capabilities, and which systems directly supported lead generation, customer experience and operational continuity.</p>
                                </header>

                                <div class="portfolio-site__case-body">
                                    <section class="portfolio-site__case-section">
                                        <h3>The Opportunity</h3>
                                        <p>The business needed clearer visibility of where time and effort were being spent across website updates, CRM activity, email campaigns, webinar support, reporting, automation, admin and support requests. Without a structured view of these responsibilities, it was difficult to make confident decisions about what could be automated, outsourced, reduced or retained internally.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Recurring responsibilities needed to be mapped and categorised.</li>
                                            <li>Routine admin needed separating from specialist digital work.</li>
                                            <li>Leadership needed clearer visibility of business-critical digital capabilities.</li>
                                            <li>Marketing, CRM and website work needed protecting from being treated as general admin.</li>
                                            <li>The business needed a repeatable way to prioritise work based on impact.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Who the System Needed to Support</h3>
                                        <div class="portfolio-site__insight-grid">
                                            <article class="portfolio-site__insight-card">
                                                <h4>Leadership</h4>
                                                <p>Needed a clearer view of which activities created operational value, supported revenue or created avoidable overhead.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Marketing</h4>
                                                <p>Needed continued support for campaigns, landing pages, email production, analytics and optimisation.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Support Team</h4>
                                                <p>Needed clearer boundaries between student/admin support tasks and specialist digital/product responsibilities.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Sales</h4>
                                                <p>Needed marketing and CRM systems to keep supporting lead generation, follow-up visibility and conversion activity.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card portfolio-site__insight-card--span">
                                                <h4>Business Operations</h4>
                                                <p>Needed a practical way to decide what should be retained, automated, outsourced or deprioritised.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Workflow Discovery</h3>
                                        <p>I reviewed recurring activities across departments and grouped them by business value, complexity, repeatability and dependency risk. The aim was to make invisible work visible, so decisions could be based on operational impact rather than assumptions.</p>
                                        <div class="portfolio-site__insight-grid">
                                            <article class="portfolio-site__insight-card">
                                                <h4>Automation candidates</h4>
                                                <p>Some tasks were routine and repeatable enough to automate or outsource.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Specialist capability</h4>
                                                <p>Some responsibilities required specialist knowledge of website, CRM, UX or campaign systems.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Cross-department gaps</h4>
                                                <p>Several workflows crossed departments and lacked a single clear owner.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Connected reporting</h4>
                                                <p>Reporting needed to combine multiple systems rather than relying on isolated metrics.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Undervalued digital work</h4>
                                                <p>High-impact digital work risked being undervalued when grouped with general admin.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Clearer prioritisation</h4>
                                                <p>Better categorisation made prioritisation easier during resource constraints.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Problems Identified</h3>
                                        <div class="portfolio-site__problem-grid">
                                            <article class="portfolio-site__problem-card">
                                                <h4>Invisible operational work</h4>
                                                <p>Many recurring responsibilities were happening in the background, making it difficult for stakeholders to understand the full workload.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Specialist work treated like admin</h4>
                                                <p>Website development, CRM management, email systems, analytics and automation could be misunderstood as simple support tasks rather than specialist digital capabilities.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Unclear prioritisation</h4>
                                                <p>Without a shared framework, urgent low-value requests could compete with higher-impact work linked to campaigns, conversion and customer experience.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Disconnected reporting</h4>
                                                <p>Performance visibility depended on combining website analytics, email reporting, CRM activity, heatmaps and campaign data.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Process Workflow Map</h3>
                                        <div class="portfolio-site__process-map" aria-label="Process workflow map showing how operational responsibilities were categorised">
                                            <div class="portfolio-site__process-flow">
                                                <div class="portfolio-site__process-step portfolio-site__process-step--primary">
                                                    <span class="portfolio-site__process-step-label">Operational Activities Review</span>
                                                </div>
                                                <span class="portfolio-site__process-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg></span>
                                                <div class="portfolio-site__process-step">
                                                    <span class="portfolio-site__process-step-label">All Responsibilities</span>
                                                </div>
                                                <span class="portfolio-site__process-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg></span>
                                                <div class="portfolio-site__process-step portfolio-site__process-step--decision">
                                                    <span class="portfolio-site__process-step-label">Categorisation Process</span>
                                                </div>
                                            </div>
                                            <span class="portfolio-site__process-arrow portfolio-site__process-arrow--split" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg></span>
                                            <div class="portfolio-site__process-branches">
                                                <div class="portfolio-site__process-branch">
                                                    <div class="portfolio-site__process-step portfolio-site__process-step--admin">
                                                        <span class="portfolio-site__process-step-label">Admin / Routine Tasks</span>
                                                    </div>
                                                    <span class="portfolio-site__process-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg></span>
                                                    <div class="portfolio-site__process-step portfolio-site__process-step--admin portfolio-site__process-step--outcome">
                                                        <span class="portfolio-site__process-step-label">Outsource or Automate</span>
                                                    </div>
                                                </div>
                                                <div class="portfolio-site__process-branch">
                                                    <div class="portfolio-site__process-step portfolio-site__process-step--specialist">
                                                        <span class="portfolio-site__process-step-label">Specialist / Revenue-Supporting Tasks</span>
                                                    </div>
                                                    <span class="portfolio-site__process-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg></span>
                                                    <div class="portfolio-site__process-step portfolio-site__process-step--specialist portfolio-site__process-step--outcome">
                                                        <span class="portfolio-site__process-step-label">Retain &amp; Prioritise</span>
                                                        <span class="portfolio-site__process-step-detail">Website &bull; CRM &bull; UX &bull; Email &bull; Automation</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Product &amp; Operations Decisions</h3>
                                        <p>I created a clearer operating model by separating task types and identifying where specialist digital capabilities should be protected, where routine activity could be simplified, and where reporting could support better decision-making.</p>
                                        <div class="portfolio-site__decision-list">
                                            <div class="portfolio-site__decision-item">
                                                <h4>Categorised responsibilities</h4>
                                                <p>Grouped work into admin, support, marketing, CRM, website, automation, reporting and product-related activity.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Separated specialist capability</h4>
                                                <p>Distinguished technical and growth-related work from routine operational tasks.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Prioritised revenue-supporting systems</h4>
                                                <p>Protected activity connected to lead generation, CRM visibility, website performance, campaign production and customer experience.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Identified automation opportunities</h4>
                                                <p>Highlighted repeatable processes that could be simplified, outsourced or automated.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Improved reporting visibility</h4>
                                                <p>Connected analytics, email, CRM and campaign data so stakeholders could see performance more clearly.</p>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>The Solution</h3>
                                        <p>The output was a clearer cross-department operating view that helped separate low-value operational overhead from specialist digital activity. This created a stronger foundation for resource planning, workload prioritisation and business continuity.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Mapped recurring responsibilities across departments.</li>
                                            <li>Categorised activity by business impact and repeatability.</li>
                                            <li>Identified tasks suitable for automation or outsourcing.</li>
                                            <li>Protected specialist work linked to website, CRM, UX, email and automation.</li>
                                            <li>Created clearer visibility for leadership and stakeholders.</li>
                                            <li>Supported better prioritisation during operational change.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Product Impact</h3>
                                        <div class="portfolio-site__insight-grid">
                                            <article class="portfolio-site__insight-card">
                                                <h4>Workload clarity</h4>
                                                <p>Made recurring responsibilities easier to understand, group and prioritise.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Better resource decisions</h4>
                                                <p>Created a clearer distinction between routine tasks and specialist digital capability.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Business continuity</h4>
                                                <p>Helped protect website, CRM, marketing and automation work during operational change.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Performance visibility</h4>
                                                <p>Improved the way stakeholders could view campaign, website and CRM performance.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card portfolio-site__insight-card--span">
                                                <h4>Scalable operating model</h4>
                                                <p>Created a repeatable approach for reviewing future responsibilities and workflow changes.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Systems &amp; Tools</h3>
                                        <p>I worked across multiple digital systems to connect operational activity with performance visibility and day-to-day delivery.</p>
                                        <div class="portfolio-site__case-chips">
                                            <span class="portfolio-site__case-chip">WordPress</span>
                                            <span class="portfolio-site__case-chip">CRM systems</span>
                                            <span class="portfolio-site__case-chip">MailerLite</span>
                                            <span class="portfolio-site__case-chip">GA4</span>
                                            <span class="portfolio-site__case-chip">GTM</span>
                                            <span class="portfolio-site__case-chip">UTM tracking</span>
                                            <span class="portfolio-site__case-chip">Microsoft Clarity</span>
                                            <span class="portfolio-site__case-chip">HTML</span>
                                            <span class="portfolio-site__case-chip">CSS</span>
                                            <span class="portfolio-site__case-chip">Excel</span>
                                            <span class="portfolio-site__case-chip">Google Sheets</span>
                                            <span class="portfolio-site__case-chip">Webinar platforms</span>
                                            <span class="portfolio-site__case-chip">Stripe</span>
                                            <span class="portfolio-site__case-chip">API integrations</span>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                        <h3>What I Learned</h3>
                                        <p>The biggest lesson was that operational clarity is a product problem as much as a management problem. When responsibilities are not clearly mapped, specialist work can be undervalued and high-impact systems can be treated as routine admin. A simple workflow model helped make hidden dependencies visible and supported better decision-making.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Invisible work needs to be mapped before it can be prioritised.</li>
                                            <li>Specialist digital capability should not be grouped with routine admin.</li>
                                            <li>Workflow clarity supports better stakeholder alignment.</li>
                                            <li>Reporting matters most when it connects multiple systems.</li>
                                            <li>Resource planning improves when work is categorised by impact, not just volume.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>What I'd Do Next</h3>
                                        <ul class="portfolio-site__case-list">
                                            <li>Build a live prioritisation dashboard for recurring requests.</li>
                                            <li>Add scoring for business impact, urgency, effort and dependency risk.</li>
                                            <li>Track time spent by workflow category.</li>
                                            <li>Create SLA-style rules for support, marketing and technical requests.</li>
                                            <li>Add automation triggers for repeatable admin tasks.</li>
                                            <li>Improve reporting across CRM, email, website and campaign performance.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                        <h3>Operational Visibility Dashboard</h3>
                                        <p>The dashboard concept brought workload priorities, business impact ratings and performance visibility into one place. The aim was to help stakeholders understand which systems supported lead generation, campaign performance and customer experience.</p>
                                        <p class="portfolio-site__media-hint">Select the screenshot to view it full size.</p>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/operational-management/case-study-digital-ops-management-dashboard.png" alt="Coordination dashboard showing workload priorities, business impact ratings, and performance metrics for website traffic, email, leads, and conversion rate" loading="lazy">
                                                <figcaption>Coordination dashboard — workload priorities and performance visibility</figcaption>
                                            </figure>
                                        </div>
                                    </section>
                                </div>

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
                                    <p class="portfolio-site__case-kicker">Case Study 4</p>
                                    <h2 class="portfolio-site__case-title">Modernising the Student Training Journey Through Platform UX</h2>
                                    <p class="portfolio-site__case-subtitle">Redesigning the mock exam, revision and results experience to help students progress through training with clearer feedback, better navigation and less dependency on manual support.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Product Management</span>
                                        <span class="portfolio-site__case-chip">UX Design</span>
                                        <span class="portfolio-site__case-chip">Learning Platform</span>
                                        <span class="portfolio-site__case-chip">Student Journey Mapping</span>
                                        <span class="portfolio-site__case-chip">Mock Exam UX</span>
                                        <span class="portfolio-site__case-chip">Feedback Loops</span>
                                        <span class="portfolio-site__case-chip">Frontend Development</span>
                                        <span class="portfolio-site__case-chip">Stakeholder Discovery</span>
                                        <span class="portfolio-site__case-chip">Scalable Systems</span>
                                    </div>
                                    <p class="portfolio-site__case-intro">I approached this project as a student journey and platform modernisation challenge. The goal was to improve how learners moved through training, practice exams, revision, feedback and next-step guidance, while also reducing the operational burden on support teams, trainers and management.</p>
                                </header>

                                <div class="portfolio-site__case-body">
                                    <section class="portfolio-site__case-section">
                                        <h3>The Opportunity</h3>
                                        <p>The existing student training experience depended on disconnected tools, manual processes and unclear progression points. Students needed a clearer way to practise, review mistakes and understand their readiness, while internal teams needed a more scalable way to support learners without repeatedly explaining the same next steps manually.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Students needed clearer visibility of their progress and exam readiness.</li>
                                            <li>Mock exam feedback needed to be easier to understand and act on.</li>
                                            <li>Support teams needed fewer repetitive progression queries.</li>
                                            <li>Trainers and management needed a more consistent view of the student journey.</li>
                                            <li>The platform needed to support future growth without adding more manual admin.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Who the Platform Needed to Support</h3>
                                        <div class="portfolio-site__insight-grid">
                                            <article class="portfolio-site__insight-card">
                                                <h4>Students</h4>
                                                <p>Needed a clear, low-friction way to practise exams, review mistakes and understand what to revise next.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Support Team</h4>
                                                <p>Needed quicker access to student progress, results and common blockers so they could guide learners more efficiently.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Trainers</h4>
                                                <p>Needed students to arrive better prepared, with clearer revision history and fewer gaps caused by poor navigation or unclear feedback.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Management</h4>
                                                <p>Needed a scalable system that reduced dependency on informal knowledge, manual tracking and disconnected legacy processes.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Mapping the Student Training Journey</h3>
                                        <div class="portfolio-site__journey-flow">
                                            <div class="portfolio-site__journey-row">
                                                <article class="portfolio-site__journey-card">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M19 8v6"/><path d="M22 11h-6"/></svg></span>
                                                        <span class="portfolio-site__journey-num">1</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Enrolment</h4>
                                                    <p class="portfolio-site__journey-question">Does the student understand where to start?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg></span>
                                                        <span class="portfolio-site__journey-num">2</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Course Content</h4>
                                                    <p class="portfolio-site__journey-question">Can the student access the right learning material easily?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M9 15h6"/><path d="M9 11h6"/></svg></span>
                                                        <span class="portfolio-site__journey-num">3</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Practice / Mock Exams</h4>
                                                    <p class="portfolio-site__journey-question">Is the exam experience clear, focused and easy to navigate?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg></span>
                                                        <span class="portfolio-site__journey-num">4</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Results Review</h4>
                                                    <p class="portfolio-site__journey-question">Can the student understand what went wrong?</p>
                                                </article>
                                            </div>
                                            <div class="portfolio-site__journey-connector" aria-hidden="true">
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--v"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg></span>
                                            </div>
                                            <div class="portfolio-site__journey-row portfolio-site__journey-row--snake">
                                                <article class="portfolio-site__journey-card" style="--mobile-order: 11">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg></span>
                                                        <span class="portfolio-site__journey-num">8</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Certification Progression</h4>
                                                    <p class="portfolio-site__journey-question">Does the next step feel clear after passing readiness checks?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h portfolio-site__journey-arrow--left" style="--mobile-order: 10" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m11 6-6 6 6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card" style="--mobile-order: 9">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg></span>
                                                        <span class="portfolio-site__journey-num">7</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Exam Readiness</h4>
                                                    <p class="portfolio-site__journey-question">Is the student confident they are ready for the real exam?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h portfolio-site__journey-arrow--left" style="--mobile-order: 8" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m11 6-6 6 6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card" style="--mobile-order: 7">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg></span>
                                                        <span class="portfolio-site__journey-num">6</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Retake / Improve Score</h4>
                                                    <p class="portfolio-site__journey-question">Can the student see progress over multiple attempts?</p>
                                                </article>
                                                <span class="portfolio-site__journey-arrow portfolio-site__journey-arrow--h portfolio-site__journey-arrow--left" style="--mobile-order: 6" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m11 6-6 6 6 6"/></svg></span>
                                                <article class="portfolio-site__journey-card" style="--mobile-order: 5">
                                                    <div class="portfolio-site__journey-card-head">
                                                        <span class="portfolio-site__journey-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></span>
                                                        <span class="portfolio-site__journey-num">5</span>
                                                    </div>
                                                    <h4 class="portfolio-site__journey-title">Targeted Revision</h4>
                                                    <p class="portfolio-site__journey-question">Does the platform guide the student towards what to revise next?</p>
                                                </article>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Product Discovery &amp; Feedback</h3>
                                        <p>I gathered product requirements by observing how students, trainers and support staff interacted with the existing process. The biggest issues were not just visual design problems — they were journey problems. Students needed clearer feedback loops, support teams needed better visibility, and the business needed a platform that could scale without relying on manual explanation.</p>
                                        <div class="portfolio-site__insight-grid">
                                            <article class="portfolio-site__insight-card">
                                                <h4>Post-exam guidance</h4>
                                                <p>Students needed better guidance after completing a mock exam.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Beyond pass/fail</h4>
                                                <p>Results needed to show more than a pass/fail percentage.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Mistake clarity</h4>
                                                <p>Question review needed to make mistakes easier to understand.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Support visibility</h4>
                                                <p>Support staff needed consistent data to answer student queries.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Trainer insight</h4>
                                                <p>Trainers needed a cleaner view of where learners were struggling.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Scalable structure</h4>
                                                <p>The platform needed a scalable content structure for future courses.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Problems Identified</h3>
                                        <div class="portfolio-site__problem-grid">
                                            <article class="portfolio-site__problem-card">
                                                <h4>Unclear student progression</h4>
                                                <p>Students could complete training activity without always knowing what to do next or whether they were ready to move forward.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Weak feedback loop</h4>
                                                <p>Mock exam results gave useful information, but the experience needed to make mistakes, topic gaps and revision priorities easier to understand.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Manual support dependency</h4>
                                                <p>Support teams had to answer repeated questions that the platform could solve through clearer UX, better progress visibility and structured guidance.</p>
                                            </article>
                                            <article class="portfolio-site__problem-card">
                                                <h4>Limited scalability</h4>
                                                <p>As more courses, mocks and content were added, the platform needed a cleaner structure that could grow without becoming harder to manage.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Wireframing the Improved Experience</h3>
                                        <p>Before building the new experience, I mapped the key screens and user flows around what students needed to understand at each stage: where they were, what they had completed, what they got wrong, and what action they should take next.</p>
                                        <div class="portfolio-site__decision-list">
                                            <div class="portfolio-site__decision-item">
                                                <h4>Quiz layout</h4>
                                                <p>I simplified the quiz interface so students could focus on the question, navigate between questions, and review progress without unnecessary friction.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Question navigation</h4>
                                                <p>I added clearer question states and navigation patterns so students could move through longer mock exams with more confidence.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Results summary</h4>
                                                <p>I redesigned the results view to make performance easier to understand at a glance, including score, correct answers, incorrect answers and unanswered questions.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Per-question breakdown</h4>
                                                <p>I introduced a clearer review structure so students could see which answers were correct or incorrect and use that feedback for targeted revision.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Dark mode</h4>
                                                <p>I explored dark mode layouts to improve comfort and accessibility for longer study sessions.</p>
                                            </div>
                                            <div class="portfolio-site__decision-item">
                                                <h4>Structured case study content</h4>
                                                <p>I introduced clearer case study layouts to support scenario-based learning and revision.</p>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>The Solution</h3>
                                        <p>The redesigned experience brought mock exams, results, review flows and revision content into a more consistent platform journey. The focus was not only on making the screens look better, but on helping students understand what happened, what it meant, and what they should do next.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Redesigned quiz interface with cleaner layout and navigation.</li>
                                            <li>Improved results dashboard with clearer performance summary.</li>
                                            <li>Added per-question review to support targeted revision.</li>
                                            <li>Improved content structure for case studies and scenario-based learning.</li>
                                            <li>Designed layouts that could support multiple courses and future content.</li>
                                            <li>Reduced reliance on manual explanation by making the next steps clearer inside the platform.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                        <h3>Visual Showcase</h3>
                                        <p class="portfolio-site__media-hint">Select any screenshot to view it full size.</p>

                                        <div class="portfolio-site__media-subsection">
                                            <h4>Before &amp; After: Quiz Experience</h4>
                                            <p>The previous quiz experience was functional but did not clearly support longer exam navigation or revision behaviour. The redesigned experience focused on question clarity, progress visibility and easier review.</p>
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
                                            <h4>Before &amp; After: Results &amp; Feedback</h4>
                                            <p>The results experience was redesigned to turn exam completion into a feedback loop. Instead of simply showing a result, the new layout helped students understand performance, identify mistakes and decide what to revise next.</p>
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
                                            <h4>Structured Learning Content</h4>
                                            <p>Scenario-based case study content was structured to support deeper learning and help students apply knowledge in a more realistic context.</p>
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

                                    <section class="portfolio-site__case-section">
                                        <h3>Product Impact</h3>
                                        <div class="portfolio-site__insight-grid">
                                            <article class="portfolio-site__insight-card">
                                                <h4>Student experience</h4>
                                                <p>Clearer exam navigation, results feedback and revision guidance helped students understand what to do next.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Support efficiency</h4>
                                                <p>Better visibility and clearer self-service guidance reduced the need for repeated manual explanations.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Platform scalability</h4>
                                                <p>The improved structure created a foundation for adding more courses, mock exams and content types.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card">
                                                <h4>Learning feedback loop</h4>
                                                <p>Results became more actionable by connecting scores, incorrect answers and review behaviour.</p>
                                            </article>
                                            <article class="portfolio-site__insight-card portfolio-site__insight-card--span">
                                                <h4>Operational consistency</h4>
                                                <p>A shared platform experience helped align students, trainers, support and management around the same journey.</p>
                                            </article>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>Build &amp; Implementation</h3>
                                        <p>I worked across product planning, UX design and frontend implementation, turning platform requirements into usable screens and scalable interface patterns. The build required balancing student-facing UX with internal operational needs, ensuring that the platform could support multiple stakeholders rather than solving for one screen in isolation.</p>
                                        <div class="portfolio-site__case-chips">
                                            <span class="portfolio-site__case-chip">HTML</span>
                                            <span class="portfolio-site__case-chip">CSS</span>
                                            <span class="portfolio-site__case-chip">JavaScript</span>
                                            <span class="portfolio-site__case-chip">Responsive design</span>
                                            <span class="portfolio-site__case-chip">CMS / content structure</span>
                                            <span class="portfolio-site__case-chip">UX workflows</span>
                                            <span class="portfolio-site__case-chip">Mock exam logic</span>
                                            <span class="portfolio-site__case-chip">Results breakdown interface</span>
                                            <span class="portfolio-site__case-chip">Mobile-first layout</span>
                                            <span class="portfolio-site__case-chip">Dark mode exploration</span>
                                        </div>
                                    </section>

                                    <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                        <h3>What I Learned</h3>
                                        <p>The biggest lesson was that platform modernisation is not just about replacing old screens. It requires understanding how every stakeholder moves through the system. Student UX improvements only become truly valuable when they also support trainers, support staff and management workflows.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Clear feedback loops are essential in learning products.</li>
                                            <li>Results pages should guide action, not just report scores.</li>
                                            <li>Support teams benefit when product UX answers repeat questions.</li>
                                            <li>Scalable content structure matters as much as visual design.</li>
                                            <li>Platform UX needs to consider both front-stage student experience and back-stage operational workflows.</li>
                                        </ul>
                                    </section>

                                    <section class="portfolio-site__case-section">
                                        <h3>What I'd Do Next</h3>
                                        <p>If continuing the project, I would focus on deeper learning analytics and personalised progression journeys, helping students understand not only what they scored but how their performance changed over time.</p>
                                        <ul class="portfolio-site__case-list">
                                            <li>Add student progress dashboards across multiple attempts.</li>
                                            <li>Track topic-level weakness and recommend revision paths.</li>
                                            <li>Add trainer dashboards for cohort-level performance trends.</li>
                                            <li>Add automated readiness indicators for exam voucher release.</li>
                                            <li>Improve accessibility testing across quiz and results screens.</li>
                                            <li>Add analytics to understand where students abandon exams or revision flows.</li>
                                        </ul>
                                    </section>

                                    <?php /* Related project: Learning Platform / LMS Rebuild — route pending
                                    <section class="portfolio-site__case-section">
                                        <h3>Related Project</h3>
                                        <article class="portfolio-site__related-card">
                                            <h4>Learning Platform / LMS Rebuild</h4>
                                            <p>This platform modernisation work connects to my wider product focus on turning disconnected workflows into clearer, measurable digital journeys.</p>
                                            <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-lms-rebuild">View Project</button>
                                        </article>
                                    </section>
                                    */ ?>
                                </div>

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
                                    <p class="portfolio-site__case-kicker">Case Study 5</p>
                                    <h2 class="portfolio-site__case-title">Social Media Campaign Creative & Performance Design</h2>
                                    <p class="portfolio-site__case-subtitle">Delivered high-performing digital creative for webinar, paid social, and promotional campaign outputs.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Creative Lead + Growth Design Support</span>
                                        <span class="portfolio-site__case-chip">Focus: clarity-driven visual conversion</span>
                                        <span class="portfolio-site__case-chip">Delivery: scalable campaign assets</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>The team needed consistent creative output that balanced speed, visual quality, and conversion performance across webinar, paid social, and organic channels.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>I was responsible for campaign creative direction, mobile-first design optimisation, and brand consistency across social and landing assets.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I designed around attention hierarchy, CTA clarity, and message relevance for cybersecurity, cloud, AI, and data campaigns, then iterated layout and headline structures based on placement performance.</p>
                                        <p>I built reusable creative templates so the team could deploy assets faster without sacrificing quality.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>Achieved higher consistency across paid and organic channels, faster deployment through reusable systems, and improved readability and engagement in mobile placements.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>Adobe Creative Suite, Canva, Figma, Photoshop, Illustrator, Meta Ads, LinkedIn campaign tooling.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase portfolio-site__case-section--showcase-bento">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any image to view it full size.</p>

                                    <div class="portfolio-site__media-grid portfolio-site__media-grid--bento-2">
                                        <h4 class="portfolio-site__media-bento-heading">Campaign visual system</h4>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/social-creative/bento-grid-poster.png" alt="Bento grid poster showing a range of social campaign creative across cybersecurity, cloud, and data themes" loading="lazy">
                                            <figcaption>Campaign overview — bento grid of paid social, webinar, and promotional creative</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/Artboard%201.png" alt="Social campaign creative artboard showing paid ad layout variants" loading="lazy">
                                            <figcaption>Creative artboard — paid ad layout variants</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/Artboard%202.png" alt="Social campaign creative artboard showing headline and CTA structure tests" loading="lazy">
                                            <figcaption>Creative artboard — headline and CTA structure tests</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Webinar & story creatives</h4>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/ticket-to-your-project-management-career-story.jpg" alt="Instagram story creative promoting a project management career webinar" loading="lazy">
                                            <figcaption>Project management webinar — Instagram story creative</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/ticket-to-your-data-engineering-career-story.jpg" alt="Instagram story creative promoting a data engineering career webinar" loading="lazy">
                                            <figcaption>Data engineering webinar — Instagram story creative</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/ticket-to-your-cyber-security-story-webinar.jpg" alt="Instagram story creative promoting a cyber security career webinar" loading="lazy">
                                            <figcaption>Cyber security webinar — Instagram story creative</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/your-cloud-career-next-move-webinar-1080x1080-190526.png" alt="Square social graphic promoting a cloud career webinar with clear CTA" loading="lazy">
                                            <figcaption>Cloud career webinar — square feed creative</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/two-infinity-teddy-invite.jpg" alt="Event invitation graphic for a Two Infinity Teddy promotional session" loading="lazy">
                                            <figcaption>Two Infinity Teddy — event invitation graphic</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Cybersecurity paid social</h4>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/break-into-the-industry-cyber-security-ad-1080x1080px.jpg" alt="Paid social ad encouraging viewers to break into the cyber security industry" loading="lazy">
                                            <figcaption>Break into cyber security — paid social ad</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/cyber-security-looking-for-new-career-anon-mask-new.jpg" alt="Cyber security career ad featuring an anonymous mask motif" loading="lazy">
                                            <figcaption>New career in cyber security — anonymous mask creative</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/cyber-security-looking-for-a-new-career-anon-facebook.jpg" alt="Facebook-format cyber security career ad with anonymous mask branding" loading="lazy">
                                            <figcaption>New career in cyber security — Facebook placement</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/getglitched-instagram-1080x1080-080426-female.png" alt="Get Glitched cyber security campaign Instagram ad with female talent" loading="lazy">
                                            <figcaption>Get Glitched campaign — Instagram ad</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Infographics & career pathways</h4>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/robust-it-cybersecurity-infographic.png" alt="Robust IT cyber security career pathway infographic" loading="lazy">
                                            <figcaption>Cyber security pathway — infographic (version 1)</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/robust-it-cybersecurity-infographic-2.png" alt="Robust IT cyber security career pathway infographic, alternate layout" loading="lazy">
                                            <figcaption>Cyber security pathway — infographic (version 2)</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/data-specialist-roadmap-rocket.jpg" alt="Data specialist career roadmap infographic with rocket motif" loading="lazy">
                                            <figcaption>Data specialist roadmap — infographic</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/aws-how-to-become-a-solution-architect.png" alt="AWS solution architect career pathway social graphic" loading="lazy">
                                            <figcaption>AWS solution architect — career pathway creative</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/social-creative/magazine-cover.jpg" alt="Magazine cover layout featuring IT training career messaging" loading="lazy">
                                            <figcaption>Magazine cover — editorial-style career promotion</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Cloud & data career ads</h4>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/how-to-become-an-azure-cloud-engineer-1080x1080%20copy.jpg" alt="Paid social ad explaining how to become an Azure cloud engineer" loading="lazy">
                                            <figcaption>Azure cloud engineer — how-to career ad</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/launch-your-cloud-career-1080x1080-190526.png" alt="Launch your cloud career paid social ad with bold headline and CTA" loading="lazy">
                                            <figcaption>Launch your cloud career — paid social ad</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/next-steps-start-data-man-1080x1080-130526.png" alt="Data career next steps paid social ad featuring male talent" loading="lazy">
                                            <figcaption>Data career next steps — paid social ad</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/from-last-month-to-this-month-woman-data-1080x1080-130526.png" alt="Data career progression paid social ad featuring female talent" loading="lazy">
                                            <figcaption>Data career progression — month-on-month creative</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/you-could-earn-65k-data-1080x1080-280426.png" alt="Data career salary-led paid social ad highlighting earning potential" loading="lazy">
                                            <figcaption>Data career salary hook — £65k earning potential ad</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Seasonal promotional campaigns</h4>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/blackfriday-offer-1.jpg" alt="Black Friday promotional offer social creative" loading="lazy">
                                            <figcaption>Black Friday — promotional offer creative</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/social-creative/cyber-monday-ad-2021.jpg" alt="Cyber Monday promotional sale social ad from 2021" loading="lazy">
                                            <figcaption>Cyber Monday — promotional sale ad</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Print & out-of-home</h4>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-rows">
                                            <img src="assets/img/projects/social-creative/1080x1920-digital-ad-harlow-no-qr-scan-bus-stop.jpg" alt="Vertical digital bus stop ad for Harlow with career training messaging" loading="lazy">
                                            <figcaption>Harlow bus stop — vertical digital out-of-home ad</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-rows">
                                            <img src="assets/img/projects/social-creative/elcas-poster-steve.jpg" alt="ELCAS funding promotional poster featuring Steve" loading="lazy">
                                            <figcaption>ELCAS funding — promotional poster</figcaption>
                                        </figure>
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
                                    <p class="portfolio-site__case-kicker">Case Study 6</p>
                                    <h2 class="portfolio-site__case-title">Deep Dissonance Podcast Brand Identity & Creative Direction</h2>
                                    <p class="portfolio-site__case-subtitle">Created a complete visual identity and social direction for a drum and bass podcast concept.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Brand Designer + Creative Director</span>
                                        <span class="portfolio-site__case-chip">Focus: identity systems + scalable application</span>
                                        <span class="portfolio-site__case-chip">Delivery: logo, typography, and social concepts</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>A new drum and bass podcast concept needed to stand out in a saturated market while remaining adaptable across podcast artwork, social posts, and promotional formats.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>I was responsible for end-to-end brand identity, creative direction, and scalable social application guidance.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I led logo exploration, mood boarding, and visual language definition, then developed a dark, high-contrast system with recognisable type treatment and structured social templates.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>Delivered a complete and scalable brand identity system, established a recognisable visual language for digital channels, and created reusable templates for ongoing content production.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>Adobe Illustrator, Adobe Photoshop, Figma, typography systems, layout design and social mock-up workflows.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase portfolio-site__case-section--showcase-bento">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any image to view it full size.</p>

                                    <div class="portfolio-site__media-grid portfolio-site__media-grid--bento-2">
                                        <h4 class="portfolio-site__media-bento-heading">Brand direction mood board</h4>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/dissonance-moodboard/moodboard-1.png" alt="Deep Dissonance brand direction mood board cover slide" loading="lazy">
                                            <figcaption>Mood board cover — Jack Heeney × Deep Dissonance brand direction, 2024</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/dissonance-moodboard/moodboard-2.png" alt="Deep Dissonance logo idea exploration showing mirrored D letterforms" loading="lazy">
                                            <figcaption>Logo exploration — mirrored D letterforms and energetic-field wireframe concepts</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/dissonance-moodboard/moodboard-3.png" alt="Deep Dissonance full mood board with colour palette, typography, and social mock-ups" loading="lazy">
                                            <figcaption>Full mood board — colour palette, Source Sans 3 typography, and social post applications</figcaption>
                                        </figure>
                                        <p class="portfolio-site__media-pdf-action">
                                            <button type="button" class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-pdf-url="assets/img/projects/dissonance-moodboard/dissonance-moodboard-direction-branding.pdf" data-pdf-name="Deep Dissonance Mood Board">Open full mood board PDF</button>
                                        </p>

                                        <h4 class="portfolio-site__media-bento-heading">Logo mark</h4>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--dark-bg">
                                            <img src="assets/img/projects/dissonance-moodboard/Asset%2032.jpg" alt="Deep Dissonance logo mark, white on dark grey app icon" loading="lazy">
                                            <figcaption>Logo mark — white on dark grey app icon format</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--dark-bg">
                                            <img src="assets/img/projects/dissonance-moodboard/Asset%2033.jpg" alt="Deep Dissonance logo mark, black on white reversed" loading="lazy">
                                            <figcaption>Logo mark — black on white reversed</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--dark-bg">
                                            <img src="assets/img/projects/dissonance-moodboard/Asset%2034.jpg" alt="Deep Dissonance logo mark, white on black" loading="lazy">
                                            <figcaption>Logo mark — white on black</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--dark-bg">
                                            <img src="assets/img/projects/dissonance-moodboard/Asset%2035.jpg" alt="Deep Dissonance logo mark, black on white squircle" loading="lazy">
                                            <figcaption>Logo mark — black on white squircle</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/dissonance-moodboard/Asset%2036.jpg" alt="Deep Dissonance logo mark grayscale value range" loading="lazy">
                                            <figcaption>Logo mark — grayscale value range for flexible application</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Brand application</h4>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/dissonance-moodboard/Asset%2037.jpg" alt="Deep Dissonance brand system showing logo lockups, colour palette, and typography" loading="lazy">
                                            <figcaption>Brand system — logo lockups, colour palette, and typography direction</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/dissonance-moodboard/Asset%2038.jpg" alt="Deep Dissonance Spotify artwork and social post mock-ups" loading="lazy">
                                            <figcaption>Brand application — Spotify artwork and social post mock-ups</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/dissonance-moodboard/Asset%2039.jpg" alt="Deep Dissonance Instagram post concepts with logo and campaign messaging" loading="lazy">
                                            <figcaption>Brand application — Instagram post concepts with logo and campaign messaging</figcaption>
                                        </figure>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-audiogrooves">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-audiogrooves">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 7</p>
                                    <h2 class="portfolio-site__case-title">AudioGrooves Event Marketing, Creative Design & After-Party Content</h2>
                                    <p class="portfolio-site__case-subtitle">Designed the label logo and supported advertising, marketing, and creative production for club nights and label events.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Graphic Designer + Marketing & Creative Lead</span>
                                        <span class="portfolio-site__case-chip">Client: AudioGrooves music label</span>
                                        <span class="portfolio-site__case-chip">Delivery: logo, posters, social graphics, after-party films</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>AudioGrooves, an independent music label, needed consistent advertising and creative support to promote club nights, label showcases, and artist events — with limited in-house design capacity and tight turnaround between announcements and show dates.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>I was responsible for designing the AudioGrooves label logo and helping run event advertising and marketing alongside end-to-end creative production: event posters, promotional graphics, and after-party recap films.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I designed the AudioGrooves logo and brand mark, establishing a recognisable visual identity that carried through posters, social assets, and event collateral.</p>
                                        <p>I planned and executed paid and organic campaign workflows across social platforms, designing event posters and promotional graphics aligned to the label brand and each night's visual identity.</p>
                                        <p>I produced after-party recap videos from event footage for post-show promotion and audience retention, and built reusable templates so recurring event formats could be turned around faster without losing quality.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>Delivered a cohesive label identity from logo through to campaign creative, maintained consistent promotional output across multiple events, and extended reach beyond the night itself via after-party content.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>Adobe Photoshop, Adobe Illustrator, Adobe Premiere Pro, After Effects, Meta Ads, social campaign tooling, logo design, typography and layout systems.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase portfolio-site__case-section--showcase-bento">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any image to view it full size. Videos play inline with controls.</p>

                                    <div class="portfolio-site__media-grid portfolio-site__media-grid--bento-2">
                                        <h4 class="portfolio-site__media-bento-heading">Label logo</h4>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--dark-bg portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/audiogrooves/audio-grooves-logo-light.png" alt="AudioGrooves music label logo on a dark background" loading="lazy">
                                            <figcaption>AudioGrooves logo — primary label mark for events and digital channels</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Event posters & flyers</h4>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/audiogrooves/grooves-on-the-decks-save-the-date-75-1st-release.png" alt="Grooves on the Decks save-the-date flyer, first release" loading="lazy">
                                            <figcaption>Grooves on the Decks — save-the-date, first release</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/audiogrooves/grooves-on-the-decks-tickets-on-sale-sp1.png" alt="Grooves on the Decks tickets on sale promotional graphic" loading="lazy">
                                            <figcaption>Grooves on the Decks — tickets on sale</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/audiogrooves/grooves-on-the-terrace-part-4-comp.jpg" alt="Grooves on the Terrace Part 4 event composite poster" loading="lazy">
                                            <figcaption>Grooves on the Terrace Part 4 — composite poster</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/audiogrooves/grooves-on-the-terrace-part-4-shannon-popple.jpg" alt="Grooves on the Terrace Part 4 poster featuring Shannon Popple" loading="lazy">
                                            <figcaption>Grooves on the Terrace Part 4 — artist-led poster</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/audiogrooves/junction-26-new.jpg" alt="Junction 26 event promotional poster" loading="lazy">
                                            <figcaption>Junction 26 — event poster</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/audiogrooves/secondcity-1.jpg" alt="Secondcity event promotional poster" loading="lazy">
                                            <figcaption>Secondcity — event poster</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-rows">
                                            <img src="assets/img/projects/audiogrooves/93feeteast-lineup-full-release-a0-841x1189mm.jpg" alt="93 Feet East full lineup release poster" loading="lazy">
                                            <figcaption>93 Feet East — full lineup release</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/audiogrooves/93feet-east-blackfriday-deal.jpg" alt="93 Feet East Black Friday promotional deal graphic" loading="lazy">
                                            <figcaption>93 Feet East — Black Friday deal promo</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Social & promo graphics</h4>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/audiogrooves/audiogrooves-colours-hoxton.jpg" alt="AudioGrooves at Colours Hoxton promotional graphic" loading="lazy">
                                            <figcaption>Colours Hoxton — event promo</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/audiogrooves/colours-hoxton-press-shot-funk-cartel-1080x1080-2.jpg" alt="Funk Cartel press shot social graphic for Colours Hoxton" loading="lazy">
                                            <figcaption>Colours Hoxton — Funk Cartel press-shot social</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/audiogrooves/boomtown-settimes.png" alt="Boomtown festival set times graphic for AudioGrooves artists" loading="lazy">
                                            <figcaption>Boomtown — set times graphic</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Motion, animated flyers & after-party films</h4>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--video">
                                            <video src="assets/img/projects/audiogrooves/animated-flyer.mp4" controls preload="metadata" playsinline></video>
                                            <figcaption>Animated event flyer — motion promo for social</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--video">
                                            <video src="assets/img/projects/audiogrooves/Final_story_time.mp4" controls preload="metadata" playsinline></video>
                                            <figcaption>Instagram story — event countdown and promo</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--video portfolio-site__media-figure--span-full">
                                            <video src="assets/img/projects/audiogrooves/audio-grooves-93-aftermovie.mp4" controls preload="metadata" playsinline></video>
                                            <figcaption>93 Feet East 1st birthday — official after-party film</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--video">
                                            <video src="assets/img/projects/audiogrooves/shoreditch-summer-day-party-aftermovie.mp4" controls preload="metadata" playsinline></video>
                                            <figcaption>Shoreditch Summer Day Party — after-party recap</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--video">
                                            <video src="assets/img/projects/audiogrooves/j26-truck-stop-secondcity-aftermovie.mp4" controls preload="metadata" playsinline></video>
                                            <figcaption>Junction 26 Truck Stop w/ Secondcity — official aftermovie</figcaption>
                                        </figure>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-kengai-records">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-kengai-records">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 8</p>
                                    <h2 class="portfolio-site__case-title">Kengai Records Label Release Art, Event Creative & Social Campaigns</h2>
                                    <p class="portfolio-site__case-subtitle">Designed release artwork, event collateral, and connected Instagram carousel posts for an independent electronic music label.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Graphic Designer + Creative Lead</span>
                                        <span class="portfolio-site__case-chip">Client: Kengai Records music label</span>
                                        <span class="portfolio-site__case-chip">Delivery: release art, event flyers, social carousels</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>Kengai Records, an independent electronic music label, needed consistent creative support for artist releases and club-night promotions — with artwork, social assets, and event flyers required on tight turnarounds between announcement and release or show dates.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>I was responsible for designing label release artwork, event promotional materials, and social campaign graphics — including multi-slide Instagram connected posts that could carry longer release narratives across a single swipeable carousel.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I produced single and EP release artwork aligned to each artist's sonic identity and the Kengai visual language, from cover art through to promotional variants for streaming and social.</p>
                                        <p>I designed event flyers, save-the-date graphics, and venue-led promotional assets for label nights and showcases.</p>
                                        <p>I built connected Instagram carousel sequences — artboards designed to scroll as one continuous post — so release stories, line-ups, and event details could be communicated without cramming everything into a single frame.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>Delivered a cohesive stream of release and event creative across multiple artists and nights, with reusable carousel formats that made longer promotional stories easier to publish and browse on social.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>Adobe Photoshop, Adobe Illustrator, typography and layout systems, social asset sizing, and Instagram carousel post workflows.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase portfolio-site__case-section--showcase-bento">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Swipe through the connected Instagram carousel below. Select any other image to view it full size.</p>

                                    <div class="portfolio-site__media-grid portfolio-site__media-grid--bento-2">
                                        <h4 class="portfolio-site__media-bento-heading">Instagram connected carousel</h4>
                                        <div class="portfolio-site__insta-carousel portfolio-site__insta-carousel--span-full" data-media-carousel>
                                            <p class="portfolio-site__insta-carousel-hint">Swipe or use the arrows to scroll through connected posts — designed as one continuous Instagram carousel.</p>
                                            <div class="portfolio-site__insta-carousel-frame">
                                                <button type="button" class="portfolio-site__insta-carousel-nav portfolio-site__insta-carousel-nav--prev" data-carousel-prev aria-label="Previous slide">‹</button>
                                                <div class="portfolio-site__insta-carousel-viewport" data-carousel-viewport tabindex="0" aria-roledescription="carousel" aria-label="Kengai Records Instagram connected posts">
                                                    <div class="portfolio-site__insta-carousel-track" data-carousel-track>
                                                        <figure class="portfolio-site__insta-carousel-slide" data-carousel-slide>
                                                            <img src="assets/img/projects/kengai-records/Artboard%201.jpg" alt="Kengai Records Instagram connected post, slide 1 of 6" loading="lazy">
                                                        </figure>
                                                        <figure class="portfolio-site__insta-carousel-slide" data-carousel-slide>
                                                            <img src="assets/img/projects/kengai-records/Artboard%202.jpg" alt="Kengai Records Instagram connected post, slide 2 of 6" loading="lazy">
                                                        </figure>
                                                        <figure class="portfolio-site__insta-carousel-slide" data-carousel-slide>
                                                            <img src="assets/img/projects/kengai-records/Artboard%203.jpg" alt="Kengai Records Instagram connected post, slide 3 of 6" loading="lazy">
                                                        </figure>
                                                        <figure class="portfolio-site__insta-carousel-slide" data-carousel-slide>
                                                            <img src="assets/img/projects/kengai-records/Artboard%204.jpg" alt="Kengai Records Instagram connected post, slide 4 of 6" loading="lazy">
                                                        </figure>
                                                        <figure class="portfolio-site__insta-carousel-slide" data-carousel-slide>
                                                            <img src="assets/img/projects/kengai-records/Artboard%205.jpg" alt="Kengai Records Instagram connected post, slide 5 of 6" loading="lazy">
                                                        </figure>
                                                        <figure class="portfolio-site__insta-carousel-slide" data-carousel-slide>
                                                            <img src="assets/img/projects/kengai-records/Artboard%206.jpg" alt="Kengai Records Instagram connected post, slide 6 of 6" loading="lazy">
                                                        </figure>
                                                    </div>
                                                </div>
                                                <button type="button" class="portfolio-site__insta-carousel-nav portfolio-site__insta-carousel-nav--next" data-carousel-next aria-label="Next slide">›</button>
                                            </div>
                                            <div class="portfolio-site__insta-carousel-footer">
                                                <div class="portfolio-site__insta-carousel-dots" data-carousel-dots role="tablist" aria-label="Carousel slides"></div>
                                                <p class="portfolio-site__insta-carousel-counter" data-carousel-counter aria-live="polite">1 / 6</p>
                                            </div>
                                            <p class="portfolio-site__insta-carousel-caption">Connected Instagram carousel — multi-slide release and event announcement sequence</p>
                                        </div>

                                        <h4 class="portfolio-site__media-bento-heading">Label branding</h4>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--dark-bg">
                                            <img src="assets/img/projects/kengai-records/bonsai-kengai.png" alt="Kengai Records bonsai tree logo mark on dark background" loading="lazy">
                                            <figcaption>Kengai Records — primary bonsai logo mark</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--dark-bg">
                                            <img src="assets/img/projects/kengai-records/bonsai-kengai-red.png" alt="Kengai Records red bonsai logo variant" loading="lazy">
                                            <figcaption>Kengai Records — red logo variant for event and release campaigns</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Release artwork</h4>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/kengai-records/kengai-evergreen-rosso-artwork.jpg" alt="Evergreen Rosso single release artwork for Kengai Records" loading="lazy">
                                            <figcaption>Evergreen Rosso — single release artwork</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/kengai-records/kengai-evergreen-rosso-release.png" alt="Evergreen Rosso release promotional graphic" loading="lazy">
                                            <figcaption>Evergreen Rosso — release promo graphic</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/kengai-records/convoy-off-my-mind.png" alt="Convoy Off My Mind release artwork" loading="lazy">
                                            <figcaption>Convoy — Off My Mind release artwork</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/kengai-records/subrix-go-or-stay.png" alt="Subrix Go Or Stay release artwork" loading="lazy">
                                            <figcaption>Subrix — Go Or Stay release artwork</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/kengai-records/subrix-underground-ep.png" alt="Subrix Underground EP release artwork" loading="lazy">
                                            <figcaption>Subrix — Underground EP artwork</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/kengai-records/sephia-trajectory.png" alt="Sephia Trajectory release artwork" loading="lazy">
                                            <figcaption>Sephia — Trajectory release artwork</figcaption>
                                        </figure>

                                        <h4 class="portfolio-site__media-bento-heading">Event flyers & social promos</h4>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/kengai-records/star-of-kings-flyer.jpg" alt="Star of Kings event flyer for Kengai Records night" loading="lazy">
                                            <figcaption>Star of Kings — event flyer</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/kengai-records/house-kengai-purple.jpg" alt="House Kengai purple-themed event promotional graphic" loading="lazy">
                                            <figcaption>House Kengai — event promo</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/kengai-records/vigital-space-station.jpg" alt="Vigital Space Station event promotional graphic" loading="lazy">
                                            <figcaption>Vigital Space Station — event promo</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/kengai-records/save-the-date-morality.jpg" alt="Save the date graphic for Morality event" loading="lazy">
                                            <figcaption>Morality — save-the-date graphic</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                            <img src="assets/img/projects/kengai-records/event-insta-post.jpg" alt="Kengai Records event Instagram post graphic" loading="lazy">
                                            <figcaption>Event Instagram post — label night announcement</figcaption>
                                        </figure>
                                    </div>
                                </section>
                                <footer class="portfolio-site__case-footer">
                                    <button class="portfolio-site__case-nav-btn" data-page="projects">Back to all case studies</button>
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-creature-print-3d">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-desktop-portfolio">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 11</p>
                                    <h2 class="portfolio-site__case-title">Desktop Portfolio Website & Interactive UX Experience</h2>
                                    <p class="portfolio-site__case-subtitle">Designed and built a nostalgic Windows-style desktop portfolio that demonstrates product thinking, frontend craft, and recruiter-friendly case study storytelling.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Product Designer + Frontend Developer</span>
                                        <span class="portfolio-site__case-chip">Audience: recruiters, hiring managers, collaborators</span>
                                        <span class="portfolio-site__case-chip">Delivery: desktop UI, browser app, guided tours, STAR case studies</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>Most portfolio sites follow the same scrollable template — clean, but easy to skim past. I needed a personal site that would stand out in hiring conversations, demonstrate hands-on product and frontend skills, and present project work in a format recruiters already use when evaluating candidates.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>I set out to design and build a distinctive portfolio experience: a nostalgic desktop metaphor that feels playful without sacrificing clarity, with structured STAR case studies, live website previews, document access, and onboarding for first-time visitors.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I conceived a Windows XP-inspired desktop with login screen, Bliss wallpaper, draggable windows, taskbar, and Start menu — mapping portfolio content to familiar desktop affordances (projects in the browser, CV in My Files, contact via desktop icons).</p>
                                        <p>I built a modular window system in vanilla JavaScript and PHP, including a browser app that hosts the portfolio site, STAR case study pages with visual showcases, and iframe previews of live client websites.</p>
                                        <p>I designed two guided tour layers: a Clippy assistant that walks visitors across the desktop column by column, and an in-browser tour that explains navigation controls without breaking immersion.</p>
                                        <p>I added interactive touches — Snake and Space Invaders mini-games, OSRS hiscores, sticky notes — to showcase frontend capability and personality, while keeping core hiring content one click away.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>Delivered a memorable, self-contained portfolio product that doubles as a skills demonstration: UX design, frontend engineering, content structure, and attention to hiring-manager workflows in one cohesive experience.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>HTML, CSS, JavaScript, PHP, responsive layout, window management UI, local storage, iframe embedding, and UX prototyping workflows.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                    <h3>What I Learned</h3>
                                    <p>Nostalgia only works when it serves a job — every desktop icon and window had to map to a clear portfolio goal, or the concept would have been a gimmick instead of a usable product.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any screenshot to view it full size.</p>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Desktop experience</h4>
                                        <div class="portfolio-site__media-grid">
                                            <figure class="portfolio-site__media-figure portfolio-site__media-figure--span-full">
                                                <img src="assets/img/projects/desktop-portfolio/desktop-homepage.png" alt="Windows XP-style desktop portfolio with Bliss wallpaper, desktop icons, taskbar, and Clippy welcome prompt" loading="lazy">
                                                <figcaption>Homepage — Bliss wallpaper, desktop icons, taskbar, and Clippy onboarding</figcaption>
                                            </figure>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Clippy guided tour</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/desktop-portfolio/clippy-ui-ux-improvement.png" alt="Clippy assistant welcome dialog with Show me around and Next tip buttons" loading="lazy">
                                                <figcaption>Clippy welcome — nostalgic assistant UI with clear primary and secondary actions</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/desktop-portfolio/how-to-use-the-site-tours.png" alt="Clippy tour highlighting the About Me desktop icon with Open About Me action" loading="lazy">
                                                <figcaption>Column-by-column tour — highlights each desktop icon with contextual actions</figcaption>
                                            </figure>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Browser app & in-window tours</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/desktop-portfolio/guided-tours.png" alt="Portfolio browser welcome tour step 1 of 6 explaining window controls" loading="lazy">
                                                <figcaption>In-browser tour — six-step guide to portfolio navigation and controls</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/desktop-portfolio/view-real-websites-ive-made-via-our-desktop-browser-window.png" alt="Desktop browser window previewing data-webinar.org live website" loading="lazy">
                                                <figcaption>Live site previews — client websites open inside the desktop browser window</figcaption>
                                            </figure>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>STAR case studies</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/desktop-portfolio/case-studies-using-star-method.png" alt="Case study page using STAR format for Student Training Portal project" loading="lazy">
                                                <figcaption>STAR structure — Situation, Task, Action, Result with role and stakeholder chips</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/desktop-portfolio/more-casae-study-view.png" alt="Case study visual showcase with before and after quiz layout comparison" loading="lazy">
                                                <figcaption>Visual showcase — lightbox-ready screenshots with before/after comparisons</figcaption>
                                            </figure>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Interactive extras & documents</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/desktop-portfolio/distraction-games-a-bit-of-fun-and-showcase-skills.png" alt="Snake Game and Space Invaders windows open on the desktop portfolio" loading="lazy">
                                                <figcaption>Mini-games — playable Snake and Space Invaders to demonstrate frontend interactivity</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/desktop-portfolio/view-my-cv.png" alt="My Files window displaying Jack Heeney CV PDF on the desktop" loading="lazy">
                                                <figcaption>CV access — downloadable résumé via the My Files desktop window</figcaption>
                                            </figure>
                                        </div>
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
                <button type="button" class="portfolio-site__lightbox-close" data-lightbox-close aria-label="Close">×</button>
                <div class="portfolio-site__lightbox-panel" role="dialog" aria-modal="true" aria-labelledby="portfolio-site-lightbox-caption">
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

    <div class="browser-tour browser-tour--hidden" id="browser-tour" aria-hidden="true">
        <div class="browser-tour__scrim browser-tour__scrim--hidden" id="browser-tour-scrim">
            <div class="browser-tour__shade browser-tour__shade--top" id="browser-tour-shade-top"></div>
            <div class="browser-tour__shade browser-tour__shade--left" id="browser-tour-shade-left"></div>
            <div class="browser-tour__shade browser-tour__shade--right" id="browser-tour-shade-right"></div>
            <div class="browser-tour__shade browser-tour__shade--bottom" id="browser-tour-shade-bottom"></div>
        </div>
        <div class="browser-tour__ring browser-tour__ring--hidden" id="browser-tour-ring"></div>
        <div class="browser-tour__popover" id="browser-tour-popover" role="dialog" aria-live="polite" aria-labelledby="browser-tour-message">
            <button type="button" class="browser-tour__popover-close" aria-label="Close tour">×</button>
            <p class="browser-tour__message" id="browser-tour-message"></p>
            <div class="browser-tour__actions">
                <button type="button" class="browser-tour__btn browser-tour__btn--skip">Skip tour</button>
                <button type="button" class="browser-tour__btn browser-tour__btn--next browser-tour__btn--primary">Next</button>
            </div>
            <p class="browser-tour__step-indicator" id="browser-tour-step"></p>
        </div>
    </div>

    <button type="button" class="browser-tour__help" id="browser-tour-help" aria-label="How to use this browser" title="How to use this browser">i</button>
</div>
