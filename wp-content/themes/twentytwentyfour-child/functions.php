<?php 
/* Child theme generated with WPS Child Theme Generator */
            
if ( ! function_exists( 'b7ectg_theme_enqueue_styles' ) ) {            
    add_action( 'wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles' );
    
    function b7ectg_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
    }
}

// Add custom fields to WooCommerce registration form
function add_custom_registration_fields() {
    ?>
    <p class="form-row">
        <label for="display_name">Display Name <span class="required">*</span></label>
        <input type="text" class="input-text" name="display_name" id="display_name" value="<?php echo esc_attr(isset($_POST['display_name']) ? $_POST['display_name'] : ''); ?>" />
    </p>
    <p class="form-row">
        <label for="contact_no">Contact Number <span class="required">*</span></label>
        <input type="text" class="input-text" name="contact_no" id="contact_no" value="<?php echo esc_attr(isset($_POST['contact_no']) ? $_POST['contact_no'] : ''); ?>" />
    </p>
   
    <?php
}
add_action('woocommerce_register_form', 'add_custom_registration_fields');

// Validate and save custom fields during registration
function validate_and_save_custom_fields($errors, $username, $email) {
    if (empty($_POST['display_name'])) {
        $errors->add('display_name_error', __('Please enter a value for the display name.', 'text-domain'));
    }
    if (empty($_POST['contact_no'])) {
        $errors->add('contact_no_error', __('Please enter a value for the contact number.', 'text-domain'));
    }
   
    return $errors;
}
add_filter('registration_errors', 'validate_and_save_custom_fields', 10, 3);

function save_custom_fields_on_registration($customer_id) {
    if (isset($_POST['display_name'])) {
        update_user_meta($customer_id, 'display_name', sanitize_text_field($_POST['display_name']));
    }
    if (isset($_POST['contact_no'])) {
        update_user_meta($customer_id, 'contact_no', sanitize_text_field($_POST['contact_no']));
    }
   
}
add_action('woocommerce_created_customer', 'save_custom_fields_on_registration');

// Save custom fields when user is approved
function save_custom_fields_on_approval($user_id) {
    $display_name = get_user_meta($user_id, 'display_name', true);
    $contact_no = get_user_meta($user_id, 'contact_no', true);

    // Update user profile in the admin
    $userdata = array(
        'ID'           => $user_id,
        'display_name' => $display_name,
    );
    wp_update_user($userdata);

    // Additional custom fields can be updated here if needed
}
add_action('new_user_approve_user_approved', 'save_custom_fields_on_approval');

// Add custom fields to user edit profile page
function add_custom_fields_to_user_profile($user) {
    $contact_no = get_user_meta($user->ID, 'contact_no', true);
    $display_name = get_user_meta($user->ID, 'display_name', true);
    ?>
    <h3><?php esc_html_e('Custom Fields', 'text-domain'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="contact_no"><?php esc_html_e('Contact Info', 'text-domain'); ?></label></th>
            <td>
                <input type="text" name="contact_no" id="contact" value="<?php echo esc_attr($contact_no); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="display_name"><?php esc_html_e('Display Name', 'text-domain'); ?></label></th>
            <td>
                <input type="text" name="display_name" id="display_name" value="<?php echo esc_attr($display_name); ?>" class="regular-text" />
            </td>
        </tr>
    </table>
    <?php
}
add_action('edit_user_profile', 'add_custom_fields_to_user_profile');
add_action('show_user_profile', 'add_custom_fields_to_user_profile');

// Save custom fields on user profile update
function save_custom_fields_on_profile_update($user_id) {
    if (current_user_can('edit_user', $user_id)) {
        update_user_meta($user_id, 'contact_no', sanitize_text_field($_POST['contact_no']));
        update_user_meta($user_id, 'display_name', sanitize_text_field($_POST['display_name']));
    }
}
add_action('personal_options_update', 'save_custom_fields_on_profile_update');
add_action('edit_user_profile_update', 'save_custom_fields_on_profile_update');

// Add custom column to user listing in admin
function add_custom_column_to_user_listing($columns) {
    $columns['contact_no'] = __('Contact No', 'text-domain');
    return $columns;
}
add_filter('manage_users_columns', 'add_custom_column_to_user_listing');

// Display custom column content in user listing in admin
function display_custom_column_content_in_user_listing($value, $column_name, $user_id) {
    if ($column_name == 'contact_no') {
        $contact_no = get_user_meta($user_id, 'contact_no', true);
        return $contact_no ? esc_html($contact_no) : '-';
    }
    return $value;
}
add_filter('manage_users_custom_column', 'display_custom_column_content_in_user_listing', 10, 3);

//Remove set password link mail on new user register
function disable_new_account_email( $enabled ) {
    return false;
}
add_filter( 'woocommerce_email_enabled_customer_new_account', 'disable_new_account_email' );

function custom_registration_error_message($errors) {
    if (isset($errors->errors['email'])) {
        $pending_message = __('Your account is pending approval. Please wait for admin approval.', 'text-domain');
        $errors->errors['email'][0] = $pending_message;
    }
    return $errors;
}
add_filter('woocommerce_registration_errors', 'custom_registration_error_message');