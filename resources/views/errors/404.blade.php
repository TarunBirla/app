@extends('layouts.app')

@section('title', 'Page or Video Not Found — SDPC Physiotherapy')

@section('content')
@php
    $doctor = config('sdpc.doctor');
@endphp
<div class="container py-4">
    <div class="sdpc-card p-4 p-md-5 text-center mx-auto" style="max-width: 620px;">
        <div class="sdpc-cat-icon mx-auto mb-3" style="width: 72px; height: 72px; font-size: 2rem;">
            <i class="bi bi-compass"></i>
        </div>
        <span class="badge rounded-pill px-3 py-1 mb-2" style="background: rgba(245, 158, 11, 0.16); color: #B45309;">
            404 • Content Not Found
        </span>
        <h1 class="h3 fw-bold mb-2">We Couldn't Find That Page or Video</h1>
        <p class="text-muted-sdpc small mb-4">
            The physiotherapy video or page link you followed may have moved or does not exist. Explore our guided exercise library or return to the SDPC home screen below.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="{{ route('home') }}" class="btn btn-sdpc-teal">
                <i class="bi bi-house-heart me-1"></i> Go to Home
            </a>
            <a href="{{ route('videos.index') }}" class="btn btn-sdpc-amber">
                <i class="bi bi-play-btn-fill me-1"></i> Browse Video Library
            </a>
            <a href="{{ $doctor['whatsapp_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-whatsapp">
                <i class="bi bi-whatsapp me-1"></i> WhatsApp Clinic
            </a>
        </div>
    </div>
</div>
@endsection
