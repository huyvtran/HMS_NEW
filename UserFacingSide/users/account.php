<?php

//include '/Applications/MAMP/htdocs/HMS/UserFacingSide/users/upload.php';



?>
<?php require_once '../users/init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();}?>
<?php
if(!empty($_POST['uncloak'])){
	if(isset($_SESSION['cloak_to'])){
		$to = $_SESSION['cloak_to'];
		$from = $_SESSION['cloak_from'];
		unset($_SESSION['cloak_to']);
		$_SESSION['user'] = $_SESSION['cloak_from'];
		unset($_SESSION['cloak_from']);
		logger($from,"Cloaking","uncloaked from ".$to);
		Redirect::to($us_url_root.'users/admin_users.php?err=You+are+now+you!');
		}else{
			Redirect::to($us_url_root.'users/logout.php?err=Something+went+wrong.+Please+login+again');
		}
}
//$newuser = trim($user->data()->fname);
$newuser1 = trim($user->data()->lname);






//dealing with if the user is logged in
if($user->isLoggedIn() || !$user->isLoggedIn() && !checkMenu(2,$user->data()->id)){
	if (($settings->site_offline==1) && (!in_array($user->data()->id, $master_account)) && ($currentPage != 'login.php') && ($currentPage != 'maintenance.php')){
		$user->logout();
		Redirect::to($us_url_root.'users/maintenance.php');
	}
}
$grav = get_gravatar(strtolower(trim($user->data()->email)));
$get_info_id = $user->data()->id;
// $groupname = ucfirst($loggedInUser->title);
$raw = date_parse($user->data()->join_date);
$signupdate = $raw['month']."/".$raw['day']."/".$raw['year'];
$userdetails = fetchUserDetails(NULL, NULL, $get_info_id); //Fetch user details


 ?>

<div id="page-wrapper">
<div class="container">
<div class="well">
<div class="row">
	<div class="col-xs-12 col-md-3">

		<p><img src="<?=$grav; ?>" class="img-thumbnail" alt="Generic placeholder thumbnail"></p>
		<p><a href="../users/user_settings.php" class="btn btn-primary">Edit Account Info</a></p>
		<p><a class="btn btn-primary " href="../users/profile.php?id=<?=$get_info_id;?>" role="button">Public Profile</a></p>
		<?php
		if($settings->twofa == 1){
		$twoQ = $db->query("select twoKey from users where id = ? and twoEnabled = 0", [$userdetails->id]);
		if($twoQ->count() > 0){ ?>
			<p><a class="btn btn-primary " href="../users/enable2fa.php" role="button">Manage 2 Factor Auth</a></p>
	<?php	} else { ?>
			<p><a class="btn btn-primary " href="../users/manage2fa.php" role="button">Manage 2 Factor Auth</a></p>
	<?php }} ?>
	<?php if($settings->session_manager==1) {?><p><a class="btn btn-primary " href="../users/manage_sessions.php" role="button">Manage Sessions</a></p><?php } ?>
	<?php if(isset($_SESSION['cloak_to'])){ 
		
		?>
		<form class="" action="account.php" method="post">
			<input type="submit" name="uncloak" value="Uncloak!" class='btn btn-danger'>
		</form><br>
		
		
        <?php }
        $userBalance = 50;
		$newuser = trim($user->data()->fname);
        echo "$newuser";
        echo "<br />\n";
        echo "Sizin balansınız: $userBalance AZN";
		?>
	</div>
	<div class="col-xs-12 col-md-9">
		<h1><?=echousername($user->data()->id)?></h1>
		<p><?=ucfirst($user->data()->fname)." ".ucfirst($user->data()->lname)?> / <?=echouser($user->data()->id)?></p>
		<p>Member Since:<?=$signupdate?></p>
		<p>Number of Logins: <?=$user->data()->logins?></p>
		<?php if($settings->session_manager==1) {?><p>Number of Active Sessions: <?=UserSessionCount()?> <sup><a class="nounderline" data-toggle="tooltip" title="Click the Manage Sessions button in the left sidebar for more information.">?</a></sup></p><?php } ?>
		<p>This is the private account page for your users. It can be whatever you want it to be; This code serves as a guide on how to use some of the built-in system functionality. </p>
	    <p> Crappy Pasta </p>
		<iframe width="560" height="315" src="https://www.youtube.com/embed/GVV06jTYjeY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			<html>



          
  <head>
    <link rel="stylesheet" href="http://localhost:8888/HMS/dygraphs/dist/dygraph.css">
    <title>Temperatures with Range Selector</title>
	
    <script type="text/javascript" src="http://localhost:8888/HMS/dygraphs/dist/dygraph.js"></script>

    <script type="text/javascript" src="http://localhost:8888/HMS/dygraphs/tests/data.js"></script>
    <style type="text/css">
    #bordered {
      border: 1px solid red;
    }
    #dark-background {
      background-color: #101015;
      color: white;
    }
    #darkbg1 .dygraph-axis-label, #darkbg2 .dygraph-axis-label {
      color: white;
    }
    #noroll .dygraph-legend,
    #roll14 .dygraph-legend,
    #darkbg1 .dygraph-legend,
    #darkbg2 .dygraph-legend {
      text-align: right;
    }
    #darkbg1 .dygraph-legend {
      background-color: #101015;
    }
    #darkbg2 .dygraph-legend {
      background-color: #101015;
    }
    </style>
  </head>
  
  <body>
  
 
