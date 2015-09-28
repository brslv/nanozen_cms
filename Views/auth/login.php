<?php use \Nanozen\Utilities\Html\Form; ?>
<?php include_once app_header() ?>
<?php include_once app_navigation(); ?>

	<main class="app-main">
		<div class="container">

			<h2>Login</h2>

			<?php include_once app_flash() ?>

			<?= Form::start('/login', 'POST'); ?>
				<div class="form-group">
					<?= Form::text('username', ['class' => 'form-control', 'placeholder' => 'Username']); ?>
				</div>

				<div class="form-group">
					<?= Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']); ?>
				</div>

				<div class="form-group">
					<?= Form::submit('loginButton', 'Login', ['class' => 'btn btn-success']); ?>
				</div>
			<?= Form::stop(); ?>

		</div>
	</main>

<?php include_once app_footer(); ?>