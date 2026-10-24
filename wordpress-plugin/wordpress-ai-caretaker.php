<?php
/**
 * Plugin Name: WordPress AI Caretaker Connector
 * Description: Read-only health endpoint for the WordPress AI Caretaker n8n MVP.
 * Version: 0.1.0
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: WordPress AI Caretaker
 * License: MIT
 * Text Domain: wordpress-ai-caretaker
 */

if (!defined('ABSPATH')) {
    exit;
}

final class WP_AI_Caretaker_Connector {
    const VERSION = '0.1.0';
    const REST_NAMESPACE = 'caretaker/v1';

    public static function init() {
        add_action('rest_api_init', array(__CLASS__, 'register_routes'));
    }

    public static function register_routes() {
        register_rest_route(self::REST_NAMESPACE, '/health', array(
            'methods'             => WP_REST_Server::READABLE,
            'callback'            => array(__CLASS__, 'health'),
            'permission_callback' => array(__CLASS__, 'can_read_health'),
        ));
    }

    public static function can_read_health() {
        return current_user_can('manage_options');
    }

    public static function health(WP_REST_Request $request) {
        // Do not expose paths, user details, plugin lists, or secrets.
        return new WP_REST_Response(array(
            'status'         => 'ok',
            'component'      => 'wordpress-ai-caretaker-connector',
            'connector'      => self::VERSION,
            'wordpress'      => array(
                'version' => get_bloginfo('version'),
                'language' => get_locale(),
            ),
            'checks'         => array(
                'rest_api' => 'ok',
                'authenticated_admin' => 'ok',
            ),
            'timestamp_utc'  => gmdate('c'),
            'read_only'     => true,
        ), 200);
    }
}

WP_AI_Caretaker_Connector::init();
