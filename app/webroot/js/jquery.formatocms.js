(function(){
    jQuery.fn.formatocms = function(options){
        
        this.each(function(){
            var settings = {
                url: "",
                type: "POST",
                dataType: "JSON"
            };
            if(options){
                $.extend(settings, options);
            }
            $this = jQuery(this);
            $this.bind('click', function(){
                $.ajax({
                  url: settings.url,
                  type: settings.type,
                  dataType: settings.dataType,
                  success: function(data){
                      $.each(data, function(i, val){
                          console.log(val.mensagem)
                      });
                  }
                  
                });
                
            });
            
        });
        
    }
    
})(jQuery)

