<?php
/* Template Name: Connexion */
get_header();

// Démarrer la mise en tampon de sortie
ob_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // Récupérer et sanitiser les données du formulaire
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $remember = isset($_POST['remember']) ? true : false;

    // Tenter de se connecter
    $creds = array(
        'user_login'    => $email,
        'user_password' => $password,
        'remember'      => $remember
    );

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        echo '<p style="color:red;">Erreur : ' . $user->get_error_message() . '</p>';
    } else {
        // Rediriger vers la page de profil ou d'accueil
        wp_redirect(home_url('/profil')); // Changez cela pour rediriger vers la page désirée
        exit;
    }
}
?>

<div class="registration-form-container">
    <h2>Connexion</h2>
    <p>Connectez-vous pour accéder à votre espace joueur</p>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <label>
            <input type="checkbox" name="remember"> Rester connecté
        </label>
        <input type="submit" name="login" value="Je me connecte">
    </form>
    <a href="<?php echo wp_lostpassword_url(); ?>">Mot de passe oublié ?</a>
    <p>Vous n'avez pas de compte ? <a href="<?php echo site_url('/creation-de-compte'); ?>">Je m’inscris</a></p>
</div>

<?php get_footer(); ?>

<?php
// Terminer la mise en tampon de sortie et l'envoyer
ob_end_flush();
?>
