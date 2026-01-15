<div class="window window--hidden" id="window-contact" style="left:320px;top:110px;width:480px;height:340px;">
    <div class="window__titlebar" data-app-drag>
        <div class="window__title">Contact</div>
        <div class="window__controls">
            <button class="window__btn window__btn--min">–</button>
            <button class="window__btn window__btn--close">×</button>
        </div>
    </div>
    <div class="window__body">
        <h2>Get in touch</h2>
        <form class="contact-form" id="contact-form">
            <div class="contact-form__group">
                <label class="contact-form__label" for="contact-name">Name</label>
                <input type="text" id="contact-name" name="name" class="contact-form__input" required>
            </div>
            <div class="contact-form__group">
                <label class="contact-form__label" for="contact-email">Email</label>
                <input type="email" id="contact-email" name="email" class="contact-form__input" required>
            </div>
            <div class="contact-form__group">
                <label class="contact-form__label" for="contact-subject">Subject</label>
                <input type="text" id="contact-subject" name="subject" class="contact-form__input" required>
            </div>
            <div class="contact-form__group">
                <label class="contact-form__label" for="contact-message">Message</label>
                <textarea id="contact-message" name="message" class="contact-form__textarea" required></textarea>
            </div>
            <button type="submit" class="contact-form__button">Send Message</button>
            <div class="contact-form__message" id="contact-message"></div>
        </form>
        <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #e5e7eb;">
            <div style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Or reach me directly</div>
            <div class="contact-grid">
                <div>
                    <div class="contact-label">Email</div>
                    <a href="mailto:<?php echo htmlspecialchars($emailAddress); ?>" class="contact-link"><?php echo htmlspecialchars($emailAddress); ?></a>
                </div>
                <div>
                    <div class="contact-label">LinkedIn</div>
                    <a href="<?php echo htmlspecialchars($linkedinUrl); ?>" target="_blank" class="contact-link">View Profile</a>
                </div>
                <div>
                    <div class="contact-label">GitHub</div>
                    <a href="<?php echo htmlspecialchars($githubUrl); ?>" target="_blank" class="contact-link">View Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>