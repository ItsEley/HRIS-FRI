// Function to rewrite the URL without reloading the page
function rewriteUrl(newUrl) {
	if (history.replaceState) {
		// Change the URL without reloading the page
		history.replaceState(null, null, newUrl);
	} else {
		console.warn("Your browser does not support history.replaceState");
	}
}
