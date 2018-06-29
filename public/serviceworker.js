/**
 * Holy Child Montessori
 * 2018
 * 
 * ServiceWorker.js
 */

'use strict';

var cn = '1.13.0';
var cacheWhiteList = ['1.13.0'];
var assetsList = [
    "/offline.php",
    "/offline-chromeless.php",
    "/assets/css/custom-styles.css",
    "/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css",
    "/assets/fonts/font-awesome-4.7.0/fonts/fontawesome-webfont.ttf",
    "/assets/fonts/font-awesome-4.7.0/fonts/fontawesome-webfont.woff",
    "/assets/fonts/font-awesome-4.7.0/fonts/fontawesome-webfont.woff2",
    "/assets/fonts/iconfont/material-icons.css",
    "/assets/fonts/iconfont/MaterialIcons-Regular.ttf",
    "/assets/fonts/iconfont/MaterialIcons-Regular.woff",
    "/assets/fonts/iconfont/MaterialIcons-Regular.woff2",
    "/assets/imgs/cover.jpg",
    "/assets/imgs/favicon.ico",
    "/assets/imgs/logo-144px.png",
    "/assets/imgs/logo-192px.png",
    "/assets/imgs/logo-256px.png",
    "/assets/imgs/logo-512px.png",
    "/assets/imgs/icons/icon-72x72.png",
    "/assets/imgs/icons/icon-96x96.png",
    "/assets/imgs/icons/icon-128x128.png",
    "/assets/imgs/icons/icon-144x144.png",
    "/assets/imgs/icons/icon-152x152.png",
    "/assets/imgs/icons/icon-192x192.png",
    "/assets/imgs/icons/icon-384x384.png",
    "/assets/imgs/icons/icon-512x512.png",
    "/assets/imgs/logo.jpg",
    "/assets/imgs/noimg.png",
    "/assets/imgs/thumb1.png",
    "/assets/imgs/thumb2.png",
    "/assets/js/aframe.min.js",
    "/assets/js/scrollreveal.min.js",
    "/assets/js/vue.js",
    "/assets/js/vue.min.js",
    "/assets/materialize/css/materialize-0.98.1.min.css",
    "/assets/materialize/fonts/roboto/Roboto-Bold.woff",
    "/assets/materialize/fonts/roboto/Roboto-Bold.woff2",
    "/assets/materialize/fonts/roboto/Roboto-Light.woff",
    "/assets/materialize/fonts/roboto/Roboto-Light.woff2",        
    "/assets/materialize/fonts/roboto/Roboto-Medium.woff",
    "/assets/materialize/fonts/roboto/Roboto-Medium.woff2",
    "/assets/materialize/fonts/roboto/Roboto-Regular.woff",
    "/assets/materialize/fonts/roboto/Roboto-Regular.woff2",
    "/assets/materialize/fonts/roboto/Roboto-Thin.woff",
    "/assets/materialize/fonts/roboto/Roboto-Thin.woff2"
];

// Install Event
self.addEventListener('install',(event)=>{
    // Open the Cache
    event.waitUntil(caches.open(cn)
        .then((cache)=>{
            // Fetch All Assets
            return cache.addAll(assetsList);
        })
    );

});

// Fetch Event
self.addEventListener('fetch', (event)=>{
    event.respondWith(
      // Try the cache
      caches.match(event.request).then((response)=>{

        // Fall back to network
        return response || fetch(event.request);

    }).catch(()=>{

        let method = event.request.method;
        let urlContainsContent = event.request.url.indexOf("_contents");

            if(method !== 'POST'){

                if(urlContainsContent > -1){
                    return caches.match('/offline-chromeless.php');
                } else {
                    return caches.match('/offline.php');
                }

            }

        })
    );
});

// Remove Old Caches
self.addEventListener('activate', (event)=>{
    event.waitUntil(
        caches.keys().then((keyList)=>{
            return Promise.all(keyList.map((key)=>{
                if(cacheWhiteList.indexOf(key) === -1){
                    return caches.delete(key);
                }
            }));
        })
    );
});
