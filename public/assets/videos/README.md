# Adding Real Physiotherapy Videos & Thumbnails

All physiotherapy video metadata is stored statically in [`config/sdpc.php`](file:///c:/Users/hp/Downloads/App/config/sdpc.php) (no database required).

## 1. Directory Structure
- **MP4 Video Files:** `public/assets/videos/<your-video-name>.mp4`
- **Thumbnail Images:** `public/assets/videos/thumbnails/<your-thumbnail>.jpg` (or `.png` / `.svg`)

## 2. How to Add or Replace a Video
1. Copy your recorded `.mp4` file into `public/assets/videos/` (for example, `public/assets/videos/back-pain-demo.mp4`).
2. Copy its thumbnail poster image into `public/assets/videos/thumbnails/`.
3. Open `config/sdpc.php` and update or add an entry under the `'videos'` array:
   ```php
   [
       'slug' => 'lower-back-pain-relief-core-stretches',
       'title' => 'Lower Back Pain Relief & Gentle Lumbar Stretches',
       'category' => 'Back Pain',
       'category_slug' => 'back-pain',
       'short_description' => 'Safe daily pelvic tilts and lumbar stretches.',
       'full_description' => 'Detailed description...',
       'duration' => '06:45',
       'published_date' => '2026-09-28',
       'thumbnail' => '/assets/videos/thumbnails/back-pain.svg',
       'video_file' => '/assets/videos/back-pain-demo.mp4',
       'featured' => true,
       'benefits' => ['...'],
       'safety_instructions' => ['...'],
   ]
   ```
4. As soon as the physical `.mp4` file exists at `public/assets/videos/...`, the Video Details page automatically switches from the **Sample Rehab Demonstration Card** to your real HTML5 MP4 video stream.

## 3. Optional CDN Support
To serve videos and thumbnails from a CDN later without changing any Blade templates:
- Set `SDPC_ASSET_CDN_URL=https://cdn.yourdomain.com` in `.env`.
- Leave `SDPC_ASSET_CDN_URL=` empty to serve all files locally.
