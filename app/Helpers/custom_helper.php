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
        // Return empty string if date is empty or null
        if (empty($date) || $date == '0000-00-00' || $date == '0000-00-00 00:00:00') {
            return '-';
        }

        // convert date to string
        $date = (string) $date;

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

        try {
            $year = substr($date, 0, 4);
            $month = (int) substr($date, 5, 2);
            $day = substr($date, 8, 2);
            
            // Validate month value is between 1-12
            if ($month < 1 || $month > 12) {
                return '-';
            }

            // add time
            if (strlen($date) > 10) {
                $time = substr($date, 11, 5);
                return $day . ' ' . $months[$month] . ' ' . $year . ' ' . $time;
            }

            return $day . ' ' . $months[$month] . ' ' . $year;
        } catch (Exception $e) {
            return '-';
        }
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