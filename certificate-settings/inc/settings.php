<?php
$msg="";
      if(isset($_POST['submit']))
      {
         $alpha_num = $_POST['alpha_num'];
         $year = $_POST['year'];
           update_option('certificate_type',$alpha_num,'yes');
           update_option('expiry_year',$year,'yes');
           $msg="Data Inserted Successfully";    
      }
      $type = get_option('certificate_type');
      $year = get_option('expiry_year');
   ?>

<section class="page-section">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="page-title">
               Settings
            </div>
         </div>
      </div>
   </div>
</section>
<section class="settings">
   <div class="container-fluid">
      <div class="row">
         
         <div class="col-md-8">
            <div class="certificate-form">
               <?php 
                     if(isset($msg) && $msg != ''){
                  ?>
                     <p class="alert alert-success"><?php echo $msg; ?></p>
                  <?php
                  }
                  ?>
               <form class="form-horizontal" method="post">
                  <div class="form-group">
                     <label class="control-label col-sm-4">Certificate No Type :</label>
                     <div class="col-sm-8">
                        <select name="alpha_num" class="form-control">
                        	<option value="number" <?php echo $type=="number"?'selected="selected"':'';?>>Number</option>
                        	<option value="alphanumeric" <?php echo $type=="alphanumeric"?'selected="selected"':'';?>>Alphanumeric</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-4">Certificate Expiry Duration :</label>
                     <div class="col-sm-8">
                        <select name="year" class="form-control">
                        	<option>Select Year</option>
                        	<option value="1" <?php echo $year=="1"?'selected="selected"':'';?>>1 Year</option>
                        	<option value="2"<?php echo $year=="2"?'selected="selected"':'';?>> 2 Year</option>
                        	<option value="3"<?php echo $year=="3"?'selected="selected"':'';?>> 3 Year</option>
                        	<option value="4" <?php echo $year=="4"?'selected="selected"':'';?>>4 Year</option>
                        	<option value="5"<?php echo $year=="5"?'selected="selected"':'';?>> 5 Year</option>
                        </select>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <div class="col-sm-offset-4 col-sm-8">
                        <input type="submit" class="btn btn-primary" name="submit" style="width:100px;" value="Save">
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-md-8">
            <div class="page-title">
               Shortcode
            </div>
            <div class="certificate-form">
               <input type="text" class="text" value="[bg-certificate]">
               <button type="button" class="btn btnCopy btn-primary">Copy</button>
            </div>   
         </div>   
      </div>
   </div>
<!-- 
   <table class="table table-striped table-hover">
   	<thead>
   		<tr>
   			<th>Certificate No Type</th>
   			<th>Certificate Expiry Duration</th>
   		</tr>
   		<tbody>
   			<tr>
   				<td><?php echo get_option('Certi_Expire'); ?></td>
   				<td><?php echo get_option('Alpha_Num No'); ?></td>
   			</tr>
   		</tbody>
   	</thead> -->
 <script type="text/javascript">
   const text = document.querySelector('.text');
   const button = document.querySelector('.btnCopy');

   button.onclick = function () {
     // Select the text
     text.select();
     
     // Copy it
     document.execCommand('copy');
     
     // Remove focus from the input
     text.blur();
   };

 </script>     