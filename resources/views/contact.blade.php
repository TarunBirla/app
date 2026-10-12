@extends('layouts.app')

@section('title', 'About & Contact SDPC — Dr. Mahesh Sahu | Indore')
@section('meta_description', 'Contact SDPC Physiotherapy Clinic in Indore. Call 098933 62477, WhatsApp Dr. Mahesh Sahu, or get directions to 584C, near Briliant School, Khatiwala Tank, Indore.')

@section('content')
<div class="container">
    <!-- Header Banner -->
    <section class="sdpc-hero p-4 p-lg-5 mb-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <span class="badge rounded-pill px-3 py-1 mb-2" style="background: rgba(255,255,255,0.16);">
                    <i class="bi bi-geo-alt-fill text-warning me-1"></i> Khatiwala Tank, Indore
                </span>
                <h1 class="display-6 fw-bold mb-2">About SDPC & Clinic Contact</h1>
                <p class="text-white-50 mb-0">
                    "Move Free. Live Pain-Free." — Connect directly with <strong class="text-white">{{ $doctor['name'] }}</strong> ({{ $doctor['specialty'] }}) for appointments, rehabilitation guidance, and clinic directions.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-inline-flex align-items-center gap-2 bg-white text-dark px-3 py-2 rounded-pill shadow-sm">
                    <i class="bi bi-star-fill text-warning"></i>
                    <span class="fw-bold small">{{ $doctor['reviews_label'] }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Direct Contact Action Cards -->
    <div class="row g-3 g-md-4 mb-5">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="sdpc-card p-4 h-100 d-flex flex-column">
                <div class="sdpc-cat-icon mb-3" style="background: rgba(245, 158, 11, 0.14); color: #D97706;">
                    <i class="bi bi-telephone-outbound-fill"></i>
                </div>
                <h2 class="h6 fw-bold mb-1">Call Clinic</h2>
                <p class="text-muted-sdpc small mb-3 flex-grow-1">Speak directly with the clinic for appointments and consultation slots.</p>
                <a href="{{ $doctor['tel_link'] }}" class="btn btn-sdpc-amber w-100 mt-auto">
                    <i class="bi bi-telephone-fill me-1"></i> {{ $doctor['phone_display'] }}
                </a>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="sdpc-card p-4 h-100 d-flex flex-column">
                <div class="sdpc-cat-icon mb-3" style="background: rgba(37, 211, 102, 0.14); color: #16A34A;">
                    <i class="bi bi-whatsapp"></i>
                </div>
                <h2 class="h6 fw-bold mb-1">WhatsApp Chat</h2>
                <p class="text-muted-sdpc small mb-3 flex-grow-1">Send a quick message on WhatsApp for clinic timings or exercise queries.</p>
                <a href="{{ $doctor['whatsapp_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-whatsapp w-100 mt-auto">
                    <i class="bi bi-whatsapp me-1"></i> Message Now
                </a>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="sdpc-card p-4 h-100 d-flex flex-column">
                <div class="sdpc-cat-icon mb-3">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <h2 class="h6 fw-bold mb-1">Google Maps</h2>
                <p class="text-muted-sdpc small mb-3 flex-grow-1">{{ $doctor['address'] }}</p>
                <a href="{{ $doctor['map_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-teal w-100 mt-auto">
                    <i class="bi bi-map-fill me-1"></i> Open Directions
                </a>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="sdpc-card p-4 h-100 d-flex flex-column">
                <div class="sdpc-cat-icon mb-3" style="background: rgba(11, 27, 58, 0.1); color: #0B1B3A;">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
                <h2 class="h6 fw-bold mb-1">Skedoc Profile</h2>
                <p class="text-muted-sdpc small mb-3 flex-grow-1">View {{ $doctor['name'] }}'s verified external practitioner profile online.</p>
                <a href="{{ $doctor['profile_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-outline w-100 mt-auto">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Visit Profile
                </a>
            </div>
        </div>
    </div>

    <!-- About SDPC Clinic & Location Details -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="sdpc-card p-4 p-md-5 h-100">
                <span class="text-teal-sdpc fw-bold small text-uppercase">About Our Clinic</span>
                <h2 class="h4 fw-bold mt-1 mb-3">SDPC Physiotherapy — Move Free. Live Pain-Free.</h2>
                <p class="text-muted-sdpc mb-3">
                    Led by <strong>{{ $doctor['name'] }}</strong> ({{ $doctor['specialty'] }}), SDPC in Indore provides structured, patient-centered physiotherapy and physical rehabilitation. With a trusted rating of <strong>{{ $doctor['reviews_label'] }}</strong>, our clinic focuses on helping individuals overcome acute and chronic pain safely.
                </p>
                <p class="text-muted-sdpc mb-4">
                    Whether you are recovering from orthopedic surgery, managing arthritis or back pain, or seeking neurological and balance rehabilitation, every session is tailored to restore natural movement and daily independence.
                </p>

                <div class="d-grid gap-3">
                    @foreach($benefits as $benefit)
                        <div class="d-flex align-items-start gap-3">
                            <span class="badge rounded-3 p-2" style="background: rgba(20,184,166,0.15); color: var(--sdpc-deep-teal);">
                                <i class="bi {{ $benefit['icon'] }} fs-6"></i>
                            </span>
                            <div>
                                <div class="fw-bold small font-heading">{{ $benefit['title'] }}</div>
                                <div class="text-muted-sdpc small">{{ $benefit['description'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="sdpc-card p-4 p-md-5 h-100 d-flex flex-column justify-content-between">
                <div>
                    <span class="text-teal-sdpc fw-bold small text-uppercase">Visit Us in Indore</span>
                    <h2 class="h4 fw-bold mt-1 mb-4">Clinic Hours & Address</h2>

                    <div class="p-3 rounded-4 border mb-3 bg-light-subtle">
                        <div class="d-flex align-items-start gap-3">
                            <i class="bi bi-pin-map-fill text-teal-sdpc fs-4"></i>
                            <div>
                                <div class="fw-bold font-heading">Full Address</div>
                                <div class="text-muted-sdpc small">{{ $doctor['address'] }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-4 border mb-3 bg-light-subtle">
                        <div class="d-flex align-items-start gap-3">
                            <i class="bi bi-clock-history text-teal-sdpc fs-4"></i>
                            <div>
                                <div class="fw-bold font-heading">Opening Hours</div>
                                <div class="text-success fw-semibold small">{{ $doctor['hours'] }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-4 border mb-4 bg-light-subtle">
                        <div class="d-flex align-items-start gap-3">
                            <i class="bi bi-telephone-forward-fill text-teal-sdpc fs-4"></i>
                            <div>
                                <div class="fw-bold font-heading">Phone & WhatsApp</div>
                                <div class="text-muted-sdpc small">{{ $doctor['phone_display'] }} ({{ $doctor['phone_e164'] }})</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Interactive Directions Card -->
                <div class="p-4 rounded-4 text-white" style="background: var(--sdpc-hero-gradient);">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div>
                            <h3 class="h6 fw-bold text-white mb-1">Need Directions to Khatiwala Tank?</h3>
                            <p class="small text-white-50 mb-0">Near Briliant School, Indore 452014</p>
                        </div>
                        <a href="{{ $doctor['map_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-amber btn-sm rounded-pill px-3">
                            <i class="bi bi-geo-alt-fill me-1"></i> Launch Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
