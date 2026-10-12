<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SdpcController extends Controller
{
    /**
     * Resolve static asset or CDN URL.
     */
    public static function assetUrl(string $path): string
    {
        $cdn = config('sdpc.asset_cdn_url', '');
        $cleanPath = '/' . ltrim($path, '/');

        if (!empty($cdn)) {
            return $cdn . $cleanPath;
        }

        return asset(ltrim($path, '/'));
    }

    /**
     * Home Screen
     */
    public function home()
    {
        $doctor = config('sdpc.doctor');
        $benefits = config('sdpc.benefits');
        $allCategories = config('sdpc.categories');
        $popularCategories = array_values(array_filter($allCategories, fn($c) => !empty($c['featured'])));
        $allVideos = config('sdpc.videos');
        $featuredVideos = array_values(array_filter($allVideos, fn($v) => !empty($v['featured'])));

        return view('home', compact(
            'doctor',
            'benefits',
            'popularCategories',
            'allCategories',
            'featuredVideos'
        ));
    }

    /**
     * Videos Library Screen
     */
    public function videos(Request $request)
    {
        $doctor = config('sdpc.doctor');
        $categories = config('sdpc.categories');
        $videos = config('sdpc.videos');
        $selectedCategory = $request->query('category', 'all');

        // Extract unique categories that have videos plus all 19 predefined categories
        return view('videos.index', compact(
            'doctor',
            'categories',
            'videos',
            'selectedCategory'
        ));
    }

    /**
     * Video Details Screen
     */
    public function videoShow(string $slug)
    {
        $doctor = config('sdpc.doctor');
        $videos = config('sdpc.videos');

        $video = null;
        foreach ($videos as $item) {
            if ($item['slug'] === $slug) {
                $video = $item;
                break;
            }
        }

        if (!$video) {
            abort(404);
        }

        // Check if physical MP4 file exists in public/assets/videos/...
        $relativeFile = ltrim($video['video_file'], '/');
        $physicalFileExists = file_exists(public_path($relativeFile));

        // Related videos (same category first, then others)
        $relatedVideos = array_values(array_filter($videos, fn($v) => $v['slug'] !== $slug));
        usort($relatedVideos, function ($a, $b) use ($video) {
            $aMatch = $a['category_slug'] === $video['category_slug'] ? 0 : 1;
            $bMatch = $b['category_slug'] === $video['category_slug'] ? 0 : 1;
            return $aMatch <=> $bMatch;
        });
        $relatedVideos = array_slice($relatedVideos, 0, 3);

        return view('videos.show', compact(
            'doctor',
            'video',
            'physicalFileExists',
            'relatedVideos'
        ));
    }

    /**
     * Treatment Categories Screen
     */
    public function categories()
    {
        $doctor = config('sdpc.doctor');
        $categories = config('sdpc.categories');
        $videos = config('sdpc.videos');

        // Count videos per category slug
        $categoryVideoCounts = [];
        foreach ($videos as $v) {
            $cSlug = $v['category_slug'];
            $categoryVideoCounts[$cSlug] = ($categoryVideoCounts[$cSlug] ?? 0) + 1;
        }

        return view('categories.index', compact(
            'doctor',
            'categories',
            'categoryVideoCounts'
        ));
    }

    /**
     * Doctor Profile Screen
     */
    public function doctorProfile()
    {
        $doctor = config('sdpc.doctor');
        $categories = config('sdpc.categories');
        $benefits = config('sdpc.benefits');

        return view('doctor.profile', compact(
            'doctor',
            'categories',
            'benefits'
        ));
    }

    /**
     * About & Contact Screen
     */
    public function contact()
    {
        $doctor = config('sdpc.doctor');
        $benefits = config('sdpc.benefits');
        $categories = config('sdpc.categories');

        return view('contact', compact(
            'doctor',
            'benefits',
            'categories'
        ));
    }

    /**
     * Offline Fallback Screen for PWA
     */
    public function offline()
    {
        $doctor = config('sdpc.doctor');
        return view('offline', compact('doctor'));
    }
}
