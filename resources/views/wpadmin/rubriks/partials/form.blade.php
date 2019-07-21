
    <!-- ====== НАЗВАНИЕ РУБРИКИ ====== -->
    <div class="form-group">
        <p style="margin:0 0 8px 0;color:#666666;"><b>Название рубрики</b></p>
        <input type="text" class="form-control" name="name_ru" value="{{$rubrik->name_ru or ""}}"  />
    </div>

    <!-- ====== РОДИТЕЛЬСКАЯ РУБРИКА ====== -->
    <div class="form-group">
        <p style="margin:0 0 8px 0;color:#666666;"><b>Родительская рубрика</b></p>
        <select class="form-control" name="parent_id">

            <option value="0">-- без родительской рубрики --</option>
            {{-- @include('wpadmin.rubriks.partials.rubriks', ['rubriks' => $rubriks]) --}}
            @foreach($rubriks as $rubrik_list)

                <option @if($rubrik && $rubrik->parent_id == $rubrik_list->id) selected="selected" @endif value="{{$rubrik_list->id or ""}}">

                    {!! $delimiter or "" !!}{{$rubrik_list->name_ru or ""}}

                </option>

            @endforeach
        </select>
    </div>

    <!-- ====== ПОЗИЦИЯ В РУБРИКАТОРЕ ====== -->
    <br><br>
    <div class="form-group">
        <p style="margin:0 0 8px 0;color:#666666;"><b>Позиция в рубрикаторе</b></p>
        <input type="text" class="form-control" name="order" value="{{$rubrik->order or "0"}}" />
    </div>

    <!-- ====== НА ГЛАВНОЙ ====== -->
    <div class="form-group">
        <p style="margin:0 10px 8px 0;color:#666666;"><b>На главной</b></p>
        <select class="form-control" name="on_main">
            <option value="0" @if($rubrik && $rubrik->on_main == 0) selected="selected" @endif >Нет</option>
            <option value="1" @if($rubrik && $rubrik->on_main == 1) selected="selected" @endif >Да</option>
        </select>
    </div>

    <!-- ====== ПОЗИЦИЯ ШАБЛОНА ====== -->
    <div class="form-group">
        <p style="margin:0 0 8px 0;color:#666666;"><b>Позиция на главной (порядковый №)</b></p>
        <input type="text" class="form-control" name="position_number" value="{{$rubrik->position_number or "0"}}"  />
    </div>

    <!-- ====== ВЕРСИЯ САЙТА ДЛЯ ВЫВОДА ====== -->
    <br><br>
    <div class="form-group">
        <p style="margin:0 10px 8px 0;color:#666666;"><b>Версия сайта для вывода</b></p>
        <select class="form-control" name="target">
            <option value="old_site" @if($rubrik && $rubrik->target == 'old_site') selected="selected" @endif >Старый</option>
            <option value="new_site" @if($rubrik && $rubrik->target == 'new_site') selected="selected" @endif >Новый</option>
        </select>
    </div>

    <!-- ====== ШАБЛОН ====== -->
    <br><br>
    <div class="form-group">
        <p style="margin:0 0 8px 0;color:#666666;"><b>№ шаблона</b></p>

        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="1" id="template_number_1"
                   @if($rubrik)
                        @if($rubrik->template_number == 1) checked @endif
                   @else
                        checked
                   @endif >
            <label for="template_number_1">№ 1</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_1.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="2" id="template_number_2"
                    @if($rubrik && $rubrik->template_number == 2) checked @endif >
            <label for="template_number_2">№ 2</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_2.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="3" id="template_number_3"
                   @if($rubrik && $rubrik->template_number == 3) checked @endif >
            <label for="template_number_3">№ 3</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_3.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="4" id="template_number_4"
                   @if($rubrik && $rubrik->template_number == 4) checked @endif >
            <label for="template_number_4">№ 4</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_4.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="5" id="template_number_5"
                   @if($rubrik && $rubrik->template_number == 5) checked @endif >
            <label for="template_number_5">№ 5</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_5.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="6" id="template_number_6"
                   @if($rubrik && $rubrik->template_number == 6) checked @endif >
            <label for="template_number_6">№ 6</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_6.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="7" id="template_number_7"
                   @if($rubrik && $rubrik->template_number == 7) checked @endif >
            <label for="template_number_7">№ 7</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_7.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="8" id="template_number_8"
                   @if($rubrik && $rubrik->template_number == 8) checked @endif >
            <label for="template_number_8">№ 8</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_8.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="9" id="template_number_9"
                   @if($rubrik && $rubrik->template_number == 9) checked @endif >
            <label for="template_number_9">№ 9</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_9.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="10" id="template_number_10"
                   @if($rubrik && $rubrik->template_number == 10) checked @endif >
            <label for="template_number_10">№ 10</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_10.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="11" id="template_number_11"
                   @if($rubrik && $rubrik->template_number == 11) checked @endif >
            <label for="template_number_11">№ 11</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_11.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="12" id="template_number_12"
                   @if($rubrik && $rubrik->template_number == 12) checked @endif >
            <label for="template_number_12">№ 12</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_12.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="template_number" value="13" id="template_number_13"
                   @if($rubrik && $rubrik->template_number == 13) checked @endif >
            <label for="template_number_13">№ 13</label>
            <img style="width:190px;" src="/images/assets/preview_template_number_13.png">
        </div>
    </div>

    <!-- ====== ИКОНКА РУБРИКИ ====== -->
    <br><br>
    <div class="form-group">
        <p style="margin:0 0 8px 0;color:#666666;"><b>Иконка рубрики</b></p>

        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="icon_number" value="1" id="icon_number_1"
                   @if($rubrik)
                        @if($rubrik->icon_number == 1) checked @endif
                   @else
                        checked
                   @endif >
            <label for="icon_number_1">№ 1</label>
            <img src="/images/assets/icon_rubrik_1.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="icon_number" value="2" id="icon_number_2"
                   @if($rubrik && $rubrik->icon_number == 2) checked @endif >
            <label for="icon_number_2">№ 2</label>
            <img src="/images/assets/icon_rubrik_2.png">
        </div>
        <div style="display: inline-block;margin: 3px;">
            <input type="radio" name="icon_number" value="3" id="icon_number_3"
                   @if($rubrik && $rubrik->icon_number == 3) checked @endif >
            <label for="icon_number_3">№ 3</label>
            <img src="/images/assets/icon_rubrik_3.png">
        </div>
    </div>

    <!-- ====== ОПЦИИ ====== -->
    <br><br>
    <div class="form-group">
        <p style="margin:0 0 8px 0;color:#666666;"><b>Опции</b></p>

        <label class="checkbox-inline">
          <input type="hidden" name="params[show_in_main_menu]" value="0" />
          <input type="checkbox" name="params[show_in_main_menu]" value="1"
            @if(
            isset($rubrik->params['show_in_main_menu']) && $rubrik->params['show_in_main_menu'] == 1
            ) checked @endif
          >Выводить в главном меню (сверху)
        </label>
        <br />
        <label class="checkbox-inline">
            <input type="hidden" name="params[show_in_footer_menu]" value="0" />
            <input type="checkbox" name="params[show_in_footer_menu]" value="1"
               @if(
               isset($rubrik->params['show_in_footer_menu']) && $rubrik->params['show_in_footer_menu'] == 1
               ) checked @endif
            >Выводить в нижнем меню
        </label>
    </div>

    <!-- ====== КНОПКА ====== -->
    <br>
    <div class="form-group">
        <!-- $fillable в модели требует передачи этого поля -->
        <input type="hidden" class="form-control" name="name_en" value="" />
        <p style="margin:0 0 8px 0;">&nbsp;</p>
        @if($rubrik)
            <button type="submit" class="btn btn-primary">Сохранить рубрику</button>
        @else
            <button type="submit" class="btn btn-primary">Добавить рубрику</button>
        @endif
    </div>
