$(document).ready(function() {

    $(".wpadmin_btn_edit_reader").click(function () {

        $('.reader').css("display","table-row");
        $(".edit_reader").css("display","none");

        $('#reader_'+$(this).attr('id')).css("display","none");
        $('#edit_reader_'+$(this).attr('id')).css("display","table-row");
        // console.log( $(this).attr('id') );

    });

});