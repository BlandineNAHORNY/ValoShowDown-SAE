<?php 
/**
 * Template Name: Archive Teams
 */

get_header(); ?>

<div class="team-archive">
    <h1>Liste des Équipes</h1>
    <ul>
        <?php
        // Arguments de la requête pour récupérer les équipes
        $args = array(
            'post_type' => 'team', // Assurez-vous que 'team' correspond à votre type de publication personnalisé
            'posts_per_page' => -1, // Récupérer tous les articles
            'orderby' => 'title', // Ordre par titre
            'order' => 'ASC' // Ordre croissant
        );
        $teams = new WP_Query($args);

        if ($teams->have_posts()) :
            while ($teams->have_posts()) : $teams->the_post();
                $logo_equipe_id = get_field('logo_equipe'); // Récupérer l'ID du logo de l'équipe
                $chef_equipe_id = get_field('chef_equipe'); // Récupérer l'ID du chef d'équipe
                $chef_equipe_name = get_the_title($chef_equipe_id); // Récupérer le nom du chef d'équipe
                $rang = get_field('rang') ? get_field('rang') : 'Non classé'; // Vérifier le rang, sinon afficher "Non classé"
                $victoires = get_field('nombre_victoires') ? get_field('nombre_victoires') : 0; // Récupérer les victoires ou 0
                $defaites = get_field('nombre_defaites') ? get_field('nombre_defaites') : 0; // Récupérer les défaites ou 0

                // Récupérer les coéquipiers
                $coequipiers = array();
                $coequipier_images = array(); // Pour stocker les images des coéquipiers
                for ($i = 1; $i <= 4; $i++) {
                    $coequipier_id = get_field("coequipier$i"); // Récupérer l'ID du coéquipier
                    if ($coequipier_id) {
                        $coequipiers[] = get_user_meta($coequipier_id, 'first_name', true); // Récupérer le prénom du coéquipier
                        $coequipier_avatar = get_avatar_url($coequipier_id); // Récupérer l'URL de l'avatar du coéquipier
                        $coequipier_images[] = $coequipier_avatar; // Ajouter l'URL de l'avatar à la liste
                    }
                }
                ?>
                <li>
                    <div class="team-card">
                        <?php if ($logo_equipe_id) : ?>
                            <img src="<?php echo esc_url(wp_get_attachment_url($logo_equipe_id)); ?>" alt="<?php the_title(); ?>" class="team-logo">
                        <?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                        <p>Rang actuel : <?php echo esc_html($rang); ?></p>
                        <p>Score : <?php echo esc_html($victoires); ?> victoires, <?php echo esc_html($defaites); ?> défaites</p>
                        <p>Chef d'équipe : <strong><?php echo esc_html($chef_equipe_name); ?></strong> <span class="crown-icon">👑</span></p>
                        <p>Coéquipiers : 
                            <?php 
                            // Afficher les images et prénoms des coéquipiers
                            foreach ($coequipiers as $index => $coequipier) {
                                echo '<img src="' . esc_url($coequipier_images[$index]) . '" alt="' . esc_attr($coequipier) . '" class="coequipier-avatar" /> ';
                                echo esc_html($coequipier) . ' '; // Afficher le prénom du coéquipier
                            }
                            ?>
                        </p>
                        <a href="<?php echo get_permalink(); ?>" class="view-details">Voir les détails</a>
                    </div>
                </li>
                <?php
            endwhile;
            wp_reset_postdata(); // Restauration de la requête
        else :
            echo '<li>Aucune équipe trouvée.</li>';
        endif;
        ?>
    </ul>
</div>

<?php get_footer(); ?>
