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
  event.waitUntil((async () => {
    const cache = await caches.open(CACHE_NAME);
    // Attempt to fetch and cache each URL individually. If one fails, skip it.
    const results = await Promise.allSettled(PRECACHE_URLS.map(async (url) => {
      try {
        const resp = await fetch(url, { cache: 'no-cache' });
        if (!resp || !resp.ok) throw new Error('Bad response');
        await cache.put(url, resp.clone());
        return { url, ok: true };
      } catch (e) {
        // swallow errors for individual resources
        return { url, ok: false, error: e.message };
      }
    }));
    // Optional: log failures (visible in devtools SW logs)
    const failed = results.filter(r => r.status === 'fulfilled' && r.value && !r.value.ok);
    if (failed.length) {
      console.warn('SW: some resources failed to precache', failed.map(f => f.value.url));
    }
  })());
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
