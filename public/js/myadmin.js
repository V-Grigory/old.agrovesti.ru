$(document).ready(function() {

    // клик для редактирования клиента
    // $(".wpadmin_btn_edit_reader").click(function () {
    //
    //     $('.reader').css("display","table-row");
    //     $(".edit_reader").css("display","none");
    //
    //     $('#reader_'+$(this).attr('id')).css("display","none");
    //     $('#edit_reader_'+$(this).attr('id')).css("display","table-row");
    //     // console.log( $(this).attr('id') );
    //
    // });

    // показ блока для редактирования
    $(".wpadmin_btn_edit_reader").click(function () {
        $('#edit_reader_'+$(this).attr('id')).css("display","block");
    });
    $(".btn_close_edit_reader").click(function (e) {
        e.preventDefault();
        $('#edit_reader_'+$(this).attr('id')).css("display","none");
    });

    // календарь
    $( ".datepicker" ).datepicker({
        format: 'dd.mm.yyyy',
        autoclose:true,
        language: 'ru'
    });

    // == ПАНЕЛЬ УПРАВЛЕНИЯ ==
    // фильтр
    $(".readers_filter").click(function () {
        // после клика стал checked
        if ($(this).is(':checked')) {
            //$('.reader_status_activity_'+$(this).val()).css("display","table-row");
            //$('.reader_status_activity_'+$(this).val()).next().css("display","table-row"); // с блоком для редактирования
            $('.reader_status_activity_'+$(this).val()).removeClass("reader_hide reader_hided_filter");
        } else {
            //$('.reader_status_activity_'+$(this).val()).css("display","none");
            //$('.reader_status_activity_'+$(this).val()).next().css("display","none"); // с блоком для редактирования
            $('.reader_status_activity_'+$(this).val()).addClass("reader_hide reader_hided_filter");
        }
    });
    // поиск
    $('input[name="search"]').on('input', function () {
        dataEntered = $(this).val();
        // цикл по реадерам, исключая скрытых фильтром
        $("tr.reader").not('.reader_hided_filter').each(function (e) {
            var $td = $(this).find('td');
            searched = false;
            // цикл столбцам текущей строки
            $td.each(function(index) {
                dataTD = $(this).text().trim().toLowerCase();
                if( dataTD.indexOf(dataEntered) != -1) searched = true;
            });
            if(!searched) $td.parent().addClass("reader_hide"); else $td.parent().removeClass("reader_hide");
        });
    });


    // $('.form-inline').on('submit', function (e) {
    //
    //     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    //
    //     e.preventDefault();
    //     console.log('111111111');
    //     var title = $('#title').val();
    //     var body = $('#body').val();
    //     var published_at = $('#published_at').val();
    //     var phone = 'новое тел';
    //     var id = '11';
    //     $.ajax({
    //         type: "PUT",
    //         url: '/wpadmin/clients/'+id,
    //         data: {_token: CSRF_TOKEN, title: title, body: body, published_at: published_at, phone: phone, id: id},
    //         success: function( msg ) {
    //             console.log(msg);
    //             //$("#ajaxResponse").append("<div>"+msg+"</div>");
    //         }
    //     });
    // });


});