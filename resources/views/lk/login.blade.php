
<div class="container">
    <div class="row">
        <br>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ Request::url() }}">
                    {{--<form class="form-horizontal" method="POST" action="{{route('profile')}}">--}}
                        {{ csrf_field() }}

                        <div class="form-group">

                            <label for="email" class="col-md-4 control-label">Ваш телефон</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="" autofocus >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Войти
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>