<?php

if (!function_exists('portfolio_project_document_url')) {
    function portfolio_project_document_url(string $relativePath): string
    {
        $segments = explode('/', str_replace('\\', '/', $relativePath));

        return 'assets/img/projects/' . implode('/', array_map('rawurlencode', $segments));
    }
}

/**
 * Scan assets/docs and assets/img/projects for PDF files, newest first.
 *
 * @return array<int, array{filename: string, url: string, name: string, mtime: int, type: string, folder: string}>
 */
function portfolio_get_documents(): array
{
    $documents = [];
    $seen = [];

    $docsDir = dirname(__DIR__) . '/docs';
    if (is_dir($docsDir)) {
        $files = array_merge(
            glob($docsDir . '/*.pdf') ?: [],
            glob($docsDir . '/*.PDF') ?: []
        );

        foreach ($files as $file) {
            if (!is_file($file)) {
                continue;
            }

            $key = strtolower(realpath($file) ?: $file);
            if (isset($seen[$key])) {
                continue;
            }
            $seen[$key] = true;

            $filename = basename($file);
            $documents[] = [
                'filename' => $filename,
                'url'      => portfolio_document_url($filename),
                'name'     => pathinfo($filename, PATHINFO_FILENAME),
                'mtime'    => filemtime($file),
                'type'     => 'PDF Document',
                'folder'   => 'Documents',
            ];
        }
    }

    $projectsDir = realpath(__DIR__ . '/../img/projects');
    if ($projectsDir !== false && is_dir($projectsDir)) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $projectsDir,
                FilesystemIterator::SKIP_DOTS
            )
        );

        foreach ($iterator as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }

            if (strtolower($fileInfo->getExtension()) !== 'pdf') {
                continue;
            }

            $absolutePath = $fileInfo->getPathname();
            $key = strtolower(realpath($absolutePath) ?: $absolutePath);
            if (isset($seen[$key])) {
                continue;
            }
            $seen[$key] = true;

            $relativePath = str_replace($projectsDir . DIRECTORY_SEPARATOR, '', $absolutePath);
            $relativePath = str_replace(DIRECTORY_SEPARATOR, '/', $relativePath);
            $folder = explode('/', $relativePath, 2)[0];

            $documents[] = [
                'filename' => $relativePath,
                'url'      => portfolio_project_document_url($relativePath),
                'name'     => pathinfo($relativePath, PATHINFO_FILENAME),
                'mtime'    => filemtime($absolutePath),
                'type'     => 'PDF Document',
                'folder'   => $folder,
            ];
        }
    }

    usort($documents, static fn(array $a, array $b): int => $b['mtime'] <=> $a['mtime']);

    return $documents;
}

function portfolio_document_url(string $filename): string
{
    $url = './assets/docs/' . rawurlencode($filename);
    $path = dirname(__DIR__) . '/docs/' . $filename;
    $version = is_file($path) ? filemtime($path) : false;

    return $version === false ? $url : $url . '?v=' . $version;
}

/**
 * Return documents grouped by folder.
 *
 * @return array<string, array<int, array{filename: string, url: string, name: string, mtime: int, type: string, folder: string}>>
 */
function portfolio_get_documents_by_folder(): array
{
    $folders = [];

    foreach (portfolio_get_documents() as $document) {
        $folders[$document['folder']][] = $document;
    }

    uksort($folders, static function (string $a, string $b): int {
        if ($a === 'Documents') {
            return -1;
        }
        if ($b === 'Documents') {
            return 1;
        }

        return strnatcasecmp($a, $b);
    });

    return $folders;
}

function portfolio_get_recent_documents(int $limit = 3): array
{
    return array_slice(portfolio_get_documents(), 0, $limit);
}
