    /**NAVBAR */
    document.addEventListener("DOMContentLoaded", function() {

        window.addEventListener('scroll', function() {

            if (window.scrollY > 200) {
                document.getElementById('navbar_top').classList.add('fixed-top');
                // add padding top to show content behind navbar
                navbar_height = document.querySelector('.navbar').offsetHeight;
                document.body.style.paddingTop = navbar_height + 'px';
            } else {
                document.getElementById('navbar_top').classList.remove('fixed-top');
                // remove padding top from body
                document.body.style.paddingTop = '0';
            }
        });
    });
    // NAVBAR  end
    $(".owl-carousel").owlCarousel({
        merge: true,
        loop: true,
        margin: 10,
        video: true,
        lazyLoad: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            }
        }

    });