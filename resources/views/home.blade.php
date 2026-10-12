@extends('layouts.app')

@section('title', 'SDPC — Dr. Mahesh Sahu | Move Free. Live Pain-Free.')
@section('meta_description', 'SDPC Physiotherapy in Indore by Dr. Mahesh Sahu (4.9 stars, 211 Google reviews). Move Free. Live Pain-Free. Watch guided rehab videos and book an appointment.')

@section('content')
<div class="container">
    <!-- 1. Hero Banner with Navy-to-Deep-Teal Gradient -->
    <section class="sdpc-hero p-4 p-md-5 mb-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3"
                     style="background: rgba(255,255,255,0.14); border: 1px solid rgba(255,255,255,0.2);">
                    <i class="bi bi-stars text-warning"></i>
                    <span class="small fw-semibold">SDPC Physiotherapy • Indore, MP</span>
                </div>
                <h1 class="display-5 fw-bold mb-2">Move Free.<br><span style="color: #5EEAD4;">Live Pain-Free.</span></h1>
                <p class="lead text-white-50 mb-4" style="font-size: 1.02rem;">
                    Personalized physiotherapy, spinal care, post-surgical recovery, and guided rehabilitation exercises with <strong class="text-white">{{ $doctor['name'] }}</strong>.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ $doctor['tel_link'] }}" class="btn btn-sdpc-amber d-inline-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill"></i>
                        <span>Call {{ $doctor['phone_display'] }}</span>
                    </a>
                    <a href="{{ $doctor['whatsapp_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-whatsapp d-inline-flex align-items-center gap-2">
                        <i class="bi bi-whatsapp"></i>
                        <span>WhatsApp Clinic</span>
                    </a>
                    <a href="{{ route('videos.index') }}" class="btn btn-outline-light rounded-4 px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-play-circle-fill text-warning"></i>
                        <span>Watch Rehab Videos</span>
                    </a>
                </div>
            </div>

            <!-- Attractive Physiotherapy Illustration / Doctor Highlight Card -->
            <div class="col-lg-5">
                <div class="p-3 p-sm-4 rounded-4" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.18);">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ \App\Http\Controllers\SdpcController::assetUrl($doctor['photo']) }}"
                             alt="{{ $doctor['name'] }}"
                             class="sdpc-doctor-avatar">
                        <div>
                            <span class="badge bg-warning text-dark fw-bold mb-1">
                                <i class="bi bi-star-fill me-1"></i>{{ $doctor['rating'] }} ({{ $doctor['reviews_count'] }} Reviews)
                            </span>
                            <h2 class="h5 fw-bold mb-0 text-white">{{ $doctor['name'] }}</h2>
                            <p class="small mb-0" style="color: #A7F3D0;">{{ $doctor['specialty'] }}</p>
                        </div>
                    </div>
                    <div class="small text-white-50 mb-3">
                        <div class="d-flex align-items-start gap-2 mb-1">
                            <i class="bi bi-geo-alt-fill text-warning mt-1"></i>
                            <span class="text-white">{{ $doctor['address'] }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-clock-fill text-warning"></i>
                            <span class="text-white">{{ $doctor['hours'] }}</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('doctor.profile') }}" class="btn btn-sm btn-light fw-semibold rounded-pill px-3 flex-grow-1">
                            View Doctor Profile
                        </a>
                        <a href="{{ $doctor['map_link'] }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-light rounded-pill px-3">
                            <i class="bi bi-map me-1"></i> Map
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Quick Actions Row (Call, WhatsApp, Directions, Doctor Profile) -->
    <section class="mb-4" aria-label="Quick Clinic Actions">
        <div class="row g-2 g-md-3">
            <div class="col-3">
                <a href="{{ $doctor['tel_link'] }}" class="sdpc-quick-action">
                    <div class="sdpc-quick-icon" style="background: rgba(245, 158, 11, 0.14); color: #D97706;">
                        <i class="bi bi-telephone-outbound-fill"></i>
                    </div>
                    <span class="fw-bold small font-heading">Call</span>
                    <small class="text-muted-sdpc d-none d-sm-block" style="font-size: 0.72rem;">{{ $doctor['phone_display'] }}</small>
                </a>
            </div>
            <div class="col-3">
                <a href="{{ $doctor['whatsapp_link'] }}" target="_blank" rel="noopener" class="sdpc-quick-action">
                    <div class="sdpc-quick-icon" style="background: rgba(37, 211, 102, 0.14); color: #16A34A;">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <span class="fw-bold small font-heading">WhatsApp</span>
                    <small class="text-muted-sdpc d-none d-sm-block" style="font-size: 0.72rem;">Instant Chat</small>
                </a>
            </div>
            <div class="col-3">
                <a href="{{ $doctor['map_link'] }}" target="_blank" rel="noopener" class="sdpc-quick-action">
                    <div class="sdpc-quick-icon" style="background: rgba(20, 184, 166, 0.15); color: #0F766E;">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <span class="fw-bold small font-heading">Directions</span>
                    <small class="text-muted-sdpc d-none d-sm-block" style="font-size: 0.72rem;">Khatiwala Tank</small>
                </a>
            </div>
            <div class="col-3">
                <a href="{{ $doctor['profile_link'] }}" target="_blank" rel="noopener" class="sdpc-quick-action">
                    <div class="sdpc-quick-icon" style="background: rgba(11, 27, 58, 0.1); color: #0B1B3A;">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                    <span class="fw-bold small font-heading">Skedoc Profile</span>
                    <small class="text-muted-sdpc d-none d-sm-block" style="font-size: 0.72rem;">Verified Listing</small>
                </a>
            </div>
        </div>
    </section>

    <!-- 3. Featured Physiotherapy Videos -->
    <section class="mb-5">
        <div class="d-flex align-items-end justify-content-between mb-3">
            <div>
                <span class="text-teal-sdpc fw-bold small text-uppercase">Guided Care</span>
                <h2 class="h4 fw-bold mb-0">Featured Physiotherapy Videos</h2>
            </div>
            <a href="{{ route('videos.index') }}" class="btn btn-sm btn-sdpc-outline rounded-pill px-3">
                All Videos <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-3 g-md-4">
            @foreach($featuredVideos as $video)
                @php
                    $videoUrl = route('videos.show', ['slug' => $video['slug']]);
                    $thumbUrl = \App\Http\Controllers\SdpcController::assetUrl($video['thumbnail']);
                @endphp
                <div class="col-12 col-md-6 col-lg-3">
                    <article class="sdpc-video-card">
                        <div class="sdpc-video-thumb-wrap">
                            <img src="{{ $thumbUrl }}" alt="{{ $video['title'] }}" loading="lazy">
                            <span class="sdpc-sample-pill">
                                <i class="bi bi-collection-play me-1"></i>{{ $video['category'] }}
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
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between text-muted-sdpc small mb-1">
                                <span><i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($video['published_date'])->format('d M Y') }}</span>
                                <span class="badge bg-light text-secondary border">Guided Demo</span>
                            </div>
                            <h3 class="h6 fw-bold mb-2">
                                <a href="{{ $videoUrl }}" class="text-decoration-none" style="color: var(--sdpc-navy);">
                                    {{ $video['title'] }}
                                </a>
                            </h3>
                            <p class="text-muted-sdpc small mb-3 flex-grow-1">
                                {{ $video['short_description'] }}
                            </p>
                            <div class="d-flex align-items-center gap-2 mt-auto pt-2 border-top">
                                <a href="{{ $videoUrl }}" class="btn btn-sm btn-sdpc-teal flex-grow-1 py-2">
                                    <i class="bi bi-play-circle me-1"></i> Watch Details
                                </a>
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
    </section>

    <!-- 4. Popular Treatment Categories -->
    <section class="mb-5">
        <div class="d-flex align-items-end justify-content-between mb-3">
            <div>
                <span class="text-teal-sdpc fw-bold small text-uppercase">Specialized Therapies</span>
                <h2 class="h4 fw-bold mb-0">Popular Treatment Categories</h2>
            </div>
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-sdpc-outline rounded-pill px-3">
                View All 19 <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-3">
            @foreach($popularCategories as $cat)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="sdpc-card sdpc-card-hover p-3 h-100 d-flex flex-column">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="sdpc-cat-icon">
                                <i class="bi {{ $cat['icon'] }}"></i>
                            </div>
                            <div>
                                <h3 class="h6 fw-bold mb-0">{{ $cat['name'] }}</h3>
                                <small class="text-teal-sdpc fw-semibold">SDPC Care</small>
                            </div>
                        </div>
                        <p class="text-muted-sdpc small mb-3 flex-grow-1">{{ $cat['short_desc'] }}</p>
                        <a href="{{ route('videos.index', ['category' => $cat['slug']]) }}" class="btn btn-sm btn-sdpc-outline w-100 rounded-pill">
                            Explore Videos <i class="bi bi-play-btn ms-1"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 5. Benefits of Physiotherapy -->
    <section class="mb-5">
        <div class="text-center mb-4">
            <span class="text-teal-sdpc fw-bold small text-uppercase">Why Physiotherapy Works</span>
            <h2 class="h4 fw-bold mb-1">Key Benefits of Guided Physiotherapy</h2>
            <p class="text-muted-sdpc small mb-0">Restoring strength, flexibility, and confidence without unnecessary discomfort.</p>
        </div>

        <div class="row g-3">
            @foreach($benefits as $benefit)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="sdpc-card p-4 h-100">
                        <div class="sdpc-cat-icon mb-3">
                            <i class="bi {{ $benefit['icon'] }}"></i>
                        </div>
                        <h3 class="h6 fw-bold mb-2">{{ $benefit['title'] }}</h3>
                        <p class="text-muted-sdpc small mb-0">{{ $benefit['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 6. Clinic Information, Opening Hours & Prominent WhatsApp CTA -->
    <section class="mb-3">
        <div class="sdpc-card p-4 p-lg-5" style="background: linear-gradient(135deg, #FFFFFF 0%, #F0FDFA 100%);">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge rounded-pill px-3 py-2 mb-2" style="background: rgba(15,118,110,0.12); color: var(--sdpc-deep-teal);">
                        <i class="bi bi-hospital me-1"></i> Visit SDPC Clinic in Indore
                    </span>
                    <h2 class="h3 fw-bold mb-2">Ready to Start Your Pain-Free Recovery?</h2>
                    <p class="text-muted-sdpc mb-3">
                        Consult <strong>{{ $doctor['name'] }}</strong> ({{ $doctor['specialty'] }}) for personalized assessment and hands-on physiotherapy care.
                    </p>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-geo-alt-fill text-teal-sdpc fs-5"></i>
                                <div>
                                    <div class="fw-bold small font-heading">Clinic Location</div>
                                    <div class="text-muted-sdpc small">{{ $doctor['address'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-clock-fill text-teal-sdpc fs-5"></i>
                                <div>
                                    <div class="fw-bold small font-heading">Opening Hours</div>
                                    <div class="text-muted-sdpc small">{{ $doctor['hours'] }}</div>
                                    <div class="small text-success fw-semibold"><i class="bi bi-star-fill text-warning me-1"></i>{{ $doctor['reviews_label'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="p-4 rounded-4 text-white" style="background: var(--sdpc-hero-gradient);">
                        <h3 class="h5 fw-bold text-white mb-2"><i class="bi bi-whatsapp me-2" style="color: #25D366;"></i>Connect on WhatsApp</h3>
                        <p class="small text-white-50 mb-3">
                            Message Dr. Mahesh Sahu directly on WhatsApp for clinic timings, directions, or appointment inquiries.
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ $doctor['whatsapp_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-whatsapp py-2">
                                <i class="bi bi-whatsapp me-1"></i> Chat on WhatsApp ({{ $doctor['phone_display'] }})
                            </a>
                            <a href="{{ $doctor['tel_link'] }}" class="btn btn-sdpc-amber py-2">
                                <i class="bi bi-telephone-fill me-1"></i> Call Clinic Directly
                            </a>
                            <a href="{{ $doctor['map_link'] }}" target="_blank" rel="noopener" class="btn btn-outline-light rounded-4 py-2 small">
                                <i class="bi bi-geo-alt me-1"></i> Open in Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
