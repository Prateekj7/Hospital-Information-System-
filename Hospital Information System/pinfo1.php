<?php
  include ("my_connect_str.php");
  $pid=$_POST['pid'];
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $sex=$_POST['gender'];
  $dob=date('d-m-y',strtotime($_POST['bday']));
  $disease=$_POST['disease'];
  $did=$_POST['did'];
  $med1=$_POST['med1'];
  $phno=$_POST['phno'];
  $ptype=$_POST['ptype'];
  $query_str=oci_parse($con_str,"insert into patient values($pid,'$fname','$lname','$sex',to_date('$dob','DD-MM-YYYY'),'$disease','$ptype','$phno','$did')");
  if(!oci_execute($query_str,OCI_COMMIT_ON_SUCCESS))
  {
    print 'Problem in query';
    exit;
  }
    ?>
