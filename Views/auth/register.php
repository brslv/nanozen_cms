<?php use \Nanozen\Utilities\Html\Form; ?>
<?php app_header() ?>
<?php app_navigation(); ?>

	<main class="app-main">
		<div class="container">

			<h2>Register</h2>

			<?= Form::start('/register', 'POST'); ?>
				<div class="form-group">
					<?= Form::text('username', ['class' => 'form-control', 'placeholder' => 'Username']); ?>
				</div>

				<div class="form-group">
					<?= Form::email('email', ['class' => 'form-control', 'placeholder' => 'Email']); ?>
				</div>

				<div class="form-group">
					<?= Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']); ?>
				</div>

				<div class="form-group">
					<?= Form::submit('registerButton', 'Register', ['class' => 'btn btn-success']); ?>
				</div>
			<?= Form::stop(); ?>

		</div>
	</main>

<?php app_footer(); ?>