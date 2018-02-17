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

        @if($params->no_delete)
            <div style="padding:10px;background-color:#ec7063;color:white;">
                {{$params->no_delete}}
            </div>
        @endif
        @if($params->ok_delete)
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

        <!-- === ВЫВОД РУБРИК === -->
        <hr />
        <table class="table table-striped">
            <thead>
                <th>Наименование</th><th class="text-right">Действие</th>
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