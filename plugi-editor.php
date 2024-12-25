<?php
$plugin_dir = NFP_PLUGIN_DIR_PATH;

// Populate the file selector dropdown with all files
function get_all_files($dir, $base = '') {
    $files = scandir($dir);
    $all_files = [];
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;
        $file_path = $dir . DIRECTORY_SEPARATOR . $file;
        $relative_path = $base . $file;
        if (is_dir($file_path)) {
            $all_files = array_merge($all_files, get_all_files($file_path, $relative_path . DIRECTORY_SEPARATOR));
        } else {
            $all_files[] = $relative_path;
        }
    }
    return $all_files;
}

$plugin_files = get_all_files($plugin_dir);


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
        echo '<textarea name="file_content" class="plugin-file-editor-textarea">' . htmlspecialchars(file_get_contents($file_path)) . '</textarea><br>';
        echo '<input type="hidden" name="file_path" value="' . htmlspecialchars($file_path, ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="submit" name="save_file" value="Save Changes" class="plugin-file-save-button">';
        echo '</form>';
    } else {
        echo '<p class="plugin-file-editor-error">File not found.</p>';
    }
}

// Save the changes made to the file
if (isset($_POST['save_file'])) {
    $file_path = $_POST['file_path'];

    $file_content = htmlspecialchars_decode($_POST['file_content']);

    if (file_put_contents($file_path, $file_content)) {
        echo '<p class="plugin-file-editor-success">File successfully updated.</p>';
    } else {
        echo '<p class="plugin-file-editor-error">Failed to update the file.</p>';
    }

}

echo '</div>';


function display_directory_tree($dir, $base = '') {
    $files = scandir($dir);

    echo '<ul class="directory-tree">';
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;

        $file_path = $dir . DIRECTORY_SEPARATOR . $file;
        $relative_path = $base . $file;

        if (is_dir($file_path)) {
            echo '<li class="directory-folder">';
            echo '<span class="folder-name">📁 ' . $file . '</span>';
            display_directory_tree($file_path, $relative_path . DIRECTORY_SEPARATOR);
            echo '</li>';
        } else {
            echo '<li class="directory-file" data-path="' . esc_attr($relative_path) . '">📄 ' . $file . '</li>';
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
    width: 75%;
    margin: 20px auto;
    background-color: #f9f9f9;
    /* border-radius: 8px; */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.directory-tree-container {
    width: 25%;
    margin: 20px auto;
    background-color: #f9f9f9;
    /* border-radius: 8px; */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.directory-tree {
    list-style-type: none;
    padding-left: 20px;
}

.directory-tree li {
    margin-bottom: 4px;
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
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 13px;
}

.plugin-file-edit-button {
    padding: 10px 20px;
    font-size: 13px;
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
    /* border-radius: 4px; */
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
    /* border-radius: 4px; */
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
</script>