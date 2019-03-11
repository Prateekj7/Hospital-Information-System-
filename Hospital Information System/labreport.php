<?php
  include ("my_connect_str.php");
  $rno=$_POST['rno'];
  $ldate=date('d-m-y',strtotime($_POST['ldate']));
  $did=$_POST['did'];
  $pid=$_POST['pid'];
  $cat=$_POST['category'];
  if (empty($_POST['category']) )
        {
                print('Enter form specialisation');
                exit;
        }
  $query_str=oci_parse($con_str,"insert into labreport values($rno,to_date('$ldate','DD-MM-YYYY'),'$cat',$did,$pid)");
  if(!oci_execute($query_str,OCI_COMMIT_ON_SUCCESS))
  {
    print 'Problem in query';
    exit;
  }
  else{
        print 'Insertion was succesful';
}
?>
