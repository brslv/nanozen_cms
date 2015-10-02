	<nav class="container">
		<ul class="nav nav-pills navbar-right">
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Pages <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="/pages/homepage">Setup homepage</a></li>
					<li role="separator" class="divider"></li>
                    
					<li><a href="/pages/create">Add new page</a></li>
					<li role="separator" class="divider"></li>
					<li class="dropdown-header">Select other pages to edit:</li>
					<li role="separator" class="divider"></li>
					
                    <?php if (count($allPages) > 0) : ?>
                        <?php foreach ($allPages as $pageInMenu) : ?>
                            <li>
                                <a href=<?= '/pages/' . $pageInMenu->getId() . '/edit' ?>>
                                    <?php if ( ! $pageInMenu->getActive()) : ?>
                                        &mdash;&nbsp;
                                    <?php endif; ?>
                                    
                                    <?= $pageInMenu->getTitle(); ?>
                                        
                                    <?php if ( ! $pageInMenu->getActive()) : ?>
                                        &mdash;&nbsp;
                                    <?php endif; ?>
                                </a>
                            </li>	
                        <?php endforeach; ?>
                    <?php else : ?>
                            <p style="padding-left: 15px;">No pages to show.</p>
                    <?php endif; ?>
				</ul>
			</li>

			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Blocks <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
                    <?php foreach ($blockTypesTitles as $bt) : ?>
                    
                        <?php $blockTitle = str_replace('_', '-', $bt['title']); ?>
                    
                        <li><a href="/blocks/<?= $blockTitle ?>/create">Add new <?= $blockTitle; ?></a></li>
                    <?php endforeach; ?>
                    
                    <?php if (count($allBlocks) > 0) : ?>
                    	<?php  
                    		$previousPageTitle = $allBlocks[0]->getPageTitle();
							$itterations = 0;
                    	?>
                        <?php foreach ($allBlocks as $blockInMenu) : ?>

                        	<?php if ($previousPageTitle != $blockInMenu->getPageTitle() || $itterations == 0) : ?>
                        		<li role="separator" class="divider"></li>
                        		<li class="dropdown-header"><?= $blockInMenu->getPageTitle() ?></li>
                        		<li role="separator" class="divider"></li>
                        	<?php endif; ?>

                            <li>
                                <a href=<?= '/blocks/' . $blockInMenu->getId() . '/edit' ?>>
                                    <?php if ( ! $blockInMenu->getActive()) : ?>
                                        &mdash;&nbsp;
                                    <?php endif; ?>
                                    
                                    <?= $blockInMenu->getTitle(); ?>
                                        
                                    <?php if ( ! $blockInMenu->getActive()) : ?>
                                        &mdash;&nbsp;
                                    <?php endif; ?>
                                </a>
                            </li>
                            <?php
                            	$itterations++; 
                            	$previousPageTitle = $blockInMenu->getPageTitle();
                            ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                            <p style="padding-left: 15px;">No blocks to show.</p>
                    <?php endif; ?>
				</ul>
			</li>

			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Profile <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="">Edit</a></li>
					<li><a href="">Change password</a></li>
					<li><a href="">Change email</a></li>
				</ul>
			</li>
		</ul>
	</nav>

	<hr />