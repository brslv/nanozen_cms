<?php use \Nanozen\Utilities\Html\Form; ?>
<?php app_header() ?>
<?php app_navigation(); ?>

	<main class="app-main">
		<div class="container">

			<h2>Login</h2>

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

<?php app_footer(); ?>