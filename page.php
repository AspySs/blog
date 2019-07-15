<?php get_header(); ?>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content(
				sprintf(
					__( 'Continue reading %s', 'blog' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				)
			);

			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'blog' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'blog' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);
			?>
	</div><!-- .entry-content -->

				<figure>

				<img src="<?php bloginfo('template_directory') ?>/images/blog-logo.png" class="content-img">

				<b><p class="content-text">Справедливый блог</p></b>

				<p class="content-text date">17.06.2019</p>

				<p class="content-text text"> Бы(д)ло ?</p>

				<p class="content-text read-more-p">

				<a href="#" class="read-more">Читать далее</a>
		
				</p>

				</figure>

		</ul>

	</div>

</body>

</html>