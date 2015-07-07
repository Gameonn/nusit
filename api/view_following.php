<?php
	require_once('../phpInclude/dbconn.php');
	require_once('../phpInclude/AdminClass.php');

	$token=$_REQUEST['token'];
	$others_id = $_REQUEST['others_id'];
	$data=array();

	if (!empty($token) && empty($others_id)) {
		$users_id=getUsersId($token);
		if (!empty($users_id)) {
			$result=getAllFollowing($users_id);
			if(!empty($result)){
				$success = "1";
				$msg="Following exist";
				$data=$result;
			}
				
			else{
				$success="1";
				$msg="No following";
			}
		}
		else{
			$success="0";
			$msg="No such user exist!";}
		
	}
	
	elseif (!empty($others_id)) {
		$others_id = checkUsersIdExist($others_id);
		if($others_id){
			$result=getAllFollowing($others_id);
			if(!empty($result)){
				$success = "1";
				$msg="Following exist";
				$data=$result;
			}
				
			else{
				$success="1";
				$msg="No following";
			}
		}
		else{
			$success="0";
			$msg="No such user exist!";}		
	}
	else{
		$success="0";
		$msg="Incomplete parameters!";		
	}
		echo json_encode(array("success"=>$success, "msg"=>$msg, "data"=>$data));
?>