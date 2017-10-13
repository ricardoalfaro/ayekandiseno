(function() {
    
    
    // Create the plugin
    tinymce.create('tinymce.plugins.sc_button' , {
        
      init : function(ed , url) {
        
            ed.addButton('sc_button' , {
            
                    title : 'Shortcodes' ,
                    image : url + '/img.png',
                    onclick : function() {
					ed.windowManager.open({
						file : url + '/window.php',
						width : 800,
						height : 500,
						inline : 1
					});					 

                    }
                
            });
        
        
      } , createControl : function(n, cm) {
            return null;
        } 
    });
    
    
    // Register the plugin
    tinymce.PluginManager.add('sc_button', tinymce.plugins.sc_button);
    
})();