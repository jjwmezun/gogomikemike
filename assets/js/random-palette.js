(() => {
    const palette =
    [
        { name: '--MAINBG', base: 224, s: 40, l: 100 },
        { name: '--MAIN1',  base: 224, s: 99, l:  20 },
        { name: '--MAIN2',  base: 224, s: 84, l:  30 },
        { name: '--MAIN3',  base: 224, s: 76, l:  50 },
        { name: '--MAIN4',  base: 224, s: 60, l:  60 },
        { name: '--MAIN5',  base: 224, s: 48, l:  80 }
    ];

    const randInt = ( min, max ) => Math.floor( Math.random() * ( max - min ) ) + min;

    const makeColor = ( h, s, l ) => `hsl( ${ h }, ${ s }%, ${ l }% )`;

    // Add adjust to value & keep within bounds o’ 0 - 100.
    const adjustPercent = ( v, adjust ) => Math.max( 0, Math.min( 100, v + adjust ) );

    const generateRandomPalette = () => {
        const hue = randInt( 0, 360 );
        const saturationAdjust = randInt( -45, 5 );
        const lightAdjust = randInt( -20, -5 );

        palette.forEach( color => {
            document.body.style.setProperty(
                color.name,
                makeColor(
                    hue,
                    adjustPercent( color.s, saturationAdjust ),
                    adjustPercent( color.l, lightAdjust )
                )
            );
        });
    };

    // Only randomize palette on subsequent page loads.
    if ( sessionStorage.getItem( 'rand_pal_page_loaded' ) ) {
        // Randomize palette on DOM load.
        document.addEventListener( `DOMContentLoaded`, generateRandomPalette );
    }
    else {
        sessionStorage.setItem( 'rand_pal_page_loaded', true )
    }
})();