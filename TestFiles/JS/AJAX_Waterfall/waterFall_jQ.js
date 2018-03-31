(function () {
    var $wrapper = $(".wrapper");
    var $li = $wrapper.find("li");
    var cpage = 2;
    var lock = true;
    var top;

    function print(data) {
        console.time("time");
        data = JSON.parse(data);
        var len = data.length;
        if (len > 0) {
            $.each(data, function (index, obj) {
                createElement(obj);
            });
        }
        if (len <= 0) {
            $wrapper.addClass("noMore");
        }
        console.timeEnd("time");
        lock = true;
    }

    function createImg(url, width, height, parentNode) {
        var $img = $("<img>").prop("src", url).
        css("height", getHeight(width, height)).
        addClass("imgHidden");

        $img.on("load",function () {
            parentNode.removeClass("loading");
            $(this).removeClass("imgHidden");
            // div.style.height = "auto";
        });
        return $img;
    }

    function createElement(obj) {
        if(parseInt(obj.width) && parseInt(obj.height)) {
            var $div = $("<div>").addClass("loading").
            append(createImg(obj.preview, obj.width, obj.height, $(this))).
            append($("<p>").
            text(obj.title));
            $(getMinWidthIndex()).append($div);
        }
        else {
            return false;
        }
    }

    $(document).on("scroll",function () {
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
    });


    function getMinWidthIndex() {
        var arr = [];
        var len = $li.length;
        var min = 0;
        for (var i = 0; i < len; i++) {
            arr.push($li[i].offsetHeight);
        }
        for (i = 1; i < len; i++) {
            if (arr[min] > arr[i]) {
                min = i;
            }
        }
        return $li[min];
    }

    window.getMinWidthIndex = getMinWidthIndex;

    function getHeight(width, height) {
        var scale = width / (900 * 0.23);
        return height / scale;
    }
    $.ajax({
       method:"get",
       url:"getPics.php",
       data:"cpage=1",
       success:print
    });

}());

