

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

    $addresses.on('click', '.address-save-confirm', () => {
      this.saveAddress();
    });
    $addresses.on('change', 'select[name="billing_address_index"]', () => {
      this.selectAddress();
    });
    $addresses.on('click', '.address-delete', () => {
      this.deleteAddress = true;
      this.render(this.account);
    });
    $addresses.on('click', '.address-delete-confirm', () => {
      this.deleteSelected();
    });
    $addresses.on('click', '.address-add', () => {
      this.selectedAddress = undefined;
      this.render(this.account);
    });
    const template = $('#addressestemplate').html();

    this.template = TemplateEngine.getInstance().precompileTemplate(template);
    this.refresh();
  }

  getSelectedId() {
    return $(this.mainselector + ' select[name="billing_address_index"]').val();
  }

  deleteSelected() {
    this.deleteAddress = false;
    const selectedId = this.getSelectedId();
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

  selectAddress() {
    this.deleteAddress = false;
    if (!Utils.hasValue(this.account) || !Utils.hasValue(this.account.addresses)) {
      return;
    }
    const selectedId = this.getSelectedId();
    this.selectedAddress = this.account.addresses.find(a => a.id === selectedId);
    this.render(this.account);
  }

  saveAddress() {
    const address = Utils.formToJson('form[name="address"]');
    address.id = this.getSelectedId();
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
    account.showNew = !account.deleteAddress;
    $(this.mainselector).html(this.template(account));
  }

}

$(document).ready(() => {
  Addresses.getInstance().bind();
});
