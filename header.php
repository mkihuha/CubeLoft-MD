<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CubeLoftMD
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site mdl-layout mdl-js-layout">

	<header id="masthead" class="site-header mdl-layout__header">
        <div class="mdl-layout__header-row">
            <div class="site-branding">
                <?php
                the_custom_logo();
                if ( is_front_page() && is_home() ) :
                    ?>
                    <h1 class="site-title mdl-layout-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php
                else :
                    ?>
                    <span class="site-title mdl-layout-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
                    <?php
                endif;
                /*$cubeloftmd_description = get_bloginfo( 'description', 'display' );
                if ( $cubeloftmd_description || is_customize_preview() ) :
                    ?>
                    <p class="site-description"><?php echo $cubeloftmd_description; /* WPCS: xss ok. */ /*?></p> 
                <?php endif;*/ ?>
            </div><!-- .site-branding -->
            
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>

            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'cubeloftmd' ); ?></button>
            <?php
                /*wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                ) );*/
                $args = array(
                    'theme_location' => 'menu-1',
                    'container'       => 'nav',
                    'items_wrap' => '%3$s',
                    'container_class' => 'mdl-navigation mdl-layout--large-screen-only',
                    'walker' => new MDLWP_Nav_Walker()
                );
                if (has_nav_menu('menu-1')) {
                    wp_nav_menu($args);
                    }
            ?>
        </div><!-- .mdl-layout__header-row -->
    </header><!-- #masthead -->
    
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title"><?php bloginfo( 'name' ); ?></span>
        <?php
            $args = array(
                'theme_location' => 'drawer',
                'container'       => 'nav',
                'items_wrap' => '%3$s',
                'container_class' => 'mdl-navigation',
                'walker' => new MDLWP_Nav_Walker()
            );
            if (has_nav_menu('drawer')) {
                wp_nav_menu($args);
            }
        ?>
    </div><!-- .mdl-layout__drawer -->
    
    <main class="mdl-layout__content">
        <div id="content" class="site-content">
