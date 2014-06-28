/**
 * Created by Administrator on 14-4-10.
 * 用于验证注册和登录表单的信息验证
 */

// 正则表达式
var reg = {} ;
reg.name = /^[a-zA-Z]+\w{5,9}$/gi;
reg.psw = /\d{6,10}/g;




