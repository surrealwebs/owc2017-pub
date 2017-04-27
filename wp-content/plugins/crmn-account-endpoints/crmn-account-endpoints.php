<?php
/**
 * Plugin Name: CRMN My Account Endpoints
 * Plugin URI:
 * Description: Creates custom post tyoes for Conflict Resolution MN
 * Author:
 * Version: 0.0.1
 * Author URI:
 */


class CRMN_Custom_My_Account_Endpoint {

  /**
   * Custom endpoint name.
   *
   * @var string
   */
  public static $endpoint = 'additional-profile-info';

  /**
   * Custom edit endpoint name.
   *
   * @var string
   */
  public static $edit_endpoint = 'additional-profile-info-edit';

  public static $display_fields = [
    'is_member_of_acr_international',
    'is_rule_114_qualified_neutral',
    'ever_had_license_revoked',
    'services_provided',
    'general_adr_matters',
    'detailed_adr_matters',
    'additional_languages_spoken',
    'member_bio',
    'member_cv',
  ];


  /**
   * Plugin actions.
   */
  public function __construct() {
    // Actions used to insert a new endpoint in the WordPress.
    add_action( 'init', array( $this, 'add_endpoints' ) );
    add_filter( 'query_vars', array( $this, 'add_query_vars' ), 0 );

    // Change the My Accout page title.
    add_filter( 'the_title', array( $this, 'endpoint_title' ) );

    // Insering your new tab/page into the My Account page.
    add_filter( 'woocommerce_account_menu_items', array( $this, 'new_menu_items' ) );
    add_action( 'woocommerce_account_' . self::$endpoint .  '_endpoint', array( $this, 'endpoint_content' ) );
    add_action( 'woocommerce_account_' . self::$edit_endpoint .  '_endpoint', array( $this, 'endpoint_edit_content' ) );
  }

