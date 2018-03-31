function createVideoControls() {
    var vids=document.getElementsByTagName("video");
    for(var i=0;i<vids.length;i++){
        addControls(vids[i]);
    }
}
function addControls(video) {
    video.removeAttribute("controls");
    // video.height=video.videoHeight;
    var controls=document.createElement("div");
    controls.setAttribute("class","controls");
    var play=document.createElement("button");
    play.setAttribute("title","play");
    play.innerHTML="&#x25BA";

    controls.appendChild(play);
    video.parentNode.insertBefore(controls,video);

}

createVideoControls();