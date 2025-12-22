<?php
$data = wp_parse_args($args, [
	'id' => '',
	'class' => '',
	'items' => [],
	'query' => null,
	'lazyload' => true,
	'svg_icon_after' => twmp_get_svg_icon('arrow'),
	'enable_container' => false
]);

$_class = !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
$_class .= $data['lazyload'] ? ' is-not-loaded' : '';

$_class_container = 'container';
$_class_container .= !empty($data['class_container']) ? esc_attr(' ' . $data['class_container']) : '';

$post_query = $data['query'] ? $data['query'] : null;

$_swiper_items = [];
while ($post_query->have_posts()) : $post_query->the_post();
	ob_start();

	get_template_part(
		'templates/post-card',
		null,
		array(
			'post_data' => get_post(get_the_ID()),
			'post_title_limit' => 10,
			'post_id' => get_the_ID(),
			'options' => [
				'show_excerpt' => false,
				'show_date' => false,
				'show_author' => false,
				'show_categories' => false
			]
		)
	);

	$content_html = ob_get_clean();

	$_swiper_items[] = [
		'class' => 'd-flex flex-column post-slider__slide',
		'content' => $content_html
	];
endwhile;
wp_reset_postdata();

?>

<div class="<?php echo esc_attr($_class); ?>" <?php if (!empty($data['id'])) : ?> id="<?php echo esc_attr($data['id']); ?>" <?php endif; ?> data-block="post-grid-slider">
	<div class="page-digital-hub-lastest-wrapper">
		<div class="page-digital-hub-lastest-container">
			<div class="d-flex justify-content-between page-search-common page-search-digital-hub">
				<?php
				get_template_part('templates/heading', null, [
					'title_class' => 'page-digital-hub-lastest__title',
					'description' => 'Our News & events',
					'description_class' => 'page-digital-hub-lastest__description',
					'class' => 'page-digital-hub-lastest__header d-flex flex-column-reverse',
					'title' => esc_html('Latest materials', 'twmp-vis')
				]);
				?>
			</div>
			<?php get_template_part('templates/swiper', null, [
				'items' => $_swiper_items,
				'lazyload' => !$data['lazyload'],
				'settings' => [
					'autoplay' => 10000,
					'pagination' => false,
					'prevNextButtons' => true,
					'prevSvgButton' => 'arrow-left',
					'nextSvgButton' => 'arrow-right'
				]
			]); ?>
		</div>
	</div>
</div>