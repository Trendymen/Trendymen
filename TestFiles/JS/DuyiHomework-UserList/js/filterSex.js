function filterClick(arr, sex) {
    return arr.filter(function (value) {
        if (value.sex === sex) {
            return true;
        }
        else if (sex === "a") {
            return true;
        }
    });
}