</form>



&nbsp; &nbsp; &nbsp;
    <h4>Burada göstərilən sizin kardiqramıdır. (Real Time)</h4>
    <div id="baseballdiv" style="width:640px; height:420px;"></div>
    

    <?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "openemr";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT linkToTheMedicalData FROM `patient_data` WHERE `fname` = '$newuser' AND `lname` = '$newuser1'";
$result = mysqli_query($conn, $sql);
$str = "http://localhost:8888/HMS/interface/patient_file/summary/uploads/suzuki-mariners.txt";





if (mysqli_num_rows($result) > 0) {

  
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       // echo "linkToTheMedicalData: " . $row["linkToTheMedicalData"]. "<br>";
        $link = $row['linkToTheMedicalData'];
    }
} else {
    echo "0 results";
}
#$readingResults = mysql_query($sql);
/*
echo "User's first name is : $newuser ||||";
echo " user's last name is : $newuser1 |||| TheFileName:  "; */
mysqli_close($conn);


$accountName = $_GET['filename'];
//echo $accountName;

if ( $accountName != null) {
  $servername1 = "localhost";
  $username1 = "root";
  $password1 = "root";
  $dbname1 = "openemr";
  
  // Create connection
  $conn1 = mysqli_connect($servername1, $username1, $password1, $dbname1);
  // Check connection
  if (!$conn1) {
      die("Connection failed: " . mysqli_connect_error());
  }
  
  $sql1 = "UPDATE patient_data SET linkToTheMedicalData = 'http://localhost:8888/HMS/UserFacingSide/users/uploads/$accountName' WHERE `fname` = '$newuser' AND `lname` = '$newuser1'"; // UPDATE Users SET weight = 160, desiredWeight = 145 WHERE id = 1;
  $result1 = mysqli_query($conn1, $sql1);                               // INSERT INTO 'TableName' (LinkToTheMedicalData) VALUES ('Variable(LinkToTheFile)','Variable2') WHERE fname = $newuser lname = $newuser1 ; 

  mysqli_close($conn1);

} else {
  // echo "Upload your file first!";
}


//Now basically this PHP variable needs to be modified from the database, on both doctor side and the user side and the loaded into both monitors.
//$linkToVideo = "http://localhost:8888/HMS/UserFacingSide/users/uploads/RecordRTC-2019011-3in8jfofog3.webm";


