var boutonHautPage = document.getElementById("scrollToTopBtn");

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}

boutonHautPage.addEventListener("click", scrollToTop);