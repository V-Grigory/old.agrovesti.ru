<div class="container">

    <h1>Ваша история</h1>
    <br>
    <p class="single_page_p">Расскажите свою историю журналу "Аграрная Политика".</p>
    <p class="single_page_p">Поделитесь опытом. Обозначьте острые и волнующие темы, выразите свое мнение.</p>
    <p class="single_page_p">О чем бы вы хотели прочитать? Попросите нас написать об этом.</p>

    <p class="single_page_p" style="margin-top: 20px;"><b>Мы будем рады вашему обращению.</b></p>

    <br><br>
    <form method="POST" action="{{ Request::url() }}">
        {{ csrf_field() }}

        <div class="form-group">
            <p style="margin:0 0 8px 0;color:#666666;font-size:16px;"><b>Как вас зовут</b></p>
            <input type="text" class="form-control" name="vasha_istoriya_fio" value="" />
        </div>

        <div class="form-group">
            <p style="margin:0 0 8px 0;color:#666666;font-size:16px;"><b>Ваш телефон или Эл. Почта</b></p>
            <input type="text" class="form-control" name="vasha_istoriya_phone" value="" />
        </div>

        <div class="form-group">
            <p style="margin:0 0 8px 0;color:#666666;font-size:16px;"><b>Ваше предприятие. Ваша должность.</b></p>
            <textarea class="form-control" name="vasha_istoriya_company"></textarea>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">ОТПРАВИТЬ</button>
        </div>

    </form>

</div>