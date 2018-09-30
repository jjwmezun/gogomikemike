var Palette =
[
	{ 'name': '--MAINBG', 'base': 224, 's': 40, 'l': 80 },
	{ 'name': '--MAIN1', 'base': 224, 's': 99, 'l': 30 },
	{ 'name': '--MAIN2', 'base': 224, 's': 84, 'l': 40 },
	{ 'name': '--MAIN3', 'base': 224, 's': 76, 'l': 50 },
	{ 'name': '--MAIN4', 'base': 224, 's': 60, 'l': 60 },
	{ 'name': '--MAIN5', 'base': 224, 's': 44, 'l': 70 }
];

function randInt( min, max )
{
	return Math.floor( Math.random() * ( max - min ) ) + min;
};

function randByte()
{
	return randInt( 0, 255 );
};

function randomColor()
{
	var string = 'hsl( ';
	
	for ( var i = 0; i < 3; i++ )
	{
		string += randInt( 0, 100 );
		
		if ( i < 2 )
		{
			string += ', ';
		}
	}
	
	string += ' )';
	
	console.log( string );
	return string;
};

function randHue()
{
	return randInt( 0, 360 );
};

function makeColor( h, s, l )
{
	console.log( 'hsl( ' + h + ', ' + s + '%, ' + l + '% )' );
	return 'hsl( ' + h + ', ' + s + '%, ' + ( l - 25 ) + '% )';
};

function adjustPercent( val, adjust )
{
	val += adjust;
	
	if ( val > 100 )
		val = 100;
	else if ( val < 0 )
		val = 0;
	
	return val;
};

function generateRandomPalette()
{
	var hue = randHue();
	var sat_adjust = randInt( 0, 50 ) - 45; // -45 to 5
	var light_adjust = randInt( 0, 30 ) - 5; // -5 to 25
	
	for ( var i = 0; i < Palette.length; i++ )
	{
		document.body.style.setProperty( Palette[ i ][ 'name' ], makeColor( hue, adjustPercent( Palette[ i ][ 's' ], sat_adjust ), adjustPercent( Palette[ i ][ 'l' ], light_adjust ) ) );
	}
};

if ( sessionStorage.getItem( 'rand_pal_page_loaded' ) )
{
	generateRandomPalette();
}

sessionStorage.setItem( 'rand_pal_page_loaded', true )