var Backbone = require('backbone');
var AboutView = require('./views/AboutView');

var Router = Backbone.Router.extend({

  views: [],

  initialize: function(options) {
    this.airports = options.airports;
    this._lastOffset = 0;
  },

  routes: {
    "about":           "about",
    "*path":           "default"
  },

  about: function() {
    if (!this._aboutView) {
      this._aboutView = new AboutView({airports: this.airports});
      Backbone.$('body').append(this._aboutView.render().el);
    }
  }
});

module.exports = Router;
