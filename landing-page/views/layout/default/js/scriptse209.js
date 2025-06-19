;(function () {
    jQuery(document).ready(function($){
        "use strict"; // use strict to start

        /*-----------
        Date picker
        -----------*/
        $('#datepicker').datetimepicker({
        //  inline: true,
            format: 'DD/MM/YYYY'
        });

        /*-----------
        timepicker
        -----------*/
        $('#timepicker').datetimepicker({
        //  inline: true,
            format: 'hh:mm A'
        });




        /*-----------
        DEfault slider
        -----------*/
        $(".banner-slider").owlCarousel({
              animateOut: 'slideOutDown',
              animateIn: 'flipInX',
              navigation : true, // Show next and prev buttons
              navigationText:	["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
              slideSpeed : 2000,
              pagination: false,
              paginationSpeed : 2000,
              singleItem:true,
              autoPlay:true,
             // transitionStyle : "fade",
              
        });

         /*-----------
        background slider
        -----------*/
        $(".background-slider").owlCarousel({
              navigation : true, // Show next and prev buttons
              navigationText:	["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
              slideSpeed : 1000,
              pagination: false,
              paginationSpeed : 1000,
              singleItem:true,
              autoPlay:true
        });

        /*-----------
        Banner title-slider
        -----------*/
        $(".title-slider").owlCarousel({
              navigation : true, // Show next and prev buttons
              navigationText:	["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
              slideSpeed : 1000,
              pagination: false,
              paginationSpeed : 1000,
              singleItem:true,
              autoPlay:true,
              transitionStyle : "fade"
        });


        /*-----------
        dish-carousel, .review-carousel
        -----------*/
        $(".dish-carousel, .review-carousel").owlCarousel({
              navigation : true, // Show next and prev buttons
              navigationText:	["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
              slideSpeed : 300,
              pagination: false,
              paginationSpeed : 400,
              singleItem:true,
              autoPlay:false,
              transitionStyle : "backSlide"
          });
        
        /*-----------
        sidebar widget slider carousel
        -----------*/
           $(".widget-slider").owlCarousel({
              navigation : true, // Show next and prev buttons
              navigationText:	["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
              slideSpeed : 300,
              pagination: false,
              singleItem:true,
              transitionStyle : "backSlide"
          });
        
        /*-----------
        related post slider carousel
        -----------*/
        $(".related-post-slide").owlCarousel({
            navigation : true, // Show next and prev buttons
            navigationText:	["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
            slideSpeed : 300,
            pagination: false,
            items: 3, 
            //              singleItem:true,
            transitionStyle : "backSlide"
          });

        /*-----------
        client logo slider carousel
        -----------*/
        $(".client-list").owlCarousel({
            navigation : false, // Show next and prev buttons
            navigationText:	["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
            slideSpeed : 300,
            pagination: false,
            items: 5,
            autoplay:true,
            // singleItem:true,
            transitionStyle : "backSlide"
        });


        /*-----------
            Fixednav scroll 
            -----------*/
        jQuery(window).on('scroll',function () { 
            var vheight=$(window).height();
            var winwidth=$(window).width();
            if ($(window).scrollTop() > 0) {
                $('.navbar-fixed-top').addClass('sticky');
            }
            else{
                $('.navbar-fixed-top').removeClass('sticky');
            }
        });


        /*-------- 
            Magnify Popup
            ---------*/
        if(jQuery('.popup-link').length){
            jQuery('.popup-link').magnificPopup({
                type: 'image',
                gallery:{
                    enabled:true
                }
            }); 
        }
            if(jQuery('.iframe-popup-link').length){
            jQuery('.iframe-popup-link').magnificPopup({
                type: 'iframe',
                gallery:{
                    enabled:true
                }
            }); 
        }
        

        /*-------
        navbar search /Site search
        -----------*/

        $( ".btn-search" ).on('click',function(e) {
            e.preventDefault();
            $( "html" ).addClass( "search-open" );
            $( ".site-search" ).addClass( "open" );
        });
        $( ".search-close" ).on('click',function(e) {
            e.preventDefault();
            $( "html" ).removeClass( "search-open" );
            $( ".site-search" ).removeClass( "open" );
        });

        /*-------
        Mobile dropdown script
        -----------*/
        $(function(){
            $('.dropdown-menu > .dropdown > a').on("click",function(e){
                e.preventDefault();
                var current=$(this).next();
                var grandparent=$(this).parent().parent();
                grandparent.find(".dropdown-menu:visible").not(current).hide();
                current.toggle();
                e.stopPropagation();
            });
        });

        /*********** 
         parallex pge banner]
        ************/
       
        $(window).enllax();

        /*-------
        Shuffle Grid gallery 
        -----------*/

        $(window).on('load',function(){
            /* initialize shuffle plugin */
            var $grid = $('#grid');
            $grid.shuffle({
                itemSelector: '.grid-item' // the selector for the items in the grid
            });
            /* reshuffle when user clicks a filter item */
            $('#filter a').on('click',function (e) {
                e.preventDefault();
                // set active class
                $('#filter a').removeClass('active');
                $(this).addClass('active');
                // get group name from clicked item
                var groupName = $(this).attr('data-group');
                // reshuffle grid
                $grid.shuffle('shuffle', groupName );
            });
        });

    
        /*--------
        Video background js
        -----------*/
        if($('.video-background').length){
            $('.video-background').videobackground({
                videoSource: [['assets/media/vid01.mp4', 'video/mp4'],
                    ['assets/media/vid01.webm', 'video/webm'], 
                    ['assets/media/vid01.ogv', 'video/ogg']], 
                controlPosition: '#main',
                loop: true,
//					poster: 'assets/media/vid.jpg',
                loadedCallback: function() {
                    $(this).videobackground('mute');
                }
            });
        }      
    });
})(jQuery);



	
	
	