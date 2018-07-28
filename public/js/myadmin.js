$(document).ready(function() {

    // клик для редактирования клиента
    $(".wpadmin_btn_edit_reader").click(function () {

        $('.reader').css("display","table-row");
        $(".edit_reader").css("display","none");

        $('#reader_'+$(this).attr('id')).css("display","none");
        $('#edit_reader_'+$(this).attr('id')).css("display","table-row");
        // console.log( $(this).attr('id') );

    });

    // календарь
    $( ".datepicker" ).datepicker({
        format: 'dd.mm.yyyy',
        autoclose:true,
        language: 'ru'
    });


});