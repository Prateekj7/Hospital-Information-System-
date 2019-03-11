<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
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
    <table id="customers">
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Specialisation</th>
        <th>Phone No.</th>
        <th>Department</th>
      </tr>
    <?php
        include("my_connect_str.php");
        $query_str=oci_parse($con_str,/*"describe student_det"*/"select * from doctor,department where doctor.deptid=department.deptid order by doctor.did");
        if(!oci_execute($query_str))
                {
                        print("Problem in the Query");
                        exit;
                }

        while($query_data=oci_fetch_array($query_str)){
          print('<tr>');
          print('<td>');
          print $query_data[0];
          print('</td>');
          print('<td>');
          print $query_data[1];
          print('</td>');
          print('<td>');
          print $query_data[2];
          print('</td>');
          print('<td>');
          print $query_data[3];
          print('</td>');
          print('<td>');
          print $query_data[5];
          print('</td>');
          print('<td>');
          print $query_data[7];
          print('</td>');
          print('</tr>');
        }


        ?>

    </table>
  </body>
</html>
