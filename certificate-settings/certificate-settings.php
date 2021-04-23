<?php

/*
    Plugin Name: Black Gold Traning Center
    Plugin URI: https://www.wordpress.org/
    Description: Customise WordPress .
    Version: 1.0.2
    Author: SS

*/

/* code for include css and js file */
//error_reporting(0);
function my_custom_function() {
    
    wp_enqueue_media();
    wp_register_style('my_style_css', plugins_url('css/card_style.css?'.time(),__FILE__ ));
    wp_enqueue_style('my_style_css');
    
    wp_register_style('bootstrap_css1','https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap_css1');
/*
    wp_register_style('bootstrap_css2','https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.css');
    wp_enqueue_style('bootstrap_css2');*/

    wp_register_script( 'js_file', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js');
    wp_enqueue_script('js_file');

    wp_register_script('js_file2','https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js');
    wp_enqueue_script('js_file2');


    wp_register_script('js_file3','https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js');
    wp_enqueue_script('js_file3');

    wp_register_script('js_file4','http://code.jquery.com/ui/1.10.2/jquery-ui.js');
    wp_enqueue_script('js_file4');

    wp_register_script('js_file5','https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js');
    wp_enqueue_script('js_file5');

    wp_register_script( 'js_file1', plugins_url('js/certificate.js?'.time(),__FILE__));
    wp_enqueue_script('js_file1');


    wp_localize_script( 'my_js', 'my_js', array( 'ajax_url' => admin_url( 'admin-ajax.php')));
    wp_register_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js');
    wp_enqueue_script('bootstrap_js');
	
	wp_register_script( 'auto_complete', 'https://goodies.pixabay.com/jquery/auto-complete/jquery.auto-complete.js');
	wp_enqueue_script('auto_complete');
	
}
add_action( 'admin_enqueue_scripts','my_custom_function');


global $jal_db_version;
$jal_db_version = '1.0';

function jal_install()
{
    global $wpdb;
    global $jal_db_version;

    $table_name = $wpdb->prefix . 'manage_certificate';
    
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
       ID int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        student_name VARCHAR(50),
        course_title VARCHAR(50),
        issue_date DATE,
        expiry_date DATE,
        student_email VARCHAR(50),
        certificate_no VARCHAR(50)
    ) $charset_collate;";


    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'jal_db_version', $jal_db_version );
}
register_activation_hook( __FILE__, 'jal_install' );


function wp_add_certificate_page(){

    add_menu_page(
        'Black Gold',
        'Black Gold',
        'edit_posts',
        'manage-certificate',
        'manage_certificate',
        'dashicons-businessman',
        30
    );
        
        add_submenu_page(
            'manage-certificate',
            'Manage Certificate',
            'Manage Certificate',
            'edit_posts',
            'manage-certificate',
            'manage_certificate'
        );
        add_submenu_page(
            'manage-certificate',
            'Manage ID Card',
            'Manage ID Card',
            'edit_posts',
            'manage-card',
            'manage_id_card'
        );
        add_submenu_page(
            'manage-certificate',
            'Settings',
            'Settings',
            'edit_posts',
            'manage-settings',
            'manage_settings'
        );
    }
add_action( 'admin_menu', 'wp_add_certificate_page' );


function manage_id_card(){
    require_once( plugin_dir_path( __FILE__ ) . 'inc/manage_id_card.php' );
}

function manage_certificate(){
    require_once( plugin_dir_path( __FILE__ ) . 'inc/manage_certificate.php' );
}
function manage_settings(){
    require_once( plugin_dir_path( __FILE__ ) . 'inc/settings.php' );
}

