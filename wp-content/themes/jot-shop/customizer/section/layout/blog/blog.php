<?php
/**
 *Blog Option
 /*******************/
//blog post content
/*******************/
    $wp_customize->add_setting('jot_shop_blog_post_content', array(
        'default'        => 'excerpt',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
    $wp_customize->add_control('jot_shop_blog_post_content', array(
        'settings' => 'jot_shop_blog_post_content',
        'label'   => __('Blog Post Content','jot-shop'),
        'section' => 'jot-shop-section-blog-group',
        'type'    => 'select',
        'choices'    => array(
        'full'   => __('Full Content','jot-shop'),
        'excerpt' => __('Excerpt Content','jot-shop'), 
        'nocontent' => __('No Content','jot-shop'), 
        ),
         'priority'   =>9,
    ));
    // excerpt length
    $wp_customize->add_setting('jot_shop_blog_expt_length', array(
			'default'           =>'30',
            'capability'        => 'edit_theme_options',
			'sanitize_callback' =>'jot_shop_sanitize_number',
		)
	);
	$wp_customize->add_control('jot_shop_blog_expt_length', array(
			'type'        => 'number',
			'section'     => 'jot-shop-section-blog-group',
			'label'       => __( 'Excerpt Length', 'jot-shop' ),
			'input_attrs' => array(
				'min'  => 0,
				'step' => 1,
				'max'  => 3000,
			),
             'priority'   =>10,
		)
	);
	// read more text
    $wp_customize->add_setting('jot_shop_blog_read_more_txt', array(
			'default'           =>'Read More',
            'capability'        => 'edit_theme_options',
			'sanitize_callback' =>'jot_shop_sanitize_text',
            'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control('jot_shop_blog_read_more_txt', array(
			'type'        => 'text',
			'section'     => 'jot-shop-section-blog-group',
			'label'       => __( 'Read More Text', 'jot-shop' ),
			'settings' => 'jot_shop_blog_read_more_txt',
             'priority'   =>11,
			
		)
	);
    /*********************/
    //blog post pagination
    /*********************/
   $wp_customize->add_setting('jot_shop_blog_post_pagination', array(
        'default'        => 'num',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
    $wp_customize->add_control('jot_shop_blog_post_pagination', array(
        'settings' => 'jot_shop_blog_post_pagination',
        'label'   => __('Post Pagination','jot-shop'),
        'section' => 'jot-shop-section-blog-group',
        'type'    => 'select',
        'choices' => array(
        'num'     => __('Numbered','jot-shop'),
        'click'   => __('Load More (Pro)','jot-shop'), 
        'scroll'  => __('Infinite Scroll (Pro)','jot-shop'), 
        ),
        'priority'   =>13,
    ));
    $wp_customize->add_setting( 'jot_shop_blog_single_sidebar_disable', array(
                'default'               => false,
                'sanitize_callback'     => 'jot_shop_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'jot_shop_blog_single_sidebar_disable', array(
                'label'                 => esc_html__('Force to disable sidebar in single page.', 'jot-shop'),
                'type'                  => 'checkbox',
                'section'               => 'jot-shop-section-blog-group',
                'settings'              => 'jot_shop_blog_single_sidebar_disable',
                'priority'   => 14,
            ) ) );
/****************/
//blog doc link
/****************/
$wp_customize->add_setting('jot_shop_blog_arch_learn_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_blog_arch_learn_more',
            array(
        'section'    => 'jot-shop-section-blog-group',
        'type'      => 'doc-link',
        'url'       => 'https://themehunk.com/docs/jot-shop/#blog-setting',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));