(function ($) {
    'use strict';
    var ph, pw, thpw;
    $(document).ready(function () {
        $('#add_clayball_gallery_section ul').sortable({
            items: '> li',
            // handle: '.sort-handle',
            cursor: "move",
            cancle: '',
            placeholder: "ui-state-highlight",
            helper: function (e, item) {
                if (!item.hasClass('ui-selected')) {
                    item.parent().children('.ui-selected').removeClass('ui-selected');
                    item.addClass('ui-selected');
                }
                var selected = item.parent().children('.ui-selected').clone();
                //placeholder用の高さを取得しておく
                pw = (item.outerWidth() + 20) * selected.length;
                thpw = item.outerWidth();
                ph = item.outerHeight();
                // console.log(pw);
                item.data('multidrag', selected).siblings('.ui-selected').remove();
                return $('<div/>').append(selected);
            },
            stop: function (e, ui) {
                var sortID = [];
                $('#add_clayball_gallery_section ul >li').each(function (inx, obj) {
                    sortID.push($(this).data('id'));
                });
                $('input#clayball_gallery_array').val(sortID.join(','));
            }
        });


    }); //document.ready over

})(jQuery);
