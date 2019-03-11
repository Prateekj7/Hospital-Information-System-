<?php
	include ("my_connect_str.php");
	$pid=$_POST['pid'];
	$fname=htmlspecialchars(stripslashes(trim(ucfirst(strtolower($_POST['fname'])))));
	if(!preg_match('/^[a-zA-Z]*$/',$fname)){
		print 'Wrongly entered First name';
		exit;
	}
	
	$lname=htmlspecialchars(stripslashes(trim(ucfirst(strtolower($_POST['lname'])))));
	if(!preg_match('/^[a-zA-Z]*$/',$lname)){
       		print 'Wrongly entered last name';
        	exit;
	}
	$sex=$_POST['gender'];
	$dob=$_POST['bday'];
	$dob=date("d-m-y",strtotime($_POST['bday']));
	$disease=htmlspecialchars(stripslashes(trim($_POST['disease'])));
	if(!preg_match('/^[a-zA-Z ]*$/',$disease)){
        	print 'Wrongly entered disease name';
        	exit;
	}
	$did=$_POST['did'];
	$med1=htmlspecialchars(stripslashes(trim(ucfirst(strtolower($_POST['med1'])))));
	if(!preg_match('/^[a-zA-Z ]*$/',$med1)){
        	print 'Wrongly entered medicine name';
        	exit;
	}
	if($_POST['med2']!='')
	{
        	$med2=htmlspecialchars(stripslashes(trim(ucfirst(strtolower($_POST['med2'])))));
	        if(!preg_match('/^[a-zA-Z ]*$/',$med2)){
        		print 'Wrongly entered medicine name';
        		exit;
		}
	}
	$phno=$_POST['phno'];
	if( is_numeric($phno) === FALSE){
		print 'wrong phone number';
		exit;
	}
	$ptype=$_POST['ptype'];
	if($ptype=='in'){
		if (empty($_POST['doa']) and empty($_POST['dor']) and empty($_POST['wno']) and empty($_POST['wtype']))
		{
        		print('Some values not entered');
        		exit;
		}
		$doa=$_POST['doa'];
		$doa=date("d-m-y",strtotime($_POST['doa']));
		$dor=$_POST['dor'];
		$dor=date("d-m-y",strtotime($_POST['dor']));
		$wno=$_POST['wno'];
		$wtype=htmlspecialchars(stripslashes(trim($_POST['wtype'])));
		if(!preg_match('/^[a-zA-Z]*$/',$wtype)){
        		print 'Wrongly entered ward type name';
        		exit;
		}

	}
	elseif($ptype=='out'){
		if (empty($_POST['cdate']) )
		{
       			print('Some values not entered');
        		exit;
		}
		$cdate=$_POST['cdate'];
		$cdate=date("d-m-y",strtotime($_POST['cdate']));
	}
	elseif($ptype=='ref'){
		if (empty($_POST['hname']) and empty($_POST['rdate']))
		{
        		print('Some values not entered');
        		exit;
		}
		$hname=htmlspecialchars(stripslashes(trim($_POST['hname'])));
		if(!preg_match('/^[a-zA-Z]*$/',$hname)){
 		       	print 'Wrongly entered hospital name';
        		exit;
		}
		$rdate=date("d-m-y",strtotime($_POST['rdate']));
	}
	/*insert into patient table*/
	$query_str=oci_parse($con_str,"insert into patient values($pid,'$fname','$lname','$sex',to_date('$dob','DD-MM-YYYY'),'$disease','$ptype','$phno',$did)");
	if(!oci_execute($query_str,OCI_COMMIT_ON_SUCCESS))
  	{
    		print 'Problem in query';
    		exit;
  	}

	/*medicine info*/
		$query_str1=oci_parse($con_str,"insert into gets values($pid,'$med1')");
		if(!oci_execute($query_str1,OCI_COMMIT_ON_SUCCESS))
	        {
	                print 'Problem in query1';
	                exit;
	        }
		if($_POST['med2']!='')
		{
			//$med2=htmlspecialchars(stripslashes(trim(ucfirst(strtolower($_POST['med2'])))));
			$query_str2=oci_parse($con_str,"insert into gets values($pid,'$med2')");
	       		if(!oci_execute($query_str2,OCI_COMMIT_ON_SUCCESS))
	        	{
	                	print 'Problem in query';
	                	exit;
	        	}
		}
	if($ptype=='in')
	{
		//$doa=$_POST['doa'];
		//$doa=date("d-m-y",strtotime($_POST['doa']));
		//$dor=$_POST['dor'];
		//$dor=date("d-m-y",strtotime($_POST['dor']));
		//$wno=$_POST['wno'];
		//$wtype=htmlspecialchars(stripslashes(trim($_POST['wtype'])));
		$query_str3=oci_parse($con_str,"insert into inpatient values($pid,to_date('$doa','DD-MM-YYYY'),to_date('$dor','DD-MM-YYYY'),$wno,'$wtype')");
		if(!oci_execute($query_str3,OCI_COMMIT_ON_SUCCESS))
                        {
                                print 'Problem in query';
                                exit;
                        }
	}
	elseif ($ptype=='out')
	{
		//$cdate=$_POST['cdate'];
		//$cdate=date("d-m-y",strtotime($_POST['cdate']));
		$query_str3=oci_parse($con_str,"insert into outpatient values($pid,to_date('$cdate','DD-MM-YYYY'))");
		if(!oci_execute($query_str3,OCI_COMMIT_ON_SUCCESS))
                        {
                                print 'Problem in query';
                                exit;
                        }
	}
	elseif($ptype=='ref')
	{
		//$hname=htmlspecialchars(stripslashes(trim($_POST['hname'])));
		//$rdate=date("d-m-y",strtotime($_POST['rdate']));
		$query_str3=oci_parse($con_str,"insert into refer values($pid,'$hname',to_date('$rdate','DD-MM-YYYY'))");	
		if(!oci_execute($query_str3,OCI_COMMIT_ON_SUCCESS))
                        {
                                print 'Problem in query';
                                exit;
                        }
	}
	print('Insertion was successful');
	
?>
