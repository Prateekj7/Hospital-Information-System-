<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Patient Bill</title>
    <style>
    table {
          font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 90%;
          margin-left: 5%;
          margin-top: 30px;
          }

          td, th {
          border: 1px solid #ddd;
          padding: 8px;
          }

          tr:nth-child(even){background-color: #f2f2f2;}

          tr:hover {background-color: #ddd;}

          th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: Tomato;
          color: white;
	}
    </style>
  </head>
  <body>
    <table>
      <?php
      include("my_connect_str.php");
      $pid=$_POST['pid'];
      $query_str=oci_parse($con_str,/*"describe student_det"*/"select mname from gets where pid=$pid");
      if(!oci_execute($query_str))
              {
                      print("Problem in the Query");
                      exit;
              }
      print('<tr>');
      print('<th>Medicine</th>');
      print('<th>Cost</th>');
      print('</tr>');
      $cost=0;
      while($query_data=oci_fetch_array($query_str)){
	
        $query_str1=oci_parse($con_str,/*"describe student_det"*/"select cost from medicine where mname='$query_data[0]'");
        if(!oci_execute($query_str1))
                {
                        print("Problem in the Query");
                        exit;
                }
        $query_data1=oci_fetch_array($query_str1);
        $cost=$cost+$query_data1[0];
        print('<tr>');
       print('<td>');
        print $query_data[0];
        print('</td>');
       print('<td>');
        print $query_data1[0];
        print('</td>');
        print('</tr>');
      }
      $query_str2=oci_parse($con_str,/*"describe student_det"*/"select category from labreport where pid=$pid");
      if(oci_execute($query_str2))
              {
          
        while($query_data2=oci_fetch_array($query_str2)){
          print('<tr>');
          print('<td>');
          print $query_data2[0];
          print('</td>');
          print('<td>');
          print 300;
          print('</td>');
          print('</tr>');
          $cost=$cost+300;
        }
      }
      print('<tr>');
      print('<td>');
      print 'Total Cost';
      print('</td>');
      print('<td>');
      print $cost;
      print('</td>');
      print('</tr>');
      ?>
    </table>
  </body>
</html>
