<?php
$page = get_trans( 'about' );
$home_page = get_trans( 'home' );
$hn_page = get_trans( 'happening-now' );
$video = get_field( 'video', $home_page );
$video_still = get_field( 'video_still', $home_page );
?>
<div class="cover-image" <?= media_bg( $video_still['ID'], 'large' ); ?>>
	<video src="<?= $video; ?>" poster="<?= $video_still['sizes']['large']; ?>" id="home-video" nocontrols></video>
	<!-- <button class="button" id="home-video-button"> -->
		<?#= pll__( 'Watch Full Video' ); ?>
	<!-- </button> -->
</div>

<div class="row flex-direction-column">
	<div class="container pt-nav mt-md mt-lg-0 mb-auto d-none d-md-block">
		<a href="<?= get_permalink( $hn_page ); ?>" class="hn-button mt-lg">
			<div><?= pll__( 'What\'s Happening Now?' ); ?></div>
		</a>
	</div>

	<div class="container highlight-text d-flex align-items-center mt-0">
		<div class="row pt-md pb-md">
			<div class="col col-12 col-md-10 col-lg-8 col-xl-6 offset-xl-6 xl-text">
				<?= wpautop( $home_page->post_content ); ?>
			</div>
		</div>
	</div>
</div>

<a href="<?= get_permalink( $page ); ?>" id="home-video-button" class="button">
	<?= pll__( 'Watch Full Video' ); ?>
</a>