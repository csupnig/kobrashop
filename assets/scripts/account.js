

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

  login(login) {
    Http.put('/account/login', login).then((account) => {
      this.render(account);
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
