
document.addEventListener('DOMContentLoaded', function () {
    const fileItems = document.querySelectorAll('.directory-file');

    fileItems.forEach(function (fileItem) {
        fileItem.addEventListener('click', function () {
            // Remove the "selected" class from all files
            fileItems.forEach(function (item) {
                item.classList.remove('selected');
            });

            // Add "selected" class to the clicked file
            fileItem.classList.add('selected');

            // Get the relative file path
            const filePath = fileItem.dataset.path;

            // Populate the file selector dropdown to reflect the selected file
            const dropdown = document.getElementById('plugin-file-selector');
            dropdown.value = filePath;

            // Optionally, submit the form programmatically to load the file
            document.querySelector('input[name="edit_file"]').click();
        });
    });
});