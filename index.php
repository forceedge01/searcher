<?php
	// Set the number of columns to display on page load.
	$defaultColumnsCount = 2;

	// The search engines to use.
	$search = [
		[
			'name' => 'bing',
			'baseUrl' => 'http://www.bing.com',
			'searchUrl' => 'http://www.bing.com/search?q={searchTerm}'
		], [
			'name' => 'duckduckgo',
			'baseUrl' => 'https://duckduckgo.com',
			'searchUrl' => 'https://duckduckgo.com/?q={searchTerm}&ia=videos'
		], [
			'name' => 'dogpile',
			'baseUrl' => 'http://www.dogpile.com',
			'searchUrl' => 'http://www.dogpile.com/search/web?q={searchTerm}'
		], [
			'name' => 'ask',
			'baseUrl' => 'http://uk.ask.com',
			'searchUrl' => 'http://uk.ask.com/web?q={searchTerm}'
		]
	];
?>

<html>
<head>
	<title>Multi search</title>
	<style>
		#searchbar {
			width: 100%;
			padding: 20px;
			margin: 0 auto;
			text-align: center;
			border-bottom: 1px solid gray;
		}
		.column {
			width: <?=(100/count($search))?>%;
			min-height: 80%;
			float: left;
		}
		iframe {
			width: 100%;
			min-height: 100%;
			height: 100%;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			setTimeout(function() {
				$('input')[0].focus();
			}, 1000);

			// Search engines details populated in javascript.
			var searchEngines = [
				<?php foreach ($search as $s): ?>
					[
						'<?=$s["name"]?>',
						'<?=$s["searchUrl"]?>'
					],
				<?php endforeach ?>
			];

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
		});
	</script>
</head>
<body>
	<div id="searchbar">
		<span>Search</span>
		<input type="text" id="searchTerm"> 
		<button id="go" tabindex="1">Go</button>
		<select id="searchCount">
			<?php for ($i = count($search); $i > 0; $i--): ?>
				<option value="<?=$i?>" <?=($i == $defaultColumnsCount) ? 'selected=selected' : ''?>><?=$i?></option>
			<?php endfor ?>
		</select>
		Per column
	</div>
	<div id="searchResult">
		<?php foreach ($search as $index => $s): ?>
			<div class="column" style="width: <?=100/$defaultColumnsCount?>%">
				<h3><?=$s['name']?></h3>
				<iframe src="" id="<?=$s['name']?>Search"></iframe>
			</div>
		<?php endforeach ?>
	</div>
</body>
</html>