/*function get_data()
{
    global $wpdb;
    $id = $_POST['search'];

    $query = $wpdb->get_row("SELECT * FROM `wp_manage_id_card` WHERE `ID` LIKE '%".$id."%'");

    if($query > 0)
    {

            $arr['course_title'] = $query->course_title;
            $arr['student_name'] = $query->student_name;
            $arr['student_id']  = $query->student_id;
            $arr['issue_date'] = $query->issue_date;
            $arr['expiry_date'] = $query->expiry_date;
            $res[] = $arr;
        echo json_encode($res);
     
    }
    else
    {

    }
   die();
}
add_action("wp_ajax_get_data","get_data");*/

function checkEmail()
{
    global $wpdb;
    $email = $_GET['email'];
    $query = $wpdb->get_var("SELECT COUNT(*) FROM `wp_manage_certificate` WHERE `student_email` = '$email'");
    if($query == 0)
    {
        echo "true";
    }
    else
    {
        echo "false";
    }
    wp_die();
}
add_action ('wp_ajax_checkEmail','checkEmail');


function getStudents()
{
   
    global $wpdb;
    $name = $_GET['search'];

    $query = $wpdb->get_results("SELECT * FROM `wp_manage_certificate` WHERE (`student_name` LIKE '%".$name."%' OR  `student_email` LIKE '%".$name."%') LIMIT 5");
    if(!empty($query))
    {
/*
            $arr['course_title'] = $query->course_title;
            $arr['student_name'] = $query->student_name;
            $arr['student_email'] = $query->student_email;
            $arr['student_id']  = $query->student_id;
            $arr['issue_date'] = $query->issue_date;
            $arr['expiry_date'] = $query->expiry_date;*/
           
        echo json_encode($query);
     
    }
    else
    {

    }
   wp_die();
}
add_action('wp_ajax_nopriv_getStudents','getStudents');
add_action('wp_ajax_getStudents','getStudents');

/* Add Shortcode    */
function verifyCertificate()
{
    if(isset($_POST['submit']))
    {
        global $wpdb;
        $success_msg="";
        $error_msg="";
        $verify = $_POST['verify'];
     
        $query = $wpdb->get_var("SELECT * FROM `wp_manage_certificate` WHERE  `certificate_no` = '".$verify."'");
        
        
        if($query == true)
        {
            $msg="Certificate Number is Verified";
        }
        else
        {
            $error_msg = "Certificate Number is not Verified";
        }

    }
    

    ?>
<div class="certificate-form">
    <?php 
     if(isset($success_msg) && $success_msg != ''){
        ?>
        <p class="alert alert-success"><?php echo $success_msg; ?></p>
    <?php
    }
  ?>
   <?php 
     if(isset($error_msg) && $error_msg != ''){
        ?>
        <p class="alert alert-danger"><?php echo $error_msg; ?></p>
    <?php
    }
  ?>
   <form class="form-horizontal" id="form" method="post">
      <div class="form-group">
         <label class="control-label col-sm-4">Verify Certificate:</label>
         <div class="col-sm-8">
          
           <input type="text" name="verify" placeholder="Enter Your Certificate No." class="form-control">
         </div>
     </div>
         <div class="form-group">
             <div class="col-sm-offset-4 col-sm-8">
               <input type="submit" name="submit" value="Vertify "class="btn btn-info custom-btn" >
             </div>
          </div>
    </form>
</div>

    <?php

}
add_shortcode('bg-certificate','verifyCertificate');

 

function UploadImage()
{
    global $wpdb;

    $user_id = $_POST['user_id'];
    $file = $_FILES['profile'];
    $_FILES =array('profile'=>$file);
    $attachment_id = media_handle_upload("profile",0);
    $attachment_url = wp_get_attachment_url($attachment_id);
     
    $query = $wpdb->update('wp_manage_certificate', array(
        'profile_image' => $attachment_url
         ),array("certificate_no"=>$user_id)
    );
    if($query == true)
    {
        $success_msg = "Image Uploaded Successfully";
    }
    else
    {
        $error_msg = "Failed to Upload Image";
    }
}
add_action('wp_ajax_nopriv_UploadImage','UploadImage');
add_action('wp_ajax_UploadImage','UploadImage');

?>