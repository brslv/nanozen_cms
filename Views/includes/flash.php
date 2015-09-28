<?php use \Nanozen\Providers\Session\SessionProvider as Session; ?>

<?php if (Session::flash()) : ?>
	<?php foreach(Session::flash('flash_messages') as $flash) : ?>
		<div class="alert alert-warning">
			<?= $flash; ?>
		</div>
	<?php endforeach; ?>
<?php endif; ?>