<?php
/**
 * Template part for displaying 3 recent posts on index.
 *
 * @package prevod3
 */

?>

<?php // variables:
        // Gets the stored background color value 
        $color_value = get_post_meta( get_the_ID(), 'mdlwp-bg-color', true ); 
        // Checks and returns the color value
  	$color = (!empty( $color_value ) ? 'background-color:' . $color_value . ';' : '');

  	// Gets the stored title color value 
        $title_color_value = get_post_meta( get_the_ID(), 'mdlwp-title-color', true ); 
        // Checks and returns the color value
  	$title_color = (!empty( $title_color_value ) ? 'color:' . $title_color_value . ';' : '');

  	// Gets the stored height value 
        $height_value = get_post_meta( get_the_ID(), 'mdlwp-height', true ); 
        // Checks and returns the height value
  	$height = (!empty( $height_value ) ? 'height:' . $height_value . ';' : '');

  	 // Gets the uploaded featured image
  	$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
  	// Checks and returns the featured image
  	$bg = (!empty( $featured_img ) ? "background-image: url('". $featured_img[0] ."');" : '');
?>

<a href="<?php echo get_permalink(); ?>" rel="bookmark" title="<?php echo the_title();?>">
<div id="post-<?php the_ID(); ?>" <?php post_class('article mdl-cell mdl-cell--14-col mdl-card mdl-shadow--2dp hover-shadow'); ?>>    
                <!-- mdl-card__media -->
		<div class="mdl-card__media" style="<?php echo $color . $bg . $height; ?> "></div>

                <!-- entry-content mdl-color-text--grey-600 mdl-card__supporting- -->
		<div class="entry-content mdl-color-text--grey-600 mdl-card__supporting-text">
                    <header>
                            <?php the_title('<h4>', '</h4>'); ?>
                    </header><!-- .entry-header -->
			<?php /*
				the_excerpt( sprintf(
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mdlwp' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
                         * 
                         */
			?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mdlwp' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer meta mdl-card__actions mdl-card--border">
                    <div class="meta">
                        <?php
                            $terms = get_the_terms( $post->ID , 'band' );
                            
                            // check to see if var is allocated and set:
                            if (is_array($terms) || is_object($terms)) { 
                                foreach ( $terms as $term ) {

                                    $term_link = get_term_link( $term, 'band' );
                                    if( is_wp_error( $term_link ) )
                                        continue;
                                    echo '<a rel="bookmark" href="' . $term_link . '"><button class="mdl-button mdl-js-button mdl-button--primary">' . $term->name . '</button></a>';
                                    } //foreach
                            } //if
                        ?>
                        <?php
                            $terms = get_the_terms( $post->ID , 'album' );
                            
                            // check to see if var is allocated and set:
                            if (is_array($terms) || is_object($terms)) { 
                                foreach ( $terms as $term ) {

                                    $term_link = get_term_link( $term, 'album' );
                                    if( is_wp_error( $term_link ) )
                                        continue;
                                    echo '<a rel="bookmark" href="' . $term_link . '"><button class="mdl-button mdl-js-button mdl-button--primary">' . $term->name . '</button></a>';      
                                } //foreach
                            } //if
                        ?>
                    </div>
	        
	        <?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php // mdlwp_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
                        <!-- share like -->
                        <a href="google.com"></a>
		</footer><!-- .entry-footer -->
</div><!-- .article mdl-cell -->
</a>