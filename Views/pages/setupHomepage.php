<?php 
	use \Nanozen\Utilities\Html\Form;
?>
<?php include app_header(); ?>
<?php include app_navigation(); ?>
<?php include app_back_navigation(); ?>

<main class="app-main">
	<div class="container">

		<h2>Choose homepage: </h2>
		
		<hr />

		<?php include_once app_flash(); ?>
        
        <?php 

            $dropdownOptions = [];

            foreach ($allPages as $pageInDropdown) {
                $dropdownOptions[$pageInDropdown->getId()] = $pageInDropdown->getTitle();
            }

        ?>
        
        <?php if ( ! empty($dropdownOptions)) : ?>
            <?= Form::start('/pages/homepage', 'POST'); ?>

                <div class="form-group">

                    <?= Form::dropdown('homepageId', $dropdownOptions, ['class' => 'form-control', 'placeholder' => 'Homepage']); ?>
                </div>
        
                <div class="form-group">
                    <?= Form::submit('setupHomepageButton', 'Choose', ['class' => 'btn btn-success']); ?>
                </div>

            <?= Form::stop(); ?>
        <?php else : ?>
            <div class="alert alert-warning">
                You don't have any pages. Go and <a class="btn btn-default btn-xs" href="/pages/create">create</a> some.
            </div>
        <?php endif; ?>

	</div>
</main>

<?php include app_footer(); ?>