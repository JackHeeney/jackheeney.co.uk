<?php

if (!function_exists('portfolio_project_image_url')) {
    function portfolio_project_image_url(string $relativePath): string
    {
        $segments = explode('/', str_replace('\\', '/', $relativePath));

        return 'assets/img/projects/' . implode('/', array_map('rawurlencode', $segments));
    }
}

if (!function_exists('portfolio_get_project_images')) {
    /**
     * Return all project images from assets/img/projects recursively.
     *
     * @return array<int, array{name: string, filename: string, url: string, folder: string}>
     */
    function portfolio_get_project_images()
    {
        $baseDir = realpath(__DIR__ . '/../img/projects');
        if ($baseDir === false || !is_dir($baseDir)) {
            return [];
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp', 'avif'];
        $items = [];

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $baseDir,
                FilesystemIterator::SKIP_DOTS
            )
        );

        foreach ($iterator as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }

            $extension = strtolower($fileInfo->getExtension());
            if (!in_array($extension, $allowedExtensions, true)) {
                continue;
            }

            $absolutePath = $fileInfo->getPathname();
            $relativePath = str_replace($baseDir . DIRECTORY_SEPARATOR, '', $absolutePath);
            $relativePath = str_replace(DIRECTORY_SEPARATOR, '/', $relativePath);
            $folder = explode('/', $relativePath, 2)[0];

            $items[] = [
                'name' => pathinfo($relativePath, PATHINFO_FILENAME),
                'filename' => $relativePath,
                'url' => portfolio_project_image_url($relativePath),
                'folder' => $folder,
            ];
        }

        usort($items, static function ($a, $b) {
            $folderCompare = strnatcasecmp($a['folder'], $b['folder']);
            if ($folderCompare !== 0) {
                return $folderCompare;
            }

            return strnatcasecmp($a['filename'], $b['filename']);
        });

        return $items;
    }
}

if (!function_exists('portfolio_get_project_images_by_folder')) {
    /**
     * Return project images grouped by top-level project folder.
     *
     * @return array<string, array<int, array{name: string, filename: string, url: string, folder: string}>>
     */
    function portfolio_get_project_images_by_folder(): array
    {
        $folders = [];

        foreach (portfolio_get_project_images() as $image) {
            $folders[$image['folder']][] = $image;
        }

        uksort($folders, 'strnatcasecmp');

        return $folders;
    }
}
