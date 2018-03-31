function render(arr) {
    var str = "";
    arr.forEach(function (value, index) {
        str += "<li><img src='img/" + value.src + "'>" +
            "<p><span>" + value.name + "" +
            "</span>" +
            "<span>" + value.age + "</span>" +
            "</p></li>";
    });
    setTimeout(function () {
        ul.innerHTML = str;
    }, 150);

}