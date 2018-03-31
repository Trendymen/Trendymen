/**
 * Created by l2266803 on 2017/11/27 0027.
 */
function insertafter(newElement, target) {
    if (target.parentNode.lastChild == target) {
        target.parentNode.appendChild(newElement);
    }
    else {
        target.parentNode.insertBefore(newElement, target.nextSibling);
    }
}

function addLoadEvent(func) {
    var onLoadFunc = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    }
    else {
        window.onload = function () {
            onLoadFunc();
            func();
        };
    }
}

function showpic(li) {
    "use strict";
    var imgSrc = li.getAttribute("href");
    var textContent = li.firstChild.nodeValue?li.firstChild.nodeValue:"";
    var oldImg = document.getElementById("imgShow");
    var oldText = document.getElementById("textShow");
    if (oldImg && oldText) {
        oldText.innerHTML = textContent;
        //modify old p element
        oldImg.setAttribute("src", imgSrc);
        //modify old img element
    }
    else {
        var ul = document.getElementsByTagName("ul")[0];
        var newImg = document.createElement("img");
        newImg.setAttribute("id", "imgShow");
        newImg.setAttribute("src", imgSrc);
        //create new img element
        var newText = document.createElement("p");
        newText.setAttribute("id", "textShow");
        newText.innerHTML = textContent;
        //create new p element
        insertafter(newText, ul);
        //add new img element
        insertafter(newImg, newText);
        //add new p element

    }
    return true;
}

function addOnclick() {
    "use strict";
    if (!document.getElementsByTagName || !document.getElementById) {
        return false;
    }
    var aArr = document.getElementsByTagName("a");
    for (var i = 0; i < aArr.length; i++) {
        aArr[i].onclick = fs(aArr[i]);

    }
}

function fs(a) {
    "use strict";
    return function () {
        return !showpic(a);
    };
}


addLoadEvent(addOnclick);
window.console.log("onload事件函数：\n" + window.onload);