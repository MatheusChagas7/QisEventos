<?php
// -------------------------------------------------------- conexao criada pela gente --------------------------------------------------------

$conpdo = new PDO('mysql:host=localhost;dbname=ilion548_qiseventos', "ilion548_qis", "j0L8sI73pj");
$conpdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $con = mysqli_connect("localhost","bacoeventos","&T_P+%s52wAg","bacoeven_baco");
$con = mysqli_connect("localhost","ilion548_qis","j0L8sI73pj","ilion548_qiseventos");
mysqli_set_charset($con,"utf8");
define('DB_USERNAME', 'ilion548_qis');
define('DB_PASSWORD', 'j0L8sI73pj');
define('DB_HOST', 'localhost');
define('DB_NAME', 'ilion548_qiseventos');

// Checar conexao
if(mysqli_connect_error()){

$erro = mysqli_connect_error();
//email da qis
$from = "suporte@qiseventos.com.br";
// envia um e-mail informando o erro
if (PHP_VERSION_ID < 50600) {
    iconv_set_encoding('input_encoding', 'UTF-8');
    iconv_set_encoding('output_encoding', 'UTF-8');
    iconv_set_encoding('internal_encoding', 'UTF-8');
} else {
    ini_set('default_charset', 'UTF-8');
}

$headers = "MIME-Version: 1.1\r\n";
$headers .= "From: QIS@scripts_interno\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "Content-type: text/html; charset=iso-8859-1 \r\n";
('Content-type: text/html; charset=iso-8859-1 \r\n');

$subject = "[QIS] CONEXAO";
$mensagem1  = "Mensagem enviado pelo site da QISeventos em : SCRIPT DE CONEXAO com BANCO DE DADOS<br />
ERRO: {$erro}.";

$subject = utf8_decode($subject);
$mensagem1 = utf8_decode($mensagem1);

$send_contact=mail($from, $subject, $mensagem1, $headers);  
  
}else{
    mysqli_set_charset($con,"utf8");

define('cade_a_chave','AAAATQLrAvE:APA91bGswqjNByBg369F66m5xwgEMMnqgl7Gnf_C5yFYATZ7CdBJlbjnHkviDQXc_n2tSbZD1_SVnRS4Q_r6kMmR-Eh7Uz6YFTr0H1hw2x1ASDi3m6pX-Ds7t8O2hZ3AHfvHG8HPLrYe');

}
// -------------------------------------------------------- conexao criada pela gente --------------------------------------------------------

// --------------------------------------------------------- conexao firebase e key ----------------------------------------------------------
//config
// define('DB_USERNAME', 'bacoeventos');
// define('DB_PASSWORD', '&T_P+%s52wAg');
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'bacoeven_baco');


// define('teste','AAAAk7SIggI:APA91bFUtyM_DmfaO3eXJ6KLduZnaIYHTGobEpKLjtfBVsTzbFMCasN3JqAGsvQNjUdo2zm5pPj-f5UVUq4bjJfQfqlEQrYSuG0l-49GHHgjsxK0qwSacmUfjWSHLq_DUanz32NWkICX' );

// --------------------------------------------------------- conexao firebase e key ----------------------------------------------------------

// --------------------------------------------------------- conexao nao sei ----------------------------------------------------------
//dbconnect
class DbConnect{

    //Variable to store database link
    private $con;
 
    //Class constructor
    function __construct(){
 
    }
 
    //This method will connect to the database
    function connect(){
        //Including the constants.php file to get the database constants
 
        //connecting to mysql database
        $this->con = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
        //Checking if any error occured while connecting
        if (mysqli_connect_errno()) {
            echo "Falha ao se conectar no MySQL: " . mysqli_connect_error();
        }
 
        //finally returning the connection link 
        return $this->con;
    }
 
}
// --------------------------------------------------------- conexao nao sei ----------------------------------------------------------

?>