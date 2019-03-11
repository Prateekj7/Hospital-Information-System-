<?php
include("my_connect_str.php");
$query_str=oci_parse($con_str,/*"describe student_det"*/"select * from patient");
if(!oci_execute($query_str))
	{
		print("Problem in the Query");
		exit;
	}

while($query_data=oci_fetch_array($query_str))
{
	print("<BR>");
	for($x=0;$x<count($query_data);$x++)
		print $query_data[$x].'	';
}
print("<BR>Query executed Successfully");


?>
