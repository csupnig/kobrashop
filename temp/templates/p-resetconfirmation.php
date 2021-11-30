<?php snippet('p-head'); ?>
<body class="p-resetconfirmation p-authentication greenBackground">
  <div class="p-background lightBlueBackground"></div>
  <a href="<?= $site->url() ?>" target="_blank"><img class="p-website" src="<?= $site->url() ?>/../assets/images/logo-white.png" alt="<?= $site->name()->html() ?>"/></a>
  <div class="p-form green whiteBackground">
    <h1>Reset password</h1>
    <?php if($error): ?>
      <div class="p-alert red"><span>Your password could not be reset!</span></div>
    <?php endif ?>
    <div class="p-alert green"><span>Please confirm your email address and specify a new password.</span></div>
    <form method="post" action="<?= $page->url() ?>">
      <div class="p-field">
        <input class="p-text green borderBottom" type="email" id="email" name="email" placeholder="Email" value="<?= esc(get('email')) ?>">
        <input class="p-text green borderBottom" type="password" id="password" name="password" placeholder="Password (8+ characters)" value="">
      </div>
      <div class="p-submit">
        <input class="p-button rounded large green whiteBackground clickable" type="submit" name="resetconfirmation" value="Submit">
      </div>
    </form>
  </div>
</body>