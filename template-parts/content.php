<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CubeLoft MD
 */

?>

<div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="mdl-card__title">
            <header class="entry-header">
                <?php
                if ( is_singular() ) :
                    the_title( '<h1 class="entry-title display-2">', '</h1>' );
                else :
                    the_title( '<h2 class="entry-title display-4"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif;

                if ( 'post' === get_post_type() ) :
                    ?>
                    <div class="entry-meta">
                        <?php
                        cubeloftmd_posted_on();
                        cubeloftmd_posted_by();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->
        </div><!-- .mdl-card__title -->

        <?php cubeloftmd_post_thumbnail(); ?>

        <div class="mdl-card__supporting-text">

            <div class="entry-content">
                <?php
                the_content( sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cubeloftmd' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ) );

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cubeloftmd' ),
                    'after'  => '</div>',
                ) );
                ?>
            </div><!-- .entry-content -->

        </div><!-- .mdl-card__supporting-text -->

        <div class="mdl-card__supporting-text">
            <footer class="entry-footer">
                <?php cubeloftmd_entry_footer(); ?>
            </footer><!-- .entry-footer -->
        </div><!-- .mdl-card__supporting-text -->
        
    </article><!-- #post-<?php the_ID(); ?> -->

</div><!-- .demo-card-wide -->
