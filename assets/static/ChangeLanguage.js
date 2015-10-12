(function($){
    
    $(function(){
        
        $('.multilanguage-set').click(function(e){
            e.preventDefault();
            var language = $(this).data('language');
            if (language && $.isNumeric(language)) {
                $.cookie('x-language-id', language, { expires: 365, path: '/' });
                document.location.reload();
            }
        });
        
    });
    
})(jQuery);