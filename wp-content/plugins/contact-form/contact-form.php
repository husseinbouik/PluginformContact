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
$wpdb->insert( $table_name, array(
    'subject' => $subject,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'message' => $message,
    'date_sent' => $date_sent
) );
$html .= '<div class="notice notice-success is-dismissible">';
$html .= '<p>' . __( 'Thank you for your message!', 'contact-form' ) . '</p>';
$html .= '</div>';
// Check if the data was inserted successfully
// if ( $wpdb->insert_id ) {
//             // Display success message
//     $html .= '<div class="notice notice-success is-dismissible"><p>' .
//         __( 'Thank you for your message!', 'contact-form' ) .
//         '</p></div>';
// } else {
//     $html .= '<div class="notice notice-error is-dismissible"><p>' .
//         __( 'There was an error submitting your message. Please try again later.', 'contact-form' ) .
//         '</p></div>';
// }
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
    $html .= '<input typr="text" name="message" id="message" class="large-text" cols="30" rows="8" required></input>';
    $html .= '</div>';
    $html .= '<div class="form-group">';
    $html .= '<button type="submit" name="contact_form_submit" class="button button-primary">' . __( 'Submit', 'contact-form' ) . '</button>';
    $html .= '</div>';
    $html .= '</form>';
    
    // Add custom CSS
    $html .= '<style>
    body {
        background: linear-gradient(45deg, #fc466b, #3f5efb);
        height: 100vh;
        font-family: "Montserrat", sans-serif;
   }
    .container {
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
   }
    form {
        background: rgba(255, 255, 255, 0.3);
        padding: 3em;
        height: 320px;
        border-radius: 20px;
        border-left: 1px solid rgba(255, 255, 255, 0.3);
        border-top: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
        box-shadow: 20px 20px 40px -6px rgba(0, 0, 0, 0.2);
        text-align: center;
        position: relative;
        transition: all 0.2s ease-in-out;
   }
    form p {
        font-weight: 500;
        color: #fff;
        opacity: 0.7;
        font-size: 1.4rem;
        margin-top: 0;
        margin-bottom: 60px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
   }
    form a {
        text-decoration: none;
        color: #ddd;
        font-size: 12px;
   }
    form a:hover {
        text-shadow: 2px 2px 6px #000 40;
   }
    form a:active {
        text-shadow: none;
   }
    form input {
        background: transparent;
        width: 200px;
        padding: 1em;
        margin-bottom: 2em;
        border: none;
        border-left: 1px solid rgba(255, 255, 255, 0.3);
        border-top: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 5000px;
        backdrop-filter: blur(5px);
        box-shadow: 4px 4px 60px rgba(0, 0, 0, 0.2);
        color: #fff;
        font-family: Montserrat, sans-serif;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
   }
    form input:hover {
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 4px 4px 60px 8px rgba(0, 0, 0, 0.2);
   }
    form input[type="email"]:focus, form input[type="password"]:focus {
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 4px 4px 60px 8px rgba(0, 0, 0, 0.2);
   }
    form input[type="button"] {
        margin-top: 10px;
        width: 150px;
        font-size: 1rem;
   }
    form input[type="button"]:hover {
        cursor: pointer;
   }
    form input[type="button"]:active {
        background: rgba(255, 255, 255, 0.2);
   }
    form:hover {
        margin: 4px;
   }
    ::placeholder {
        font-family: Montserrat, sans-serif;
        font-weight: 400;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
   }
    .drop {
        background: rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        border-left: 1px solid rgba(255, 255, 255, 0.3);
        border-top: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 10px 10px 60px -8px rgba(0, 0, 0, 0.2);
        position: absolute;
        transition: all 0.2s ease;
   }
    .drop-1 {
        height: 80px;
        width: 80px;
        top: -20px;
        left: -40px;
        z-index: -1;
   }
    .drop-2 {
        height: 80px;
        width: 80px;
        bottom: -30px;
        right: -10px;
   }
    .drop-3 {
        height: 100px;
        width: 100px;
        bottom: 120px;
        right: -50px;
        z-index: -1;
   }
    .drop-4 {
        height: 120px;
        width: 120px;
        top: -60px;
        right: -60px;
   }
    .drop-5 {
        height: 60px;
        width: 60px;
        bottom: 170px;
        left: 90px;
        z-index: -1;
   }
    a, input:focus, select:focus, textarea:focus, button:focus {
        outline: none;
   }
    ';    
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