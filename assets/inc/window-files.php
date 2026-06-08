<?php
if (!function_exists('portfolio_get_documents')) {
    require_once __DIR__ . '/docs-helper.php';
}
if (!function_exists('portfolio_get_project_images')) {
    require_once __DIR__ . '/images-helper.php';
}
$documents = portfolio_get_documents();
$images = portfolio_get_project_images();
$imagesByFolder = portfolio_get_project_images_by_folder();
?>
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
                <h3>My Images <span class="files__count">(<?php echo count($images); ?>)</span></h3>
            </div>
            <div class="files__table">
                <div class="files__table-row files__table-row--head">
                    <span>Name</span><span>Type</span>
                </div>
                <?php if (empty($images)) : ?>
                    <p class="docs-list__empty">No images in assets/img/projects yet.</p>
                <?php else : ?>
                    <?php $isFirstFolder = true; ?>
                    <?php foreach ($imagesByFolder as $folder => $folderImages) : ?>
                        <div class="files__table-folder<?php echo $isFirstFolder ? ' files__table-folder--first' : ''; ?>">
                            <?php echo htmlspecialchars($folder, ENT_QUOTES, 'UTF-8'); ?>
                            <span class="files__table-folder-count"><?php echo count($folderImages); ?></span>
                        </div>
                        <?php foreach ($folderImages as $image) : ?>
                            <button
                                class="files__table-row"
                                data-image-url="<?php echo htmlspecialchars($image['url'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-image-name="<?php echo htmlspecialchars($image['name'], ENT_QUOTES, 'UTF-8'); ?>">
                                <span><span class="files__icon">🖼️</span><?php echo htmlspecialchars(basename($image['filename']), ENT_QUOTES, 'UTF-8'); ?></span>
                                <span>Image File</span>
                            </button>
                        <?php endforeach; ?>
                        <?php $isFirstFolder = false; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
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
                <?php if (empty($documents)) : ?>
                    <p class="docs-list__empty">No documents in this folder yet.</p>
                <?php else : ?>
                    <?php foreach ($documents as $doc) : ?>
                        <div
                            class="doc"
                            data-pdf-url="<?php echo htmlspecialchars($doc['url'], ENT_QUOTES, 'UTF-8'); ?>"
                            data-pdf-name="<?php echo htmlspecialchars($doc['name'], ENT_QUOTES, 'UTF-8'); ?>"
                        >
                            <h3><?php echo htmlspecialchars($doc['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p><?php echo htmlspecialchars($doc['filename'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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