<?php

/* * *****************************************************************************
 * File Name: analyticsdashboardfunctions.php
 * Project: Sandbox
 * Author: mnutsch
 * Date Created: 4-7-2017
 * Description: This file contains functions for interacting the web analytics database tables. 
 * Notes: 
 * **************************************************************************** */

//==================================================================== BEGIN PHP

//Set Debugging Options
$debugging = 0; //set this to 1 to see debugging output

$t=time(); //variable used for obtaining the current time

//display information if we are in debugging mode
if($debugging)
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

/*******************************************************************************
* Function Name: connectToMySQLAnalytics()
* Description: 
* This function will: 
* Connect to MySQL.
* The connection information should be stored as constants, defined in an included file.
* The connection will be stored in a global variable called $GLOBALS['conn'];
* The function will return 1 if the connection was made and 0 if not.
*******************************************************************************/
function connectToMySQLAnalytics()
{
  try
  {
	$mySQLConnection = 0; //used to track if the database is connected.
	
	$mysql_dbname = SANDBOX_DB_DBNAME001; //sandbox
	$mysql_username = SANDBOX_DB_USER;
	$mysql_pw = SANDBOX_DB_PWD;
	$mysql_hostname = SANDBOX_DB_HOST;
	  
	// Create connection
	$mySQLConnection = new mysqli($mysql_hostname, $mysql_username, $mysql_pw, $mysql_dbname);
	  
	// Check connection
	if ($mySQLConnection->connect_error) 
	{
	  $errorMessage = "Error connecting to the MySQL database.";
	  sendErrorMessage($debugging, $errorMessage); //requires emailfunctions.php
	  if($debugging == 1)
	  {
	    echo $errorMessage;
	  }
	  //echo "Error connecting to MySQL: <br>" . $mySQLConnection->error;
	  
	  return 0;
	}
	else
	{
	  return $mySQLConnection;
	}
  }
  catch (Exception $e)
  {
	$errorMessage = $errorMessage . "Error connecting to the MySQL database.";
	sendErrorMessage($debugging, $errorMessage); //requires emailfunctions.php
	if($debugging == 1)
	{
      echo $errorMessage;
	  //$error = $e->getMessage();
      //echo $error;
	}
	return 0;
  }
}

/*******************************************************************************
* Function Name: disconnectFromMySQLAnalytics()
* Description: 
* This function will: 
* Disconnect from MySQL.
*******************************************************************************/
function disconnectFromMySQLAnalytics($mySQLConnection)
{
  try
  {	
    $mySQLConnection->close();
  }
  catch (Exception $e)
  {
	$errorMessage = $errorMessage . "Error disconnecting to the MySQL database.";
	sendErrorMessage($debugging, $errorMessage); //requires emailfunctions.php
	if($debugging == 1)
	{
	  
	  echo $errorMessage;
	  
	  //$error = $e->getMessage();
      //echo $error;
	}
  }
}

/*******************************************************************************
* Function Name: getPageLoads()
* Description: 
* This function will: 
* Returns an array of objects containing the high level page load data.
*******************************************************************************/
function getPageLoads()
{
  $result = 0;
  $sql = 0;
  $row = 0;
  
  try
  {
  
    $mySQLConnectionLocal = connectToMySQLAnalytics(); //connect to the database
  
    /* raw SQL command
	SELECT url as "URL", count(*) as "Calls", MAX(time_called) as "Last Called" FROM sandbox.analytics_page_loads GROUP BY url ORDER BY Calls DESC;
	*/
	
    //direct SQL method
	$sql = 'SELECT url as "URL", count(*) as "Calls", MAX(time_called) as "Last Called" FROM sandbox.analytics_page_loads GROUP BY url ORDER BY Calls DESC;'; 
	
	$result =  $mySQLConnectionLocal->query($sql); //direct SQL method
	
	$outputCount = 0;
    while($row = $result->fetch_array())
    {
      $testObjects[$outputCount]->vars["url"] = $row[0];
      $testObjects[$outputCount]->vars["calls"] = $row[1];
	  $testObjects[$outputCount]->vars["last_called"] = $row[2];

      $outputCount++;
      $returnValue = 1;
    }

    disconnectFromMySQLAnalytics($mySQLConnectionLocal);
  
  }
  catch (Exception $e)
  {
	$errorMessage = "Error getting info on all page loads.";
	sendErrorMessage($debugging, $errorMessage); //requires emailfunctions.php
	if($debugging == 1)
	{
      echo $errorMessage;
	  //$error = $e->getMessage();
      //echo $error;
	}
  }
  
  return $testObjects;
}

/*******************************************************************************
* Function Name: getActions()
* Description: 
* This function will: 
* Returns an array of objects containing the high level actions data.
*******************************************************************************/
function getActions()
{
  $result = 0;
  $sql = 0;
  $row = 0;
  
  try
  {
  
    $mySQLConnectionLocal = connectToMySQLAnalytics(); //connect to the database
  
    $table_name = "main_users";
  
    /* raw SQL command
	SELECT name as "Name", count(*) as "Calls", MAX(time_called) as "Last Called" FROM sandbox.analytics_actions GROUP BY name ORDER BY Calls DESC;
	*/
	
    //direct SQL method
	$sql = 'SELECT name as "Name", count(*) as "Calls", MAX(time_called) as "Last Called" FROM sandbox.analytics_actions GROUP BY name ORDER BY Calls DESC;'; 
	
	$result =  $mySQLConnectionLocal->query($sql); //direct SQL method
	
	$outputCount = 0;
    while($row = $result->fetch_array())
    {
      $testObjects[$outputCount]->vars["name"] = $row[0];
      $testObjects[$outputCount]->vars["calls"] = $row[1];
	  $testObjects[$outputCount]->vars["last_called"] = $row[2];

      $outputCount++;
      $returnValue = 1;
    }

    disconnectFromMySQLAnalytics($mySQLConnectionLocal);
  
  }
  catch (Exception $e)
  {
	$errorMessage = "Error getting info on all page loads.";
	sendErrorMessage($debugging, $errorMessage); //requires emailfunctions.php
	if($debugging == 1)
	{
      echo $errorMessage;
	  //$error = $e->getMessage();
      //echo $error;
	}
  }
  
  return $testObjects;
}

//====================================================================== END PHP
?>