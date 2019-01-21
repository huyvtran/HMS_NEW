<?php
 ?>
<?php require_once '../users/init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php
$query = $db->query("SELECT * FROM email");
$results = $query->first();
$act = $results->email_act;
if($act!=1) Redirect::to($us_url_root.'index.php?err=Email verification is not enabled. Please contact the System Administrator.');
if($user->isLoggedIn()) $user->logout();

$token = Input::get('csrf');
if(Input::exists()){
    if(!Token::check($token)){
        include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
    }
}

$email_sent=FALSE;

$errors = array();
if(Input::exists('post')){
    $email = Input::get('email');
    $fuser = new User($email);

    $validate = new Validate();
    $validation = $validate->check($_POST,array(
    'email' => array(
      'display' => 'Email',
      'valid_email' => true,
      'required' => true,
    ),
    ));
    if($validation->passed()){ //if email is valid, do this

        if($fuser->exists()){
          $vericode=randomstring(15);
          $vericode_expiry=date("Y-m-d H:i:s",strtotime("+$settings->join_vericode_expiry hours",strtotime(date("Y-m-d H:i:s"))));
          $db->update('users',$fuser->data()->id,['vericode' => $vericode,'vericode_expiry' => $vericode_expiry]);
            //send the email
            $options = array(
              'fname' => $fuser->data()->fname,
              'email' => rawurlencode($email),
              'vericode' => $vericode,
              'join_vericode_expiry' => $settings->join_vericode_expiry
            );
            $encoded_email=rawurlencode($email);
            $subject = 'Verify Your Email';
            $body =  email_body('_email_template_verify.php',$options);
            $email_sent=email($email,$subject,$body);
            logger($fuser->data()->id,"User","Requested a new verification email.");
            if(!$email_sent){
                $errors[] = 'Email NOT sent due to error. Please contact site administrator.';
            }
        }else{
            $errors[] = 'That email does not exist in our database';
        }
    }else{
        $errors = $validation->errors();
    }
}

?>

<div id="page-wrapper">
<div class="container">

<?php

if ($email_sent){
    require $abs_us_root.$us_url_root.'users/views/_verify_resend_success.php';
}else{
    require $abs_us_root.$us_url_root.'users/views/_verify_resend.php';
}

?>
</div>
</div>

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

  <!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
