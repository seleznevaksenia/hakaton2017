$(document).ready(function () {
    function bottomFooter() {
        if ($('section').height() + $('#header').height() < $(window).height()) {
            $('.page-footer').css("position", "absolute");
        }
        else $('.page-footer').css("position", "relative");
    }
    bottomFooter();
    $(window).resize(bottomFooter);

    $("#new").click();
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD HH:mm'

    });

    $(":checkbox").change(function(){
        var id = $(this).attr("data-id");
        if(this.checked){
            $.post('/task/updatetask/' + id + '', {complete: 1, id: id}, function (data) {
            });
        }
        else {
            $.post('/task/updatetask/' + id + '', {complete: 0, id: id}, function (data) {
            });
        }
    });
});
