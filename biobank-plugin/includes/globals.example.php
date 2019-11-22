<?php

/*
 * Set the WP-specific capabilities.
 * These capabilities are prefixed to ensure compatibility with other plugins.
 */

$biobanker_capabilities = array(
    "read", "biobank_view_admin_menu",
    "biobank_create_participant", "biobank_edit_participant", "biobank_view_participant", "biobank_remove_participant",
	"biobank_create_researcher", "biobank_edit_researcher", "biobank_remove_researcher",
	"biobank_create_study", "biobank_edit_study", "biobank_remove_study",
	"biobank_send_email", "biobank_remove_email",
	"biobank_settings",
	"biobank_update_consent", "biobank_view_consent",
);

$researcher_capabilities = array(
    "read", "biobank_view_admin_menu",
	"biobank_view_study",
);

$participant_capabilities = array(
    "biobank_view_profile",
	"biobank_update_consent", "biobank_view_consent",
);

/*
 * Set the scopes for different user roles.
 * These scopes must be in agreement with the REST API's scopes.
 */

$scopes = array(
	"administrator" => array(
		"create_participant", "update_participant", "view_participant", "remove_participant",
		"create_researcher", "remove_researcher",
		"create_study", "update_study", "remove_study", "view_study",
		"view_consent",
		"view_email", "create_email", "remove_email",
		"view_subscription",
		"admin",
	),
	"biobanker" => array(
		"create_participant", "update_participant", "view_participant", "remove_participant",
		"create_researcher", "remove_researcher",
		"create_study", "update_study", "remove_study", "view_study",
		"view_consent",
		"view_email", "create_email", "remove_email",
		"admin",
	),
	"researcher" => array(
		"view_study", "view_consent",
	),
	"participant" => array(
		"view_study",
		"update_consent", "view_consent",
		"change_card",
		"view_subscription", "update_subscription"
	),
);

/*
 * The client identifiers.
 */

$client_id = "abc";
$client_secret = "xyz";

/*
 * The name of the blockchain solution's access token.
 * It is assumed to be stored in a cookie.
 */
$blockchain_access_token = "access_token";

/**
 * The authorization URL for the Hyperledger Composer REST API.
 */
$auth_url = "http://localhost:3000/auth/local-wordpress";

/*
 * The endpoint to which requests for access tokens should be made.
 */
$token_endpoint = "token";

/*
 * Page information and menu visibility.
 * These pages are created by the plugin upon activated, and removed when de-activated.
 * By default, pages are visible by everyone in the menu.
 * These permissions are used by the `wp_get_nav_menu_items` filter to hide pages in the menu.
 */
$plugin_pages = array(
	"biobank-consent" => array(
		"wp_info" => array(
			"post_title" => "Ongoing Studies",
			"post_content" => "[biobank-consent type=\"all\"]",
			"post_name" => "biobank-consent",
			"post_status" => "publish",
			"post_author" => 1,
			"post_type" => "page",
		),
		"menu_visibility" => array(
			"participant", "administrator",
		)
	),
	"biobank-study" => array(
		"wp_info" => array(
			"post_title" => "Study",
			"post_content" => "[biobank-study]",
			"post_name" => "biobank-study",
			"post_status" => "publish",
			"post_author" => 1,
			"post_type" => "page",
		),
		"menu_visibility" => array( )
	),
	"biobank-unsubscribe" => array(
		"wp_info" => array(
			"post_title" => "Subscriptions",
			"post_content" => "[biobank-subscription]",
			"post_name" => "biobank-subscription",
			"post_status" => "publish",
			"post_author" => 1,
			"post_type" => "page",
		),
		"menu_visibility" => array( )
	),
);

/*
 * The key used to encrypt email addresses.
 * The key can be generated using `php -r "echo bin2hex(sodium_crypto_secretbox_keygen());" > itop_secret_key.txt`.
 */
$encryptionKey = hex2bin("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");

/*
 * The FontAwesome kit to use.
 * A kit can be downloaded from FontAwesome after registering: https://fontawesome.com/
 */
$fontawesome_kit = "https://kit.fontawesome.com/xxxxxxxxxx.js"

?>
