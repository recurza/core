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

//TODO: make sure name & desc cannot be blank
//TODO: edit and delete item
//TODO: retrieve item
//FIXME: CSS for Add Items

@session_start() ;

if (isActionAccessible($guid, $connection2, "/modules/Lost Property/lostproperty.php")==FALSE) {
    //Acess denied
    print "<div class='error'>" ;
    print "You do not have access to this action." ;
    print "</div>" ;
}
else {
    print "<div class='trail'>";
    print "<div class='trailHead'><a href='" . $_SESSION[$guid]["absoluteURL"] . "'>" . _("Home") . "</a> > <a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/" . getModuleName($_GET["q"]) . "/" . getModuleEntry($_GET["q"], $connection2, $guid) . "'>" . _(getModuleName($_GET["q"])) . "</a> > </div><div class='trailEnd'>" . _('Browse Items') . "</div>" ;
    print "</div>" ;

    print "<h1>Browse Lost Items</h1>";

    print "<table cellspacing='0' style='width: 100%; margin-top: -30px'>";
    print "<th>Name</th>";
    print "<th>Description</th>";
    print "<th>Date Found</th>";

    try {
	$data=array("itemID"=>$row["itemID"]);
	$sql="SELECT name, description, dateFound FROM lostProperty";
	$result=$connection2->prepare($sql);
	$result->execute($data);
    }
    catch(PDOException $e) { 
	print "<div class='error'>" . $e->getMessage() . "</div>" ; 
    }

    $items=array();

    while($row=$result->fetch()) {
	print "<tr>";
	print "<td>";
	print $row["name"];
	print "</td>";
	print "<td>";
	print $row["description"];
	print "</td>";
	print "<td>";
	print $row["dateFound"];
	print "</td>";
	print "</tr>";
	print "<br>";
    }

    print "</table>";
}
?>
