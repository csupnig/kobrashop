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

<div class="col-2">

		<h2>Neues Konto <span class="txt-headline-light">anlegen</span></h2>

		<form method="post" class="register ajax-register" autocomplete="off">

			<div class="fields-address fields">

        <select class="account_type hidden" name="reg_account_type">
            <option value="Privatkunde" selected="">Privatkunde</option>
            <option value="Firma">Firma</option>
        </select>

        <p class="form-row">
            <input type="text" class="input-text billing_company" name="billing_company" placeholder="Firma" value=""><input type="text" class="input-text billing_uid hidden" name="billing_uid" placeholder="UID" value="" autocomplete="uid">
        </p>

        <p class="form-row">
            <input type="text" class="input-text input-required" name="billing_first_name" placeholder="Vorname" value=""><input type="text" class="input-text input-required billing_last_name" name="billing_last_name" placeholder="Nachname" value="">
        </p>

        <p class="form-row">
            <input type="text" class="input-text input-required" name="billing_address_1" placeholder="Straße, Hausnummer, Tür" value=""><input type="text" class="input-text input-required" name="billing_postcode" placeholder="PLZ" value=""><input type="text" class="input-text input-required billing_city" name="billing_city" placeholder="Stadt" value="">
        </p>

        <p class="form-row">
            <select class="country_select billing_country" name="billing_country">
                                    <option value="AT">Österreich</option>
                                    <option value="BE">Belgien</option>
                                    <option value="BG">Bulgarien</option>
                                    <option value="HR">Kroatien</option>
                                    <option value="CY">Zypern</option>
                                    <option value="CZ">Tschechien</option>
                                    <option value="DK">Dänemark</option>
                                    <option value="EE">Estland</option>
                                    <option value="FI">Finnland</option>
                                    <option value="FR">Frankreich</option>
                                    <option value="DE">Deutschland</option>
                                    <option value="GR">Griechenland</option>
                                    <option value="HU">Ungarn</option>
                                    <option value="IT">Italien</option>
                                    <option value="LV">Lettland</option>
                                    <option value="LT">Litauen</option>
                                    <option value="LU">Luxemburg</option>
                                    <option value="MT">Malta</option>
                                    <option value="NL">Niederlande</option>
                                    <option value="PL">Polen</option>
                                    <option value="PT">Portugal</option>
                                    <option value="IE">Irland</option>
                                    <option value="RO">Rumänien</option>
                                    <option value="SK">Slowakei</option>
                                    <option value="SI">Slowenien</option>
                                    <option value="ES">Spanien</option>
                                    <option value="SE">Schweden</option>
                                    <option value="GB">United Kingdom</option>
                            </select><input type="text" class="input-text input-required" name="billing_phone" placeholder="Telefonnummer" value="">
        </p>


				<p class="form-row form-row-wide">
					<input type="email" class="input-text input-required reg_email" placeholder="E-Mail" name="email" value=""><input type="password" class="input-text input-required reg_password" placeholder="Passwort" name="password" autocomplete="new-password">				</p>



			<div class="fields">
                <label class="txt-overlay-regular checkbox-container news-subscribe"><input type="checkbox" name="news_subscription" value="true"><span class="checkmark"></span>Newsletter abonnieren</label>

                <label class="txt-overlay-regular checkbox-container conditions-agree"><input type="checkbox" name="conditions_agreement" value="true"><span class="checkmark"></span>Ich akzeptiere die <a href="/legalnote/" class="toggle-legalNote dotted">Datenschutzrichtlinien</a>.</label>
      </div>

			</div>

			<div class="form-errors"></div>

            <button type="submit" class="button alt submit">Konto anlegen </button>

					</form>
	</div>


	</div>


    {{/if}}

</script>
</div>
