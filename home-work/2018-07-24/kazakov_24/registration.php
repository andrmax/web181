<!-- тут помещал блоки в другие блоки и писал классы-->

<div class="regis">
    <h2>Регистрация</h2>
    <form class="form-registration" method="post">
        <div>
            <div class="over_label">
                <div class = "label_log">Логин:</div>
                <div class = "label_pass">Пароль:</div>
            </div>
            <input type="text" class="form-registration__login" name="login">
            <input type="password" class="form-registration__password" name="password">
        </div>
        <div>
            <div class="over_label">
                <div class = "label_name">Имя:</div>
            </div>
            <input type="text" class="form-registration__name" name="firstname">
            <button type="submit" class="form-registration__submit">Register</button>
        </div>
        <input type="hidden" name="event" value="registration">
    </form>
</div>

