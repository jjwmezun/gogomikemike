function rand_palette()
{
	var DARK_AVERAGE = 96;
	var NORMAL_ADD = 24*3;
	var LIGHTER_ADD = 48*3;
	var DARKER_SUB = 60;
	
	var NUM_O_COLORS = 3;
	var whole = DARK_AVERAGE*NUM_O_COLORS;
	// 'Tween 72 & 144
	var first_cut = Math.floor(Math.random() * (whole/4))+(whole/4);
	var remainder = whole - first_cut;
	// 'Tween 72 & 144
	var second_cut = Math.floor(Math.random() * (remainder/2));
	var third_cut = remainder - second_cut;
	
	var colors = [first_cut, second_cut, third_cut];
	
	// Shuffle for extra randomness.
	colors.sort(function() { return 0.5 - Math.random() });
	
	var main_bg = randomColor('bright');
	var main_dark = 'rgb('+colors[0]+','+colors[1]+','+colors[2]+')';
	var main_normal = 'rgb('+notOver255(colors[0],NORMAL_ADD)+','+notOver255(colors[1],NORMAL_ADD)+','+notOver255(colors[2],NORMAL_ADD)+')';
	var main_lighter = 'rgb('+notOver255(colors[0],LIGHTER_ADD)+','+notOver255(colors[1],LIGHTER_ADD)+','+notOver255(colors[2],LIGHTER_ADD)+')'; var main_darker = 'rgb('+notUnder0(colors[0],DARKER_SUB)+','+notUnder0(colors[1],DARKER_SUB)+','+notUnder0(colors[2],DARKER_SUB)+')';

	//console.log(main_dark);
	//console.log(main_normal);
	//console.log(main_lighter);
	
		document.body.style.setProperty('--main_bg', main_bg);	
		document.body.style.setProperty('--MAIN1', main_dark);	
		document.body.style.setProperty('--MAIN3', main_normal);
		document.body.style.setProperty('--MAIN4', main_lighter);
		document.body.style.setProperty('--MAIN2', main_darker);
		
		/*
		$('.page-header h1').append('<div class="banner_filter"></div>');
		
		var filter = {'position':absolute,'left':'0','top':'0','right':'375px','bottom':'100px','background':main_normal};
		
		$('.banner_filter').css(filter);
		*/
}