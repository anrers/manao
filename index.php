<?php require 'header.php';
?>   
<?php if (!$_SESSION['auth']): ?>
        <div class="regist"> 
            <h4>Регистрация:</h4>
            <div id="result_form"></div> 
            <form class="inner" method="post" action="" id="ajax_form">
                <div>Логин<Br>
                    <input class="input" type="text" name="login">
                </div>
                <div>Пароль<Br>
                    <input class="input" type="password" name="password"> 
                </div>
                <div>Подтвердите пароль<Br>
                    <input class="input" type="password" name="confirm_password"> <Br>
                </div>
                <div>Email<Br>
                    <input class="input" type="text" name="email"> <Br>
                </div>
                <div> Ваше имя<Br>  
                    <input class="input" type="text" name="name"> <Br>
                </div>
                <input class="input" type="submit" id="btn" name="submit" value="Отправить" />
            </form>
        </div>
    <br>
    <div class="regist">
        <h4>Авторизация:</h4>
        <form class="inner" method="post" action="" id="auth_form">
            <div>Логин<Br>
                <input class="input" type="text" name="login">
            </div>
            <div>Пароль<Br>
                <input class="input" type="password" name="password"> 
            </div>
            <input class="input" type="submit" id="btn1" name="submit" value="Отправить" />
        </form>
    <br>
    <div id="result_auth"></div> 
    </div> 
    <?php 
    else:?>
    <div class="hello"><h1>Hello, <?php echo $_SESSION['name'];?></h1></div>
    <?php endif;?>
    </body>
</html>
