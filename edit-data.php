<?php
include_once 'classes/class.crud.php';
// instantiate a new object from class
$crud = new CrudClass($DB_con);

// collect the form update values
if(isset($_POST['btn-update'])){
    $id = $_GET['edit_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['contact_no'];

    if($crud->updateData($id,$fname,$lname,$email,$contact))
    {
        $msg = "<div class='alert alert-info'>
                Record was updated successfully <a href='index.php'>Home</a>!
                </div>";
    }
    else
    {
        $msg = "<div class='alert alert-warning'>
                <strong>SORRY!</strong> ERROR while updating record !
                </div>";
    }
} //

// get the id and pass it to getID method
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    /*extract() function uses array keys as variable names and values as variable values. 
     For each element it will create a variable in the current symbol table.*/
    extract($crud->getID($id));
}

// include the header file
include_once 'header.php';
?>
<!-- Page Body starts -->
<div class="container top-pad ">  
    <h1>Update Record</h1>
    <!-- Display the message -->
    <?php
    if(isset($msg)){
        echo $msg;
        echo $crud->displayException();
    }
    ?>
    <!-- Add Record Form -->    
  <form class="form-horizontal" method="POST">
    <div class="form-group">
      <label for="fname" class="col-sm-2 control-label">First Name</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $first_name; ?>" placeholder="first name">
      </div>
    </div>
    <div class="form-group">
      <label for="lname" class="col-sm-2 control-label">Last Name</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $last_name ?>" placeholder="last name">
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-4">
        <input type="email" class="form-control" name="email" id="email" value="<?php echo $email_id ?>" placeholder="email">
      </div>
    </div>
    <div class="form-group">
      <label for="contact_no" class="col-sm-2 control-label">Contact No</label>
      <div class="col-sm-4">
        <input type="tel" class="form-control" name="contact_no" id="contact_no" value="<?php echo $contact_no ?>" placeholder="contact number">
      </div>
    </div>   
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
       <button type="submit" class="btn btn-primary" name="btn-update">
    		<span class="glyphicon glyphicon-plus"></span> Update Record
			</button>  
      <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancel</a>
      </div>
    </div>
</form>

 </div><!--/.container --> 
<!-- Page Body Ends -->  
<?php include_once "footer.php"; ?>