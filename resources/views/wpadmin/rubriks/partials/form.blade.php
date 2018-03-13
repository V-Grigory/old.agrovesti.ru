    {{--
    <label for="">Статас</label>
    <select class="form-control">
        @if(isset($rubrik->id))
            <option value="0" @if($rubrik->order == 0) selected=""> @endif Не опубликовано</option>
            <option value="1" @if($rubrik->order > 0) selected=""> @endif Oпубликовано</option>
        @else
            <option value="0">Не опубликовано</option>
            <option value="1">Oпубликовано</option>
        @endif
    </select>
    --}}

    <div class="form-group">
        <p style="margin:0 0 8px 0;color:#666666;"><b>Название рубрики</b></p>
        <input type="text" class="form-control" name="name_ru" value="{{$rubrik->name_ru or ""}}"  />
    </div>

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
