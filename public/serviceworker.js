/**
 * Holy Child Montessori
 * 2018
 * 
 * ServiceWorker.js
 */

'use strict';

// Install Event
self.addEventListener('install',(event)=>{

    // Declare Cache Version No. and assets
    let cn = '1.11.3';
    let assetsList = [
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

    // Open the Cache
    event.waitUntil(caches.open(cn)
        .then((cache)=>{
            // Fetch All Assets
            return cache.addAll(assetsList);
        })
    );

});

// Fetch Event
self.addEventListener('fetch',(event)=>{
    event.respondWith(
        caches.match(event.request).then((resp)=>{
            return resp || fetch(event.request).then((response)=>{

                let cn = "1.11.3";

                return caches.open(cn).then((cache)=>{

                    // Prevent throwing error when doing a POST request
                    if(event.request.method !== 'POST'){
                        cache.put(event.request, response.clone());
                    }

                    return response;

                });

            });
        }).catch(()=>{
            return caches.match('/assets/imgs/noimg.jpg');
        })
    );
});


// Remove Old Caches
self.addEventListener('activate', (event)=>{
    var cacheWhiteList = ['1.11.13'];

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
