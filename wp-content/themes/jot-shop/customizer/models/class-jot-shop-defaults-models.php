<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * This file stores all functions that return default content.
 *
 * @package  Jot Shop
 */
/**
 * Class Jot_Shop_Defaults_Models
 *
 * @package  Jot Shop
 */
class Jot_Shop_Defaults_Models extends Jot_Shop_Singleton{
/**
	 * Get default values for features section.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	/**
	 * Get default values for Brands section.

	 * @access public
	 */
public function get_brand_default() {
		return apply_filters(
			'jot_shop_brand_default_content', json_encode(
				array(
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '#',
					),
					array(
						'image_url' => '',
						'link'       => '#',
					),
				)
			)
		);
	}


	/**
	 * Get default values for features section.

	 * @access public
	 */
	public function get_feature_default() {
		return apply_filters(
			'jot_shop_highlight_default_content', json_encode(
				array(
					array(
						'icon_value' => 'fa-cog',
						'title'      => esc_html__( 'Free Shiping', 'jot-shop' ),
						'subtitle'   => esc_html__( 'On all order over ', 'jot-shop' ),
						
					),
					array(
						'icon_value' => 'fa-cog',
						'title'      => esc_html__( 'Free Shiping', 'jot-shop' ),
						'subtitle'   => esc_html__( 'On all order over ', 'jot-shop' ),
						
					),
					array(
						'icon_value' => 'fa-cog',
						'title'      => esc_html__( 'Free Shiping', 'jot-shop' ),
						'subtitle'   => esc_html__( 'On all order over ', 'jot-shop' ),
						
					),
				)
			)
		);
	}	


	public function get_faq_default() {
		return apply_filters(
			'jotshop_faq_default_content', json_encode(
				array( 
					array(
						'title'     => esc_html__( 'What do you want to know', 'jot-shop' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'jot-shop' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'jot-shop' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'jot-shop' ),
					),
					
					array(
						'title'     => esc_html__( 'What do you want to know', 'jot-shop' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'jot-shop' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'jot-shop' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'jot-shop' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'jot-shop' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'jot-shop' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'jot-shop' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'jot-shop' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'jot-shop' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'jot-shop' ),
					),

					array(
						'title'     => esc_html__( 'What do you want to know', 'jot-shop' ),
						
						'text'      => esc_html__( 'Nulla et sodales nisl. Nam auctor quis odio eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'jot-shop' ),
					),

				)
			)
		);	
	}

	/**
	 * Get default values for features section.

	 * @access public
	 */
	public function get_service_default() {
		return apply_filters(
			'jot_shop_service_default_content', json_encode(
				array(
					array(
						'icon_value' => 'fa-diamond',
						'title'      => esc_html__( 'Development', 'jot-shop' ),
						'text'       => esc_html__( 'Nam varius mauris eget sodales tempus. Quisque sollicitudin consectetur accumsan. Ut imperdiet mi velit, ut congue justo sagittis eget',
							'jot-shop' ),
						'link'       => '#',
						'color'      => '#ff214f',
					),
					array(
						'icon_value' => 'fa-heart',
						'title'      => esc_html__( 'Design', 'jot-shop' ),
						'text'       => esc_html__( 'Nam varius mauris eget sodales tempus. Quisque sollicitudin consectetur accumsan. Ut imperdiet mi velit, ut congue justo sagittis eget',
							'jot-shop' ),
						'link'       => '#',
						'color'      => '#00bcd4',
					),
					array(
						'icon_value' => 'fa-globe',
						'title'      => esc_html__( 'Seo', 'jot-shop' ),
						'text'       => esc_html__( 'Nam varius mauris eget sodales tempus. Quisque sollicitudin consectetur accumsan. Ut imperdiet mi velit, ut congue justo sagittis eget',
							'jot-shop' ),
						'link'       => '#',
						'color'      => '#4caf50',
					),
				)
			)
		);
	}	

	/**
	 * Get default values for Testimonials section.

	 * @access public
	 */
public function get_testimonials_default() {
		return apply_filters(
			'jot_shop_testimonials_default_content', json_encode(
				array(
					array(
						'image_url' =>	JOT_SHOP_THEME_URI . 'image/testimonial1.png',
						'title'     => esc_html__( 'Surbhi', 'jot-shop' ),
						'subtitle'  => esc_html__( 'Business Owner', 'jot-shop' ),
						'text'      => esc_html__( '"Nunc eu elementum libero. Etiam egestas leo eget urna ultrices, in finibus eros gravida. Donec scelerisque pulvinar dapibus. Nam pretium risus sed metus ultrices blandit. Pellentesque rhoncus est non nunc ultricies accumsan. Nullam gravida turpis et lacinia cursus. Fusce iaculis mattis consectetur."', 'jot-shop' ),
						'link'		=>	'#',
						'id'        => 'customizer_repeater_56d7ea7f40d56',
					),
					array(
						'image_url' =>	JOT_SHOP_THEME_URI . 'image/testimonial2.png',
						'title'     => esc_html__( 'Nataliya', 'jot-shop' ),
						'subtitle'  => esc_html__( 'Artist', 'jot-shop' ),
						'text'      => esc_html__( '"Nunc eu elementum libero. Etiam egestas leo eget urna ultrices, in finibus eros gravida. Donec scelerisque pulvinar dapibus. Nam pretium risus sed metus ultrices blandit. Pellentesque rhoncus est non nunc ultricies accumsan. Nullam gravida turpis et lacinia cursus. Fusce iaculis mattis consectetur."', 'jot-shop' ),
						'link'		=>	'#',
						'id'        => 'customizer_repeater_56d7ea7f40d66',
					),

					array(
						'image_url' =>	JOT_SHOP_THEME_URI . 'image/testimonial1.png',
						'title'     => esc_html__( 'Ramedrin', 'jot-shop' ),
						'subtitle'  => esc_html__( 'Business Owner', 'jot-shop' ),
						'text'      => esc_html__( '"Nunc eu elementum libero. Etiam egestas leo eget urna ultrices, in finibus eros gravida. Donec scelerisque pulvinar dapibus. Nam pretium risus sed metus ultrices blandit. Pellentesque rhoncus est non nunc ultricies accumsan. Nullam gravida turpis et lacinia cursus. Fusce iaculis mattis consectetur."', 'jot-shop' ),
						'link'		=>	'#',
						'id'        => 'customizer_repeater_56d7ea7f40d56',
					),
				)
			)
		);
	}


public function get_team_default() {
		return apply_filters(
			'jot_shop_team_default_content', json_encode(
				array( 
					array(
						'title'     => esc_html__( 'Gabriel', 'jot-shop' ),					
						'subtitle'  => esc_html__( 'Developer', 'jot-shop' ),
						'text'      => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'jot-shop' ),
						'image_url' => JOT_SHOP_THEME_URI . 'image/team2.jpg',
						'link'       => '#',
						'social_repeater' => json_encode(
							array(
									array(
									
									'link' => 'youtube.com',
									'icon' => 'fa-youtube',
									),
									array(
									
									'link' => 'twitter.com',
									'icon' => 'fa-twitter',
									),
								array(
									
									'link' => 'linkedin.com',
									'icon' => 'fa-linkedin',
								),
							)
						),
					),

					array(
						'title'     => esc_html__( 'Maurics', 'jot-shop' ),					
						'subtitle'  => esc_html__( 'Marketer', 'jot-shop' ),
						'text'      => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'jot-shop' ),
						'image_url' => JOT_SHOP_THEME_URI . 'image/team2.jpg',
						'link'       => '#',
						'social_repeater' => json_encode(
							array(
									array(
									
									'link' => 'youtube.com',
									'icon' => 'fa-youtube',
									),
									array(
									
									'link' => 'twitter.com',
									'icon' => 'fa-twitter',
									),
								array(
									
									'link' => 'linkedin.com',
									'icon' => 'fa-linkedin',
								),
							)
						),
					),

					array(
						'title'     => esc_html__( 'Ramedrin', 'jot-shop' ),					
						'subtitle'  => esc_html__( 'Designer', 'jot-shop' ),
						'text'      => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'jot-shop' ),
						'image_url' => JOT_SHOP_THEME_URI . 'image/team2.jpg',
						'link'       => '#',
						'social_repeater' => json_encode(
							array(
									array(
									
									'link' => 'youtube.com',
									'icon' => 'fa-youtube',
									),
									array(
									
									'link' => 'twitter.com',
									'icon' => 'fa-twitter',
									),
								array(
									
									'link' => 'linkedin.com',
									'icon' => 'fa-linkedin',
								),
							)
						),
					),	
					array(
						'title'     => esc_html__( 'Ramedrin', 'jot-shop' ),					
						'subtitle'  => esc_html__( 'Designer', 'jot-shop' ),
						'text'      => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'jot-shop' ),
						'image_url' => JOT_SHOP_THEME_URI . 'image/team2.jpg',
						'link'       => '#',
						'social_repeater' => json_encode(
							array(
									array(
									
									'link' => 'youtube.com',
									'icon' => 'fa-youtube',
									),
									array(
									
									'link' => 'twitter.com',
									'icon' => 'fa-twitter',
									),
								array(
									
									'link' => 'linkedin.com',
									'icon' => 'fa-linkedin',
								),
							)
						),
					),	

				)///	
			)	
		);
	}
}
