<?php
/* Template Name: Inscription */
get_header();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    // Récupérer et sanitiser les données du formulaire
    $nom = sanitize_text_field($_POST['nom']);
    $prenom = sanitize_text_field($_POST['prenom']);
    $pseudo = sanitize_text_field($_POST['pseudo']);
    $id_riot = sanitize_text_field($_POST['id_riot']);
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $confirm_password = sanitize_text_field($_POST['confirm_password']);

    // Validation des données
    if ($password !== $confirm_password) {
        echo '<p style="color:red;">Les mots de passe ne correspondent pas.</p>';
    } else {
        $userdata = array(
            'user_login' => $pseudo, // Utiliser le pseudo comme nom d'utilisateur
            'user_pass' => $password,
            'user_email' => $email,
            'first_name' => $prenom,
            'last_name' => $nom,
        );
        
        // Création de l'utilisateur
        $user_id = wp_insert_user($userdata);

        if (!is_wp_error($user_id)) {
            // Ajout d'informations supplémentaires
            update_user_meta($user_id, 'id_riot', $id_riot);
            echo '<p style="color:green;">Compte créé avec succès. <a href="'. site_url('/connexion') .'">Connectez-vous ici</a></p>';
        } else {
            echo '<p style="color:red;">Erreur : ' . $user_id->get_error_message() . '</p>';
        }
    }
}
?>

<div class="registration-form-container">
    <h2>Inscription</h2>
    <p>En soumettant ce formulaire, je m'engage à respecter les règles et conditions du tournoi.</p>
    <form method="POST">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="text" name="pseudo" placeholder="Pseudo" required>
        <input type="text" name="id_riot" placeholder="ID Riot" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="password" name="confirm_password" placeholder="Confirmation mot de passe" required>
        
        <label>
            <input type="checkbox" name="conditions" required>
            J'accepte les <a href="#">conditions générales d'utilisation</a> et la <a href="/politique-de-confidentialite">politique de confidentialité</a>.
        </label>
        
        <input type="submit" name="register" value="Je m'inscris">
    </form>
    <p>J'ai déjà un compte. <a href="<?php echo wp_login_url(); ?>">Je me connecte</a>.</p>
</div>

<?php get_footer(); ?>
