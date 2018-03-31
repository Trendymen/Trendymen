/**
 * Created by l2266803 on 2018/1/3 0003.
 */
function displayCitation() {
    "use strict";
    if (!document.getElementsByTagName || !document.createElement || !document.createTextNode) {
        return false;
    }
    //判断浏览器DOM可通用性
    var citation = document.getElementsByTagName("blockquote");
    //取得所有引用
    for (var i = 0; i < citation.length; i++) {  //遍历引用
        if (!citation[i].getAttribute("cite")) {
            continue;  //如果没有cite属性，继续循环。
        }
        var url = citation[i].getAttribute("cite");
        //保存cite属性
        var allelement = citation[i].getElementsByTagName("*");
        //取得引用中所有元素节点
        var lastElementChild = allelement[allelement.length - 1];
        //取得引用中的最后一个元素节点
        var link = document.createElement("a");
        link.setAttribute("href", url);
        var linkText = document.createTextNode("[" + (i + 1) + "]");
        link.appendChild(linkText);
        var sup = document.createElement("sup");
        sup.appendChild(link);
        lastElementChild.appendChild(sup);
    }
}
addLoadEvent(displayCitation);