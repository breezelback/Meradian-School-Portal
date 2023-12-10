<?php 
require('../function_php/conn.php'); 
//$_GET['academic_year_id'];
//$_GET['student_id'];
$sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created`, `student_status`, `enrollment_status` FROM `tbl_user` WHERE id = '.$_GET['student_id'];
$exec = $conn->query($sql);
$student = $exec->fetch_assoc();

 $sql1 = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` WHERE status = "Active" ';
  $exec1 = $conn->query($sql1);
  $active = $exec1->fetch_assoc();



  $selectSection = 'SELECT `id`, `school_year`, `section`, `status`, `date_created` FROM `tbl_section` WHERE id = '.$student['section'];
  $execSection = $conn->query($selectSection);
  $section = $execSection->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<?php include '_include_header.php'; ?>
  <style>
    body
    {
      font-size: 12px;
    }
  </style>
</head>
<body>


  <div class="container">
    <div class="row">
      <div class="col-6">
        <center>
          <h6>REPORT ON LEARNING PROGRESS AND ACHIEMENT</h6>
          <table class="table table-bordered mt-5">
            <thead>
            <tr>
              <!-- <th><center>ID NUMBER</center></th>
              <th><center>NAME</center></th>
              <th><center>YEAR & SECTION</center></th> -->
              <th>CODE</th>
              <th>SUBJECT</th>
              <th>1ST</th>
              <th>2ND</th>
              <th>3RD</th>
              <th>4TH</th>
              <th>AVERAGE</th>
              <!-- <th><center>ACTION</center></th> -->
            </tr>
            </thead>
            <tbody>

              <?php   

                  $selectStudSched = ' SELECT `id`, `student_id`, `schedule_id`, `date_created`, `academic_year_id` FROM `tbl_student_schedule` WHERE student_id = '.$_GET['student_id'].' AND academic_year_id = '.$_GET['academic_year_id'];
                  $execStudSched = $conn->query($selectStudSched);
                  while ($stud = $execStudSched->fetch_assoc() ) {

                    $selectSched = ' SELECT `id`, `teacher_id`, `subject_id`, `teaching_day`, `teaching_time`, `schedule_code`, `status`, `date_created`, `teaching_time_to`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `school_year`, `section` FROM `tbl_schedule` WHERE id = '.$stud['schedule_id'];
                    $execSched = $conn->query($selectSched);
                    $sched = $execSched->fetch_assoc();

                    $selectSub = ' SELECT `id`, `subject_name`, `subject_code`, `date_created`, `school_year` FROM `tbl_subject` WHERE id = '.$sched['subject_id'];
                    $execSub = $conn->query($selectSub);
                    $subject = $execSub->fetch_assoc();

                    $selectSched = ' SELECT `id`, `stud_schedule_id`, `first`, `second`, `third`, `fourth`, `average`, `academic_year_id`, `date_created` FROM tbl_grades WHERE stud_schedule_id = '.$stud['id'];
                    $execSched = $conn->query($selectSched);
                    $rowGrade = $execSched->fetch_assoc();

                    $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$stud['student_id'];
                    $exec = $conn->query($sql);
                    $row = $exec->fetch_assoc();
                   
              ?>
                <tr style="font-size: 14px;">
                
                  <td><?php echo $subject['subject_code']; ?></td>
                  <td><?php echo $subject['subject_name']; ?></td>
                  <td><?php echo (empty($rowGrade['first']) ? 0 : $rowGrade['first']); ?></td>
                  <td><?php echo (empty($rowGrade['second']) ? 0 : $rowGrade['second']); ?></td>
                  <td><?php echo (empty($rowGrade['third']) ? 0 : $rowGrade['third']); ?></td>
                  <td><?php echo (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth']); ?></td>
                  <td><b><?php echo ((empty($rowGrade['first']) ? 0 : $rowGrade['first']) + (empty($rowGrade['second']) ? 0 : $rowGrade['second']) + (empty($rowGrade['third']) ? 0 : $rowGrade['third']) + (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth'])) / 4; ?></b> </td>
                
                </tr>
              <?php  }  ?>

            </tbody>  
          </table>

          <table class="my-3">
            <thead>
              <th>Description</th>        
              <th>Grading Scale</th>  
              <th>Remarks</th>
            </thead>
            <tbody>
              <tr>
                <td>Outstanding</td>    
                <td>90-100</td> 
                <td>Passed</td>
              </tr>

              <tr>
                <td>Very Satisfactory</td>
                <td>85-89</td>
                <td>Passed</td>
              </tr>
              <tr>
                <td>Satisfactory</td>
                <td>80-84</td>
                <td>Passed</td>
              </tr>
              <tr>
                <td>Fairly Satisfactory</td>
                <td>15-79</td>
                <td>Passed</td>
              </tr>
              <tr>  
                <td>Did not meet expectations</td>  
                <td>Below 75</td> 
                <td>Failed</td>
              </tr>
            </tbody>
          </table>

          <h6>Parent/ Guardian Signature</h6>
          <p>First Quarter _____________________________________</p>
          <p>Second Quarter____________________________________</p>
          <p>Third Quarter______________________________________</p>
          <p>Fourth Quarter_____________________________________</p>
        </center>
      </div>
      <div class="col-6">
        <center>
          <img src="../images/logo.jpg" alt="" width="50">
          Republic of the Philippines<br>
          Department of Education<br>
          Division of Batangas<br>
          Lipa City</h6>
          <h5>The Meradian School Inc.</h5>
          City Park Avenue, Brgy. Sabang Lipa City, Batangas<br>
          PROGRESS REPORT CARD<br>
          School Year <?php echo $active['academic_year']; ?><br>
          <p>Name: __________________<u><?php echo $student['firstname'].' '.$student['lastname'] ?></u>__________________</p>
          <p>LRN: _______<u><?php echo $student['id_number']; ?></u>_____Grade:___<u><?php echo $student['school_year']; ?></u>__________</p>
          <p>Age: __<u><span id="age"></span></u>____Sex:___<u><?php echo $student['gender']; ?></u>__Section:___<u><?php echo $section['section']; ?></u>____________</p>
        </center>
        <p>Dear Parent,</p>
        <p style="text-indent:50px;">
          This report cards shows the ability and progress your child has made in the different learning areas as well as his/her progress in core values. The school welcomes you should you desire to know more about your child’s progress
        </p>
        <div class="row">
          <div class="col-6">
            <p>Principal</p>
          </div>
          <div class="col-6">
            <p class="float-right">Teacher</p>
          </div>
        </div>
        <center>
          CERTIFICATE OF TRANSFER
          <p>Admitted to Grade : ______________Section:______________</p>
          <p>Eligibility for Admission to Grade  : ____________________________</p>
        </center>
        <div class="row">
          <div class="col-6">
            <p>Principal</p>
          </div>
          <div class="col-6">
            <p class="float-right">Teacher</p>
          </div>
        </div>
        <center>
          CERTIFICATE OF ELIGIBILITY TO TRANSFER
          <p>Admitted in : ________________________________________</p>
          <p>Date  : ________________________</p>
        </center>
        <div class="row">
          <div class="col-6">
            <p>Principal</p>
          </div>
          <div class="col-6">
            <p class="float-right">Teacher</p>
          </div>
        </div>
      </div>
    </div>
  </div>


						
	
	<?php include'_include_footer.php'; ?>
	<script>

    var css = '@page { size: landscape; }',
    head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

    style.type = 'text/css';
    style.media = 'print';

    if (style.styleSheet){
      style.styleSheet.cssText = css;
    } else {
      style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);

    function getAge(dateString) {
      var today = new Date();
      var birthDate = new Date(dateString);
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
          age--;
      }
      // return age;
      $('#age').text(age);
    }

  // $('#birthdate').on('change', function(){
  //   let raw_date = $(this).val();
  //   var date_val = getAge(raw_date);
  //   $('#age').val(date_val);
  // });

  getAge('<?php echo $student['birthdate']; ?>');




		window.print();
	</script>
</body>
</html>