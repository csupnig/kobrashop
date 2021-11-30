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

    Handlebars.registerHelper('ifEquals', (a, b, next) => {
      return (a === b) ? true : false;
    });
    Handlebars.registerHelper({
      eq: (v1, v2) => v1 === v2,
      ne: (v1, v2) => v1 !== v2,
      lt: (v1, v2) => v1 < v2,
      gt: (v1, v2) => v1 > v2,
      lte: (v1, v2) => v1 <= v2,
      gte: (v1, v2) => v1 >= v2,
      and() {
        return Array.prototype.every.call(arguments, Boolean);
      },
      or() {
        return Array.prototype.slice.call(arguments, 0, -1).some(Boolean);
      }
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

  static hasText(obj) {
    return Utils.hasValue(obj) && obj !== '' && obj.length > 0;
  }

  static go(target) {
    window.location.href = target;
  }
}