session_start();

$_SESSION["account_name"] = $newuser;

//echo $target_dir;
//echo $path;
echo "&nbsp;";
//echo $target_dir;

//echo $finalUploadedFileName;
?>

    <script type="text/javascript" language= ”JavaScript”>

    js_variable_name = "<?php echo $link; ?>";
      alert(js_variable_name);

     // var highlight_start = new Date('2009/07/15 00:47');
     // var highlight_end = new Date('2009/07/16 00:48');
      g1 = new Dygraph(
          document.getElementById("baseballdiv"),js_variable_name,
          {
            rollPeriod: 1,
            showRoller: true,
            showRangeSelector: true,
            rangeSelectorPlotLineWidth: 1,
            displayAnnotations: true
            /*
            labels: ['X', 'Est.', 'Actual'],
            animatedZooms: true,
            underlayCallback: function(canvas, area, g) {
              var bottom_left = g.toDomCoords(highlight_start, -20);
              var top_right = g.toDomCoords(highlight_end, +20);

              var left = bottom_left[0];
              var right = top_right[0];

              canvas.fillStyle = "rgba(255, 255, 102, 1.0)";
              canvas.fillRect(left, area.y, right - left, area.h); */
          }
      );
      /*
       <h2>Stock Chart demo</h2>
  <div id="stock_div" style="width: 600px; height: 320px;"></div>

      g = new Dygraph(document.getElementById("stock_div"),
        stockData,
        {
          customBars: true,
          logscale: true
        }); 

    function setLog(val) {
      g.updateOptions({ logscale: val });
      document.getElementById("linear").disabled = !val;
      document.getElementById("log").disabled = val;
    }*/

    g1.ready(function() {
  // This is called when data.csv comes back and the chart draws.
        g1.setAnnotations([{
           series: "Suzuki",
           x: "2009/07/15 00:47",
           shortText: "M",
           text: "Marker",
           tickHeight: 0,
           width: 18,
           height: 18
         },
         {
           series: "Suzuki",
           x: "2009/07/12 17:34",
           shortText: "L",
           text: "Large",
           tickHeight: 0,
           width: 18,
           height: 18
         },
         {
           series: "Suzuki",
           x: "2009/07/16 00:48",
           shortText: "S",
           text: "Stuffio",
           tickHeight: 0,
           width: 18,
           height: 18
         }
         ],
         );
    });
      
    </script>



    <?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "openemr";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT linkToTheMedicalData FROM `patient_data` WHERE `fname` = '$newuser' AND `lname` = '$newuser1'";
$result = mysqli_query($conn, $sql);
$str = "http://localhost:8888/HMS/interface/patient_file/summary/uploads/suzuki-mariners.txt";





if (mysqli_num_rows($result) > 0) {

  
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       // echo "linkToTheMedicalData: " . $row["linkToTheMedicalData"]. "<br>";
        $link = $row['linkToTheMedicalData'];
    }
} else {
    echo "0 results";
}
#$readingResults = mysql_query($sql);
/*
echo "User's first name is : $newuser ||||";
echo " user's last name is : $newuser1 |||| TheFileName:  "; */
mysqli_close($conn);


$accountName = $_GET['filename'];
//echo $accountName;

if ( $accountName != null) {
  $servername1 = "localhost";
  $username1 = "root";
  $password1 = "root";
  $dbname1 = "openemr";
  
  // Create connection
  $conn1 = mysqli_connect($servername1, $username1, $password1, $dbname1);
  // Check connection
  if (!$conn1) {
      die("Connection failed: " . mysqli_connect_error());
  }
  
  $sql1 = "UPDATE patient_data SET linkToTheMedicalData = 'http://localhost:8888/HMS/UserFacingSide/users/uploads/$accountName' WHERE `fname` = '$newuser' AND `lname` = '$newuser1'"; // UPDATE Users SET weight = 160, desiredWeight = 145 WHERE id = 1;
  //UPDATE `patient_data` SET `linkToVideoMessage` = 'http://localhost:8888/HMS/UserFacingSide/users/uploads/RecordRTC-2019014-fvlfchrvz3q.webm' WHERE `fname` = "Dolores" AND `lname` = "Vanguelos";
  $result1 = mysqli_query($conn1, $sql1);                               // INSERT INTO 'TableName' (LinkToTheMedicalData) VALUES ('Variable(LinkToTheFile)','Variable2') WHERE fname = $newuser lname = $newuser1 ; 

  mysqli_close($conn1);

} else {
 // echo "Upload your file first!";
}


