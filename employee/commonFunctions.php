<?php
class Common {
	
	public function getIPAddress(){
		
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip_address = $_SERVER['HTTP_CLIENT_IP'];
		}
		//whether ip is from proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  {
			$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		//whether ip is from remote address
		else{
			$ip_address = $_SERVER['REMOTE_ADDR'];
		}
		date_default_timezone_set("Asia/Kolkata");
		$date=date("Y-m-d h:i:sa");
		
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip_address = $_SERVER['HTTP_CLIENT_IP'];
		}
		//whether ip is from proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		//whether ip is from remote address
		else{
			$ip_address = $_SERVER['REMOTE_ADDR'];
		}
		return $ip_address;
 }
 public function getSettingValue($pass){
		
	$myfile = fopen("../assets/js/custom/Settings.txt", "r") or die("Unable to open file!");
	//$search = "name";
	// Read from file
	$lines = file('../assets/js/custom/Settings.txt');
	foreach($lines as $line)
	{
	  // Check if the line contains the string we're looking for, and print if it does
	  if(strpos($line, $pass) !== false){
		$str_arr = explode ("=", $line); 
		return trim($str_arr[1]);
		break;
	  }
	  
	} 
	 
	fclose($myfile);
 }

public function getCommonDataValue($pass){
	return $this->getSettingValue($pass);
 }

}
?>