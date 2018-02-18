@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Статьи</h1> <hr />

    <!-- === ВЫВОД СТАТЕЙ ИЗ РУБРИКИ === -->

    <table class="table table-striped">
        <tbody>
            @forelse($list_articles as $article)
                <tr>
                    <td style="padding: 0;">
                        <form action="{{route('wpadmin.article.update', $article->id)}}" method="post">
                            <input type="hidden" name="_method" value="put" />
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-link"
                                style="white-space:normal;text-align:left;line-height: 1.3;" >
                                {{$article->name_ru}}
                            </button>
                        </form>
                    </td>
                    <td class="text-right" style="padding: 0;">
                        <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }"
                            action="{{route('wpadmin.article.destroy', $article)}}" method="post">
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