
/* --------------------------- File Explorer --------------------------- */

const FileExplorer = (() => {
    function init() {
        const filesWindow = document.getElementById("window-files");
        if (!filesWindow) return;

        const views = filesWindow.querySelectorAll(".files__view");

        const showView = (name) => {
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
        filesWindow.querySelectorAll(".files__view--videos .files__table-row").forEach(row => {
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
        filesWindow.querySelectorAll(".files__view--images .files__table-row").forEach(row => {
            row.addEventListener("click", () => {
                const src = row.dataset.imageUrl;
                const name = row.dataset.imageName;
                imgTitle.textContent = name;
                imgViewer.src = src;
                showView("image-viewer");
            });
        });

        // PDF documents list
        const pdfTitle = document.getElementById("files-pdf-title");
        const pdfViewer = document.getElementById("files-pdf-viewer");
        filesWindow.querySelectorAll(".files__view--docs .doc").forEach(doc => {
            doc.addEventListener("click", () => {
                const src = doc.dataset.pdfUrl;
                const name = doc.dataset.pdfName;
                pdfTitle.textContent = name;
                pdfViewer.src = src;
                showView("pdf-viewer");
            });
        });
    }

    return { init };
})();
