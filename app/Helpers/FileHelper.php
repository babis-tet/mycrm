<?php

if (!function_exists('getFontAwesomeIcon')) {
    /**
     * Get the FontAwesome icon class based on the file extension.
     *
     * @param string $filename
     * @return string
     */
    function getFontAwesomeIcon(string $filename): string
    {
        // Extract the file extension
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Map file extensions to FontAwesome icons
        $icons = [
            'xls'  => 'fa-file-excel',
            'xlsx' => 'fa-file-excel',
            'pdf'  => 'fa-file-pdf',
            'doc'  => 'fa-file-word',
            'docx' => 'fa-file-word',
            'jpg'  => 'fa-file-image',
            'jpeg' => 'fa-file-image',
            'png'  => 'fa-file-image',
            'gif'  => 'fa-file-image',
            'txt'  => 'fa-file-alt',
            'zip'  => 'fa-file-archive',
            'rar'  => 'fa-file-archive',
            // Default
            'default' => 'fa-file',
        ];

        // Return the corresponding icon or the default one
        return $icons[$extension] ?? $icons['default'];
    }
}
