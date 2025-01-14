<?php
/**
 * Title and button header block pattern
 */
return array(
	'title'      => __( 'Title and button header', 'twentytwentytwo' ),
	'categories' => array( 'header' ),
	'blockTypes' => array( 'core/template-part/header' ),
	'content'    => '<!-- jk:group {"align":"full","layout":{"inherit":true}} -->
					<div class="jk-block-group alignfull"><!-- jk:group {"align":"wide","style":{"spacing":{"padding":{"bottom":"var(--jk--custom--spacing--large, 8rem)","top":"var(--jk--custom--spacing--small, 1.25rem)"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
					<div class="jk-block-group alignwide" style="padding-top:var(--jk--custom--spacing--small, 1.25rem);padding-bottom:var(--jk--custom--spacing--large, 8rem)"><!-- jk:site-title {"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}},"typography":{"fontStyle":"normal","fontWeight":"700"}}} /-->

					<!-- jk:navigation {"layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right"},"overlayMenu":"always"} -->
					<!-- jk:page-list {"isNavigationChild":true,"showSubmenuIcon":true,"openSubmenusOnClick":false} /-->
					<!-- /jk:navigation --></div>
					<!-- /jk:group --></div>
					<!-- /jk:group -->',
);
