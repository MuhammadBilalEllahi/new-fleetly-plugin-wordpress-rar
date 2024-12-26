
/**
* Copy shortcode to clipboard on click.
*/
document.addEventListener('DOMContentLoaded', () => {
    const copyIcons = document.querySelectorAll('.nfp-copy-icon');

    copyIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            const shortcode = icon.dataset.shortcode;

            // Copy to clipboard
            navigator.clipboard.writeText(shortcode).then(() => {
                icon.title = `Shortcode copied: ${shortcode}`;
                // alert(`Shortcode copied: ${shortcode}`);
                showToast({ message: `ShortCode Copied  ${shortcode}`, type: 'success', duration: 1000 });
            }).catch(err => {
                console.error('Failed to copy shortcode: ', err);
            });
        });

        icon.addEventListener('mouseover', () => {
            const shortcode = icon.dataset.shortcode;
            icon.title = `Click to copy shortcode: ${shortcode}`;
        });
    });
});

// RUNS ON SAVE BUTTON PHP
document.querySelector('#save_button').addEventListener('click', function () {
    showToast({
        message: "clicked!",
        duration: 1000
    });
});
