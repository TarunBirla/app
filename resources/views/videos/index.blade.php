@extends('layouts.app')

@section('title', 'Physiotherapy Video Library — SDPC | Dr. Mahesh Sahu')
@section('meta_description', 'Watch guided physiotherapy and rehabilitation exercise videos curated by Dr. Mahesh Sahu (SDPC Indore). Filter by category, date, or newest sessions.')

@section('content')
<div class="container">
    <!-- Page Header Banner -->
    <div class="sdpc-hero p-4 mb-4">
        <div class="row align-items-center g-3">
            <div class="col-lg-8">
                <span class="badge rounded-pill px-3 py-1 mb-2" style="background: rgba(255,255,255,0.16);">
                    <i class="bi bi-play-btn-fill text-warning me-1"></i> SDPC Rehab Library
                </span>
                <h1 class="h2 fw-bold mb-1">Guided Physiotherapy Videos</h1>
                <p class="text-white-50 small mb-0">
                    Step-by-step mobility, strengthening, and pain-relief demonstrations by {{ $doctor['name'] }}. Filter by treatment category or date below.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ $doctor['whatsapp_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-whatsapp btn-sm rounded-pill px-3 py-2">
                    <i class="bi bi-whatsapp me-1"></i> Ask {{ $doctor['name'] }} on WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Frontend Filter Controls (No Search Bar as strictly required) -->
    <section class="sdpc-card p-3 p-md-4 mb-4" aria-label="Video Filters">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-sliders2-vertical text-teal-sdpc fs-5"></i>
                <h2 class="h6 fw-bold mb-0">Filter Videos Instantly</h2>
                <span id="sdpcVideoCountLabel" class="badge rounded-pill" style="background: rgba(15,118,110,0.12); color: var(--sdpc-deep-teal);">
                    {{ count($videos) }} videos
                </span>
            </div>
            <button type="button" id="sdpcFilterReset" class="btn btn-sm btn-sdpc-outline rounded-pill py-1 px-3">
                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filters
            </button>
        </div>

        <!-- Horizontal Predefined Category Chips -->
        <div class="sdpc-chip-scroll mb-3" role="tablist" aria-label="Predefined Video Categories">
            <button type="button"
                    class="sdpc-filter-chip js-video-category-chip {{ $selectedCategory === 'all' ? 'active' : '' }}"
                    data-category="all">
                All Categories
            </button>
            @foreach($categories as $cat)
                <button type="button"
                        class="sdpc-filter-chip js-video-category-chip {{ $selectedCategory === $cat['slug'] ? 'active' : '' }}"
                        data-category="{{ $cat['slug'] }}">
                    <i class="bi {{ $cat['icon'] }} me-1"></i>{{ $cat['name'] }}
                </button>
            @endforeach
        </div>

        <!-- Dropdown Filters: Category, Date Window, Custom Date Range, Sort Order -->
        <div class="row g-2 g-md-3 align-items-end">
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="sdpcFilterCategorySelect" class="form-label small fw-semibold text-muted-sdpc mb-1">Treatment Category</label>
                <select id="sdpcFilterCategorySelect" class="form-select form-select-sm rounded-3 py-2">
                    <option value="all" {{ $selectedCategory === 'all' ? 'selected' : '' }}>All 19 Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat['slug'] }}" {{ $selectedCategory === $cat['slug'] ? 'selected' : '' }}>
                            {{ $cat['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 col-sm-6 col-lg-2">
                <label for="sdpcFilterDateRange" class="form-label small fw-semibold text-muted-sdpc mb-1">Published Period</label>
                <select id="sdpcFilterDateRange" class="form-select form-select-sm rounded-3 py-2">
                    <option value="all">All Dates</option>
                    <option value="30days">Last 30 Days</option>
                    <option value="60days">Last 60 Days</option>
                    <option value="90days">Last 90 Days</option>
                </select>
            </div>

            <div class="col-6 col-sm-4 col-lg-2">
                <label for="sdpcFilterSort" class="form-label small fw-semibold text-muted-sdpc mb-1">Sort By Date</label>
                <select id="sdpcFilterSort" class="form-select form-select-sm rounded-3 py-2">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                </select>
            </div>

            <div class="col-6 col-sm-4 col-lg-2">
                <label for="sdpcFilterDateFrom" class="form-label small fw-semibold text-muted-sdpc mb-1">From Date</label>
                <input type="date" id="sdpcFilterDateFrom" class="form-control form-control-sm rounded-3 py-2" min="2026-01-01" max="2026-12-31">
            </div>

            <div class="col-6 col-sm-4 col-lg-3">
                <label for="sdpcFilterDateTo" class="form-label small fw-semibold text-muted-sdpc mb-1">To Date</label>
                <input type="date" id="sdpcFilterDateTo" class="form-control form-control-sm rounded-3 py-2" min="2026-01-01" max="2026-12-31">
            </div>
        </div>
    </section>

    <!-- Video Cards Grid -->
    <div id="sdpcVideoGrid" class="row g-3 g-md-4" data-initial-category="{{ $selectedCategory }}">
        @foreach($videos as $video)
            @php
                $videoUrl = route('videos.show', ['slug' => $video['slug']]);
                $thumbUrl = \App\Http\Controllers\SdpcController::assetUrl($video['thumbnail']);
                $hasMp4 = file_exists(public_path(ltrim($video['video_file'], '/')));
            @endphp
            <div class="col-12 col-md-6 col-lg-4 js-video-card-item"
                 data-category="{{ $video['category_slug'] }}"
                 data-date="{{ $video['published_date'] }}">
                <article class="sdpc-video-card">
                    <div class="sdpc-video-thumb-wrap">
                        <img src="{{ $thumbUrl }}" alt="{{ $video['title'] }}" loading="lazy">
                        <span class="sdpc-sample-pill">
                            <i class="bi bi-tag-fill me-1"></i>{{ $video['category'] }}
                        </span>
                        <span class="sdpc-duration-badge">
                            <i class="bi bi-clock me-1"></i>{{ $video['duration'] }}
                        </span>
                        <a href="{{ $videoUrl }}" class="sdpc-play-overlay" aria-label="Play {{ $video['title'] }}">
                            <span class="sdpc-play-btn-circle">
                                <i class="bi bi-play-fill ms-1"></i>
                            </span>
                        </a>
                    </div>

                    <div class="p-3 p-md-4 d-flex flex-column flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between text-muted-sdpc small mb-2">
                            <span><i class="bi bi-calendar-event me-1"></i>{{ \Carbon\Carbon::parse($video['published_date'])->format('d M Y') }}</span>
                            @if($hasMp4)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">HD Video</span>
                            @else
                                <span class="badge bg-warning-subtle text-dark border border-warning-subtle">{{ $video['sample_badge'] }}</span>
                            @endif
                        </div>

                        <h3 class="h5 fw-bold mb-2">
                            <a href="{{ $videoUrl }}" class="text-decoration-none" style="color: var(--sdpc-navy);">
                                {{ $video['title'] }}
                            </a>
                        </h3>

                        <p class="text-muted-sdpc small mb-3 flex-grow-1">
                            {{ $video['short_description'] }}
                        </p>

                        <div class="d-flex align-items-center gap-2 mt-auto pt-3 border-top">
                            <a href="{{ $videoUrl }}" class="btn btn-sm btn-sdpc-teal flex-grow-1 py-2">
                                <i class="bi bi-play-circle-fill me-1"></i> Play & View Details
                            </a>
                            <button type="button"
                                    class="btn btn-sm btn-sdpc-outline px-2 py-2 js-whatsapp-share"
                                    data-title="{{ $video['title'] }}"
                                    data-url="{{ $videoUrl }}"
                                    title="Share on WhatsApp"
                                    aria-label="Share {{ $video['title'] }} on WhatsApp">
                                <i class="bi bi-whatsapp text-success"></i>
                            </button>
                            <button type="button"
                                    class="btn btn-sm btn-sdpc-outline px-2 py-2 js-share-video"
                                    data-title="{{ $video['title'] }}"
                                    data-url="{{ $videoUrl }}"
                                    title="Share Video"
                                    aria-label="Share {{ $video['title'] }}">
                                <i class="bi bi-share-fill"></i>
                            </button>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>

    <!-- Empty Filter Result Card -->
    <div id="sdpcVideoEmptyState" class="sdpc-card p-5 text-center my-4 d-none">
        <div class="sdpc-cat-icon mx-auto mb-3">
            <i class="bi bi-camera-video"></i>
        </div>
        <h3 class="h5 fw-bold mb-2">No Videos Found for Selected Filter</h3>
        <p class="text-muted-sdpc small mb-3">
            We are recording more physiotherapy sessions for this category/date range. You can reset the filter or message {{ $doctor['name'] }} on WhatsApp for personalized exercise guidance.
        </p>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <button type="button" class="btn btn-sdpc-teal btn-sm" onclick="document.getElementById('sdpcFilterReset').click()">
                <i class="bi bi-arrow-counterclockwise me-1"></i> Show All Videos
            </button>
            <a href="{{ $doctor['whatsapp_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-whatsapp btn-sm">
                <i class="bi bi-whatsapp me-1"></i> Ask Dr. Mahesh Sahu
            </a>
        </div>
    </div>
</div>
@endsection
