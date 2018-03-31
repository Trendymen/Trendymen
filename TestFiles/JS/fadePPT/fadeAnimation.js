var ppt = {
    index: 0,
    indexBtn: $(".indexBtn"),
    slider: $(".slider"),
    rigthBtn: $(".button .rightBtn"),
    lock: true,
    timer:null,
    createIndex: function () {
        this.len = this.slider.length;
        var fragment = $(document.createDocumentFragment());
        for (var i = 0; i < this.len; i++) {
            $("<li></li>").appendTo(fragment);
        }
        var child = fragment.children();
        child.addClass("fa fa-circle").appendTo(this.indexBtn).eq(0).addClass("active");
        this.indexLi = this.indexBtn.children();
    },
    init: function () {
        this.createIndex();
        this.addevent();
        this.auto();
    },
    addevent: function () {
        $(".button span").add(this.indexLi).click(
            function () {
                clearTimeout(ppt.timer);
                if (ppt.lock) {
                    ppt.lock = false;
                    var _this = $(this);
                    var now = ppt.index;
                    if (_this.parent().hasClass("button")) {
                        if (_this.hasClass("rightBtn")) {
                            ppt.index = ppt.index + 1 === ppt.len ? 0 : ppt.index + 1;
                        }
                        else {
                            ppt.index = ppt.index - 1 < 0 ? ppt.len - 1 : ppt.index - 1;
                        }
                    }
                    else if (_this.parent().hasClass("indexBtn")) {
                        ppt.index = _this.index();
                    }
                    ppt.changeIndex(ppt.index);
                    ppt.fade(ppt.slider.eq(now));
                }
            }
        );
    },

    fade: function (element) {
        $(element).fadeOut(300, function () {
            ppt.slider.eq(ppt.index).fadeIn(300);
            ppt.lock = true;
            ppt.auto();
        });
    },
    auto: function () {
        this.timer=setTimeout(function () {
            ppt.rigthBtn.trigger("click");
        }, 3000);
    },
    changeIndex: function (index) {
        this.indexLi.parent().find(".active").removeClass("active");
        this.indexLi.eq(index).addClass("active");
    }
};

ppt.init();