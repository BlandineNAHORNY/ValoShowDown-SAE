<?php
/* Template Name: Connexion */
get_header();

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
        // Rediriger vers la page d'accueil ou une autre page
        wp_redirect(home_url());
        exit;
    }
}
?>

<div class="login-form-container">
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
