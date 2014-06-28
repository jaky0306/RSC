$(function(){

    $("#ans_question").toggle(function(){
        $("#stu_check_detail").hide();
        $("#ans_question_detail").show();
    },function(){
        $("#ans_question_detail").hide();
        $("#stu_check_detail").show();
    });

    $("#search").click(function(){
        //查询条件
        var condition = $("#search_input").val();
        var method  ;
        var goal ;
        var dataPost ;

        //判断goal类型
        var con = ['学号','姓名','系别'];
        switch ($.trim($("#diff").text())){
            case con[0] : goal = 'XH' ; break ;
            case con[1] : goal = 'XM' ; break ;
            case con[2] : goal = 'ZY' ; break ;
            default : goal = 'XH' ;
        }

        //判断过滤
        var filter = $("#filter").val();
        if(filter=="all"){
            method = "first" ;
            dataPost = "method=third" + "&" + "condition=" + condition + "&" + "goal=" + goal ;
        }else{
            method = "second" ;
            dataPost = "method=third"+ "&" + "condition=" + condition + "&" + "goal=" + goal + "&" + "filter=" + filter ;
        }

        $("#hidden").val(dataPost); // 隐藏搜索方式

       //查询类别

//        $.ajax({
//            type : 'POST' ,
//            url : 'dao.php',
//            data : encodeURI(dataPost),
//            dataType : 'json' ,
//            success : makeJsonToView
//        });

        //获取数据
        $.post("dao.php",{
            condition : condition,
            method : method ,
            goal : goal ,
            filter : filter
        },makeJsonToView) ;

        return false ;

    });


    $("#goal a").on("click",function(event){
        $("#diff").html($(this).text() + ' <span class="caret"></span>');
    });

    $("#num_page li").live("click",function(){
        var query = $("#hidden").val();

        query += "&page=" + $(this).index();

         $.ajax({
            type : 'POST' ,
            url : 'dao.php',
            data : query ,
            success : makeJsonToViewPage
         });

        return false ;
    });

});

//"a0":{"XH":"081101","XM":"王林","XB":"1","CSSJ":"1990-02-10","ZY":"计算机","ZXF":"50","BZ":null,"ZP":null},
// "a1":{"XH":"081102","XM":"程明","XB":"1","CSSJ":"1991-02-01","ZY":"计算机","ZXF":"50","BZ":null,"ZP":null},

function makeJsonToView(data){
    data = JSON.parse(data);
    var $table = $("#table_view") ;
    $("#table_view tr:gt(0)").remove();

    var length = data.length ;
    var stop = 0 ;
    for(var key in data){
        if(stop == 10 ) break ;
        if(key != "length"){
            var $tr = $("<tr></tr>") ;
            for(var key2 in data[key]){
                var $td = $("<td></td>");
                $td.html(data[key][key2]);
                $tr.append($td);
            }
            $table.append($tr);
        }
        stop ++ ;
    }

    var page = Math.floor(length /10 ) + 1 ;
    var $page = $("#num_page");
    $("#num_page li").remove();
    for(var i=0 ; i<page;i++){
        $page.append($("<li><a>" + (i + 1) +"</a></li>"))
    }
}

function makeJsonToViewPage(data){
    data = JSON.parse(data);
    var $table = $("#table_view") ;
    $("#table_view tr:gt(0)").remove();

    var length = data.length ;
    var stop = 0 ;
    for(var key in data){
        if(stop == 10 ) break ;
        if(key != "length"){
            var $tr = $("<tr></tr>") ;
            for(var key2 in data[key]){
                var $td = $("<td></td>");
                $td.html(data[key][key2]);
                $tr.append($td);
            }
            $table.append($tr);
        }
        stop ++ ;
    }
}

// 行数编辑模式
$(function(){
    var editable = true ;
    var change ;
    var $submitChange = $("#submitchange") ,
        $noChange = $("#nochange") ;

    $noChange.click(function(){
       window.location.reload();
    });

    $("#table_view tr:gt(0)").live("dblclick",function(){

        if(editable){
            $submitChange.removeClass("disabled");
            $noChange.removeClass("disabled");

            change = [] ;
            var index = 0 ;
            editable = false ;
            $this = $(this) ;
            $this.find("td").each(function(index){
                var length = $(this).index();
                change[index++] = $(this).text();
                if(length!=7 && length !== 0){
                    var txt = $(this).text();
                    change[index++] = txt ;
                    $input = $("<input class='change_val' value='" + txt + "'>");
                    $(this).html($input);
                }
            });
        }else{
            alert("你还有修改未保存！");
        }

        change[change.length] = $this.index();
        editable = false ;
    });

    $submitChange.click(function(){

        if($(this).hasClass("disabled")){
            return ;
        }

        var tmp = {} ;
        var indexName = ["XM","XB","CSSJ","ZY","ZXF","BZ"] ;

        var trIndex = change[change.length-1] ;

        $("#table_view tr:eq(" + trIndex + ")").find("input").each(function(index){
            tmp[indexName[index]] = $(this).val();
        });

        tmp["XH"] = change[0] ;
        tmp["ZP"] = "" ;

        $.post("updao.php",tmp,function(data){
            var ifSuccess = parseInt(data) ;
            if(ifSuccess == 1 ){
                editable = true ;
                alert("修改成功");
                $("#table_view tr:eq(" + trIndex + ")").find("input").each(function(index){
                    var val = $(this).val();
                    $(this).parent().html(val) ;
                });
                $submitChange.addClass("disabled");
            }else{
                alert("修改失败");
            }

        });



    });

});