<?php return function ($kirby, $site, $page) {
  $error = false;
  $message = "";
  $timestamp = $page->timestamp();
  $resetEmail = $page->resetEmail();
  $currentTime = (int)time();

  //GET FORM SUBMISSION
  if ($kirby->request()->is('POST') && get('resetconfirmation')) {
    $userEmail = get('email');
    //CHECK IF SPECIFIED EMAIL CORRESPONDS TO RESET PAGE
    if($userEmail == $resetEmail) {
      //CHECK IF RESET PAGE IS STILL VALID
      if ($currentTime - $timestamp >= 600) {
        //CHECK IF PASSWORD IS VALID
        if (V::minLength(get('password'),8)) {
          try { 
            $kirby->impersonate('kirby');
            $kirby->user($resetEmail)->changePassword(get('password'));
            $page->delete();
            $goToUrl = $site->url()."/portal";
            go($goToUrl);
          } catch(Exception $e) {
            $error = true;
            $message = "Your password could not be reset!";
          }
        } else {
          $error = true;
          $message = "Specified password is invalid!";
        }
      } else {
        $error = true;
        $message = "Reset page has timed out! If you would still like to reset your password, please request a new reset link.";
      }
    } else {
      $error = true;
      $message = "Email address does not correspond to user account.";
    }
  } else {
    $error = true;
    $message = "Your password could not be reset!";
  }
  return [
    'error' => $error,
    'message' => $message
  ];
};