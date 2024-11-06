<?php 
/* Template Name: Réglages Utilisateur */
get_header(); 

// Récupérer l'utilisateur actuel
$current_user = wp_get_current_user(); 
$user_id = $current_user->ID;

// Récupérer l'avatar de l'utilisateur
$profile_picture = get_avatar_url($user_id); // URL de l'avatar
$registration_date = date('d F Y', strtotime($current_user->user_registered)); // Date d'inscription

// Traitement du formulaire pour changer la photo de profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Changement de la photo de profil
    if (isset($_FILES['profile_picture'])) {
        $uploaded_file = $_FILES['profile_picture'];
        $upload_overrides = array('test_form' => false);

        // Gérer le téléchargement de l'image
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            // Mettre à jour l'avatar de l'utilisateur
            update_user_meta($user_id, 'profile_picture', $movefile['url']);
            echo '<p>Photo de profil mise à jour avec succès.</p>';
        } else {
            echo '<p>Erreur lors du téléchargement de l\'image.</p>';
        }
    }

    // Changement de mot de passe
    if (!empty($_POST['new_password'])) {
        wp_set_password($_POST['new_password'], $user_id);
        echo '<p>Mot de passe mis à jour avec succès.</p>';
    }

    // Suppression du compte
    if (isset($_POST['delete_account'])) {
        require_once(ABSPATH . 'wp-admin/includes/user.php');
        wp_delete_user($user_id);
        echo '<p>Votre compte a été supprimé avec succès.</p>';
        exit;
    }
}

?>

<div class="settings-page">
    <h1>Réglages du Compte</h1>
    <div class="profile-header">
        <div class="profile-picture">
            <img src="<?php echo esc_url($profile_picture); ?>" alt="<?php echo esc_attr($current_user->display_name); ?>" />
        </div>
        <div class="profile-info">
            <h2><?php echo esc_html($current_user->display_name); ?></h2>
            <p>Créé le <?php echo esc_html($registration_date); ?></p> <!-- Date de création du compte -->
            <?php 
            if (in_array('administrator', $current_user->roles)) {
                echo '<p><strong>Rôle : Modérateur</strong></p>'; // Si administrateur
            } elseif (in_array('contributor', $current_user->roles)) {
                echo '<p><strong>Rôle : Joueur</strong></p>'; // Si contributeur
            }
            ?>
        </div>
    </div>

    <h2>Changer la photo de profil</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="profile_picture">Sélectionnez une nouvelle image :</label>
        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
        <input type="submit" value="Mettre à jour la photo">
    </form>

    <h2>Changer le mot de passe</h2>
    <form method="POST">
        <label for="new_password">Nouveau mot de passe :</label>
        <input type="password" name="new_password" id="new_password" required>
        <input type="submit" value="Changer le mot de passe">
    </form>

    <h2>Supprimer le compte</h2>
    <form method="POST">
        <input type="hidden" name="delete_account" value="1">
        <p>Attention : Cette action est irréversible. Voulez-vous vraiment supprimer votre compte ?</p>
        <input type="submit" value="Supprimer mon compte">
    </form>
</div>

<?php get_footer(); ?>
