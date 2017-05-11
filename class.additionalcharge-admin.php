<?php

/**
 * Description of class
 *
 * @author yongquizheng
 */
class AdditionalCharge_Admin {
    	
    private static $initiated = false;


    public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	public static function init_hooks() {
		self::$initiated = true;
                add_action('admin_init',array('AdditionalCharge_Admin','admin_init'));
                add_action( 'admin_menu', array( 'AdditionalCharge_Admin', 'admin_menu' ), 10 ); # Priority 5, so it's called before Jetpack's admin_menu.
	}
        
        public static function admin_init(){
            load_plugin_textdomain( ADDITIONAL_CHARGE_DOMAIN );
        }
        
        public static function admin_menu(){
            self::load_menu();
        }
        
        public static function load_menu(){
            if ( class_exists( 'WooCommerce' ) ){
              	 add_submenu_page( 'woocommerce',
                         __( 'Additional Charge' , ADDITIONAL_CHARGE_DOMAIN), 
                         __( 'Additional Charge' , ADDITIONAL_CHARGE_DOMAIN), 
                         'manage_options', 
                         'ac-fields-config', array( 'AdditionalCharge_Admin', 'display_page' ) );

            }else{
                add_menu_page( __('Additional Charge', ADDITIONAL_CHARGE_DOMAIN),
                        __('Additional Charge', ADDITIONAL_CHARGE_DOMAIN), 
                        'manage_options', 
                        'ac-fields-config', 
                        array( 'AdditionalCharge_Admin', 'display_page' ) );
            }
        }
        
        public static function get_action_url(){
            $arg = array('page'=>'ac-fields-config');
            $action_url = add_query_arg($arg, admin_url( 'admin.php' ) );
            return $action_url;
        }
        
        public static function display_page(){
            // showing the field
            self::handle_config_post();
            include(ADDITIONAL_CHARGE__PLUGIN_DIR.'/views/admin/ac-field-config.php');
        }
        
        protected static function handle_config_post(){
            $isUpdate = filter_input(INPUT_POST, 'ac-update');
            if($isUpdate==='1'){
            // here we need to handle the form submit config
                $rates = filter_input(INPUT_POST, AdditionalCharge::$rate_var);
                $message = filter_input(INPUT_POST, AdditionalCharge::$message_var);
                $btn = filter_input(INPUT_POST, AdditionalCharge::$btn_var);
                $heading = filter_input(INPUT_POST, AdditionalCharge::$heading_var);
                $fee_label = filter_input(INPUT_POST, AdditionalCharge::$fee_label_var);
                update_option(AdditionalCharge::$rate_var, $rates);
                update_option(AdditionalCharge::$heading_var, $heading);
                update_option(AdditionalCharge::$message_var, $message);
                update_option(AdditionalCharge::$btn_var, $btn);
                update_option(AdditionalCharge::$fee_label_var, $fee_label);
            }
        }

}
