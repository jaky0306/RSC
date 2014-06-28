
<?php
    include_once 'base.php' ;
    include_once 'header.php';

    session_start();
    if(isset($_GET['exit'])){
        unset($_SESSION['username']);
    }
    if(!empty($_SESSION['username'])){
        header("Location:main.php");
    }

?>
		<hr>
		

		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="hero-unit">
						<h3>首页</h3>
						<p style="text-indent:2em" class="text-center">
							注册登录后进行问答，查询。
						</p>
						<p class="text-center">
							<br>
							<a class="btn btn-success btn-large" href="login.php">点击进行</a>
						</p>
					</div>
				</div>
			</div>
		</div>

    <?php
        include_once 'footer.php' ;
    ?>