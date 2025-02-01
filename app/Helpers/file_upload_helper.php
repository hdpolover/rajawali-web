<?php

if (!function_exists('uploadFileToStorage')) {
    /**
     * Upload a file to a remote storage server
     *
     * @param string $url The API endpoint on the remote storage server
     * @param \CodeIgniter\HTTP\Files\UploadedFile $file The uploaded file object
     * @return array The response status and message
     */
    function uploadFileToStorage(string $path, \CodeIgniter\HTTP\Files\UploadedFile $file): array
    {
        if ($file->isValid() && !$file->hasMoved()) {
            // Get file details
            $filePath = $file->getTempName();
            $fileName = $file->getName();
            $mimeType = $file->getMimeType();

            $uniqueName = uniqid() . '_' . $fileName;

            // Prepare the cURL request
            $curl = curl_init();

            $cFile = curl_file_create($filePath, $mimeType, $uniqueName);

            $storageUrl = 'https://storage.bengkelrajawalimotor.com/uploads/';

            $url = $storageUrl . $path . '/' . $uniqueName;

            $postFields = [
                'file' => $cFile,
            ];

            curl_setopt_array($curl, [
                CURLOPT_URL            => $url,
                CURLOPT_POST           => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS     => $postFields,
                CURLOPT_HTTPHEADER     => [
                    'Accept: application/json',
                ],
            ]);

            $response = curl_exec($curl);
            $error    = curl_error($curl);
            curl_close($curl);

            if ($error) {
                return ['status' => false, 'message' => 'cURL Error: ' . $error];
            }

            return ['status' => true, 'message' => 'File uploaded successfully!', 'response' => $response];
        }

        return ['status' => false, 'message' => 'Invalid file upload.'];
    }
}
