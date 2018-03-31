/**
 * Created by lz199 on 2018/1/5 0005.
 */
function movediv(name, tox, toy, time) {
    if (!document.getElementById || !window.getComputedStyle || !document.getElementById(name)) {
        return false;
    }
    var div = document.getElementById(name);
    if (div.movement) {
        clearTimeout(div.movement);
    }
    if (!window.getComputedStyle(div, null).left) {
        div.style.left = 0;
    }
    if (!window.getComputedStyle(div, null).top) {
        div.style.top = 0;
    }
    var x = parseInt(window.getComputedStyle(div, null).left);
    var y = parseInt(window.getComputedStyle(div, null).top);
    var dist = 0;
    if (x === tox && y === toy) {
        return true;
    }
    else {
        if (x < tox) {
            dist = Math.ceil((tox - x) / 20);
            x += dist;
        }
        else if (x > tox) {
            dist = Math.ceil((x - tox) / 20);
            x -= dist;
        }
        if (y < toy) {
            dist = Math.ceil((toy - y) / 20);
            y += dist;
        }
        else if (y > toy) {
            dist = Math.ceil((y - toy) / 20);
            y -= dist;
        }

    }
    div.style.left = x + "px";
    div.style.top = y + "px";
    div.movement = setTimeout("movediv('" + name + "'," + tox + "," + toy + "," + time +")", time);
}