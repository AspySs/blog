<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
	<?php if( has_post_thumbnail()): ?>
		<div class="poster" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></div><?php endif; ?>
		<div class="details">
			<a href="<?php echo esc_url( get_permalink() );?>" class="title"><?php the_title(); ?></a>
			<div class="meta">
				<em class="date"><?php the_date('d/m/Y'); ?></em>
				<?php the_category(' '); ?>
			</div>
			<div class="content">
				<?php
				the_content( sprintf(
					__( 'Continue reading %s', 'blog' )
			) );
				?>
			</div>
		</div>
	</article>