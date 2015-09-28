<?php 
	use \Nanozen\Providers\Session\SessionProvider as Session; 
	use \Nanozen\Utilities\Html\Form;
?>
<?php include app_header(); ?>
<?php include app_navigation(); ?>
	
	<nav class="container">
		<ul class="nav nav-pills navbar-right">
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Pages <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="">About</a></li>
					<li><a href="">Projects</a></li>
					<li><a href="">Contacts</a></li>
				</ul>
			</li>

			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Blocks <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="">Add block</a></li>
					<li><a href="">Manage blocks</a></li>
				</ul>
			</li>

			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Users <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="">Manage users</a></li>
					<li><a href="">Manage editors</a></li>
				</ul>
			</li>

			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Settings <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="">Site title</a></li>
					<li><a href="">Site description</a></li>
				</ul>
			</li>

			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Profile <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="">Edit</a></li>
					<li><a href="">Change password</a></li>
					<li><a href="">Change email</a></li>
				</ul>
			</li>
		</ul>
	</nav>

	<hr />

	<main class="app-main">
		<div class="container">

			<h2>Welcome, <?= Session::get('username'); ?>.</h2>

			<hr />

			<?php include_once app_flash() ?>

			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Notes</h3>
						</div>
						<div class="panel-body">
							Here you can jot down stuff you need to remember.
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Quick links</h3>
						</div>
						<div class="panel-body">
							<ul>
								<li><a href="">Add new page</a></li>
								<li><a href="">Create block</a></li>
								<li><a href="">Edit profile</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="quote panel panel-default">
				<div class="panel-body">
					<h3><?= $quote; ?></h3>
				</div>
			</div>

		</div>
	</main>
<?php include app_footer(); ?>