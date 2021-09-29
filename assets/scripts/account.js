

class Account {

  static _instance = undefined;
  static getInstance() {
    if (!Account._instance) {
      Account._instance = new Account();
    }
    return Account._instance;
  }

  bind() {
    $('button.account').click(() => {
      this.show();
    });
    $('div.overlay.account button.close').click(() => {
      this.hide();
    });
  }

  show() {
    $("div.overlay.account").addClass("active");
  }

  hide() {
    $("div.overlay").removeClass("active");
  }

}

$(document).ready(() => {
  Account.getInstance().bind();
});
