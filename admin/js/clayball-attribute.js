'use struct';

(function($){
    
    $(function(){
        add_attribute();
        del_attribute();
        $( ".selector" ).sortable(
            {
                axis: "y",
                handle: ".handle",
                helper: "clone",
                placeholder: "sortable-placeholder",
                containment: ".clayballsetting_attribute_wrap",
                sort: function( event, ui ) {
                    
                    // console.log(ui.height());
                },
            }
        ).disableSelection();
    });
    
    
    var add_attribute = ()=>{
        if ($("[data-section='clayballsetting_attribute_addfield']").length>0){
            var btn = $("[data-section='clayballsetting_attribute_addfield']");
            btn.on('click',function(){
                var c = $(".clayballsetting_attribute_item:first-child").clone();
                c.find("input[type=text]").val('');
                $(".clayballsetting_attribute_itemWrap").append(c);
            });
        }
    };
    
    var del_attribute = ()=>{
        $(document).on('click','[name="del-attribute"]',function(e){
            e.preventDefault();
            $(this).parents(".clayballsetting_attribute_item").remove();
        });
    };
    
    
    
})(jQuery);