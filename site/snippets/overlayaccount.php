<div class="overlay account width33 height100 fixed top right verySmallPadding whiteBackground">
	<button class="close floatRight"></button>


  <div id="account">

  </div>
  <script id="accounttemplate" type="text/x-handlebars">
    {{#if loggedin}}
      <h1>Loggedin</h1>
      <a href="#" class="logout">Logout</a>
    {{else}}



	<div class="col-1">


		<h2>Hallo! <span class="txt-headline-light">Bitte melde Dich mit Deinen Kundendaten an.</span></h2>

		<form method="post" class="login ajax-login">

			<div class="form-row form-row-wide fields">
				<input type="text" class="input-text input-required user_login" placeholder="E-Mail" name="username" id="username" value="">
				<input class="input-text input-required password" type="password" placeholder="Passwort" name="password" id="">
			</div>


			<div class="form-errors"></div>

			<div class="txt-default_medium submit-row-inline fields">
                <div>Hast Du Dein <a class="overlay-link lostpass dotted" href="https://kobrashop.at/my-account/lost-password/">Passwort vergessen</a>?</div>
                <button class="button alt submit" type="submit">Einloggen </div>
      </div>


		</form>




	</div>


    {{/if}}

</script>
</div>
