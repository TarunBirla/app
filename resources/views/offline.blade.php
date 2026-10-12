@extends('layouts.app')

@section('title', 'Offline Mode — SDPC Physiotherapy App')

@section('content')
<div class="container py-4">
    <div class="sdpc-card p-4 p-md-5 text-center mx-auto" style="max-width: 640px;">
        <div class="sdpc-cat-icon mx-auto mb-3" style="width: 72px; height: 72px; font-size: 2rem;">
            <i class="bi bi-wifi-off"></i>
        </div>
        <span class="badge bg-warning text-dark rounded-pill px-3 py-1 mb-2">
            Offline Mode Active
        </span>
        <h1 class="h3 fw-bold mb-2">You Are Currently Offline</h1>
        <p class="text-muted-sdpc small mb-4">
            No internet connection detected. You can still view SDPC clinic details and call <strong>{{ $doctor['name'] }}</strong> directly anytime.
        </p>

        <div class="p-3 rounded-4 border bg-light text-start mb-4">
            <div class="fw-bold font-heading mb-1">{{ $doctor['name'] }} ({{ $doctor['specialty'] }})</div>
            <div class="small text-muted-sdpc mb-1"><i class="bi bi-geo-alt-fill text-teal-sdpc me-1"></i>{{ $doctor['address'] }}</div>
            <div class="small text-muted-sdpc mb-1"><i class="bi bi-clock-fill text-teal-sdpc me-1"></i>{{ $doctor['hours'] }}</div>
            <div class="small fw-bold text-success"><i class="bi bi-telephone-fill me-1"></i>{{ $doctor['phone_display'] }}</div>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="{{ $doctor['tel_link'] }}" class="btn btn-sdpc-amber">
                <i class="bi bi-telephone-fill me-1"></i> Call {{ $doctor['phone_display'] }}
            </a>
            <button type="button" onclick="window.location.reload()" class="btn btn-sdpc-teal">
                <i class="bi bi-arrow-clockwise me-1"></i> Retry Connection
            </button>
            <a href="{{ route('home') }}" class="btn btn-sdpc-outline">
                <i class="bi bi-house-heart me-1"></i> Cached Home
            </a>
        </div>
    </div>
</div>
@endsection
