<?php 
//importing required files 
require_once 'DbOperation.php';
require_once 'Firebase.php';
require_once 'Push.php';  

$db = new DbOperation();

$response = array(); 

$Jorel = true;


if($Jorel = true){	
	//hecking the required params 
	if($Jorel = true){

		//creating a new push
		$push = null; 
		//first check if the push has an image with it
		if(isset($_POST['image'])){
			$push = new Push(
					$_POST['title'],
					$_POST['message'],
					$_POST['image']
				);
		}else{
			//if the push don't have an image give null in place of image
			$push = new Push(
					//$_POST['title'],
					"QISeventos", 
					//$_POST['message'],
					"Você tem uma nova notificação",
					null
				);
		}

		//getting the push from push object
		$mPushNotification = $push->getPush(); 

		//getting the token from database object 
		$devicetoken = $db->getTokenByEmaila($email_log);

		//creating firebase class object 
		$firebase = new Firebase(); 

		//sending push notification and displaying result 
		echo $firebase->send($devicetoken, $mPushNotification);
	}else{
		$response['error']=true;
		$response['message']='Ainda nao precisa';
	}
}else{
	$response['error']=true;
	$response['message']='Pedido Invalido';
}

json_encode($response);