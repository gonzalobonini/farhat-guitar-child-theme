<?php

/*
Template Name: Bands Page
*/

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post();

                    $current_url = get_permalink();
                ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="main_title"><?php the_title(); ?></h1>
				<?php
					$thumb = '';
					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">
					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->


			<?php endwhile; ?>

            <aside class="related-bands">
                <ul class="lcp_catlist" id="lcp_instance_0">

                    <?php
                    //The Query
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $new_query = new WP_Query();
                    $new_query->query( 'showposts=21&post_type=bands&orderby=title&order=asc&cat='.$category_id.'&paged='.$paged );

                    //The Loop
                    while ($new_query->have_posts()) : $new_query->the_post();
                        $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
                        ?>

                        <li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
                        <a
                            href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img width="45" height="30"
                                                                                                src="<?php echo $url ?>"
                                                                                                class="attachment-50x30 wp-post-image"
                                                                                                alt="<?php the_title(); ?>"></a>
                    </li>

                    <?php
                    endwhile;
?>
                    <nav class="bands-pagination">
                <?php
                        if($new_query->max_num_pages>1){?>
                        <ul class="page-numbers">
                            <?php
                            for($i=1;$i<=$new_query->max_num_pages;$i++){?>
                                <li>
                                    <a href="<?php echo $current_url.'page/'.$i;?>" class="page-number <?php echo ($paged==$i)? 'active':'';?>"><?php echo $i;?></a>
                                </li>

                            <?php
                            }
                            if($paged!=$new_query->max_num_pages){?>
                                <li>
                                    <a href="<?php echo $current_url.'page/'. ($paged+1);?>"  class="page-number next">→</a>
                                </li>
                            <?php } ?>
                        </div>
                        <?php } ?>

                    </nav>


                </ul>

            </aside>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>