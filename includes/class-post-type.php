<?php
/**
 * Defines the Research custom post type
 */
namespace UCFResearch\PostTypes;

class Research {
	private
		/**
		 * @var string The singular label for the post type
		 */
		$singular,
		/**
		 * @var string The lowercase variant of $singular
		 */
		$singular_lower,
		/**
		 * @var string The plural label for the post type
		 */
		$plural,
		/**
		 * @var string The lowercase variant of $plural
		 */
		$plural_lower,
		/**
		 * @var string The text domain to use for translation
		 */
		$text_domain;

	/**
	 * Constructs the Research object.
	 * Adds any initial filters/actions as needed
	 * @author Jim Barnes
	 * @since 1.0.0
	 */
	public function __construct() {
		// Always set the labels on construct
		$this->set_labels();

		// Register the post type on init
		add_action( 'init', array( $this, 'register' ), 10, 0 );
	}

	/**
	 * Helper function that initializes the labels
	 * @author Jim Barnes
	 * @since 1.0.0
	 */
	private function set_labels() {
		$defaults = array(
			'singular'    => 'Research Area',
			'plural'      => 'Research Areas',
			'text_domain' => 'ucf_research'
		);

		$labels = apply_filters( 'ucf_research_label_defaults', $defaults );

		$this->singular       = $labels['singular'];
		$this->singular_lower = strtolower( $this->singular );
		$this->plural         = $labels['plural'];
		$this->plural_lower   = strtolower( $this->plural );
		$this->text_domain    = $labels['text_domain'];
	}

	/**
	 * Registers the post type
	 * @author Jim Barnes
	 * @since 1.0.0
	 */
	public function register() {
		register_post_type( 'research', $this->args() );
	}

	/**
	 * Generates the labels used to register
	 * the custom post type
	 * @author Jim Barnes
	 * @since 1.0.0
	 * @return array The array of labels
	 */
	private function labels() {
		$retval = array(
			"name"                  => _x( $this->plural, "Post Type General Name", $this->text_domain ),
			"singular_name"         => _x( $this->singular, "Post Type Singular Name", $this->text_domain ),
			"menu_name"             => __( $this->plural, $this->text_domain ),
			"name_admin_bar"        => __( $this->singular, $this->text_domain ),
			"archives"              => __( "$this->singular Archives", $this->text_domain ),
			"parent_item_colon"     => __( "Parent $this->singular:", $this->text_domain ),
			"all_items"             => __( "All $this->plural", $this->text_domain ),
			"add_new_item"          => __( "Add New $this->singular", $this->text_domain ),
			"add_new"               => __( "Add New", $this->text_domain ),
			"new_item"              => __( "New $this->singular", $this->text_domain ),
			"edit_item"             => __( "Edit $this->singular", $this->text_domain ),
			"update_item"           => __( "Update $this->singular", $this->text_domain ),
			"view_item"             => __( "View $this->singular", $this->text_domain ),
			"search_items"          => __( "Search $this->plural", $this->text_domain ),
			"not_found"             => __( "Not found", $this->text_domain ),
			"not_found_in_trash"    => __( "Not found in Trash", $this->text_domain ),
			"featured_image"        => __( "Featured Image", $this->text_domain ),
			"set_featured_image"    => __( "Set featured image", $this->text_domain ),
			"remove_featured_image" => __( "Remove featured image", $this->text_domain ),
			"use_featured_image"    => __( "Use as featured image", $this->text_domain ),
			"insert_into_item"      => __( "Insert into $this->singular_lower", $this->text_domain ),
			"uploaded_to_this_item" => __( "Uploaded to this $this->singular_lower", $this->text_domain ),
			"items_list"            => __( "$this->plural list", $this->text_domain ),
			"items_list_navigation" => __( "$this->plural list navigation", $this->text_domain ),
			"filter_items_list"     => __( "Filter $this->plural_lower list", $this->text_domain ),
		);

		$retval = apply_filters( 'ucf_research_labels', $retval );

		return $retval;
	}

	/**
	 * Returns the args array used in
	 * registering the custom post type
	 * @author Jim Barnes
	 * @since 1.0.0
	 * @return array The argument array
	 */
	private function args() {
		$taxonomies = $this->taxonomies();

		$args = array(
			'label'               => __( $this->singular, $this->text_domain ),
			'description'         => __( $this->plural, $this->text_domain ),
			'labels'              => $this->labels(),
			'supports'            => array( 'title', 'editor', 'excerpt', 'revisions' ),
			'taxonomies'          => $taxonomies,
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'rest_base'           => 'research',
			'menu_position'       => 8,
			'menu_icon'           => 'dashicons-welcome-write-blog',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post'
		);

		$args = apply_filters( 'ucf_research_args', $args );

		return $args;
	}

	/**
	 * Function that returns the taxonomies
	 * used by the custom post type
	 * @author Jim Barnes
	 * @since 1.0.0
	 * @return array The array of taxonomies
	 */
	public function taxonomies() {
		return apply_filters(
			'ucf_research_taxonomies',
			array()
		);
	}
}

new Research();
