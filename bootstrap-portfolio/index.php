<?php
/*
# =================================================
# index.php
#
# The main template file.
# =================================================
*/
?>

<?php
/* Load header.php. */
get_header();
?>

<div class="container-fluid text-center">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1><?php _e( 'My thoughts on and off the web.', 'tuts' ); ?></h1>

                <p class="lead">
                    <?php _e( 'Web-design, development, and parent-teacher conferences.', 'tuts' ); ?>
                </p>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end jumbotron -->
</div> <!-- end container-fluid -->

<div class="page-blog container-fluid">
    <div class="row">
        <aside class="sidebar col-md-3 col-md-offset-1 col-md-push-8">
            <?php
                /* Load sidebar.php */
                get_sidebar();
            ?>
        </aside>

        <div class="posts col-md-8 col-md-pull-4">
            <div class="row">
                <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', get_post_format() ); ?>
                <?php endwhile; ?>

                <?php else : ?>
                    <?php get_template_part( 'content', 'none' ); ?>
                <?php endif; ?>

                <?php
                    /* Load numbered pagination. */
                    tuts_numbered_pagination();
                ?>
            </div> <!-- end row -->
        </div> <!-- end posts -->
    </div> <!-- end row -->
</div> <!-- end container-fluid -->

<?php
/* Load footer.php. */
get_footer();
?>
