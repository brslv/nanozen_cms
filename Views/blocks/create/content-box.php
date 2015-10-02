<?php 
	use \Nanozen\Utilities\Html\Form;
?>
<?php include app_header(); ?>
<?php include app_navigation(); ?>
<?php include app_back_navigation_resolver(); ?>

<main class="app-main">
	<div class="container">
        
		<h2>Create block of type <strong>content-box</strong></h2>
		
		<hr />
        
        <?php include_once app_flash() ?>

        <?= Form::start('/blocks/store/content-box', 'POST'); ?>
        
            <?= Form::hidden('blockTypeId', 2) ?>
        
            <div class="form-group">
                <?= Form::text('title', ['class' => 'form-control', 'placeholder' => 'Block title']); ?>
            </div>
        
            <div class="form-group">
                <?= Form::text('description', ['class' => 'form-control', 'placeholder' => 'Short description']); ?>
            </div>
        
            <div class="form-group">
                <?= Form::textarea('content', ['class' => 'form-control', 'id' => 'ck', 'placeholder' => 'Content']); ?>
            </div>
        
            <div class="form-group">
                <label for="pageId">Attach to page: </label>
            </div>
        
            <div class="form-group">
                <?php 
                
                    $dropdownOptions = [];
                
                    foreach ($allPages as $pageInDropdown) {
                        $dropdownOptions[$pageInDropdown->getId()] = $pageInDropdown->getTitle();
                    }
                
                ?>
                
                <?= Form::dropdown('pageId', $dropdownOptions, ['class' => 'form-control']) ?>
            </div>
        
            <div class="form-group">
                <label for="region">Region: </label>
            </div>
        
            <div class="form-group">
                <?php 
                
                    $regionOptions = [];
                
                    foreach ($regions as $region) {
                        $regionOptions[$region['region']] = $region['description'];
                    }
                
                ?>
                
                <?= Form::dropdown('region', $regionOptions, ['class' => 'form-control']) ?>
            </div>
            
            <div class="form-group">
                <label for="region">Block status: </label>
            </div>
        
            <div class="form-group">
				<?= Form::dropdown('active', [1 => 'Visible', 0 => 'Hidden'], ['class' => 'form-control']); ?>
			</div>
        
            <div class="form-group">
                <?= Form::submit('createContentBox', 'Add', ['class' => 'btn btn-success']); ?>
            </div>
        
        <?= Form::stop(); ?>

	</div>
</main>

<?php include app_footer(); ?>