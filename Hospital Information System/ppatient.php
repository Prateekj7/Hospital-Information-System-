<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Particular Patient Information</title>
    <style>
    table{
      width:80%;
      padding:8px;
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
          $pid=$_POST['pid'];
          $query_str=oci_parse($con_str,/*"describe student_det"*/"select pid,fname,lname,sex,dob,disease,ptype,phno from patient where pid=$pid");
          if(!oci_execute($query_str))
                  {
                          print("Problem in the Query");
                          exit;
                  }
          $query_data=oci_fetch_array($query_str);
          print('<tr>');
            print('<td>Patient ID:</td>');
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
            print('<td>Sex:</td>');
            print('<td>');
            print $query_data[3];
            print('</td>');
          print('</tr>');
          print('<tr>');
            print('<td>Date of Birth:</td>');
            print('<td>');
            print $query_data[4];
            print('</td>');
          print('</tr>');
          print('<tr>');
            print('<td>Disease:</td>');
            print('<td>');
            print $query_data[5];
            print('</td>');
          print('</tr>');
          print('<tr>');
            print('<td>Phone No:</td>');
            print('<td>');
            print $query_data[7];
            print('</td>');
          print('</tr>');
          print('<tr>');
            print('<td>Patient Type:</td>');
            print('<td>');
            print $query_data[6].' patient';
            print('</td>');
            print('</tr>');
            print('<tr>');
              print('<td>Doctor Consulted:</td>');
              $query_str0=oci_parse($con_str,/*"describe student_det"*/"select fname,lname from doctor where did=(select did from patient where pid=$pid)");
              if(!oci_execute($query_str0))
                      {
                              print("Problem in the Query");
                              exit;
                      }
              $query_data0=oci_fetch_array($query_str0);
              print('<td>');
              print $query_data0[0].' '.$query_data0[1];
              print('</td>');
              print('</tr>');

	    if(strcmp(trim($query_data[6]),'in')==0)
	    {
        $query_str1=oci_parse($con_str,/*"describe student_det"*/"select doa,dor,wno,wtype from patient,inpatient where inpatient.pid=$pid");
        if(!oci_execute($query_str1))
                {
                        print("Problem in the Query");
                        exit;
                }
        $query_data1=oci_fetch_array($query_str1);
        print('<tr>');
          print('<td>Date of Arrival:</td>');
          print('<td>');
          print $query_data1[0];
          print('</td>');
          print('</tr>');
          print('<tr>');
            print('<td>Date of Release:</td>');
            print('<td>');
            print $query_data1[1];
            print('</td>');
            print('</tr>');
            print('<tr>');
              print('<td>Ward No.:</td>');
              print('<td>');
              print $query_data1[2];
              print('</td>');
              print('</tr>');
              print('<tr>');
                print('<td>Ward Type:</td>');
                print('<td>');
                print $query_data1[3];
                print('</td>');
                print('</tr>');
	    }
      elseif (strcmp(trim($query_data[6]),'out')==0)
	    {
        $query_str1=oci_parse($con_str,/*"describe student_det"*/"select cdate from patient,outpatient where outpatient.pid=$pid");
        if(!oci_execute($query_str1))
                {
                        print("Problem in the Query");
                        exit;
                }
                $query_data1=oci_fetch_array($query_str1);
                print('<tr>');
                  print('<td>Date of Consultancy:</td>');
                  print('<td>');
                  print $query_data1[0];
                  print('</td>');
                  print('</tr>');
      }
      elseif (strcmp(trim($query_data[6]),'ref')==0)
	    {
        $query_str1=oci_parse($con_str,/*"describe student_det"*/"select hname,rdate from patient,refer where refer.pid=$pid");
        if(!oci_execute($query_str1))
                {
                        print("Problem in the Query:");
                        exit;
                }
                $query_data1=oci_fetch_array($query_str1);
                print('<tr>');
                  print('<td>Referred Hospital/Expert Name:</td>');
                  print('<td>');
                  print $query_data1[0];
                  print('</td>');
                  print('</tr>');
                print('<tr>');
                  print('<td>Date of Referral:</td>');
                  print('<td>');
                  print $query_data1[1];
                  print('</td>');
                  print('</tr>');
      }
      $query_str2=oci_parse($con_str,/*"describe student_det"*/"select mname from gets where pid=$pid");
      if(!oci_execute($query_str2))
              {
                      print("Problem in the Query");
                      exit;
              }
              print('<tr>');
                print('<td>Medicines:</td>');
              while($query_data2=oci_fetch_array($query_str2)){

                  print('<td>');
                  print $query_data2[0];
                  print('</td>');

              }
              print('</tr>');
      print('<tr>');
      $query_str3=oci_parse($con_str,/*"describe student_det"*/"select rno,ldate,category from labreport where pid=$pid");
      if(!oci_execute($query_str3))
        {
          print 'Problem in query';
          exit;
        }      else        {

              print('<tr>');
                print('<td><h4>Lab Reports:</h4></td>');
                print('</tr>');
              while($query_data3=oci_fetch_array($query_str3)){
                  print('<tr>');
                  print('<td>');
                  print ('Report No.:');
                  print('</td>');
                  print('<td>');
                  print $query_data3[0];
                  print('</td>');
                  print('</tr>');
                  print('<tr>');
                  print('<td>');
                  print ('Date:');
                  print('</td>');
                  print('<td>');
                  print $query_data3[1];
                  print('</td>');
                  print('</tr>');
                  print('<tr>');
                  print('<td>');
                  print ('Category:');
                  print('</td>');
                  print('<td>');
                  print $query_data3[2];
                  print('</td>');
                  print('</tr>');
              }
            }

      ?>
    </table>
  </body>
</html>
