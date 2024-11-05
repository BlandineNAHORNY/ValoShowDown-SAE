<?php get_header(); ?>

<div class="team-archive">
    <h1>Liste des Équipes</h1>
    <ul>
        <?php
        // Arguments de la requête pour récupérer les équipes
        $args = array('post_type' => 'team', 'posts_per_page' => -1);
        $teams = new WP_Query($args);

        if ($teams->have_posts()) :
            while ($teams->have_posts()) : $teams->the_post();
                $logo_equipe = get_field('logo_equipe');
                $chef_equipe = get_field('chef_equipe');
                $rang = get_field('rang');
                $victoires = get_field('nombre_victoires');
                $defaites = get_field('nombre_defaites');
                ?>
                <li>
                    <div>
                        <?php if ($logo_equipe) : ?>
                            <img src="<?php echo esc_url($logo_equipe); ?>" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                        <p>Rang actuel : <?php echo esc_html($rang); ?></p>
                        <p>Score : <?php echo esc_html($victoires); ?> victoires, <?php echo esc_html($defaites); ?> défaites</p>
                        <p>Chef d'équipe : <strong><?php echo esc_html($chef_equipe); ?></strong> <span class="crown-icon">👑</span></p>
                        <a href="<?php the_permalink(); ?>">Voir les détails</a> <!-- Lien vers la page de détails de l'équipe -->
                    </div>
                </li>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<li>Aucune équipe trouvée.</li>';
        endif;
        ?>
    </ul>
</div>

<?php get_footer(); ?>
