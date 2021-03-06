<?php 
	use \Nanozen\Utilities\Html\Form;
?>
<?php include app_header(); ?>
<?php include app_navigation(); ?>
<?php include app_back_navigation_resolver(); ?>

<main class="app-main">
	<div class="container">
        
		<h2>Edit page: <strong><?= $page->getTitle(); ?></strong></h2>
		
		<hr />

		<?php include_once app_flash(); ?>
        <?php $csrf = Form::csrfToken(); ?>

		<?= Form::start('/pages/' . $page->getId(), 'PUT', null, false); ?>
            <?= Form::hidden('_token', $csrf); ?>
        
			<div class="form-group">
				<?= Form::text('title', ['value' => $page->getTitle(), 'class' => 'form-control']); ?>
			</div>

			<div class="form-group">
				<?= Form::dropdown('active', [1 => 'Visible', 0 => 'Hidden'], ['class' => 'form-control', 'placeholder' => 'Status'], $page->getActive()); ?>
			</div>

			<div class="form-group">
				<?= Form::submit('editPageButton', 'Edit', ['class' => 'btn btn-success']); ?>
			</div>
		<?= Form::stop(); ?>
        
        <?= Form::start('/pages/' . $page->getId() . '/delete', 'DELETE', null, false) ?>
        
            <?= Form::hidden('_token', $csrf); ?>
        
            <div class="form-group">
                <button class="btn btn-danger" type="submit">Delete</button>
			</div>
        
        <?= Form::stop() ?>

	</div>
</main>

<?php include app_footer(); ?>