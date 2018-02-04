@extends('wpadmin.layouts.wpadmin')

@section('content')

    <div class="container">

        @component('wpadmin.components.breadcrumb')
            @slot('title') Список категория @endslot
            @slot('parent') Главная @endslot
            @slot('active') Категории @endslot
        @endcomponent

        <hr />

        <a href="{{route('wpadmin')}}" class="btn btn-primary pull-right"><i class="fafa-plus-square-o"></i> Создать категорию</a>

        <table class="table table-striped">
            <thead>
                <th>Наименование</th>
                <th>Публикация</th>
                <th class="text-right">Действие</th>
            </thead>
            <tbody>
                @forelse($rubriks as $rubrik)
                    <tr>
                        <td>{{$rubrik->name_ru}}</td>
                        <td>{{$rubrik->name_en}}</td>
                        <td class="text-right">
                            <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }"
                                  action="{{route('admin.rubrik.destroy', $rubrik)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}

                                <a class="btn btn-default" href="{{route('admin.rubrik.edit', $rubrik)}}" ><i class="fafa-edit">11</i></a>
                                <button type="submit" class="btn"><i class="fa fa-trash-o">22</i></button>
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
                            <?php //{{$rubriks->links}} ?>
                        </ul>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>

@endsection