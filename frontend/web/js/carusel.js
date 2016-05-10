var caroufredsel = function () {
    jQuery('#enigma_portfolio_section').carouFredSel({
        width: '100%',
        responsive: true,
        scroll : {
            items : 1,
            duration : 1000,
            timeoutDuration : 1000			},
        circular: true,
        direction: 'left',
        items: {
            height: 'variable',
            visible: {
                min: 1,
                max: 4				}
        },
        prev: '#port-prev',
        next: '#port-next',
        auto: {
            play: false
        }
    });

    jQuery('#enigma_blog_section').carouFredSel({
        width: '100%',
        responsive: true,
        scroll : {
            items : 1,
            duration : 2000,
            timeoutDuration : 2000						},
        circular: true,
        direction: 'left',
        items: {
            height: 'variable',
            visible: {
                min: 1,
                max: 4,
            },
        },
        prev: '#port-prev1',
        next: '#port-next1',
        auto: {
            play: true
        }
    });

    jQuery('#enigma_testimonial_section').carouFredSel({
        width: '100%',
        responsive: true,
        scroll : {
            items : 1,
            duration : 2000,
            timeoutDuration : 2000						},
        circular: true,
        direction: 'left',
        items: {
            height: 'variable',
            visible: {
                min: 1,
                max: 1							}
        },
        pagination: "#pager2",
        auto: {
            play: true						}
    });

    // jQuery CarouFredSel  For Client
    jQuery('#enigma_client_section').carouFredSel({
        width: '100%',
        height: 'variable',
        responsive: true,
        scroll :1,
        circular: true,
        direction: 'left',
        items: {
            height: 'variable',
            visible: {
                min: 1,
                max:4							}
        },
        scroll: {
            duration : 2000,
            timeoutDuration : 2000,
        },
        prev: '#client-prev',
        next: '#client-next',
        auto: {
            play: true						}
    });
}
jQuery(window).resize(function () { caroufredsel(); });
jQuery(window).load(function () { caroufredsel(); });