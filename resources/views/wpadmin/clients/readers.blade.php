@extends('wpadmin.layouts.wpadmin')

@section('content')

    <h1>Подписчики</h1> <hr style="margin: 10px 0;" />

    {{-- === Панель управления === --}}
    <div class="readers_controls">
        {{-- добавить нового --}}
        <div style="display: inline-block; width: 170px;">
            <form class="form-inline" action="{{route('wpadmin.clients.store')}}" method="post" >
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Телефон" style="width: 110px;" />
                </div>
                <button type="submit" name="addClient" class="btn btn-primary" title="Добавить">+</button>
            </form>
        </div>
        {{-- поиск --}}
        <div style="display: inline-block; width: 150px;">
            <input type="text" name="search" class="form-control" placeholder="Поиск ..." style="width: 120px;" />
        </div>
        {{-- фильтр --}}
        <div style="display: inline-block; width: 260px;">
            <b style="display: block;">Фильтр:</b>
            <label class="checkbox-inline"><input type="checkbox" class="readers_filter" value="new_client" checked> Новые</label>
            <label class="checkbox-inline"><input type="checkbox" class="readers_filter" value="trial_period" checked> Пробный период</label>
            <label class="checkbox-inline"><input type="checkbox" class="readers_filter" value="inactive" checked> Заблокированные</label>
            <label class="checkbox-inline"><input type="checkbox" class="readers_filter" value="active" checked> Активные</label>
        </div>
        {{-- выделить --}}
        <div style="display: inline-block; width: 260px;">
            <b style="display: block;">Выделить:</b>
            <label class="checkbox-inline"><input type="checkbox" class="readers_select" value="new_client" > Новые</label>
            <label class="checkbox-inline"><input type="checkbox" class="readers_select" value="trial_period" > Пробный период</label>
            <label class="checkbox-inline"><input type="checkbox" class="readers_select" value="inactive" > Заблокированные</label>
            <label class="checkbox-inline"><input type="checkbox" class="readers_select" value="active" > Активные</label>
        </div>
        {{-- массовые действия --}}
        <div style="display: inline-block;">
            <b style="display: block;">С выделенными:</b>
            <select id="mass_actions_select" class="form-control" name="mass_actions_select">
                <option value="change_action">Выберите действие</option>
                <option value="send_sms">Отправить СМС</option>
                <option value="update">Изменить</option>
                <option value="delete">Удалить</option>
            </select>
            {{-- контейнер для масс действий --}}
            <div id="mass_actions_container" class="modal_container" style="display: none;">
                <p class="modal_container_title"></p>
                <form id="form_mass_actions" class="form-inline" action="{{route('wpadmin.clients.massActions')}}" method="post" enctype="multipart/form-data" >
                    <input type="hidden" name="action" value="" />
                    <input type="hidden" name="readers_phone" value="" />
                    {{ csrf_field() }}
                    <div id="modal_container_content"></div>
                    <br/>
                    <div>
                        <button type="submit" class="btn btn-success btn-sm">Выполнить</button>
                        <button id="btn_close_mass_actions_container" class="btn btn-danger btn-sm">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
    @if( session('mass_action_seccess') !== null ) <div class="flash_mass_action_seccess">{{ session('mass_action_seccess') }}</div> @endif
    <hr style="margin: 10px 0;" />


    @if(isset($params) && $params->err_store)
        <div style="padding:10px;background-color:#ec7063;color:white;">
            {{$params->err_store}}
        </div>
    @endif

    @php
        $status_activity = ['new_client'=>'Новый клиент','trial_period'=>'Пробный период','active'=>'Активен','inactive'=>'Заблокирован'];
        $status_activity_style = ['new_client'=>'','trial_period'=>'background-color:#ff8000;color:#ffffff;',
                                  'active'=>'background-color:#52BE80;color:#ffffff;','inactive'=>'background-color:#CD6155;color:#ffffff;'];
    @endphp

    {{-- === Вывод подписчиков === --}}
    <table class="table table-striped">
        <thead>
            <th><input type="checkbox" id="all_readers_check" value=""></th>
            <th>Дата рег-ции</th>
            <th>Телефон</th>
            <th>ФИО</th>
            <th>Email</th>
            <th>Компания</th>
            <th>Оплата</th>
            <th>Период активности</th>
            <th>Статус</th>
            <th class="text-right"></th>
        </thead>
        <tbody>
        @forelse($clients as $client)
            <tr id="reader_{{ $client->id }}" class="reader reader_status_activity_{{ $client->status_activity }}"
            style="{{ $status_activity_style[$client->status_activity] }}" >
                <td> <input type="checkbox" class="reader_checkbox" value="{{ $client->phone }}"> </td>
                <td> {{ date_format($client->created_at, "d.m.Y H:i:s") }} </td>
                <td> {{ $client->phone }} </td>
                <td> {{ $client->f_name.' '.$client->i_name.' '.$client->o_name }} </td>
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

                    <div id="edit_reader_{{ $client->id }}" class="modal_container" style="display: none;">
                        <p class="modal_container_title">Редактирование</p>

                        <form class="form-inline" action="{{route('wpadmin.clients.update', $client)}}" method="post" enctype="multipart/form-data" >
                            <input type="hidden" name="_method" value="PUT" />
                            <input type="hidden" name="id" value="{{$client->id}}" />
                            {{ csrf_field() }}

                            <div style="width: 150px;display: inline-block;">
                                <label>Телефон</label>
                                <input type="text" class="form-control" name="phone" value="{{$client->phone}}" style="width: 100%;" />
                            </div>
                            <div style="width: 150px;display: inline-block;">
                                <label>Фамилия</label>
                                <input type="text" class="form-control" name="f_name" value="{{$client->f_name}}" style="width: 100%;" />
                            </div>
                            <div style="width: 150px;display: inline-block;">
                                <label>Имя</label>
                                <input type="text" class="form-control" name="i_name" value="{{$client->i_name}}" style="width: 100%;" />
                            </div>
                            <div style="width: 150px;display: inline-block;">
                                <label>Отчество</label>
                                <input type="text" class="form-control" name="o_name" value="{{$client->o_name}}" style="width: 100%;" />
                            </div>
                            <div style="width: 150px;display: inline-block;">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="{{$client->email}}" style="width: 100%;" />
                            </div>
                            <div style="width: 150px;display: inline-block;">
                                <label>Компания</label>
                                <input type="text" class="form-control" name="company" value="{{$client->company}}" style="width: 100%;" />
                            </div>
                            <div style="width: 150px;display: inline-block;">
                                <label>Оплата</label>
                                <select class="form-control" name="status_pay" style="width: 100%;">
                                    <option value="notpaid" @if($client->status_pay == 'notpaid') selected @endif >Не оплачено</option>
                                    <option value="paid" @if($client->status_pay == 'paid') selected @endif >Оплачено</option>
                                </select>
                            </div>
                            <div style="width: 150px;display: inline-block;">
                                <label>Период</label>
                                <input type="text" class="form-control datepicker" name="range_pay" value="{{$client->range_pay}}" style="width: 100%;" />
                            </div>
                            <div style="width: 150px;display: inline-block;">
                                <label>Статус</label>
                                <select class="form-control" name="status_activity" style="width: 100%;">
                                    <option value="new_client" @if($client->status_activity == 'new_client') selected @endif >Новый клиент</option>
                                    <option value="trial_period" @if($client->status_activity == 'trial_period') selected @endif >Пробный период</option>
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
        @empty
            <tr>
                <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection