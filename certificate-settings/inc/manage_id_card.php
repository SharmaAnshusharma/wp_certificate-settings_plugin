<?php
$success_msg = "";
$error_msg = "";
global $wpdb;

$result = $wpdb->get_row("SELECT `ID` FROM `wp_manage_certificate` ORDER BY `ID` DESC");
$auto_no = isset($result->ID)?$result->ID+1 : 1 ;



?>


<script type="text/javascript">
 var  PLUGIN_URL="<?php echo plugin_dir_url( __FILE__ );?>";
 var SITE_URL = "<?php echo site_url(); ?>";
</script>
<?php
   $type=get_option('certificate_type');
   $year=get_option('expiry_year');
     
?>
<section class="page-section">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="page-title">
               Manage ID Card
            </div>
         </div>
      </div>
   </div>
</section>
<section class="certificate">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-6 custom-grid"  id="student_card">
            <div class="row">
               <div class="col-md-12 bg-color">
               
                  <div class="back" style="background-image: url('<?php echo site_url("/wp-content/plugins/certificate-settings/images/bg.png");?>')">
                 
                     <div class="card-logo">
                        <img src="<?php echo site_url('/wp-content/plugins/certificate-settings/images/logo.png');?>">
                     </div>
                     <div class="content">
                        <ul class="student-detail">
                           <li>Course Title: <span id="Ccourse_title"></span></li>
                           <li>Student Name: <span id="Cstudent_name"></span></li>
                           <li>Student ID: <span id="Cstudent_id"></span></li>
                           <li>Certificate Number:<span id="Ccer-no"></span></li>
                        </ul>

                        <div class="student_img">
                           <img id="Cupimg" src="<?php echo site_url('/wp-content/plugins/certificate-settings/images/avatar.jpg');?>">
                        </div>
                     </div>
                     <div class="btm-content">
                        <p>Issued Date:<span id="Cissued_date"></span></p>
                        <p>Expire Date:<span id="Cexpire-date"></span></p>
                     </div>
                     <div class="divider"></div>
                  </div>
               </div>
               <div class="col-md-12 bg-color">
                  <div class="front">
                     <div class="header">
                        <div class="card-logo">
                           <img src="<?php echo site_url('/wp-content/plugins/certificate-settings/images/logo.png');?>">
                        </div>
                        
                     </div>
                     <div class="banner" style="background-image: url('<?php echo site_url("/wp-content/plugins/certificate-settings/images/id-back-bg-2.jpg");?>')">
                        <img id="qr_code" src="<?php echo site_url('/wp-content/plugins/certificate-settings/inc/qrcode.php');?>" class="qr_code">
                        <div class="student_name" style="font"></div>
                     </div>
                     <div class="website-link">
                        <p>Web: www.bgtrainingcenter.com</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 custom-grid">
            <div class="certificate-form">
                  
               <form class="form-horizontal" id="form" method="post" enctype="multipart/form-data">
                  
                  <div class="form-group">
                     <label class="control-label col-sm-4">Student Name:</label>
                     <div class="col-sm-8">
                      
                       <input type="text" name="student_name" id="student_name" class="form-control">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-4">Student Email:</label>
                     <div class="col-sm-8">
                        <input type="text" name="stu_email" id="student_email" class="form-control"  readonly>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-4">Course Title:</label>
                     <div class="col-sm-8">
                        <input type="text" name="course_title" id="course_title"oninput="updateText(this,'#Ccourse_title')" class="form-control"  readonly>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <label class="control-label col-sm-4">Student ID:</label>
                     <div class="col-sm-8">
                        <input type="text" name="stu_id" id="student_id" oninput="updateText(this,'#Cstudent_id')" class="form-control" readonly>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <label class="control-label col-sm-4">Certificate No:</label>
                     <div class="col-sm-8">
                        <input type="text" name="certificate_no" oninput="updateText(this,'#Ccer-no')" class="form-control" readonly>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-4">Issued Date:</label>
                     <div class="col-sm-8">
                        <input type="text" name="issue_date" id="issue_date" oninput="updateText(this,'#Cissued_date');updateExpiry(this,'<?php echo $year ?>')" class="form-control" readonly>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-4">Expiry Date:</label>
                     <div class="col-sm-8">
                        <input type="text" name="expiry_date" id="expiry_date" oninput="updateText(this,'#Cexpire-date')" class="form-control" readonly>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <label class="control-label col-sm-4">Upload Image:</label>
                     <div class="col-sm-8 upload-img">
                        <input type="file" name="myfile" onchange="readURL(this)" id="uploadImage" class="form-control">
                     </div>
                     <?php 
                        if(isset($msg) && $msg !='')
                        {
                           ?>
                           <p id="msg" class="alert alert-success"><?php echo $msg; ?></p>
                           <?php
                        }
                        if(isset($error_msg) && $error_msg !='')
                        {
                           ?>
                           <p id="msg" class="alert alert-danger"><?php echo $error_msg; ?></p>
                           <?php
                        }
                      ?>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-offset-4 col-sm-8">
                       <a class="btn btn-info custom-btn " id="idcard">Download</a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">

</script>


