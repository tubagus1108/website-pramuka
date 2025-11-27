const CACHE_NAME = 'pramuka-cache-v1';
const OFFLINE_URL = '/offline.html';
const PRECACHE_URLS = [
  '/',
  OFFLINE_URL,
  '/img/Logo-Pramuka.webp',
  '/img/Logo-Pramuka-small.jpeg',
  '/build/assets/app-CP-jfLnZ.css',
  '/build/assets/app-Dn177VMY.js'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(PRECACHE_URLS))
  );
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) => Promise.all(
      keys.filter(k => k !== CACHE_NAME).map(k => caches.delete(k))
    ))
  );
  self.clients.claim();
});

self.addEventListener('fetch', (event) => {
  const request = event.request;

  // Always try network first for API requests
  if (request.url.includes('/api/') || request.mode === 'navigate') {
    event.respondWith(
      fetch(request).catch(() => caches.match(OFFLINE_URL))
    );
    return;
  }

  // For other requests, respond from cache, then network
  event.respondWith(
    caches.match(request).then((cached) => {
      if (cached) return cached;
      return fetch(request).then((response) => {
        // Save a copy in cache for future use
        return caches.open(CACHE_NAME).then((cache) => {
          try { cache.put(request, response.clone()); } catch (e) { /* some requests are opaque */ }
          return response;
        });
      }).catch(() => {
        // If request is navigation or HTML, fallback to offline
        if (request.mode === 'navigate') {
          return caches.match(OFFLINE_URL);
        }
      });
    })
  );
});
