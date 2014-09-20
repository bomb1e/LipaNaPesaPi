<?php

require "/db/connectdb.php";

$query = mysql_query("

select from * Daily where id =3 ;


	");
echo($data);

//echo(mysql_num_rows($query) !== 0) ? mysql_result($query, 0) : "Password not found " ;

?>