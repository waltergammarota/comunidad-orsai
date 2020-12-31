 $(document).ready(function() {
 
         $("#owlMainSlider").owlCarousel({

             navigation : true, // Show next and prev buttons
             slideSpeed : 300,
             paginationSpeed : 400,
             singleItem:true,
             loop:true, 
             items : 1,
             nav:true,
             navText : ["<i class='icon-left_arrow'></i>","<i class='icon-right_arrow'></i>"]

             // "singleItem:true" is a shortcut for:
             // itemsDesktop : false,
             // itemsDesktopSmall : false,
             // itemsTablet: false,
             // itemsMobile : false

         });
         $("#owl-demo_2").owlCarousel({

            navigation : true, // Show next and prev buttons
            slideSpeed : 300,
            paginationSpeed : 400,
            stagePadding: 0,
            singleItem:true,
            dots:false,
            rewind:true,
            loop:true, 
            margin:10,
            nav:true,
            navText : ["<i class='icon-left_arrow color_amarillo'></i>","<i class='icon-right_arrow color_amarillo'></i>"],
            responsive : {
            0 : {
                autoWidth:false,
                items : 1
            },
            1040 : {
                items : 1,
                autoWidth:false
                // mergeFit:false

            },
            1700 : {
                items : 2,
                margin:200,
                mergeFit:false
            },
            1900 : {
                items : 2,
                margin:200,
                mergeFit:false
            }    
            }
        });

        $("#owl-demo_3").owlCarousel({

        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        dots:false,
        rewind:true,
        loop:true,
        autoWidth:true,
        margin:10,
        items : 1,
        nav:true,
        navText : ["<i class='icon-left_arrow color_amarillo'></i>","<i class='icon-right_arrow color_amarillo'></i>"]

        });
}); 