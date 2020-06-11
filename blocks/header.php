<div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">Задачи</h5>
            <?php if($_COOKIE["login"] == ""):?>
               <a class="btn btn-outline-primary" href="/singup.php">Войти</a> 
            <?php
            else:
            ?>
            <a class="btn btn-outline-primary" href="/favorite.php">Избранные</a> 
            <a class="btn btn-outline-primary" href="/php/out.php">Выйти</a> 
            <?php endif;?>
            
        </div>
</div>
<script src="../js/header.js"></script>