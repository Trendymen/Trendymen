var puzzle = {
    wrapper: document.getElementsByClassName("wrapper")[0],
    box: document.getElementsByClassName("box"),

    init: function () {   //对象入口
        this.random();
        this.boxAuto();
        this.bindEvent();
    },

    random: function () {     //给每个方格生成 0 - 8随机数字 并且不重复
        var arr = [];
        var reg = /boxchild[0-9]/;
        for (var i = 0; i < 9; i++) {
            arr.push(getRandomNum());
        }

        Array.prototype.forEach.call(this.box, function (ele, index) {
            ele.setAttribute("num", arr[index]);
            var className = ele.getAttribute("class");
            var regStr = className.match(reg);
            regStr ? ele.setAttribute("class", className.replace(regStr, "boxchild" + arr[index]))
                : ele.classList.add("boxchild" + arr[index]);
        });

        function getRandomNum() {
            var num = Math.floor(Math.random() * 9);
            if (arr.indexOf(num) !== -1) {
                return getRandomNum();
            }
            else {
                return num;
            }
        }
    },

    boxAuto: function (restart) {  //使每个方格根据在box类数组中的顺序自动移动至指定方向
        var target=restart?{left:0,top:0,opacity:0}:"";
        Array.prototype.forEach.call(this.box, function (ele, index) {
            ele.style.left = ele.style.left ? ele.style.left : 0;
            ele.style.top = ele.style.top ? ele.style.top : 0;
            $(ele).animate(target,restart?"":0,
                jQuery.prototype.animate.bind($(ele),
                    {
                        left: (index % 3) * 100,
                        top: (parseInt(index / 3)) * 100,
                        opacity: 1
                    }));
            // move(ele, target,
            //     move.bind(window, ele, {left: (index % 3) * 100, top: (parseInt(index / 3)) * 100, opacity: 1}));

        });
    },

    changePosition: function (use, target) {    //当拖动方格时，与其他方格交换位置或不改变位置的函数
        var index;
        if (target) {
            var next = use.nextElementSibling;
            this.wrapper.insertBefore(use, target.nextElementSibling);
            this.wrapper.insertBefore(target, next);
            index = Array.prototype.indexOf.call(this.box, target);
            move(target, {
                left: (index % 3) * 100,
                top: (parseInt(index / 3)) * 100
            }, this.DoYouWin.bind(this, target));
        }
        index = Array.prototype.indexOf.call(this.box, use);
        move(use, {
            left: (index % 3) * 100,
            top: (parseInt(index / 3)) * 100
        }, this.removeClass.bind(this, "", use));
    },

    bindEvent: function () {            //事件绑定
        this.wrapper.addEventListener("mousedown", function (e) {
            var ele = e.target;
            var self = this;
            var x, y;
            if (ele.parentNode === this.wrapper) {
                window.cancelAnimationFrame(ele.timer);
                this.removeClass(document.getElementsByClassName("active")[0],
                    document.getElementsByClassName("oncover")[0]);
                ele.classList.add("active");
                x = e.pageX - ele.offsetLeft;
                y = e.pageY - ele.offsetTop;
                document.addEventListener("mousemove", move);
                document.addEventListener("mouseup", up);
            }

            function move(e) {
                ele.style.left = e.pageX - x + "px";
                ele.style.top = e.pageY - y + "px";
                self.judge(ele);
            }

            function up() {
                document.removeEventListener("mousemove", move);
                document.removeEventListener("mouseup", up);
                self.changePosition(ele, self.judge(ele, true));
            }
        }.bind(this));
    },

    judge: function (ele, up) {            //拖动方格过程中，根据距离判断使可交换位置的方格边框变色。
        // 以及根据距离在松开鼠标时对 removeClass 函数的调用 并且返回可交换方格的 DOM 元素
        var eleIndex = Array.prototype.indexOf.call(this.box, ele);
        var element;
        for (var i = 0; i < 9; i++) {
            if (eleIndex !== i) {
                element = this.box[i];
                if (Math.abs(ele.offsetLeft - element.offsetLeft) < 50 && Math.abs(ele.offsetTop - element.offsetTop) < 50) {
                    element.classList.add("oncover");
                    if (up) {
                        break;
                    }
                }
                else {
                    element.classList.remove("oncover");
                    element = null;
                }
            }
        }
        return element;
    },

    DoYouWin: function (target) {
        this.removeClass("", target);
        var win = Array.prototype.every.call(this.box, function (ele, index) {
            if (index == ele.getAttribute("num")) {
                return true;
            }
        });
        if (win) {

            var again = confirm("you win! Do you want to play again?");
            if (again) {
                this.random();
                this.boxAuto(true);
            }
        }
    },

    removeClass: function (use, target) {       //清除边框变色方格的的类及活动方格的active类
        if (use && use.getAttribute("class").indexOf("active") !== -1) {
            use.classList.remove("active");
        }
        if (target && target.getAttribute("class").indexOf("oncover") !== -1) {
            target.classList.remove("oncover");
        }

    }
};

puzzle.init();
