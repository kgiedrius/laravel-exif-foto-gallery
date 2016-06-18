var FancyBox = function () {

    return {
            
        //Fancybox
        initFancybox: function () {
            jQuery(".fancybox").fancybox({
            groupAttr: 'data-rel',
            prevEffect: 'fade',
            nextEffect: 'fade',
            openEffect  : 'elastic',
            closeEffect  : 'fade',
            closeBtn: false,
                overlayOpacity:1,
                padding:0,
                margin:5,
                modal:false,
            helpers: {
                title: {
                        type: 'float'
                    }
                }
            });

            $(".fbox-modal").fancybox({

                maxWidth    : 800,
                maxHeight   : 600,
                fitToView   : true,
                width       : '90%',
                height      : '90%',
                autoSize    : false,
                closeClick  : false,
                closeEffect : 'fade',
                openEffect  : 'elastic'
            });
        }

    };

}();        