// $(document).ready(function() {
var pageWrap = document.getElementById('pagewrap'),
    pages = [].slice.call(pageWrap.querySelectorAll('div.load')),
    currentPage = 0,
    loader = new SVGLoader(document.getElementById('loader'), {
        speedIn: 400,
        easingIn: mina.easeinout
    });

function init() {
    loader.show();
    // after some time hide loader
    setTimeout(function() {
        loader.hide();

        classie.removeClass(pages[currentPage], 'show');
        // update..
        currentPage = currentPage ? 0 : 1;
        $(window).load(function() {
            classie.addClass(pages[currentPage], 'show');
        });

    }, 2000);
}

init();
// });
