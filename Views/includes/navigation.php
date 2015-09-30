<?php use \Nanozen\Providers\Session\SessionProvider as Session; ?>
<header>
	<nav class="navbar navbar-default">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><strong><?= $appTitle; ?></strong></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
                    <?php foreach ($activePages as $page) : ?>
                        <li><a href="/"><?= $page->getTitle(); ?></a></li>
                    <?php endforeach; ?>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<?php if (Session::has('username')) : ?>
						<li><a href="/back">Control panel</a></li>
						<li><a href="/logout">Logout</a></li>
					<?php else: ?>
						<li><a href="/register">Register</a></li>
						<li><a href="/login">Login</a></li>
					<?php endif; ?>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
</header>