/* * *****************************************************************************
 * File Name: webanalytics.js
 * Project: WebAnalytics
 * Author: mnutsch
 * Date Created: Apr 7, 2017
 * Description: This file contains functions for calling the web analytics
 * web service.
 * Notes: 
 * **************************************************************************** */

function addPageTracking(token_id, page_url, page_values) 
{
    //alert("add page load function was called"); //sends an alert box telling us that the function was called

    var event_type = "page_load";
    
    //insert the values
    var http = new XMLHttpRequest();
    
    var url = "../../Includes/analyticswebservice.php";
    var params = "token_id=" + token_id + "&event_type=" + event_type + "&page_url=" + page_url + "&page_values=" + page_values;
    
    //alert("the params are " + params); //sends an alert box telling us the parameter string
    
    http.open("POST", url, true);
    
    //Send the proper header information along with the request
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    
    http.onreadystatechange = function() 
    {
        if(http.readyState == 4 && http.status == 200) 
        {
            //alert(http.responseText); //sends an alert box telling us the result from the function call
        }
    }

    http.send(params);
   
}	

function addActionTracking(token_id, action_name, action_values) 
{
    //alert("add action function was called");

    var event_type = "custom_action";
    
    //insert the values
    var http = new XMLHttpRequest();
    
    var url = "../../Includes/analyticswebservice.php";
    var params = "token_id=" + token_id + "&event_type=" + event_type + "&action_name=" + action_name + "&action_values=" + action_values;
    
    //alert("the params are " + params);
    
    http.open("POST", url, true);
    
    //Send the proper header information along with the request
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    
    http.onreadystatechange = function() 
    {
        if(http.readyState == 4 && http.status == 200) 
        {
            //alert(http.responseText);
        }
    }

    http.send(params);
   
}	