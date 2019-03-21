﻿<!DOCTYPE html>
<html>

<?php include 'css.php';?>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>NP TIRE</b></a>
            <small>GOLD WHEEL</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="login.php">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'js.php';?>
</body>

</html>