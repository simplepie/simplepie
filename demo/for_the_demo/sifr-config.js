var lucida_grande = {
	src: './for_the_demo/lucida-grande-bold.swf'
};

sIFR.activate(lucida_grande);

sIFR.replace(lucida_grande, {
	selector: 'h3.header',
	wmode: 'transparent',
	css: {
		'.sIFR-root': {
			'text-align': 'center',
			'color': '#000000',
			'font-weight': 'bold',
			'background-color': '#EEFFEE',
			'font-size': '40px',
			'letter-spacing': '-4'
		},
		'a': {
			'text-decoration': 'none',
			'color': '#000000'
		},
		'a:hover': {
			'text-decoration': 'none',
			'color': '#666666'
		}
	}
});
