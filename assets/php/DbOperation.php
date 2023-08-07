<?php

class DbOperation
{
    //Database connection link
    private $con, $stmt, $nCols, $colsNames;

    //Class constructor
    function __construct(){
		//fara a conexao com banco de dados
		include_once 'conexao.php';

        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();

        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
    }
	
	public function getTokenByEmaila($cliente){
		$stmt = $this->con->prepare("SELECT token FROM token WHERE fk_token_usu = ?");
		$stmt->bind_param("s",$cliente);
		$stmt->execute(); 
		$result = $stmt->bind_result($token);
		$tokens = array(); 
		while($teste = $stmt->fetch()){
			$teste =  $token;
			array_push($tokens, $teste);
		}
		return $tokens; 

	}
	
	public function getAllTokensF($email_favorito){
		$stmt = $this->con->prepare("SELECT token FROM token WHERE fk_token_usu = ?");
		$stmt->bind_param("s",$email_favorito);
		$stmt->execute(); 
		$result = $stmt->bind_result($token);
		$tokens = array(); 
		while($teste = $stmt->fetch()){
			$teste =  $token;
			array_push($tokens, $teste);
		}
		return $tokens; 

	}   

}
