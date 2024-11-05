
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>Informations Légales</h3>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/politique-de-confidentialite')); ?>">Politique de Confidentialité</a></li>
                <li><a href="<?php echo esc_url(home_url('/mentions-legales')); ?>">Mentions Légales</a></li>
                <li><a href="<?php echo esc_url(home_url('/cgu')); ?>">CGU</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h3>Navigation Complémentaire</h3>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/faq')); ?>">FAQ</a></li>
                <li><a href="<?php echo esc_url(home_url('/abonnement-newsletter')); ?>">Abonnement Newsletter</a></li>
                <li><a href="<?php echo esc_url(home_url('/support-et-aide')); ?>">Support et Aide</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h3>Réseaux</h3>
            <ul>
                <li><a href="https://www.instagram.com/" target="_blank">Instagram</a></li>
                <li><a href="https://www.youtube.com/" target="_blank">YouTube</a></li>
                <li><a href="https://www.twitch.tv/" target="_blank">Twitch</a></li>
                <li><a href="https://discord.gg/" target="_blank">Discord</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© <?php echo date('Y'); ?> ValoShowdown. Tous droits réservés</p>
        <p>Ce site n’est pas affilié à Riot Games et Valorant</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>