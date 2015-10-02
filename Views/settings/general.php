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

			<h2>General settings</h2>

			<hr />

			<?php include_once app_flash() ?>

			<?= Form::start('/settings/general', 'POST') ?>
				<div class="panel panel-default">
					<div class="panel-heading">Site title: </div>

					<div class="panel-body">
						<?= Form::text('app_title', ['class' => 'form-control', 'value' => $app_title]); ?>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Site description: </div>

					<div class="panel-body">
						<?= Form::text('app_description', ['class' => 'form-control', 'value' => $app_description]); ?>
					</div>
				</div>

				<?= Form::submit('generalSettingsButton', 'Save', ['class' => 'btn btn-success']); ?>
			<?= Form::stop(); ?>

		</div>
	</main>
<?php include app_footer(); ?>