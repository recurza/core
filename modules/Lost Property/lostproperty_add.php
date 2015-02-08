<?php

@session_start();

if (isActionAccessible($guid, $connection2, "/modules/Lost Property/lostproperty_add.php")==FALSE) {
    //Acess denied
    print "<div class='error'>" ;
    print "You do not have access to this action." ;
    print "</div>" ;
}
else {
    print "<p>Hello</p>";
}

?>
