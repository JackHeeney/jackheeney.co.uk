<?php

/**
 * Scan assets/docs for PDF files, newest first.
 *
 * @return array<int, array{filename: string, url: string, name: string, mtime: int, type: string}>
 */
function portfolio_get_documents(): array
{
    $docsDir = dirname(__DIR__) . '/docs';
    $documents = [];

    if (!is_dir($docsDir)) {
        return $documents;
    }

    $files = glob($docsDir . '/*.{pdf,PDF}', GLOB_BRACE);
    if ($files === false) {
        $files = array_merge(glob($docsDir . '/*.pdf') ?: [], glob($docsDir . '/*.PDF') ?: []);
    }

    $seen = [];
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
        ];
    }

    usort($documents, static fn(array $a, array $b): int => $b['mtime'] <=> $a['mtime']);

    return $documents;
}

function portfolio_document_url(string $filename): string
{
    return './assets/docs/' . rawurlencode($filename);
}

function portfolio_get_recent_documents(int $limit = 3): array
{
    return array_slice(portfolio_get_documents(), 0, $limit);
}
