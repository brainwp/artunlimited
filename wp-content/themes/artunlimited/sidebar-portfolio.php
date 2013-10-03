<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package artunlimited
 */
?>
<div id="secondary" class="widget-area" role="complementary">
<div class="compartilhe-sidebar">
<h2 class="fonte-roxa">compartilhe!</h2>
<div class="compartilhe-sidebar-facebook">
<a class="a-compartilhe" href="<?php echo get_option( 'mo_facebook' ); ?>" target="_blank"></a>
</div><!-- .compartilhe-sidebar-facebook -->
<div class="compartilhe-sidebar-email">
<a class="a-compartilhe" href="mailto:<?php echo get_option( 'mo_email' ); ?>" target="_blank"></a>
</div><!-- .compartilhe-sidebar-email -->
<div class="">
</div><!--  -->
</div><!-- .compartilhe-sidebar -->
<div class="outros-projetos">

		<?php while ( have_posts() ) : the_post(); ?>
<h2 class="fonte-roxa">outros projetos:</h2>
<div class="setas-outros">
<a id="prev3" href="#"><div class="seta-outros-anteriores">
</div></a>
<!-- .seta-outros-anteriores -->
<a id="next3" href="#"><div class="seta-outros-posteriores">
</div></a><!-- .seta-outros-posteriores -->
</div><!-- setas-outros -->
<div class="outros-slider">

        <div class="list_carousel">
                        <ul id="foo3">
                            <?php

                        $args3 = array(
                                'post_type' => 'portfolio',
                                'numberposts' => 8,
                                'post_status' => 'publish',
                                );
                            
                            $outrosprojetos = get_posts( $args3 );
                            if ( $outrosprojetos ) {
                                foreach ( $outrosprojetos as $outroprojeto ) { ?>
                                								
                            <li>
							<div class="cada-outro-projeto">                        
								<a class="a-outro" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('thumb-outros-projetos'); ?>
								</a><!-- .a-outro  -->
							</div><!-- cada-outro-projeto -->
                            </li>
                            <?php } } ?>
                        </ul>
						
						<?php wp_reset_query(); // reset query ?>
                        <div class="clearfix"></div>
                        
        </div> <!-- .list_carrousel -->
					

</div><!-- .outros-slider -->
<?php endwhile; // end of the loop. ?>
</div><!-- .outros-projetos -->