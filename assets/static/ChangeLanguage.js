(function($){
    
    $(function(){
        
        $('.multilanguage-set').click(function(e){
            e.preventDefault();
            var language = $(this).data('language');
            if (language && $.isNumeric(language)) {
                
                var date = new Date(new Date().getTime()/1000 + 1000 * 86400 * 365);
                document.cookie = "x-language-id="+language+"; path=/; expires=" + date.toUTCString();
                
                document.location.reload();
            }
        });
        
    });
    
})(jQuery);