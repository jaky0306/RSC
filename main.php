<?php

    header("Content-type:text/xml;charset=UTF-8");

    include_once 'base.php';
    include_once 'ConnDB.php';
    include_once '../FirePHPCore/fb.php';

    $loginsuccess = false;
    $ans_grade = 0 ;
    $hasAnsFlag = false ;
    $ans_sql_grade = 0 ;

    session_start();

    if (!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $loginsuccess = true;
        $mysql2 = new ConnDB();
        $result = $mysql2->selectSet("select grade from ask where username = '$username'");
        $fetch = mysql_fetch_array($result);
        $ans_sql_grade = $fetch['grade'] ;
        if($ans_sql_grade>-1){
            $hasAnsFlag = true ;
        }
        $mysql2->close();
    }

    if ($loginsuccess == false) {
        header('Location : login.php');
    }

    if (isset($_POST['ans_submit'])) {
        $hasAnsFlag = true ;
        $ans_arr = array('7', '90', 'xiaoming', 'dahoutian', 'apple');
        $post_arr = array(
            $_POST['first'],
            $_POST['second'],
            $_POST['third'],
            $_POST['four'],
            $_POST['five']
        );



        for($i = 0 ; $i <count($ans_arr);$i++){
            if($ans_arr[$i]==$post_arr[$i]){
                $ans_grade ++ ;
            }
        }
        $mysql = new ConnDB();
        //把分数写进数据库
        $mysql->affectSet("update ask set grade = $ans_grade where username = '$username'") ;
        $result = $mysql->selectSet("select grade from ask where username = '$username'");
        $fetch = mysql_fetch_array($result);
        $ans_sql_grade = $fetch['grade'] ;
        $mysql->close();

    }

?>

    <div class="container">
        <div class="row">
            <div class="offset1 span3" id="logo">
                <div class="row">
                    <div class="offset2 span10">
						<span class="logo_word">
							<h2><a href="index.php" class="a_no_style">作业</a></h2>
						</span>
                    </div>
                </div>
            </div>
            <div class="offset3 span5 " id="menu_tab">
                <ul class="nav nav-pills">
                    <a class="a_no_style">
                        <img src="img/guest.png" id="user">
                        <span id="user_name"><?= $username ?></span>
                    </a>
                    <li><a href="index.php?exit=1">退出</a></li>
                </ul>
            </div>
        </div>
    </div>

    <hr>


    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="hero-unit">
                    <h3>
                        操作页：
                    </h3>

                    <div class="btn-group">
                        <button class="btn " id="ans_question">问答系统 / 学籍查询</button>
<!--                        <button class="btn disabled" id="stu_check">学籍查询</button>-->
                    </div>

                    <div id="ans_question_detail" style="display: none">
                        <?php
                        if($hasAnsFlag){
                            ?>
                            <p class="text-right text-info">
                                你已经在问答题中获得 <strong class="text-success" style="font-size: 25px"><?php echo $ans_sql_grade ?></strong> 分
                            </p>
                        <?php
                        }else{
                        ?>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ; ?>" method="post">
                            <p class="text-center">
                                <span>在歌唱节目《我是歌手》中，一期有多少歌手？</span><br/>
                                <label for="ans_a" style="display: inline">7人 <input type="radio" id="ans_a"
                                                                                     name="first"
                                                                                     value="7"></label>
                                <label for="ans_b" style="display: inline">8人 <input type="radio" id="ans_b"
                                                                                     name="first"
                                                                                     value="8"></label>
                            </p>

                            <p class="text-center">
                                <span>计算49 + 41 = ？</span><br/>
                                <label for="ans_c" style="display: inline">100 <input type="radio" id="ans_c"
                                                                                      name="second"
                                                                                      value="100"></label>

                                <label for="ans_d" style="display: inline">90 <input type="radio" id="ans_d"
                                                                                     name="second"
                                                                                     value="90"></label>
                            </p>

                            <p class="text-center">
                                <span>小明有两个哥哥，请问小米爸爸的第三个儿子叫什么？</span><br/>
                                <label for="ans_e" style="display: inline">小明 <input type="radio" id="ans_e"
                                                                                     name="third"
                                                                                     value="xiaoming"></label>

                                <label for="ans_f" style="display: inline">大明 <input type="radio" id="ans_f"
                                                                                     name="third"
                                                                                     value="daming"></label>
                            </p>

                            <p class="text-center">
                                <span>明天之后天是什么？</span><br/>
                                <label for="ans_g" style="display: inline">后天<input type="radio" id="ans_g" name="four"
                                                                                    value="houtian"></label>

                                <label for="ans_h" style="display: inline">大后天<input type="radio" id="ans_h" name="four"
                                                                                     value="dahoutian"></label>
                            </p>

                            <p class="text-center">
                                <span>苹果的单词是什么？</span><br/>
                                <label for="ans_i" style="display: inline">Apple<input type="radio" id="ans_i"
                                                                                       name="five"
                                                                                       value="apple"></label>

                                <label for="ans_j" style="display: inline">Banana <input type="radio" id="ans_j" name="five" value="banana"></label>
                            </p>

                            <p class="text-right">
                                <input type="submit" class="btn btn-large btn-success" name="ans_submit" value="提交">
                            </p>
                        </form>
                    </div>
                    <?php } ?>
                </div>

                <div id="stu_check_detail" style="margin-top:10px ">
                    <p class="text-info" style="font-size: 12px;margin-bottom: -5px">1）根据学号、姓名、系别进行模糊查询，查询学生信息，分页显示。</p>
                    <p class="text-info" style="font-size: 12px;margin-bottom: -5px">2）输入学号后可以查询学生基本信息，点击【修改】按钮可以修改学生信息。</p>
                    <p class="text-info" style="font-size: 12px;margin-bottom: -5px">3）性别栏中：0代表女性 , 1代表男性</p>
                    <p class="text-info" style="font-size: 12px">4）查询结果后，双击行就可以启动编辑模式,点击提交修改就可</p>
                    <div class="input-prepend input-append">
                        <div class="btn-group">
                            <button id="diff" class="btn dropdown-toggle" data-toggle="dropdown">
                                学号
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="goal">
                                <li><a id="XH">学号</a></li>
                                <li><a id="XM">姓名</a></li>
                                <li><a id="ZY">系别</a></li>
                            </ul>
                        </div>
                        <input type="text" id="search_input" placeholder="支持模糊查询">
                        <div class="btn-group">
                            <button id="search" class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-search"></i>
                                搜索
                            </button>
                        </div>
                    </div>
                    <select id="filter">
                        <option value="all">系别</option>
                        <option value="all">全部(默认)</option>
                        <option value="通信工程">通信工程</option>
                        <option value="计算机">计算机</option>
                    </select>
                    <input type="button" id="submitchange" class="btn btn-success disabled" value="提交修改" style="margin-top: -12px">
                    <input type="button" id="nochange" class="btn btn-warning disabled" value="放弃修改并刷新页面" style="margin-top: -12px">
                    <table class="table table-striped table-hover" id="table_view" style="font-size: 14px">
                        <tr>
                            <td>学号</td>
                            <td>姓名</td>
                            <td>性别</td>
                            <td>出生日期</td>
                            <td>专业</td>
                            <td>学分</td>
                            <td>备注</td>
                            <td></td>
                        </tr>

                    </table>
                    <div class="pagination" id="page" style="font-size: 12px;text-align: center">
                        <ul id="num_page">
                        </ul>
                    </div>
                    <form>
                        <input type="hidden" id="hidden" value="">
                        <p id="hiddentext"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript" src="src/main.php.js"></script>

<?php
    include_once 'footer.php';
?>