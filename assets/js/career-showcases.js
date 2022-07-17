const showcaseVideo = document.getElementById("showcase-video");

const showcaseVideoContainer = document.getElementById("showcase-video-container");

const playingClass = "showcases__video-container--playing";

showcaseVideo.addEventListener("click", (e) => {
    if (showcaseVideo.paused) {
        showcaseVideo.play();

        showcaseVideoContainer.classList.add(playingClass);
    } else {
        showcaseVideo.pause();

        showcaseVideoContainer.classList.remove(playingClass);
    }
});
