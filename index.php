<?php
/* Template Name: Index */
get_header();
?>

<div class="index-page">
    <img src="<?php echo get_template_directory_uri(); ?>/src/home-preview.png" alt="ValoShowdown" class="home-image" />
    <a href="<?php echo esc_url(home_url('/creation-de-compte')); ?>" class="signup-button">Inscription</a>
</div>
<?php get_footer(); ?>