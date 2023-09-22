document.addEventListener( `DOMContentLoaded`, () => {
    let isMobile = false;
    const search = document.getElementById( `gomike-search-input` );
    const origTextArea = search.innerHTML;
    const textInput = (() => {
        const bar = document.getElementById( `gomike-search-bar` );
        const origAttributes = bar.getAttributeNames().map( att => `${ att }="${ bar.getAttribute( att ) }"` ).join( ` ` );
        return `<input
            ${ origAttributes }
            type="text"
        />`;
    })();

    const update = () => {
        const prevIsMobile = isMobile;
        isMobile = window.innerWidth < 1000;

        // If screen orientation hasn’t changed, skip.
        if ( prevIsMobile === isMobile ) return;

        // On mobile, change to input text box,
        // but on desktop, keep as textarea.
        search.innerHTML = isMobile ? textInput : origTextArea;
    };

    window.addEventListener( `resize`, update );
    update();
});