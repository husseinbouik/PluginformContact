<?php
/*
Plugin Name: Contact Form
Plugin URI: https://example.com/contact-form
Description: A simple contact form plugin for WordPress.
Version: 1.0
Author: Your Name
Author URI: https://example.com
License: GPL2
*/

// Create the table when plugin is activated
register_activation_hook( __FILE__, 'create_contact_form_table' );
function create_contact_form_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        subject varchar(255) NOT NULL,
        first_name varchar(255) NOT NULL,
        last_name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        message text NOT NULL,
        date_sent datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

// Delete the table when plugin is deactivated
register_deactivation_hook( __FILE__, 'delete_contact_form_table' );
function delete_contact_form_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';
    $wpdb->query( "DROP TABLE IF EXISTS $table_name" );
}

// Add the shortcode
add_shortcode( 'contact_form', 'contact_form_shortcode' );
function contact_form_shortcode() {
    $html = '';
    // If form is submitted, process the form data
    if ( isset( $_POST['contact_form_submit'] ) ) {
        $subject = sanitize_text_field( $_POST['subject'] );
        $first_name = sanitize_text_field( $_POST['first_name'] );
        $last_name = sanitize_text_field( $_POST['last_name'] );
        $email = sanitize_email( $_POST['email'] );
        $message = sanitize_textarea_field( $_POST['message'] );
        $date_sent = current_time( 'mysql' );
        // Insert the form data into the database
        global $wpdb;
        $table_name = $wpdb->prefix . 'contact_form';
        $wpdb->insert(
            $table_name,
            array(
                'subject' => $subject,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'message' => $message,
                'date_sent' => $date_sent
            )
        );
        // Display success message
        $html .= '<div class="contact-form-message success">' . __( 'Thank you for your message!', 'contact-form' ) . '</div>';
    }
// Display the form
$html .= '<form method="post" class="contact-form">';
$html .= '<div class="form-group">';
$html .= '<label for="subject">' . __( 'Subject', 'contact-form' ) . '</label>';
$html .= '<input type="text" name="subject" id="subject" class="regular-text" required>';
$html .= '</div>';
$html .= '<div class="form-group">';
$html .= '<label for="first_name">' . __( 'First Name', 'contact-form' ) . '</label>';
$html .= '<input type="text" name="first_name" id="first_name" class="regular-text" required>';
$html .= '</div>';
$html .= '<div class="form-group">';
$html .= '<label for="last_name">' . __( 'Last Name', 'contact-form' ) . '</label>';
$html .= '<input type="text" name="last_name" id="last_name" class="regular-text" required>';
$html .= '</div>';
$html .= '<div class="form-group">';
$html .= '<label for="email">' . __( 'Email', 'contact-form' ) . '</label>';
$html .= '<input type="email" name="email" id="email" class="regular-text" required>';
$html .= '</div>';
$html .= '<div class="form-group">';
$html .= '<label for="message">' . __( 'Message', 'contact-form' ) . '</label>';
$html .= '<textarea name="message" id="message" class="large-text" cols="30" rows="8" required></textarea>';
$html .= '</div>';
$html .= '<div class="form-group">';
$html .= '<button type="submit" name="contact_form_submit" class="button button-primary">' . __( 'Submit', 'contact-form' ) . '</button>';
$html .= '</div>';
$html .= '</form>';
return $html;
}
// Add the menu page
add_action( 'admin_menu', 'contact_form_menu' );
function contact_form_menu() {
add_menu_page(
__( 'Contact Form Submissions', 'contact-form' ),
__( 'Contact Form', 'contact-form' ),
'manage_options',
'contact-form-submissions',
'contact_form_submissions_page',
'dashicons-email'
);
}

// Display the submissions page
function contact_form_submissions_page() {
global $wpdb;
$table_name = $wpdb->prefix . 'contact_form';
$submissions = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY date_sent DESC" );
echo '<div class="wrap">';
echo '<h1>' . __( 'Contact Form Submissions', 'contact-form' ) . '</h1>';
if ( $submissions ) {
echo '<table class="widefat">';
echo '<thead><tr><th>' . __( 'Subject', 'contact-form' ) . '</th><th>' . __( 'Name', 'contact-form' ) . '</th><th>' . __( 'Email', 'contact-form' ) . '</th><th>' . __( 'Message', 'contact-form' ) . '</th><th>' . __( 'Date Sent', 'contact-form' ) . '</th></tr></thead>';
echo '<tbody>';
foreach ( $submissions as $submission ) {
echo '<tr>';
echo '<td>' . esc_html( $submission->subject ) . '</td>';
echo '<td>' . esc_html( $submission->first_name ) . ' ' . esc_html( $submission->last_name ) . '</td>';
echo '<td>' . esc_html( $submission->email ) . '</td>';
echo '<td>' . esc_html( $submission->message ) . '</td>';
echo '<td>' . date_i18n( get_option( 'date_format' ), strtotime( $submission->date_sent ) ) . '</td>';
echo '</tr>';
}
echo '</tbody>';
echo '</table>';
} else {
echo '<p>' . __( 'No submissions yet.', 'contact-form' ) . '</p>';
}
echo '</div>';
}
?>