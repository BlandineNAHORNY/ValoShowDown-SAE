<?php   
/* Template Name: Archive Résultats de Match */
get_header(); ?>

<div class="results-archive">
    <h1>Résultats des Matchs</h1>
    <ul>
        <?php
        // Arguments pour la requête pour récupérer les résultats de match
        $args = array(
            'post_type' => 'resultat_match', // Type de publication personnalisée pour les résultats
            'posts_per_page' => -1, // Récupérer tous les articles
            'orderby' => 'date', // Ordre par date
            'order' => 'ASC' // Afficher les plus anciens en premier
        );
        $results = new WP_Query($args);

        if ($results->have_posts()) :
            while ($results->have_posts()) : $results->the_post();
                // Récupérer les données des champs
                $equipe1 = get_field('equipe1result'); // Récupérer le nom de l'équipe 1
                $equipe2 = get_field('equipe2result'); // Récupérer le nom de l'équipe 2
                $score = get_field('resultat'); // Récupérer le score
                $date_match = get_field('date_du_resultat'); // Récupérer la date du match
                $horaire_match = get_field('horaire_du_resultat'); // Récupérer l'heure du match
                $youtube_rediff = get_field('youtube_rediff'); // URL de rediffusion YouTube
                $twitch_rediff = get_field('twitch_rediff'); // URL de rediffusion Twitch

                // Vérifier si les équipes existent et récupérer leurs noms
                $equipe1_name = $equipe1 ? esc_html($equipe1) : 'Équipe 1 non spécifiée';
                $equipe2_name = $equipe2 ? esc_html($equipe2) : 'Équipe 2 non spécifiée';
                ?>
                <li>
                    <div class="result-card">
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo esc_html($equipe1_name) . ' vs ' . esc_html($equipe2_name); ?></p>
                        <p>Score : <?php echo esc_html($score); ?></p>
                        <p>Date : <?php echo esc_html(date('d/m/Y', strtotime($date_match))); ?></p> <!-- Formatage de la date -->
                        <p>Heure : <?php echo esc_html(date('H:i', strtotime($horaire_match))); ?></p> <!-- Formatage de l'heure -->

                        <!-- Boutons de rediffusion -->
                        <div class="rediff-links">
                            <?php if ($youtube_rediff): ?>
                                <a href="<?php echo esc_url($youtube_rediff); ?>" class="button">Youtube</a>
                            <?php endif; ?>
                            <?php if ($twitch_rediff): ?>
                                <a href="<?php echo esc_url($twitch_rediff); ?>" class="button">Twitch</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <?php
            endwhile;
            wp_reset_postdata(); // Restauration de la requête
        else :
            echo '<li>Aucun résultat trouvé.</li>';
        endif;
        ?>
    </ul>
</div>

<?php get_footer(); ?>
