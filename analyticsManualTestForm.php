<!DOCTYPE html>
<html>
    <head>
        <title>Web Analytics Tester</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>Web Analytics Tester</div>
        
    <form action="analyticsWebService.php" method="post">    
      Token ID:<br>
        <input type="text" name="token_id" value="987654321">
        <br><br>
      Event Type
      <select name="event_type">
        <option value="page_load">page_load</option>
        <option value="custom_action">custom_action</option>
      </select>
      <br><br>
      Action name:<br>
        <input type="text" name="action_name" value="Contact Form Submitted">
        <br><br>
      Action values:<br>
        <input type="textarea" name="action_values" value="">
<?php
  $a = array();
  $a["UserID"] = 23;
  $a["UserDepartment"] = "Production";
  echo json_encode($a);
?>          
        <br><br>
      Page URL:<br>
        <input type="text" name="page_url" value="http://ws-test.vistasand.com/Controls/General/main.php">
        <br><br>
      Page Values:<br>
        <input type="textarea" name="page_values">
<?php
  $a = array();
  $a["UserID"] = 23;
  $a["UserDepartment"] = "Production";
  echo json_encode($a);
?>        
        <br><br>
        <input type="submit" value="Submit">
    </form> 
    </body>
</html>
