<?php

if (!function_exists('portfolio_get_project_images')) {
    /**
     * Return all project images from assets/img/projects recursively.
     *
     * @return array<int, array{name: string, filename: string, url: string}>
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

            $items[] = [
                'name' => pathinfo($relativePath, PATHINFO_FILENAME),
                'filename' => $relativePath,
                'url' => 'assets/img/projects/' . $relativePath,
            ];
        }

        usort($items, static function ($a, $b) {
            return strnatcasecmp($a['filename'], $b['filename']);
        });

        return $items;
    }
}
