<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css"> <!-- Lien vers le CSS principal -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/script.js" defer></script> <!-- Lien vers le JavaScript -->
</head>

<body <?php body_class(); ?>>

<div class="menu-header">
    <div class="logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/src/LOGO-VS.svg" alt="ValoShowdown">
        </a>
    </div>
    <div class="hamburger" id="hamburger">
        &#9776; <!-- Symbole hamburger -->
    </div>
</div>

<nav class="nav-bar" id="navBar">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'menu_class' => 'nav-menu',
        'container' => false
    ));
    ?>
    <div class="user-menu">
        <?php if (is_user_logged_in()) : ?>
            <a href="<?php echo wp_logout_url(); ?>">Déconnexion</a>
        <?php else : ?>
            <a href="<?php echo esc_url(home_url('/connexion')); ?>">Connexion</a>
        <?php endif; ?>
    </div>
</nav>

<div class="menu-overlay" id="menuOverlay">
    <div class="menu-content">
        <span class="close-btn" id="closeBtn">&times;</span>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'main-menu',
            'menu_class' => 'nav-menu',
            'container' => false
        ));
        ?>
        <div class="user-menu">
            <?php if (is_user_logged_in()) : ?>
                <a href="<?php echo wp_logout_url(); ?>">Déconnexion</a>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/connexion')); ?>">Connexion</a>
            <?php endif; ?>
        </div>
    </div>
</div>
