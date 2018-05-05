<?php /* Template Name: Index */ get_header(); ?>

<?php
/*
 * tozi template se izpolzva za stranica index
 * stranica index e nastroena za nachalna stranica
 */
?>

<?php // variables:
$i=0; //counter used to echo $category_names
$category_index = array(
    "cat1" => prevod,
    "cat2" => novini,
    "cat3" => articles,
);
$category_names = array(
    "1" => преводи,
    "2" => новини,
    "3" => статии,
);
?>
  
	<div id="primary" class="content-area">
            <main id="main" class="site-main mdl-grid mdlwp-1440" role="main">
                    
		<?php if ( have_posts() ) : ?>

			<?php do_action( 'mdlwp_before_content' ); ?>
                    
                        <?php // show three posts on index ---OR---
                              // show nine posts on other pages
                              // $show_posts_no 

                            if (is_home() | is_front_page()) 
                                {   $show_posts_no=3; } else 
                                {   $show_posts_no=9; }
                        ?>

                        <?php
                            foreach ($category_index as $k => $v) { ?>  
                            <?php /* Start the Loop */ ?>

                            <?php // Define custom query parameters */
                            $custom_query_args = array(
                                'category_name'             => $v,
                                'post_type'                 => 'post',
                                'nopaging'                  => false,
                                'posts_per_page'            => $show_posts_no,
                                'ignore_sticky_posts'       => 1,
                            );

                            // Get current page and append to custom query parameters array
                            $custom_query_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

                            // Instantiate custom query
                            $custom_query = new WP_Query( $custom_query_args );

                            // Output custom query loop
                            if ( $custom_query->have_posts() ) :
                                while ( $custom_query->have_posts() ) :
                                    $custom_query->the_post();

                                            // get_template_part( 'template-parts/content', get_post_format() );
                                            get_template_part( 'template-parts/index', 'cards' );
                                endwhile;
                                
                                ?>
                    <div class="mdl-cell--12-col center">
                        <a title="всички <?php echo $v; ?> ref="bookmark" class="wide" href="<?php echo esc_url( home_url( '/category/' ) ); echo $v; ?>"> 
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                            <?php $i++ ?>
                            Всички <?php echo $category_names[$i];?>
                            </button>
                        </a>
                    </div>
                    <?php
                                
                            endif;
                        } //foreach category
                        
                        // Reset postdata
                        wp_reset_postdata(); ?>

			<?php do_action( 'mdlwp_before_pagination' ); ?>

			<?php // mdlwp_posts_navigation(); ?>

			<?php do_action( 'mdlwp_after_pagination' ); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		<?php do_action( 'mdlwp_after_content' ); ?>

		</main><!-- #main -->
	</div><!-- #primary .content-area-->
   
<?php get_footer(); ?>