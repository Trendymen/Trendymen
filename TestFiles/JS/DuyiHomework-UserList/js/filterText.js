function filterText(arr, text) {

    return arr.filter(function (value, index) {
        if (value.name.indexOf(text) !== -1) {
            return true;
        }
    });
}