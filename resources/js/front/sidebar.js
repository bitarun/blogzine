export function f() {
    document.body.addEventListener('click', function () {
        const main = document.getElementById("main");
        if (!main) return;

        main.style.cssText = "margin: 0;";
    }, true);
}

document.addEventListener('DOMContentLoaded', () => {

    const main = document.getElementById("main");
    const closedSidebar = document.getElementById("closedSidebar");
    const openedSidebar = document.getElementById("openedSidebar");

    if (!main || !closedSidebar || !openedSidebar) return;

    closedSidebar.addEventListener('click', function () {
        main.style.cssText = "margin: 0;";
    });

    openedSidebar.addEventListener('click', function () {
        const mediaQuery = window.matchMedia('(min-width: 768px)');

        if (mediaQuery.matches) {
            main.style.cssText = "margin: 0 -260px 0 0;";
        } else {
            main.style.cssText = "margin: 0 -750px 0 0;";
        }
    });

});


/*/!*document.body.addEventListener('click', function () {
    document.getElementById("main").style.cssText = "margin: 0;"
}, true);*!/

export function f() {
    document.body.addEventListener('click', function () {
        document.getElementById("main").style.cssText = "margin: 0;"
    }, true);
}

document.getElementById("closedSidebar").addEventListener('click', function () {
    document.getElementById("main").style.cssText = "margin: 0;";
});

document.getElementById("openedSidebar").addEventListener('click', function () {
    const mediaQuery = window.matchMedia('(min-width: 768px)')
    if (mediaQuery.matches) {
        document.getElementById("main").style.cssText = "margin: 0 -260px 0 0;";
    } else {
        document.getElementById("main").style.cssText = "margin: 0 -750px 0 0;";
    }
})*/
