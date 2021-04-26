<nav role="navigation" id="nav-page" aria-label="Page">
	<ul>
		<?php foreach ( $args['sections'] as $index => $section ) { ?>
			<li>
				<a href="#<?= slugify( $section ); ?>">
					<?= $section; ?>
				</a>
			</li>
		<?php } ?>
	</ul>

</nav>