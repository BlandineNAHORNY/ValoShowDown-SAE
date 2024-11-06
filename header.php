<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Orbitron:wght@400;600&family=Inter:wght@400&display=swap" rel="stylesheet">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="menu-header">
    <div class="profile-pic-container">
        <?php if (is_user_logged_in()) : ?>
            <?php
            $current_user = wp_get_current_user(); // Récupérer les informations de l'utilisateur connecté
            $avatar_url = get_avatar_url($current_user->ID); // Récupérer l'URL de l'avatar
            ?>
            <a href="<?php echo esc_url(home_url('/profil')); ?>">
                <img src="<?php echo esc_url($avatar_url); ?>" alt="Profil de <?php echo esc_attr($current_user->display_name); ?>" class="profile-pic" />
            </a>
        <?php endif; ?>
    </div>
    <div class="logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/src/logo-vs-ecart.svg" alt="ValoShowdown">
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

<script>
    // JavaScript pour gérer le menu hamburger
    document.getElementById("hamburger").addEventListener("click", function() {
        document.getElementById("menuOverlay").classList.toggle("show");
        this.classList.toggle("active"); // Toggle pour ajouter une classe active au hamburger
        document.getElementById("navBar").classList.toggle("hidden"); // Cacher la barre de navigation si hamburger est actif
    });

    document.getElementById("closeBtn").addEventListener("click", function() {
        document.getElementById("menuOverlay").classList.remove("show");
        document.getElementById("hamburger").classList.remove("active"); // Enlever la classe active du hamburger
        document.getElementById("navBar").classList.remove("hidden"); // Afficher la barre de navigation
    });
</script>

