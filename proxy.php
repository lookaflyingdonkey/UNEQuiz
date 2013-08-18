<?php
$actions = array('load_quizzes', 'load_quiz', 'submit');

// Check that action is set
if(!isset($_GET['action'])) die('Sorry, an action is required');

// Get the action
$action = $_GET['action'];

// Check the action is valid
if(!in_array($action, $actions)) die('Sorry, your action is invalid');

// Endpoint for course
$endpoint = "http://mcs.une.edu.au/~comp280/Quiz/";

// User details for UNE
// NOTE: DO NOT LEAVE THESE SET WHEN NOT IN USE, NOT SECURE AT ALL
$username = "johndoe";
$password = "12345678";

// Below here is the actual program, please read through before using to make sure you are happy.
// Nothing is saved or transmitted outside this script or the UNE system


// Work out the total endpoint
$endpoint .= $_GET['quiz'];

// Init the curl request
$request = curl_init($endpoint);
curl_setopt($request, CURLOPT_VERBOSE, 1);
curl_setopt($request, CURLOPT_HEADER, 1);
curl_setopt($request, CURLOPT_USERPWD, $username . ":" . $password);
curl_setopt($request, CURLOPT_TIMEOUT, 30);
curl_setopt($request, CURLOPT_RETURNTRANSFER, TRUE);

// Setup required bits for each action
switch($action) {
	case 'load_quizzes':
		// Do Nothing
	break;
	case 'load_quiz':
		// Do Nothing
	break;
	case 'submit':
		curl_setopt($request, CURLOPT_POST, 1);
		curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($_POST));
		
	break;
}

// Execute request and close connection
$response = curl_exec($request);


$header_size = curl_getinfo($request, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);

echo $body;
curl_close($request);