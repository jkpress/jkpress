<?php
/**
 * Twenty Sixteen Theme: Block Patterns
 *
 * @package JKPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 2.3
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'twentysixteen',
		array( 'label' => __( 'Twenty Sixteen', 'twentysixteen' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	register_block_pattern(
		'twentysixteen/large-heading-short-description',
		array(
			'title'      => __( 'Large heading with short description', 'twentysixteen' ),
			'categories' => array( 'twentysixteen' ),
			'content'    => '<!-- jk:group {"align":"full","backgroundColor":"background"} -->
            <div class="jk-block-group alignfull has-background-background-color has-background"><div class="jk-block-group__inner-container"><!-- jk:spacer {"height":60} -->
            <div style="height:60px" aria-hidden="true" class="jk-block-spacer"></div>
            <!-- /jk:spacer -->
            <!-- jk:heading {"level":6,"style":{"typography":{"lineHeight":"1.5","fontSize":35}}} -->
            <h6 style="font-size:35px;line-height:1.5"><strong>' . esc_html__( 'Twenty Sixteen is a modern take on the horizontal masthead with an optional right sidebar. It works perfectly for JKPress websites and blogs.', 'twentysixteen' ) . '</strong></h6>
            <!-- /jk:heading -->
            <!-- jk:paragraph {"style":{"typography":{"lineHeight":"1.8"}}} -->
            <p style="line-height:1.8">' . esc_html__( 'Twenty Sixteen will make your JKPress website look beautiful everywhere. Take advantage of custom color options, beautiful default color schemes, a harmonious fluid grid using a mobile-first approach, and impeccable polish in every detail.', 'twentysixteen' ) . '</p>
            <!-- /jk:paragraph -->
            <!-- jk:spacer {"height":60} -->
            <div style="height:60px" aria-hidden="true" class="jk-block-spacer"></div>
            <!-- /jk:spacer --></div></div>
            <!-- /jk:group -->',
		)
	);

	register_block_pattern(
		'twentysixteen/big-title-two-columns-text',
		array(
			'title'      => __( 'Big Title with Two Columns Text', 'twentysixteen' ),
			'categories' => array( 'twentysixteen' ),
			'content'    => '<!-- jk:spacer -->
            <div style="height:100px" aria-hidden="true" class="jk-block-spacer"></div>
            <!-- /jk:spacer -->

            <!-- jk:heading {"level":1,"style":{"typography":{"fontSize":55}}} -->
            <h1 style="font-size:55px">' . esc_html__( 'Twenty Sixteen', 'twentysixteen' ) . '</h1>
            <!-- /jk:heading -->

            <!-- jk:spacer {"height":30} -->
            <div style="height:30px" aria-hidden="true" class="jk-block-spacer"></div>
            <!-- /jk:spacer -->

            <!-- jk:columns -->
            <div class="jk-block-columns"><!-- jk:column -->
            <div class="jk-block-column"><!-- jk:paragraph {"dropCap":true} -->
            <p class="has-drop-cap">' . esc_html__( 'Twenty Sixteen will make your JKPress website look beautiful everywhere. Take advantage of its custom color options and beautiful default color schemes.', 'twentysixteen' ) . '</p>
            <!-- /jk:paragraph --></div>
            <!-- /jk:column -->

            <!-- jk:column -->
            <div class="jk-block-column"><!-- jk:paragraph -->
            <p>' . esc_html__( 'The theme features a harmonious fluid grid using a mobile-first approach. The layout is a modern take on the horizontal masthead with an optional right sidebar.', 'twentysixteen' ) . '</p>
            <!-- /jk:paragraph --></div>
            <!-- /jk:column --></div>
            <!-- /jk:columns -->

            <!-- jk:spacer -->
            <div style="height:100px" aria-hidden="true" class="jk-block-spacer"></div>
            <!-- /jk:spacer -->',
		)
	);

	register_block_pattern(
		'twentysixteen/large-blockquote',
		array(
			'title'      => __( 'Large Blockquote', 'twentysixteen' ),
			'categories' => array( 'twentysixteen' ),
			'content'    => '<!-- jk:spacer -->
            <div style="height:100px" aria-hidden="true" class="jk-block-spacer"></div>
            <!-- /jk:spacer -->

            <!-- jk:separator {"color":"dark-gray","className":"is-style-wide"} -->
            <hr class="jk-block-separator has-text-color has-background has-dark-gray-background-color has-dark-gray-color is-style-wide"/>
            <!-- /jk:separator -->

            <!-- jk:heading {"style":{"typography":{"lineHeight":"1.5","fontSize":40}}} -->
            <h2 style="font-size:40px;line-height:1.5"><em>' . esc_html__( 'Twenty Sixteen will make your JKPress look beautiful everywhere.', 'twentysixteen' ) . '</em></h2>
            <!-- /jk:heading -->

            <!-- jk:paragraph {"textColor":"medium-gray"} -->
            <p class="has-medium-gray-color has-text-color">' . esc_html__( '— Takashi Irie', 'twentysixteen' ) . '</p>
            <!-- /jk:paragraph -->

            <!-- jk:spacer {"height":52} -->
            <div style="height:52px" aria-hidden="true" class="jk-block-spacer"></div>
            <!-- /jk:spacer -->

            <!-- jk:separator {"color":"dark-gray","className":"is-style-wide"} -->
            <hr class="jk-block-separator has-text-color has-background has-dark-gray-background-color has-dark-gray-color is-style-wide"/>
            <!-- /jk:separator -->

            <!-- jk:spacer -->
            <div style="height:100px" aria-hidden="true" class="jk-block-spacer"></div>
            <!-- /jk:spacer -->',
		)
	);

	register_block_pattern(
		'twentysixteen/call-to-action',
		array(
			'title'      => __( 'Call to Action', 'twentysixteen' ),
			'categories' => array( 'twentysixteen' ),
			'content'    => '<!-- jk:spacer -->
            <div style="height:100px" aria-hidden="true" class="jk-block-spacer"></div>
            <!-- /jk:spacer -->

            <!-- jk:separator {"color":"dark-gray","className":"is-style-wide"} -->
            <hr class="jk-block-separator has-text-color has-background has-dark-gray-background-color has-dark-gray-color is-style-wide"/>
            <!-- /jk:separator -->

            <!-- jk:heading {"level":1,"style":{"typography":{"fontSize":35,"lineHeight":"1.5"}}} -->
            <h1 style="font-size:35px;line-height:1.5">' . esc_html__( 'My new book “Twenty Sixteen” is available for pre-order.', 'twentysixteen' ) . '</h1>
            <!-- /jk:heading -->

            <!-- jk:columns -->
            <div class="jk-block-columns"><!-- jk:column -->
            <div class="jk-block-column"><!-- jk:buttons -->
            <div class="jk-block-buttons"><!-- jk:button {"borderRadius":0,"backgroundColor":"bright-blue"} -->
            <div class="jk-block-button"><a class="jk-block-button__link has-bright-blue-background-color has-background no-border-radius">' . esc_html__( 'Pre-Order Now', 'twentysixteen' ) . '</a></div>
            <!-- /jk:button --></div>
            <!-- /jk:buttons --></div>
            <!-- /jk:column -->

            <!-- jk:column -->
            <div class="jk-block-column"><!-- jk:spacer {"height":54} -->
            <div style="height:54px" aria-hidden="true" class="jk-block-spacer"></div>
            <!-- /jk:spacer --></div>
            <!-- /jk:column --></div>
            <!-- /jk:columns -->

            <!-- jk:spacer -->
            <div style="height:100px" aria-hidden="true" class="jk-block-spacer"></div>
            <!-- /jk:spacer -->',
		)
	);
}
