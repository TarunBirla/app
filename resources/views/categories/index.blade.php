@extends('layouts.app')

@section('title', 'Physiotherapy Treatment Categories — SDPC | Dr. Mahesh Sahu')
@section('meta_description', 'Explore all 19 specialized physiotherapy and rehabilitation treatment categories offered by Dr. Mahesh Sahu at SDPC in Indore.')

@section('content')
<div class="container">
    <!-- Hero Header -->
    <div class="sdpc-hero p-4 p-md-5 mb-4">
        <div class="row align-items-center g-3">
            <div class="col-lg-8">
                <span class="badge rounded-pill px-3 py-1 mb-2" style="background: rgba(255,255,255,0.15);">
                    <i class="bi bi-grid-1x2-fill text-warning me-1"></i> 19 Specialized Services
                </span>
                <h1 class="h2 fw-bold mb-2">Physiotherapy Treatment Categories</h1>
                <p class="text-white-50 mb-0">
                    Comprehensive musculoskeletal, neurological, paediatric, geriatric, and post-surgical rehabilitation services at SDPC Indore.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ $doctor['tel_link'] }}" class="btn btn-sdpc-amber rounded-pill px-4">
                    <i class="bi bi-telephone-fill me-1"></i> Book Consultation
                </a>
            </div>
        </div>
    </div>

    <!-- All 19 Categories Grid -->
    <div class="row g-3 g-md-4 mb-5">
        @foreach($categories as $index => $cat)
            @php
                $videoCount = $categoryVideoCounts[$cat['slug']] ?? 0;
            @endphp
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="sdpc-card sdpc-card-hover p-4 h-100 d-flex flex-column">
                    <div class="d-flex align-items-start justify-content-between gap-3 mb-3">
                        <div class="sdpc-cat-icon">
                            <i class="bi {{ $cat['icon'] }}"></i>
                        </div>
                        @if($videoCount > 0)
                            <span class="badge rounded-pill px-3 py-1" style="background: #ECFDF5; color: #0F766E; border: 1px solid #A7F3D0;">
                                <i class="bi bi-play-circle-fill me-1"></i>{{ $videoCount }} {{ $videoCount === 1 ? 'Video' : 'Videos' }}
                            </span>
                        @else
                            <span class="badge bg-light text-secondary border rounded-pill px-3 py-1">
                                In-Clinic Therapy
                            </span>
                        @endif
                    </div>

                    <h2 class="h5 fw-bold mb-2">{{ $cat['name'] }}</h2>
                    <p class="text-muted-sdpc small mb-4 flex-grow-1">
                        {{ $cat['short_desc'] }}
                    </p>

                    <div class="d-flex align-items-center gap-2 mt-auto pt-3 border-top">
                        <a href="{{ route('videos.index', ['category' => $cat['slug']]) }}"
                           class="btn btn-sm {{ $videoCount > 0 ? 'btn-sdpc-teal' : 'btn-sdpc-outline' }} flex-grow-1 rounded-pill py-2">
                            <i class="bi bi-collection-play me-1"></i>
                            {{ $videoCount > 0 ? 'Watch Rehab Videos' : 'View Related Videos' }}
                        </a>
                        <a href="{{ $doctor['whatsapp_link'] }}?text={{ urlencode('Hello Dr. Mahesh Sahu, I would like to inquire about ' . $cat['name'] . ' at SDPC Indore.') }}"
                           target="_blank" rel="noopener"
                           class="btn btn-sm btn-sdpc-whatsapp rounded-pill px-3 py-2"
                           title="Inquire on WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Bottom Consultation CTA -->
    <div class="sdpc-card p-4 p-md-5 text-center" style="background: linear-gradient(135deg, #FFFFFF 0%, #F0FDFA 100%);">
        <h2 class="h4 fw-bold mb-2">Not Sure Which Physiotherapy Treatment You Need?</h2>
        <p class="text-muted-sdpc small mb-3 mx-auto" style="max-width: 620px;">
            Reach out to <strong>{{ $doctor['name'] }}</strong> at SDPC ({{ $doctor['address'] }}) for an accurate physical evaluation and personalized recovery plan.
        </p>
        <div class="d-flex justify-content-center flex-wrap gap-2">
            <a href="{{ $doctor['tel_link'] }}" class="btn btn-sdpc-amber">
                <i class="bi bi-telephone-fill me-1"></i> Call {{ $doctor['phone_display'] }}
            </a>
            <a href="{{ $doctor['whatsapp_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-whatsapp">
                <i class="bi bi-whatsapp me-1"></i> Message on WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
