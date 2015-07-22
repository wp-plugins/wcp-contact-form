(function($) {  
    $(document).ready(function() { 
        $('.scfp-captcha-refresh').on('click', function( event ) {
            event.preventDefault();
            var container = $(this).closest('.scfp-form-row').find('.scfp-captcha-image');
            var self = this;
            
            var data = {};
            data.action = 'recreateCaptcha';
            data.nonce = ajax_scfp.ajax_nonce;
            data.id = $(this).data('id');
            data.key = $(this).data('key');

            $.ajax({
                url:ajax_scfp.ajax_url,
                type: 'POST' ,
                data: data,
                dataType: 'html',
                cache: false,
                success: function(data) {
                    $(container).html($(data).find('.scfp-captcha-image').html());
                    $(self).closest('.scfp-form-row').find('.scfp-captcha-field .scfp-form-field').val('');
                },
                error: function (request, status, error) {
                }
            });            
          
            return false;
        });
        
        
        
    });
})(jQuery);


