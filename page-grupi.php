<?php /* Template Name: Grupi */ get_header(); ?>

<?php
/*
 * tozi template se izpolzva za stranica grupi
 * izpolzva plugin Taxonomy Term Image
 * https://github.com/daggerhart/taxonomy-term-image
 */
?>

<?php // variables:

// your taxonomy name
$tax = 'band'; 

// get the terms of taxonomy
$terms = get_terms( $tax, $args = array( 
    'hide_empty' => false, // do not hide empty terms
));

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

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main mdl-grid mdlwp-1200" role="main">



                    <?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){ ?>
                                        <?php
                                        // loop through all terms
                                            foreach ( $terms as $term ) {

                                            // Get the term link
                                            $term_link = get_term_link( $term );

                                                if( $term->count > 0 ) {
                                                    // display link to term archive ?>
                                                    <div id="band-name-id-<?php the_ID(); ?>" class="mdl-cell mdl-cell--16-col mdl-card mdl-shadow--2dp">
                                                                <?php
                                                                    if ( $term->term_image ) {
                                                                            $featured_img = wp_get_attachment_image_src( $term->term_image, 'full' )[0];
                                                                            $bg = (!empty( $featured_img ) ? "background-image: url('". $featured_img ."');" : '');
                                                                    } ?>
                                                        <!-- mdl-card__media -->
                                                        <div class="mdl-card__media" style="<?php echo $color . $bg . $height; ?> ">
                                                        </div>
                                                    <?php echo '<a href="' . esc_url( $term_link ) . '">'
                                                            . '<button class="mdl-button mdl-js-button mdl-button--primary">' . $term->name . '</button></a>';
                                                    ?></div><?php
                                                } // if
                                                
                                                elseif( $term->count !== 0 )
                                                    // display name
                                                    echo '' . $term->name .''; ?>
                                                    
                                                <?php 
                                            } // foreach
                            } //if not empty
                     ?>  
 
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>