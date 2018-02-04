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

<label for="">Наименование</label>
<input type="text" class="form-control" name="name_ru" placeholder="Заголовок рубрики" value="{{$rubrik->name_ru or ""}}"  />
<input type="text" class="form-control" name="name_en" placeholder="name_en" value="{{$rubrik->name_en or ""}}"  />
<select class="form-control" name="parent_id">
    <option value="0">-- без родительской рубрики --</option>
    @include('wpadmin.rubriks.partials.rubriks', ['rubriks' => $rubriks])
</select>

<hr />

<input class="btn btn-primary" type="submit" value="Сохранить" />