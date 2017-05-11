<?php

/**
 * Description of class
 *
 * @author yongquizheng
 */
class AdditionalCharge {
    
        private static $initiated = false;
        private static $domain='addtional_charge';
        
        public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
        }
        /**
	 * Initializes WordPress hooks
	 */
	private static function init_hooks() {
		self::$initiated = true;
                add_action('woocommerce_after_order_notes',array('AdditionalCharge','add_additional_charge_section'));
                add_action('init',array('AdditionalCharge','init_domain'),97);
                add_action('init',array('AdditionalCharge','init_session'),96);
                add_action('init',array('AdditionalCharge','registerScriptAndStyle'),98);
                
                add_action('wp_enqueue_scripts', array('AdditionalCharge','enqueueScriptAndStyle'),99);
                
                add_action('wp_ajax_nopriv_add_charge',array('AdditionalCharge','add_charge'),10);
                add_action('wp_ajax_add_charge',array('AdditionalCharge','add_charge'),10);
                add_action('woocommerce_cart_calculate_fees', array('AdditionalCharge','add_charge_cost_from_session'),10);

	}
        
        public static function add_charge(){            
                $cost = filter_input(INPUT_POST,'charge',FILTER_VALIDATE_FLOAT);
                $charge = floatval($cost);
                if($charge!=0.0){
                    $_SESSION['charge_value']=$charge;
                    echo json_encode(array("status"=>1,"message"=>__("Tip has been added","shundao")));
                }else{
                    echo json_encode(array("status"=>0,"message"=>__("Failed to add tip","shundao")));
                }
                exit();
        }
        public static function add_charge_cost_from_session() {
            global $woocommerce;
            $cart=$woocommerce->cart;
            $charge=$_SESSION['charge_value'];
            if($charge!=null){
                $tip_label=__("Additional Charge:",self::$domain);
                $cart->add_fee($tip_label,$charge);
                unset($_SESSION['charge_value']);
            }
        }
        
        public static function init_domain(){
           load_plugin_textdomain( self::$domain );
        }
        
        public static function init_session(){
              $status = session_status();
            if ( PHP_SESSION_DISABLED === $status ) {
                // That's why you cannot rely on sessions!
                return;
            }
            if ( PHP_SESSION_NONE === $status ) {
                session_start();
            }
        }


        public static function registerScriptAndStyle(){
            // try loading the script
            $initJs =plugins_url('/public/assets/js/init.js', __FILE__);
            $styleCss =plugins_url('/public/assets/css/additionalcharge.css', __FILE__);
            wp_register_script( 'ac_script',$initJs );
            wp_register_style( 'ac_style', $styleCss);
            
        }
        
        public static function enqueueScriptAndStyle(){
            wp_enqueue_script('ac_script');
            wp_enqueue_style('ac_style');
        }
        
        
        
    
    	/**
	 * Attached to activate_{ plugin_basename( __FILES__ ) } by register_activation_hook()
	 * @static
	 */
	public static function plugin_activation() {

	}

	/**
	 * Removes all connection options
	 * @static
	 */
	public static function plugin_deactivation( ) {
	}
        
        // adding actions
        public static function add_additional_charge_section(){
            global $woocommerce;
            //TODO: need to the rate to the admin page
            $rates = array(0.10,0.15,0.18,0.20);
            // we handle output the additional charge to woocommerce section
            $cart_total = $woocommerce->cart->cart_contents_total;
        ?>
            <div class="addtional-charge-info-cont">
                <p class="addtional-charge-info"></p>
            </div>
            <div class="additional-charge-cont">
                <h4><?php _e("Additional Charge", self::$domain); ?><div id="ac-spinner" class="ac-spinner"></div></h4>
                <div class="addtional-charge-radio-cont">
                    <p class="addtional-charge-message do-not-show"></p>
                    <?php for($i=0;$i<count($rates);$i++){ ?>
                        <input class="ac-selection" checked="checked"  
                               type="radio" 
                               id="ac-radio-<?php echo $i ?>" 
                               name="ac-radios" 
                               value="<?php echo (number_format(($rates[$i] * $cart_total),2)); ?>">
                        <label for="ac-radio-<?php echo $i ?>">
                            <?php echo ($rates[$i] * 100)."% ($".(number_format(($rates[$i] * $cart_total),2)).")";?>
                        </label>
                    <?php } ?>
                        
                      <div class="additional-charge-control">
                        <input type="text" name="additional-charge-value" 
                               class="input-text-ac" id="input-text-ac" value="">
                        <button id="ac-add-charge" type="button"><?php _e("Add Charge",self::$domain) ?></button>
                      </div>    
                </div>
            </div>
<?php
        }
}
