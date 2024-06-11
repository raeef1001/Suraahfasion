/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
jQuery(document).ready(function($){
    $.jotShop = {
        init: function () {
            this.focusForCustomShortcut();
        },
        focusForCustomShortcut: function (){
            var fakeShortcutClasses = [
                'jot_shop_top_slider_section',
                'jot_shop_category_tab_section',
                'jot_shop_product_slide_section',
                'jot_shop_cat_slide_section',
                'jot_shop_product_slide_list',
                'jot_shop_product_cat_list',
                'jot_shop_brand',
                'jot_shop_ribbon',
                'jot_shop_banner',
                'jot_shop_highlight',
                'jot_shop_product_big_feature',
                'jot_shop_1_custom_sec',
                'jot_shop_2_custom_sec',
                'jot_shop_3_custom_sec',
                'jot_shop_4_custom_sec',
            ];
            fakeShortcutClasses.forEach(function (element){
                $('.customize-partial-edit-shortcut-'+ element).on('click',function (){
                   wp.customize.preview.send( 'jot-shop-customize-focus-section', element );
                });
            });
        }
    };
    $.jotShop.init();
    // color
    $.jotShopColor = {
        init: function () {
            this.focusForCustomShortcutColor();
        },
        focusForCustomShortcutColor: function (){
            var fakeShortcutClasses = [
                'jot-shop-top-slider-color',
                'jot-shop-cat-slider-color',
                'jot-shop-ribbon-color',
            ];
            fakeShortcutClasses.forEach(function (element){
                $('.customize-partial-edit-shortcut-'+ element).on('click',function (){
                   wp.customize.preview.send( 'jot-shop-customize-focus-color-section', element );
                });
            });
        }
    };
    $.jotShopColor.init();
});