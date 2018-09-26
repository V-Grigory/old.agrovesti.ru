$(document).ready(function() {

    // федеральные округа с регионами
    FO = {
        'Не_выбрано': {
            'name':'Не_выбрано',
            'regions': ['Не_выбрано']
        },
        'Центральный': {
            'name':'Центральный',
            'regions': ['Белгородский','Брянский','Владимирский','Воронежский','Ивановский','Калужский','Костромской','Курский','Липецкий','Московский',
                'Орловский','Рязанский','Смоленский','Тамбовский','Тверской','Тульский','Ярославский','г. Москва']
        },
        'Северо-Западный': {
            'name':'Северо-Западный',
            'regions': ['р.Карелия','р.Коми','Архангельский','Ненецкий АО','Вологодский','Калининградский','Ленинградский','Мурманский',
                'Новгородский','Псковский','г.Санкт-Петербург']
        },
        'Южный': {
            'name':'Южный',
            'regions': ['р.Адыгея','р.Дагестан','р.Ингушетия','Кабардино-Балкарская р.','р.Калмыкия','Карачаево-Черкесская р.','р.Северная Осетия-Алания',
                'Чеченская р.','Краснодарский край','Ставропольский край','Астраханский','Волгоградский','Ростовский']
        },
        'Приволжский': {
            'name':'Приволжский',
            'regions': ['р.Башкортостан','р.Марий Эл','р.Мордовия','р.Татарстан','Удмуртская р.','Чувашская р.','Кировский','Нижегородский','Оренбургский',
                'Пензенский','Пермский','Коми-Пермяцкий АО','Самарский','Саратовский','Ульяновский']
        },
        'Уральский': {
            'name':'Уральский',
            'regions': ['Курганский','Свердловский','Тюменский','Ханты-Мансийский АО','Ямало-Ненецкий АО','Челябинский']
        },
        'Сибирский': {
            'name':'Сибирский',
            'regions': ['р.Алтай','р.Бурятия','р.Тыва','р.Хакасия','Алтайский край','Красноярский край','Таймырский АО','Эвенкийский АО','Иркутский',
                'Усть-Ордынский АО','Кемеровский','Новосибирский','Омский','Томский','Читинский','Агинский Бурятский АО']
        },
        'Дальневосточный': {
            'name':'Дальневосточный',
            'regions': ['р.Саха (Якутия)','Приморский край','Хабаровский край','Амурский','Камчатский','Корякский АО','Магаданский','Сахалинский',
                'Еврейская АО','Чукотский АО']
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
        count_selected_rows();
    });
    // выделение - селекты
    $(".readers_select_by_select").change(function(){
        $('.reader_'+$(this).val()).not('.reader_hided_filter').children().children().prop('checked', true);
        count_selected_rows();
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
            $("#modal_container_content").html(
                "<textarea rows='4' style='width: 100%;' name='text_sms' placeholder='Введите текст СМС'></textarea>" +
                "<p style='margin:0;'>Кол-во символов: <b id='text_sms_length'>0</b>  (макс. 480)</p>" +
                "<p style='margin:0;'>Кол-во СМС-ок в сообщении: <b id='text_sms_count'>1</b></p>" +
                "<p style='margin:0;'>Стоимость сообщения для <b>1</b> клиента: <b id='text_sms_worth_for_one_client'>0</b> р.</p>" +
                "<p style='margin:0;'>Стоимость сообщения для <b>всех выделенных</b> (а их <b>"+$("#count_checked_readers").text()+"</b>) " +
                "клиентов: <b id='text_sms_worth_for_all_clients'>0</b> р.</p>"
            );
            // подсчет кол-ва символов, расчет смс
            $('body').on('input propertychange', 'textarea[name=text_sms]', function () {
                // длинна сообщения
                text_sms_length = $(this).val().length;
                $("#text_sms_length").text(text_sms_length);
                // кол-во смс в сообщении
                text_sms_count = Math.ceil(text_sms_length / 67);
                $("#text_sms_count").text(text_sms_count);
                // стоимость сообщения
                text_sms_worth_for_one_client = text_sms_count * 2.20;
                text_sms_worth_for_one_client = text_sms_worth_for_one_client.toPrecision(3);
                $("#text_sms_worth_for_one_client").text(text_sms_worth_for_one_client);
                // стоимость сообщения для всех выделенных клиентов
                text_sms_worth_for_all_clients = text_sms_worth_for_one_client * parseInt($("#count_checked_readers").text());
                $("#text_sms_worth_for_all_clients").text(text_sms_worth_for_all_clients.toPrecision(3));
            });
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
      count_selected_rows(); //setTimeout(count_selected_rows, 1000);
    });

    // клик по чекбоксу (выделение / снятие)
    $('.reader_checkbox').change(function() {
        count_selected_rows();
    });
    
    // функция подсчета кол-ва выделенных клиентов
    function count_selected_rows() {
        count_checked_readers = $('.reader_checkbox:checkbox:checked').length;;
        $("#count_checked_readers").text(count_checked_readers);
    }

});