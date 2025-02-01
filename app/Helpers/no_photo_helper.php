<?php

if (!function_exists('no_photo')) {
    /**
     * Returns the URL of the logo if no photo is available.
     *
     * @param string|null $photoUrl
     * @return string
     */
    function no_photo($photoUrl = null)
    {
        $defaultLogoUrl = '/path/to/logo.png'; // Update this path to your logo's URL

        return $photoUrl ? $photoUrl : $defaultLogoUrl;
    }
}