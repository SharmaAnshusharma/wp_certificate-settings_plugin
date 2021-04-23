<?php
global $wpdb;
$success_msg = "";
$error_msg = "";
$result = $wpdb->get_row("SELECT `ID` FROM `wp_manage_certificate` ORDER BY `ID` DESC");


$auto_no = isset($result->ID)?$result->ID+1 : 1 ;
$msg = '';
$type = get_option('certificate_type');
if($type == "number")
{
$certificate_no = strtoUpper(sprintf("%d%s%05d",date("Y"),date("m"),$auto_no ));
}
else
{
$certificate_no = strtoUpper(sprintf("%d%s%05d",date("Y"),date("M"),$auto_no ));
}



if(isset($_POST['submit']))
{ 
   $stu_name =$_POST['stu_name'];
   $course_title = $_POST['course_title'];
   $issue_date = $_POST['issue_date'];
   $expiry_date = $_POST['expiry_date'];
   $student_email = $_POST['email'];
   

   
 $query = $wpdb->insert('wp_manage_certificate',array(
      "student_name"=>$stu_name,
      "course_title"=>$course_title,
      "issue_date"=>$issue_date,
      "expiry_date"=>$expiry_date,
      "student_email"=>$student_email,
      "certificate_no"=>$certificate_no
   ));

   if($query == true)
   {
      $success_msg = "Data Inserted Successfully";
   }
   else
   {
      $error_msg = "Faild to Insert Data";
   }

}


?>
<script type="text/javascript">
 var  PLUGIN_URL="<?php echo plugin_dir_url( __FILE__ );?>";
</script>
<?php
   $type=get_option('certificate_type');
   $year=get_option('expiry_year');
     
?>
<style type="text/css">
   label.error {
    color: red;
    font-weight: normal;
}
</style>
<section class="page-section">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="page-title">
               Manage certificate
            </div>
         </div>
      </div>
   </div>
</section>

<section class="certificate">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div id="container" class="certificate-box" style="background-image: url(https://i.ibb.co/nBHschr/certificate-bg.png);">
               <div>
                  <h1>Certificate</h1>
               </div>
               <div class="awd">
                  <h5>Awarded To</h5>
               </div>
               <div class="awd">
                  <h3 id="user_name"></h3>
               </div>
               <span>For successfully completing training in</span>
               <div class="border-b">
                  <h3 id="course_name"></h3>
               </div>
               <div class="btm-section">
                  <div class="right">
                     <p>Issue Date : <span id="Cissued_date" class="no-b"></span></p>
                     <p>Expiry Date : <span id="Cexpire-date" class="no-b"></span></p>
                  </div>
                  <div class="left">
                    
                     <p>Authorized SIGNATURE</p>
                  </div>
               </div>
               
               <div class="ftr_content">
                  <p>Certificate No.<span class="no-b"><?php echo $certificate_no; ?></span></p>
                  <p>Note: Any abrasion or modification eliminates this document</p>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="certificate-form">

               <form class="form-horizontal" id="myform"  method="post">
                  <div class="form-group">
                     <label class="control-label col-sm-2">Student Name:</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" id="student_name" name="stu_name" oninput="updateText(this,'#user_name')" placeholder="Enter student name"  data-rule-required="true" data-msg-required="Name Required">
                     </div>
                  </div>
                                    <div class="form-group">
                     <label class="control-label col-sm-2">Email:</label>
                     <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Student Email"  data-rule-required="true" data-msg-required="Email Required" data-rule-email="true" data-msg-email="Valid Email Required" data-rule-remote="admin-ajax.php?action=checkEmail" data-msg-remote="Email already exists.">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-2">Course Title:</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" oninput="updateText(this,'#course_name')" name="course_title"  data-rule-required="true" data-msg-required="Course Title Required" id="input_course_name" placeholder="Enter course title">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-2">Issued Date:</label>
                     <div class="col-sm-10">
                        <input type="date" name="issue_date" oninput="updateText(this,'#Cissued_date');updateExpiry(this,'<?php echo $year; ?>')" placeholder="mm-dd-yyyy" class="form-control" placeholder="Enter issued date" >
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-2">Expiry Date:</label>
                     <div class="col-sm-10">
                        <input type="date" name="expiry_date" oninput="updateText(this,'#Cexpire-date')" class="form-control" placeholder="Enter expiry Date" placeholder="mm-dd-yyyy">
                     </div>
                  </div>

                  <div class="form-group">
                     <div class="col-sm-offset-2 col-sm-5">
                        <a class="btn btn-info custom-btn"id="certificate" >Download</a>
                        <input type="submit" name="submit"  value="Save" class="btn btn-primary custom-btn">
                     </div>
                  </div>
               </form>
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
            </div>
         </div>
      </div>
   </div>
</section>
<script>
   $(document).ready(function(){
      $( "#myform" ).validate();   
   });
   
</script>