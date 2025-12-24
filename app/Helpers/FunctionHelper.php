<?php

if (!function_exists('format_phone')) {
    /**
     * Simple phone formatter
     */
    function format_phone($phone) {
        return preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $phone);
    }
}

if (!function_exists('get_user_role_label')) {
    /**
     * Get human-readable role label
     */
    function get_user_role_label($role) {
        $labels = [
            'admin' => 'Administrator',
            'manager' => 'Project Manager',
            'member' => 'Team Member',
        ];

        return $labels[$role] ?? $role;
    }
}
