jQuery(".mb-nav-panel").on('click', '#mb-open-menu', function() {
    var id = jQuery(this).data('id');
    jQuery('.mb-panel-contents').children().hide();
    jQuery("#" + id).fadeIn(500);
    jQuery(this).parents('ul').find('a').removeClass('open');
    jQuery(this).addClass('open');
    jQuery("." + id).parent("ul").show().prev().addClass("openheader");
});

jQuery('.mb-header').on('click', '#mb_save', function(e) {
    $this   = jQuery(this);
    var serializedData = jQuery('#mb-save-options :input[name][name!="security"][name!="reset"]').serialize();
    $this.parent('.option-action').append('<i class="flaticon-spinner2"></i>');
    jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        dataType: 'json',
        data: serializedData+'&action=save_mb_options',
        success: function(response) {
             $this.parent('.option-action').find('i').remove();
             jQuery.sticky('Setting Saved.', {classList: 'success', speed: 200, autoclose: 5000});
        }
    });

    return false;

});