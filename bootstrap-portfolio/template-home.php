<?php
/*
# =================================================
# template-home.php
#
# Template Name: Homepage
# =================================================
*/
?>

<?php
/* Load header.php */
get_header();
?>

<!-- Jumbotron -->
<div class="container-fluid text-center">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1><?php _e( 'Hello, my name is Cory Simmons.', 'tuts' ); ?></h1>

                <p class="lead">
                    <?php _e( 'I sell websites and website accessories.', 'tuts' ); ?>
                </p>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end jumbotron -->
</div> <!-- end container-fluid -->

<!-- Filterable Portfolio -->
<div class="filterable-portfolio container-fluid">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills portfolio-filter">
                <li class="portfolio-title">
                <?php _e( 'Filter by:', 'tuts' ); ?>
                </li>
                <li role="presentation" class="active">
                <a href="#" data-filter="*"><?php _e( 'All', 'tuts' ); ?></a>
                </li>

                <?php
                    $args = array(
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'hide_empty' => true,
                        'exclude' => '1'
                    );

                    $categories = get_categories( $args );

                    foreach ( $categories as $category ) { ?>
                        <li role="presentation">
                            <a href="#" data-filter=".<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
                        </li>
                    <?php }
                ?>
            </ul>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="portfolio-items row">
        <?php
            $queryArgs = array(
                'cat' => '-1',
                'posts_per_page' => '-1'
            );

            $query = new WP_Query( $queryArgs );
        ?>

        <?php if ( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post(); ?>
            <?php if ( has_post_thumbnail() ) : ?>
                <?php
                    $slugs = '';
                    $currentCategories = get_the_category();

                    foreach ( $currentCategories as $currentCategory ) {
                        $slugs .= ' ' . $currentCategory->slug;
                    }
                ?>

                <figure class="portfolio-item col-sm-4 item<?php echo $slugs; ?>">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?></a>
                </figure>
            <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>
    </div> <!-- end row -->
</div> <!-- end container-fluid -->

<?php
/* Load footer.php */
get_footer();
?>
