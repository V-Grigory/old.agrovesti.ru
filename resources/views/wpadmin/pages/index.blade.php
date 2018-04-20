@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Список страниц из Тильды</h1>

    <hr />
    <table class="table table-striped">
        <thead>
            <th>Название</th><th>Дата создания</th><th>Дата обновления</th><th class="text-right">Действие</th>
        </thead>
        <tbody>
        @forelse($pages as $page)
            <tr>
                <td>
                    {{$page->name_ru}}
                </td>
                <td>
                    {{$page->created_at}}
                </td>
                <td>
                    {{$page->updated_at}}
                </td>
                <td class="text-right" style="padding: 0;">
                    -
                    {{--<form onsubmit="if(confirm('Удалить?')){ return true } else { return false }"--}}
                          {{--action="{{route('wpadmin.banners.destroy', $banner)}}" method="post">--}}
                        {{--<input type="hidden" name="_method" value="DELETE" />--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<button type="submit" class="btn btn-link">Удалить</button>--}}
                    {{--</form>--}}
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