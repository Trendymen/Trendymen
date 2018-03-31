var tool = {};
tool.search();
(function () {
    var $input = $(".search").find(":text");
    var $ul = $(".searchList");
    tool.search = init;

    function init() {
        bindEvent();
    }

    function bindEvent() {
        $input.on("input", function () {
            request($(this).val());
        });
    }


    function request(value) {
        $.ajax({
            method: "get",
            url: "https://api.douban.com/v2/music/search",
            dataType: "jsonp",
            data: "count=6&q=" + value,
            success: insertData
        });
    }

    function insertData(data) {
        console.log(data);
        var fragment = document.createDocumentFragment();
        data.musics.forEach(function (obj) {
            createElement(obj, fragment);
        });
        $ul.html("");
        console.log(1);
        $(fragment).appendTo($ul);
    }

    function createElement(obj, fragment) {
        var li = $("<li>").appendTo(fragment);
        $("<a>").attr("href",obj.alt).append($("<img>").prop("src", obj.image))
            .append($("<span>").text(obj.title))
            .append($("<em>").text("(" + obj.author[0].name + ")")).appendTo(li);


    }
}());

