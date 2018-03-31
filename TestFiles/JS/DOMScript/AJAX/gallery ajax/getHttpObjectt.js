/**
 * Created by l2266803 on 2018/1/3 0003.
 */
function getHTTPObject() {
    if (typeof XMLHttpRequest == "undefined") {
        XMLHttpRequest = function () {
            try {
                return new ActiveXObject("Msxl2.XMLHTTP.6.0");
            }
            catch (e) {
            }
            try {
                return new ActiveXObject("Msxl2.XMLHTTP.3.0");
            }
            catch (e) {
            }
            try {
                return new ActiveXObject("Msxl2.XMLHTTP");
            }
            catch (e) {
            }
            return false;
        };
    }

    return new XMLHttpRequest();

}
