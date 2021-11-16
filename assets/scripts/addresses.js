

class Addresses {

  static _instance = undefined;
  static getInstance() {
    if (!Addresses._instance) {
      Addresses._instance = new Addresses();
    }
    return Addresses._instance;
  }

  template = undefined;

  selectedAddress = undefined;

  account = undefined;

  deleteAddress = false;

  mainselector = '.address-container';

  bind() {


    const $addresses = $(this.mainselector);

    $addresses.on('click', '.address-save-confirm', ($event) => {
      this.saveAddress($event);
    });
    $addresses.on('change', 'select[name="billing_address_index"]', ($event) => {

      this.selectAddress($event);
    });
    $addresses.on('change', 'select[name="reg_account_type"]', ($event) => {
      if (!Utils.hasValue(this.selectedAddress)) {
        this.selectedAddress = {};
        this.selectedAddress.id = this.getSelectedId($event);
        this.account.addresses.push(this.selectedAddress)
      }
      const address = Utils.formToJson($($event.currentTarget).parents(this.mainselector).find('form[name="address"]'));
      console.log(address.reg_account_type, $($event.currentTarget).val());
      if (address.reg_account_type === 'Firma') {
        this.selectedAddress.isprivate = false;
        this.selectedAddress.iscompany = true;
      } else {
        this.selectedAddress.isprivate = true;
        this.selectedAddress.iscompany = false;
      }
      this.render(this.account);
    });
    $addresses.on('click', '.address-delete', () => {
      this.deleteAddress = true;
      this.render(this.account);
    });
    $addresses.on('click', '.address-delete-confirm', ($event) => {
      this.deleteSelected($event);
    });
    $addresses.on('click', '.address-add', () => {
      this.selectedAddress = undefined;
      this.render(this.account);
    });
    const template = $('#addressestemplate').html();

    this.template = TemplateEngine.getInstance().precompileTemplate(template);
    this.refresh();
  }

  getSelectedId($event) {
    return $($event.currentTarget).parents(this.mainselector).find('select[name="billing_address_index"]').val();
  }

  deleteSelected($event) {
    this.deleteAddress = false;
    const selectedId = this.getSelectedId($event);
    Http.get('/account').then((account) => {
      let addresses = account.addresses;
      if (!Utils.hasValue(addresses)) {
        addresses = [];
      }
      addresses = addresses.filter(a => a.id !== selectedId);
      return Http.put('/account/addresses', {addresses : addresses});
    }).then((account) => {
      this.account = account;
      this.render(account);
    });
  }

  selectAddress($event) {

    this.deleteAddress = false;
    if (!Utils.hasValue(this.account) || !Utils.hasValue(this.account.addresses)) {
      return;
    }
    const selectedId = this.getSelectedId($event);
    this.selectedAddress = this.account.addresses.find(a => a.id === selectedId);
    this.render(this.account);
  }

  getCartAddress() {
    return Utils.formToJson($('#overlay-cart').find('form[name="address"]'));
  }

  isCartAddressValid() {
    let form = $('#overlay-cart').find('form[name="address"]')[0];
    return form.checkValidity();
  }

  setCartFormError() {
    $('#overlay-cart').find('form[name="address"]').addClass('error');
  }

  saveAddress($event) {
    const address = Utils.formToJson($($event.currentTarget).parents(this.mainselector).find('form[name="address"]'));
    address.id = this.getSelectedId($event);
    if (address.reg_account_type === 'Firma') {
      address.isprivate = false;
      address.iscompany = true;
    } else {
      address.isprivate = true;
      address.iscompany = false;
    }
    Http.get('/account').then((account) => {
        let addresses = account.addresses;
        if (!Utils.hasValue(addresses)) {
          addresses = [];
        }
        if (addresses.filter(a => a.id === address.id).length > 0) {
          addresses = addresses.map(a => {
            if (a.id === address.id) {
              return address;
            } else {
              return a;
            }
          });
        } else {
          addresses.push(address);
        }
        return Http.put('/account/addresses', {addresses : addresses});
    }).then((account) => {
      this.selectedAddress = account.addresses.find(a => a.id === address.id);
      this.account = account;
      this.render(account);
    });
  }

  refresh() {
    Http.get('/account').then((account) => {
      this.account = account;
      this.render(account);
    });
  }

  render(account) {
    account.selectedAddress = this.selectedAddress;
    account.nextid = account.addresses ? account.addresses.length : 0;
    account.createnew = !this.selectedAddress;
    account.deleteAddress = Utils.hasValue(this.selectedAddress) && this.deleteAddress;
    account.showDelete = Utils.hasValue(this.selectedAddress) && !this.deleteAddress;
    account.showNew = !account.deleteAddress && Utils.hasValue(this.selectedAddress);
    $(this.mainselector).html(this.template(account));
  }

}

$(document).ready(() => {
  Addresses.getInstance().bind();
});
