<?php 
    if(!isset($_SESSION["id"]) && isset($_COOKIE['remember_me'])) {
        $token = $_COOKIE['remember_me'];
        $userId = UserToken::getUserIdByToken($token);
        if($userId) {
            $_SESSION['id'] = $userId;
        } else {
            setcookie('remember_me', '', time() - 3600, "/");
        }
    } 
    if (isset($_SESSION["id"])) {
        $user = User::findOne($_SESSION);
    }
?>
<div class="top-bar">
    <router-link to="/"  class="navigation-link-logo">
        <div class="logo">
            <img src="../img/logo-mini.jpg" class="logo-img">
            <div class="logo-text">
            <div class="logo-text-first">Допомога</div>
            <div class="logo-text-second">Україні</div>
            </div>
        </div>
    </router-link>
    <div class="navigation">
        <div>
            <a href="../index.php" class="navigation-link">Головна</a>
        </div>
        <div>
            <a href="../view/events.php?page=1" class="navigation-link">Заходи</a>
        </div>
        <div>
            <a href="" class="navigation-link">Новини</a>
        </div>
        <div>       
            <a href="" class="navigation-link">Про нас</a>
        </div>
    </div>
    <div class="login">
        <?if (!isset($_SESSION['id'])): ?> 
            <a href="../view/login_form.php" class="login-link btn">Логін</a>
        <? else: ?>
        <button type="button" class="btn" id="show-btn"> 
            <?= $user['first_name'] . ' ' . $user['last_name'] ?>
        </button>
        <div class="user-block">
            <a href="../view/profile.php" class="user-link">Профіль</a>
            <a href="../users/out.php" class="user-link">Вийти</a>
        </div>
        <? endif; ?>
    </div>       
</div>
<script>
    let showBtn =document.getElementById('show-btn');
    let userBlock =document.querySelector('.user-block')
    showBtn.onclick = function() {
        userBlock.style.display = (userBlock.style.display === 'none' || userBlock.style.display === '') ? 'block' : 'none';
    }
</script>