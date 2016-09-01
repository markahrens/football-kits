var Backbone = require('backbone');
var _ = require('underscore');
//var template = require('./templates/AboutView.pug');
var AboutView = Backbone.View.extend({

  tagName: 'div',
  className: 'about site-info',

  initialize: function(options) {
   this.clubs = options.clubs;
  },

  render: function() {
    return this;
  }

});

module.exports = AboutView;
