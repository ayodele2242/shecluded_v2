'use strict'
/* PWA services worker register */

if ("serviceWorker" in navigator) {
  window.addEventListener("load", function (event) {
      navigator.serviceWorker
          //.register("././serviceWorker.js", {
          .register("serviceWorker.js", {
              scope: './'
          })
          .then(reg => console.log("service worker registered"))
          .catch(err => console.log("service worker not registered"));
  });
}
