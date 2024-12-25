
<?php
$plugin_dir = plugin_dir_path(__FILE__);
$plugin_files = scandir($plugin_dir);

// File editor UI
echo '<div class="plugin-file-editor-container-total">';
echo '<div class="plugin-file-editor-container">';
echo '<h1 class="plugin-file-editor-heading">Plugin File Editor</h1>';
echo '<p class="plugin-file-editor-description">Select a file to edit:</p>';
echo '<form method="post" action="" class="plugin-file-editor-form">';
echo '<select name="plugin_file" class="plugin-file-selector" id="plugin-file-selector">';

foreach ($plugin_files as $file) {
    // Skip parent directories
    if ($file == '.' || $file == '..') continue;
    echo "<option value=\"$file\">$file</option>";
}

echo '</select>';
echo '<input type="submit" name="edit_file" value="Edit File" class="plugin-file-edit-button">';
echo '</form>';

if (isset($_POST['edit_file'])) {
    $selected_file = $_POST['plugin_file'];
    $file_path = $plugin_dir . $selected_file;

    // Check if the file exists
    if (file_exists($file_path)) {
        echo '<h2>Editing: ' . $selected_file . '</h2>';
        echo '<form method="post" action="">';
        echo '<textarea name="file_content" class="plugin-file-editor-textarea">' . esc_textarea(file_get_contents($file_path)) . '</textarea><br>';
        echo '<input type="hidden" name="file_path" value="' . esc_attr($file_path) . '">';
        echo '<input type="submit" name="save_file" value="Save Changes" class="plugin-file-save-button">';
        echo '</form>';
    } else {
        echo '<p class="plugin-file-editor-error">File not found.</p>';
    }
}

// Save the changes made to the file
if (isset($_POST['save_file'])) {
    $file_path = $_POST['file_path'];
    $file_content = $_POST['file_content'];

    if (file_put_contents($file_path, $file_content)) {
        echo '<p class="plugin-file-editor-success">File successfully updated.</p>';
    } else {
        echo '<p class="plugin-file-editor-error">Failed to update the file.</p>';
    }
}

echo '</div>';

// Function to display the directory tree
function display_directory_tree($dir) {
    $files = scandir($dir);

    // Start the tree structure
    echo '<ul class="directory-tree">';

    foreach ($files as $file) {
        // Skip the special . and .. directories
        if ($file == '.' || $file == '..') continue;

        $file_path = $dir . DIRECTORY_SEPARATOR . $file;

        // Check if it's a directory
        if (is_dir($file_path)) {
            echo '<li class="directory-folder">';
            echo '<span class="folder-name">📁 ' . $file . '</span>';
            // Recursively call the function to display the contents of the subdirectory
            display_directory_tree($file_path);
            echo '</li>';
        } else {
            // Add a list item for files
            echo '<li class="directory-file" data-path="' . esc_attr($file_path) . '">📄 ' . $file . '</li>';
        }
    }

    echo '</ul>';
}

// Display the directory tree
echo '<div class="directory-tree-container">';
echo '<h2>Plugin Directory Structure</h2>';
display_directory_tree($plugin_dir);
echo '</div>';
?>

<style>
.plugin-file-editor-container-total {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.plugin-file-editor-container {
    width: 70%;
    margin: 20px auto;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.directory-tree-container {
    width: 25%;
    margin: 20px auto;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.directory-tree {
    list-style-type: none;
    padding-left: 20px;
}

.directory-tree li {
    margin-bottom: 10px;
}

.directory-folder {
    font-weight: bold;
    color: #4CAF50;
}

.directory-file {
    color: #333;
    cursor: pointer;
}

.directory-file.selected {
    background-color: #e0e0e0;
}

.folder-name {
    cursor: pointer;
    transition: color 0.3s ease;
}

.folder-name:hover {
    color: #45a049;
}

.plugin-file-editor-heading {
    text-align: center;
    font-size: 24px;
    margin-bottom: 15px;
    color: #333;
}

.plugin-file-editor-description {
    font-size: 16px;
    margin-bottom: 20px;
}

.plugin-file-editor-form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.plugin-file-selector {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.plugin-file-edit-button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.plugin-file-edit-button:hover {
    background-color: #45a049;
}

.plugin-file-editor-textarea {
    width: 100%;
    height: 400px;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    font-family: monospace;
    line-height: 1.5;
}

.plugin-file-save-button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.plugin-file-save-button:hover {
    background-color: #45a049;
}

.plugin-file-editor-error {
    color: red;
    font-size: 16px;
}

.plugin-file-editor-success {
    color: green;
    font-size: 16px;
}
</style>

<script>
// Add event listener to directory files to make them selectable
document.addEventListener('DOMContentLoaded', function() {
    const fileItems = document.querySelectorAll('.directory-file');
    
    fileItems.forEach(function(fileItem) {
        fileItem.addEventListener('click', function() {
            // Remove the "selected" class from all files
            fileItems.forEach(function(item) {
                item.classList.remove('selected');
            });
            
            // Add "selected" class to the clicked file
            fileItem.classList.add('selected');

            // Get the file name and path
            const fileName = fileItem.textContent.trim();
            const filePath = fileItem.dataset.path;

            // Populate the file selector dropdown to reflect the selected file
            document.getElementById('plugin-file-selector').value = fileName;

            // Optionally, if you'd like to trigger the form submission immediately
            // to open the file in the editor, you can do this:
            document.querySelector('input[name="edit_file"]').click();
        });
    });
});
</script>
