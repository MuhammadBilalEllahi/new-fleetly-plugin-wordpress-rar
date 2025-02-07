


// # LOADING STARTS HERE
function shownfpl_styles_loadingOverlay(message) {
    const overlayMessage = document.getElementById('nfpl_styles_overlay-message');
    if (overlayMessage) {
        overlayMessage.textContent = message;
    }
    const nfpl_styles_loadingOverlay = document.getElementById('nfpl_styles_loadingOverlay');
    if (nfpl_styles_loadingOverlay) {
        nfpl_styles_loadingOverlay.style.display = 'flex';
        nfpl_styles_loadingOverlay.style = 'flex-direction: column;';
    }
}

function hidenfpl_styles_loadingOverlay() {
    const nfpl_styles_loadingOverlay = document.getElementById('nfpl_styles_loadingOverlay');
    if (nfpl_styles_loadingOverlay) {
        nfpl_styles_loadingOverlay.style.display = 'none';
    }
}
// * LOADING ENDS HERE
