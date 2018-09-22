$(document).ready(function() {

    // федеральные округа с регионами
    FO = {
        'Не_выбрано': {
            'name':'Не_выбрано',
            'regions': ['Не_выбрано']
        },
        'Центральный': {
            'name':'Центральный',
            'regions': ['Не_выбрано']
        },
        'Северо-Западный': {
            'name':'Северо-Западный',
            'regions': ['Не_выбрано']
        },
        'Южный': {
            'name':'Южный',
            'regions': ['Не_выбрано']
        },
        'Приволжский': {
            'name':'Приволжский',
            'regions': ['Не_выбрано']
        },
        'Уральский': {
            'name':'Уральский',
            'regions': ['Курганский','Свердловский','Тюменский','Ханты-Мансийский АО','Ямало-Ненецкий АО','Челябинский']
        },
        'Сибирский': {
            'name':'Сибирский',
            'regions': ['Не_выбрано']
        },
        'Дальневосточный': {
            'name':'Дальневосточный',
            'regions': ['Не_выбрано']
        }
    };

    function fill_okrug_and_region(reader_id, only_region ) {
        // заполнение селекта округами
        if( only_region === false) {
          fed_okrug = reader_id.find("select[name='fed_okrug']");
          for (key in FO) {
            fed_okrug.append('<option value="' + key + '">' + FO[key].name + '</option>');
          }
        }
        // заполнение селекта регионами, соответствующими выбранному округу
        region = reader_id.find("select[name='region']");
        region.find('option').remove();
        for (key in FO) {
            if( key == fed_okrug.val() ) {
              for (regions in FO[key].regions) {
                region.append('<option value="' + FO[key].regions[regions] + '">' + FO[key].regions[regions] + '</option>');
              }
            }
        }
    }

    // показ блока для редактирования
    $(".wpadmin_btn_edit_reader").click(function () {
        reader_id = $('#edit_reader_'+$(this).attr('id'));
        reader_id.css("display","block");
        fill_okrug_and_region( reader_id, false );
    });
    $(".btn_close_edit_reader").click(function (e) {
        e.preventDefault();
        $('#edit_reader_'+$(this).attr('id')).css("display","none");
    });

    // перестроить селект регионов при смене округа
    $("select[name='fed_okrug']").change(function(){
        fill_okrug_and_region( reader_id, true );
    });

    // календарь
    function bind_datepicker() {
        $( ".datepicker" ).datepicker({
          format: 'dd.mm.yyyy',
          autoclose:true,
          language: 'ru'
        });
    }

    bind_datepicker();

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
    // фильтр - чекбоксы
    $(".readers_filter").click(function () {
        // после клика стал checked
        if ($(this).is(':checked')) {
          $('.reader_'+$(this).val()).removeClass("reader_hide reader_hided_filter");
        } else {
          $('.reader_'+$(this).val()).addClass("reader_hide reader_hided_filter");
        }
    });
    // фильтр - селекты
    //$("#mass_actions_select").change(function(){
    //});
    // выделение - чекбоксы
    $(".readers_select").click(function () {
        // после клика стал checked
        if ($(this).is(':checked')) {
          $('.reader_'+$(this).val()).not('.reader_hided_filter').children().children().prop('checked', true);
        } else {
          $('.reader_'+$(this).val()).not('.reader_hided_filter').children().children('input').prop('checked', false);
        }
    });
    // выделение - селекты
    $(".readers_select_by_select").change(function(){
        $('.reader_'+$(this).val()).not('.reader_hided_filter').children().children().prop('checked', true);
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

        titles = {send_sms:'Отправить СМС', update:'Обновить', delete:'Удалить'};
        action = $(this).val();

        $('input[name=action]').val( action );
        $('input[name=readers_phone]').val( readers_phone.toString() );

        if( action == 'send_sms' ) {
            $('#mass_actions_container').css("display","block");
            $('#mass_actions_container .modal_container_title').text( titles[$(this).val()] );
            $("#modal_container_content").html( "<textarea rows='4' style='width: 100%;' name='text_sms' placeholder='Введите текст СМС'></textarea>" );
        }

        if( action == 'update' ) {
            $('#mass_actions_container').css("display","block");
            $('#mass_actions_container .modal_container_title').text( titles[$(this).val()] );
            $("#modal_container_content").html(

                "<div style='width: 170px;display: inline-block;'>" +
                    "<label>Оплата</label>" +
                    "<select class='form-control' name='change_status_pay'>" +
                        "<option value='no_change'>НЕ МЕНЯТЬ</option>" +
                        "<option value='notpaid'>Не оплачено</option>" +
                        "<option value='paid'>Оплачено</option>" +
                    "</select>" +
                "</div>" +

                "<div style='width: 170px;display: inline-block;'>" +
                    "<label>Период</label>" +
                    "<input type='text' class='form-control datepicker' name='change_range_pay' value='' style='width: 135px;' />" +
                "</div>" +

                "<div style='width: 170px;display: inline-block;'>" +
                    "<label>Статус</label>" +
                    "<select class='form-control' name='change_status_activity'>" +
                        "<option value='no_change'>НЕ МЕНЯТЬ</option>" +
                        "<option value='new_client'>Новый клиент</option>" +
                        "<option value='trial_period'>Пробный период</option>" +
                        "<option value='active'>Активен</option>" +
                        "<option value='inactive'>Заблокирован</option>" +
                    "</select>" +
                "</div>"
            );
            bind_datepicker();
        }

        if( $(this).val() == 'delete' ) {
            $("#form_mass_actions").submit(function() {
                var c = confirm("Уверены что хотите УДАЛИТЬ выделенные записи?");
                return c;
            });
            $("#form_mass_actions").submit();
        }

    });
    $("#btn_close_mass_actions_container").click(function (e) {
        e.preventDefault();
        $('.modal_container').css("display","none");
    });
    // массовое выделение / снятие выделения
    $('#all_readers_check').change(function() {
      if ($(this).is(':checked')) {
          $(".reader_checkbox").each(function() {
              if( !$(this).parent().parent().hasClass('reader_hided_filter') )
                $(this).prop('checked', true);
          });
      } else {
          $(".reader_checkbox").each(function() {
              $(this).prop('checked', false);
          });
      }
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