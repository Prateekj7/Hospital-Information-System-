<?php
  include ("my_connect_str.php");
  $did=$_POST['did'];
  $fname=htmlspecialchars(stripslashes(trim(ucfirst(strtolower($_POST['fname'])))));
  if(!preg_match('/^[a-zA-Z]*$/',$fname)){
        print 'Wrongly entered first name';
        exit;
	}
  $lname=htmlspecialchars(stripslashes(trim(ucfirst(strtolower($_POST['lname'])))));
  if(!preg_match('/^[a-zA-Z]*$/',$lname)){
        print 'Wrongly entered last name';
        exit;
	}
  $deptid=$_POST['deptid'];
  $phno=$_POST['phno'];
  if(is_numeric($phno)===FALSE){
	print 'wrong phone no.';
	exit;
	}
  $sp=$_POST['formspec'];
  if (empty($_POST['formspec']) )
	{
        	print('Enter form specialisation');
        	exit;
	}
  $query_str=oci_parse($con_str,"select did from doctor where did=$did");
  if(!oci_execute($query_str,OCI_COMMIT_ON_SUCCESS))
  {
    print 'Record does not exist';
    exit;
  }
  else{
    $query_str1=oci_parse($con_str,"update doctor set fname='$fname',lname='$lname',spc='$sp', deptid=$deptid,phno='$phno' where did=$did");
    if(!oci_execute($query_str1,OCI_COMMIT_ON_SUCCESS))
    {
      print 'Problem in query';
      exit;
    }
    else {
      print 'Update was succesful';
    }
}
 ?>
