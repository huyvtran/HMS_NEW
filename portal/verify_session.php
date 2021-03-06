<?php


// All of the common intialization steps for the get_* patient portal functions are now in this single include.



//continue session
session_start();

//landing page definition -- where to go if something goes wrong
$landingpage = "index.php?site=".$_SESSION['site_id'];
//

// kick out if patient not authenticated
if (isset($_SESSION['pid']) && isset($_SESSION['patient_portal_onsite_two'])) {
    $pid = $_SESSION['pid'];
} else {
    session_destroy();
    header('Location: '.$landingpage.'&w');
    exit;
}

//

$ignoreAuth=true; // ignore the standard authentication for a regular OpenEMR user
require_once(dirname(__file__) . './../interface/globals.php');
