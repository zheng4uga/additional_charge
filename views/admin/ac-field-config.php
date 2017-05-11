<div class="ac-field-confg">
    <h2><?php _e("Additional Charge",ADDITIONAL_CHARGE_DOMAIN) ?></h2>
    <form action="<?php echo AdditionalCharge_Admin::get_action_url(); ?>" method="post">
        <input type="hidden" name="ac-update" value=1 />
        <table class="ac-field-table form-table">
            <tr>
                <th><label for="ac-charge-rate"><?php _e("Rates", AdditionalCharge::$domain) ?></label></th>
                <td>
                    <input type="text" name="ac-charge-rates" placeholder="0.10,0.15,0.18,0.20" id="ac-charge-rate" value="<?php echo esc_attr(get_option( 'ac-charge-rates') ); ?>" class="regular-text" /><br />
                    <span class="description">Enter comma separated rate (ex: 0.10,0.15,0.18,0.20)</span>
                </td>

            </tr>
            <tr>
                   <th><label for="ac-heading"><?php _e("Heading", AdditionalCharge::$domain) ?></label></th>
                <td>
                    <input type="text" name="ac-heading" placeholder="Additional Charge" id="ac-heading" value="<?php echo esc_attr(get_option( 'ac-heading') ); ?>" class="regular-text" /><br />
                    <span class="description">Set the charge heading text (ex: Additional Charge)</span>
                </td>
            </tr>
            <tr>
                 <th><label for="ac-message"><?php _e("Notificatoin Message", AdditionalCharge::$domain) ?></label></th>
                <td>
                    <input type="text" name="ac-message" placeholder="Charge has been added" id="ac-message" value="<?php echo esc_attr(get_option( 'ac-message') ); ?>" class="regular-text" /><br />
                    <span class="description">Set the status message (Ex: Charge has been added)</span>
                </td>
            </tr>
            <tr>
                             
                     <th><label for="ac-btn"><?php _e("Button Text", AdditionalCharge::$domain) ?></label></th>
                <td>
                    <input type="text" name="ac-btn" placeholder="Add Charge" id="ac-btn" value="<?php echo esc_attr(get_option( 'ac-btn') ); ?>" class="regular-text" /><br />
                    <span class="description">Enter the button text (Ex: Add Charge)</span>
                </td>
            </tr>
               <tr>
                             
                     <th><label for="ac-fee-label"><?php _e("Fee Label", AdditionalCharge::$domain) ?></label></th>
                <td>
                    <input type="text" name="ac-fee-label" placeholder="Additional Charge" id="ac-btn" value="<?php echo esc_attr(get_option( 'ac-fee-label') ); ?>" class="regular-text" /><br />
                    <span class="description">Enter the fee label (Ex: Additional Charge)</span>
                </td>
            </tr>
        </table>
       <input type="submit" name="submit" class="button-primary" value="Save Changes">
    </form>
</div>