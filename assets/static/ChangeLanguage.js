(function($){
    
    $(function(){
        
        $('.multilanguage-set').click(function(e){
            e.preventDefault();
            var language = $(this).data('language');
            if (language && $.isNumeric(language)) {
                var date = new Date(new Date().getTime() + 86400000 * 365); // 1 year
                document.cookie = "x-language-id="+language+"; path=/; expires=" + date.toUTCString();
                
                document.location.reload();
            }
        });
        
    });
    
})(jQuery);