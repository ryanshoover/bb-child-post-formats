<?php

$show_thumbs = FLTheme::get_setting('fl-archive-show-thumbs');
$show_full   = apply_filters( 'fl_archive_show_full',  FLTheme::get_setting( 'fl-archive-show-full' ) );
$more_text   = FLTheme::get_setting('fl-archive-readmore-text');
$thumb_size  = FLTheme::get_setting('fl-archive-thumb-size');

$quote      = get_post_meta( get_the_ID(), 'fl-child-quote', true );
$quote_html = sprintf( '<p class="fl-post-format fl-post-format-quote">%s</p>', $quote );

do_action('fl_before_post'); ?>

<article <?php post_class( 'fl-post' ); ?> id="fl-post-<?php the_ID(); ?>" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">

	<?php if ( ( $quote_html || has_post_thumbnail() ) && ! empty( $show_thumbs ) ) : ?>
		<?php if ( $show_thumbs == 'above-title' ) : ?>
		<div class="fl-post-thumb">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php echo $quote_html ?: get_the_post_thumbnail( 'large', [ 'itemprop' => 'image' ] ); ?>
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

	<?php if ( ( $quote_html || has_post_thumbnail() ) && ! empty( $show_thumbs ) ) : ?>

		<?php if ( $show_thumbs == 'above' ) : ?>
		<div class="fl-post-thumb">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php echo $quote_html ?: get_the_post_thumbnail( 'large' ); ?>
			</a>
		</div>
		<?php endif; ?>

		<?php if ( $show_thumbs == 'beside' ) : ?>
		<div class="row">
			<div class="fl-post-image-<?php echo $show_thumbs; ?>">
				<div class="fl-post-thumb">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
						<?php echo $quote_html ?: get_the_post_thumbnail( $thumb_size ); ?>
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
