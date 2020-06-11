<?php if(!$_COOKIE["login"]){
header('Location: /singup.php');
exit;
};
?>
<?php if($_COOKIE["login"]):?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <?php include("blocks/header.php");    ?>



    <div class="container">
        
            <?php  if($_COOKIE['login']):?>
            <h1>Привет, <?= $_COOKIE["login"]?></h1>
            <?php endif?>
            <div class="group-card">
                <?php 
                        $mysqli = new mysqli("localhost", "root", "","prototeh");
                        $mysqli->query("SET NAMES 'utf8'");
                        $count = $mysqli-> query("SELECT COUNT(*) FROM `contacts`;");
                        $row = mysqli_fetch_row($count);
                        $total = $row[0];
                        $login = $_COOKIE['login'];
                        $result_set = $mysqli-> query("SELECT * FROM `contacts`;");


                        $result_set1 = $mysqli-> query("SELECT * FROM `users` WHERE `login` = '$login';");
                        $result1 = $result_set1->fetch_assoc();
                        $favorite = $result1["favorite"];
                        $favoritearr = explode(",",$favorite);
                ?>
                
                <?php for($i = 0; $i<=$total;$i++):?>
                   
                    <?php
                   
 
                        
                        $result = $result_set->fetch_assoc();
                        $id = $result["id"];
                        $FIO = $result["FIO"];
                        $phone = $result["phone"];
                        $added = false;
                        for($j = 0; $j < count($favoritearr); $j++){
                            $item = $favoritearr[$j];
                            if($item == $id){
                                $added = true;
                                }
                        } 

                        if($result):
                             
                        ?>
                   
                        <div class="card mb-4 shadow-sm">
                        <form action="/addFavorite.php" method="POST"> 
                            <div class="card-header"> 
                                <h4 class="my-0 font-weight-normal" name="name"><?= $FIO?></h4>
                            </div>
                            <div   div class="card-body">
                                <ul class="list-unstyled mt-3 mb-4">
                                <h2 name="text"><?=$text?></h2> 
                                <p name="email"><?=$phone ?></p>
                                <h2 name="status"><?=$id?></h2>
                                </ul>
                                <?php if($_COOKIE['login'] && $added == false):?>
                                    <button type="submit" name ="send" class="btn btn-lg btn-block btn-outline-primary" value="<?= $id?>">Добавить в избранные</button>
                                <?php else:?>
                                    <p name="added">Добавлено в избранное</p>
                                    <?php endif;?>
                                </div> 
                        </form>  
                        </div>
                    
                        <?php endif; endfor?>

                <?php     $mysqli->close();?>
        </div>
    </div>


    <?php         include("blocks/footer.php")?>
</body>
</html>

<?php endif;?>
