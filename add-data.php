<?php
include_once 'header.php';
include_once 'classes/class.crud.php';

// instantiate a new object from class
$crud = new CrudClass($DB_con);

if(isset($_POST['btn-save'])){

    //Collet the form values
    $fname =    $_POST['fname'];
    $lname =    $_POST['lname'];
    $email =    $_POST['email'];
    $contact =  $_POST['contact_no'];
    $err_msg = "All fields are required";

    if(empty($fname) || empty($lname) || empty($email) || empty($contact) ){
       header("Location: add-data.php?error");
       return false;
    }
    //else {  
    if($crud->create($fname,$lname,$email,$contact))
      {
        header("Location: add-data.php?inserted");
      }
      else
      {
        header("Location: add-data.php?failure");
      }
    }  
  //}
?>

<!-- Page Body starts -->
<div class="container top-pad">  
  <?php
  if(isset($_GET['error'])){
    echo  "<div class='alert alert-warning'>
              <span class='err-red'>*</span> All fields are required!
          </div>";
  }
    if(isset($_GET['inserted'])) {       
      "<div class='alert alert-info'>
          Record was inserted successfully <a href='index.php'>Home</a>!
      </div>";  
    }
   else if(isset($_GET['failure'])) {
      
          "<div class='alert alert-warning'>
              <strong>SORRY!</strong> ERROR while inserting record !
          </div>";    
    } 
   ?>
    <h1>Add New Record</h1>
    
    <!-- Add Record Form -->    
  <form name="addForm" class="form-horizontal" method="POST">
    <div class="form-group">
      <label for="fname" class="col-sm-2 control-label">First Name</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="fname" id="fname" placeholder="first name">
      </div>
    </div>
    <div class="form-group">
      <label for="lname" class="col-sm-2 control-label">Last Name</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="lname" id="lname" placeholder="last name">
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-4">
        <input type="email" class="form-control" name="email" id="email" placeholder="email">
      </div>
    </div>
    <div class="form-group">
      <label for="contact_no" class="col-sm-2 control-label">Contact No</label>
      <div class="col-sm-4">
        <input type="tel" class="form-control" name="contact_no" id="contact_no" placeholder="contact number">
      </div>
    </div>   
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
       <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Create New Record
			</button>  
      <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
      </div>
    </div>
</form>
  </div><!--/.container --> 
<!-- Page Body Ends -->  
<?php include_once "footer.php"; ?>