<?php

if (!function_exists('format_phone_numbers')) {
    /**
     * Format multiple phone numbers for display
     *
     * @param string $phoneNumbers
     * @param string $separator
     * @return string
     */
    function format_phone_numbers($phoneNumbers, $separator = '<br>')
    {
        if (empty($phoneNumbers)) {
            return '';
        }
        
        // Split by new lines and filter empty lines
        $numbers = array_filter(array_map('trim', explode("\n", $phoneNumbers)));
        
        if (empty($numbers)) {
            return '';
        }
        
        // If only one number, return as is
        if (count($numbers) === 1) {
            return $numbers[0];
        }
        
        // Return formatted numbers with separator
        return implode($separator, $numbers);
    }
}

if (!function_exists('get_phone_numbers_array')) {
    /**
     * Get phone numbers as array
     *
     * @param string $phoneNumbers
     * @return array
     */
    function get_phone_numbers_array($phoneNumbers)
    {
        if (empty($phoneNumbers)) {
            return [];
        }
        
        return array_filter(array_map('trim', explode("\n", $phoneNumbers)));
    }
}
