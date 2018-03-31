(function () {
    var li = document.getElementsByClassName("wrapper")[0].children;
    var wrapper = document.getElementsByClassName("wrapper")[0];
    var cpage = 2;
    var lock = true;
    var top;

    function print(data) {
        console.time("time");
        data = JSON.parse(data);
        var len = data.length;
        if (len > 0) {
            data.forEach(function (obj, index) {
                createElement(obj);
            });
        }
        if (len <= 0) {
            wrapper.classList.add("noMore");
        }
        console.timeEnd("time");
        lock = true;
    }

    function createImg(url,width,height,parentNode) {
        var img = document.createElement("img");
        img.src = url;
        img.style.height = getHeight(width,height) + "px";
        img.classList.add("imgHidden");
        img.onload = function () {
            parentNode.classList.remove("loading");
            img.classList.remove("imgHidden");
            // div.style.height = "auto";
        };
        return img ;
    }

    function createElement(obj) {
        if(parseInt(obj.width) && parseInt(obj.height)){
            var div = document.createElement("div");
            div.classList.add("loading");

            var p = document.createElement("p");
            p.innerHTML = obj.title;

            div.appendChild(createImg(obj.preview,obj.width,obj.height,div));
            div.appendChild(p);
            getMinWidthIndex().appendChild(div);
        }
        else {
            return false;
        }

    }

    window.onscroll = function (e) {
        var scrollTop =window.scrollY || document.documentElement.scrollTop;
        if (scrollTop >= getMinWidthIndex().offsetHeight - document.documentElement.clientHeight &&
            scrollTop > top) {
            if (lock) {

                lock = false;
                ajax("get", "getPics.php", "cpage=" + cpage, print, true);
                cpage++;
            }

        }
        top = window.scrollY || document.documentElement.scrollTop;
    };

    function getMinWidthIndex() {
        var arr = [];
        var len = li.length;
        var min = 0;
        for (var i = 0; i < len; i++) {
            arr.push(li[i].offsetHeight);
        }
        for (i = 1; i < len; i++) {
            if (arr[min] > arr[i]) {
                min = i;
            }
        }
        return li[min];
    }

    window.getMinWidthIndex = getMinWidthIndex;

    function getHeight(width,height) {
        var scale = width / (900 * 0.23);
        return height / scale;
    }

    ajax("get", "getPics.php", "cpage=1", print, true);


}());

