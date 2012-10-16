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
				$scope.customer = $scope.customer || {};

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

	<section>
		<h2>Resource Methods</h2>

		<br />
		<pre class="language-js" ng:non-bindable>
			HTTP/1.1 <strong>201 Created</strong>
			Location: <strong>http://app-server/posts/506403b2a08e776906000004</strong>
			Content-Type: application/json; charset=UTF-8

			{
				"_id": "506403b2a08e776906000004",
				"title": "On Tempting the Demo Gods",
				....
			}
		</pre>
	</section>

	<section>
		<h2>Putting it together</h2>

		<div ng:controller="TodosController">
			<ul class="todos">
				<li ng:repeat="item in todos">
					<input type="checkbox" ng:model="item.completed" />
					<label
						ng:class="{ completed: item.completed }"
						ng:click="todos.remove($index)"
					>{{ item.title }}</label>
				</li>
				<li ng:show="todos.isEmpty()"><em>Add to-do items below</em></li>
			</ul>

			<form ng:submit="todos.add(newTodo); newTodo = ''">
				<input type="text" class="new-todo" placeholder="New to-do" ng:model="newTodo" />
			</form>
			<pre ng:show="todos.isFilled()">{{ todos }}</pre>
		</div>

		<script type="text/javascript">
			function TodosController($scope) {
				$scope.todos = $.extend([], {
					add: function(item) {
						this.push({ title: item, completed: false });
					},
					remove: function(index) {
						this.splice(index, 1)[0];
					},
					isEmpty: function() {
						return this.length === 0;
					},
					isFilled: function() {
						return this.length >= 3;
					}
				});
			}
		</script>
	</section>

	<section>
		<h2>Putting it together</h2>

		<pre class="language-html" ng:non-bindable>
			<div ng:controller="TodosController">
				<ul class="todos">
					<li ng:repeat="item in todos">
						<input type="checkbox" ng:model="item.completed" />

						<label
							ng:class="{ completed: item.completed }"
							ng:click="todos.remove($index)"
						>{{ item.title }}</label>

					</li>
					<li ng:show="todos.isEmpty()">
						<em>Add to-do items below</em>
					</li>
				</ul>
				<form ng:submit="todos.add(newTodo); newTodo = ''">
					<input type="text" ng:model="newTodo" />
				</form>
				<pre ng:show="todos.isFilled()">{{ todos }}</pre>
			</div>
		</pre>
	</section>

	<section>
		<h2>Putting it together</h2>

		<br />
		<pre class="language-js" ng:non-bindable>
			function TodosController($scope) {
				$scope.todos = $.extend([], {
					add: function(item) {
						this.push({ title: item, completed: false });
					},
					remove: function(index) {
						this.splice(index, 1);
					},
					isEmpty: function() {
						return this.length === 0;
					},
					isFilled: function() {
						return this.length >= 3;
					}
				});
			}
		</pre>
	</section>

	<section>
		<h2>Putting it together</h2>

		<br /><br />
		<h3>
			<pre class="language-js" style="text-align: center;">

			$.ajax({ data: $scope.todos }) ?


			</pre>
		</h3>
	</section>

	<section>
		<h2 class="leader" style="text-align: center; padding-left: 0.8em;">Wrong!</h2>
	</section>

	<section>
		<h2>Putting it together</h2>

		<div ng:controller="PersistentTodosController">

			<ul class="todos">
				<li ng:repeat="item in todos">
					<input type="checkbox" ng:model="item.completed" />

					<label
						ng:class="{ completed: item.completed }"
						ng:click="todos.remove($index)"
					>{{ item.title }}</label>

				</li>
				<li ng:show="todos.isEmpty()">
					<em>Add to-do items below</em>
				</li>
			</ul>

			<form ng:submit="todos.add({ title: newTodo }); newTodo = ''">
				<input type="text" ng:model="newTodo" />
			</form>
		</div>

		<script type="text/javascript">
			app.controller("PersistentTodosController", function($scope, $resource) {
				var Todo = $resource("/todos/:id", { id: '@_id' });

				$scope.todos = $.extend(Todo.query(), {
					add: function(data) {
						var list = this,
							todo = new Todo($.extend(data, { completed: false }));

						todo.$save(function() { list.push(todo); });
					},
					remove: function(index) {
						var todo = this.splice(index, 1)[0];
						todo.$delete();
					},
					isEmpty: function() {
						return this.length === 0;
					},
					isFilled: function() {
						return this.length >= 3;
					}
				});
			});
		</script>
	</section>

	<section>
		<h2>Putting it together</h2>

		<pre class="language-html" ng:non-bindable>
			<ul class="todos">
				<li ng:repeat="item in todos">
					...
				</li>

				<li ng:show="todos.isEmpty()">
					<em>Add to-do items below</em>
				</li>
			</ul>

			<form ng:submit="todos.add(**{ title: newTodo }^**); newTodo = ''">
				<input type="text" ng:model="newTodo" />
			</form>
		</pre>
	</section>

	<section>
		<h2>Putting it together</h2>

		<pre class="language-js" ng:non-bindable>
			function TodosController($scope, <strong>$resource</strong>) {
				<strong>var Todo = $resource("/todos/:id", { id: '@_id' });</strong>

				$scope.todos = $.extend(<strong>Todo.query()</strong>, {
					add: function(data) {
						var list = this, todo = new Todo($.extend(data, {
							completed: false
						}));
						todo.$save(function() { list.push(todo); });
					},
					remove: function(index) {
						var todo = this.splice(index, 1)<strong>[0]</strong>;
						todo.$delete();
					},
					...
				});
			});
		</pre>
	</section>

	<section>
		<h2>Putting it together: the backend</h2>

		<pre class="language-js">
			namespace todos\controllers;

			use todos\models\Todos;

			class TodosController extends \lithium\action\Controller {

				// ...
			}
		</pre>
	</section>

	<section>
		<h2>Putting it together: the backend</h2>

		<pre class="language-js">
			public function index() {
				$todos = Todos::all();
				return compact('todos');
			}

			public function add() {
				$todo = Todos::create($data = $this->request->data);

				if (($data) && $todo->save()) {
					if ($this->request->accepts() === 'html') {
						return $this->redirect(array(
							'Todos::view', 'id' => $todo->_id
						)));
					}
				}
				return compact('todo');
			}
		</pre>
	</section>

	<section>
		<h2 class="leader" style="text-align: center; padding-left: 0.8em;">Better:</h2>
	</section>


	<section>
		<h2>Putting it together: the backend</h2>

		<pre class="language-js">
			class <strong>Todos</strong> extends <strong>\li3_resources\action\Resource</strong> {

				public function index($request, $todos) {
					return $todos;
				}

				public function add($request, $todo) {
					$data = $request->data;
					return ($data) ? $todo->save($data) : $todo;
				}

				// ...
			}
		</pre>
	</section>


	<section>
		<h2>Putting it together: the backend</h2>

		<pre class="language-js">
			class Todos extends \li3_resources\action\Resource {

				// ...

				public function view($request, $todo) {
					return $todo;
				}

				public function edit($request, $todo) {
					$data = $request->data;
					return ($data) ? $todo->save($data) : $todo;
				}

				public function delete($request, $todo) {
					return $todo->delete();
				}
			}
		</pre>
	</section>


	<section>
		<h2>Examples</h2>

		<br />
		<ul>
			<li>
				<code>POST /session => </code>Log in
			</li>
			<li>
				<code>GET /session => </code>Get current user
			</li>
			<li>
				<code>DELETE /session => </code>Log out
			</li>
		</ul>
	</section>


	<section>
		<h2>Examples</h2>

		<pre class="language-js">
			class Session extends \li3_resources\action\Resource {

				protected $_binding = 'my_app\models\Users';

				protected $_methods = array(
					'GET'    => array('view' => null),
					'POST'   => array('add' => null),
					'DELETE' => array('delete' => null)
				);

				// ...
			}
		</pre>
	</section>


	<section>
		<h2>Examples</h2>

		<pre class="language-js">
			class Session extends \li3_resources\action\Resource {

				// ...

				protected $_parameters = array(
					'add' => array('session' => array(
						'call' => 'create', 'required' => false
					)),
					'delete' => array('session' => array(
						'call' => 'delete'
					))
				);

				// ...
			}
		</pre>
	</section>


	<section>
		<h2>Examples</h2>

		<pre class="language-js">
			class Session extends \li3_resources\action\Resource {

				// ...

				public function add($request, $session) {
					return $session ? array(true, $session) : 401;
				}

				public function view($request, $session) {
					return $session;
				}

				public function delete($request) {
					return 204;
				}
			}
		</pre>
	</section>


	<section>
		<h2>Examples</h2>

		<pre class="language-js">
			Resources::handlers(array(
				'session' => array(
					function($request, array $resource) {
						return $resource['binding']::current();
					},
					'create' => function($request, array $resource) {
						return $resource['binding']::current($request);
					},
					'delete' => function($request, array $resource) {
						return $resource['binding']::current(false);
					}
				)
			));
		</pre>
	</section>


	<section>
		<h2>Examples</h2>

		<pre class="language-js">
			class Users extends Base {

				// ...

				public static function current($request = null) {
					if ($request === false) {
						return Auth::clear('default');
					}
					if ($request) {
						$data = Auth::check('default', $request);
					} else {
						$data = Auth::check('default');
					}
					return $data ? static::create($data) : null;
				}
			}
		</pre>
	</section>


	<section>
		<h2>Future: Resource Links &amp; Nesting</h2>

		<pre class="language-js" ng:non-bindable>
			GET /posts/&lt;id&gt;
			{
				$links: {
					self: "http://app/posts/&lt;id&gt;",
					author: "http://app/users/&lt;user-id&gt;",
					comments: "http://app/posts/&lt;id&gt;/comments"
				},
				...
			 }

			var user = post.$author();
			var comments = post.$comments();
		</pre>
	</section>


	<section>
		<h2>Future</h2>

		<br />
		<ul>
			<li>
				<code>li3_docs</code> integration for API documentation via <code>OPTIONS</code>
				(inspiration: <a href="http://twitter.com/CaseySoftware">@CaseySoftware</a>)
			</li>
		</ul>
	</section>


	<section>
		<h2>Release: Lithium 0.11</h2>

		<ul>
			<li>~700 commits</li>
			<li>&gt; 60 contributors</li>
			<li>~16 months</li>
			<li><a href="https://github.com/UnionOfRAD/lithium/wiki/Releases-0.11">Changelog</a></li>
		</ul>
	</section>


	<section>
		<h2>Links</h2>

		<ul>
			<li><a href="http://lithify.me">lithify.me</a>: Lithium</li>
			<li><a href="http://angularjs.org">angularjs.org</a>: AngularJS</li>
			<li>
				<a href="http://github.com/nateabele/li3_resources">
					github.com/nateabele/li3_resources</a>: li3_resources
			</li>
			<li>
				<a href="https://github.com/nateabele/li3-angular-presentation">
					github.com/nateabele/li3-angular-presentation</a>: This talk
			</li>
		</ul>
	</section>
</div>
