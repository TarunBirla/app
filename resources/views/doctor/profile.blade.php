@extends('layouts.app')

@section('title', 'Dr. Mahesh Sahu — Physiotherapist Profile | SDPC Indore')
@section('meta_description', 'Profile of Dr. Mahesh Sahu, Physiotherapist in Indore (4.9 stars, 211 Google reviews). Located at 584C, near Briliant School, Khatiwala Tank, Indore.')

@section('content')
<div class="container">
    <!-- Doctor Profile Hero Card -->
    <section class="sdpc-hero p-4 p-lg-5 mb-4">
        <div class="row align-items-center g-4">
            <div class="col-md-auto text-center text-md-start">
                <img src="{{ \App\Http\Controllers\SdpcController::assetUrl($doctor['photo']) }}"
                     alt="{{ $doctor['name'] }}"
                     class="sdpc-doctor-avatar-lg">
            </div>
            <div class="col-md">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-2 mb-2">
                    <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill">
                        <i class="bi bi-star-fill me-1"></i>{{ $doctor['reviews_label'] }}
                    </span>
                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(20, 184, 166, 0.25); color: #A7F3D0;">
                        <i class="bi bi-patch-check-fill me-1"></i>Verified Physiotherapist
                    </span>
                </div>
                <h1 class="display-6 fw-bold mb-1 text-center text-md-start">{{ $doctor['name'] }}</h1>
                <p class="fs-5 mb-2 text-center text-md-start" style="color: #5EEAD4;">{{ $doctor['specialty'] }} • SDPC Indore</p>
                <p class="text-white-50 small mb-4 text-center text-md-start" style="max-width: 680px;">
                    {{ $doctor['summary'] }}
                </p>

                <!-- Action Buttons: Call, WhatsApp, Map, External Skedoc Profile -->
                <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2">
                    <a href="{{ $doctor['tel_link'] }}" class="btn btn-sdpc-amber">
                        <i class="bi bi-telephone-fill me-1"></i> Call {{ $doctor['phone_display'] }}
                    </a>
                    <a href="{{ $doctor['whatsapp_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-whatsapp">
                        <i class="bi bi-whatsapp me-1"></i> WhatsApp Now
                    </a>
                    <a href="{{ $doctor['map_link'] }}" target="_blank" rel="noopener" class="btn btn-outline-light rounded-4 px-3 py-2 fw-semibold">
                        <i class="bi bi-geo-alt-fill text-warning me-1"></i> Google Maps
                    </a>
                    <a href="{{ $doctor['profile_link'] }}" target="_blank" rel="noopener" class="btn btn-outline-light rounded-4 px-3 py-2 fw-semibold">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Skedoc Profile
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Verified Clinic & Practice Highlights -->
    <div class="row g-4 mb-5">
        <div class="col-lg-5">
            <div class="sdpc-card p-4 h-100">
                <h2 class="h5 fw-bold mb-3"><i class="bi bi-building-check text-teal-sdpc me-2"></i>Verified Clinic Information</h2>

                <div class="d-grid gap-3">
                    <div class="p-3 rounded-4 border bg-light-subtle">
                        <div class="small text-muted-sdpc fw-semibold">Doctor Name & Specialty</div>
                        <div class="fw-bold">{{ $doctor['name'] }} — {{ $doctor['specialty'] }}</div>
                    </div>

                    <div class="p-3 rounded-4 border bg-light-subtle">
                        <div class="small text-muted-sdpc fw-semibold">Patient Rating</div>
                        <div class="fw-bold text-success">
                            <i class="bi bi-star-fill text-warning me-1"></i>{{ $doctor['reviews_label'] }}
                        </div>
                    </div>

                    <div class="p-3 rounded-4 border bg-light-subtle">
                        <div class="small text-muted-sdpc fw-semibold">Clinic Address</div>
                        <div class="fw-semibold small">{{ $doctor['address'] }}</div>
                        <a href="{{ $doctor['map_link'] }}" target="_blank" rel="noopener" class="small text-teal-sdpc fw-bold text-decoration-none d-inline-block mt-1">
                            <i class="bi bi-compass me-1"></i>Get Directions on Google Maps
                        </a>
                    </div>

                    <div class="p-3 rounded-4 border bg-light-subtle">
                        <div class="small text-muted-sdpc fw-semibold">Clinic Timings</div>
                        <div class="fw-bold"><i class="bi bi-clock text-teal-sdpc me-1"></i>{{ $doctor['hours'] }}</div>
                    </div>

                    <div class="p-3 rounded-4 border bg-light-subtle">
                        <div class="small text-muted-sdpc fw-semibold">Direct Phone & External Listing</div>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <a href="{{ $doctor['tel_link'] }}" class="btn btn-sm btn-sdpc-outline rounded-pill">
                                <i class="bi bi-telephone me-1"></i>{{ $doctor['phone_display'] }}
                            </a>
                            <a href="{{ $doctor['profile_link'] }}" target="_blank" rel="noopener" class="btn btn-sm btn-sdpc-outline rounded-pill">
                                <i class="bi bi-globe2 me-1"></i>View on Skedoc
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Treatment Services (All 19 Predefined Services) -->
        <div class="col-lg-7">
            <div class="sdpc-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h2 class="h5 fw-bold mb-0"><i class="bi bi-heart-pulse text-teal-sdpc me-2"></i>Available Treatment Services</h2>
                        <small class="text-muted-sdpc">All 19 physiotherapy & rehabilitation specialties offered at SDPC</small>
                    </div>
                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-sdpc-outline rounded-pill">Details</a>
                </div>

                <div class="row g-2">
                    @foreach($categories as $cat)
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('videos.index', ['category' => $cat['slug']]) }}"
                               class="d-flex align-items-center gap-2 p-2 rounded-3 border text-decoration-none bg-white sdpc-card-hover">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-3"
                                      style="width: 36px; height: 36px; background: rgba(20,184,166,0.12); color: var(--sdpc-deep-teal); flex-shrink: 0;">
                                    <i class="bi {{ $cat['icon'] }}"></i>
                                </span>
                                <span class="small fw-semibold text-dark">{{ $cat['name'] }}</span>
                                <i class="bi bi-chevron-right ms-auto text-muted small"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
