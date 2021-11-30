<?php return function ($kirby, $site, $page) {
  //REDIRECT IF USER LOGGED IN
  if ($kirby->user()) {
    go('/portal');
  }
  $error = false;
  $success = false;
  $message = "";
  //DELETE OBSOLETE RESET PAGES
  $currentTime = (int)time();
  $resetPages = $site->index()->filterBy("intendedTemplate", "p-resetconfirmation")->sortBy("timestamp", "asc");
  foreach ($resetPages as $resetPage) {
    $pageTime = (int)(string)$resetPage->timestamp()->html();
    if ($currentTime - $pageTime > 600) {
      $kirby->impersonate('kirby');
      $resetPage->delete();
    }
  }

  //GET FORM SUBMISSION
  if ($kirby->request()->is('POST') && get('reset')) {

    //CHECK IF USER EXISTS
    if ($user = $kirby->user(get('email'))) {
      //GENERATE A RANDOM PAGE NAME
      $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
      $charactersLength = strlen($characters);
      $pageName = '';
      for ($i = 0; $i < 10; $i++) {
          $pageName .= $characters[rand(0, $charactersLength - 1)];
      }

      //CREATE A PASSWORD RESET PAGE
      $kirby->impersonate('kirby');
      $page->createChild([
        'slug'     => $pageName,
        'name'     => $pageName,
        'template' => 'p-resetconfirmation',
        'draft' => 0,
        'content' => [
          'resetEmail'  => get('email'),
          'timestamp' => $currentTime
        ]
      ]);

      //SEND EMAIL TO USER
      try {
        $kirby->impersonate('kirby');
        $kirby->email([
          'from'    => 'communications@inhope.org',
          'replyTo' => 'communications@inhope.org',
          'to' => get('email'),
          'subject' => 'INHOPE Portal - Password reset request',
          'template' => 'p-reset',
          'data' => [
            'pageName' => $pageName,
            'assetUrl' => kirby()->urls()->assets(),
            'siteUrl' => $site->url(),
            'footerText' => $site->address()->kirbyText()
          ]
        ]);
        $success = true;
      } catch (Exception $error) {
        $error = true;
      }
    }
  }
  return [
    'error' => $error,
    'success' => $success
  ];
};