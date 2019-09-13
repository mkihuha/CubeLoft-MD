<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CubeLoftMD
 */

?>

        </div><!-- #content -->

        <footer id="colophon" class="site-footer mdl-mini-footer">
            <div class="site-info mdl-mini-footer__left-section">
                <div class="mdl-logo">
                    <?php
                    /* translators: 1: Theme name, 2: Theme author. */
                    printf( esc_html__( 'Theme: %1$s by %2$s.', 'cubeloftmd' ), 'cubeloftmd', '<a href="http://www.wakilichapchap.co.ke">Martin Kihuha</a>' );
                    ?>
                </div>
                <ul class="mdl-mini-footer__link-list">
                    <li>
                        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cubeloftmd' ) ); ?>">
                            <?php
                            /* translators: %s: CMS name, i.e. WordPress. */
                            printf( esc_html__( 'Proudly powered by %s', 'cubeloftmd' ), 'WordPress' );
                            ?>
                        </a>
                    </li>
                </ul>
                <span class="sep"> | </span>
                    <?php
                    /* translators: 1: Theme name, 2: Theme author. */
                    printf( esc_html__( 'Theme: %1$s by %2$s.', 'cubeloftmd' ), 'cubeloftmd', '<a href="http://www.wakilichapchap.co.ke">Martin Kihuha</a>' );
                    ?>
            </div><!-- .site-info -->
        </footer><!-- #colophon -->
    </main><!-- .mdl-layout__content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
