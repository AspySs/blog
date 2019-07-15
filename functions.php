<?php


		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'blog' ),
		) );

		add_theme_support( 'post-thumbnails', 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		set_post_thumbnail_size( $width = 360, $height = 500, $crop = true );


