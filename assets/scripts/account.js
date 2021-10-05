

class Account {

  static _instance = undefined;
  static getInstance() {
    if (!Account._instance) {
      Account._instance = new Account();
    }
    return Account._instance;
  }

  template = undefined;

  bind() {
    $('button.account').click(() => {
      this.show();
    });
    $('div.overlay.account button.close').click(() => {
      this.hide();
    });

    const $account = $('#account');
    $account.on('click', '.logout', (event) => {
      this.logout();
      event.preventDefault();
    });
    $account.on('submit', 'form.ajax-login', (event) => {
      const login = $('form.ajax-login').serializeArray().reduce((prev, current) => {
        prev[current.name] = current.value;
        return prev;
      }, {});
      this.login(login);
      event.preventDefault();
    });
    $account.on('submit', 'form.ajax-register', (event) => {
      const user = $('form.ajax-register').serializeArray().reduce((prev, current) => {
        prev[current.name] = current.value;
        return prev;
      }, {});
      this.register(user);
      event.preventDefault();
    });
    const template = $('#accounttemplate').html();

    this.template = TemplateEngine.getInstance().precompileTemplate(template);
    this.refresh();
  }

  show() {
    $("div.overlay.account").addClass("active");
  }

  hide() {
    $("div.overlay").removeClass("active");
  }

  register(user) {
    console.log('user', user);
    const $form = $('form.ajax-register');
    $form.removeClass('error');
    if (!user.conditions_agreement) {
      $form.addClass('error');
      return;
    }
    user.addresses = [{name : 'address1'}, {name:'address2'}];
    Http.post('/account', user).then((account) => {
      this.render(account);
    }).catch(() => {
      $form.addClass('error');
    });
  }

  login(login) {
    Http.put('/account/login', login).then((account) => {
      this.render(account);
    }).catch(() => {
      this.render({passworderror : true})
    });
  }

  logout() {
    Http.put('/account/logout').then((account) => {
      this.render(account);
    });
  }

  refresh() {
    Http.get('/account').then((account) => {
      this.render(account);
    });
  }

  render(account) {
    $('#account').html(this.template(account));
  }

}

$(document).ready(() => {
  Account.getInstance().bind();
});
