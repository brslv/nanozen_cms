<?php 
	use \Nanozen\Utilities\Html\Form;
?>
<?php include app_header(); ?>
<?php include app_navigation(); ?>
<?php include app_back_navigation(); ?>

<main class="app-main">
	<div class="container">
        
		<h2>Edit block</h2>
		
		<hr />
        
        <?php include_once app_flash() ?>

        <?= Form::start('/blocks/' . $block->getId(), 'PUT'); ?>
        
            <?= Form::hidden('blockTypeId', 2) ?>
        
            <div class="form-group">
                <?= Form::text('title', ['class' => 'form-control', 'placeholder' => 'Block title', 'value' => $block->getTitle()]); ?>
            </div>
        
            <div class="form-group">
                <?= Form::text('description', ['class' => 'form-control', 'placeholder' => 'Short description', 'value' => $block->getDescription()]); ?>
            </div>
        
            <div class="form-group">
                <?= Form::textarea('content', ['class' => 'form-control', 'placeholder' => 'Content'], $block->getContent()); ?>
            </div>
        
            <div class="form-group">
                <lable class="form-control-static" for="pageId">Attach to page: </lable>
            </div>
        
            <div class="form-group">
                <?php 
                
                    $dropdownOptions = [];
                
                    foreach ($allPages as $pageInDropdown) {
                        $dropdownOptions[$pageInDropdown->getId()] = $pageInDropdown->getTitle();
                    }
                
                ?>
                
                <?= Form::dropdown('pageId', $dropdownOptions, ['class' => 'form-control'], $block->getPageId()) ?>
            </div>
        
            <div class="form-group">
                <lable class="form-control-static" for="region">Region: </lable>
            </div>
        
            <div class="form-group">
                <?php 
                
                    $regionOptions = [];
                
                    foreach ($regions as $region) {
                        $regionOptions[$region['region']] = $region['description'];
                    }
                
                ?>
                
                <?= Form::dropdown('region', $regionOptions, ['class' => 'form-control'], $block->getRegion()) ?>
            </div>
        
            <div class="form-group">
                <?= Form::submit('editContentBox', 'Edit', ['class' => 'btn btn-success']); ?>
            </div>
        
        <?= Form::stop(); ?>

	</div>
</main>

<?php include app_footer(); ?>