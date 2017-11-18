<?php
include_once 'classes/class.crud.php';

// instantiate a new object from class
$crud = new CrudClass($DB_con);
// include the header file
include_once 'header.php';
?>
<!-- Page Body starts -->
<div class="container top-pad">
<a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add New Records</a>
</div>
<div class="container ">  
    <h1>List Of Records</h1>
	 	 <table class='table table-bordered table-responsive'>
     <tr>
     <th>#</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>E - mail ID</th>
     <th>Contact No</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
		$query = "SELECT * FROM tbl_users";       
		$records_per_page=3;
		$newquery = $crud->paging($query,$records_per_page);
		$crud->viewData($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>

 </div><!--/.container --> 
<!-- Page Body Ends -->  
<?php include_once "footer.php"; ?>