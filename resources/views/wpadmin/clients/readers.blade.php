@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Подписчики</h1> <hr />

    @if(isset($params) && $params->err_store)
        <div style="padding:10px;background-color:#ec7063;color:white;">
            {{$params->err_store}}
        </div>
    @endif


    {{-- === Вывод подписчиков === --}}
    <table class="table table-striped">
        <thead>
            <th>Телефон</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Email</th>
            <th>Компания</th>
            <th>Оплата</th>
            <th>Период оплаты</th>
            <th>Статус</th>
            <th class="text-right"></th>
        </thead>
        <tbody>
        @forelse($clients as $client)
            <tr id="reader_{{ $client->id }}" class="reader">
                <td style="padding:5px;"> {{ $client->phone }} </td>
                <td> {{ $client->f_name }} </td>
                <td> {{ $client->i_name }} </td>
                <td> {{ $client->o_name }} </td>
                <td> {{ $client->email }} </td>
                <td> {{ $client->company }} </td>
                <td> @if($client->status_pay == 'notpaid') Не оплачено @else Оплачено @endif </td>
                <td> {{ $client->range_pay }} мес.</td>
                <td> @if($client->status_activity == 'active') Активен @else Заблокирован @endif </td>
                <td>
                    <div id="{{ $client->id }}" class="wpadmin_btn_edit_reader"><img style="width:100%;" src="{{asset('images/assets/btn_edit.png')}}" /></div>
                </td>
            </tr>
            {{-- строка для редактирования --}}
            <tr id="edit_reader_{{ $client->id }}" class="edit_reader" style="display: none;">
                <td colspan="10">
                    <form class="form-inline" action="{{route('wpadmin.clients.update', $client)}}" method="post" enctype="multipart/form-data" >
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="id" value="{{$client->id}}" />
                        {{ csrf_field() }}

                        <div class="col-md-1 readers_col-md">
                            <label>Телефон</label>
                            <input type="text" class="form-control" name="phone" value="{{$client->phone}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Фамилия</label>
                            <input type="text" class="form-control" name="f_name" value="{{$client->f_name}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Имя</label>
                            <input type="text" class="form-control" name="i_name" value="{{$client->i_name}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Отчество</label>
                            <input type="text" class="form-control" name="o_name" value="{{$client->o_name}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-2 readers_col-md">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{$client->email}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-2 readers_col-md">
                            <label>Компания</label>
                            <input type="text" class="form-control" name="company" value="{{$client->company}}" style="width: 100%;" />
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Оплата</label>
                            <select class="form-control" name="status_pay" style="width: 100%;">
                                <option value="notpaid">Не оплачено</option>
                                <option value="paid">Оплачено</option>
                            </select>
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Период</label>
                            <select class="form-control" name="range_pay" style="width: 100%;">
                                <option value="1">1 мес.</option>
                                <option value="2">2 мес.</option>
                                <option value="3">3 мес.</option>
                                <option value="4">4 мес.</option>
                                <option value="5">5 мес.</option>
                                <option value="6">6 мес.</option>
                            </select>
                        </div>
                        <div class="col-md-1 readers_col-md">
                            <label>Статус</label>
                            <select class="form-control" name="status_activity" style="width: 100%;">
                                <option value="active">Активен</option>
                                <option value="inactive">Заблокирован</option>
                            </select>
                        </div>
                        <div class="col-md-1 readers_col-md" style="text-align: center;">
                            <button type="submit" class="wpadmin_btn_save_reader" title="Сохранить"></button>
                        </div>
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