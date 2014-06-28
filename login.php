<?php

    $loginSuccessFlag = false ;

    if(isset($_POST['submit'])){
        session_start();
        $user = $_POST['username'] ;
        $psw = $_POST['password'] ;

        include_once "ConnDB.php" ;

        $mysql = new ConnDB() ;
        $num = $mysql->selectNum("select * from login where username = '$user' and password = '$psw'");
        if($num>0){
            $loginSuccessFlag = true ;
            $_SESSION['username'] = $user ;
        }
    }
?>

<?php
    include_once 'base.php';
    include_once 'header.php';
?>

<hr>


<div class="container">
    <div class="row">
        <div class="span12">
            <div class="hero-unit">
                <h3>邮客登录:</h3>
                <?php
                    if($loginSuccessFlag==false){
                ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form-horizontal">
                    <div class="control-group">
                        <label for="username" class="control-label">用户名：</label>
                        <div class="controls" ><input type="text" id="username" name="username"></div>
                    </div>
                    <div class="control-group">
                        <label for="password" class="control-label">密码：</label>
                        <div class="controls" ><input type="password" id="password" name="password" ></div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" name="submit" class="btn btn-large btn-success" value="登录">
                        </div>
                    </div>
                </form>
                <?php
                    }
                    else{
                ?>
                    <p class="text-center text-success" style="font-size:18px;">登录成功</p>
                    <p class="text-center text-warning">2秒转向首页</p>
                    <script type="text/javascript" >
                        setTimeout(function(){
                            window.location = "main.php" ;
                        },2000);
                    </script>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
    include_once 'footer.php' ;
?>
