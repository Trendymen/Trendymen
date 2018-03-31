var div = document.getElementsByClassName("slide")[0];
var ul = document.getElementsByClassName("index")[0],dom;
var width = div.children[0].offsetWidth;
var num = div.children.length - 1;
var index = 0;
var timer;

var doing = true;

(function () {
    //index初始化
    for (var i = 0; i < num; i++) {
        ul.appendChild(document.createElement("li"));
    }
    ul.children[0].classList.add("active");
    //index注册事件
    ul.addEvent("click", function (e) {
        if (e.target.tagName === "LI") {
            var index = Array.prototype.indexOf.call(ul.children, e.target);
            autoMove(index);
        }
    });
}());

(function () {
    dom = document.getElementsByClassName("btn")[0];
    //btn按钮事件
    dom.addEvent("click", function (e) {
        if (e.target.tagName === "SPAN") {
            var one = Array.prototype.indexOf.call(e.target.parentNode.children, e.target) ? 1 : -1;
            autoMove(index + one);
        }
    });
}());

(function () {
    dom = document.getElementsByClassName("slideContainer")[0];
    //移入暂停 移出继续自动轮播
    dom.addEvent("mouseenter", function (e) {
        console.log("enter");
        clearInterval(timer);
        e.stopPropagation();
    });
    dom.addEvent("mouseleave", function (e) {
        console.log("out");
        timer = setInterval(autoMove, 2000);
        e.stopPropagation();
    });
}());


function autoMove(thisIndex) {
    if (doing) {
        doing = false;
        index = typeof thisIndex === "number" ? thisIndex : index + 1;
        if (index < 0) {
            div.style.left = -num * width + "px";
            index = num - 1;
        }
        changeIndex(index === num ? 0 : index);
        move(div, {left: -index * width}, function () {
            if (index === num) {
                div.style.left = 0;
                index = 0;
            }
            doing = true;
        });
    }

}

function changeIndex(index) {
    ul.getElementsByClassName("active")[0].classList.remove("active");
    ul.children[index].classList.add("active");
}

timer = setInterval(autoMove, 2000);

//第二轮播方案  承袭自渡一
// function autoMove(thisIndex) {
//     if (doing) {
//         doing = false;
//         if (thisIndex === 1 || !thisIndex) {
//             index++;
//             index = index === num ? 0 : index;
//             changeIndex(index);
//             move(div, {left: div.offsetLeft - width}, function () {
//                 if (index == 0) {
//                     div.style.left = 0;
//                 }
//                 doing = true;
//             })
//         } else if (thisIndex === -1) {
//             if (index === 0) {
//                 div.style.left = -num * width + "px";
//                 index = num;
//             }
//             index--;
//             changeIndex(index);
//             move(div, {left: -index * width}, function () {
//                 doing = true;
//             })
//         }
//     }
// }