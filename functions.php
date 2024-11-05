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


// Enregistrement du type de publication personnalisé "Équipes"
function create_team_post_type() {
    register_post_type('team', // Clé du type de publication
        array(
            'labels' => array(
                'name' => __('Teams'), // Libellé au pluriel
                'singular_name' => __('Team'), // Libellé au singulier
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'), // Prise en charge des titres, éditeurs et images à la une
            'rewrite' => array('slug' => 'equipes'), // Slug pour les URL
        )
    );
}
add_action('init', 'create_team_post_type');


// Ajout des champs personnalisés avec ACF
if( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array(
        'key' => 'group_teams',
        'title' => 'Équipe',
        'fields' => array(
            array(
                'key' => 'logo_equipe',
                'label' => 'Logo équipe',
                'name' => 'logo_equipe',
                'type' => 'image',
            ),
            array(
                'key' => 'chef_equipe',
                'label' => 'Chef d\'Équipe',
                'name' => 'chef_equipe',
                'type' => 'user',
            ),
            array(
                'key' => 'coequipier1',
                'label' => 'Coéquipier 1',
                'name' => 'coequipier1',
                'type' => 'user',
            ),
            array(
                'key' => 'coequipier2',
                'label' => 'Coéquipier 2',
                'name' => 'coequipier2',
                'type' => 'user',
            ),
            array(
                'key' => 'coequipier3',
                'label' => 'Coéquipier 3',
                'name' => 'coequipier3',
                'type' => 'user',
            ),
            array(
                'key' => 'coequipier4',
                'label' => 'Coéquipier 4',
                'name' => 'coequipier4',
                'type' => 'user',
            ),
            array(
                'key' => 'rang',
                'label' => 'Rang',
                'name' => 'rang',
                'type' => 'text',
            ),
            array(
                'key' => 'nombre_victoires',
                'label' => 'Nombre de victoires',
                'name' => 'nombre_victoires',
                'type' => 'number',
            ),
            array(
                'key' => 'nombre_defaites',
                'label' => 'Nombre de défaites',
                'name' => 'nombre_defaites',
                'type' => 'number',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'team', // Le type de publication
                ),
            ),
        ),
    ));
}
