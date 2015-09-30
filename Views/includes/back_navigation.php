	<nav class="container">
		<ul class="nav nav-pills navbar-right">
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Pages <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="/pages/create">Add new page</a></li>
					<li role="separator" class="divider"></li>
					<li class="dropdown-header">Select page to edit:</li>
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
					<li><a href="">Add block</a></li>
					<li><a href="">Manage blocks</a></li>
				</ul>
			</li>

			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Users <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="">Manage users</a></li>
					<li><a href="">Manage editors</a></li>
				</ul>
			</li>

			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					Settings <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="">Site title</a></li>
					<li><a href="">Site description</a></li>
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