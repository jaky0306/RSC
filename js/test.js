var username = "a1234d56" ;
var psw = "123345" ;

var regName = /^[a-zA-z]+\w{3,7}/ ;
var regPSW= /\w{6,9}/;

console.log(regName.test(username));
console.log(regPSW.test(psw));