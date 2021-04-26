<?php
$page = $post;
?>
<div id="cover-image" <?= post_bg( $page ); ?>>

	<div class="highlight-text">
		<div>
			<?= wpautop( $page->post_content ); ?>
		</div>
	</div>

</div>