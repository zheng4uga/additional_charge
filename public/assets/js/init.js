jQuery(document).ready(function(){
    //change the tip function
    var inputVal = jQuery("#input-text-ac");
    var messageCont = jQuery('.addtional-charge-message');;
    jQuery('input.ac-selection').each(function(){
       jQuery(this).click(function(){
           var charge = jQuery(this).val();
           inputVal.val(charge);
       }); 
    });
    jQuery('#ac-add-charge').click(function(){
        var charge = inputVal.val();
        uploadChargeValue(charge,inputVal,messageCont);
    });
});

function uploadChargeValue(charge,inputVal,messageCon){
       jQuery('#ac-spinner').show();
       jQuery.ajax({
        url:woocommerce_params.ajax_url,
        method:"POST",
        dataType:"json",
        data:{'charge':charge,'action':'add_charge'},
        success:function(data,status){
            if(status==="success" && data.status===1){
                jQuery("body").trigger("update_checkout");
            }
            jQuery("#ac-spinner").hide();
            jQuery(messageCon).html(data.message);
            jQuery(inputVal).val('$'+charge);
        }
    });
}



