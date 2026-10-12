@extends('layouts.app')

@section('title', $video['title'] . ' — SDPC Physiotherapy Video')
@section('meta_description', $video['short_description'])

@section('content')
@php
    $shareUrl = route('videos.show', ['slug' => $video['slug']]);
    $thumbUrl = \App\Http\Controllers\SdpcController::assetUrl($video['thumbnail']);
    $videoFileUrl = \App\Http\Controllers\SdpcController::assetUrl($video['video_file']);
@endphp

<div class="container">
    <!-- Top Back Button & Category Breadcrumb -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
        <a href="{{ route('videos.index') }}" class="btn btn-sm btn-sdpc-outline rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Videos
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('videos.index', ['category' => $video['category_slug']]) }}"
               class="badge rounded-pill text-decoration-none px-3 py-2"
               style="background: rgba(15, 118, 110, 0.14); color: var(--sdpc-deep-teal);">
                <i class="bi bi-tag-fill me-1"></i>{{ $video['category'] }}
            </a>
            <span class="badge bg-white text-secondary border rounded-pill px-3 py-2">
                <i class="bi bi-clock me-1"></i>{{ $video['duration'] }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Column: Video Player, Title, Sharing, Description, Benefits & Safety -->
        <div class="col-lg-8">
            <div class="sdpc-card p-3 p-md-4 mb-4">
                <!-- Video Player or Clearly Marked Sample Demonstration Card with HTML5 Player Controls -->
                <div class="sdpc-player-wrapper mb-3">
                    @if($physicalFileExists)
                        <video id="sdpcMainVideoPlayer"
                               controls
                               playsinline
                               preload="metadata"
                               poster="{{ $thumbUrl }}">
                            <source src="{{ $videoFileUrl }}" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                    @else
                        <!-- Clearly Marked Sample Video Card + Interactive Guided Canvas Player -->
                        <video id="sdpcSampleVideoPlayer"
                               controls
                               playsinline
                               poster="{{ $thumbUrl }}"
                               class="w-100 h-100">
                        </video>
                        <canvas id="sdpcSampleCanvas" width="800" height="450" class="d-none"></canvas>
                        <div id="sdpcSampleOverlayBadge"
                             class="position-absolute top-0 start-0 m-3 px-3 py-1 rounded-pill small fw-semibold d-flex align-items-center gap-2"
                             style="background: rgba(11, 27, 58, 0.88); color: #5EEAD4; border: 1px solid rgba(94, 234, 212, 0.4); z-index: 4; pointer-events: none;">
                            <i class="bi bi-info-circle-fill text-warning"></i>
                            <span>Sample Rehab Demonstration Card (Place MP4 at <code>public{{ $video['video_file'] }}</code>)</span>
                        </div>
                    @endif
                </div>

                <!-- Video Title & Published Meta -->
                <div class="d-flex flex-wrap align-items-center gap-2 text-muted-sdpc small mb-2">
                    <span><i class="bi bi-calendar3 me-1"></i>Published: {{ \Carbon\Carbon::parse($video['published_date'])->format('d M Y') }}</span>
                    <span>•</span>
                    <span><i class="bi bi-person-check-fill text-teal-sdpc me-1"></i>{{ $doctor['name'] }} ({{ $doctor['specialty'] }})</span>
                    <span>•</span>
                    <span><i class="bi bi-stopwatch me-1"></i>Duration: {{ $video['duration'] }}</span>
                </div>

                <h1 class="h3 fw-bold mb-3">{{ $video['title'] }}</h1>

                <!-- Share Bar: Native Share, WhatsApp Share, Copy Link -->
                <div class="d-flex flex-wrap align-items-center gap-2 p-3 rounded-4 mb-4" style="background: #F0FDFA; border: 1px solid #CCFBF1;">
                    <span class="fw-bold small font-heading me-auto">
                        <i class="bi bi-share-fill text-teal-sdpc me-1"></i> Share This Exercise Video:
                    </span>
                    <button type="button"
                            class="btn btn-sm btn-sdpc-teal rounded-pill px-3 py-2 js-share-video"
                            data-title="{{ $video['title'] }}"
                            data-url="{{ $shareUrl }}">
                        <i class="bi bi-share me-1"></i> Share Video
                    </button>
                    <button type="button"
                            class="btn btn-sm btn-sdpc-whatsapp rounded-pill px-3 py-2 js-whatsapp-share"
                            data-title="{{ $video['title'] }}"
                            data-url="{{ $shareUrl }}">
                        <i class="bi bi-whatsapp me-1"></i> WhatsApp
                    </button>
                    <button type="button"
                            class="btn btn-sm btn-sdpc-outline rounded-pill px-3 py-2 js-copy-link"
                            data-url="{{ $shareUrl }}">
                        <i class="bi bi-link-45deg me-1"></i> Copy Link
                    </button>
                </div>

                <!-- Full Description -->
                <div class="mb-4">
                    <h2 class="h5 fw-bold mb-2">About This Physiotherapy Session</h2>
                    <p class="text-muted-sdpc mb-0">{{ $video['full_description'] }}</p>
                </div>

                <!-- Step-by-Step Technique -->
                @if(!empty($video['steps']))
                <div class="mb-4">
                    <h2 class="h5 fw-bold mb-3"><i class="bi bi-list-ol text-teal-sdpc me-2"></i>How to Perform Safely</h2>
                    <div class="d-grid gap-2">
                        @foreach($video['steps'] as $idx => $step)
                            <div class="d-flex align-items-start gap-3 p-3 rounded-4 border bg-light">
                                <span class="badge rounded-circle d-inline-flex align-items-center justify-content-center fw-bold"
                                      style="width: 28px; height: 28px; background: var(--sdpc-navy); color: #FFF; flex-shrink:0;">
                                    {{ $idx + 1 }}
                                </span>
                                <span class="small fw-medium">{{ $step }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Benefits & Safety Instructions Grid -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 p-md-4 rounded-4 h-100" style="background: #F0FDFA; border: 1px solid #99F6E4;">
                            <h3 class="h6 fw-bold mb-3 d-flex align-items-center gap-2" style="color: #0F766E;">
                                <i class="bi bi-check2-circle fs-5"></i>
                                <span>Key Therapeutic Benefits</span>
                            </h3>
                            <ul class="list-unstyled mb-0 d-grid gap-2 small">
                                @foreach($video['benefits'] as $benefit)
                                    <li class="d-flex align-items-start gap-2">
                                        <i class="bi bi-check-lg text-success fw-bold mt-1"></i>
                                        <span>{{ $benefit }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 p-md-4 rounded-4 h-100" style="background: #FFFBEB; border: 1px solid #FDE68A;">
                            <h3 class="h6 fw-bold mb-3 d-flex align-items-center gap-2" style="color: #B45309;">
                                <i class="bi bi-shield-exclamation fs-5"></i>
                                <span>Safety Instructions</span>
                            </h3>
                            <ul class="list-unstyled mb-0 d-grid gap-2 small">
                                @foreach($video['safety_instructions'] as $safety)
                                    <li class="d-flex align-items-start gap-2">
                                        <i class="bi bi-exclamation-circle-fill text-warning mt-1"></i>
                                        <span>{{ $safety }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Column: Doctor Consultation Card + Related Videos -->
        <div class="col-lg-4">
            <!-- Doctor Quick Contact Card -->
            <div class="sdpc-card p-4 mb-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ \App\Http\Controllers\SdpcController::assetUrl($doctor['photo']) }}"
                         alt="{{ $doctor['name'] }}"
                         class="sdpc-doctor-avatar"
                         style="width: 68px; height: 68px;">
                    <div>
                        <h2 class="h6 fw-bold mb-0">{{ $doctor['name'] }}</h2>
                        <small class="text-teal-sdpc fw-semibold d-block">{{ $doctor['specialty'] }}</small>
                        <small class="text-muted-sdpc"><i class="bi bi-star-fill text-warning me-1"></i>{{ $doctor['reviews_label'] }}</small>
                    </div>
                </div>
                <p class="small text-muted-sdpc mb-3">
                    Experiencing pain during this exercise? Book an in-clinic evaluation at SDPC Khatiwala Tank, Indore.
                </p>
                <div class="d-grid gap-2">
                    <a href="{{ $doctor['tel_link'] }}" class="btn btn-sdpc-amber btn-sm">
                        <i class="bi bi-telephone-fill me-1"></i> Call {{ $doctor['phone_display'] }}
                    </a>
                    <a href="{{ $doctor['whatsapp_link'] }}" target="_blank" rel="noopener" class="btn btn-sdpc-whatsapp btn-sm">
                        <i class="bi bi-whatsapp me-1"></i> Ask on WhatsApp
                    </a>
                </div>
            </div>

            <!-- Related Physiotherapy Videos -->
            <div class="sdpc-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h2 class="h6 fw-bold mb-0">Related Videos</h2>
                    <a href="{{ route('videos.index') }}" class="small text-teal-sdpc fw-semibold text-decoration-none">View All</a>
                </div>

                <div class="d-grid gap-3">
                    @foreach($relatedVideos as $rel)
                        @php
                            $relUrl = route('videos.show', ['slug' => $rel['slug']]);
                            $relThumb = \App\Http\Controllers\SdpcController::assetUrl($rel['thumbnail']);
                        @endphp
                        <div class="d-flex gap-3 align-items-center p-2 rounded-4 border bg-light-subtle">
                            <a href="{{ $relUrl }}" class="flex-shrink-0 position-relative rounded-3 overflow-hidden" style="width: 110px; aspect-ratio: 16/9;">
                                <img src="{{ $relThumb }}" alt="{{ $rel['title'] }}" class="w-100 h-100 object-fit-cover">
                                <span class="position-absolute bottom-0 end-0 bg-dark text-white px-1 rounded-1 m-1" style="font-size: 0.65rem;">
                                    {{ $rel['duration'] }}
                                </span>
                            </a>
                            <div class="min-w-0">
                                <span class="badge bg-teal-subtle text-teal-sdpc p-0 mb-1" style="font-size: 0.7rem;">{{ $rel['category'] }}</span>
                                <h3 class="h6 fw-bold mb-1 text-truncate" style="font-size: 0.88rem;">
                                    <a href="{{ $relUrl }}" class="text-decoration-none" style="color: var(--sdpc-navy);">
                                        {{ $rel['title'] }}
                                    </a>
                                </h3>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ $relUrl }}" class="small text-teal-sdpc fw-semibold text-decoration-none" style="font-size: 0.76rem;">
                                        <i class="bi bi-play-fill"></i> Watch
                                    </a>
                                    <button type="button"
                                            class="btn btn-link p-0 text-muted-sdpc js-share-video"
                                            style="font-size: 0.76rem;"
                                            data-title="{{ $rel['title'] }}"
                                            data-url="{{ $relUrl }}">
                                        <i class="bi bi-share"></i> Share
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if(!$physicalFileExists)
@push('scripts')
<script>
/**
 * When a real clinic MP4 has not yet been placed in public/assets/videos/,
 * provide a smooth animated canvas stream inside the HTML5 <video> element
 * so the user can test play/pause/scrub controls while clearly seeing the Sample Rehab Card notice.
 */
document.addEventListener('DOMContentLoaded', function () {
    const videoEl = document.getElementById('sdpcSampleVideoPlayer');
    const canvas = document.getElementById('sdpcSampleCanvas');
    if (!videoEl || !canvas) return;

    const ctx = canvas.getContext('2d');
    const title = @json($video['title']);
    const category = @json($video['category']);
    const steps = @json($video['steps'] ?? []);
    let frame = 0;

    function drawSampleFrame() {
        frame++;
        // Navy to Deep Teal background
        const grad = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
        grad.addColorStop(0, '#0B1B3A');
        grad.addColorStop(1, '#0F766E');
        ctx.fillStyle = grad;
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Animated breathing / motion circle
        const pulse = Math.sin(frame * 0.05) * 18;
        ctx.strokeStyle = 'rgba(20, 184, 166, 0.35)';
        ctx.lineWidth = 4;
        ctx.beginPath();
        ctx.arc(630, 225, 85 + pulse, 0, Math.PI * 2);
        ctx.stroke();

        ctx.fillStyle = 'rgba(245, 158, 11, 0.9)';
        ctx.beginPath();
        ctx.arc(630, 225, 42 + pulse * 0.4, 0, Math.PI * 2);
        ctx.fill();

        // Text overlays
        ctx.fillStyle = '#5EEAD4';
        ctx.font = 'bold 18px Inter, sans-serif';
        ctx.fillText('SDPC PHYSIOTHERAPY SAMPLE STREAM • ' + category.toUpperCase(), 44, 110);

        ctx.fillStyle = '#FFFFFF';
        ctx.font = 'bold 28px Poppins, sans-serif';
        ctx.fillText(title.substring(0, 42), 44, 160);

        const stepIdx = Math.floor((frame / 150) % Math.max(1, steps.length));
        const activeStep = steps[stepIdx] || 'Follow slow, pain-free range of motion movements.';
        ctx.fillStyle = '#FDE68A';
        ctx.font = '600 18px Inter, sans-serif';
        ctx.fillText('Step ' + (stepIdx + 1) + ': ' + activeStep.substring(0, 58), 44, 230);

        ctx.fillStyle = '#CBD5E1';
        ctx.font = '16px Inter, sans-serif';
        ctx.fillText('Dr. Mahesh Sahu • 098933 62477 • Khatiwala Tank, Indore', 44, 390);

        requestAnimationFrame(drawSampleFrame);
    }

    drawSampleFrame();
    if (canvas.captureStream) {
        try {
            videoEl.srcObject = canvas.captureStream(30);
        } catch (e) {
            // Poster image remains visible if captureStream is restricted
        }
    }
});
</script>
@endpush
@endif
