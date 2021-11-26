     
     <?php
     //get variables for database connection
    include_once ("../files/config.php");

    class category{
        public $cat_id;
        public $cat_name;
        public $cat_status;
        public $cat_date;
        private $db;

        function __construct(){
            $this->db=new mysqli(host,un,pw,db1);
        }
		//function to add a new category
        function insert_cat(){
            $sql="INSERT INTO prod_cat (cat_name) VALUES ('$this->cat_name')"; 
            $this->db->query($sql);
            $u_id=$this->db->insert_id;//gets the primary key of last insertion
            move_uploaded_file($_FILES["uimg"]["tmp_name"],"../item/Images/$u_id.jpg");//uimg is the name giveb in the form
            return  $u_id;
            
           // echo $sql;
        //    if($this->db->affected_rows==1)
        //         return true;
        //    else
        //         return false;
        }


        
		//function to update category
		 function edit_category($edit_id){
            $sql="UPDATE prod_cat SET cat_name='$this->cat_name' where cat_id='$edit_id'";
            $this->db->query($sql);
           // echo $sql;
            move_uploaded_file($_FILES["uimg"]["tmp_name"],"../item/Images/$edit_id.jpg");
			}
		
		//function to get information from the table
            function get_all_cat(){
            $sql="SELECT * FROM prod_cat WHERE cat_status='ACTIVE' ";
            $result=$this->db->query($sql);
            $cat_array= array();
            while($row=$result->fetch_array()){
                $cat_getall=new category();
                $cat_getall->cat_id=$row["cat_id"];
                $cat_getall->cat_name=$row["cat_name"];
                $cat_getall->cat_status=$row["cat_status"];
                $cat_getall->cat_date=$row["cat_date"];
                $cat_array[]=$cat_getall;
            }
            return  $cat_array;
        }

        function get_all_cat_filter(){

            $filter_startdt=$_POST["startdt"];
           
            $filter_enddt=$_POST["enddt"];
            $filter_catid=$_POST["cat-id"];
            $filter_catname=$_POST["cat-name"];
            $filter_catstatus=$_POST["cat-status"];

            $sql="SELECT * FROM prod_cat WHERE cat_status='ACTIVE' ";

            if($filter_catid!=''){
                $sql.=" and cat_id='$filter_catid'"; 
            }
            if($filter_catname!=-1){
                $sql.=" and cat_id='$filter_catname'"; 
            }
            if($filter_catstatus!=-1){
                $sql.=" and cat_status='$filter_catstatus'"; 
            }
            // if($filter_startdt!=''){
            //     $sql.=" and cat_date='$filter_startdt'"; 
            // }
            
            if($filter_startdt!='' &&  $filter_enddt!='' )
            {
                $sql.="and cat_date BETWEEN  '".$_POST['startdt']."' and '".$_POST['enddt']."' "; 
            }
            echo $sql;

            $result=$this->db->query($sql);
            $cat_array= array();
            while($row=$result->fetch_array()){
                $cat_getall=new category();
                $cat_getall->cat_id=$row["cat_id"];
                $cat_getall->cat_name=$row["cat_name"];
                $cat_getall->cat_status=$row["cat_status"];
                $cat_getall->cat_date=$row["cat_date"];
                $cat_array[]=$cat_getall;
            }
            return  $cat_array;
        }

        function getbyid_category($cat_id){
            $sql="SELECT * FROM prod_cat WHERE cat_id=$cat_id ";
           // echo $sql;
            $result=$this->db->query($sql);
            $row=$result->fetch_array();
            $cat_getbyid=new category();

            $cat_getbyid->cat_id=$row["cat_id"];
            $cat_getbyid->cat_name=$row["cat_name"];
            $cat_getbyid->cat_status=$row["cat_status"];
            $cat_getbyid->cat_date=$row["cat_date"];
 
            return $cat_getbyid;

        }

        function getcatbyid2($cat_id){
            $sql="SELECT * FROM prod_cat WHERE cat_id='$cat_id' ";
            $result=$this->db->query($sql);
            $cat_array= array();
            while($row=$result->fetch_array()){
                $cat_getall=new category();
                $cat_getall->cat_id=$row["cat_id"];
                $cat_getall->cat_name=$row["cat_name"];
                $cat_getall->cat_status=$row["cat_status"];
                $cat_getall->cat_date=$row["cat_date"];

                $cat_array[]=$cat_getall;
            }
            return  $cat_array;
        }

        function del_category($delid){
            $sqlcheck="SELECT * FROM itemname WHERE itemcat=$delid AND itemname_status='ACTIVE'";
            $result=$this->db->query($sqlcheck);
            //echo $sqlcheck;
            //$num=$result->num_rows;
            //echo $num;
        if($result->num_rows==0){

            $sql="UPDATE prod_cat SET cat_status='INACTIVE' where cat_id='$delid'";
            $this->db->query($sql);
            //echo $sql;
            return true;
        }
            else 
            //echo "no rows";
            return false;
            
        }

        function getcatbyname($cat){
            $sql="SELECT * FROM prod_cat WHERE cat_name='$cat' ";
            //echo $sql;
             $result=$this->db->query($sql);
             $row=$result->fetch_array();

             $cat_getbyid=new category();
 
             $cat_getbyid->cat_id=$row["cat_id"];
             $cat_getbyid->cat_name=$row["cat_name"];
            
  
             return $cat_getbyid;
 
        }

        


    }


?>
