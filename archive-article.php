<?php
/* Template Name: Archive Article */
get_header();
?>

<div class="articles-archive">
    <h1>Liste des Articles</h1>

    <!-- Filtrage -->
    <form class="filter-options" method="GET" action="">
        <label for="sort-by">Trier par :</label>
        <select id="sort-by" name="sort-by">
            <option value="recent" <?php selected(isset($_GET['sort-by']) && $_GET['sort-by'] == 'recent'); ?>>Les plus récents</option>
            <option value="oldest" <?php selected(isset($_GET['sort-by']) && $_GET['sort-by'] == 'oldest'); ?>>Les plus anciens</option>
            <option value="popular" <?php selected(isset($_GET['sort-by']) && $_GET['sort-by'] == 'popular'); ?>>Les plus populaires</option>
        </select>
        <button type="submit">Appliquer</button>
    </form>

    <div class="articles-container">
        <?php
        // Arguments pour la requête pour récupérer les articles
        $args = array(
            'post_type' => 'post', // Utiliser le type de publication "post"
            'posts_per_page' => -1, // Récupérer tous les articles
            'orderby' => 'date', // Trier par date
            'order' => 'DESC' // Récupérer du plus récent au plus ancien
        );

        // Vérifier le filtre et ajuster les arguments
        if (isset($_GET['sort-by'])) {
            if ($_GET['sort-by'] == 'oldest') {
                $args['order'] = 'ASC'; // Trier du plus ancien au plus récent
            } elseif ($_GET['sort-by'] == 'popular') {
                // Implémentez la logique de tri par popularité ici (ex. par nombre de commentaires)
                $args['orderby'] = 'comment_count';
                $args['order'] = 'DESC';
            }
        }

        $articles = new WP_Query($args);

        if ($articles->have_posts()) :
            while ($articles->have_posts()) : $articles->the_post();
                $image_article = get_field('image_article'); // Récupérer le champ image
                $date_publication = get_field('date_publication'); // Récupérer le champ date
                ?>
                <div class="article-card">
                    <a href="<?php the_permalink(); ?>">
                        <div class="card-image">
                            <?php if ($image_article) : ?>
                                <img src="<?php echo esc_url($image_article); ?>" alt="<?php the_title(); ?>" />
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/src/default-image.png" alt="Image par défaut" />
                            <?php endif; ?>
                        </div>
                        <p class="article-date">Publié le : <?php echo esc_html($date_publication); ?></p>
                        <h3 class="article-title"><?php the_title(); ?></h3>
                    </a>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Aucun article trouvé.</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
