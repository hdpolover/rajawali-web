<?php

use \FtpClient\FtpClient;

if (!function_exists('uploadFileToStorage')) {
    function uploadFileToStorage($directory, $file, $isBase64 = false) 
    {
        // Get Storage server configuration from .env
        $storageConfig = [
            'host' => getenv('ftp.hostname') ?: 'ftp.bengkelrajawalimotor.com',
            'username' => getenv('ftp.username') ?: 'u544553474.storageftp',
            'password' => getenv('ftp.password') ?: 'B4z]o]r7zU/xdkcu',
            'port' => getenv('ftp.port') ?: 21,
            'passive' => getenv('ftp.passive') !== false ? (bool)getenv('ftp.passive') : true
        ];
        
        $ftp = null;
        
        try {
            // Handle base64 image from camera
            if ($isBase64) {
                $tempFile = tempnam(sys_get_temp_dir(), 'upload_');
                $base64_string = explode(',', $file)[1];
                file_put_contents($tempFile, base64_decode($base64_string));
                $mimeType = 'image/png';
                $uniqueName = uniqid() . '.png';
            } else {
                if (!$file instanceof \CodeIgniter\HTTP\Files\UploadedFile) {
                    throw new \Exception('Invalid file upload');
                }
                $tempFile = $file->getTempName();
                $mimeType = $file->getMimeType();
                $uniqueName = $file->getRandomName();
            }

            // Initialize FTP client
            $ftp = new FtpClient();
            $ftp->connect($storageConfig['host'], false, $storageConfig['port']);
            $ftp->login($storageConfig['username'], $storageConfig['password']);
            
            // Set passive mode based on config
            $ftp->pasv($storageConfig['passive']);

            // Create directory if not exists
            $uploadPath = '/uploads/' . trim($directory, '/');
            if (!$ftp->isDir($uploadPath)) {
                $ftp->mkDirRecursive($uploadPath);
            }

            // Change to upload directory
            $ftp->chdir($uploadPath);

            // Upload file
            if (!$ftp->put($uniqueName, $tempFile, FTP_BINARY)) {
                throw new \Exception('Failed to upload file');
            }

            // Clean up temp file if it was created from base64
            if ($isBase64 && file_exists($tempFile)) {
                unlink($tempFile);
            }

            // Build public URL
            $publicUrl = 'https://storage.bengkelrajawalimotor.com/uploads/' . 
                        trim($directory, '/') . '/' . $uniqueName;

            return [
                'status' => true,
                'url' => $publicUrl,
                'message' => 'File uploaded successfully'
            ];

        } catch (\Exception $e) {
            log_message('error', 'FTP upload error: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ];
        } finally {
            // Close FTP connection if it exists
            if (isset($ftp)) {
                try {
                    $ftp->close();
                } catch (\Exception $e) {
                    // Just log the error but don't stop the flow
                    log_message('error', 'Error closing FTP connection: ' . $e->getMessage());
                }
            }
        }
    }
}