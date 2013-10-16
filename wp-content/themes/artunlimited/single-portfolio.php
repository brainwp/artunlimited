<?php
/**
 * The Template for displaying all single posts.
 *
 * @package artunlimited
 */

get_header( 'portfolio' ); ?>

	<div id="primary" class="content-area">
		<div id="content-interno" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

		<div id="slider-projetos">
<div id="slider-single">
                
                    <div class="list_carousel">
						<a class="prev" id="prev2" href="#"><span>anterior</span></a>
                        <a class="next" id="next2" href="#"><span>seguinte</span></a>
                        <ul id="foo2">
                            <?php
                        $args = array(
                                'post_type' => 'attachment',
                                'numberposts' => -1,
                                'post_status' => null,
                                'post_parent' => $post->ID,
                                'orderby' => 'rand'
                                );
                            
                            $anexos = get_posts ( $args );
                            
                            if ( $anexos ) {
                                foreach ( $anexos as $anexo ) { ?>
                                
                                <?php 
                                    $attachment_id = $anexo->ID;
                                    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' );
                                    $attachment_page = get_attachment_link( $attachment_id ); 
                                    $description = $anexo->post_content;
									$url = wp_get_attachment_url( $attachment_id ); 
                                    ?>
                            <li>
							<div class="cada-slide">                        
							<?php
                            if ($description):
                            echo '<div id="desc-slide">' . $description . '</div>';
                            endif;
                            ?>
                            <a href="<?php echo $url; ?>" class="thickbox image">
                            <img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" alt="<?php echo apply_filters('the_title', $anexo->post_title); ?>">
							</a>
							</div>
                            </li>
                            <?php } } ?>
                        </ul>
					
						
                        <div class="clearfix"></div>
                        
                    </div>
                
				</div><!-- #slider-single -->
		</div><!-- #sider-projetos -->
<div class="esquerda-single-portfolio">

	<header class="entry-header">
		<h1 class="entry-title-interno"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'artunlimited' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
			<?php // artunlimited_content_nav( 'nav-below' ); ?>
			<?php endwhile; // end of the loop. ?>
			
			<?php wp_reset_query(); // reset query ?>
</div>
			<!-- .esquerda-single-portfolio -->
			<div class="direita-single-portfolio">
			<?php get_sidebar( 'portfolio' ); ?>
			</div><!-- #direita-single-portfolio -->
			
		</div><!-- #content -->

	<?php get_footer(); ?>

	</div><!-- #primary -->