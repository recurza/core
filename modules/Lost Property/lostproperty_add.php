<?php

@session_start();

if (isActionAccessible($guid, $connection2, "/modules/Lost Property/lostproperty_add.php")==FALSE) {
    //Acess denied
    print "<div class='error'>" ;
    print "You do not have access to this action." ;
    print "</div>" ;
}
else {
    print "<div class='trail'>";
    print "<div class='trailHead'><a href='" . $_SESSION[$guid]["absoluteURL"] . "'>" . _("Home") . "</a> > <a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/" . getModuleName($_GET["q"]) . "/" . getModuleEntry($_GET["q"], $connection2, $guid) . "'>" . _(getModuleName($_GET["q"])) . "</a> > </div><div class='trailEnd'>" . _('Add Items') . "</div>" ;
    print "</div>";

    if(isset($_POST['name'])) {
	try {
	    $data=array("itemID"=>$row["itemID"]);
	    $sql="INSERT INTO lostProperty (`name`, `description`, `gibbonPersonIDFounder`,`datefound`) VALUES ('".$_POST["name"]."', '".$_POST["desc"]."', '1', '".date("Y-m-d")."')";
	    $result=$connection2->prepare($sql);
	    $result->execute($data);
	}
	catch(PDOException $e) { 
	    print "<div class='error'>" . $e->getMessage() . "</div>" ; 
	}
    }
    print "<h1>Add a lost item:</h1>";
    print "<form action='' method='post'>";
    print "<p>Name:</p><input type='text' name='name'><br>";
    print "<p>Description:</p><textarea name='desc' cols='50' rows='10'></textarea><br>";
    print "<input type='submit' value='Add'>";
    print "</form>";

}

?>
