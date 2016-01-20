<?php
/*
# =================================================
# functions.php
#
# The theme's functions.
# =================================================
*/

/* ------------------------------------------------ */
/* 1. CONSTANTS */
/* ------------------------------------------------ */
define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/img' );
define( 'JS', THEMEROOT . '/js' );



/* ------------------------------------------------ */
/* 2. THEME SETUP */
/* ------------------------------------------------ */
if ( ! function_exists( 'tuts_theme_setup' ) ) {
    function tuts_theme_setup() {
        /* Make the theme available for translation. */
        $lang_dir = THEMEROOT . '/languages';
        load_theme_textdomain( 'tuts', $lang_dir );

        /* Add support for automatic feed links. */
        add_theme_support( 'automatic-feed-links' );

        /* Add support for post thumbnails. */
        add_theme_support( 'post-thumbnails' );

        /* Register nav menus. */
        register_nav_menus( array(
            'main-menu' => __( 'Main Menu', 'tuts' )
        ) );
    }

    add_action( 'after_setup_theme', 'tuts_theme_setup' );
}



/* ------------------------------------------------ */
/* 3. GET POST META */
/* ------------------------------------------------ */
if ( ! function_exists( 'tuts_post_meta' ) ) {
    function tuts_post_meta() {
        if ( get_post_type() === 'post' ) {
            /* Post author. */
            echo '<p class="post-meta">';
            _e( 'by', 'tuts' );
            printf( '<a href="%1$s" rel="author"> %2$s </a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() );
            _e( 'on', 'tuts' );
            echo ' <span>' . get_the_date() . '</span></p>';
        }
    }
}



/* ------------------------------------------------ */
/* 4. NUMBERED PAGINATION */
/* ------------------------------------------------ */
if ( ! function_exists( 'tuts_numbered_pagination' ) ) {
    function tuts_numbered_pagination() {
        $args = array(
            'prev_next' => false,
            'type' => 'array'
        );

        echo '<div class="col-md-12">';
        $pagination = paginate_links( $args );

        if ( is_array( $pagination ) ) {
            echo '<ul class="nav nav-pills">';
            foreach ( $pagination as $page ) {
                if ( strpos( $page, 'current' ) ) {
                    echo '<li class="active"><a href="#">' . $page . '</a></li>';
                } else {
                    echo '<li>' . $page . '</li>';
                }
            }

            echo '</ul>';
        }

        echo '</div>';
    }
}



/* ------------------------------------------------ */
/* 5. REGISTER WIDGET AREAS */
/* ------------------------------------------------ */
if ( ! function_exists( 'tuts_widget_init' ) ) {
    function tuts_widget_init() {
        if ( function_exists( 'register_sidebar' ) ) {
            register_sidebar( array(
                'name' => __( 'Main Widget Area', 'tuts' ),
                'id' => 'main-sidebar',
                'description' => __( 'Appears in the blog pages.', 'tuts' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div> <!-- end widget -->',
                'before_title' => '<h2>',
                'after_title' => '</h2>'
            ) );
        }
    }

    add_action( 'widgets_init', 'tuts_widget_init' );
}



/* ------------------------------------------------ */
/* 6. SCRIPTS */
/* ------------------------------------------------ */
if ( ! function_exists( 'tuts_scripts' ) ) {
    function tuts_scripts() {
        /* Register scripts. */
        wp_register_script( 'modernizr-js', JS . '/vendor/modernizr-2.6.2.min.js', false, false, false );
        wp_register_script( 'bootstrap-js', THEMEROOT . '/bower_components/bootstrap/dist/js/bootstrap.min.js', array( 'jquery' ), false, true );
        wp_register_script( 'isotope-js', THEMEROOT . '/bower_components/isotope/dist/isotope.pkgd.min.js', false, false, true );
        wp_register_script( 'plugins-js', JS . '/plugins.js', false, false, true );
        wp_register_script( 'main-js', JS . '/main.js', false, false, true );

        /* Load the custom scripts. */
        wp_enqueue_script( 'modernizr-js' );
        wp_enqueue_script( 'bootstrap-js' );
        wp_enqueue_script( 'isotope-js' );
        wp_enqueue_script( 'plugins-js' );
        wp_enqueue_script( 'main-js' );

        /* Load the stylesheets. */
        wp_enqueue_style( 'bootstrap-css', THEMEROOT . '/bower_components/bootstrap/dist/css/bootstrap.min.css' );
        wp_enqueue_style( 'main-css', THEMEROOT . '/css/style.css' );
    }

    add_action( 'wp_enqueue_scripts', 'tuts_scripts' );
}



/* ------------------------------------------------ */
/* 7. WIDGETS */
/* ------------------------------------------------ */
require_once( get_template_directory() . '/include/widgets/widget-recent-projects.php' );



/* ------------------------------------------------ */
/* 8. VALIDATE FIELD LENGTH  */
/* ------------------------------------------------ */
if ( ! function_exists( 'tuts_validate_length' ) ) {
	function tuts_validate_length( $fieldValue, $minLength ) {
		return ( strlen( trim( $fieldValue ) ) > $minLength );
	}
}
?>