//Now basically this PHP variable needs to be modified from the database, on both doctor side and the user side and the loaded into both monitors.
//$linkToVideo = "http://localhost:8888/HMS/UserFacingSide/users/uploads/RecordRTC-2019011-3in8jfofog3.webm";


session_start();

$_SESSION["account_name"] = $newuser;

//echo $target_dir;
//echo $path;
echo "&nbsp;";
//echo $target_dir;

//echo $finalUploadedFileName;


// IN order to write the location of the new video to the database
//UPDATE `patient_data` SET `linkToVideoMessage` = 'http://localhost:8888/HMS/UserFacingSide/users/uploads/RecordRTC-2019014-fvlfchrvz3q.webm' WHERE `patient_data`.`pid` = 2;
?>

<?php
$servername1 = "localhost";
$username1 = "root";
$password1 = "root";
$dbname1 = "openemr";

// Create connection
$conn1 = mysqli_connect($servername1, $username1, $password1, $dbname1);
// Check connection
if (!$conn1) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['set_pid'])) {
  include_once("$srcdir/pid.inc");
  setpid($_GET['set_pid']);
}
//echo $pid;

$sql1 = "SELECT linkToVideoMessage FROM `patient_data` WHERE `fname` = '$newuser' AND `lname` = '$newuser1'";
$result1 = mysqli_query($conn1, $sql1);

//Now basically this PHP variable needs to be modified from the database, on both doctor side and the user side and the loaded into both monitors.
//$linkToVideo = "http://localhost:8888/HMS/UserFacingSide/users/uploads/RecordRTC-2019011-3in8jfofog3.webm";


if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    while($row1 = mysqli_fetch_assoc($result1)) {
       // echo "linkToTheMedicalData: " . $row["linkToTheMedicalData"]. "<br>";
        $linkToVideo = $row1['linkToVideoMessage'];
    }
} else {
    echo "0 results";
}
//$readingResults = mysql_query($sql);

mysqli_close($conn1);
?>


<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Spice";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT logins FROM `users` WHERE `fname` = '$newuser' AND `lname` = '$newuser1'";
$result = mysqli_query($conn, $sql);

// Now I need to write the resulting output into a variable.


if (mysqli_num_rows($result) > 0) {

  
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       // echo "linkToTheMedicalData: " . $row["linkToTheMedicalData"]. "<br>";
        $link = $row['logins'];
    }
} else {
    echo "0 results";
}
#$readingResults = mysql_query($sql);

echo $logins;
mysqli_close($conn);


$accountName = $_GET['filename'];
//echo $accountName;

if ( $accountName != null) {
  $servername1 = "localhost";
  $username1 = "root";
  $password1 = "root";
  $dbname1 = "openemr";
  
  // Create connection
  $conn1 = mysqli_connect($servername1, $username1, $password1, $dbname1);
  // Check connection
  if (!$conn1) {
      die("Connection failed: " . mysqli_connect_error());
  }
  
  $sql1 = "UPDATE patient_data SET linkToTheMedicalData = 'http://localhost:8888/HMS/UserFacingSide/users/uploads/$accountName' WHERE `fname` = '$newuser' AND `lname` = '$newuser1'"; // UPDATE Users SET weight = 160, desiredWeight = 145 WHERE id = 1;
  //UPDATE `patient_data` SET `linkToVideoMessage` = 'http://localhost:8888/HMS/UserFacingSide/users/uploads/RecordRTC-2019014-fvlfchrvz3q.webm' WHERE `fname` = "Dolores" AND `lname` = "Vanguelos";
  $result1 = mysqli_query($conn1, $sql1);                               // INSERT INTO 'TableName' (LinkToTheMedicalData) VALUES ('Variable(LinkToTheFile)','Variable2') WHERE fname = $newuser lname = $newuser1 ; 

  mysqli_close($conn1);

} else {
  // echo "Upload your file first!";
}


