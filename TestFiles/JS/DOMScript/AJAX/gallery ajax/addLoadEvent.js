/**
 * Created by l2266803 on 2018/1/3 0003.
 */
function addLoadEvent(func) {
    var oldLoadFunc = window.onload;
    if (typeof oldLoadFunc != "function") {
        window.onload = func;
    }
    else {
        window.onload = function () {
            oldLoadFunc();
            func();
        };
    }
}