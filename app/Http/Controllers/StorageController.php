<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageController extends Controller
{
    public function serve($path)
    {
        // Normalize path - decode URL
        $path = urldecode($path);

        // Try public disk first
        if (Storage::disk('public')->exists($path)) {
            return $this->serveFile(Storage::disk('public')->path($path), $path);
        }

        // Fallback: try direct path in storage/app/public
        $fallbackPath = storage_path('app/public/' . $path);
        if (file_exists($fallbackPath)) {
            return $this->serveFile($fallbackPath, $path);
        }

        // File not found
        \Log::error('Storage file not found', [
            'requested_path' => $path,
            'public_disk_path' => Storage::disk('public')->path($path),
            'fallback_path' => $fallbackPath,
            'files_in_heroes' => glob(storage_path('app/public/heroes/*'))
        ]);

        abort(404, 'File not found: ' . $path);
    }

    private function serveFile($fullPath, $relativePath)
    {
        try {
            $mimeType = $this->getMimeType($fullPath);

            return response()
                ->file($fullPath, [
                    'Content-Type' => $mimeType,
                    'Cache-Control' => 'public, max-age=31536000, immutable',
                    'Access-Control-Allow-Origin' => '*',
                    'Access-Control-Allow-Methods' => 'GET, HEAD, OPTIONS',
                    'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
                ]);
        } catch (\Exception $e) {
            \Log::error('Error serving file', [
                'path' => $fullPath,
                'error' => $e->getMessage()
            ]);
            abort(500, 'Error serving file: ' . $e->getMessage());
        }
    }

    private function getMimeType($filePath)
    {
        $mimeTypes = [
            'webp' => 'image/webp',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];

        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        return $mimeTypes[$ext] ?? 'application/octet-stream';
    }
}