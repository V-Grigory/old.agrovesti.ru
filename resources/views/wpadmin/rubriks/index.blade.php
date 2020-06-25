@extends('wpadmin.layouts.wpadmin')

@section('content')

    {{--
        @component('wpadmin.components.breadcrumb')
            @slot('title') Список категория @endslot
            @slot('parent') Главная @endslot
            @slot('active') Категории @endslot
      @endcomponent
     --}}

        <h1>Рубрики</h1> <hr />

        @if(isset($params) && $params->no_delete)
            <div style="padding:10px;background-color:#ec7063;color:white;">
                {{$params->no_delete}}
            </div>
        @endif
        @if(isset($params) && $params->ok_delete)
            <div style="padding:10px;background-color:#17a589;color:white;">
                {{$params->ok_delete}}
            </div>
        @endif

        <!-- === СОЗДАТЬ РУБРИКУ === -->
        @if($rubrik)
            <form action="{{route('wpadmin.rubrik.update', $rubrik)}}" method="post" class="form-inline" >
            <input type="hidden" name="_method" value="PUT" />
        @else
            <form action="{{route('wpadmin.rubrik.store', $rubrik)}}" method="post" class="form-inline" >
        @endif
            {{ csrf_field() }}
            @include('wpadmin.rubriks.partials.form')
        </form>

        {{-- ЗАГРУЗИТЬ КАРТИНКУ К 8-МУ ШАБЛОНУ --}}
        <div style="margin-top:10px;padding: 10px 0;border-top: 2px solid #c0c0c0;border-bottom: 2px solid #c0c0c0;">
            <p style="font-weight: bold;">Загрузить изображение 8-го шаблона</p>
            <form class="form-inline" action="{{route('wpadmin.rubrik.uploadImageTemplate')}}" method="post" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="file" name="image_template" value="" />
                </div>
                <div class="form-group">
                    <input type="hidden" name="template_number" value="8" />
                    <button type="submit" class="btn btn-info btn-sm">Загрузить</button>
                </div>
            </form>
        </div>
        {{-- ЗАГРУЗИТЬ КАРТИНКУ К 9-МУ ШАБЛОНУ --}}
        {{--<div style="margin-top:10px;padding: 10px 0;border-top: 2px solid #c0c0c0;border-bottom: 2px solid #c0c0c0;">--}}
            {{--<p style="font-weight: bold;">Загрузить изображение 9-го шаблона</p>--}}
            {{--<form class="form-inline" action="{{route('wpadmin.rubrik.uploadImageTemplate')}}" method="post" enctype="multipart/form-data" >--}}
                {{--{{ csrf_field() }}--}}
                {{--<div class="form-group">--}}
                    {{--<input type="file" name="image_template" value="" />--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<input type="hidden" name="template_number" value="9" />--}}
                    {{--<button type="submit" class="btn btn-info btn-sm">Загрузить</button>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}

        <!-- === ВЫВОД РУБРИК === -->
        <hr />
        <table class="table table-striped">
            <thead>
                <th>Наименование</th><th>Позиция в рубрикаторе</th><th>На главной</th><th>Позиция на главной</th>
                <th>Иконка рубрики</th><th>№ шаблона</th><th>Версия сайта</th><th class="text-right">Действие</th>
            </thead>
            <tbody>
                @forelse($rubriks as $rubrik)
                    <tr>
                        <td style="padding: 0;">
                            <form action="{{route('wpadmin.rubrik.edit', $rubrik)}}" method="get">
                                <input type="hidden" name="_method" value="EDIT" />
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-link">{{$rubrik->name_ru}}</button>
                            </form>
                        </td>
                        <td>
                            {{ $rubrik->order }}
                        </td>
                        <td>
                            @if ($rubrik->on_main == 1) <b>Да</b> @else Нет @endif
                        </td>
                        <td>
                            @if ($rubrik->on_main == 1) {{$rubrik->position_number}} @endif
                        </td>
                        <td>
                            <img src="/images/assets/icon_rubrik_{{ $rubrik->icon_number }}.png">
                        </td>
                        <td>
                            @if ($rubrik->on_main == 1) {{$rubrik->template_number}} @endif
                        </td>
                        <td>
                            @if ($rubrik->target == 'old_site') На старом @else <b>На новом</b> @endif
                        </td>
                        <td class="text-right" style="padding: 0;">
                            <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }"
                                  action="{{route('wpadmin.rubrik.destroy', $rubrik)}}" method="post">
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
            <tfoot>
                <tr>
                    <td colspan="3">
                        <ul class="pagination pull-right">
                            {{-- $rubriks->links --}}
                        </ul>
                    </td>
                </tr>
            </tfoot>
        </table>



@endsection
