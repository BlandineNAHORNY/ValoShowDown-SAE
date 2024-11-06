<?php get_header(); ?>

<div class="match-archive">
    <h1>Archives des Matchs</h1>
    
    <ul>
        <?php
        $args = array(
            'post_type' => 'match', 
            'posts_per_page' => -1 
        );
        $matches = new WP_Query($args);

        if ($matches->have_posts()) :
            while ($matches->have_posts()) : $matches->the_post();
                $equipe1 = get_field('equipe1'); 
                $equipe2 = get_field('equipe2'); 
                $resultat_equipe1 = get_field('resultat_equipe_1'); 
                $resultat_equipe2 = get_field('resultat_equipe_2'); 
                $date_heure = get_field('date_heure'); 
                $statut_match = get_field('statut_match'); 
                ?>
                <li class="match-card">
                    <h2><?php echo esc_html($equipe1); ?> <span class="vs">VS</span> <?php echo esc_html($equipe2); ?></h2>
                    <p>Match du <?php echo esc_html(date('d/m/Y à H:i', strtotime($date_heure))); ?></p>
                    <p><?php echo esc_html($resultat_equipe1); ?> : <?php echo esc_html($resultat_equipe2); ?></p>
                    <?php if ($statut_match) : ?>
                        <p><strong>Statut : Match terminé</strong></p>
                    <?php else : ?>
                        <p><strong>Statut : Match en cours</strong></p>
                    <?php endif; ?>
                    <div class="match-links">
                        <a href="<?php the_permalink(); ?>">Voir les détails</a>
                    </div>
                </li>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<li>Aucun match trouvé.</li>';
        endif;
        ?>
    </ul>
</div>

<?php get_footer(); ?>
