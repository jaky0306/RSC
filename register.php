<?php
include_once 'base.php';
include_once 'header.php';
include_once 'ConnDB.php';

$registerSuccessFlag = false;
$registerFailGiveTip = false;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $psw = $_POST['password'];

    $mysql = new ConnDB();
    if ($mysql->selectNum("select * from login where username = '$username'")) {
        $registerSuccessFlag = false;
        $registerFailGiveTip = true ;
    } else {
        $result = $mysql->affectNum("insert into login values ('$username','$psw')");
        if ($result > 0) {
            $registerSuccessFlag = true;
            session_start();
            $_SESSION['username'] = $username;
            $mysql->affectNum("insert into ask values ('$username',-1)");
        } else {
            $registerFailGiveTip = true;
        }
    }

}

?>

<hr>

<div class="container">
    <div class="row">
        <div class="span12">
            <div class="hero-unit">
                <h3>注册:</h3>
                <?php
                if ($registerSuccessFlag) {
                    ?>
                    <p class="text-center text-success">注册成功</p>
                    <p class="text-center text-info">2秒后跳转到操作页</p>
                    <script type="text/javascript">
                        setTimeout(function() {
                            window.location = "main.php";
                        }, 2000);
                    </script>
                <?php
                } else {
                    if ($registerFailGiveTip) {
                        ?>
                        <p class="text-center text-error">注册失败</p>
                    <?php
                    }
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-horizontal">
                        <div class="control-group">
                            <label for="username" class="control-label">用户名：</label>

                            <div class="controls">
                                <input type="text" name="username" id="username" placeholder="以字母开头，4-8个字符">
                                <span class="help-inline" style="font-size:12px">以字母开头，4-10个字符的字母数字</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="password" class="control-label">密码：</label>

                            <div class="controls">
                                <input type="password" name="password" id="password1" placeholder="以字母和数字结合，区分大小写">
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="password" class="control-label">重复密码：</label>

                            <div class="controls"><input type="password" id="password2" placeholder="重复一遍密码"></div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input type="submit" name="submit" class="btn btn-large btn-success" value="注册">
                            </div>
                        </div>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function () {

        // 正则表达式

        var nameReg = /^[a-zA-Z]+\w{3,7}/g;
        var pswReg = /\w{5,10}/g;

    });

</script>

<?php
include_once 'footer.php';
?>
