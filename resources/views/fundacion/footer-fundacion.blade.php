<script>
    $('.icono_up').click(function () {
        $("html, body").animate({scrollTop: 0}, 1000);
        return false;
    });
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 300) {
            $(".icono_up").fadeIn();
        } else {
            $(".icono_up").fadeOut();
        }
        if ($(window).width() > 991) {
            if ($(this).scrollTop() > 140) {
                $('.menu_lateral_izq ul').addClass('fixed');
            } else {
                $('.menu_lateral_izq ul').removeClass('fixed');
            }
        }

    });
    $(window).resize(function () {
        console.log($(window).scrollTop())
        if ($(window).width() > 991) {
            if ($(window).scrollTop() > 140) {
                $('.menu_lateral_izq ul').addClass('fixed');
            } else {
                $('.menu_lateral_izq ul').removeClass('fixed');
            }
        } else {
            $('.menu_lateral_izq ul').removeClass('fixed');
        }
    });

    if( $(window).width() > 991 ){
        $(function() {
            $('.mouse_over').hover(function() { 
                $('.mouse_over_modal').fadeIn(); 
            }, function() { 
                $('.mouse_over_modal').fadeOut(); 
            });
        });
    }
</script>
