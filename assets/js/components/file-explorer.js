
/* --------------------------- File Explorer --------------------------- */

const FileExplorer = (() => {
    let filesWindow = null;
    let showView = null;

    function openPdf(url, name) {
        if (!filesWindow || !showView) return;

        const pdfTitle = document.getElementById("files-pdf-title");
        const pdfViewer = document.getElementById("files-pdf-viewer");
        if (!pdfTitle || !pdfViewer) return;

        pdfTitle.textContent = name;
        pdfViewer.src = url;
        showView("pdf-viewer");
    }

    function init() {
        filesWindow = document.getElementById("window-files");
        if (!filesWindow) return;

        const views = filesWindow.querySelectorAll(".files__view");

        showView = (name) => {
            views.forEach(v => v.classList.remove("files__view--active"));
            const target = filesWindow.querySelector(`.files__view--${name}`);
            if (target) target.classList.add("files__view--active");
        };

        // main buttons
        filesWindow.querySelectorAll("[data-files-view-target]").forEach(btn => {
            btn.addEventListener("click", () => showView(btn.dataset.filesViewTarget));
        });

        // back buttons
        filesWindow.querySelectorAll("[data-files-back]").forEach(btn => {
            btn.addEventListener("click", () => {
                const to = btn.getAttribute("data-files-back");
                if (to === "videos") return showView("videos");
                if (to === "images") return showView("images");
                if (to === "docs") return showView("docs");
                showView("main");
            });
        });

        // video list
        const videoTitle = document.getElementById("files-video-title");
        const videoPlayer = document.getElementById("files-video-player");
        filesWindow.querySelectorAll(".files__view--videos .files__table-row[data-video-url]").forEach(row => {
            row.addEventListener("click", () => {
                const src = row.dataset.videoUrl;
                const name = row.dataset.videoName;
                videoTitle.textContent = name;
                videoPlayer.src = src;
                videoPlayer.currentTime = 0;
                videoPlayer.play().catch(() => { });
                showView("video-player");
            });
        });

        // image list
        const imgTitle = document.getElementById("files-image-title");
        const imgViewer = document.getElementById("files-image-viewer");
        filesWindow.querySelectorAll(".files__view--images .files__table-row[data-image-url]").forEach(row => {
            row.addEventListener("click", () => {
                const src = row.dataset.imageUrl;
                const name = row.dataset.imageName;
                imgTitle.textContent = name;
                imgViewer.src = src;
                showView("image-viewer");
            });
        });

        // PDF documents list
        filesWindow.querySelectorAll(".files__view--docs .doc").forEach(doc => {
            doc.addEventListener("click", () => {
                openPdf(doc.dataset.pdfUrl, doc.dataset.pdfName);
            });
        });
    }

    return { init, openPdf };
})();
