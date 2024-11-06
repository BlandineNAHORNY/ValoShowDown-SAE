<?php

function my_theme_enqueue_styles() {
    wp_enqueue_style('main-styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');



// Enregistre un menu de navigation
function register_my_menus() {
    register_nav_menus(
        array(
            'main-menu' => __( 'Menu Principal' ),
            'footer-menu' => __( 'Menu Pied de Page' )
        )
    );
}
add_action( 'init', 'register_my_menus' );


function my_theme_enqueue_scripts() {
    wp_enqueue_script('menu-script', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');


function restrict_contributor_access() {
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        if (in_array('contributor', $current_user->roles)) {
            // Rediriger vers le profil de l'utilisateur
            wp_redirect(home_url('/profil'));
            exit;
        }
    }
}
add_action('admin_init', 'restrict_contributor_access');


function remove_admin_menu_for_contributors() {
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        if (in_array('contributor', $current_user->roles)) {
            remove_menu_page('index.php'); // Retirer le tableau de bord
        }
    }
}
add_action('admin_menu', 'remove_admin_menu_for_contributors');


function redirect_to_profile_after_login($redirect_to, $request, $user) {
    // Vérifie si l'utilisateur a été connecté avec succès
    if (isset($user->roles) && is_array($user->roles)) {
        // Redirige l'utilisateur vers sa page de profil
        return home_url('/profil');
    }
    return $redirect_to;
}
add_filter('login_redirect', 'redirect_to_profile_after_login', 10, 3);
