const portraits = Array.from(document.querySelectorAll(".js-artist"));

portraits.forEach((artist) => {
    artist.style.top = Math.random() * 100 + "%";

    artist.style.left = Math.random() * 100 + "%";
});

let firstPass = true;

let iterations = 0;

const movePortraits = () => {
    portraits.forEach((artist) => {
        if (firstPass || Math.floor(Math.random() * 100) < 30) {
            const size = Math.random() * 100 + 50 + "px";

            artist.style.height = size;

            artist.style.width = size;

            artist.style.top = Math.random() * 100 + "%";

            artist.style.left = Math.random() * 100 + "%";
        }
    });

    firstPass = false;

    if (iterations-- > 0) {
        setTimeout(movePortraits, 1000);
    }
};

setTimeout(movePortraits, 100);
