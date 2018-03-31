function combineFilter(obj, data) {
    return function () {
        var lastData = data;
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop)) {
                lastData = obj[prop](lastData, store.getState()[prop]);
            }
        }
        return lastData;
    };
}

var combine = combineFilter({text: filterText, sex: filterClick}, window.data);