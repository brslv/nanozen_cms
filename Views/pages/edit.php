<?php 
	use \Nanozen\Utilities\Html\Form;
?>
<?php include app_header(); ?>
<?php include app_navigation(); ?>
<?php include app_back_navigation(); ?>

<main class="app-main">
	<div class="container">

		<h2>Edit page: <strong><?= $page->getTitle(); ?></strong></h2>
		
		<hr />

		<?php include_once app_flash(); ?>

		<?= Form::start('/pages', 'PUT'); ?>
			<div class="form-group">
				<?= Form::text('title', ['value' => $page->getTitle(), 'class' => 'form-control']); ?>
			</div>

			<div class="form-group">
				<?= Form::textarea('content', ['class' => 'form-control'], $page->getContent()); ?>
			</div>

			<div class="form-group">
				<?= Form::dropdown('active', [1 => 'Visible', 0 => 'Hidden'], ['class' => 'form-control', 'placeholder' => 'Status']); ?>
			</div>

			<div class="form-group">
				<?= Form::submit('editPageButton', 'Edit', ['class' => 'btn btn-success']); ?>
			</div>
		<?= Form::stop(); ?>

	</div>
</main>

<?php include app_footer(); ?>