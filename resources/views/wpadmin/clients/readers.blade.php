@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Подписчики</h1> <hr style="margin: 10px 0;" />

    {{-- === Панель управления === --}}
    <div class="readers_controls">
        {{-- добавить нового --}}
        <div class="col-md-3">
            <form class="form-inline" action="{{route('wpadmin.clients.store')}}" method="post" >
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Телефон" />
                </div>
                <button type="submit" name="addClient" class="btn btn-primary" title="Добавить">Добавить</button>
            </form>
        </div>
        {{-- поиск --}}
        <div class="col-md-3">
            {{--<form class="form-inline" action="{{route('wpadmin.clients.store')}}" method="post" >--}}
                {{--{{ csrf_field() }}--}}
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Поиск ..." />
                </div>
            {{--</form>--}}
        </div>
        {{-- фильтр --}}
        <div class="col-md-6">
            <b style="display: block;">Фильтр:</b>
            <label class="checkbox-inline"><input type="checkbox" class="readers_filter" id="new_client" value="new_client" checked> Новые</label>
            <label class="checkbox-inline"><input type="checkbox" class="readers_filter" id="inactive" value="inactive" checked> Заблокированные</label>
            <label class="checkbox-inline"><input type="checkbox" class="readers_filter" id="active" value="active" checked> Активные</label>
        </div>
        <div style="clear: both;"></div>
    </div>
    <hr style="margin: 10px 0;" />


    @if(isset($params) && $params->err_store)
        <div style="padding:10px;background-color:#ec7063;color:white;">
            {{$params->err_store}}
        </div>
    @endif

    @php
        $status_activity = ['new_client'=>'Новый клиент','active'=>'Активен','inactive'=>'Заблокирован'];
        $status_activity_style = ['new_client'=>'','active'=>'background-color:#52BE80;color:#ffffff;','inactive'=>'background-color:#CD6155;color:#fff;'];
    @endphp

    {{-- === Вывод подписчиков === --}}
    <table class="table table-striped">
        <thead>
            <th>Дата рег-ции</th>
            <th>Телефон</th>
            <th>ФИО</th>
            {{--<th>Фамилия</th>--}}
            {{--<th>Имя</th>--}}
            {{--<th>Отчество</th>--}}
            <th>Email</th>
            <th>Компания</th>
            <th>Оплата</th>
            <th>Период оплаты</th>
            <th>Статус</th>
            <th class="text-right"></th>
        </thead>
        <tbody>
        @forelse($clients as $client)
            <tr id="reader_{{ $client->id }}" class="reader reader_status_activity_{{ $client->status_activity }}"
            style="{{ $status_activity_style[$client->status_activity] }}" >
                <td> {{ date_format($client->created_at, "d.m.Y H:i:s") }} </td>
                <td> {{ $client->phone }} </td>
                <td> {{ $client->f_name.' '.$client->i_name.' '.$client->o_name }} </td>
                {{--<td> {{ $client->f_name }} </td>--}}
                {{--<td> {{ $client->i_name }} </td>--}}
                {{--<td> {{ $client->o_name }} </td>--}}
                <td> {{ $client->email }} </td>
                <td> {{ $client->company }} </td>
                <td> @if($client->status_pay == 'notpaid') Не оплачено @else Оплачено @endif </td>
                <td> {{ $client->range_pay }} </td>
                <td> {{ $status_activity[$client->status_activity] }} </td>
                <td>
                    <div style="width: 50px;">
                        <div id="{{ $client->id }}" class="wpadmin_btn_readers wpadmin_btn_edit_reader">
                            <img style="width:100%;" src="{{asset('images/assets/btn_edit.png')}}" />
                        </div>
                        <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" style="display: inline-block;"
                              action="{{route('wpadmin.clients.destroy', $client)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE" />
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-link wpadmin_btn_readers wpadmin_btn_delete_reader"></button>
                        </form>
                    </div>
                </td>
            </tr>
            {{-- строка для блока редактирования --}}
            {{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
            <tr>
                <td colspan="10" style="padding: 0;">

                    <div id="edit_reader_{{ $client->id }}" class="modal_edit_reader" style="display: none;">
                        <p class="modal_edit_reader_title">Редактирование</p>

                        <form class="form-inline" action="{{route('wpadmin.clients.update', $client)}}" method="post" enctype="multipart/form-data" >
                            <input type="hidden" name="_method" value="PUT" />
                            <input type="hidden" name="id" value="{{$client->id}}" />
                            {{ csrf_field() }}

                            <div class="modal_edit_reader_item_form">
                                <label>Телефон</label>
                                <input type="text" class="form-control" name="phone" value="{{$client->phone}}" style="width: 100%;" />
                            </div>
                            <div class="modal_edit_reader_item_form">
                                <label>Фамилия</label>
                                <input type="text" class="form-control" name="f_name" value="{{$client->f_name}}" style="width: 100%;" />
                            </div>
                            <div class="modal_edit_reader_item_form">
                                <label>Имя</label>
                                <input type="text" class="form-control" name="i_name" value="{{$client->i_name}}" style="width: 100%;" />
                            </div>
                            <div class="modal_edit_reader_item_form">
                                <label>Отчество</label>
                                <input type="text" class="form-control" name="o_name" value="{{$client->o_name}}" style="width: 100%;" />
                            </div>
                            <div class="modal_edit_reader_item_form">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="{{$client->email}}" style="width: 100%;" />
                            </div>
                            <div class="modal_edit_reader_item_form">
                                <label>Компания</label>
                                <input type="text" class="form-control" name="company" value="{{$client->company}}" style="width: 100%;" />
                            </div>
                            <div class="modal_edit_reader_item_form">
                                <label>Оплата</label>
                                <select class="form-control" name="status_pay" style="width: 100%;">
                                    <option value="notpaid" @if($client->status_pay == 'notpaid') selected @endif >Не оплачено</option>
                                    <option value="paid" @if($client->status_pay == 'paid') selected @endif >Оплачено</option>
                                </select>
                            </div>
                            <div class="modal_edit_reader_item_form">
                                <label>Период</label>
                                <input type="text" class="form-control datepicker" name="range_pay" value="{{$client->range_pay}}" style="width: 100%;" />
                            </div>
                            <div class="modal_edit_reader_item_form">
                                <label>Статус</label>
                                <select class="form-control" name="status_activity" style="width: 100%;">
                                    <option value="new_client" @if($client->status_activity == 'new_client') selected @endif >Новый клиент</option>
                                    <option value="active" @if($client->status_activity == 'active') selected @endif >Активен</option>
                                    <option value="inactive" @if($client->status_activity == 'inactive') selected @endif >Заблокирован</option>
                                </select>
                            </div>
                            <br/><br/>
                            <div>
                                <button type="submit" class="btn btn-success btn-sm">Сохранить</button>
                                <button id="{{ $client->id }}" class="btn btn-danger btn-sm btn_close_edit_reader">Отмена</button>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>


            {{--<tr id="edit_reader_{{ $client->id }}" class="edit_reader" style="display: none;">--}}
                {{--<td colspan="10">--}}
                    {{--<form class="form-inline" action="{{route('wpadmin.clients.update', $client)}}" method="post" enctype="multipart/form-data" >--}}
                        {{--<input type="hidden" name="_method" value="PUT" />--}}
                        {{--<input type="hidden" name="id" value="{{$client->id}}" />--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="col-md-1 readers_col-md">--}}
                            {{--<label>Телефон</label>--}}
                            {{--<input type="text" class="form-control" name="phone" value="{{$client->phone}}" style="width: 100%;" />--}}
                        {{--</div>--}}
                        {{--<div class="col-md-1 readers_col-md">--}}
                            {{--<label>Фамилия</label>--}}
                            {{--<input type="text" class="form-control" name="f_name" value="{{$client->f_name}}" style="width: 100%;" />--}}
                        {{--</div>--}}
                        {{--<div class="col-md-1 readers_col-md">--}}
                            {{--<label>Имя</label>--}}
                            {{--<input type="text" class="form-control" name="i_name" value="{{$client->i_name}}" style="width: 100%;" />--}}
                        {{--</div>--}}
                        {{--<div class="col-md-1 readers_col-md">--}}
                            {{--<label>Отчество</label>--}}
                            {{--<input type="text" class="form-control" name="o_name" value="{{$client->o_name}}" style="width: 100%;" />--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2 readers_col-md">--}}
                            {{--<label>Email</label>--}}
                            {{--<input type="text" class="form-control" name="email" value="{{$client->email}}" style="width: 100%;" />--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2 readers_col-md">--}}
                            {{--<label>Компания</label>--}}
                            {{--<input type="text" class="form-control" name="company" value="{{$client->company}}" style="width: 100%;" />--}}
                        {{--</div>--}}
                        {{--<div class="col-md-1 readers_col-md">--}}
                            {{--<label>Оплата</label>--}}
                            {{--<select class="form-control" name="status_pay" style="width: 100%;">--}}
                                {{--<option value="notpaid" @if($client->status_pay == 'notpaid') selected @endif >Не оплачено</option>--}}
                                {{--<option value="paid" @if($client->status_pay == 'paid') selected @endif >Оплачено</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-1 readers_col-md">--}}
                            {{--<label>Период</label>--}}
                            {{--<input type="text" class="form-control datepicker" name="range_pay" value="{{$client->range_pay}}" style="width: 100%;" />--}}
                        {{--</div>--}}
                        {{--<div class="col-md-1 readers_col-md">--}}
                            {{--<label>Статус</label>--}}
                            {{--<select class="form-control" name="status_activity" style="width: 100%;">--}}
                                {{--<option value="new_client" @if($client->status_activity == 'new_client') selected @endif >Новый клиент</option>--}}
                                {{--<option value="active" @if($client->status_activity == 'active') selected @endif >Активен</option>--}}
                                {{--<option value="inactive" @if($client->status_activity == 'inactive') selected @endif >Заблокирован</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-1 readers_col-md" style="text-align: center;">--}}
                            {{--<button type="submit" class="wpadmin_btn_readers wpadmin_btn_save_reader" title="Сохранить"></button>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</td>--}}
            {{--</tr>--}}
        @empty
            <tr>
                <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection