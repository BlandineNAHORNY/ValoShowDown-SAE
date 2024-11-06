<?php 
/* Template Name: Profil Utilisateur */
get_header(); 

// Récupérer l'utilisateur actuel
$current_user = wp_get_current_user(); 
$user_id = $current_user->ID;

// Récupérer l'ID de l'équipe de l'utilisateur
$team_id = get_user_meta($user_id, 'equipe1', true); // Remplacez 'equipe1' par le champ approprié si nécessaire

// Récupérer les informations de l'équipe
$team_name = get_the_title($team_id); // Nom de l'équipe
$logo_equipe_id = get_field('logo_equipe', $team_id); // Récupérer l'ID du logo de l'équipe
$chef_equipe_id = get_field('chef_equipe', $team_id); // Récupérer l'ID du chef d'équipe
$chef_equipe_name = get_the_title($chef_equipe_id); // Récupérer le nom du chef d'équipe
$rang = get_field('rang', $team_id); // Récupérer le rang actuel de l'équipe
$victories = get_field('nombre_victoires', $team_id); // Récupérer le nombre de victoires de l'équipe
$defeats = get_field('nombre_defaites', $team_id); // Récupérer le nombre de défaites de l'équipe
$profile_picture = get_avatar_url($user_id); // URL de l'avatar
?>

<div class="profile-page">
    <div class="profile-header">
        <div class="profile-picture">
            <img src="<?php echo esc_url($profile_picture); ?>" alt="<?php echo esc_attr($current_user->display_name); ?>" />
        </div>
        <div class="profile-info">
            <h2><?php echo esc_html($team_name); ?> <?php if ($chef_equipe_id === $user_id) echo '👑'; ?></h2>
            <h3><?php echo esc_html($current_user->display_name); ?></h3>
            <p>Créé le <?php echo get_the_date('d F Y', $team_id); ?></p> <!-- Date de création de l'équipe -->
            <p>Rang actuel : <strong><?php echo esc_html($rang); ?></strong></p>
            <p>Score : <strong><?php echo esc_html($victories); ?> victoires, <?php echo esc_html($defeats); ?> défaites</strong></p>
        </div>
    </div>

    <div class="team-members">
        <h3>Coéquipiers :</h3>
        <ul>
            <?php 
            // Récupérer les coéquipiers
            for ($i = 1; $i <= 4; $i++) {
                $coequipier_id = get_field("coequipier$i", $team_id); // Récupérer l'ID du coéquipier
                if ($coequipier_id) {
                    $coequipier_first_name = get_user_meta($coequipier_id, 'first_name', true); // Récupérer le prénom du coéquipier
                    $coequipier_last_name = get_user_meta($coequipier_id, 'last_name', true); // Récupérer le nom du coéquipier
                    $coequipier_avatar = get_avatar_url($coequipier_id); // Récupérer l'avatar du coéquipier
                    echo '<li>';
                    echo '<div class="member-card">';
                    echo '<img src="' . esc_url($coequipier_avatar) . '" alt="' . esc_attr($coequipier_first_name . ' ' . $coequipier_last_name) . '" class="profile-pic" />';
                    echo '<span>' . esc_html($coequipier_first_name . ' ' . $coequipier_last_name) . '</span>'; // Afficher le nom et prénom du coéquipier
                    echo '</div>';
                    echo '</li>';
                }
            }
            ?>
        </ul>
    </div>

    <div class="statistics">
        <h3>Statistiques</h3>
        <div id="chart" style="width: 100%; height: 300px;"></div>
    </div>
</div>

<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script>
    // Données pour le graphique
    var data = [{
        x: ['Victoires', 'Défaites'],
        y: [<?php echo esc_js($victories); ?>, <?php echo esc_js($defeats); ?>],
        type: 'bar',
        marker: {color: '#FF4655'}
    }];
    
    var layout = {
        xaxis: {
            title: 'Résultats'
        },
        yaxis: {
            title: 'Nombre'
        }
    };

    Plotly.newPlot('chart', data, layout);
</script>

<?php get_footer(); ?>
