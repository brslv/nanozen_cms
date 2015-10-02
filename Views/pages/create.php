<?php 
	use \Nanozen\Utilities\Html\Form;
?>
<?php include app_header(); ?>
<?php include app_navigation(); ?>
<?php include app_back_navigation_resolver(); ?>

<main class="app-main">
	<div class="container">

		<h2>Create page</h2>
		
		<hr />

		<?php include_once app_flash(); ?>

		<?= Form::start('/pages', 'POST'); ?>
			<div class="form-group">
				<?= Form::text('title', ['class' => 'form-control', 'placeholder' => 'Title']); ?>
			</div>
        
			<div class="form-group">
				<?= Form::dropdown('active', [1 => 'Visible', 0 => 'Hidden'], ['class' => 'form-control', 'placeholder' => 'Status']); ?>
			</div>

			<div class="form-group">
				<?= Form::submit('createPageButton', 'Create', ['class' => 'btn btn-success']); ?>
			</div>
		<?= Form::stop(); ?>

	</div>
</main>

<?php include app_footer(); ?>