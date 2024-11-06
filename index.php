<?php
/* Template Name: Index */
get_header();
?>

<div class="index-page">
    <div class="image-container">
        <img src="<?php echo get_template_directory_uri(); ?>/src/home-preview.png" alt="ValoShowdown" class="home-image" />
        <a href="<?php echo site_url('/inscription'); ?>" class="nav-button-home">Inscription</a>
    </div>
</div>

<?php get_footer(); ?>