//Now basically this PHP variable needs to be modified from the database, on both doctor side and the user side and the loaded into both monitors.
//$linkToVideo = "http://localhost:8888/HMS/UserFacingSide/users/uploads/RecordRTC-2019011-3in8jfofog3.webm";


session_start();

$_SESSION["account_name"] = $newuser;

//echo $target_dir;
//echo $path;
echo "&nbsp;";
//echo $target_dir;

//echo $finalUploadedFileName;


// IN order to write the location of the new video to the database
//UPDATE `patient_data` SET `linkToVideoMessage` = 'http://localhost:8888/HMS/UserFacingSide/users/uploads/RecordRTC-2019014-fvlfchrvz3q.webm' WHERE `patient_data`.`pid` = 2;
?>

<video width="640" height="320" controls>
 <!-- <source src="/Users/shamilkarimli/Desktop/RecordRTC-2019011-eekqrmio1qn.mkv" type="video/x-matroska"> -->
  
 
 <source src=<?php echo $linkToVideo; ?> type="video/webm">
  Your browser does not support the video tag.
</video>

  <!--  <a href="http://localhost:8888/HMS/HMSVideoAudio/index.php" style="height:300px;width:800px" id ="3"> <button> Record audio & video for the doctor </button>  </a> -->
    <?php
     echo "<button><a href=http://localhost:8888/HMS/HMSVideoAudio/index.php?fname=".$newuser."&&lname=".$newuser1.">Record audio & video for the doctor</a></button>";
    ?>
    
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <p> <h4> Serverə yüklənilməsi üçün xəstə datasını seçin (ancaq .txt qəbul edilir): </h4>   
    <input type="file" name="fileToUpload" id="fileToUpload">   <br> 
    <input type="submit" value="Datanı yüklə" name="submit"> <br>

   
   
       </p>
 
    &nbsp;   &nbsp;&nbsp; &nbsp; &nbsp;
    &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;
    &nbsp;  &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	</a>

    </div>

</div>

</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>


<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>


    <?php
       // $newPid = Math.Random();

        $userLogins =  $user->data()->logins;
        echo  $userLogins;

        $newPID = rand(10,1000);
        
        if($userLogins == 1){
        $servername2 = "localhost";
        $username2 = "root";
        $password2 = "root";
        $dbname2 = "openemr";
        
        // Create connection
        $conn2 = mysqli_connect($servername2, $username2, $password2, $dbname2);
        // Check connection
        if (!$conn2) {
            die("Connection failed: " . mysqli_connect_error());
        }
      
        $sql2 = "INSERT INTO `patient_data`(`fname`,`lname`,`pid`,`pubpid`,`id`) VALUES ('$newuser','$newuser1','$newPID','$newPID','$newPID');"; 
        echo $newuser;
        echo $newuser1;
        $result2 = mysqli_query($conn2, $sql2);
        mysqli_close($conn2);
        //Now basically this PHP variable needs to be modified from the database, on both doctor side and the user side and the loaded into both monitors.
      
        session_start();
      
        // $_SESSION["account_name"] = $newuser;
      
        //echo $target_dir;
        //echo $path;
        echo "&nbsp;";
        //echo $target_dir;
      
        //echo $finalUploadedFileName;
      exit;

    } else {
        echo "Login successful!";
    }

?>
	</html>

	    

