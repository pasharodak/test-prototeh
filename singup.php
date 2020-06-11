<?php           
                   
                   
                   if(isset($_POST["send"])){
                        $login = $_POST["login"];
                        $password = md5($_POST["password"]);
                        $mysqli = new mysqli("localhost", "root", "","prototeh");
                        $mysqli->query("SET NAMES 'utf8'");
                        $result_set = $mysqli-> query("SELECT * FROM `users` where `login` = '$login' and `password` = '$password';");
                        $result = $result_set->fetch_assoc();
                        $error = "";
                        if($result){
                            setcookie('login',$login,time()+3600,'/');
                            header("Location: /");
                        }else{
                            $error = "Неправильный логин или пароль";
                        }

                        $mysqli->close();
                    }
                    if(isset($_POST["end"])){
                        setcookie('login',"",time()-3600,'/');
                       
                    }
                    if(isset($_POST["signup"])){
                        $error1 = "";
                        $login = $_POST["login"];
                        $name = $_POST["name"];
                        $password = md5($_POST["password"]);
                        $mysqli = new mysqli("localhost", "root", "","prototeh");
                        $mysqli->query("SET NAMES 'utf8'");
                        $result_set = $mysqli-> query("SELECT * FROM `users` where `login` = '$login';");
                        if($result = $result_set->fetch_assoc()){
                            $error1 = "Такой пользователь уже есть";
                        }else{
                            $result_set = $mysqli-> query("INSERT INTO `users` (`login`,`name`,`password`) VALUES ('$login','$name','$password');");
                                setcookie('login',$login,time()+3600,'/');
                                header("Location: /"); 

                        }
                        $mysqli->close();
                       
                    }

        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход/Регистрация</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <?php include("blocks/header.php");    ?>

                        

          
     <div class="container">            
    <?php if(!$_COOKIE["login"]):?>
   
        <form action="" method="post" >
            <h1 class="mt-2">Войти</h1>
            <h2> <?=$error?></h2>
            <input type="text" name="login" class="form-control mt-3 " placeholder="Введите ваш @mail"><span></span>
            <input type="password" name="password" id="phone" class="form-control mt-3" placeholder="Введите пароль"><span></span>
            <input type="submit" name="send" class="btn btn-success mt-3" value="Войти">
        </form>

        <form action="" method="post" >
            <h1 class="mt-2">Регистрация</h1>
            <h2> <?=$error1?></h2>
            <input type="text" name="name"  class="form-control mt-3 " placeholder="Введите ваше имя"><span></span>
            <input type="text" name="login" class="form-control mt-3 " placeholder="Введите ваш @mail"><span></span>
            <input type="password" name="password" id="phone" class="form-control mt-3" placeholder="Введите пароль"><span></span>
            <input type="submit" name="signup" class="btn btn-success mt-3" value="Войти">
        </form>
    <?php elseif($_COOKIE["login"]):?>
        <form action="" method="post" >
            
            <input type="submit" name="end" class="btn btn-success mt-3" value="Выйти">
        </form>
    <?php endif;?>
    <?php         include("blocks/footer.php")?>
    </div>
</body>
</html>