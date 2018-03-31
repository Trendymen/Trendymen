var ul = document.getElementsByClassName("list")[0];
var input = document.getElementsByClassName("search-box")[0];
var pOfBtn = document.getElementById("btn");
var store=createStore({text:"",sex:""});
store.getFunction(function () {
    render(combine());
});
