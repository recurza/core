<?php
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

include "../../functions.php" ;
include "../../config.php" ;

//New PDO DB connection
try {
  	$connection2=new PDO("mysql:host=$databaseServer;dbname=$databaseName;charset=utf8", $databaseUsername, $databasePassword);
	$connection2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connection2->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
  echo $e->getMessage();
}

@session_start() ;

//Set timezone from session variable
date_default_timezone_set($_SESSION[$guid]["timezone"]);

$URL=$_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/" . getModuleName($_POST["address"]) . "/space_manage_add.php" ;

if (isActionAccessible($guid, $connection2, "/modules/School Admin/space_manage_add.php")==FALSE) {
	//Fail 0
	$URL.="&addReturn=fail0" ;
	header("Location: {$URL}");
}
else {
	//Proceed!
	$name=$_POST["name"] ; 	
	$type=$_POST["type"] ;
	$gibbonPersonID1=$_POST["gibbonPersonID1"] ;
	if ($gibbonPersonID1=="") {
		$gibbonPersonID1="NULL" ;
	}
	$gibbonPersonID2=$_POST["gibbonPersonID2"] ;
	if ($gibbonPersonID2=="") {
		$gibbonPersonID2="NULL" ;
	}
	$capacity=$_POST["capacity"] ;
	$computer=$_POST["computer"] ;
	$computerStudent=$_POST["computerStudent"] ;
	$projector=$_POST["projector"] ;
	$tv=$_POST["tv"] ;
	$dvd=$_POST["dvd"] ;
	$hifi=$_POST["hifi"] ;
	$speakers=$_POST["speakers"] ;
	$iwb=$_POST["iwb"] ;
	$phoneInternal=$_POST["phoneInternal"] ;
	$phoneExternal=preg_replace('/[^0-9+]/', '', $_POST["phoneExternal"]) ;
	$comment=$_POST["comment"] ;
	
	//Validate Inputs
	if ($name=="" OR $type=="" OR $computer=="" OR $computerStudent=="" OR $projector=="" OR $tv=="" OR $dvd=="" OR $hifi=="" OR $speakers=="" OR $iwb=="") {
		//Fail 3
		$URL.="&addReturn=fail3" ;
		header("Location: {$URL}");
	}
	else {
		//Check unique inputs for uniquness
		try {
			$data=array("name"=>$name); 
			$sql="SELECT * FROM gibbonSpace WHERE name=:name" ;
			$result=$connection2->prepare($sql);
			$result->execute($data);
		}
		catch(PDOException $e) { 
			//Fail 2
			$URL.="&addReturn=fail2" ;
			header("Location: {$URL}");
			break ;
		}
		
		if ($result->rowCount()>0) {
			//Fail 4
			$URL.="&addReturn=fail4" ;
			header("Location: {$URL}");
		}
		else {
			//Write to database
			try {
				$data=array("name"=>$name, "type"=>$type, "gibbonPersonID1"=>$gibbonPersonID1, "gibbonPersonID2"=>$gibbonPersonID2, "capacity"=>$capacity, "computer"=>$computer, "computerStudent"=>$computerStudent, "projector"=>$projector, "tv"=>$tv, "dvd"=>$dvd, "hifi"=>$hifi, "speakers"=>$speakers, "iwb"=>$iwb, "phoneInternal"=>$phoneInternal, "phoneExternal"=>$phoneExternal, "comment"=>$comment); 
				$sql="INSERT INTO gibbonSpace SET name=:name, type=:type, gibbonPersonID1=:gibbonPersonID1, gibbonPersonID2=:gibbonPersonID2, capacity=:capacity, computer=:computer, computerStudent=:computerStudent, projector=:projector, tv=:tv, dvd=:dvd, hifi=:hifi, speakers=:speakers, iwb=:iwb, phoneInternal=:phoneInternal, phoneExternal=:phoneExternal, comment=:comment" ;
				$result=$connection2->prepare($sql);
				$result->execute($data);
			}
			catch(PDOException $e) { 
				//Fail 2
				$URL.="&addReturn=fail2" ;
				header("Location: {$URL}");
				break ;
			}
			
			//Success 0
			$URL.="&addReturn=success0" ;
			header("Location: {$URL}");
		}
	}
}
?>