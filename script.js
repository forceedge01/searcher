$(document).ready(function() {
	var keywords = {
		'maps:': 'https://www.google.co.uk/maps/search/{term}',
		'translate:': 'https://translate.google.co.uk/#auto/en/{term}',
		'bing:': 'http://www.bing.com/search?q={term}',
		'images:': 'http://www.bing.com/images/search?q={term}',
		'stack:': 'http://stackoverflow.com/search?q={term}',
		'amazon:': 'https://www.amazon.co.uk/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords={term}',
		'ebay:': 'http://www.ebay.co.uk/sch/i.html?_from=R40&_trksid=p2050601.m570.l1313.TR0.TRC0.H0.Xasdf.TRS0&_nkw={term}&_sacat=0',
		'asda:': 'http://groceries.asda.com/search/{term}',
		'destination:': 'https://www.google.co.uk/maps/dir/Abbey+Rd,+Birmingham+B23+7QQ,+UK/{term}/',
		'imdb:': 'http://www.imdb.com/find?ref_=nv_sr_fn&q={term}&s=all'
	};

	setTimeout(function() {
		$('input')[0].focus();
	}, 1000);

	// On go, submit the query to both search engines.
	$('#go').on('click', function() {
		// Get the search term submitted.
		var search = $('#searchTerm').val();
		var filteredUrl = '';
		var count = $('#searchCount').val();

		// Reset width of columns.
		$('.column').attr('style', 'width: ' + 100/count + '%;');

		// Set the iframe urls.
		for (property in searchEngines) {
			filteredUrl = searchEngines[property][1].replace('{searchTerm}', search);
			$('#' + searchEngines[property][0] + 'Search').attr('src', filteredUrl);
		}
	});

	jQuery(document).on('keypress', function(e) {
	    if (e.which == 13) {
	        jQuery('#go').click();
	    }
	});

	jQuery('#go').on('click', function() {
		var toSearch = $('#searchTerm').val();

		// Go to the url specified in the match.
		for (keyword in keywords) {
		    if (toSearch.indexOf(keyword) === 0) {
				var res = toSearch.split(keyword);
				var goTo = null;

				goTo = keywords[keyword].replace('{term}', res[1]);

				if (goTo !== null) {
					window.location = goTo;
				}
		    }
		}
     });
});