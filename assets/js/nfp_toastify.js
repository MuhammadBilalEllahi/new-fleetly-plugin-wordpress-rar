
/**
 * Show a toast notification.
 * 
 * @param {string} message - The message to display in the toast.
 * @param {string} type - The type of toast (success, error, info, warning).
 * @param {number} duration - How long the toast will stay visible (in ms).
 */
function showToast({ message, type = 'info', duration = 3000 }) {
    const container = document.getElementById('nfp-toastContainer');

    // Create toast element
    const toast = document.createElement('div');
    toast.className = `nfp-toast ${type}`;
    toast.innerHTML = `
                <span>${message}</span>
                <span class="nfp-close-btn">&times;</span>
            `;

    // Close button functionality
    toast.querySelector('.nfp-close-btn').addEventListener('click', () => {
        removeToast(toast);
    });

    // Append toast to container
    container.appendChild(toast);

    // Auto-remove toast after duration
    setTimeout(() => removeToast(toast), duration);
}

/**
 * Remove a toast notification.
 * 
 * @param {HTMLElement} toast - The toast element to remove.
 */
function removeToast(toast) {
    toast.style.animation = 'nfp-toast-slide-out var(--nfp-toastify-animation-duration) forwards';
    toast.addEventListener('animationend', () => toast.remove());
}

// To use the toast notification, call the showToast function with the desired options
// showToast({ message: 'Success! Your action was completed.', type: 'success', duration: 5000 });
// showToast({ message: 'Error! Something went wrong.', type: 'error', duration: 4000 });
// showToast({ message: 'Information: This is a general message.', type: 'info', duration: 3000 });
// showToast({ message: 'Warning! Check your input.', type: 'warning', duration: 3000 });
