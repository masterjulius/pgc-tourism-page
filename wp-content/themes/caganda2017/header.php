<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head <?php do_action( 'add_head_attributes' ); ?>>

        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="msapplication-tap-highlight" content="no" />

        <title><?php caganda_title(); ?></title>
        
        <!-- Favicons-->
        <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-touch-icon-152x152.png">    
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/mstile-144x144.png">
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon-32x32.png" sizes="32x32">
        <!--- End Favicons -->

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

        <!-- End CSS Fonts -->

        <!-- Embed Custom Icons -->
        <!-- CSS Fonts -->
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/cssfonts/animation.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/cssfonts/cagicon.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/cssfonts/cagicon-codes.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/cssfonts/cagicon-embedded.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/cssfonts/cagicon-ie7.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/cssfonts/cagicon-ie7-codes.css" />

		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" media="screen,projection" />

        <!-- <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons" /> -->
        <!--Offline Google Icon Font (Remove Later) -->
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/materialicons/icon.css" />

        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-2.1.1.min.js"></script>

        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/materialize.min.js"></script>

        <!-- Compiled and minified JavaScript -->
		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/script.js"></script>

        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

    <div class="container-fluid" id="cag-theme-container-slider">
        <?php if ( is_active_sidebar( 'widget-1' ) ) : ?>
            <!-- <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary"> -->
                <?php dynamic_sidebar( 'widget-1' ); ?>
            <!-- </div> --><!-- #primary-sidebar -->
        <?php endif; ?>
    </div>

