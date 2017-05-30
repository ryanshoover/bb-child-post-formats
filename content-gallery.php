<?php

$show_thumbs = FLTheme::get_setting('fl-archive-show-thumbs');
$show_full   = apply_filters( 'fl_archive_show_full',  FLTheme::get_setting( 'fl-archive-show-full' ) );
$more_text   = FLTheme::get_setting('fl-archive-readmore-text');
$thumb_size  = FLTheme::get_setting('fl-archive-thumb-size');

$gallery     = get_post_meta( get_the_ID(), 'fl-child-gallery', true );

$gallery_html  = '';
$gallery_html .= '<div class="fl-mosaicflow">';
$gallery_html .= '<div class="fl-mosaicflow-content">';

foreach ( (array) $gallery as $id => $url ) {
	$img = wp_get_attachment_image( $id, 'medium' );

	$has_file_type = preg_match( '/.*\.(\w{2,4})/', $url, $matches );

	$file_type = $has_file_type ? $matches[1] : 'jpg';

	$gallery_html .= <<<HTML
		<div class="fl-mosaicflow-item">
			<div class="fl-photo fl-photo-align-center" itemscope="" itemtype="http://schema.org/ImageObject">
				<div class="fl-photo-content fl-photo-img-{$file_type}">
					{$img}
				</div>
			</div>
		</div>

HTML;

}

$gallery_html .= '</div>';
$gallery_html .= '<div class="fl-clear clearfix"></div>';
$gallery_html .= '</div>';

$gallery_html = sprintf( '<div class="fl-post-format fl-post-format-gallery">%s</div>', $gallery_html );

$gallery_js = <<<JAVASCRIPT
	jQuery('.fl-post-format-gallery .fl-mosaicflow-content').mosaicflow({
		itemSelector: '.fl-mosaicflow-item',
		columnClass: 'fl-mosaicflow-col',
		minItemWidth: 300
	});
JAVASCRIPT;

wp_add_inline_script( 'jquery-mosaicflow', $gallery_js );

do_action( 'fl_before_post' ); ?>

<article <?php post_class( 'fl-post' ); ?> id="fl-post-<?php the_ID(); ?>" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">

	<?php if ( ( $gallery_html || has_post_thumbnail() ) && ! empty( $show_thumbs ) ) : ?>
		<?php if ( $show_thumbs == 'above-title' ) : ?>
		<div class="fl-post-thumb">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php echo $gallery_html ?: get_the_post_thumbnail( 'large', [ 'itemprop' => 'image' ] ); ?>
			</a>
		</div>
		<?php endif; ?>
	<?php endif; ?>

	<header class="fl-post-header">
		<h2 class="fl-post-title" itemprop="headline">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			<?php edit_post_link( _x( 'Edit', 'Edit post link text.', 'fl-automator' ) ); ?>
		</h2>
		<?php FLTheme::post_top_meta(); ?>
	</header><!-- .fl-post-header -->

	<?php if ( ( $gallery_html || has_post_thumbnail() ) && ! empty( $show_thumbs ) ) : ?>

		<?php if ( $show_thumbs == 'above' ) : ?>
		<div class="fl-post-thumb">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php echo $gallery_html ?: get_the_post_thumbnail( 'large' ); ?>
			</a>
		</div>
		<?php endif; ?>

		<?php if ( $show_thumbs == 'beside' ) : ?>
		<div class="row">
			<div class="fl-post-image-<?php echo $show_thumbs; ?>">
				<div class="fl-post-thumb">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
						<?php echo $gallery_html ?: get_the_post_thumbnail( $thumb_size ); ?>
					</a>
				</div>
			</div>
			<div class="fl-post-content-<?php echo $show_thumbs; ?>">
		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'fl_before_post_content' ); ?>

	<div class="fl-post-content clearfix" itemprop="text">
		<?php

		if ( is_search() || ! $show_full ) {
			the_excerpt();
			echo '<a class="fl-post-more-link" href="'. get_permalink() .'">'. $more_text .'</a>';
		}
		else {
			the_content( '<span class="fl-post-more-link">' . $more_text . '</span>' );
		}

		?>
	</div><!-- .fl-post-content -->

	<?php FLTheme::post_bottom_meta(); ?>

	<?php do_action( 'fl_after_post_content' ); ?>

	<?php if ( has_post_thumbnail() && $show_thumbs == 'beside' ) : ?>
		</div>
	</div>
	<?php endif; ?>

</article>

<?php do_action( 'fl_after_post' ); ?>
<!-- .fl-post -->
