Function.prototype.myCall = function (target, fn) {
    if (!target) {
        target = window;
    }
    target.fn = this;
    var arr = [];
    for (var i = 1; i < arguments.length; i++) {
        arr.push('arguments[' + i + ']');
    }
    var result = eval("target.fn(" + arr + ")");
    delete target.fn;
    return result;
};

var obj = {
    b: "obj"
};

var b = "window";

function a() {
    return this.b;
}

console.log(a.myCall(obj, b));