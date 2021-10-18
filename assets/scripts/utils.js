class Http {

  static handleErrors(response) {
    if (!response.ok) {
      throw Error(response.statusText);
    }
    return response;
  }

  static post(url, data) {
    return fetch(url, {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      method: 'POST',
      body: JSON.stringify(data)
    }).then(Http.handleErrors).then((response) => response.json());
  }

  static put(url, data) {
    return fetch(url, {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      method: 'PUT',
      body: JSON.stringify(data)
    }).then(Http.handleErrors).then((response) => response.json());
  }

  static get(url) {
    return fetch(url, {
      headers: {
        'Accept': 'application/json'
      },
      method: 'GET'
    }).then(Http.handleErrors).then((response) => response.json());
  }

  static remove(url, data) {
    return fetch(url, {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      method: 'DELETE',
      body: JSON.stringify(data)
    }).then(Http.handleErrors).then((response) => response.json());
  }
}

class TemplateEngine {
  static _instance = undefined;
  static getInstance() {
    if (!TemplateEngine._instance) {
      TemplateEngine._instance = new TemplateEngine();
    }
    return TemplateEngine._instance;
  }

  constructor() {
    Handlebars.registerHelper('formatCurrency', (value) => {
      return '€ ' + (+value).toFixed(2).toLocaleString();
    });

    Handlebars.registerHelper('ifEquals', function(a, b, next) {
      return (a === b) ? true : false;
    });
  }

  precompileTemplate(template) {
    return Handlebars.compile(template);
  }
}


class Utils {

  static formToJson(formselector) {
    const data = $(formselector).serializeArray().reduce((prev, current) => {
      prev[current.name] = current.value;
      return prev;
    }, {});

    return data;
  }

  static hasValue(obj) {
    return obj && typeof obj !== 'undefined' && obj != null;
  }
}
