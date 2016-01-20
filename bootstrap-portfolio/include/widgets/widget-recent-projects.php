<?php
/**
 * widget-recent-projects.php
 *
 * Plugin Name: Tuts_Widget_Recent_Projects
 * Plugin URI: http://www.tutsplus.com
 * Description: A widget that displays the thumbnails of recent projects.
 * Version: 1.0
 * Author: Adi Purdila
 * Author URI: http://www.adipurdila.com
*/

class Tuts_Widget_Recent_Projects extends WP_Widget {
    /* Widget name, description, class name. */
    public function __construct() {
		parent::__construct(
			'tuts-widget-recent-projects',
			__( 'Tuts: Recent Projects', 'tuts' ),
			array(
				'classname' => 'recent-projects',
				'description' => __( 'A custom widget that displays the 6 most recent projects.', 'tuts' )
			)
		);
	}

    /* Generate the back-end layout for the widget. */
	public function form( $instance ) {
		/* Defaults. */
		$defaults = array(
			'title' => 'Recent Projects'
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tuts' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

        <?php
	}

    /* Processes the widget's values. */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Update values. */
		$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );

		return $instance;
	}

    /* Output the contents of the widget. */
	public function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );

		/* Display the markup before the widget. */
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

        /* Create a custom query and get the most recent 6 projects. */
        $queryArgs = array(
            /* Do not get posts from the Uncategorized category. */
            'cat' => '-1',
            /* Order by date. */
            'orderby' => 'date',
            /* Show all posts. */
            'posts_per_page' => '6'
        );
        $query = new WP_Query( $queryArgs );

        if ( $query->have_posts() ) : ?>
            <ul class="row">

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <li class="col-md-4">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?></a>
                </li>
            <?php endwhile; ?>

            </ul>
        <?php endif;

		/* Display the markup after the widget. */
		echo $after_widget;
	}
}

/* Register the widget using an annonymous function. */
add_action( 'widgets_init', create_function( '', 'register_widget( "Tuts_Widget_Recent_Projects" );' ) );
?>
