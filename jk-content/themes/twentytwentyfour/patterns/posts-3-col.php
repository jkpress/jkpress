<?php
/**
 * Title: List of posts, 3 columns
 * Slug: twentytwentyfour/posts-3-col
 * Categories: query
 * Block Types: core/query
 * Description: A list of posts, 3 columns.
 */
?>

<!-- jk:query {"query":{"perPage":10,"pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide","layout":{"type":"default"}} -->
<div class="jk-block-query alignwide">
	<!-- jk:query-no-results -->
	<!-- jk:pattern {"slug":"twentytwentyfour/hidden-no-results"} /-->
	<!-- /jk:query-no-results -->

	<!-- jk:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
	<div class="jk-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--jk--preset--spacing--50);padding-right:0;padding-bottom:var(--jk--preset--spacing--50);padding-left:0">

		<!-- jk:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","columnCount":3}} -->

		<!-- jk:post-featured-image {"isLink":true,"aspectRatio":"3/4","style":{"spacing":{"margin":{"bottom":"0"},"padding":{"bottom":"var:preset|spacing|20"}}}} /-->

		<!-- jk:group {"style":{"spacing":{"blockGap":"10px","margin":{"top":"var:preset|spacing|20"},"padding":{"top":"0"}}},"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"}} -->
		<div class="jk-block-group" style="margin-top:var(--jk--preset--spacing--20);padding-top:0">
			<!-- jk:post-title {"isLink":true,"style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}},"fontSize":"large"} /-->

			<!-- jk:template-part {"slug":"post-meta"} /-->

			<!-- jk:post-excerpt {"style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}},"textColor":"contrast-2","fontSize":"small"} /-->

			<!-- jk:spacer {"height":"0px","style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}}} -->
			<div style="height:0px" aria-hidden="true" class="jk-block-spacer">
			</div>
			<!-- /jk:spacer -->
		</div>
		<!-- /jk:group -->

		<!-- /jk:post-template -->

		<!-- jk:spacer {"height":"var:preset|spacing|40","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
		<div style="margin-top:0;margin-bottom:0;height:var(--jk--preset--spacing--40)" aria-hidden="true" class="jk-block-spacer"></div>
		<!-- /jk:spacer -->

		<!-- jk:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"space-between"}} -->
		<!-- jk:query-pagination-previous /-->
		<!-- jk:query-pagination-next /-->
		<!-- /jk:query-pagination -->

	</div>
	<!-- /jk:group -->
</div>
<!-- /jk:query -->
