<div class="container">

    @if( session('email_sended') )
        <div class="div_notification_email_sended">
            <h1 style="font-size:22px;">Спасибо. Ваше обращение отправлено в редакцию.</h1>
            <p>Также вы можете обратиться в редакцию любым способом:</p>
            <p>По телефонам - 8 (3452) 595-206, 595-204, 8-905-858-88-19</p>
            <p>По электронной почте - agrotmn2016@mail.ru</p>
        </div>
    @endif

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