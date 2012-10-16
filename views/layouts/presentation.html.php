<!doctype html>
<html ng-app="demo">
<head>
	<?=$this->html->charset(); ?>
	<title>Resource-Oriented Applications with AngularJS and Lithium</title>
	<?=$this->html->style(array(
		'oswald',
		'reveal.js/main',
		'/lib/reveal.js/css/zenburn',
		'/lib/jasmine-1.2.0/jasmine'
	)); ?>
	<?=$this->html->style('theme/nate', array('id' => 'theme')); ?>

	<?=$this->html->script(array(
		'jquery.min',
		'angular.min',
		'angular-resource-1.0.1.min.js',
		// 'jquery-syntaxhighlighter/prettify.min',
		'jquery.syntaxhighlighter.min',
		'/lib/jasmine-1.2.0/jasmine',
		'/lib/jasmine-1.2.0/jasmine-html',
	)); ?>

	<script type="text/javascript">
		$.SyntaxHighlighter.init({
			lineNumbers: false,
			stripEmptyStartFinishLines: true,
			stripEmptyStartFinishLines: true,
			stripInitialWhitespace: true
		});
		$(document).ready(function() {

			/**
			 * Shamelessly hacky code formatting.
			 */
			$("pre.language-html, pre.language-js").each(function() {
				var $this = $(this),
					raw = $this.html(),
					pre = [['<!-- html -->', '<html>'], ['<!-- /html -->', '</html>']],
					post = [
						[/\^\*\*/g, '</strong>'],
						[/\*\*/g, '<strong>'],
						[/\=""\s*/g, '']
					],
					m = $this.hasClass("language-html") ? "text" : "html";

				var replace = function(text, replace) {
					for (var n in replace) {
						text = text.replace(replace[n][0], replace[n][1]);
					}
					return text;
				};
				var trim = function(text, ct) {
					return $.map(text.split("\n"), function(t) { return t.substr(ct); }).join("\n");
				}
				$this[m](trim(replace(raw, pre), 3));

				if (m === "text" && $this.html().indexOf("^**") > 0) {
					$this.html(replace($this.html(), post));
				}
			});
		});

		// Angular module initialization
		var app = angular.module('demo', ['ngResource']);

	</script>

	<?=$this->scripts(); ?>
	<?=$this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body>

	<div class="reveal">
		<?=$this->content(); ?>
	</div>

	<?=$this->html->script(array('/lib/reveal.js/js/head.min.js', 'reveal.js/reveal.js')); ?>

	<script type="text/javascript">
		Reveal.initialize({
			controls: true,
			progress: true,
			history: true,
			keyboard: true,
			rollingLinks: false,

			transition: 'default',

			// Optional libraries used to extend on reveal.js
			dependencies: [
				{ src: '/lib/reveal.js/js/highlight.js', async: true, callback: function() { window.hljs.initHighlightingOnLoad(); } },
				{ src: '/lib/reveal.js/js/classList.js', condition: function() { return !document.body.classList; } },
				{ src: '/lib/reveal.js/js/showdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
				{ src: '/lib/reveal.js/js/data-markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } }//,
				// { src: '/socket.io/socket.io.js', async: true, condition: function() { return window.location.host === 'localhost:1947'; } },
				// { src: 'plugin/speakernotes/client.js', async: true, condition: function() { return window.location.host === 'localhost:1947'; } },
			]
		});

	</script>

	<script type="text/javascript">
		// Jasmine test runner

		(function() {
			var htmlReporter = new jasmine.HtmlReporter({
				body: $("#test-results").get(0),
				location: document.location
			});
			var jasmineEnv = jasmine.getEnv();

			jasmineEnv.updateInterval = 1000;
			jasmineEnv.addReporter(htmlReporter);

			jasmineEnv.specFilter = function(spec) {
				return htmlReporter.specFilter(spec);
			};

			$(document).ready(function() {
				jasmineEnv.execute();
			});
		})();
	</script>
</body>
</html>