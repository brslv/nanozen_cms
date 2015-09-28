<?php include_once app_header(); ?>

	<?php include_once app_navigation(); ?>

	<main class="app-main">
		<div class="container">
			<section class="jumbotron">
				<!-- Here is the welcome-block -->
				<h1>This is nano.</h1>
				<h3>A simple content management system.</h3>
			</section>

			<section class="app-content-section col-md-8">
				<!-- Here foreach contenct block -->
				<div class="content-block">
					<h2>This is an example content block.</h2>

					<p>
						Lorem Ipsum is simply dummy text of the printing and typesetting
						industry. Lorem Ipsum has been the industry's standard dummy text
						ever since the 1500s, when an unknown printer took a galley of type
						and scrambled it to make a type specimen book. It has survived not
						only five centuries, but also the leap into electronic typesetting,
						remaining essentially unchanged. It was popularised in the 1960s
						with the release of Letraset sheets containing Lorem Ipsum
						passages, and more recently with desktop publishing software like
						Aldus PageMaker including versions of Lorem Ipsum.
					</p>
				</div>
			</section>

			<aside class="app-sidebar col-md-4">
				<!-- Here foreach sidebar-block -->
				<h2>Sidebar</h2>
				<div class="panel panel-default">
					<div class="panel-heading">Panel heading without title</div>
					<div class="panel-body">
						<ul>
							<li><a href="">Friends 1</a></li>
							<li><a href="">Friends 2</a></li>
							<li><a href="">Friends 3</a></li>
						</ul>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">Panel heading without title</div>
					<div class="panel-body">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
					</div>
				</div>
			</aside>
		</div>
	</main>

<?php include_once app_footer(); ?>