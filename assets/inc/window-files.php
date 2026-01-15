<div class="window window--hidden" id="window-files" style="left:280px;top:150px;width:700px;height:460px;">
    <div class="window__titlebar" data-app-drag>
        <div class="window__title">My Files</div>
        <div class="window__controls">
            <button class="window__btn window__btn--min">–</button>
            <button class="window__btn window__btn--close">×</button>
        </div>
    </div>
    <div class="window__body files">
        <!-- MAIN -->
        <div class="files__view files__view--main files__view--active">
            <h2>My Files</h2>
            <div class="files__buttons">
                <button class="files__button" data-files-view-target="videos">
                    <span class="files__button-icon">🎬</span>
                    <span>My Videos</span>
                </button>
                <button class="files__button" data-files-view-target="images">
                    <span class="files__button-icon">🖼️</span>
                    <span>My Images</span>
                </button>
                <button class="files__button" data-files-view-target="docs">
                    <span class="files__button-icon">📄</span>
                    <span>My Documents</span>
                </button>
            </div>
        </div>

        <!-- VIDEOS LIST -->
        <div class="files__view files__view--videos">
            <div class="files__header">
                <button class="files__back" data-files-back>Main</button>
                <h3>My Videos</h3>
            </div>
            <div class="files__table">
                <div class="files__table-row files__table-row--head">
                    <span>Name</span><span>Type</span>
                </div>
                <button class="files__table-row"
                    data-video-url="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4"
                    data-video-name="Project Demo.mp4">
                    <span><span class="files__icon">🎬</span>Project Demo.mp4</span>
                    <span>Video File</span>
                </button>
                <button class="files__table-row"
                    data-video-url="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4"
                    data-video-name="Presentation.mp4">
                    <span><span class="files__icon">🎥</span>Presentation.mp4</span>
                    <span>Video File</span>
                </button>
            </div>
        </div>

        <!-- VIDEO PLAYER -->
        <div class="files__view files__view--video-player">
            <div class="files__header">
                <button class="files__back" data-files-back="videos">← Back to Videos</button>
                <h3 id="files-video-title">Video</h3>
            </div>
            <video id="files-video-player" controls></video>
        </div>

        <!-- IMAGES LIST -->
        <div class="files__view files__view--images">
            <div class="files__header">
                <button class="files__back" data-files-back>Main</button>
                <h3>My Images</h3>
            </div>
            <div class="files__table">
                <div class="files__table-row files__table-row--head">
                    <span>Name</span><span>Type</span>
                </div>
                <button class="files__table-row"
                    data-image-url="https://via.placeholder.com/400x300/3b82f6/ffffff?text=Profile+Photo"
                    data-image-name="Profile.jpg">
                    <span><span class="files__icon">🖼️</span>Profile.jpg</span>
                    <span>Image File</span>
                </button>
                <button class="files__table-row"
                    data-image-url="https://via.placeholder.com/400x300/8b5cf6/ffffff?text=Project+Screenshot"
                    data-image-name="Project Screenshot.png">
                    <span><span class="files__icon">🖼️</span>Project Screenshot.png</span>
                    <span>Image File</span>
                </button>
                <button class="files__table-row"
                    data-image-url="https://via.placeholder.com/400x300/ec4899/ffffff?text=Design+Mockup"
                    data-image-name="Design Mockup.jpg">
                    <span><span class="files__icon">🖼️</span>Design Mockup.jpg</span>
                    <span>Image File</span>
                </button>
            </div>
        </div>

        <!-- IMAGE VIEWER -->
        <div class="files__view files__view--image-viewer">
            <div class="files__header">
                <button class="files__back" data-files-back="images">← Back to Images</button>
                <h3 id="files-image-title">Image</h3>
            </div>
            <img id="files-image-viewer" src="" alt="Preview" />
        </div>

        <!-- DOCS -->
        <div class="files__view files__view--docs">
            <div class="files__header">
                <button class="files__back" data-files-back>Main</button>
                <h3>My Documents</h3>
            </div>
            <div class="docs-list">
                <!-- Replace the PDF URLs below with your actual PDF file URLs -->
                <!-- Option 1: Direct PDF URL (if hosted on your server): -->
                <!-- data-pdf-url="https://yourdomain.com/path/to/cv.pdf" -->
                <!-- Option 2: Using PDF.js viewer (for external URLs or CORS issues): -->
                <!-- data-pdf-url="https://mozilla.github.io/pdf.js/web/viewer.html?file=YOUR_PDF_URL" -->
                <div class="doc" data-pdf-url="https://mozilla.github.io/pdf.js/web/viewer.html?file=https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf" data-pdf-name="CV">
                    <h3>CV</h3>
                    <p>CV.pdf</p>
                </div>
                <div class="doc" data-pdf-url="https://mozilla.github.io/pdf.js/web/viewer.html?file=https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf" data-pdf-name="Resume">
                    <h3>Resume</h3>
                    <p>Resume.pdf</p>
                </div>
                <div class="doc" data-pdf-url="https://mozilla.github.io/pdf.js/web/viewer.html?file=https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf" data-pdf-name="Cover Letter">
                    <h3>Cover Letter</h3>
                    <p>Cover Letter.pdf</p>
                </div>
            </div>
        </div>

        <!-- PDF VIEWER -->
        <div class="files__view files__view--pdf-viewer">
            <div class="files__header">
                <button class="files__back" data-files-back="docs">← Back to Documents</button>
                <h3 id="files-pdf-title">PDF Document</h3>
            </div>
            <iframe id="files-pdf-viewer" src="" frameborder="0"></iframe>
        </div>
    </div>
</div>