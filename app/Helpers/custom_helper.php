<?php

if (!function_exists('format_rupiah')) {
    /**
     * Format a number into Indonesian Rupiah currency format
     *
     * @param float|int $amount The amount to format
     * @param bool $withRp Include 'Rp' symbol (default: true)
     * @return string
     */
    function format_rupiah($amount, $withRp = true)
    {
        $formatted = number_format($amount, 0, ',', '.');
        return $withRp ? 'Rp ' . $formatted : $formatted;
    }
}

if (!function_exists('format_indonesian_date')) {
    /**
     * Format a date into Indonesian date format
     *
     * @param string $date Date string in 'Y-m-d' format
     * @return string Formatted date in Indonesian
     */
    function format_indonesian_date($date)
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $dateTimeParts = explode(' ', $date);
        $dateParts = explode('-', $dateTimeParts[0]);
        $year = $dateParts[0];
        $month = (int) $dateParts[1];
        $day = $dateParts[2];

        $formattedDate = $day . ' ' . $months[$month] . ' ' . $year;

        if (isset($dateTimeParts[1]) && $dateTimeParts[1] !== '00:00:00') {
            $formattedDate .= ' ' . $dateTimeParts[1];
        }

        return $formattedDate;
    }
}

if (!function_exists('clean_rupiah')) {
    /**
     * Clean Rupiah format to number
     *
     * @param string $rupiah_string Rupiah formatted string
     * @return float
     */
    function clean_rupiah($rupiah_string)
    {
        return (float) str_replace(['Rp ', '.', ','], '', $rupiah_string);
    }
}

if (!function_exists('get_service_difficulty_level')) {
    /**
     * Convert integer difficulty level to readable text
     * @param int $level Difficulty level (1-5)
     * @return string Difficulty level text in Indonesian
     */
    function get_service_difficulty_level($level) {
        switch ($level) {
            case 1:
                return 'Ringan';
            case 2:
                return 'Sedang';
            case 3:
                return 'Besar';
            default:
                return 'Tidak Diketahui';
        }
    }
}