@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Баннеры</h1> <hr />

    @if(isset($params) && $params->err_store)
        <div style="padding:10px;background-color:#ec7063;color:white;">
            {{$params->err_store}}
        </div>
    @endif

    <!-- === СОЗДАТЬ БАННЕР === -->
    @if($banner)
        <form action="{{route('wpadmin.banners.update', $banner)}}" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="_method" value="PUT" />
            @else
                <form action="{{route('wpadmin.banners.store', $banner)}}" method="post" enctype="multipart/form-data" >
                    @endif
                    {{ csrf_field() }}

                    <div class="form-group" style="width: 50%;">
                        <p style="margin:0 0 8px 0;color:#666666;"><b>Название баннера (всплывает при наведении на баннер мыши)</b></p>
                        <input type="text" class="form-control" name="name" value="{{$banner->name or ""}}"  />
                    </div>

                    <div class="form-group" style="width: 50%;">
                        <p style="margin:0 0 8px 0;color:#666666;"><b>Позиция баннера (рубрика)</b></p>
                        <select class="form-control" name="position">
                            @foreach($rubriks as $rubrik)
                                <option value="{{$rubrik->name_en}}">{{$rubrik->name_ru}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="width: 50%;">
                        <p style="margin:0 0 8px 0;color:#666666;"><b>Куда ведет баннер (ссылка)</b></p>
                        <input type="text" class="form-control" name="link" value="{{$banner->link or ""}}"  />
                    </div>

                    <div class="form-group">
                        <p style="margin:0 0 8px 0;color:#666666;"><b>Сам баннер (файл с изображением), 300 x 600 пикс.</b></p>
                        <input type="file" name="image" value=""/>
                    </div>

                    <div class="form-group">
                        @if($banner)
                            <input type="hidden" class="form-control" name="id" value="{{$banner->id}}" />
                            <button type="submit" class="btn btn-primary">Сохранить баннер</button>
                        @else
                            <button type="submit" class="btn btn-primary">Добавить баннер</button>
                        @endif
                    </div>

                </form>

                <!-- === ВЫВОД БАННЕРОВ === -->
                <hr />
                <table class="table table-striped">
                    <thead>
                    <th>Название</th><th>Позиция</th><th>Ссылка</th><th class="text-right">Действие</th>
                    </thead>
                    <tbody>
                    @forelse($banners as $banner)
                        <tr>
                            <td style="padding: 0;">
                                <form action="{{route('wpadmin.banners.edit', $banner)}}" method="get">
                                    <input type="hidden" name="_method" value="EDIT" />
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-link">{{$banner->name}}</button>
                                </form>
                            </td>
                            <td>
                                @foreach($rubriks as $rubrik)
                                    @if($rubrik->name_en == $banner->position)
                                        {{$rubrik->name_ru}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                {{$banner->link}}
                            </td>
                            <td class="text-right" style="padding: 0;">
                                <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }"
                                      action="{{route('wpadmin.banners.destroy', $banner)}}" method="post">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-link">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

@endsection