<?php get_header( 'novosprojetos' ); ?>

<div id="content-interno" class="site-content" role="main">

    <div class="archive-portfolio">
        		<div class="header-portfolio">
				<div class="header-categories">
					<ul class="separated-list menu"><li class="categoria-li">Categorias:</li></ul>					
					<ul class="separated-list menu">
					<?php
					  $myterms = get_terms( 'tipo' );
					    $conta = 0;
					  foreach($myterms as $term){
					    $root_url = get_bloginfo('url');
					    $term_taxonomy = $term->taxonomy;
					    $term_slug = $term->slug;
					    $term_name = $term->name;
					    $link = $root_url.'/'.$term_taxonomy.'/'.$term_slug;
					    /*$output .= "<option value='".$link."'>".$term_name."</option>";*/
						                                
					 if ($conta < 1){
					    $i = "<li class=\"primeiro-li\"><a href=";
					} else {
					    $i = "<li><a href=";
					}
					echo $i;
					  echo $link . ">" . $term_name;
					  echo "</a></li>";
					$conta++;
					  }
					?>
				    </ul>
				</div><!-- .header-categories -->
                	<div id="busca-aba" class="portfolio">
                            <div id="lupa-aba"></div>
                            <form id="searchform" action="<?php bloginfo('url'); ?>/" method="get">
				<input class="inlineSearch" type="text" name="s" value="busca" onblur="if (this.value == '') {this.value = 'busca';}" onfocus="if (this.value == 'busca') {this.value = '';}" />
				<input type="hidden" name="post_type" value="portfolio" />
				<!-- <input class="inlineSubmit" id="searchsubmit" type="submit" alt="Search" value="Buscar" /> -->
                            </form>
                        </div><!-- #busca-aba -->
           	</div><!-- .header-portfolio -->

    <?php $term = $wp_query->queried_object; ?>
    <div class="titulo-taxonomy"><h1><?php echo '<h1 class="entry-title-interno">'.$term->name.'</h1>'; ?></h1></div>

<?php if ( have_posts() ) : ?>
    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <div class="cada-projeto">
        <div class="thumb-cada-projeto">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumb-projetos'); ?></a>
        </div><!-- .thumb-cada-projeto -->
    
        <div class="rodape-cada-projeto">
            <h3><a class="titulo-resumo" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <span class="data-cada-post"><?php the_time( 'Y' ); ?></span>
        </div><!-- .rodape-cada-projeto -->
    </div><!-- .cada-projeto -->

		<?php endwhile; ?>
    
        <?php artunlimited_content_nav( 'nav-below' ); ?>
    
    <?php else : ?>
    
        <?php get_template_part( 'no-results', 'archive' ); ?>
    
    <?php endif; ?>
    
    </div> <!-- .archive-portfolio -->

</div><!-- #content -->

<?php get_footer( 'portfolio' ); ?>
