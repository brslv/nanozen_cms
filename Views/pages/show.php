<?php include_once app_header(); ?>

	<?php include_once app_navigation(); ?>

	<main class="app-main">
        <?php if (isset($blocks) && ! empty($blocks['regionOne'])) : ?>
            <section class="jumbotron">
                <div class="container">
                    <?php foreach ($blocks['regionOne'] as $block) : ?>

                        <p>
                            <?= $block->getContent(); ?>
                        </p>

                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
        
		<div class="container">
            
            <?php if (isset($blocks) && ! empty($blocks['regionTwo'])) : ?>
                <section class="app-content-section <?= ! empty($blocks['regionThree']) ? 'col-md-8' : 'col-md-12'; ?>">
                    <div class="content-block">
                        <?php foreach ($blocks['regionTwo'] as $block) : ?>

                            <p>
                                <?= $block->getContent(); ?>
                            </p>

                        <?php endforeach; ?>
                    </div>
                </section>
            <?php else : ?>
                <?php if (empty($blocks['regionOne']) && empty($blocks['regionThree'])) : ?>
                    <h3 class="col-md-8">Nothing to display here. Sad story...</h3>
                <?php endif; ?>
            <?php endif; ?>
                
                
            <?php if (isset($blocks) && ! empty($blocks['regionThree'])) : ?>
                <aside class="app-sidebar col-md-4">
                    <div class="content-block">
                        <?php foreach ($blocks['regionThree'] as $block) : ?>
                            <div class="well">
                                <?= $block->getContent(); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </aside>
            <?php endif; ?>
		</div>
	</main>

<?php include_once app_footer(); ?>