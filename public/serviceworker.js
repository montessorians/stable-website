'use strict';

// Install Event
self.addEventListener('install',(event)=>{

    // Declare Cache Version No. and assets
    let cn = 'version1';
    let assetsList = [

    ];

    // Open the Cache
    event.waitUntil(caches.open(cn)
        .then(function(cache){
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

                let cn = "version1";

                return caches.open(cn).then((cache)=>{
                    cache.put(event.request, response.clone());
                    return response;
                });

            });
        }).catch(()=>{
            return catches.match('/assets/imgs/noimg.png');
        })
    );
});

/*
// Remove Old Caches
self.addEventListener('activate',function(event){
    var cacheWhiteList = ['v4'];

    event.waitUntil(
        caches.keys().then(function(keyList){
            return Promise.all(keyList.map(function(key){
                if(cacheWhiteList.indexOf(key) === -1){
                    return caches.delete(key);
                }
            }));
        })
    );
    
});
*/