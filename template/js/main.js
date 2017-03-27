$(document).ready(function () {
    function bottomFooter() {
        if ($('section').height() + $('#header').height() < $(window).height()) {
            $('.page-footer').css("position", "absolute");
        }
        else $('.page-footer').css("position", "relative");
    }
    bottomFooter();
    $(window).resize(bottomFooter);

});
