<?php
/**
 * Post API: JK_Post class
 *
 * @package JKPress
 * @subpackage Post
 * @since 4.4.0
 */

/**
 * Core class used to implement the JK_Post object.
 *
 * @since 3.5.0
 *
 * @property string $page_template
 *
 * @property-read int[]    $ancestors
 * @property-read int[]    $post_category
 * @property-read string[] $tags_input
 */
#[AllowDynamicProperties]
final class JK_Post {

	/**
	 * Post ID.
	 *
	 * @since 3.5.0
	 * @var int
	 */
	public $ID;

	/**
	 * ID of post author.
	 *
	 * A numeric string, for compatibility reasons.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_author = 0;

	/**
	 * The post's local publication time.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_date = '0000-00-00 00:00:00';

	/**
	 * The post's GMT publication time.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_date_gmt = '0000-00-00 00:00:00';

	/**
	 * The post's content.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_content = '';

	/**
	 * The post's title.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_title = '';

	/**
	 * The post's excerpt.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_excerpt = '';

	/**
	 * The post's status.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_status = 'publish';

	/**
	 * Whether comments are allowed.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $comment_status = 'open';

	/**
	 * Whether pings are allowed.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $ping_status = 'open';

	/**
	 * The post's password in plain text.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_password = '';

	/**
	 * The post's slug.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_name = '';

	/**
	 * URLs queued to be pinged.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $to_ping = '';

	/**
	 * URLs that have been pinged.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $pinged = '';

	/**
	 * The post's local modified time.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_modified = '0000-00-00 00:00:00';

	/**
	 * The post's GMT modified time.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_modified_gmt = '0000-00-00 00:00:00';

	/**
	 * A utility DB field for post content.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_content_filtered = '';

	/**
	 * ID of a post's parent post.
	 *
	 * @since 3.5.0
	 * @var int
	 */
	public $post_parent = 0;

	/**
	 * The unique identifier for a post, not necessarily a URL, used as the feed GUID.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $guid = '';

	/**
	 * A field used for ordering posts.
	 *
	 * @since 3.5.0
	 * @var int
	 */
	public $menu_order = 0;

	/**
	 * The post's type, like post or page.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_type = 'post';

	/**
	 * An attachment's mime type.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $post_mime_type = '';

	/**
	 * Cached comment count.
	 *
	 * A numeric string, for compatibility reasons.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $comment_count = 0;

	/**
	 * Stores the post object's sanitization level.
	 *
	 * Does not correspond to a DB field.
	 *
	 * @since 3.5.0
	 * @var string
	 */
	public $filter;

	/**
	 * Retrieve JK_Post instance.
	 *
	 * @since 3.5.0
	 *
	 * @global jkdb $jkdb JKPress database abstraction object.
	 *
	 * @param int $post_id Post ID.
	 * @return JK_Post|false Post object, false otherwise.
	 */
	public static function get_instance( $post_id ) {
		global $jkdb;

		$post_id = (int) $post_id;
		if ( ! $post_id ) {
			return false;
		}

		$_post = jk_cache_get( $post_id, 'posts' );

		if ( ! $_post ) {
			$_post = $jkdb->get_row( $jkdb->prepare( "SELECT * FROM $jkdb->posts WHERE ID = %d LIMIT 1", $post_id ) );

			if ( ! $_post ) {
				return false;
			}

			$_post = sanitize_post( $_post, 'raw' );
			jk_cache_add( $_post->ID, $_post, 'posts' );
		} elseif ( empty( $_post->filter ) || 'raw' !== $_post->filter ) {
			$_post = sanitize_post( $_post, 'raw' );
		}

		return new JK_Post( $_post );
	}

	/**
	 * Constructor.
	 *
	 * @since 3.5.0
	 *
	 * @param JK_Post|object $post Post object.
	 */
	public function __construct( $post ) {
		foreach ( get_object_vars( $post ) as $key => $value ) {
			$this->$key = $value;
		}
	}

	/**
	 * Isset-er.
	 *
	 * @since 3.5.0
	 *
	 * @param string $key Property to check if set.
	 * @return bool
	 */
	public function __isset( $key ) {
		if ( 'ancestors' === $key ) {
			return true;
		}

		if ( 'page_template' === $key ) {
			return true;
		}

		if ( 'post_category' === $key ) {
			return true;
		}

		if ( 'tags_input' === $key ) {
			return true;
		}

		return metadata_exists( 'post', $this->ID, $key );
	}

	/**
	 * Getter.
	 *
	 * @since 3.5.0
	 *
	 * @param string $key Key to get.
	 * @return mixed
	 */
	public function __get( $key ) {
		if ( 'page_template' === $key && $this->__isset( $key ) ) {
			return get_post_meta( $this->ID, '_jk_page_template', true );
		}

		if ( 'post_category' === $key ) {
			if ( is_object_in_taxonomy( $this->post_type, 'category' ) ) {
				$terms = get_the_terms( $this, 'category' );
			}

			if ( empty( $terms ) ) {
				return array();
			}

			return jk_list_pluck( $terms, 'term_id' );
		}

		if ( 'tags_input' === $key ) {
			if ( is_object_in_taxonomy( $this->post_type, 'post_tag' ) ) {
				$terms = get_the_terms( $this, 'post_tag' );
			}

			if ( empty( $terms ) ) {
				return array();
			}

			return jk_list_pluck( $terms, 'name' );
		}

		// Rest of the values need filtering.
		if ( 'ancestors' === $key ) {
			$value = get_post_ancestors( $this );
		} else {
			$value = get_post_meta( $this->ID, $key, true );
		}

		if ( $this->filter ) {
			$value = sanitize_post_field( $key, $value, $this->ID, $this->filter );
		}

		return $value;
	}

	/**
	 * {@Missing Summary}
	 *
	 * @since 3.5.0
	 *
	 * @param string $filter Filter.
	 * @return JK_Post
	 */
	public function filter( $filter ) {
		if ( $this->filter === $filter ) {
			return $this;
		}

		if ( 'raw' === $filter ) {
			return self::get_instance( $this->ID );
		}

		return sanitize_post( $this, $filter );
	}

	/**
	 * Convert object to array.
	 *
	 * @since 3.5.0
	 *
	 * @return array Object as array.
	 */
	public function to_array() {
		$post = get_object_vars( $this );

		foreach ( array( 'ancestors', 'page_template', 'post_category', 'tags_input' ) as $key ) {
			if ( $this->__isset( $key ) ) {
				$post[ $key ] = $this->__get( $key );
			}
		}

		return $post;
	}
}
