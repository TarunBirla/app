/**
 * SDPC Progressive Web App Service Worker
 * Versioned cache for App Shell, safe static assets, and Offline Fallback.
 * Does NOT cache third-party sensitive data or external heavy video streams indiscriminately.
 */

const CACHE_VERSION = 'sdpc-pwa-v1.0.2';
const STATIC_CACHE = `${CACHE_VERSION}-static`;
const PAGES_CACHE = `${CACHE_VERSION}-pages`;
const OFFLINE_URL = '/offline';

const PRECACHE_ASSETS = [
  '/',
  '/videos',
  '/categories',
  '/doctor',
  '/contact',
  OFFLINE_URL,
  '/manifest.json',
  '/assets/css/sdpc.css',
  '/assets/js/sdpc.js',
  '/assets/logo.png',
  '/assets/logo.svg',
  '/assets/images/dr-mahesh-sahu.svg',
  '/assets/icons/icon-192x192.png',
  '/assets/icons/icon-512x512.png',
  '/assets/videos/thumbnails/back-pain.svg',
  '/assets/videos/thumbnails/knee-pain.svg',
  '/assets/videos/thumbnails/shoulder-pain.svg',
  '/assets/videos/thumbnails/post-surgical.svg',
  '/assets/videos/thumbnails/arthritis.svg',
  '/assets/videos/thumbnails/balance-vestibular.svg',
  '/assets/videos/thumbnails/therapeutic-exercise.svg',
  '/assets/videos/thumbnails/foot-ankle.svg'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(STATIC_CACHE).then((cache) => {
      return Promise.allSettled(
        PRECACHE_ASSETS.map((url) =>
          cache.add(url).catch(() => {
            // Ignore individual precache failure so installation stays resilient
          })
        )
      );
    })
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) => {
      return Promise.all(
        keys
          .filter((key) => key !== STATIC_CACHE && key !== PAGES_CACHE)
          .map((oldKey) => caches.delete(oldKey))
      );
    }).then(() => self.clients.claim())
  );
});

// Listen for skipWaiting message from the UI update banner
self.addEventListener('message', (event) => {
  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
});

self.addEventListener('fetch', (event) => {
  const { request } = event;

  if (request.method !== 'GET') {
    return;
  }

  const url = new URL(request.url);

  // Do not cache external domains or raw MP4 video streams unless explicitly configured
  if (url.origin !== self.location.origin) {
    return;
  }
  if (url.pathname.endsWith('.mp4') || url.pathname.endsWith('.webm')) {
    return;
  }

  // HTML Navigation requests: Network First -> Cache Fallback -> Offline Page
  if (request.mode === 'navigate' || (request.headers.get('accept') || '').includes('text/html')) {
    event.respondWith(
      fetch(request)
        .then((networkResponse) => {
          if (networkResponse && networkResponse.status === 200) {
            const copy = networkResponse.clone();
            caches.open(PAGES_CACHE).then((cache) => cache.put(request, copy));
          }
          return networkResponse;
        })
        .catch(async () => {
          const cachedPage = await caches.match(request);
          if (cachedPage) {
            return cachedPage;
          }
          return caches.match(OFFLINE_URL);
        })
    );
    return;
  }

  // Same-origin Static Assets (CSS, JS, SVG, PNG, Fonts): Cache First -> Network Fallback
  event.respondWith(
    caches.match(request).then((cachedAsset) => {
      if (cachedAsset) {
        return cachedAsset;
      }
      return fetch(request)
        .then((networkResponse) => {
          if (networkResponse && networkResponse.status === 200 && networkResponse.type === 'basic') {
            const copy = networkResponse.clone();
            caches.open(STATIC_CACHE).then((cache) => cache.put(request, copy));
          }
          return networkResponse;
        })
        .catch(() => {
          // Return nothing if asset is unavailable offline
        });
    })
  );
});
