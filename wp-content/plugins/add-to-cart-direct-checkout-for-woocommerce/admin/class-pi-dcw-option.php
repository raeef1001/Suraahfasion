<?php

class Class_Pi_Dcw_Option{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'default';

    private $tab_name = "Basic setting";

    private $setting_key = 'basic_setting_dcw';

    private $pages =array();

    public $tab;
    
    private $pro_version = false;

    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;


        $this->pages = $this->get_pages();
        
        $this->tab = sanitize_text_field(filter_input( INPUT_GET, 'tab'));
        $this->active_tab = $this->tab != "" ? $this->tab : 'default';

        if($this->this_tab == $this->active_tab){
            add_action($this->plugin_name.'_tab_content', array($this,'tab_content'));
        }

        $this->pro_version = pi_dcw_pro_check();

        $url = admin_url( 'admin.php?page=pi-dcw&tab=checkout#row_option_to_remove_qty_on_checkout' );

        add_action($this->plugin_name.'_tab', array($this,'tab'),1);

        $this->settings = array(
            array('field'=>'sunday', 'class'=> 'bg-secondary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__('Single page / One page Checkout setting<br>(Your checkout page should be made using [woocommerce_checkout] shortcode  and not by WooCommerce content block) ','pi-dcw'), 'type'=>'setting_category'),

            array('field'=>'pi_dcw_disable_cart','desc'=>__('Disable cart page, so all the cart page will be redirected to checkout page','pi-dcw'), 'label'=>__('Disable cart page','pi-dcw'),'type'=>'switch', 'default'=>1),

            array('field'=>'pi_dcw_single_page_checkout','desc'=>__('Enable single page checkout, so checkout page will show the cart as well<br><strong>Enabling this option will disable the option of "Change and Remove Quantity on checkout page" found in <a href="'.$url.'" target="_blank">Checkout page tab</a></strong>','pi-dcw'), 'label'=>__('Enable single page checkout','pi-dcw'),'type'=>'switch','default'=>1),

            array('field'=>'pi_dcw_use_old_way','desc'=>__('We change changed the way we implemented single page checkout it will not make any difference to you but if you face any issue in checkout page layout you can fall back to old way using this setting','pi-dcw'), 'label'=>__('Use old implementation of single page checkout','pi-dcw'),'type'=>'switch', 'default'=>0),

            array('field'=>'sunday', 'class'=> 'bg-secondary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__('Redirect Setting','pi-dcw'), 'type'=>'setting_category'),

            array('field'=>'pi_dcw_global_redirect','desc'=>__('Once enabled, after clicking add to cart button customer will be directly redirected to Checkout page or the page selected by you in below setting','pi-dcw'), 'label'=>__('Enable redirect on add to cart','pi-dcw'),'type'=>'switch', 'default'=>1),
            
            array('field'=>'pi_dcw_global_redirect_custom_url','desc'=>__('Redirect to custom url instead of page, so using this you can redirect to category page, tag page or post, or any third website url','pi-dcw'), 'label'=>__('Redirect to custom url','pi-dcw'),'type'=>'switch','default'=>0),

            array('field'=>'pi_dcw_global_redirect_to_page','desc'=>__('If you have enabled the first option "Enable redirect" and you don\'t select any page in here then customer will be redirected to checkout page after doing add to cart, if you want to redirect to some other page then select here','pi-dcw'), 'label'=>__('Redirect to page','pi-dcw'),'type'=>'select', 'value'=>$this->pages),

            array('field'=>'pi_dcw_global_custom_url','desc'=>__('Redirect to this any custom url of your website e.g.: http://yourwebsite.com<br> <strong>(PRO version even allows you to redirect to external website link as well)</strong>','pi-dcw'), 'label'=>__('Redirect to custom url','pi-dcw'),'type'=>'text'),

            array('field'=>'pi_dcw_global_disable_continue_shopping_btn','desc'=>__('WooCommerce shows a continue shopping button after a product is added to cart, with this option you can disable that link so user remain on checkout page','pi-dcw'), 'label'=>__('Disable continue shopping button','pi-dcw'),'type'=>'switch','default'=>0),
           
        );
        $this->register_settings();
        
        
    }

    function get_pages(){
        $pages = get_posts(array('numberposts' => -1, 'post_type' => 'page'));
        $pages_array = array(""=>__("Select page","pi-dcw"));
        if($pages){
            foreach ( $pages as $page ) {
                $pages_array[$page->ID] = $page->post_title;
            }
        }
        return $pages_array;
    }

    

    function register_settings(){   

        foreach($this->settings as $setting){
            register_setting( $this->setting_key, $setting['field']);
        }
    
    }

    function tab(){
        ?>
        <a class=" px-3 text-light d-flex align-items-center  border-left border-right  <?php echo ($this->active_tab == $this->this_tab ? 'bg-primary' : 'bg-secondary'); ?>" href="<?php echo admin_url( 'admin.php?page='.sanitize_text_field($_GET['page']).'&tab='.$this->this_tab ); ?>">
            <?php _e( $this->tab_name, 'http2-push-content' ); ?> 
        </a>
        <?php
    }

    function tab_content(){
       ?>
        <form method="post" action="options.php"  class="pisol-setting-form">
        <?php settings_fields( $this->setting_key ); ?>
        <?php
            foreach($this->settings as $setting){
                new pisol_class_form_dcw($setting, $this->setting_key);
            }
        ?>
        <input type="submit" class="mt-3 btn btn-primary btn-sm" value="Save Option" />
        </form>
       <?php
    }

    
}

new Class_Pi_Dcw_Option($this->plugin_name);