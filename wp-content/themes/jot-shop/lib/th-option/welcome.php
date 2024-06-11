
<!--- tab first -->
<div class="theme_link">
    <h3><?php _e('1. Install Recommended Plugins','jot-shop'); ?></h3>
    <p><?php _e('We highly Recommend to install ThemeHunk Customizer plugin to get all customization options in Jot Shop theme. Also install recommended plugins available in recommended tab.','jot-shop'); ?></p>
</div>
<div class="theme_link">
    <h3><?php _e('2. Setup Home Page','jot-shop'); ?><!-- <php echo $theme_config['plugin_title']; ?> --></h3>
        <p><?php _e('To set up the HomePage in Jot Shop theme, Just follow the below given Instructions.','jot-shop'); ?> </p>
<p><?php _e('Go to Wp Dashboard > Pages > Add New > Create a Page using “Home Page Template” available in Page attribute.','jot-shop'); ?> </p>
<p><?php _e('Now go to Settings > Reading > Your homepage displays > A static page (select below) and set that page as your homepage.','jot-shop'); ?> </p>
     <p>
        <?php
		if($this->_check_homepage_setup()){
            $class = "activated";
            $btn_text = __('Home Page Activated','jot-shop');
            $Bstyle = "display:none;";
            $style = "display:inline-block;";
        }else{
            $class = "default-home";
             $btn_text = __('Set Home Page','jot-shop');
             $Bstyle = "display:inline-block;";
            $style = "display:none;";


        }
        ?>
        <button style="<?php echo $Bstyle; ?>" class="button activate-now <?php echo $class; ?>"><?php echo esc_html($btn_text); ?></button>
		
         </p>
		 	 
		 
    <p>
        <a target="_blank" href="https://themehunk.com/docs/jot-shop/#homepage-setting" class="button"><?php _e('Go to Doc','jot-shop'); ?></a>
    </p>
</div>

<!--- tab third -->





<!--- tab second -->
<div class="theme_link">
    <h3><?php _e('3. Customize Your Website','jot-shop'); ?><!-- <php echo $theme_config['plugin_title']; ?> --></h3>
    <p><?php _e('Jot Shop theme support live customizer for home page set up. Everything visible at home page can be changed through customize panel','jot-shop'); ?></p>
    <p>
    <a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php _e("Start Customize","jot-shop"); ?></a>
    </p>
</div>
<!--- tab third -->

  <div class="theme_link">
    <h3><?php _e("4. Customizer Links","jot-shop"); ?></h3>
    <div class="card-content">
        <div class="columns">
                <div class="col">
                    <a href="<?php echo admin_url('customize.php?autofocus[control]=custom_logo'); ?>" class="components-button is-link"><?php _e("Upload Logo","jot-shop"); ?></a>
                    <hr><a href="<?php echo admin_url('customize.php?autofocus[section]=jot-shop-gloabal-color'); ?>" class="components-button is-link"><?php _e("Global Colors","jot-shop"); ?></a><hr>
                    <a href="<?php echo admin_url('customize.php?autofocus[panel]=woocommerce'); ?>" class="components-button is-link"><?php _e("Woocommerce","jot-shop"); ?></a><hr>

                </div>

               <div class="col">
                <a href="<?php echo admin_url('customize.php?autofocus[section]=jot-shop-section-header-group'); ?>" class="components-button is-link"><?php _e("Header Options","jot-shop"); ?></a>
                <hr>

                <a href="<?php echo admin_url('customize.php?autofocus[panel]=jot-shop-panel-frontpage'); ?>" class="components-button is-link"><?php _e("FrontPage Sections","jot-shop"); ?></a><hr>


                 <a href="<?php echo admin_url('customize.php?autofocus[section]=jot-shop-section-footer-group'); ?>" class="components-button is-link"><?php _e("Footer Section","jot-shop"); ?></a><hr>
            </div>

        </div>
    </div>

</div>
<!--- tab fourth -->