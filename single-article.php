<?php get_header(); ?>

<div class="single-article">
    <?php
    // Commencer la boucle WordPress
    if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- Afficher l'image de l'article -->
        <div class="article-image">
            <?php 
            $image_id = get_field('image_article'); // Récupérer l'ID de l'image
            if ($image_id) : 
                $image_url = wp_get_attachment_url($image_id); // Obtenir l'URL à partir de l'ID
            ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" />
            <?php else : ?>
                <p>Aucune image disponible.</p> <!-- Message si aucune image n'est trouvée -->
            <?php endif; ?>
        </div>

        <!-- Date de publication -->
        <p class="publication-date">Publié le : <?php echo get_field('date_publication'); ?></p>

        <!-- Titre de l'article -->
        <h1 class="article-title"><?php the_title(); ?></h1>

        <!-- Contenu de l'article -->
        <div class="article-content">
            <?php the_content(); ?>
        </div>

        <!-- Navigation entre articles -->
        <div class="navigation-buttons">
            <div class="nav-left">
                <?php
                // Lien vers l'article précédent
                $prev_post = get_previous_post();
                if (!empty($prev_post)) {
                    echo '<a href="' . get_permalink($prev_post->ID) . '" class="nav-button">Article Précédent</a>';
                }
                ?>
            </div>
            <div class="nav-right">
                <?php
                // Lien vers l'article suivant
                $next_post = get_next_post();
                if (!empty($next_post)) {
                    echo '<a href="' . get_permalink($next_post->ID) . '" class="nav-button">Article Suivant</a>';
                }
                ?>
            </div>
        </div>


    <?php endwhile; else : ?>
        <p>Aucun article trouvé.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
