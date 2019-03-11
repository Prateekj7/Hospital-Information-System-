<?php
 $con_str = oci_connect(/*"activity"*/"nandita_csb16", /*"act123"*/"nandita", "192.168.125.4/oracle10");
    if (!$con_str)
        {
       $err = oci_error();
       print("Coulnot connect");
	exit;
     }



?>
