<?php
/* Template Name: Créer Équipe */
get_header();

// Vérifier si l'utilisateur est connecté
if (!is_user_logged_in()) {
    echo '<p>Vous devez être connecté pour créer une équipe.</p>';
    get_footer();
    exit;
}

// Récupérer l'utilisateur actuel
$current_user = wp_get_current_user();
?>

<div class="create-team-form">
    <h2>Créer une Équipe</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="team_name">Nom de l'équipe :</label>
        <input type="text" name="team_name" id="team_name" required oninput="updateInviteLink()">

        <label for="team_logo">Logo de l'équipe :</label>
        <input type="file" name="team_logo" id="team_logo" accept="image/*" required>

        <label for="coequipier1">Coéquipier 1 :</label>
        <select name="coequipier1" id="coequipier1" required>
            <option value="">Sélectionnez un coéquipier</option>
            <?php
            // Récupérer tous les utilisateurs
            $users = get_users();
            foreach ($users as $user) {
                echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
            }
            ?>
        </select>

        <label for="coequipier2">Coéquipier 2 :</label>
        <select name="coequipier2" id="coequipier2" required>
            <option value="">Sélectionnez un coéquipier</option>
            <?php
            foreach ($users as $user) {
                echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
            }
            ?>
        </select>

        <label for="coequipier3">Coéquipier 3 :</label>
        <select name="coequipier3" id="coequipier3" required>
            <option value="">Sélectionnez un coéquipier</option>
            <?php
            foreach ($users as $user) {
                echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
            }
            ?>
        </select>

        <label for="coequipier4">Coéquipier 4 :</label>
        <select name="coequipier4" id="coequipier4" required>
            <option value="">Sélectionnez un coéquipier</option>
            <?php
            foreach ($users as $user) {
                echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
            }
            ?>
        </select>

        <input type="submit" name="create_team" value="Créer l'équipe">
    </form>

    <div class="invite-link">
        <h3>Lien d'Invitation :</h3>
        <p id="inviteLink">Veuillez saisir le nom de l'équipe pour générer un lien.</p>
    </div>

    <?php
    // Traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_team'])) {
        $team_name = sanitize_text_field($_POST['team_name']);
        $chef_id = $current_user->ID;

        // Gérer le téléchargement du logo
        if (!empty($_FILES['team_logo']['name'])) {
            $uploaded_file = $_FILES['team_logo'];
            $upload_overrides = array('test_form' => false);

            // Utiliser WP Handle Upload pour gérer le téléchargement
            $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

            if ($movefile && !isset($movefile['error'])) {
                $logo_url = $movefile['url'];
            } else {
                echo 'Erreur lors du téléchargement de l\'image.';
            }
        }

        // Créer une équipe
        $team_id = wp_insert_post(array(
            'post_title'   => $team_name,
            'post_type'    => 'team', // Type de publication personnalisé
            'post_status'  => 'publish',
            'post_author'  => $chef_id,
        ));

        // Ajouter les métadonnées de l'équipe
        if ($team_id) {
            update_field('logo_equipe', $logo_url, $team_id);
            update_field('chef_equipe', $chef_id, $team_id);

            // Assigner les coéquipiers
            for ($i = 1; $i <= 4; $i++) {
                $coequipier_id = sanitize_text_field($_POST['coequipier' . $i]);
                if ($coequipier_id) {
                    update_field("coequipier" . $i, $coequipier_id, $team_id);
                }
            }

            // Créer le lien d'invitation
            $invite_link = site_url('/inscription?team_id=' . $team_id); // Lien d'invitation
            echo '<p>Équipe créée avec succès !</p>';
            echo '<p>Partagez ce lien pour inviter des amis à rejoindre votre équipe : <a href="' . esc_url($invite_link) . '">' . esc_html($invite_link) . '</a></p>';
        } else {
            echo '<p>Erreur lors de la création de l\'équipe.</p>';
        }
    }
    ?>
</div>

<script>
function updateInviteLink() {
    var teamName = document.getElementById("team_name").value;
    var inviteLinkElement = document.getElementById("inviteLink");
    if (teamName) {
        var link = "<?php echo site_url('/inscription?team_name='); ?>" + encodeURIComponent(teamName);
        inviteLinkElement.innerHTML = '<a href="' + link + '">' + link + '</a>';
    } else {
        inviteLinkElement.innerHTML = 'Veuillez saisir le nom de l\'équipe pour générer un lien.';
    }
}
</script>

<?php get_footer(); ?>
