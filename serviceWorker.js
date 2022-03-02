var static = "Shecluded";
var cacheassets = [
    "/auth.php",
    "/forgot-password.php",
    "/admin/clients.php",
    "/admin/course_topic.php",
    "/admin/course-category.php",
    "/admin/course.php",
    "/admin/dashboard.php",
    "/admin/edit_userInfo.php",
    "/admin/failed_trans.php",
    "/admin/footer.php",
    "/assets/js/pwa.js",
];

self.addEventListener("install", function (event) {
    event.waitUntil(
        caches.open(static).then(function (cache) {
            cache.addAll(cacheassets);
        }).then(function () {
            return self.skipWaiting();
        })
    );
});
self.addEventListener("activate", function (event) {});

self.addEventListener("fetch", function (event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            return response || fetch(event.request)
        })
    );
});