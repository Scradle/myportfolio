<footer>
    <div class="contact-icons">
        <a href="#" class="icon contact-icon">
            <img src="<?php echo get_template_directory_uri() . './assets/images/envelope.svg'; ?>" class="icon-svg" alt="Me contacter">
        </a>
        <a href="#" class="icon">
            <img src="<?php echo get_template_directory_uri() . './assets/images/linkedin.svg'; ?>" class="icon-svg" alt="Mon LinkedIn">
        </a>
        <a href="#" class="icon">
            <img src="<?php echo get_template_directory_uri() . './assets/images/github.svg'; ?>" class="icon-svg" alt="Mon GitHub">
        </a>
    </div>
    <?php get_template_part( 'templates-parts/contact-modal' ); ?> <!-- intégration modale de contact -->
</footer>

<?php wp_footer(); ?>

</body>
</html>