  /**
   * Register new endpoint to use inside My Account page.
   *
   * @see https://developer.wordpress.org/reference/functions/add_rewrite_endpoint/
   */
  public function add_endpoints() {
    add_rewrite_endpoint( self::$endpoint, EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( self::$edit_endpoint, EP_ROOT | EP_PAGES );
  }

  /**
   * Add new query var.
   *
   * @param array $vars
   * @return array
   */
  public function add_query_vars( $vars ) {
    $vars[] = self::$endpoint;
    $vars[] = self::$edit_endpoint;

    return $vars;
  }

  /**
   * Set endpoint title.
   *
   * @param string $title
   * @return string
   */
  public function endpoint_title( $title ) {
    global $wp_query;

    $is_endpoint = isset( $wp_query->query_vars[ self::$endpoint ] );

    if ( $is_endpoint && ! is_admin() && is_main_query() && in_the_loop() && is_account_page() ) {
      // New page title.
      $title = __( 'Additional Profile Information', 'woocommerce' );

      remove_filter( 'the_title', array( $this, 'endpoint_title' ) );
    }

    return $title;
  }

  /**
   * Insert the new endpoint into the My Account menu.
   *
   * @param array $items
   * @return array
   */
  public function new_menu_items( $items ) {
    //edit these to be in whatever order you want them to be in
    $new_ordered_items = array(
      'dashboard'       => __( 'Dashboard', 'woocommerce' ),
      'orders'          => __( 'Orders', 'woocommerce' ),
      'subscriptions'   => __( 'Subscriptions', 'woocommerce-subscriptions' ),
      'downloads'       => __( 'Downloads', 'woocommerce' ),
      'edit-address'    => __( 'Addresses', 'woocommerce' ),
      'payment-methods' => __( 'Payment Methods', 'woocommerce' ),
      'edit-account'    => __( 'Account Details', 'woocommerce' ),
      'customer-logout' => __( 'Logout', 'woocommerce' ),
    );
    //loop through the new array and remove any elements that do not exist in the `$items` array
    foreach ( $new_ordered_items as $key => $value ) {
      if ( ! array_key_exists( $key, $items ) ) {
        unset( $new_ordered_items[ $key ] );
      }
    }
    // Remove the logout menu item.
    $logout = $new_ordered_items['customer-logout'];
    unset( $new_ordered_items['customer-logout'] );

    // Insert your custom endpoint.
    $new_ordered_items[ self::$endpoint ] = __( 'Additional Profile Info', 'woocommerce' );

    // Insert back the logout item.
    $new_ordered_items['customer-logout'] = $logout;

    return $new_ordered_items;
  }

  /**
   * Method used to display content for the endpoint
   */
  public function endpoint_content() {

    echo '<p>Additional membership profile information. Please keep this 
            information up to date, site visitors will be able to search for you 
            based on data provided in this section.</p>';

    $mypod = pods('user', get_current_user_id());

    $podFields = $mypod->fields();

    ob_start();

    echo '<a href="' . esc_url( wc_get_endpoint_url( self::$edit_endpoint) ) . '" class="edit">' . __( 'Edit profile data.', 'woocommerce' ) . '</a>';

    echo '<div class="pods-form-front"><ul class="pods-form-fields">';

    foreach (self::$display_fields as $field) {

      $label = (!empty($podFields[$field]['label'])?$podFields[$field]['label']:'');
      $data  = get_user_meta(get_current_user_id(), $field);

      echo '<li class="pods-field">
                <div class="pods-field-label pods-data"><label>' . __($label, 'crmn') . '</label></div>
                <div class="pods-field-input pods-data">';

      $this->display_data_value_for_type($data, $podFields[$field]['type']);

      echo '</div>
            </li>';

    }

    echo '</ul></div>';

    // this will actually display :)
    echo ob_get_clean();

  }

  /**
   * Endpoint HTML Form content.
   */
  public function endpoint_edit_content() {

    echo '<p>Additional membership profile information. Please keep this information up to date so users can find your in the directory.</p>';

    $mypod = pods('user', get_current_user_id());
    echo $mypod->form(self::$display_fields, null, '/my-account/additional-profile-info/');
  }

  /**
   * Plugin install action.
   * Flush rewrite rules to make our custom endpoint available.
   */
  public static function install() {
    flush_rewrite_rules();
  }

  /**
   * Determine how to handle the data being passed in.
   *
   * @param array $data User data.
   * @param string $type the the of the data being passed in.
   */
  public function display_data_value_for_type($data, $type) {
    switch($type) {
      case 'boolean':
        $this->display_boolean_data_value($data);
        break;
      case 'pick':
        $this->display_pick_data_value($data);
        break;
      case 'wysiwyg':
        $this->display_wysiwyg_value($data);
        break;
      case 'file':
        $this->display_file_value($data);
        break;
      default:
        // no-op
        break;
    }
  }

  /**
   * Take a boolean selection and convert to Yes/No then display
   *
   * @param array $data User's selection
   * @return void
   */
  public function display_boolean_data_value($data) {
    $out = __('No', 'crmn');
    if ($data[0]) {
      $out = __('Yes', 'crmn');
    }
    echo esc_html($out);
  }

  /**
   * Builds list data to display
   *
   * @param array $data User's field data.
   * @return string Data transformed for display.
   */
  public function display_pick_data_value($data) {
    $out = '<em>' . esc_html(__('You have not selected anything for this section', 'crmn')) . '</em>';

    if (!empty($data[0])) {
      array_walk($data, 'esc_html');

      $out = '<ul><li>' . implode('</li><li>', $data) . '</li></ul>';
    }

    echo $out;
  }

  /**
   * Handle WYSIWYG data the user may have entered.
   *
   * @param array $data User data.
   */
  public function display_wysiwyg_value( $data ) {
    $out = '<em>' . esc_html( __( 'You do not have a Bio at this time.', 'crmn' ) ) . '</em>';
    if ( ! empty( $data[0] ) ) {
      $out = wp_kses_post( $data[0] );
    }

    echo $out;
  }

  /**
   * Build a link the file if it exists.
   *
   * @param array $data File data if any have been uploaded.
   */
  public function display_file_value( $data ) {
    $out = '<em>' . esc_html( __( 'You have not uploaded a file yet.', 'crmn' ) ) . '</em>';
    if ( ! empty( $data[0] ) ) {
      $title = $data[0]['post_title'];
      $url = $data[0]['guid'];

      $out = '<a href="' . $url . '">' . esc_html( __( 'Click to view your CV', 'crmn' ) ) . '</a>';
    }

    echo $out;
  }

}

new CRMN_Custom_My_Account_Endpoint();

// Flush rewrite rules on plugin activation.
register_activation_hook( __FILE__, array( 'CRMN_Custom_My_Account_Endpoint', 'install' ) );