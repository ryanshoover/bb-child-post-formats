<?php
/**
 * Partial content for video posts
 */

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

printf( '<div class="fl-post-format fl-post-format-gallery">%s</div>', $gallery_html );

$gallery_js = <<<JAVASCRIPT
	jQuery('.fl-post-format-gallery .fl-mosaicflow-content').mosaicflow({
		itemSelector: '.fl-mosaicflow-item',
		columnClass: 'fl-mosaicflow-col',
		minItemWidth: 300
	});
JAVASCRIPT;

wp_add_inline_script( 'jquery-mosaicflow', $gallery_js );
