<?php

/* Content Panel */
FLCustomizer::add_panel('fl-child', array(
	'title'    => _x( 'Child Theme', 'Customizer panel title.', 'fl-automator' ),
	'sections' => array(

		/* Content Background Section */
		'fl-post-format' => array(
			'title'   => _x( 'Post Format', 'Customizer section title.', 'fl-automator' ),
			'options' => array(

				/* Show Full Text */
				'fl-post-format-location' => array(
					'setting'   => array(
						'default'   => 'content-above'
					),
					'control'   => array(
						'class'         => 'WP_Customize_Control',
						'label'         => __('Placement on the individual post', 'fl-automator'),
						'description'   => __('Where should the custom post format content be placed?', 'fl-automator'),
						'type'          => 'select',
						'choices'       => array(
							'post-above'       => __('Above the entire post', 'fl-automator'),
							'content-above'    => __('Above the post content', 'fl-automator'),
							'content-below'    => __('Below the post content', 'fl-automator'),
							'post-below'       => __('Below the entire post', 'fl-automator'),
						)
					)
				),
			)
		),
	)
) );
