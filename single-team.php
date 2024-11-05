<?php get_header(); ?>

<div class="single-team">
    <?php
    // Commencez la boucle
    if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- Afficher l'image de l'équipe -->
        <div class="group-image">
            <?php 
            $logo_equipe = get_field('logo_equipe'); // Récupérer le logo de l'équipe
            if ($logo_equipe) : ?>
                <img src="<?php echo esc_url($logo_equipe); ?>" alt="<?php the_title(); ?>" />
            <?php endif; ?>
        </div>

        <h1 class="team-title"><?php the_title(); ?></h1>
        <p>Créé le <?php echo get_the_date(); ?></p> <!-- Afficher la date de création -->

        <div class="team-stats">
            <p>Rang actuel : <?php echo esc_html(get_field('rang')); ?></p>
            <p>Score : <?php echo esc_html(get_field('nombre_victoires')); ?> victoires, <?php echo esc_html(get_field('nombre_defaites')); ?> défaites</p>
        </div>

        <h3>Coéquipiers :</h3>
        <div class="team-members">
            <?php
            $coequipiers = array();
            for ($i = 1; $i <= 4; $i++) {
                $coequipier = get_field("coequipier$i"); // Récupérer chaque coéquipier
                if ($coequipier) {
                    $coequipiers[] = $coequipier; // Ajouter à la liste des coéquipiers
                }
            }

            if (!empty($coequipiers)) {
                foreach ($coequipiers as $coequipier) {
                    echo '<div class="member-card">';
                    // Afficher l'image de profil de chaque coéquipier
                    $avatar_url = get_avatar_url($coequipier, ['size' => '50']);
                    echo '<img src="' . esc_url($avatar_url) . '" alt="' . esc_attr($coequipier) . '" class="profile-pic">';
                    echo '<p>' . esc_html($coequipier) . '</p>'; // Afficher le nom du coéquipier
                    echo '</div>';
                }
            } else {
                echo '<p>Aucun coéquipier trouvé.</p>';
            }
            ?>
        </div>

        <p>
            <?php 
            $chef_equipe = get_field('chef_equipe'); 
            if ($chef_equipe) : ?>
                <strong><?php echo esc_html($chef_equipe); ?></strong> <span class="crown-icon">👑</span> <!-- Icône de couronne pour le chef d'équipe -->
            <?php endif; ?>
        </p>

        <div class="navigation-buttons">
            <div class="nav-left">
                <?php
                // Lien vers l'équipe précédente
                $prev_post = get_previous_post();
                if (!empty($prev_post)) {
                    echo '<a href="' . get_permalink($prev_post->ID) . '" class="nav-button">Équipe Précédente</a>';
                }
                ?>
            </div>
            <div class="nav-right">
                <?php
                // Lien vers l'équipe suivante
                $next_post = get_next_post();
                if (!empty($next_post)) {
                    echo '<a href="' . get_permalink($next_post->ID) . '" class="nav-button">Équipe Suivante</a>';
                }
                ?>
            </div>
        </div>

    <?php endwhile; else : ?>
        <p>Aucune équipe trouvée.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
