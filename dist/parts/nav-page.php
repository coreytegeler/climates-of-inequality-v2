<nav role="navigation" id="nav-page" aria-label="Page">
	<ul>
		<?php foreach ( $args['sections'] as $index => $section ) { ?>
			<li>
				<a href="#<?= slugify( $section ); ?>" class="arrow-link">
					<?= $section; ?>
				</a>
			</li>
		<?php } ?>
	</ul>

</nav>