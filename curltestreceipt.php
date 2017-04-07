<?php
$debugging = 1; //set this to 1 to see debugging output

$t=time(); //variable used for obtaining the current time

//display information if we are in debugging mode
if($debugging == 1)
{
  echo "The current Linux user is: ";
  echo exec('whoami');
  echo "<br/>";
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  echo "<strong>Debugging Enabled</strong><br/>";  
  echo "Start time: ";
  echo(date("Y-m-d H:i:s",$t));
  echo "<br/>";
}

//include other files
require_once('/var/www/configuration/db-mysql-sandbox.php'); //contains database connection info
echo "<html><body>";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  //web post was received
  echo "web post was received";
}

echo "</body></html>";
//====================================================================== END PHP
?>