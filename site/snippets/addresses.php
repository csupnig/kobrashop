<div id="addresses" class="address-container">

</div>

<script id="addressestemplate" type="text/x-handlebars">
{{#if loggedin}}

<div class="width100 verySmallHPadding smallVPadding">
    <select name="billing_address_index" class="select-address">
        {{#each addresses}}
          <option value="{{this.id}}" class="address-default" {{#if (ifEquals this.id ../selectedAddress.id)}}selected=""{{/if}}>{{#if (or this.billing_first_name this.billing_last_name)}}{{this.billing_first_name}} {{this.billing_last_name}}{{else}}Unbenannt{{/if}}</option>
        {{/each}}
        <option value="{{nextid}}" class="address-new" {{#if createnew}}selected=""{{/if}}>Neue Adresse</option>
    </select>
    {{#if showNew}}
    <button type="button" class="button address-add">+</button>
    {{/if}}
    {{#if showDelete}}
    <button type="button" class="button address-delete">×</button>
    {{/if}}
    {{#if deleteAddress}}
    <button type="button" class="button address-delete-confirm">Bestätigen</button>
    {{/if}}
</div>
<div class="width100 verySmallHPadding smallVPadding">

  <form name="address" class="fields-address fields">

        <select class="account_type" name="reg_account_type">
            <option value="Privatkunde" {{#if selectedAddress.isprivate}}selected=""{{/if}}>Privatkunde</option>
            <option value="Firma" {{#if selectedAddress.iscompany}}selected=""{{/if}}>Firma</option>
        </select>

        {{#if selectedAddress.iscompany}}
        <p class="form-row">
            <input type="text" class="input-text billing_company" name="billing_company" placeholder="Firma" value="{{selectedAddress.billing_company}}" required><input type="text" class="input-text billing_uid hidden" name="billing_uid" placeholder="UID" value="{{selectedAddress.billing_uid}}" autocomplete="uid" required>
        </p>
        {{/if}}
        <p class="form-row">
            <input type="text" class="input-text input-required" name="billing_first_name" placeholder="Vorname" value="{{selectedAddress.billing_first_name}}"><input type="text" class="input-text input-required billing_last_name" name="billing_last_name" placeholder="Nachname" value="{{selectedAddress.billing_last_name}}">
        </p>

        <p class="form-row">
            <input type="text" class="input-text input-required" name="billing_address_1" placeholder="Straße, Hausnummer, Tür" value="{{selectedAddress.billing_address_1}}" required><input type="text" class="input-text input-required" name="billing_postcode" placeholder="PLZ" value="{{selectedAddress.billing_postcode}}" required><input type="text" class="input-text input-required billing_city" name="billing_city" placeholder="Stadt" value="{{selectedAddress.billing_city}}" required>
        </p>

        <p class="form-row">
            <select class="country_select billing_country" name="billing_country" required>
                                    <option value="AT" {{#ifEquals selectedAddress.billing_country "AT"}} selected=""{{/ifEquals}}>Österreich</option>
                                    <option value="BE" {{#ifEquals selectedAddress.billing_country "BE"}} selected=""{{/ifEquals}}>Belgien</option>
                                    <option value="BG" {{#ifEquals selectedAddress.billing_country "BG"}} selected=""{{/ifEquals}}>Bulgarien</option>
                                    <option value="HR" {{#ifEquals selectedAddress.billing_country "HR"}} selected=""{{/ifEquals}}>Kroatien</option>
                                    <option value="CY" {{#ifEquals selectedAddress.billing_country "CY"}} selected=""{{/ifEquals}}>Zypern</option>
                                    <option value="CZ" {{#ifEquals selectedAddress.billing_country "CZ"}} selected=""{{/ifEquals}}>Tschechien</option>
                                    <option value="DK" {{#ifEquals selectedAddress.billing_country "DK"}} selected=""{{/ifEquals}}>Dänemark</option>
                                    <option value="EE" {{#ifEquals selectedAddress.billing_country "EE"}} selected=""{{/ifEquals}}>Estland</option>
                                    <option value="FI" {{#ifEquals selectedAddress.billing_country "FI"}} selected=""{{/ifEquals}}>Finnland</option>
                                    <option value="FR" {{#ifEquals selectedAddress.billing_country "FR"}} selected=""{{/ifEquals}}>Frankreich</option>
                                    <option value="DE" {{#ifEquals selectedAddress.billing_country "DE"}} selected=""{{/ifEquals}}>Deutschland</option>
                                    <option value="GR" {{#ifEquals selectedAddress.billing_country "GR"}} selected=""{{/ifEquals}}>Griechenland</option>
                                    <option value="HU" {{#ifEquals selectedAddress.billing_country "HU"}} selected=""{{/ifEquals}}>Ungarn</option>
                                    <option value="IT" {{#ifEquals selectedAddress.billing_country "IT"}} selected=""{{/ifEquals}}>Italien</option>
                                    <option value="LV" {{#ifEquals selectedAddress.billing_country "LV"}} selected=""{{/ifEquals}}>Lettland</option>
                                    <option value="LT" {{#ifEquals selectedAddress.billing_country "LT"}} selected=""{{/ifEquals}}>Litauen</option>
                                    <option value="LU" {{#ifEquals selectedAddress.billing_country "LU"}} selected=""{{/ifEquals}}>Luxemburg</option>
                                    <option value="MT" {{#ifEquals selectedAddress.billing_country "MT"}} selected=""{{/ifEquals}}>Malta</option>
                                    <option value="NL" {{#ifEquals selectedAddress.billing_country "NL"}} selected=""{{/ifEquals}}>Niederlande</option>
                                    <option value="PL" {{#ifEquals selectedAddress.billing_country "PL"}} selected=""{{/ifEquals}}>Polen</option>
                                    <option value="PT" {{#ifEquals selectedAddress.billing_country "PT"}} selected=""{{/ifEquals}}>Portugal</option>
                                    <option value="IE" {{#ifEquals selectedAddress.billing_country "IE"}} selected=""{{/ifEquals}}>Irland</option>
                                    <option value="RO" {{#ifEquals selectedAddress.billing_country "RO"}} selected=""{{/ifEquals}}>Rumänien</option>
                                    <option value="SK" {{#ifEquals selectedAddress.billing_country "SK"}} selected=""{{/ifEquals}}>Slowakei</option>
                                    <option value="SI" {{#ifEquals selectedAddress.billing_country "SI"}} selected=""{{/ifEquals}}>Slowenien</option>
                                    <option value="ES" {{#ifEquals selectedAddress.billing_country "ES"}} selected=""{{/ifEquals}}>Spanien</option>
                                    <option value="SE" {{#ifEquals selectedAddress.billing_country "SE"}} selected=""{{/ifEquals}}>Schweden</option>
                                    <option value="GB" {{#ifEquals selectedAddress.billing_country "GB"}} selected=""{{/ifEquals}}>United Kingdom</option>
                            </select><input type="text" class="input-text input-required" name="billing_phone" placeholder="Telefonnummer" value="{{selectedAddress.billing_phone}}">
        </p>

    <button type="button" class="button address-save-confirm">Adresse speichern</button>

	</div>

</div>

{{else}}

{{/if}}

</script>
