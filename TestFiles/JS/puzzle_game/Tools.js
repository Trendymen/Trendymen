//Element与Document 事件监听兼容性写法
Element.prototype.addEvent = function (event, func) {
    if (Element.prototype.addEventListener) {
        this.addEventListener(event, func, false);
    }
    else if (Element.prototype.attatchEvent) {
        this.attachEvent("on" + event, func);
    } else {
        this.onclick = func;
    }
};

document.addEvent = Element.prototype.addEvent;

//元素拖放
function drag(ele) {
    var x,y;
    ele.addEvent("mousedown", function (e) {
        x = e.pageX - parseInt(getComputedStyle(ele, null).left);
        y = e.pageY - parseInt(getComputedStyle(ele, null).top);
        document.addEvent("mousemove", move);
        document.addEvent("mouseup", release);
    });

    function move(e) {
        ele.style.left = e.pageX - x+ "px";
        ele.style.top = e.pageY - y + "px";
    }

    function release() {
        document.removeEventListener("mousemove", move, false);
    }

}

//getConputedStyle兼容写法
function getStyle(ele, css) {
    if (window.getComputedStyle) {
        return window.getComputedStyle(ele, null)[css];
    } else if (ele.currentStyle) {
        return ele.currentStyle[css];
    } else {
        return ele.style[css];
    }
}

//多物体 多值 链式变动 运动函数
function move(obj, target, callBack) {
    cancelAnimationFrame(obj.timer);
    var targetNum, curState, speed;
    obj.timer = null;
   movein();
    function movein() {
        var done = true;
        for (var attr in target) {
            if (attr === "opacity") { //由于opacity样式区间为0-1，所以需做特殊处理乘以100以整数来完成计算。
                curState = parseFloat(getStyle(obj,"opacity") * 100);
                targetNum = parseFloat(target[attr]) * 100;
            }
            else {
                curState = parseInt(getStyle(obj,attr));
                targetNum = parseInt(target[attr]);
            }
            if (targetNum - curState !== 0) {
                speed = (targetNum - curState) / 8;
                speed = targetNum - curState > 0 ? Math.ceil(speed) : Math.floor(speed);
                if (attr === "opacity") {
                    obj.style[attr] = (curState + speed) / 100;
                }
                else {
                    obj.style[attr] = curState + speed + "px";
                }
                done = false;     //用此判断是否所有样式变换完成，只要有一个未完成，则done为false，下一步if不会执行
            }
        }
        if (done) {
            obj.timer=null;
            typeof callBack === "function" ? callBack() : ""; //判断回调函数是否存在，是则执行。
        }
        else {
            obj.timer = requestAnimationFrame(movein);
        }
    }

}

//弹性运动
function elasticMove(obj,target) {
    console.log(target);
    cancelAnimationFrame(obj.timer);
    var v=target-obj.offsetLeft>0?15:-15;
    var u=0.7;
    var a;
    function move() {
        a=(target-obj.offsetLeft)/8;
        v=(v+a)*u;
        console.log(v);
            if(!(Math.abs(obj.offsetLeft-target)<=1&&Math.abs(v)<=1)){
                obj.style.left=obj.offsetLeft+v+"px";
                obj.timer=requestAnimationFrame(move);
            }
            else {
                obj.style.left=target+"px";
                console.log("done");
            }

    }
    move();

}


//filter兼容
if (!Array.prototype.filter) {
    Array.prototype.filter = function (fun /* , thisArg*/) {
        "use strict";
        if (this === void 0 || this === null) {
            throw new TypeError();
        }
        var t = Object(this);
        var len = t.length >>> 0;
        if (typeof fun !== "function") {
            throw new TypeError();
        }
        var res = [];
        var thisArg = arguments.length >= 2 ? arguments[1] : void 0;
        for (var i = 0; i < len; i++) {
            if (i in t) {
                var val = t[i];
                // NOTE: Technically this should Object.defineProperty at
                //       the next index, as push can be affected by
                //       properties on Object.prototype and Array.prototype.
                //       But that method's new, and collisions should be
                //       rare, so use the more-compatible alternative.
                if (fun.call(thisArg, val, i, t)) {
                    res.push(val);
                }
            }
        }
        return res;
    };
}

//document.getElementsByTagName兼容写法
(function () {
    if (!document.getElementsByClassName) {
        document.getElementsByClassName = function (className) {
            var arr = document.getElementsByTagName("*");
            return Array.prototype.filter.call(arr, function (value) {
                if (value.className === className) {
                    return value;
                }
            });
        };
    }
}());

// requestAnimationFrame和cancelRequestAnimationFrame兼容写法
(function () {
    window.requestAnimationFrame = (function () {
        return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function (callback) {
                window.setTimeout(callback, 1000 / 60);
            };
    }());
    window.cancelAnimationFrame=(function () {
        return window.cancelAnimationFrame || function () {

        };
    }());
}());

