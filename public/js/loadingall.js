window.addEventListener("load", function () {
    setTimeout(function () {
        const preloader = document.getElementById("preloader");
        preloader.style.opacity = "0";

        setTimeout(function () {
            preloader.style.display = "none";
        }, 700);
    }, 2000);
});
