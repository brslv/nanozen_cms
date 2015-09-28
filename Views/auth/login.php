<?php 
	use \Nanozen\Utilities\Html\Form; 
	use \Nanozen\Providers\Session\SessionProvider as Session;
?>
<?php app_header() ?>
<?php app_navigation(); ?>

	<main class="app-main">
		<div class="container">

			<h2>Login</h2>

			<?php if (Session::has('flash_message')) : ?>
				<?php foreach(Session::flash('flash_message') as $flash) : ?>
					<div class="alert alert-warning">
						<?= $flash; ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

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