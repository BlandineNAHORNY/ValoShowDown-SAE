<?php
/*
Template Name: Tournoi
*/

get_header(); 
?>

<div class="tournament-page">
    <div class="tournament-header">
        <img src="<?php echo get_template_directory_uri(); ?>/src/tournoi-preview.png" alt="Tournoi ValoShowdown">
        <h1>Bienvenue au ValoShowdown !</h1>
        <p>
            Ce tournoi exclusif de Valorant est l'occasion parfaite pour les joueurs de prouver leurs compétences et de se battre pour remporter un cashprize de 1500€. Préparez-vous pour deux jours d’intenses affrontements, où seules les meilleures équipes triompheront.
        </p>
        <p>
            <strong>Dates du Tournoi</strong><br>
            📅 Du 09/11 au 10/11<br>
            ⏰ À partir de 20h30
        </p>
        <p>
            <strong>Cashprize Total</strong><br>
            💰 1500€ à se partager entre les vainqueurs
        </p>
        <p>
            Rejoignez-nous pour un week-end de compétition et de divertissement. Montrez votre talent, emmenez votre équipe au sommet, et faites-vous un nom dans la communauté Valorant ! Pour participer, il vous suffit de vous inscrire via le bouton ci-dessous et de rassembler votre équipe.
        </p>
        <a href="<?php echo site_url('/page-creation-compte'); ?>" class="button">Inscription</a>
    </div>

    <div class="registration-conditions">
        <h2>Modalités d'Inscription</h2>
        <p>Pour participer au tournoi ValoShowdown, voici les étapes et les conditions d'inscription. Assurez-vous de bien respecter ces modalités pour valider votre inscription et pouvoir concourir pour le cashprize de 1500€.</p>
        
        <h3>Conditions de Participation</h3>
        <ul>
            <li>Âge minimum : 16 ans révolus.</li>
            <li>Plateforme : Tournoi exclusivement réservé aux joueurs sur PC.</li>
            <li>Jeu : Possession d'une copie valide de Valorant et d'un compte actif.</li>
            <li>Équipe : Tournoi en équipes de 5 joueurs. Chaque équipe doit être complète pour valider l'inscription.</li>
            <li>Nationalité : Le tournoi est ouvert aux joueurs résidant en France.</li>
        </ul>

        <h3>Étapes d'Inscription</h3>
        <ol>
            <li>Remplissez le formulaire d'inscription en ligne sur notre site.</li>
            <li>Indiquez le nom de l'équipe et les informations complètes de chaque joueur (pseudo, ID Riot, adresse email).</li>
            <li>Acceptez les conditions générales d'utilisation et la politique de confidentialité.</li>
            <li>Une fois le formulaire soumis, un email de confirmation sera envoyé. Cliquez sur le lien dans cet email pour finaliser votre inscription.</li>
        </ol>

        <h3>Frais et Délai d'Inscription</h3>
        <p>Frais d'Inscription : Gratuit, aucune participation financière requise.<br>Délai d'Inscription : Les inscriptions sont ouvertes jusqu'au 08/11 à 23h59.</p>

        <h3>Engagement des Participants</h3>
        <ul>
            <li>Disponibilité : Les participants doivent être disponibles les 09/11 et 10/11 à partir de 20h30 pour le déroulement des matchs.</li>
            <li>Respect des règles : Les règles du tournoi et les instructions des modérateurs doivent être suivies scrupuleusement.</li>
            <li>Suivi des communications : Les participants sont tenus de suivre les mises à jour via les réseaux sociaux ou leur email.</li>
        </ul>

        <h3>En cas de Non-Respect des Règles</h3>
        <p>Le non-respect des règles du tournoi ValoShowdown entraînera des sanctions, qui peuvent inclure :</p>
        <ul>
            <li>Avertissement : En cas d'infraction mineure (comportement inapproprié, retard non justifié).</li>
            <li>Disqualification : Les infractions graves entraîneront une disqualification immédiate de l’équipe concernée.</li>
            <li>Exclusion des Tournois Futurs : En cas de comportements récurrents ou d’infractions répétées.</li>
            <li>Retrait du Cashprize : En cas de non-respect des règles après la remise des prix.</li>
        </ul>
    </div>
</div>

<?php get_footer(); ?>
