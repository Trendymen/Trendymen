var data = [
    {src: "images/image (1).png"},
    {src: "images/image (2).png"},
    {src: "images/image (3).png"},
    {src: "images/image (4).png"},
    {src: "images/image (5).png"},
    {src: "images/image (6).png"},
    {src: "images/image (7).png"},
    {src: "images/image (8).png"},
    {src: "images/image (9).png"},
    {src: "images/image (10).png"},
    {src: "images/image (11).png"},
    {src: "images/image (12).png"},
    {src: "images/image (13).png"},
    {src: "images/image (14).png"}
];

var gallery = {
        liWidth: document.getElementsByTagName("li"),
        showPic: document.getElementsByClassName("showPic")[0],
        ul: document.getElementsByClassName("ul")[0],
        lock: true,
        init: function (data) {
            this.insertImg(data);
            this.eventBind();
        },
        insertImg: function (data) {
            var liHeight=(document.body.offsetWidth / 4) - 4; //li高度 ：与宽度统一
            var domFrag = document.createDocumentFragment();
            var lodding = new Image();
            lodding.src = "images/Rolling-1s-200px.gif";
            data.forEach(function (ele, index) {
                var img = new Image();
                img.src = ele.src;
                var li = $("<li></li>").append(img).appendTo(domFrag);
                li.css("height", liHeight).addClass("loadding");
                $(img).on("load", function () {
                    li.removeClass("loadding");
                    $(this).addClass("show");
                })
            });
            $(this.ul).append(domFrag);
        },
        eventBind: function () {
            var _this = this;
            window.onresize = function () {
                Array.prototype.forEach.call(_this.liWidth, function (ele) {
                    ele.style.height = parseFloat(window.getComputedStyle(ele, null).width) + "px";
                });
            };

            $(this.ul).on("tap", function (e) {
                if (e.target.tagName === "IMG") {
                    _this.show($(e.target).parent().index());
                }
            });

            $(this.showPic).on("swipeLeft", function (e) {
                var index = _this.index < _this.ul.children.length - 1 ? _this.index + 1 : 0;
                _this.show(index);

            });

            $(this.showPic).on("swipeRight", function (e) {
                var index = _this.index > 0 ? _this.index - 1 : _this.ul.children.length - 1;
                _this.show(index);
            });


            $(this.showPic).bind("touchmove", function (e) {
                e.preventDefault();
            });

            $(this.showPic).on("tap", function () {
                $(this).fadeOut();
            })
        },
        show: function (index) {
            var _this = this;
            if (this.lock) {
                this.lock = false;
                this.index = index;
                var img = new Image();
                img.src = this.ul.children[index].children[0].src;
                // $(this.showPic.children[0]).prop("src", this.ul.children[index].children[0].src);
                this.showPic.replaceChild(img, this.showPic.children[0]);
                if (window.getComputedStyle(this.showPic, null).display === "none") {
                    $(this.showPic).fadeIn(function () {
                        _this.lock = true;
                    });
                }
                else {
                    $(this.showPic.children[0]).fadeIn(function () {
                        _this.lock = true;
                    });
                }

            }
        }
    }
;

gallery.init(data);