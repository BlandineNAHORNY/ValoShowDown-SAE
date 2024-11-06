<?php 
/* Template Name: Profil Utilisateur */
get_header(); 

// Récupérer l'utilisateur actuel
$current_user = wp_get_current_user(); 
$user_id = $current_user->ID;

// Récupérer l'avatar de l'utilisateur
$profile_picture = get_avatar_url($user_id); // URL de l'avatar
$registration_date = date('d F Y', strtotime($current_user->user_registered)); // Date d'inscription

// Informations sur le tournoi
$tournament_participation = 0; // Tournoi concurrent
$tournament_dates = "Du 09/11 au 10/11"; // Dates du tournoi
?>

<div class="profile-page">
    <div class="profile-header">
        <div class="profile-picture">
            <img src="<?php echo esc_url($profile_picture); ?>" alt="<?php echo esc_attr($current_user->display_name); ?>" />
        </div>
        <div class="profile-info">
            <h2><?php echo esc_html($current_user->display_name); ?></h2>
            <p>Créé le <?php echo esc_html($registration_date); ?></p> <!-- Date de création du compte -->
            <p>Tournoi concurrent : <strong><?php echo esc_html($tournament_participation); ?></strong></p> <!-- Tournoi concurrent -->
            <p>Inscrit sur le tournoi : <strong><?php echo esc_html($tournament_dates); ?></strong></p> <!-- Dates du tournoi -->
        </div>
    </div>
</div>

