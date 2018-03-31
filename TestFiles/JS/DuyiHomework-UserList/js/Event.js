window.addEventListener("load", function () {
    render(data);
});

input.oninput = function () {
    store.setStateAndChange({text:this.value});

};

pOfBtn.addEventListener("click", function (e) {
    if (e.target.tagName === "SPAN") {
        document.getElementsByClassName("active")[0].removeAttribute("class");
        e.target.className = "active";
        store.setStateAndChange({sex:e.target.dataset.name});

    }
});