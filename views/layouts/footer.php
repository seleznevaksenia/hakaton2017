

<footer id="footer" class="page-footer"><!--Footer-->
    <div class="container">
        <p class="pull-left">Copyright © 2017</p>
    </div>
</footer><!--/Footer-->

<script type="text/javascript" src="/template/js/moment.js"></script>
<script type="text/javascript" src="/template/js/bootstrap-datetimepicker.min.js"></script>

<script>
    $(document).ready(function () {
        $("#new").click();
        $('#datetimepicker1').datetimepicker({
        	format: 'YYYY-MM-DD kk:mm:ss'
        });
        $('select').material_select();
    });
</script>

</body>
</html>