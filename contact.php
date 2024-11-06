<?php
/* Template Name: Contact */
get_header();
?>

<div class="contact-page">
    <h1>Contact</h1>
    <p>Une question, besoin d’aide ? Contactez notre équipe du tournoi ValoShowdown !</p>
    <p>Consultez notre <a href="<?php echo esc_url(home_url('/faq')); ?>">FAQ</a> pour trouver des réponses aux questions fréquentes.</p>

    <form method="POST" action="" class="contact-form">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="sujet" placeholder="Sujet" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <button type="submit">Envoyer</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Traitement du formulaire
        $nom = sanitize_text_field($_POST['nom']);
        $prenom = sanitize_text_field($_POST['prenom']);
        $email = sanitize_email($_POST['email']);
        $sujet = sanitize_text_field($_POST['sujet']);
        $message = sanitize_textarea_field($_POST['message']);

        // Validation
        $errors = [];
        if (!is_email($email)) {
            $errors[] = "L'adresse e-mail est invalide.";
        }

        if (empty($errors)) {
            // Envoyer l'email
            $to = 'contact@valoshowdown.com'; // Remplacez par votre adresse email
            $headers = 'From: ' . $email . "\r\n" . 'Reply-To: ' . $email . "\r\n";
            $mail_body = "Nom: $nom\nPrénom: $prenom\nEmail: $email\n\nMessage:\n$message";

            if (wp_mail($to, $sujet, $mail_body, $headers)) {
                echo '<p style="color:green;">Votre message a été envoyé avec succès.</p>';
            } else {
                echo '<p style="color:red;">Erreur lors de l\'envoi du message.</p>';
            }
        } else {
            foreach ($errors as $error) {
                echo '<p style="color:red;">' . esc_html($error) . '</p>';
            }
        }
    }
    ?>
</div>

<?php get_footer(); ?>
