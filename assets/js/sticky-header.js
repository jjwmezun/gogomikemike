document.addEventListener( `DOMContentLoaded`, () => {
    const baseClass = `gomike-main-header`;
    const stickyBaseClass = `${ baseClass }--sticky`;
    let isMobile = false;
    let isDown = false;
    let prevY = 0;
    const header = document.getElementById( baseClass );
    const body = document.getElementById( `gomike-body` );

    const update = () => {
        isMobile = window.innerWidth < 1280;

        // Is down when below nav & has scrolled down.
        isDown = window.scrollY > 300 && prevY < window.scrollY;

        prevY = window.scrollY;

        // Don’t make sticky @ all on mobile.
        if ( isMobile ) {
            header.classList.remove( stickyBaseClass );
            header.classList.remove( `${ stickyBaseClass }-show` );
            body.classList.remove( `gomike-body--sticky` );
        }
        else {
            // Make sticky on desktop.
            body.classList.add( `gomike-body--sticky` );
            header.classList.add( stickyBaseClass );

            // But hide when scrolling down.
            header.classList[ isDown ? `add` : `remove` ]( `${ stickyBaseClass }-hide` );
        }
    };

    window.addEventListener( `scroll`, update );
    window.addEventListener( `resize`, update );
    update();
});