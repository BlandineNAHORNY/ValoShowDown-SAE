<?php get_header(); ?>

<div class="single-match">
    <?php
    if (have_posts()) : while (have_posts()) : the_post();

        $equipe1 = get_field('equipe1');
        $equipe2 = get_field('equipe2');
        $resultat_equipe1 = get_field('resultat_equipe_1');
        $resultat_equipe2 = get_field('resultat_equipe_2');
        $date_heure = get_field('date_heure');
        $statut_match = get_field('statut_match');
        ?>
        <h1>Détails du Match</h1>
        <p>Match du <?php echo esc_html(date('d/m/Y à H:i', strtotime($date_heure))); ?></p>
        <h2><?php echo esc_html($equipe1); ?> <span class="vs">VS</span> <?php echo esc_html($equipe2); ?></h2>
        <p><strong>Résultat :</strong> <?php echo esc_html($resultat_equipe1); ?> : <?php echo esc_html($resultat_equipe2); ?></p>
        <?php if ($statut_match) : ?>
            <p><strong>Statut : Match terminé</strong></p>
        <?php else : ?>
            <p><strong>Statut : Match en cours</strong></p>
        <?php endif; ?>

        <div class="navigation-buttons">
            <div class="nav-left">
                <?php
                $prev_post = get_previous_post();
                if (!empty($prev_post)) {
                    echo '<a href="' . get_permalink($prev_post->ID) . '" class="nav-button">Match Précédent</a>';
                }
                ?>
            </div>
            <div class="nav-right">
                <?php
                $next_post = get_next_post();
                if (!empty($next_post)) {
                    echo '<a href="' . get_permalink($next_post->ID) . '" class="nav-button">Match Suivant</a>';
                }
                ?>
            </div>
        </div>

    <?php endwhile; else : ?>
        <p>Aucun match trouvé.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
