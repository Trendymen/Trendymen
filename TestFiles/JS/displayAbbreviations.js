/**
 * Created by l2266803 on 2018/1/3 0003.
 */
function displayAbbreviations() {
    if (!document.getElementsByTagName || !document.createElement || !document.createTextNode) {
        return false;
    }
    //判断浏览器DOM可通用性
    var body = document.getElementsByTagName("body")[0];
    var abbr = document.getElementsByTagName("abbr");
    //取得所有缩略词标签
    var dl = document.createElement("dl");
    //创建缩略词解释列表
    var defs = new Array();
    for (var i = 0; i < abbr.length; i++) {
        var definition = abbr[i].getAttribute("title");
        var key = abbr[i].firstChild.nodeValue;
        defs[key] = definition;
    }
    for (var prop in defs) {   //遍历defs数组并将数组的键与值赋给dt与dd元素的文本节点
        var dt = document.createElement("dt");
        var dttext = document.createTextNode(prop);
        dt.appendChild(dttext);
        var dd = document.createElement("dd");
        var ddtext = document.createTextNode(defs[prop]);
        dd.appendChild(ddtext);
        dl.appendChild(dt);
        dl.appendChild(dd);
    }
    body.appendChild(dl);
}
addLoadEvent(displayAbbreviations);