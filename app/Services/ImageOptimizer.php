<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\PngEncoder;

class ImageOptimizer
{
    /**
     * Optimize and optionally resize an image
     */
    public static function optimize(
        string $path,
        ?int $maxWidth = null,
        ?int $maxHeight = null,
        int $quality = 80,
        string $disk = 'public'
    ): string {
        $fullPath = Storage::disk($disk)->path($path);

        if (!file_exists($fullPath)) {
            return $path;
        }

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        // Skip SVG files - they don't need optimization
        if ($extension === 'svg') {
            return $path;
        }

        try {
            $image = Image::read($fullPath);

            // Resize if dimensions are specified
            if ($maxWidth || $maxHeight) {
                $image->scaleDown($maxWidth, $maxHeight);
            }

            // Encode based on extension or convert to WebP for better compression
            $newPath = $path;

            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                // Convert to WebP for better compression (keep original extension in path)
                $webpPath = preg_replace('/\.(jpg|jpeg|png|gif)$/i', '.webp', $path);

                $image->encode(new WebpEncoder($quality))
                    ->save(Storage::disk($disk)->path($webpPath));

                // Delete original if different
                if ($webpPath !== $path && file_exists($fullPath)) {
                    unlink($fullPath);
                }

                $newPath = $webpPath;
            }

            return $newPath;
        } catch (\Exception $e) {
            // If optimization fails, return original path
            report($e);
            return $path;
        }
    }

    /**
     * Get optimized dimensions for different image types
     */
    public static function getDimensions(string $type): array
    {
        return match ($type) {
            'hero' => ['width' => 500, 'height' => 500],
            'gallery' => ['width' => 400, 'height' => 400],
            'skill' => ['width' => 128, 'height' => 128],
            'project' => ['width' => 800, 'height' => 600],
            default => ['width' => null, 'height' => null],
        };
    }

    /**
     * Get image dimensions and detect aspect ratio
     */
    public static function getImageDimensions(string $path, string $disk = 'public'): ?array
    {
        $fullPath = Storage::disk($disk)->path($path);

        if (!file_exists($fullPath)) {
            return null;
        }

        try {
            $image = Image::read($fullPath);
            $width = $image->width();
            $height = $image->height();

            $aspectRatio = self::calculateAspectRatio($width, $height);

            return [
                'width' => $width,
                'height' => $height,
                'aspect_ratio' => $aspectRatio,
            ];
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }

    /**
     * Calculate aspect ratio as simplified string (e.g., "16:9", "9:16")
     */
    public static function calculateAspectRatio(int $width, int $height): string
    {
        // Find GCD to simplify the ratio
        $gcd = function ($a, $b) {
            return $b === 0 ? $a : ($b)($a % $b, $b);
        };

        $divisor = self::gcd($width, $height);
        $w = intval($width / $divisor);
        $h = intval($height / $divisor);

        return "{$w}:{$h}";
    }

    /**
     * Calculate GCD (Greatest Common Divisor)
     */
    private static function gcd($a, $b): int
    {
        return $b === 0 ? $a : self::gcd($b, $a % $b);
    }
}
