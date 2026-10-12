<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0B1B3A">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="SDPC">
    <meta name="description" content="@yield('meta_description', 'SDPC Physiotherapy & Rehabilitation in Indore by Dr. Mahesh Sahu. Move Free. Live Pain-Free.')">

    <!-- Open Graph / WhatsApp Share Preview -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'SDPC - Dr. Mahesh Sahu | Physiotherapist in Indore')">
    <meta property="og:description" content="@yield('meta_description', 'Move Free. Live Pain-Free. Expert physiotherapy, pain relief, and rehabilitation in Indore by Dr. Mahesh Sahu.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ \App\Http\Controllers\SdpcController::assetUrl('/assets/icons/icon-512x512.png') }}">

    <title>@yield('title', 'SDPC — Dr. Mahesh Sahu | Move Free. Live Pain-Free.')</title>

    <!-- PWA Manifest & App Icons -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/icons/icon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/icons/apple-touch-icon.png') }}">

    <!-- Google Fonts: Poppins (Headings) & Inter (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- SDPC Material Design 3 Custom Styles -->
    <link href="{{ asset('assets/css/sdpc.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @php
        $sdpcDoctor = config('sdpc.doctor');
        $logoExists = file_exists(public_path('assets/logo.png'));
    @endphp

    <!-- Service Worker Update Notification Bar -->
    <div id="sdpcSwUpdateBanner" class="bg-navy-sdpc text-white py-2 px-3 d-none">
        <div class="container d-flex align-items-center justify-content-between gap-2">
            <span class="small fw-medium"><i class="bi bi-arrow-repeat text-warning me-1"></i> A new version of SDPC App is ready.</span>
            <button id="sdpcSwUpdateBtn" type="button" class="btn btn-sm btn-warning fw-semibold rounded-pill px-3">Update Now</button>
        </div>
    </div>

    <!-- Top App Header (Mobile App Bar + Desktop Navbar) -->
    <header class="sdpc-appbar">
        <div class="container py-2 py-lg-3">
            <div class="d-flex align-items-center justify-content-between gap-2">
                <!-- Brand Logo + Name -->
                <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                    @if($logoExists)
                        <img src="{{ \App\Http\Controllers\SdpcController::assetUrl('/assets/logo.png') }}"
                             alt="SDPC Logo"
                             class="sdpc-brand-logo"
                             onerror="this.style.display='none'; this.nextElementSibling.classList.remove('d-none');">
                    @endif
                    <span class="sdpc-svg-monogram {{ $logoExists ? 'd-none' : '' }}" aria-label="SDPC Monogram">
                        <svg width="44" height="44" viewBox="0 0 240 240" xmlns="http://www.w3.org/2000/svg" style="border-radius:14px;">
                            <defs>
                                <linearGradient id="hdrLogoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#0B1B3A"/>
                                    <stop offset="65%" stop-color="#0F766E"/>
                                    <stop offset="100%" stop-color="#14B8A6"/>
                                </linearGradient>
                            </defs>
                            <rect width="240" height="240" rx="54" fill="url(#hdrLogoGrad)"/>
                            <g fill="#14B8A6">
                                <ellipse cx="120" cy="52" rx="16" ry="6"/>
                                <ellipse cx="120" cy="70" rx="20" ry="7"/>
                                <ellipse cx="120" cy="90" rx="16" ry="6"/>
                            </g>
                            <path d="M 36 128 L 78 128 L 94 102 L 112 154 L 130 92 L 146 138 L 160 128 L 204 128"
                                  fill="none" stroke="#F59E0B" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
                            <text x="120" y="196" text-anchor="middle" font-family="Poppins, sans-serif" font-weight="800" font-size="52" fill="#FFFFFF">SDPC</text>
                        </svg>
                    </span>

                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="font-heading fw-bold fs-5 lh-1" style="color: var(--sdpc-navy);">SDPC</span>
                            <span class="badge rounded-pill" style="background: rgba(20,184,166,0.15); color: var(--sdpc-deep-teal); font-size: 0.68rem;">Indore</span>
                        </div>
                        <small class="d-block text-muted-sdpc" style="font-size: 0.74rem;">Dr. Mahesh Sahu • Physiotherapist</small>
                    </div>
                </a>

                <!-- Desktop Navigation Links (No Search Bar as requested) -->
                <nav class="d-none d-lg-flex align-items-center gap-1 sdpc-desktop-nav" aria-label="Main Navigation">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="bi bi-house-heart me-1"></i> Home
                    </a>
                    <a href="{{ route('videos.index') }}" class="nav-link {{ request()->routeIs('videos.*') ? 'active' : '' }}">
                        <i class="bi bi-play-btn me-1"></i> Videos
                    </a>
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2 me-1"></i> Categories
                    </a>
                    <a href="{{ route('doctor.profile') }}" class="nav-link {{ request()->routeIs('doctor.*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge me-1"></i> Doctor
                    </a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') || request()->routeIs('about') ? 'active' : '' }}">
                        <i class="bi bi-telephone-inbound me-1"></i> Contact
                    </a>
                </nav>

                <!-- Right Status & Call/WhatsApp Action -->
                <div class="d-flex align-items-center gap-2">
                    <div class="sdpc-net-badge js-network-status" title="Application Network Status">
                        <span class="sdpc-net-dot"></span>
                        <span class="js-network-label">Online</span>
                    </div>

                    <a href="{{ $sdpcDoctor['tel_link'] }}" class="btn btn-sm btn-sdpc-amber d-none d-sm-inline-flex align-items-center gap-1 rounded-pill px-3 py-2">
                        <i class="bi bi-telephone-fill"></i>
                        <span>{{ $sdpcDoctor['phone_display'] }}</span>
                    </a>

                    <a href="{{ $sdpcDoctor['whatsapp_link'] }}" target="_blank" rel="noopener"
                       class="btn btn-sm btn-sdpc-whatsapp d-inline-flex align-items-center justify-content-center rounded-circle"
                       style="width: 38px; height: 38px; padding: 0;"
                       aria-label="WhatsApp Dr. Mahesh Sahu"
                       title="Chat on WhatsApp">
                        <i class="bi bi-whatsapp fs-6"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Android PWA Install Prompt Banner (Shown automatically when installable) -->
    <div class="container mt-3">
        <div class="sdpc-pwa-banner js-pwa-install-banner align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('assets/icons/icon-192x192.png') }}" alt="SDPC App" width="42" height="42" class="rounded-3">
                <div>
                    <div class="fw-bold font-heading small">Install SDPC Physiotherapy App</div>
                    <div class="text-white-50" style="font-size: 0.76rem;">Fast offline access to exercise videos & clinic contact on your Android phone.</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 ms-auto">
                <button type="button" class="btn btn-sm btn-sdpc-amber rounded-pill px-3 py-1 js-pwa-install-btn">
                    <i class="bi bi-download me-1"></i> Install App
                </button>
                <button type="button" class="btn btn-sm btn-outline-light rounded-circle js-pwa-dismiss-btn" style="width:30px;height:30px;padding:0;" aria-label="Dismiss">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Screen Content -->
    <main class="py-3 py-lg-4">
        @yield('content')
    </main>

    <!-- Desktop & Tablet Footer -->
    <footer class="bg-white border-top mt-5 py-4 py-lg-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <img src="{{ asset('assets/logo.png') }}" alt="SDPC" width="38" height="38" class="rounded-3">
                        <div>
                            <h5 class="mb-0 fw-bold font-heading">SDPC Physiotherapy</h5>
                            <small class="text-teal-sdpc fw-semibold">Move Free. Live Pain-Free.</small>
                        </div>
                    </div>
                    <p class="text-muted-sdpc small mb-2">
                        {{ $sdpcDoctor['name'] }} ({{ $sdpcDoctor['specialty'] }}) — Rated {{ $sdpcDoctor['reviews_label'] }}.
                    </p>
                    <p class="text-muted-sdpc small mb-0">
                        <i class="bi bi-geo-alt-fill text-teal-sdpc me-1"></i> {{ $sdpcDoctor['address'] }}
                    </p>
                </div>
                <div class="col-lg-4">
                    <h6 class="font-heading fw-bold mb-2">Quick Navigation</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('home') }}" class="btn btn-sm btn-sdpc-outline rounded-pill py-1 px-3">Home</a>
                        <a href="{{ route('videos.index') }}" class="btn btn-sm btn-sdpc-outline rounded-pill py-1 px-3">Videos</a>
                        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-sdpc-outline rounded-pill py-1 px-3">Categories</a>
                        <a href="{{ route('doctor.profile') }}" class="btn btn-sm btn-sdpc-outline rounded-pill py-1 px-3">Doctor Profile</a>
                        <a href="{{ route('contact') }}" class="btn btn-sm btn-sdpc-outline rounded-pill py-1 px-3">Contact</a>
                    </div>
                </div>
                <div class="col-lg-3 text-lg-end">
                    <div class="d-grid gap-2">
                        <a href="{{ $sdpcDoctor['tel_link'] }}" class="btn btn-sdpc-amber btn-sm">
                            <i class="bi bi-telephone-fill me-1"></i> Call {{ $sdpcDoctor['phone_display'] }}
                        </a>
                        <a href="{{ $sdpcDoctor['whatsapp_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-whatsapp btn-sm">
                            <i class="bi bi-whatsapp me-1"></i> WhatsApp Clinic
                        </a>
                    </div>
                </div>
            </div>
            <hr class="my-3 text-muted opacity-25">
            <div class="d-flex flex-wrap justify-content-between align-items-center small text-muted-sdpc">
                <span>© {{ date('Y') }} SDPC • {{ $sdpcDoctor['name'] }}, Indore.</span>
                <span>Open daily, closes at 9 PM</span>
            </div>
        </div>
    </footer>

    <!-- Native-App-Style Fixed Bottom Navigation Bar (Mobile & Tablet < 992px) -->
    <nav class="sdpc-bottom-nav d-lg-none" aria-label="Mobile Bottom Navigation">
        <ul class="sdpc-bottom-nav-list">
            <li class="sdpc-bottom-nav-item">
                <a href="{{ route('home') }}" class="sdpc-bottom-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <span class="sdpc-bottom-nav-pill">
                        <i class="bi {{ request()->routeIs('home') ? 'bi-house-heart-fill' : 'bi-house-heart' }}"></i>
                    </span>
                    <span>Home</span>
                </a>
            </li>
            <li class="sdpc-bottom-nav-item">
                <a href="{{ route('videos.index') }}" class="sdpc-bottom-nav-link {{ request()->routeIs('videos.*') ? 'active' : '' }}">
                    <span class="sdpc-bottom-nav-pill">
                        <i class="bi {{ request()->routeIs('videos.*') ? 'bi-play-btn-fill' : 'bi-play-btn' }}"></i>
                    </span>
                    <span>Videos</span>
                </a>
            </li>
            <li class="sdpc-bottom-nav-item">
                <a href="{{ route('categories.index') }}" class="sdpc-bottom-nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <span class="sdpc-bottom-nav-pill">
                        <i class="bi {{ request()->routeIs('categories.*') ? 'bi-grid-1x2-fill' : 'bi-grid-1x2' }}"></i>
                    </span>
                    <span>Categories</span>
                </a>
            </li>
            <li class="sdpc-bottom-nav-item">
                <a href="{{ route('doctor.profile') }}" class="sdpc-bottom-nav-link {{ request()->routeIs('doctor.*') ? 'active' : '' }}">
                    <span class="sdpc-bottom-nav-pill">
                        <i class="bi {{ request()->routeIs('doctor.*') ? 'bi-person-badge-fill' : 'bi-person-badge' }}"></i>
                    </span>
                    <span>Doctor</span>
                </a>
            </li>
            <li class="sdpc-bottom-nav-item">
                <a href="{{ route('contact') }}" class="sdpc-bottom-nav-link {{ request()->routeIs('contact') || request()->routeIs('about') ? 'active' : '' }}">
                    <span class="sdpc-bottom-nav-pill">
                        <i class="bi {{ request()->routeIs('contact') || request()->routeIs('about') ? 'bi-telephone-inbound-fill' : 'bi-telephone-inbound' }}"></i>
                    </span>
                    <span>Contact</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Toast Feedback Pill -->
    <div class="sdpc-toast-container" aria-live="polite">
        <div id="sdpcToast" class="sdpc-toast">
            <i id="sdpcToastIcon" class="bi bi-check-circle-fill text-warning"></i>
            <span id="sdpcToastText">Action completed</span>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle + SDPC App Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/sdpc.js') }}"></script>
    @stack('scripts')
</body>
</html>
