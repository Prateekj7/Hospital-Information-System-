<?php
    if ($_SERVER['REQUEST_METHOD']== "POST") {
    //Your indicator for your condition, actually it depends on what you need. I am just used to this method.
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $pid=$_POST['pid'];
    $fname=test_input($_POST['fname']);
    $lname=test_input($_POST['lname']);
    $sex=$_POST['gender'];
    $dob=$_POST['bday'];
    $dob=date("d-m-y",strtotime($_POST['bday']));
    $disease=test_input($_POST['disease']);
    $did=$_POST['did'];
    $med1=test_input(ucfirst(strtolower($_POST['med1'])));
    $phno=$_POST['phno'];
    echo $fname.' '.$lname;
    if( is_numeric($phno) === FALSE)
      echo 'phone no error';
    $ptype=$_POST['ptype'];
    if($_POST['med2'!=''])
      {
        $med2=test_input($_POST['med2']);
      }
    if($_POST['ptype']=='in')
    {
      $doa=$_POST['doa'];
                $doa=date("d-m-y",strtotime($_POST['doa']));
                $dor=$_POST['dor'];
                $dor=date("d-m-y",strtotime($_POST['dor']));
                $wno=$_POST['wno'];
                $wtype=test_input($_POST['wtype']);
    }
    elseif ($_POST['ptype']=='out') {
      $cdate=$_POST['cdate'];
                $cdate=date("d-m-y",strtotime($_POST['cdate']));
    }
    elseif ($_POST['ptype']=='ref') {
      $hname=test_input($_POST['hname']);
                $rdate=date("d-m-y",strtotime($_POST['rdate']));
    }
     //if valid then redirect

      header('Location: http://192.168.125.6/~nandita_csb16/pinfo.php');

    }
?>
