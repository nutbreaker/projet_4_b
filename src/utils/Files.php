<?php

namespace tomtroc\utils;

abstract class Files
{
    /**
     * Checks if the file array is empty.
     *
     * @param array|null $file the file to check or null
     * 
     * @return bool returns true if the file is empty or null, false otherwise
     */
    public static function isEmpty(?array $file): bool
    {
        return empty($file) || $file['error'] === UPLOAD_ERR_NO_FILE;
    }

    /**
     * Checks if the file is correctly uploaded.
     * 
     * @param array|null $file the file to check or null
     * 
     * @return bool return true if the filee is correctly uploaded, false otherwise
     */
    public static function isUploaded(?array $file): bool {
        if(self::isEmpty($file)) {
            return false;
        }

        return $file['error'] === UPLOAD_ERR_OK;
    }

    /**
     * Check if the file type is allowed
     *
     * @param array|null $file the file to check
     * @param array $allowedTypes an array of allowed MIME types for the image
     * 
     * @return bool True if the file is allowed, otherwise false
     */
    public static function isAllowed(?array $file, array $allowedTypes = ['image/jpeg', 'image/png']): bool
    {
        if (self::isEmpty($file)) {
            return false;
        }

        if (empty($allowedTypes)) {
            return true;
        }

        $fileType = mime_content_type($file['tmp_name']);

        return in_array($fileType, $allowedTypes);
    }

    /**
     * Get the file extension from a given filename.
     *
     * @param string $fileName the name of the file
     * 
     * @return string|null the file extension if it exists, otherwise null
     */
    public static function getExtension(string $fileName): ?string
    {
        return pathinfo($fileName, PATHINFO_EXTENSION) ?: null;
    }

    /**
     * Save the uploaded file to the specified destination with a unique name.
     *
     * @param string $key The key of the file in the $_FILES array.
     * @param string $destinationFolder The destination path where the file should be saved without extension nor the end slash.
     * 
     * @return bool|string The file destination if the upload was successful, otherwise false.
     */
    public static function save(?array $file, string $destinationFolder = 'img_uploaded'): bool|string
    {
        if (empty($file)) {
            return false;
        }

        $tempFileName = $file['tmp_name'];
        $fileExtension = self::getExtension($file['name']);
        $fileUniqName = uniqid(time() . "_") . '.' . $fileExtension;
        $fileDestination = $destinationFolder . '/' . $fileUniqName;

        $isUploaded = move_uploaded_file($tempFileName, $fileDestination);

        return $isUploaded ? $fileDestination : false;
    }

    /**
     * Delete the specified file.
     *
     * @param string $fileName the path to the file to be deleted
     * 
     * @return bool true if the file was deleted, false otherwise
     */
    public static function delete(string $fileName): bool
    {
        if (!file_exists($fileName)) {
            return false;
        }

        return unlink($fileName);
    }
}
