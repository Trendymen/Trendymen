/**
 * Created by l2266803 on 2018/1/3 0003.
 */

window.onload = function () {
    var testdiv = document.getElementById("testdiv");
    var para = document.createElement("p");
    var text = document.createTextNode("Hello Wrold");
    para.appendChild(text);
    testdiv.appendChild(para);
};


