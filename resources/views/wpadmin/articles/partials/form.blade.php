<label for="">Статас</label>
<select class="form-control">

        <option value="0">Не опубликовано</option>
        <option value="1">Oпубликовано</option>

</select>

<label for="">Заголовок</label>
<input type="text" class="form-control" name="name_ru" placeholder="Заголовок рубрики" value="{{$article->name_ru or ""}}"  />

<label for="">name_en</label>
<input type="text" class="form-control" name="name_en" placeholder="name_en" value="{{$article->name_en or ""}}"  />

<label for="">Род катег</label>
<select class="form-control" name="rubriks[]" multiple="">
    @include('wpadmin.articles.partials.rubriks', ['rubriks' => $rubriks])
</select>

<hr />

<input class="btn btn-primary" type="submit" value="Сохранить" />