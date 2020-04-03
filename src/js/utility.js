function displayNotification(options){
	if ('serviceWorker' in navigator) {
		navigator.serviceWorker.ready
			.then(function(swreg) {
				swreg.showNotification(options.title, options);
			});

	}
}
