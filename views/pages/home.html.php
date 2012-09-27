<!-- Empty ul for parseable jQuery -->
<ul style="display: none;"></ul>

<div class="slides">
	<section>
		<br />

		<h1>Resource-Oriented Web Apps</h1>
		<h3 class="subtitle">
			with
			<span class="lithium">Lithium</span>
			&amp;
			<span class="angular">Angular<span class="suffix">JS</span></span>
		</h3>
	</section>

	<section>
		<h2>Sponsored By</h2>
		<?=$this->html->image('ey-logo.png', array('alt' => 'Engine Yard')); ?>
	</section>

	<section>
		<h2>Hello</h2>

		<br />
		<ul>
			<li>Nate Abele, your humble speaker</li>
			<li>Lead developer + co-founder, Lithium</li>
			<li>Former lead developer, CakePHP</li>
			<li><a href="http://twitter.com/nateabele">Twitter: @nateabele</a></li>
			<li><a href="http://nateabele.com/">Blog: nateabele.com</a></li>
			<li class="image">
				<a href="http://union-of-rad.com/">Work with me: Union-of-RAD.com</a>
			</li>
		</ul>

		<?=$this->html->image('uor-logo.png', array(
			'alt' => 'Union of RAD, LLC',
			'style' => 'border: 0; background: transparent; margin-top: 10px; padding-bottom: -100px;',
			'width' => 125,
			'height' => 125
		)); ?>
	</section>

	<section>
		<h2>Colophon</h2>

		<br />
		<ul>
			<li>Google Chrome + Presentation Mode + reveal.js</li>
			<li>AngularJS + Angular Resources</li>
			<li>Lithium 0.11 + li3_resources</li>
			<li>Ubuntu</li>
			<li>VirtualBox + Vagrant</li>
			<li>OSX</li>
		</ul>
	</section>

	<section>
		<h2>Overview</h2>

		<br />
		<ul>
			<li class="title">Intro to AngularJS</li>
			<li class="title">Resources: What and Why?</li>
			<li class="title">Implementation</li>
			<li class="title">Examples</li>
		</ul>
	</section>

	<section>
		<h2>AngularJS</h2>

		<br /><br />
		<ul>
			<li class="title">Abstraction</li>
			<li class="title">Organization</li>
			<li class="title">Testability</li>
		</ul>
	</section>

	<section>
		<h2>Follow along!</h2>

		<a href="http://git.io/Kra4GQ" class="leader">http://git.io/Kra4GQ</a>
	</section>

	<section>
		<h2>AngularJS: Abstraction</h2>

		<br /><br />
		<h3>DOM : jQuery :: jQuery : AngularJS</h3>

		<br /><br />
		<div class="block red">AngularJS</div>
		<div class="block green">jQuery</div>
		<div class="block blue">DOM</div>
	</section>

	<section>
		<h2>Event Binding</h2>

		<h3>jQuery</h3>

		<pre class="language-html">
			<input type="text" id="name" />
			<h1>Hello!</h1>

			<script type="text/javascript">
				$(document).ready(function() {
					$('#name').keydown(function(e) {
						$('h1').html("Hello " + e.target.value + "!")
					});
				});
			</script>
		</pre>
	</section>

	<section>
		<h2>Event Binding</h2>

		<h3>AngularJS</h3>

		<pre class="language-html" ng:non-bindable>
			<input type="text" ng:model="name" />
			<h1>Hello {{ name }}!</h1>
		</pre>

		<br /><br />
		<input type="text" ng:model="name" class="title" />

		<h1>Hello {{ name }}!</h1>
	</section>


	<section>
		<h2>Iteration / Data Sets</h2>

		<h3>jQuery</h3>

		<pre class="language-html">
			<ul></ul>

			<script type="text/javascript">
				$(["Hello", "Hola", "Ciao"]).each(function(k, v) {
					$("ul:first").append("<li>" + v + " World</li>");
				});
			</script>
		</pre>
	</section>

	<section>
		<h2>Iteration / Data Sets</h2>

		<h3>AngularJS</h3>

		<pre class="language-html" ng:non-bindable>
			<ul>
				<li ng:repeat="greet in ['Hello', 'Hola', 'Ciao']">
					{{ greet }} World
				</li>
			</ul>
		</pre>

		<ul>
			<li ng:repeat="greet in ['Hello', 'Hola', 'Ciao']">
				{{ greet }} World
			</li>
		</ul>

	</section>

	<section>
		<h2>Iteration / Data Sets</h2>

		<h3>AngularJS</h3>

		<pre class="language-html half" ng:non-bindable>
			<input ng:model="names" ng:list />
			<span> = {{ names }}</span>

			<ul>
			   <li ng:repeat="name in names">
			     User {{ $index + 1 }}: {{ name }}
			   </li>
			</ul>
		</pre>

		<input type="text" ng:model="names" class="half" ng:list>
		<br /><br />

		<span> = {{ names }}</span>
		<br /><br />

		<ul>
			<li ng:repeat="name in names">User {{ $index + 1 }}: {{ name }}</li>
		</ul>
	</section>

	<section>
		<h2>AngularJS: Organization</h2>

		<br />
		<span ng:controller="CheckoutController">
			<div ng:repeat="item in items">
				Item: <input type="text" ng:model="item.name" style="width: 175px;" />
				Qty: <input type="number" ng:model="item.qty" />
				Price: <input type="number" ng:model="item.price" />
				Total: <div style="display: inline-block; width: 75px;">
					{{ item.qty * item.price | currency: "$" }}
				</div>
			</div>

			<hr />
			<div>Total: {{ total() | currency: "$" }}</div>
		</span>

		<script type="text/javascript">
			function CheckoutController($scope) {
				$scope.items = $scope.items || [{ price: 0, qty: 0 }];

				$scope.total = function() {
					if ($scope.items[$scope.items.length - 1].qty) {
						$scope.items.push({ price: 0, qty: 0 });
					}

					return $scope.items.map(function(item) {
						return item.qty * item.price;
					}).reduce(function(a, b) {
						return a + b;
					});
				};
			}
		</script>
	</section>

	<section>
		<h2>AngularJS: Organization</h2>

		<br />
		<pre class="language-html" ng:non-bindable>
			<span ng:controller="**CheckoutController^**">
				<div ng:repeat="item in items">
					Item: <input type="text" ng:model="item.name" />
					Qty: <input **type="number"^** ng:model="item.qty" />
					Price: <input **type="number"^** ng:model="item.price" />
					Total: {{ **item.qty * item.price | currency: "$"^** }}
				</div>

				<hr />
				<div>Total: {{ **total()^** | currency: "$" }}</div>
			</span>
		</pre>
	</section>

	<section>
		<h2>AngularJS: Organization</h2>

		<br />
		<pre class="language-js" ng:non-bindable>
			function CheckoutController($scope) {
				$scope.items = $scope.items || [{ price: 0, qty: 0 }];

				$scope.total = function() {
					if ($scope.items[$scope.items.length - 1].qty) {
						$scope.items.push({ price: 0, qty: 0 });
					}

					return $scope.items.map(function(item) {
						return item.qty * item.price;
					}).reduce(function(a, b) {
						return a + b;
					});
				};
			}
		</pre>
	</section>

	<section>
		<h2>AngularJS: Testability</h2>
		<br />
		<pre class="language-js" ng:non-bindable>
			describe("Shopping cart", function() {

				describe("Checkout widget", function() {

					it("should create a default element", function() {
						var scope = {},
							controller = new CheckoutController(scope);

						expect(scope.items.length).toBe(1);
						expect(scope.items[0].qty).toBe(0);
						expect(scope.items[0].price).toBe(0);
					});
				});
			});
		</pre>
	</section>

	<section>
		<h2>AngularJS: Testability</h2>
		<br />
		<pre class="language-js" ng:non-bindable>
			describe("Shopping cart", function() {

				describe("Checkout widget", function() {
					// ...

					it("should calculate order total", function() {
						var scope = { items: [
							{ price: 2, qty: 4 }, { price: 10, qty: 1 }
						]};
						var controller = new CheckoutController(scope);

						expect(scope.total()).toBe(18);
					});
				});
			});
		</pre>
	</section>

	<section>
		<h2>AngularJS: Testability</h2>

		<script type="text/javascript">
			describe("Shopping cart", function() {

				describe("Checkout widget", function() {

					it("should create a default element", function() {
						var scope = {},
							controller = new CheckoutController(scope);

						expect(scope.items.length).toBe(1);
						expect(scope.items[0].qty).toBe(0);
						expect(scope.items[0].price).toBe(0);
					});

					it("should calculate order total", function() {
						var scope = {
							items: [
								{ price: 2, qty: 4 },
								{ price: 10, qty: 1 }
							]
						};
						var controller = new CheckoutController(scope);

						expect(scope.total()).toBe(18);
					});
				});
			})
		</script>

		<div id="test-results"></div>
	</section>

	<section>
		<h2 class="leader">Resources?</h2>
	</section>

	<section>
		<h2>An HTTP resource is / has...</h2>

		<br />
		<ul>
			<li>...a <em>thing</em> &nbsp;(a chunk of information)</li>
			<li>...usually made up of some headers and a body</li>
			<li>...identified by a URL</li>
			<li>...different <em>representations</em></li>
			<li>...exposed through a set of well-defined methods</li>
			<li>...links to other related resources</li>
		</ul>
	</section>

	<section>
		<h2>Resource Representations</h2>

		<br /><br />
		<pre class="language-html" ng:non-bindable>
			GET /posts HTTP/1.1

			<!-- html -->
				...
				<h1>My blog</h1>
				...
			<!-- /html -->
		</pre>
	</section>

	<section>
		<h2>Resource Representations</h2>

		<br />
		<pre class="language-js" ng:non-bindable>
			GET /posts HTTP/1.1
			<strong>Accept: application/json</strong>

			[
				{ id: 1, title: "Hello World", ... },
				{ id: 2, title: "Something political", ... },
				{ id: 3, title: "Something programming-related", ... },
				{ id: 4, title: "Something political", ... },
				{ id: 5, title: "Something political", ... }
			]
		</pre>
	</section>

	<section>
		<h2>Resource Methods</h2>

		<br />
		<pre class="language-js" ng:non-bindable>
			POST /posts HTTP/1.1
			Accept: application/json
			<strong>Content-Type: application/json</strong>

			{ "title": "On Tempting the Demo Gods", ... }
		</pre>
	</section>
</div>

<aside class="notes">
	- Great for CRUD apps
	- Most of the web is a CRUD app
	- Like most programming, modeling with resources is a **design** problem
</aside>
