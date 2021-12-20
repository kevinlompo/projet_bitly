<?php
               
class pdoService {

//1. Variables membres
private $host  = '';
private $user  = '';
private $pass  = '';
private $dbh= '';
// 2. constructeur plein
public function __construct($host='localhost',$user='root',$pass='')
{       
  $this->host=$host;
  $this->user=$user;
  $this->pass=$pass;
  $dbh = new PDO("mysql:host=$host;dbname=bddbanque", $user , $pass );
 //echo 'Connected to database<br />';
}
// 3. les fonctions et procédures

// fonction qui effectue la  connexion à la base de données sous Mysql
	public function connect()
	{
		$host="localhost";


		$user="root";
		$pass="";
		$dbh = new PDO("mysql:host=$host;dbname=bddbanque", $user , $pass );
		//echo "connexion etabli  ".$dbh->errorCode(); 
		return $dbh;
	}
	
//  fonction qui effectue la consultation de données dans une table  
function Tablesql($sql){
$os =new pdoService();
try {
   $dbh= $os->connect();
   $stmt = $dbh->query($sql);
   echo "<div>";
	echo "<table class='CSSTableGenerator'>";
    $fields = array_keys($stmt->fetch(PDO::FETCH_ASSOC));//retourne les noms des colonnes dans un array
     echo "<tr>";
	 foreach($fields as $key=>$val)//affiche les norms des colonnes
         {
		  echo "<th>$val<th>"; 
         }
		 echo "</tr>";
	$stmt = $dbh->query($sql);
    while($res = $stmt->fetch(PDO::FETCH_NUM)){
	echo "<tr>";
    foreach($res as $key=>$val)
{
if(strlen($val)>50) {
echo '<th><img src="data:image/jpeg;base64,'.base64_encode($val).'" height="100" width="200"><th>'; 
break;
}
		else { echo "<th>$val<th>"; }
        }
		echo "<tr>";
    }
    $dbh = null;
	echo "</table>";
	echo "</div>";
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}

 // fonction qui effectue l'insertion de données dans une table
 function f_insert($sql) {
  $os =new pdoService();
try {
   $dbh= $os->connect();
   $res=$dbh->exec($sql);
  if($res=1)
  {
    echo "une insertion vient d'etre realisee dans la database" ;
  }else {
   echo "erreur ,pas d'insertion $res->errorcode() ";
  }
  $dbh=null;
}catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}
//fonction qui effectue la consultation de données dans une table  
function Consult_table1($sql) {
$os =new pdoService();
try {
$dbh= $os->connect();
$stmt =$dbh->query($sql);
 if(!$stmt){  
 echo "Lecture impossible";
 } else {  
  while ($row =$stmt->fetch(PDO::FETCH_NUM))   { 
   foreach($row as $val)    {     
   echo $val;  
   }   
   echo "<hr />"; 
   }
   $dbh = null;
 }
 }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}
// fonction qui retourne un  id 
public function retour_id($sql) {
$os =new pdoService();
try {
    $dbh= $os->connect();
    $stmt = $dbh->query($sql);
    $obj = $stmt->fetch(PDO::FETCH_OBJ);
    return $obj->UserId;
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}

//fonction qui réalise le login avec création session			
public function login_session($un,$pw)
{
$sql="SELECT UserId FROM user WHERE username='".$un."' AND password='".$pw."'";
$os =new pdoService();
try {
  $dbh= $os->connect();
  $stmt = $dbh->prepare($sql);  
  $stmt->execute();  
  $req = $stmt->rowCount();
  $r = false;
if($req==1)
{
   session_start();
   $row= $stmt->fetchAll(PDO::FETCH_ASSOC);
	$_SESSION['userId']=$row['userId'];
	$r= true;
	return $r;
}
else
$r= false;
return $r;
	
}catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}	
}//fin class