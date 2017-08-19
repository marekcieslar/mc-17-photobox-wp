<?php
add_action('admin_menu', 'my_admin_menu');


function my_admin_menu () {
    // add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
    add_menu_page('Footer Text title', 'Footer Settings', 'manage_options', 'footer_setting_page', 'mt_settings_page');

    // add_submenu_page( 'footer_setting_page', 'Page title', 'Sub-menu title', 'manage_options', 'child-submenu-handle', 'my_magic_function');
}

// mt_settings_page() displays the page content for the Test Settings submenu
function mt_settings_page() {
    echo "<h2>" . __( 'Footer Settings Configurations', 'menu-test' ) . "</h2>";
	include_once('footer_settings_page.php');
}
?>