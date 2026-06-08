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
                                        <div class="portfolio-site__case-card-tag">Marketing Systems</div>
                                        <h3 class="portfolio-site__case-card-title">Webinar Marketing System & Email Campaign Optimisation</h3>
                                        <p class="portfolio-site__case-card-meta">Role: Marketing Strategy & Campaign Lead</p>
                                        <p class="portfolio-site__case-card-desc">STAR: diagnosed mobile funnel drop-off and improved webinar registrations without extra ad spend.</p>
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
                                    <h2 class="portfolio-site__case-title">Webinar Marketing System & Email Campaign Optimisation</h2>
                                    <p class="portfolio-site__case-subtitle">Improving email marketing performance and webinar registrations without increasing ad spend.</p>
                                    <div class="portfolio-site__case-chips">
                                        <span class="portfolio-site__case-chip">Role: Marketing Strategy & Campaign Lead</span>
                                        <span class="portfolio-site__case-chip">Metrics: CTR, registrations, funnel drop-off</span>
                                        <span class="portfolio-site__case-chip">Problem-solving: mobile conversion gap</span>
                                    </div>
                                </header>
                                <div class="portfolio-site__case-star">
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">S</span> Situation</h3>
                                        <p>Open rates across several webinar campaigns remained strong, but click-through and registration rates were inconsistent, limiting overall lead generation performance.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">T</span> Task</h3>
                                        <p>I was responsible for identifying the cause of the conversion drop and improving webinar registrations without increasing advertising spend.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">A</span> Action</h3>
                                        <p>I analysed campaign performance using MailerLite, Google Analytics, UTM tracking, and Microsoft Clarity. I segmented audiences based on engagement behaviour and discovered that a large proportion of traffic was reaching the landing page on mobile devices but failing to progress.</p>
                                        <p>I redesigned the landing page structure, improved mobile usability, simplified the call-to-action flow, and implemented A/B tests on email messaging and CTA placement. I also introduced behavioural segmentation for follow-up campaigns.</p>
                                    </section>
                                    <section class="portfolio-site__case-section portfolio-site__case-section--star">
                                        <h3 class="portfolio-site__case-star-heading"><span class="portfolio-site__case-star-letter">R</span> Result</h3>
                                        <p>Registration conversion rates improved, engagement became more consistent across campaigns, and the business gained clearer visibility into where prospects were dropping out of the funnel. The improvements created a repeatable optimisation process that could be applied across future campaigns.</p>
                                    </section>
                                </div>
                                <section class="portfolio-site__case-section">
                                    <h3>Tools & Technologies</h3>
                                    <p>MailerLite, GA4, GTM, UTM tracking, Microsoft Clarity, HTML email development, CRM systems, Excel, Google Sheets.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--learned">
                                    <h3>What I Learned</h3>
                                    <p>Strong open rates can mask downstream failure — tracking the full journey from email click to registration exposed problems assumptions alone would have missed.</p>
                                </section>
                                <section class="portfolio-site__case-section portfolio-site__case-section--showcase">
                                    <h3>Visual Showcase</h3>
                                    <p class="portfolio-site__media-hint">Select any screenshot to view it full size.</p>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Email metrics — before optimisation</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/webinar-marketing/case-study-email-marketing-low-stats-1.png" alt="MailerLite campaign stats: 22.47% opened, 0.21% clicked" loading="lazy">
                                                <figcaption>Campaign A — high opens, minimal clicks</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/webinar-marketing/case-study-email-marketing-low-stats-2.png" alt="MailerLite campaign stats: 2.28% opened, 0.14% clicked" loading="lazy">
                                                <figcaption>Campaign B — low engagement across the funnel</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/webinar-marketing/case-study-email-marketing-low-stats-3.png" alt="MailerLite campaign stats: 1.1% opened, 0.09% clicked" loading="lazy">
                                                <figcaption>Campaign C — click rate below 0.1%</figcaption>
                                            </figure>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Email metrics — after optimisation</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/webinar-marketing/case-study-email-marketing-high-stats-1.png" alt="MailerLite campaign stats after optimisation: 72.54% opened, 3.75% clicked" loading="lazy">
                                                <figcaption>Campaign A — click rate improved to 3.75%</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/webinar-marketing/case-study-email-marketing-high-stats-2.png" alt="MailerLite campaign stats after optimisation: 35.56% opened, 2.32% clicked" loading="lazy">
                                                <figcaption>Campaign B — stronger opens and clicks</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/webinar-marketing/case-study-email-marketing-high-stats-3.png" alt="MailerLite campaign stats after optimisation: 62.66% opened, 3.18% clicked" loading="lazy">
                                                <figcaption>Campaign C — 3.18% click rate on 41k recipients</figcaption>
                                            </figure>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Email creative</h4>
                                        <div class="portfolio-site__media-grid portfolio-site__media-grid--stacked">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/webinar-marketing/case-study-email-template-design-webinars.png" alt="Webinar invitation email template for a Data career live session with headline, event details, and multiple CTAs" loading="lazy">
                                                <figcaption>Webinar email — invitation layout with event details and CTA flow</figcaption>
                                            </figure>
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/webinar-marketing/sales-email.png" alt="Promotional sales email layout with bundle offer and primary CTA" loading="lazy">
                                                <figcaption>Sales email — offer-led layout and CTA hierarchy</figcaption>
                                            </figure>
                                        </div>
                                    </div>

                                    <div class="portfolio-site__media-subsection">
                                        <h4>Funnel design</h4>
                                        <div class="portfolio-site__media-grid">
                                            <figure class="portfolio-site__media-figure">
                                                <img src="assets/img/projects/webinar-marketing/mailer-funnels.png" alt="MailerLite automation workflow: trigger on route selector click, customer segment check, timed delays, and still-deciding nurture email" loading="lazy">
                                                <figcaption>Behavioural nurture funnel — segmenting non-customers for follow-up after route selector engagement</figcaption>
                                            </figure>
                                        </div>
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

            <button type="button" class="browser-tour__help" id="browser-tour-help" aria-label="How to use this browser" title="How to use this browser">i</button>
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
</div>