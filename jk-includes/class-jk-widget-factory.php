<?php
/**
 * Widget API: JK_Widget_Factory class
 *
 * @package JKPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Singleton that registers and instantiates JK_Widget classes.
 *
 * @since 2.8.0
 * @since 4.4.0 Moved to its own file from jk-includes/widgets.php
 */
#[AllowDynamicProperties]
class JK_Widget_Factory {

	/**
	 * Widgets array.
	 *
	 * @since 2.8.0
	 * @var array
	 */
	public $widgets = array();

	/**
	 * PHP5 constructor.
	 *
	 * @since 4.3.0
	 */
	public function __construct() {
		add_action( 'widgets_init', array( $this, '_register_widgets' ), 100 );
	}

	/**
	 * PHP4 constructor.
	 *
	 * @since 2.8.0
	 * @deprecated 4.3.0 Use __construct() instead.
	 *
	 * @see JK_Widget_Factory::__construct()
	 */
	public function JK_Widget_Factory() {
		_deprecated_constructor( 'JK_Widget_Factory', '4.3.0' );
		self::__construct();
	}

	/**
	 * Registers a widget subclass.
	 *
	 * @since 2.8.0
	 * @since 4.6.0 Updated the `$widget` parameter to also accept a JK_Widget instance object
	 *              instead of simply a `JK_Widget` subclass name.
	 *
	 * @param string|JK_Widget $widget Either the name of a `JK_Widget` subclass or an instance of a `JK_Widget` subclass.
	 */
	public function register( $widget ) {
		if ( $widget instanceof JK_Widget ) {
			$this->widgets[ spl_object_hash( $widget ) ] = $widget;
		} else {
			$this->widgets[ $widget ] = new $widget();
		}
	}

	/**
	 * Un-registers a widget subclass.
	 *
	 * @since 2.8.0
	 * @since 4.6.0 Updated the `$widget` parameter to also accept a JK_Widget instance object
	 *              instead of simply a `JK_Widget` subclass name.
	 *
	 * @param string|JK_Widget $widget Either the name of a `JK_Widget` subclass or an instance of a `JK_Widget` subclass.
	 */
	public function unregister( $widget ) {
		if ( $widget instanceof JK_Widget ) {
			unset( $this->widgets[ spl_object_hash( $widget ) ] );
		} else {
			unset( $this->widgets[ $widget ] );
		}
	}

	/**
	 * Serves as a utility method for adding widgets to the registered widgets global.
	 *
	 * @since 2.8.0
	 *
	 * @global array $jk_registered_widgets
	 */
	public function _register_widgets() {
		global $jk_registered_widgets;
		$keys       = array_keys( $this->widgets );
		$registered = array_keys( $jk_registered_widgets );
		$registered = array_map( '_get_widget_id_base', $registered );

		foreach ( $keys as $key ) {
			// Don't register new widget if old widget with the same id is already registered.
			if ( in_array( $this->widgets[ $key ]->id_base, $registered, true ) ) {
				unset( $this->widgets[ $key ] );
				continue;
			}

			$this->widgets[ $key ]->_register();
		}
	}

	/**
	 * Returns the registered JK_Widget object for the given widget type.
	 *
	 * @since 5.8.0
	 *
	 * @param string $id_base Widget type ID.
	 * @return JK_Widget|null
	 */
	public function get_widget_object( $id_base ) {
		$key = $this->get_widget_key( $id_base );
		if ( '' === $key ) {
			return null;
		}

		return $this->widgets[ $key ];
	}

	/**
	 * Returns the registered key for the given widget type.
	 *
	 * @since 5.8.0
	 *
	 * @param string $id_base Widget type ID.
	 * @return string
	 */
	public function get_widget_key( $id_base ) {
		foreach ( $this->widgets as $key => $widget_object ) {
			if ( $widget_object->id_base === $id_base ) {
				return $key;
			}
		}

		return '';
	}
}
