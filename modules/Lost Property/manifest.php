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
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

//This file describes the module, including database tables

//Basic variables
$name="Lost Property" ; //The name of the variable as it appears to users. Needs to be unique to installation. Also the name of the folder that holds the unit.
$description="Find your lost items here." ; //Short text description
$entryURL="lostproperty.php" ; //The landing page for the unit, used in the main menu
$type="Additional" ; //Do not change.
$category="Other" ; //The main menu area to place the module in
$version="0.0.1" ; //Verson number
$author="Stephanie Ng" ; //Your name
$url="" ; //Your URL

//Module tables & gibbonSettings entries

$moduleTables[0]="CREATE TABLE `lostProperty` (
    `itemID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
    `name` varchar (255) NOT NULL,
    `description` text NOT NULL,
    `gibbonPersonIDRetriever` int(10) unsigned zerofill,
    `gibbonPersonIDFounder` int(10) unsigned zerofill NOT NULL,
    `dateRetrieved` date,
    `dateFound` date NOT NULL,

    PRIMARY KEY (`itemID`)   
);" ;
//One array entry for every database table you need to create. Might be nice to preface the table name with the module name, to keep the db neat. 
//$moduleTables[1]="" ; //Also can be used to put data into gibbonSettings. Other sql can be run, but resulting data will not be cleaned up on uninstall.


//Action rows 
//One array per action
$actionRows[0]["name"]="Browse Items" ; //The name of the action (appears to user in the right hand side module menu)
$actionRows[0]["precedence"]="0"; //If it is a grouped action, the precedence controls which is highest action in group
$actionRows[0]["category"]="" ; //Optional: subgroups for the right hand side module menu
$actionRows[0]["description"]="Find your lost items here" ; //Text description
$actionRows[0]["URLList"]="lostproperty.php" ; //List of pages included in this action
$actionRows[0]["entryURL"]="lostproperty.php" ; //The landing action for the page.
$actionRows[0]["defaultPermissionAdmin"]="Y" ; //Default permission for built in role Admin
$actionRows[0]["defaultPermissionTeacher"]="Y" ; //Default permission for built in role Teacher
$actionRows[0]["defaultPermissionStudent"]="Y" ; //Default permission for built in role Student
$actionRows[0]["defaultPermissionParent"]="Y" ; //Default permission for built in role Parent
$actionRows[0]["defaultPermissionSupport"]="Y" ; //Default permission for built in role Support
$actionRows[0]["categoryPermissionStaff"]="Y" ; //Should this action be available to user roles in the Staff category?
$actionRows[0]["categoryPermissionStudent"]="Y" ; //Should this action be available to user roles in the Student category?
$actionRows[0]["categoryPermissionParent"]="Y" ; //Should this action be available to user roles in the Parent category?
$actionRows[0]["categoryPermissionOther"]="Y" ; //Should this action be available to user roles in the Other category?

$actionRows[1]["name"]="Add Items" ;
$actionRows[1]["precedence"]="1" ;
$actionRows[1]["category"]="" ;
$actionRows[1]["description"]="Add your lost items here" ;
$actionRows[1]["URLList"]="lostproperty_add.php" ;
$actionRows[1]["entryURL"]="lostproperty_add.php" ;
$actionRows[1]["defaultPermissionAdmin"]="Y" ;
$actionRows[1]["defaultPermissionTeacher"]="Y" ;
$actionRows[1]["defaultPermissionStudent"]="Y" ;
$actionRows[1]["defaultPermissionParent"]="Y" ;
$actionRows[1]["defaultPermissionSupport"]="Y" ;
$actionRows[1]["categoryPermissionStaff"]="Y" ;
$actionRows[1]["categoryPermissionStudent"]="Y" ;
$actionRows[1]["categoryPermissionParent"]="Y" ;
$actionRows[1]["categoryPermissionOther"]="Y" ;
//Hooks
$hooks[0]="INSERT INTO `gibbonHook` (`gibbonHookID`, `name`, `type`, `options`, gibbonModuleID) VALUES (NULL, 'Lost Property', 'Public Home Page ', '', (SELECT gibbonModuleID FROM gibbonModule WHERE name='$name'));" ; //Serialised array to create hook and set options. See Hooks documentation online.
?>
