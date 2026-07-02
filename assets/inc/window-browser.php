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
                                    Each write-up follows a Google-style STAR structure — Situation, Task, Action, and Result —
                                    with measurable impact, stakeholder context, and key learnings where relevant.
                                </p>
                            </section>

                            <section class="portfolio-site__section">
                                <div class="portfolio-site__case-studies-grid">
                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Digital Product + Growth</div>
                                        <h3 class="portfolio-site__case-card-title">IT Training Route Decision Platform & Conversion Funnel</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Digital Product & Growth Lead</p>
                                        <p class="portfolio-site__case-card-desc">STAR: clarified Cloud, Cyber, Data, and AI pathways to reduce confusion and improve enquiry quality.</p>
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
                                        <p class="portfolio-site__case-card-desc">STAR: streamlined operations during restructuring while preserving revenue-critical digital work.</p>
                                        <button class="portfolio-site__case-card-btn" data-page="case-study-digital-ops">Open case study</button>
                                    </article>

                                    <article class="portfolio-site__case-card">
                                        <div class="portfolio-site__case-card-tag">Education Product</div>
                                        <h3 class="portfolio-site__case-card-title">Student Training Portal & Platform Modernisation</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Product Lead, UX Designer, Frontend Developer</p>
                                        <p class="portfolio-site__case-card-desc">STAR: led cross-functional delivery of a scalable student platform replacing legacy manual processes.</p>
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
                                    <h2 class="portfolio-site__case-title">IT Training Route Decision Platform & Conversion Funnel</h2>
                                    <p class="portfolio-site__case-subtitle">Product and UX improvement across Cloud, Cyber, Data, and AI training pathways.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Digital Product & Growth Lead</span>
                                        <span class="portfolio-site__case-chip">Stakeholders: sales, marketing, content, development</span>
                                        <span class="portfolio-site__case-chip">Scale: full ad-to-enquiry journey</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>Prospective students were struggling to understand the differences between Cloud, Cyber, Data, and AI training pathways, leading to confusion and lower conversion rates.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>I was responsible for improving the user journey and helping visitors identify the most suitable pathway.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I redesigned the information architecture, created clearer pathway positioning, simplified navigation, and introduced comparison content focused on outcomes, certifications, and career opportunities.</p>
                                        <p>I worked across content, UX design, development, and marketing functions to ensure a consistent experience from advertisement through to enquiry.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>Users were able to navigate the pathways more easily, reducing confusion and improving the quality of enquiries received by the sales team.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>GA4, GTM, MailerLite, Ahrefs, Hotjar, Microsoft Clarity, HTML, CSS, JavaScript, WordPress.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                    <h3>What I Learned</h3>
                                    <p>Conversion gains came from resolving ambiguity early — comparison-led content and cross-functional alignment mattered as much as layout changes.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any screenshot to view it full size.</p>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Training landing pages</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--compare">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/route-selector/route-selector-case-study-old-landing.png" alt="Previous IT training landing page before route decision redesign" loading="lazy">
                                                <figcaption>Previous landing page</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/route-selector/route-selector-case-study-updated-landing.png" alt="Redesigned IT training landing page with clearer pathway positioning" loading="lazy">
                                                <figcaption>Redesigned landing page</figcaption>
                                            </figure>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Route decision funnel</h4>
                                        <div class="portfolio-site__media-grid">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/route-selector/route-selector-case-study-funnel.png" alt="IT training route decision funnel guiding visitors from pathway choice to enquiry" loading="lazy">
                                                <figcaption>Pathway decision and enquiry funnel</figcaption>
                                            </figure>
                                        </div>
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
                                    <p class="portfolio-site__case-subtitle">Taking ownership during business restructuring to protect revenue-critical digital capabilities.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Digital Product & Operations Lead</span>
                                        <span class="portfolio-site__case-chip">Stakeholders: leadership, marketing, support</span>
                                        <span class="portfolio-site__case-chip">Impact: resource allocation clarity</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>The company entered a restructuring period due to financial pressures, requiring departments to reduce operational costs while maintaining service levels.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>My responsibility was to identify which operational processes could be streamlined or automated while ensuring that key marketing, website, and digital product functions continued to support revenue generation.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I conducted a review of recurring operational tasks, identified lower-value administrative activities, and separated them from specialist technical responsibilities such as website development, CRM management, automation, email production, and digital product work.</p>
                                        <p>I documented workflows, proposed outsourcing opportunities where appropriate, and developed a revised role structure focused on higher-impact activities directly connected to lead generation and customer experience.</p>
                                        <p>In parallel, I implemented consistent tracking using Google Analytics, UTM parameters, email reporting, heatmaps, and CRM reporting — building processes that combined multiple data sources so decisions were based on performance, not assumptions.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>The company gained a clearer understanding of which activities generated business value versus administrative overhead. This enabled more informed decision-making around resource allocation while preserving critical marketing and digital capabilities. Stakeholders also gained better visibility into marketing performance, enabling faster optimisation and more effective budget allocation.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>WordPress, CRM systems, MailerLite, GA4, GTM, UTM tracking, Microsoft Clarity, HTML, CSS, Excel, Google Sheets, webinar platforms, Stripe, API integrations.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                    <h3>What I Learned</h3>
                                    <p>During uncertainty, clarity beats volume — separating high-impact work from overhead helped leadership make defensible choices without sacrificing growth infrastructure.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any screenshot to view it full size.</p>
                                    <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/operational-management/case-study-digital-ops-management-workflow-map.png" alt="Process workflow map showing how operational responsibilities were reviewed, categorised, and split between outsource or automate and retain and prioritise" loading="lazy">
                                            <figcaption>Process workflow map — responsibility review and categorisation</figcaption>
                                        </figure>
                                        <figure class="portfolio-site__media-figure">
                                            <img src="assets/img/projects/operational-management/case-study-digital-ops-management-dashboard.png" alt="Coordination dashboard showing workload priorities, business impact ratings, and performance metrics for website traffic, email, leads, and conversion rate" loading="lazy">
                                            <figcaption>Coordination dashboard — workload priorities and performance visibility</figcaption>
                                        </figure>
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
                                    <h2 class="portfolio-site__case-title">Student Training Portal & Platform Modernisation</h2>
                                    <p class="portfolio-site__case-subtitle">Cross-functional leadership to replace legacy student processes with a scalable learning platform.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Product Lead + Frontend Developer</span>
                                        <span class="portfolio-site__case-chip">Stakeholders: students, trainers, support, management</span>
                                        <span class="portfolio-site__case-chip">Scale: organisation-wide student experience</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>The company relied on multiple disconnected systems and manual processes to manage student training progression.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>I identified an opportunity to improve the student experience and reduce administrative workload through a modern learning platform — including mock exams, results, and structured revision content.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I led the planning and development of the platform, defining requirements across students, support teams, trainers, and management stakeholders.</p>
                                        <p>I designed workflows, developed functionality, managed technical implementation, and modernised the exam experience with clearer navigation, mobile-first question flows, results breakdowns, and scalable content structure.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>The organisation gained a scalable platform capable of supporting future growth while reducing dependency on legacy processes and improving the overall student experience.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>HTML, CSS, JavaScript, responsive design methods, UX design workflows, CMS and content systems.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                    <h3>What I Learned</h3>
                                    <p>Platform success depended on aligning every stakeholder’s workflow upfront — student UX improvements only scaled once support and delivery teams could operate within the same system.</p>
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
                                    <p class="portfolio-site__case-kicker">Case Study 7</p>
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
                                    <p class="portfolio-site__case-kicker">Case Study 8</p>
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
                                    <p class="portfolio-site__case-kicker">Case Study 9</p>
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
                                    <button class="portfolio-site__case-nav-btn portfolio-site__case-nav-btn--primary" data-page="case-study-desktop-portfolio">Next case study</button>
                                </footer>
                            </article>
                        </main>
                    </div>

                    <div class="portfolio-site__page" id="page-case-study-desktop-portfolio">
                        <main class="portfolio-site__main">
                            <article class="portfolio-site__case-study">
                                <header class="portfolio-site__case-hero">
                                    <p class="portfolio-site__case-kicker">Case Study 10</p>
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