/**
 * Created by l2266803 on 2018/1/3 0003.
 */
var request = getHTTPObject();
function getNewContent() {
    if (request) {
        request.open("GET", "image.json", true);
        request.responseType = 'json';
        request.onreadystatechange = reseponse;
        request.send(null);
    }
    else {
        window.alert("Sorry,your browser doesn\'t support XMLHttpRequest");
    }
}

function reseponse() {

    if (request.readyState == 4) {
        var aArr = document.getElementsByTagName("a");
        var aArrimg = document.getElementsByTagName("img");
        var src=null;
        if(request.responseType != 'json'){ //针对不支持request.responseType != 'json'浏览器
            src = JSON.parse(request.responseText);
        }
        else{
            src = request.response;
        }
        for (var i = 0; i < aArr.length; i++) {
            aArr[i].setAttribute("href", src.imgsrc[i]);
            aArrimg[i].setAttribute("src", src.imgsrc[i]);
        }
    }

}
addLoadEvent(getNewContent);
