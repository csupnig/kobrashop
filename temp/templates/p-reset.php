<?php snippet('p-head'); ?>
<body class="p-reset p-authentication greenBackground">
  <div class="p-background lightBlueBackground"></div>
  <a href="<?= $site->url() ?>" target="_blank"><img class="p-website" src="<?= $site->url() ?>/../assets/images/logo-white.png" alt="<?= $site->name()->html() ?>"/></a>
  <div class="p-form green whiteBackground">
    <h1>Reset password</h1>
    <?php if($error): ?>
      <div class="p-alert red"><span>Reset email could not be sent!</span></div>
    <?php endif ?>
    <div class="p-alert green"><span>To request a password reset, please provide your user's email address.</span></div>
    <form method="post" action="<?= $page->url() ?>">
      <div class="p-field">
        <input class="p-text green borderBottom" type="email" id="email" name="email" placeholder="Email" value="<?= esc(get('email')) ?>">
      </div>
      <div class="p-submit">
        <input class="p-button rounded large green whiteBackground clickable" type="submit" name="reset" value="Submit">
      </div>
      <div class="p-notification">
        <?php if($success): ?>
          <span class="p-alert green">An email with a password reset link has been sent to the specified email address (if a corresponding user exists).</span>
        <?php endif; ?>
      </div>
    </form>
  </div>
</body>