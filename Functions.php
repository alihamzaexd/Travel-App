<?php

function MakeConnection(){
	$dbname = "mydb";
	$host        = "host = localhost";
	$port        = "port = 5432";
	$dbname      = "dbname = $dbname";
	$credentials = "user=postgres password=postgres";
	$db = pg_connect( "$host $port $dbname $credentials" );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
     
   }
   return $db;


}

function MakeConnection2(){
	$dbname = "TravelSolution";
	$host        = "host = localhost";
	$port        = "port = 5432";
	$dbname      = "dbname = $dbname";
	$credentials = "user=postgres password=postgres";
	$db = pg_connect( "$host $port $dbname $credentials" );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
     
   }
   return $db;


}

function CreateDatabase($db){
	$sql =<<<EOF
      CREATE TABLE Details
      (ID serial PRIMARY KEY     NOT NULL,
      FName           TEXT    NOT NULL,
      LName       TEXT     NOT NULL
	  );
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
   } else {
      echo "Table created successfully\n";
   }
	
}

function InsertData($db,$fname,$lname){
	
	$sql2 =<<<EOF
		INSERT INTO Details(FName,LName)
		VALUES ('{$fname}','{$lname}');
EOF;
	
	$ret2 = pg_query($db, $sql2);
   if(!$ret2) {
      echo pg_last_error($db);
   } else {
      echo "Entery Added successfully\n";
   }

}


function getcountry($db)
{

$countries= array();
	$sql2 =<<<EOF
		SELECT * FROM countries_list;
EOF;

$ret2 = pg_query($db, $sql2);

while($row = pg_fetch_assoc($ret2)) {
	
   array_push($countries,$row);
   }
 return json_encode($countries);	
	
}


function ShowData2($db){
	
	$sql3 =<<<EOF
		select * from Details;
EOF;
	$ret3 = pg_query($db, $sql3);
	if(!$ret3) {
      echo pg_last_error($db);
   } else {
     
   while($row = pg_fetch_row($ret3)) {
   echo "<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td></tr>";
   }
   echo "Operation done successfully\n";
   }
   }

?>