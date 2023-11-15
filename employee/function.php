<?php
class Signup{
	private $conn;
	function __construct()
	{
		require "DB_Connect.php";	
		$dbConn=new dbConnect();
		$this->conn = $dbConn->Connect();
		
	}
    public function Select($value){
  
            //FOLLING STATEMENT IS NOW CORRECT
            $queryrun=mysqli_query($this->conn, $value);
			$result=mysqli_fetch_array($queryrun);
			return $result["cnt"];
			
    }
	public function SelectF($query,$value1){
            //FOLLING STATEMENT IS NOW CORRECT
            $queryrun=mysqli_query($this->conn, $query);
			$result=mysqli_fetch_array($queryrun);
            $cntRows = mysqli_num_rows($queryrun);
			if ($cntRows>0)
			{
				return $result[$value1];
			}
			else
			{
				return "";
			}
			
    }
	public function FunctionQuery($query,$return_id = false){
  
            //FOLLING STATEMENT IS NOW CORRECT
			if($runi=mysqli_query($this->conn,$query)){
				$id = $this->conn->insert_id;
				
				if($return_id==true){
					return $id;
				}
				else{
					return "Success";
				}
				
			}
			else{
				   return "error";
			}
			
    }
	
	  public function FunctionJSON($value){
			// array for JSON response
			$response = array();
            $queryrun=mysqli_query($this->conn, $value);
			$cntRows = mysqli_num_rows($queryrun);
			if ($cntRows>0)
			{
				//array_push($response,array("row_count"=>$cntRows));
				while($row = mysqli_fetch_assoc($queryrun)){
					foreach($row as $column => $value) {
						if($value==null){
							$value="";
						}
						array_push($response,array($column=>$value));
					}
				}
			}
			else
			{
				$value="";
				for($i = 0; $i < mysqli_num_fields($queryrun); $i++) {
					$field_info = mysqli_fetch_field($queryrun);
					$col = "{$field_info->name}";
					array_push($response,array($col=>$value));
				}
			}
			return json_encode(array('response'=>$response));
			
    } 

	public function FunctionDataCount($value){
			// array for JSON response
			$response = array();
            $queryrun=mysqli_query($this->conn, $value);
			$cntRows = mysqli_num_rows($queryrun);
			if ($cntRows>0)
			{

				while($row = mysqli_fetch_assoc($queryrun)){
					$record = array();
					foreach($row as $column => $value) {
						if($value==null){
							$value="";
						}
						$record[$column]=$value;
					}
					array_push($response,$record);
					
				}
				
			}
			
			return (count($response));
			
    }
	
}


?>