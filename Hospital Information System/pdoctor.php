<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Particular Patient Information</title>
    <style>
    table{
      padding:8px;
      margin-left: 20%;
      margin-right: 20%;
      font-family: Calibri;
      font-size: 11pt;
      font-style: normal;
      font-weight: bold;
      text-align:;
      border-radius: 5px;
      background-color: #f2f2f2;
      border-collapse: collapse;
    }
    </style>
  </head>
  <body>
    <table cellpadding=10>
      <?php
          include("my_connect_str.php");
          $did=$_POST['did'];
          $query_str=oci_parse($con_str,/*"describe student_det"*/"select did,fname,lname,spc,phno from doctor where did=$did");
          if(!oci_execute($query_str))
                  {
                          print("Problem in the Query");
                          exit;
                  }
          $query_data=oci_fetch_array($query_str);
          print('<tr>');
            print('<td>Doctor ID:</td>');
            print('<td>');
            print $query_data[0];
            print('</td>');
          print('</tr>');
          print('<tr>');
            print('<td>First Name:</td>');
            print('<td>');
            print $query_data[1];
            print('</td>');
          print('</tr>');
          print('<tr>');
            print('<td>Last Name:</td>');
            print('<td>');
            print $query_data[2];
            print('</td>');
          print('</tr>');
          print('<tr>');
            print('<td>Specialisation:</td>');
            print('<td>');
            print $query_data[3];
            print('</td>');
          print('</tr>');
          print('<tr>');
          print('<td>Department:</td>');

          $query_str1=oci_parse($con_str,/*"describe student_det"*/"select dname from department where deptid=(select deptid from doctor where did=$did)");
          if(!oci_execute($query_str1))
                  {
                          print("Problem in the Query");
                          exit;
                  }
          $query_data1=oci_fetch_array($query_str1);
          print('<td>');
          print $query_data1[0];
          print('</td>');
          print('</tr>')
            ?>
          </table>
        </body>
        </html>
