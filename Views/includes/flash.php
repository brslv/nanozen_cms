<?php use \Nanozen\Providers\Session\SessionProvider as Session; ?>

<?php if (Session::flash()) : ?>
	<?php foreach(Session::flash('flash_messages') as $flash) : ?>
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?= $flash; ?>
		</div>
	<?php endforeach; ?>
<?php endif; ?>