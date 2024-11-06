<?php
/* Template Name: Archive Prochains Matchs */

get_header();

$upcoming_matches = new WP_Query(array(
    'post_type' => 'prochain_match', // Modifié pour correspondre au slug du type de publication
    'posts_per_page' => 10,
    'orderby' => 'meta_value',
    'meta_key' => 'horaire', // Assurez-vous que cela correspond au champ de date et heure
    'order' => 'ASC'
));
?>

<div class="matchs-container">
    <h1>Prochains Matchs</h1>
    <div class="upcoming-matches-list">
        <?php
        // Affichage des matchs récupérés
        if ($upcoming_matches->have_posts()) :
            while ($upcoming_matches->have_posts()) : $upcoming_matches->the_post(); ?>
                <div class="match-card">
                    <h2><?php the_title(); ?></h2> <!-- Titre du match -->

                    <?php
                    // Récupérer les IDs des équipes
                    $team_1_id = get_field('team_id_1'); // Assurez-vous que cela correspond à votre champ ACF
                    $team_2_id = get_field('team_id_2'); // Assurez-vous que cela correspond à votre champ ACF

                    // Vérifiez et récupérez le nom de l'équipe 1
                    if ($team_1_id) {
                        $team_1_name = get_the_title($team_1_id);
                    } else {
                        $team_1_name = 'Équipe 1 non spécifiée';
                    }

                    // Vérifiez et récupérez le nom de l'équipe 2
                    if ($team_2_id) {
                        $team_2_name = get_the_title($team_2_id);
                    } else {
                        $team_2_name = 'Équipe 2 non spécifiée';
                    }
                    ?>

                    <div class="team-info">
                        <div class="team">
                            <p><?php echo esc_html($team_1_name); ?></p>
                        </div>

                        <span class="vs">vs</span>

                        <div class="team">
                            <p><?php echo esc_html($team_2_name); ?></p>
                        </div>
                    </div>

                    <p>Date et heure : <?php echo esc_html(get_field('horaire')); ?></p> <!-- Modifié pour correspondre à votre champ horaire -->
                </div>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Aucun match à venir trouvé.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
