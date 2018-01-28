@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Список категория @endslot
            @slot('parent') Главная @endslot
            @slot('active') Категории @endslot
        @endcomponent

        <hr>

        <a href="{{route('admin.rubrik.create')}}" class="btn btn-primary pull-right"><i class="fafa-plus-square-o"></i> Создать категорию</a>

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
                        <td>{{$rubrik->name_ru}}</td>
                        <td>
                            <a href="{{route('admin.rubrik.edit', ['id'=>'$rubrik->id'])}}" ></a>
                        </td>
                    </tr>
                @empty()

                @endforelse()
            </tbody>
        </table>

    </div>

@endsection