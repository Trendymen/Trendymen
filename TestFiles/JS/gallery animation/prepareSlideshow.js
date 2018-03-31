/**
 * Created by lz199 on 2018/1/5 0005.
 */

var ul = document.getElementsByTagName("ul")[0];
var slide=document.getElementById("slide");



function prepareSlideshow(a) {
    var divname = "slide";
    var ul = document.getElementsByTagName("ul")[0];
    var j = 0;
    for (var i = 0; i < ul.children.length; i++) {
        var li = ul.children[i];
        j++;
        if (a === li) {
            window.movediv(divname, -(j * 300), 0, 10);
            return true;
        }
    }
    return false;
}


function automove() {

    if (!window.getComputedStyle(slide, null).left) {
        slide.style.left = "0px";
    }
    var x = parseInt(window.getComputedStyle(slide, null).left);
    var tox = null;
    window.console.log(x);
    if (x === (-900)) {
        tox = 0;
    }
    else {
        tox = x - 300;
    }
    window.movediv("slide", tox, 0, 1000 / 60, true);
}


// window.addLoadEvent(automoveevent);
window.addLoadEvent(function () {
    var li = document.getElementsByTagName("ul")[0].children;
    Array.prototype.forEach.call(li, function (ele, index) {
        ele.addEvent("mouseover", function () {
                prepareSlideshow(ele);
        });
    });

});
