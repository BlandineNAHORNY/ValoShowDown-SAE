<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="header">
    <div class="menu-header">
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/src/logo-vs-ecart.svg" alt="ValoShowdown Logo">
            </a>
        </div>
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <span class="hamburger-icon">&#9776;</span> <!-- Hamburger Icon -->
        </button>
        <nav class="main-navigation" id="primary-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'nav-menu',
            ));
            ?>
        </nav>
    </div>
</header>

<div id="content" class="site-content">
