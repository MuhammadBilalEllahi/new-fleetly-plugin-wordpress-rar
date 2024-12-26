


// # LOADING STARTS HERE
function showLoadingOverlay(message) {
    const overlayMessage = document.getElementById('overlay-message');
    if (overlayMessage) {
        overlayMessage.textContent = message;
    }
    const loadingOverlay = document.getElementById('loadingOverlay');
    if (loadingOverlay) {
        loadingOverlay.style.display = 'flex';
        loadingOverlay.style = 'flex-direction: column;';
    }
}

function hideLoadingOverlay() {
    const loadingOverlay = document.getElementById('loadingOverlay');
    if (loadingOverlay) {
        loadingOverlay.style.display = 'none';
    }
}
// * LOADING ENDS HERE
