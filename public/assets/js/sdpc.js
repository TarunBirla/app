/**
 * SDPC Physiotherapy Frontend Application Script
 * - Service Worker Registration & Update notification
 * - Online / Offline Live Status Indicator
 * - Android PWA Install Prompt Handler
 * - Native Web Share API + WhatsApp Share + Clipboard Copy Link Fallback
 * - Instant Frontend Video Library Filters (Category, Date Range, Sort Order)
 * - Interactive Sample Rehab Video Canvas Stream (when local MP4 is not yet placed)
 */

(function () {
    'use strict';

    // -------------------------------------------------------------------------
    // 1. Toast Notification Helper
    // -------------------------------------------------------------------------
    window.showSdpcToast = function (message, iconClass = 'bi-check-circle-fill text-warning') {
        const toastEl = document.getElementById('sdpcToast');
        const toastText = document.getElementById('sdpcToastText');
        const toastIcon = document.getElementById('sdpcToastIcon');
        if (!toastEl || !toastText) return;

        toastText.textContent = message;
        if (toastIcon) {
            toastIcon.className = 'bi ' + iconClass;
        }
        toastEl.classList.add('show');
        clearTimeout(window._sdpcToastTimer);
        window._sdpcToastTimer = setTimeout(() => {
            toastEl.classList.remove('show');
        }, 3000);
    };

    // -------------------------------------------------------------------------
    // 2. Online / Offline Status Indicator
    // -------------------------------------------------------------------------
    function updateNetworkBadge() {
        const badges = document.querySelectorAll('.js-network-status');
        const isOnline = navigator.onLine;
        badges.forEach((badge) => {
            const label = badge.querySelector('.js-network-label');
            if (isOnline) {
                badge.classList.remove('is-offline');
                if (label) label.textContent = 'Online';
            } else {
                badge.classList.add('is-offline');
                if (label) label.textContent = 'Offline Mode';
            }
        });
    }

    window.addEventListener('online', () => {
        updateNetworkBadge();
        window.showSdpcToast('Back online! All features active.', 'bi-wifi text-info');
    });

    window.addEventListener('offline', () => {
        updateNetworkBadge();
        window.showSdpcToast('You are offline. Viewing cached app content.', 'bi-wifi-off text-danger');
    });

    document.addEventListener('DOMContentLoaded', updateNetworkBadge);

    // -------------------------------------------------------------------------
    // 3. Service Worker Registration & Update Banner
    // -------------------------------------------------------------------------
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker
                .register('/service-worker.js')
                .then((registration) => {
                    // Check if an updated worker is waiting
                    if (registration.waiting) {
                        promptServiceWorkerUpdate(registration.waiting);
                    }

                    registration.addEventListener('updatefound', () => {
                        const newWorker = registration.installing;
                        if (!newWorker) return;
                        newWorker.addEventListener('statechange', () => {
                            if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                promptServiceWorkerUpdate(newWorker);
                            }
                        });
                    });
                })
                .catch((err) => {
                    console.warn('SDPC Service Worker registration note:', err);
                });

            let refreshing = false;
            navigator.serviceWorker.addEventListener('controllerchange', () => {
                if (refreshing) return;
                refreshing = true;
                window.location.reload();
            });
        });
    }

    function promptServiceWorkerUpdate(worker) {
        const updateBar = document.getElementById('sdpcSwUpdateBanner');
        const updateBtn = document.getElementById('sdpcSwUpdateBtn');
        if (updateBar) {
            updateBar.classList.remove('d-none');
            if (updateBtn) {
                updateBtn.addEventListener('click', () => {
                    worker.postMessage({ type: 'SKIP_WAITING' });
                });
            }
        }
    }

    // -------------------------------------------------------------------------
    // 4. PWA Install Prompt (beforeinstallprompt)
    // -------------------------------------------------------------------------
    let deferredInstallPrompt = null;

    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredInstallPrompt = e;
        const installBanners = document.querySelectorAll('.js-pwa-install-banner');
        installBanners.forEach((el) => el.classList.add('show'));
    });

    document.addEventListener('click', async (e) => {
        const installBtn = e.target.closest('.js-pwa-install-btn');
        if (installBtn) {
            if (deferredInstallPrompt) {
                deferredInstallPrompt.prompt();
                const { outcome } = await deferredInstallPrompt.userChoice;
                if (outcome === 'accepted') {
                    window.showSdpcToast('Installing SDPC App on your phone...');
                }
                deferredInstallPrompt = null;
                document.querySelectorAll('.js-pwa-install-banner').forEach((el) => el.classList.remove('show'));
            } else {
                window.showSdpcToast('Use browser menu -> "Add to Home screen" to install SDPC App.');
            }
        }

        const dismissBtn = e.target.closest('.js-pwa-dismiss-btn');
        if (dismissBtn) {
            document.querySelectorAll('.js-pwa-install-banner').forEach((el) => el.classList.remove('show'));
        }
    });

    window.addEventListener('appinstalled', () => {
        deferredInstallPrompt = null;
        document.querySelectorAll('.js-pwa-install-banner').forEach((el) => el.classList.remove('show'));
        window.showSdpcToast('SDPC App installed successfully!');
    });

    // -------------------------------------------------------------------------
    // 5. Video Sharing (Native Share API, WhatsApp, Copy Link)
    // -------------------------------------------------------------------------
    window.sdpcShareContent = async function (title, url) {
        const fullUrl = url.startsWith('http') ? url : window.location.origin + url;
        const shareText = `${title} — Watch guided physiotherapy by Dr. Mahesh Sahu (SDPC Indore):`;

        if (navigator.share) {
            try {
                await navigator.share({
                    title: `${title} | SDPC Physiotherapy`,
                    text: shareText,
                    url: fullUrl,
                });
                return;
            } catch (err) {
                if (err.name === 'AbortError') return;
            }
        }

        // Fallback: copy link to clipboard and open share modal/toast
        await window.sdpcCopyLink(fullUrl, `Link copied! You can now paste & share "${title}".`);
    };

    window.sdpcCopyLink = async function (url, customMsg) {
        const fullUrl = url.startsWith('http') ? url : window.location.origin + url;
        try {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                await navigator.clipboard.writeText(fullUrl);
            } else {
                const tempInput = document.createElement('input');
                tempInput.value = fullUrl;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
            }
            window.showSdpcToast(customMsg || 'Video link copied to clipboard!');
        } catch (err) {
            window.showSdpcToast('Could not copy automatically: ' + fullUrl, 'bi-info-circle text-warning');
        }
    };

    window.sdpcShareWhatsApp = function (title, url) {
        const fullUrl = url.startsWith('http') ? url : window.location.origin + url;
        const message = encodeURIComponent(`*${title}*\nGuided Physiotherapy by Dr. Mahesh Sahu (SDPC Indore)\nWatch here: ${fullUrl}`);
        window.open(`https://wa.me/?text=${message}`, '_blank', 'noopener,noreferrer');
    };

    // Delegate click listeners for share/copy buttons
    document.addEventListener('click', (e) => {
        const shareBtn = e.target.closest('.js-share-video');
        if (shareBtn) {
            e.preventDefault();
            const title = shareBtn.getAttribute('data-title') || 'SDPC Physiotherapy Video';
            const url = shareBtn.getAttribute('data-url') || window.location.href;
            window.sdpcShareContent(title, url);
        }

        const copyBtn = e.target.closest('.js-copy-link');
        if (copyBtn) {
            e.preventDefault();
            const url = copyBtn.getAttribute('data-url') || window.location.href;
            window.sdpcCopyLink(url);
        }

        const waBtn = e.target.closest('.js-whatsapp-share');
        if (waBtn) {
            e.preventDefault();
            const title = waBtn.getAttribute('data-title') || 'SDPC Physiotherapy Video';
            const url = waBtn.getAttribute('data-url') || window.location.href;
            window.sdpcShareWhatsApp(title, url);
        }
    });

    // -------------------------------------------------------------------------
    // 6. Videos Library Instant Frontend Filtering & Sorting (No Page Reload)
    // -------------------------------------------------------------------------
    document.addEventListener('DOMContentLoaded', () => {
        const videoGrid = document.getElementById('sdpcVideoGrid');
        if (!videoGrid) return;

        const categoryChips = document.querySelectorAll('.js-video-category-chip');
        const categorySelect = document.getElementById('sdpcFilterCategorySelect');
        const dateRangeSelect = document.getElementById('sdpcFilterDateRange');
        const dateFromInput = document.getElementById('sdpcFilterDateFrom');
        const dateToInput = document.getElementById('sdpcFilterDateTo');
        const sortSelect = document.getElementById('sdpcFilterSort');
        const resetBtn = document.getElementById('sdpcFilterReset');
        const countLabel = document.getElementById('sdpcVideoCountLabel');
        const emptyState = document.getElementById('sdpcVideoEmptyState');

        let activeCategory = videoGrid.getAttribute('data-initial-category') || 'all';

        function applyVideoFilters() {
            const cards = Array.from(videoGrid.querySelectorAll('.js-video-card-item'));
            const dateRangeVal = dateRangeSelect ? dateRangeSelect.value : 'all';
            const fromVal = dateFromInput && dateFromInput.value ? new Date(dateFromInput.value) : null;
            const toVal = dateToInput && dateToInput.value ? new Date(dateToInput.value) : null;
            const sortVal = sortSelect ? sortSelect.value : 'newest';

            // Reference "today" based on newest video or current system date
            const now = new Date('2026-10-12T23:59:59');

            let visibleCount = 0;

            cards.forEach((card) => {
                const cardCat = card.getAttribute('data-category') || '';
                const pubDateStr = card.getAttribute('data-date') || '';
                const pubDate = new Date(pubDateStr + 'T00:00:00');

                // 1. Category check
                const matchesCategory = (activeCategory === 'all') || (cardCat === activeCategory);

                // 2. Quick Date Range check
                let matchesDateRange = true;
                if (dateRangeVal !== 'all' && !isNaN(pubDate)) {
                    const diffDays = (now - pubDate) / (1000 * 60 * 60 * 24);
                    if (dateRangeVal === '30days') {
                        matchesDateRange = diffDays <= 30;
                    } else if (dateRangeVal === '60days') {
                        matchesDateRange = diffDays <= 60;
                    } else if (dateRangeVal === '90days') {
                        matchesDateRange = diffDays <= 90;
                    }
                }

                // 3. Custom Date From / To check
                let matchesCustomDates = true;
                if (fromVal && !isNaN(pubDate)) {
                    matchesCustomDates = matchesCustomDates && (pubDate >= fromVal);
                }
                if (toVal && !isNaN(pubDate)) {
                    const endOfDay = new Date(toVal);
                    endOfDay.setHours(23, 59, 59, 999);
                    matchesCustomDates = matchesCustomDates && (pubDate <= endOfDay);
                }

                const isVisible = matchesCategory && matchesDateRange && matchesCustomDates;
                card.classList.toggle('d-none', !isVisible);
                if (isVisible) visibleCount++;
            });

            // 4. Sort cards by Published Date (Newest / Oldest)
            cards.sort((a, b) => {
                const dateA = new Date(a.getAttribute('data-date') || '2026-01-01');
                const dateB = new Date(b.getAttribute('data-date') || '2026-01-01');
                return sortVal === 'oldest' ? dateA - dateB : dateB - dateA;
            });

            cards.forEach((card) => videoGrid.appendChild(card));

            if (countLabel) {
                countLabel.textContent = `${visibleCount} ${visibleCount === 1 ? ' video' : ' videos'}`;
            }

            if (emptyState) {
                emptyState.classList.toggle('d-none', visibleCount > 0);
            }
        }

        function setCategoryFilter(catSlug) {
            activeCategory = catSlug;
            categoryChips.forEach((chip) => {
                chip.classList.toggle('active', chip.getAttribute('data-category') === catSlug);
            });
            if (categorySelect && categorySelect.value !== catSlug) {
                categorySelect.value = catSlug;
            }
            applyVideoFilters();
        }

        categoryChips.forEach((chip) => {
            chip.addEventListener('click', () => {
                setCategoryFilter(chip.getAttribute('data-category') || 'all');
            });
        });

        if (categorySelect) {
            categorySelect.addEventListener('change', (e) => {
                setCategoryFilter(e.target.value);
            });
        }

        if (dateRangeSelect) {
            dateRangeSelect.addEventListener('change', applyVideoFilters);
        }

        if (dateFromInput) {
            dateFromInput.addEventListener('change', applyVideoFilters);
        }

        if (dateToInput) {
            dateToInput.addEventListener('change', applyVideoFilters);
        }

        if (sortSelect) {
            sortSelect.addEventListener('change', applyVideoFilters);
        }

        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                if (dateRangeSelect) dateRangeSelect.value = 'all';
                if (dateFromInput) dateFromInput.value = '';
                if (dateToInput) dateToInput.value = '';
                if (sortSelect) sortSelect.value = 'newest';
                setCategoryFilter('all');
                window.showSdpcToast('Filters reset to show all videos.');
            });
        }

        // Run initial filter state on page load
        setCategoryFilter(activeCategory);
    });
})();
