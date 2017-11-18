<?php
include_once 'dbconfig.php';
    class CrudClass{

        // declare the private property 
        private $db;

        // contructor function for Database connection
        function __construct($DB_con){
            $this->db = $DB_con;
        } // end of __construct

        // declare the property to hold the exception
        private $exp_error;
       
        /* DATA INSERT METHOD
        define create method to insert the values into the database */
        public function create($fname, $lname, $email, $contact){
            try{
                //$tsmt = $this->db->prepare("INSERT INTO tbl_users(first_name,last_name,email_id,contact_no)  VALUES(:fname, :lname, :email, :contact)");
                $sql = "INSERT INTO tbl_users(first_name,last_name,email_id,contact_no) VALUES(:fname, :lname, :email, :contact)";
                $stmt = $this->db->prepare($sql);        
                $stmt->bindparam(":fname", $fname);
                $stmt->bindparam(":lname", $lname);
                $stmt->bindparam(":email", $email);
                $stmt->bindparam(":contact", $contact);               
                $stmt->execute();
                //echo "New records created successfully";
                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        } // end of create()

         /* VIEW DATA METHOD
         define the ViewData method *//*
        public function viewData(){
            $sql = "SELECT * FROM tbl_users";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            
            if($stmt->rowCount()>0){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
             }
        } // end of viewData()
        */
    public function viewData($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['first_name']); ?></td>
                <td><?php print($row['last_name']); ?></td>
                <td><?php print($row['email_id']); ?></td>
                <td><?php print($row['contact_no']); ?></td>
                <td align="center">
                <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete-data.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>               
                <?php
                // dispaly the data as JSON
                // $x = $this->json_data = json_encode($row);
                 //echo $x;
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}

        /* GET ID METHOD
        define the getID method */
        public function getID($id){
            $stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE id=:id");
            $stmt->execute(array(":id"=>$id));
            $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
            return $editRow;
	    } // end of getID()

        /*UPDATE DATA METHOD
        define the updateData method  */
        public function updateData($id,$fname,$lname,$email,$contact){
            try{
                $sql = "UPDATE tbl_users SET first_name=:fname,last_name=:lname,email_id=:email,contact_no=:contact
                        WHERE id=:id ";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(":id", $id);
                $stmt->bindparam(":fname", $fname);
                $stmt->bindparam(":lname", $lname);
                $stmt->bindparam(":email", $email);
                $stmt->bindparam(":contact", $contact);  
                $stmt->execute();
                return true;
        }
            catch(PDOException $e){
               // echo $e->getMessage();
                $this->exp_error = $e->getMessage();
                return false;
            }
        }// end of updateData()

        /* DELETE DATA METHOD
          define deleteData method*/ 

          public function deleteData($id){
            try{
            $sql = "DELETE FROM tbl_users WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(":id",$id);
            $stmt->execute();
            }
            catch(PDOException $e){
                $this->exp_error = $e->getMessage();
            }          
          }// end of deleteData()

        // method to display PDO Exception
        public function displayException(){
            echo $this->exp_error;
        }

        /*PAGINATION*/
        public function paging($query,$records_per_page){
            $starting_position=0;
            if(isset($_GET["page_no"]))
            {
            $starting_position=($_GET["page_no"]-1)*$records_per_page;
            }
            $query2=$query." limit $starting_position,$records_per_page";
            return $query2;
        } // end of paging()

        public function paginglink($query,$records_per_page){
            
            $self = $_SERVER['PHP_SELF'];
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            $total_no_of_records = $stmt->rowCount();
            
            if($total_no_of_records > 0)
            {
                echo "<ul class='pagination'>";
                $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
                $current_page=1;
                if(isset($_GET["page_no"]))
                {
                    $current_page=$_GET["page_no"];
                }
                if($current_page!=1)
                {
                    $previous =$current_page-1;
                    echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                    echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
                }
                for($i=1;$i<=$total_no_of_pages;$i++)
                {
                    if($i==$current_page)
                    {
                        echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
                    }
                    else
                    {
                        echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                    }
                }
                if($current_page!=$total_no_of_pages)
                {
                    $next=$current_page+1;
                    echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                    echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
                }
                echo "</ul>";
            }
        }// end of paginglink()
    } // end of CrudClass
?>