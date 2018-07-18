@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Подписчики</h1> <hr />

    @if(isset($params) && $params->err_store)
        <div style="padding:10px;background-color:#ec7063;color:white;">
            {{$params->err_store}}
        </div>
    @endif

    <!-- === Добавить / править подписчика === -->
    @if($client)
        <form action="{{route('wpadmin.clients.update', $client)}}" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="_method" value="PUT" />
            @else
                <form action="{{route('wpadmin.clients.store', $client)}}" method="post" enctype="multipart/form-data" >
                    @endif
                    {{ csrf_field() }}



                </form>

                <!-- === Вывод подписчиков === -->
                <hr />
                <table class="table table-striped">
                    <thead>
                        <th>Телефон</th>
                        <th>ФИО</th>
                        <th>Email</th>
                        <th>Компания</th>
                        <th>Оплата</th>
                        <th>Период оплаты</th>
                        <th>Статус</th>
                        <th class="text-right">Действие</th>
                    </thead>
                    <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td style="padding: 0;">

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>

                            </td>
                            <td class="text-right" style="padding: 0;">
                                <form action="{{route('wpadmin.clients.edit', $client)}}" method="get">
                                    <input type="hidden" name="_method" value="EDIT" />
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-link">Изменить</button>
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