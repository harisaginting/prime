</main>
    </div>
  </body>


<script type="text/javascript">
    $(".Jselect2").select2();
    $('.date-picker').datepicker({
        format: "mm/dd/yyyy",
        disableTouchKeyboard : false,
        toggleActive: true,
        forceParse: false,
        autoclose: true
    });

    $(".date-picker").attr("autocomplete","off");
    $(".form-control").attr("autocomplete","off");

    $('.rupiah').priceFormat({
        prefix: 'Rp. ',
        centsSeparator: ',',
        thousandsSeparator: '.',
        centsLimit: 0
    });
    $('.fileinput').fileinput();
</script>


</html>
