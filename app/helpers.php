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

if (!function_exists('format_email_addresses')) {
    /**
     * Format multiple email addresses for display
     *
     * @param string $emailAddresses
     * @param string $separator
     * @return string
     */
    function format_email_addresses($emailAddresses, $separator = '<br>')
    {
        if (empty($emailAddresses)) {
            return '';
        }
        
        // Split by new lines and filter empty lines
        $emails = array_filter(array_map('trim', explode("\n", $emailAddresses)));
        
        if (empty($emails)) {
            return '';
        }
        
        // If only one email, return as is
        if (count($emails) === 1) {
            return $emails[0];
        }
        
        // Return formatted emails with separator
        return implode($separator, $emails);
    }
}

if (!function_exists('get_email_addresses_array')) {
    /**
     * Get email addresses as array
     *
     * @param string $emailAddresses
     * @return array
     */
    function get_email_addresses_array($emailAddresses)
    {
        if (empty($emailAddresses)) {
            return [];
        }
        
        return array_filter(array_map('trim', explode("\n", $emailAddresses)));
    }
}

if (!function_exists('get_primary_email')) {
    /**
     * Get the first (primary) email address
     *
     * @param string $emailAddresses
     * @return string
     */
    function get_primary_email($emailAddresses)
    {
        $emails = get_email_addresses_array($emailAddresses);
        return !empty($emails) ? $emails[0] : '';
    }
}