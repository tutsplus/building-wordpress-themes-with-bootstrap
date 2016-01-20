<?php
/*
# =================================================
# single.php
#
# The single post template file.
# =================================================
*/
?>

<?php
/* Load header.php. */
get_header();
?>

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
    <div class="container-fluid text-center">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1><?php the_title(); ?></h1>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end jumbotron -->

        <div class="jumbotron">
            <div class="row">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive center-block' ) ); ?>
                <?php endif; ?>
            </div> <!-- end row -->
        </div> <!-- end jumbotron -->
    </div> <!-- end container-fluid -->

    <div class="single-post container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <article class="post-excerpt">
                    <header>
                        <?php
                            /* Get the post meta. */
                            tuts_post_meta();
                        ?>
                    </header>

                    <?php the_content(); ?>
                </article>
            </div> <!-- end posts -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->
<?php endwhile; ?>

<?php else : ?>
    <?php _e( 'Oops, it seems there is nothing here.', 'tuts' ); ?>
<?php endif; ?>

<?php
/* Load footer.php. */
get_footer();
?>
