
// Feather icons init
feather.replace()

// SidenavToggle
$("a#sideNavOpenLink").click(function (e) { 
    e.preventDefault();
    $("div#sidenavMobileCloser").css('display','block');
    $("div#sidenavMobile").css('display','block');
});

$("div#sidenavMobileCloser").click(function (e) { 
    e.preventDefault();
    $(this).css('display','none');
    $("div#sidenavMobile").css('display','none');
});



$("input#showPwdCustomerLogin").click(function (e) { 
    e.preventDefault();
    if($("input#customer-password").attr('type')=='password'){
        $("input#customer-password").attr('type','text');
    }else{
        $("input#customer-password").attr('type','password');
    }
});


$("div#product-gallery-box").owlCarousel({
    nav:false,
    dots: true,
    responsive:{
        0:{
            items:3
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    },
    margin: 10,
    navigationText: ['<','>'],
    loop:false
});



var owlSliderHome = $('#home-hero-slider,#home-hero-slider-mobile');
owlSliderHome.owlCarousel({
    nav:false,
    dots: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    },
    // navigationText: ['<','>'],
    loop:true,
    autoplay:true,
    autoplayTimeout:3500,
    autoplayHoverPause:true
});

$("div#home-category-slider-mobile").owlCarousel({
    nav:true,
    responsive:{
        0:{
            items:5
        },
        600:{
            items:5
        },
        1000:{
            items:5
        }
    },
    margin: 5,
    loop:false
});

$("div#daily-deals-carousel,div#related-products").owlCarousel({
    dots:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    },
    autoplay:true,
    autoplayTimeout:3500,
    autoplayHoverPause:true,
    margin: 10,
    loop:true,
});