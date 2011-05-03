<?php
/*Variables to connect to the MySQL DB*/
$dbHost = 'www.whatcanidorightnow.info';
$dbUser = 'webuser';
$dbPassword = 'is690';
$dbName = 'entitydb';
$dbTable = 'people';

/*Makes a connection to the server or displays an error*/
$connection = mysql_connect($dbHost, $dbUser, $dbPassword) or die(mysql_error());


/*Make a connection to the database or displays an error*/
$dbCurrent = mysql_select_db($dbName, $connection) or die (mysql_error());

/* Creates an SQL Query to be sent to MySQL*/
//$sqlQuery = "SHOW TABLES FROM entitydb"; //Test to show all Tables
//$sqlQuery = "SELECT * FROM people";

/*Shows all fields w/in a table*/
$sqlQuery = "SHOW COLUMNS FROM $dbTable";
$result = mysql_query($sqlQuery, $connection);

 /* If there is an error with the query it will display an error along
 * With the SQL Query being sent */
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "<br/><br/>";
    $message .= 'Whole query: ' . $sqlQuery;
    die($message);
}

/* Display all the data from the SQL Query in a table
 * Creates the header for the table */
echo "<table border='1'><tr>";
while ($row = mysql_fetch_row($result)) {
  echo "<th> ".$row[0]." </th>";
}
echo "</tr>";

/*Creates the query to pull all values from the table*/
$sqlQuery = "SELECT * FROM $dbTable";
$result = mysql_query($sqlQuery, $connection);

 /* If there is an error with the query it will display an error along
 * With the SQL Query being sent */
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "<br/><br/>";
    $message .= 'Whole query: ' . $sqlQuery;
    die($message);
}

/*Shows all the values under their corresponding table header*/

while ($row = mysql_fetch_row($result)) {
  echo "<tr>";

  for($i = 0; $i < count($row); $i++){
  echo "<td>".$row[$i]."</td>";
  }

  echo "</tr>";
}
echo "</table>";





/*	
 entitydb20110410.sql
Sorry for the confusion.  Here is the database connectivity info:

Connection Type: TCP

Host: www.whatcanidorightnow.info (50.17.104.179)

User: webuser

Password: is690

Database: entitydb

Port: 3306
*/

?>
