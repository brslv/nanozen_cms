<?php 
	use \Nanozen\Providers\Session\SessionProvider as Session; 
	use \Nanozen\Utilities\Html\Form;
	use \Nanozen\Models\UserRoles;
?>
<?php include app_header(); ?>
<?php include app_navigation(); ?>
<?php include app_back_navigation_resolver(); ?>

	<main class="app-main">
		<div class="container">

			<h1 class="welcome-message">Welcome, <strong><?= $user->getUsername() ?></strong>.</h1>
			<h5 class="role-info">Your role is: <strong><?= $user->getRole(); ?></strong></h5>

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

							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua.

							<div style="padding-top: 20px;">
							<a href="" class="btn btn-sm btn-default">Edit</a>
							</div>
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