<?php 
	use \Nanozen\Utilities\Html\Form;
?>
<?php include app_header(); ?>
<?php include app_navigation(); ?>
<?php include app_back_navigation_resolver(); ?>

<main class="app-main">
	<div class="container">
        
        <h2>Edit block <strong><?= $block->getPageTitle() . ' &bull; ' . $block->getTitle(); ?></strong> (content-box)</h2>
		
		<hr />
        
        <?php include_once app_flash() ?>

        <?php $csrf = Form::csrfToken(); ?>
        
        <?= Form::start('/blocks/' . $block->getId(), 'PUT', null, false); ?>
        
            <?= Form::hidden('_token', $csrf); ?>
        
            <?= Form::hidden('blockTypeId', 2) ?>
        
            <div class="form-group">
                <?= Form::text('title', ['class' => 'form-control', 'placeholder' => 'Block title', 'value' => $block->getTitle()]); ?>
            </div>
        
            <div class="form-group">
                <?= Form::text('description', ['class' => 'form-control', 'placeholder' => 'Short description', 'value' => $block->getDescription()]); ?>
            </div>
        
            <div class="form-group">
                <?= Form::textarea('content', ['class' => 'form-control', 'id' => 'ck', 'placeholder' => 'Content'], $block->getContent()); ?>
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
                
                <?= Form::dropdown('pageId', $dropdownOptions, ['class' => 'form-control'], $block->getPageId()) ?>
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
                
                <?= Form::dropdown('region', $regionOptions, ['class' => 'form-control'], $block->getRegion()) ?>
            </div>
        
            <div class="form-group">
                <label for="region">Block status: </label>
            </div>
        
            <div class="form-group">
				<?= Form::dropdown('active', [1 => 'Visible', 0 => 'Hidden'], ['class' => 'form-control'], $block->getActive()); ?>
			</div>
            
            <div class="form-group">
                <?= Form::submit('editContentBox', 'Edit', ['class' => 'btn btn-success']); ?>
            </div>
        
        <?= Form::stop(); ?>
        
        <?= Form::start('/blocks/' . $block->getId() . '/delete', 'DELETE', null, false) ?>
        
            <?= Form::hidden('_token', $csrf); ?>
        
            <div class="form-group">
                <button class="btn btn-danger" type="submit">Delete</button>
			</div>
        
        <?= Form::stop() ?>

	</div>
</main>

<?php include app_footer(); ?>