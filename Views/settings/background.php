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

			<h2>Change site background: </h2>

			<hr />

			<?php include_once app_flash() ?>

			<?php $token = Form::csrfToken(); ?>

			<div class="col-md-6" style="margin-bottom: 30px;">
				<?= Form::start('/settings/background/image', 'POST', ['enctype' => 'multipart/form-data'], false) ?>
					<?= Form::hidden('_token', $token); ?>

					<div class="panel panel-default">
						<div class="panel-heading">Choose background image: </div>

						<div class="panel-body">
							<?= Form::input('file', ['name' => 'app_background_image', 'class' => 'form-control']); ?>
						</div>
					</div>

					<?= Form::submit('imageBackground', 'Upload and save', ['class' => 'btn btn-success']); ?>
				<?= Form::stop(); ?>
			</div>

			<div class="col-md-6">
				<?= Form::start('/settings/background/color', 'POST', ['enctype' => 'multipart/form-data'], false); ?>
					<?= Form::hidden('_token', $token); ?>

					<div class="panel panel-default">
						<div class="panel-heading">Choose background color: </div>

						<div class="panel-body">
							<?= Form::text('app_background_color', ['class' => 'form-control', 'value' => $app_background_color], $app_background_color); ?>
						</div>
					</div>

					<?= Form::submit('colorBackground', 'Save', ['class' => 'btn btn-success']); ?>
				<?= Form::stop(); ?>
			</div>

		</div>
	</main>
<?php include app_footer(); ?>