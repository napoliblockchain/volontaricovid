var deferredPrompt;

//Polyfill: per i browser più vecchi che non hanno window.Promise
if (!window.Promise){
	window.Promise = Promise;
}

if ('serviceWorker' in navigator){
	navigator.serviceWorker
		.register('sw.js')
		.then(function (){
			console.log('[Service worker] ... from service registered.');
		})
		.catch(function(err) {
	   		console.log("Service Worker Failed to Register", err);
   		});
}

window.addEventListener('beforeinstallprompt', function(event){
	console.log('beforeinstallprompt fired!');
	event.preventDefault();
	deferredPrompt = event;
	return false;
});
