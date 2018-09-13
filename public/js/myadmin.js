$(document).ready(function() {

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
    // массовые действия
    $("#mass_actions_select").change(function(){

        readers_phone = [];
        $(".reader_checkbox:checked").each(function() {
          readers_phone.push($(this).val());
        });
        if( readers_phone.length == 0 ) {
            alert('Не отмечено ни одной записи!');
            $('#mass_actions_select option[value="change_action"]').prop("selected", true);
            return false;
        }

        titles = {send_sms:'Отправить СМС', change_status_activity:'Сменить статус', delete:'Удалить'};

        $('input[name=action]').val( $(this).val() );
        $('input[name=readers_phone]').val( readers_phone.toString() );

        if( $(this).val() == 'send_sms' ) {
            $('#mass_actions_container').css("display","block");
            $('#mass_actions_container .modal_container_title').text( titles[$(this).val()] );
            $("#modal_container_content").html( "<textarea rows='4' style='width: 100%;' name='text_sms' placeholder='Введите текст СМС'></textarea>" );
        }

        if( $(this).val() == 'change_status_activity' ) {
            $('#mass_actions_container').css("display","block");
            $('#mass_actions_container .modal_container_title').text( titles[$(this).val()] );
            $("#modal_container_content").html(
                "<select class='form-control' name='change_status_activity'>" +
                    "<option value='new_client'>Новый клиент</option>" +
                    "<option value='trial_period'>Пробный период</option>" +
                    "<option value='active'>Активен</option>" +
                    "<option value='inactive'>Заблокирован</option>" +
                "</select>"
            );
        }

        if( $(this).val() == 'delete' ) {
            $("#form_mass_actions").submit();
        }

        //if( $(this).val() != 'change_action' ) {
         // console.log( 'Selected value: ' + $(this).val() );
        //}
    });
    $("#btn_close_mass_actions_container").click(function (e) {
        e.preventDefault();
        $('.modal_container').css("display","none");
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