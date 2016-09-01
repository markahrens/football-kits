var Backbone = require('backbone');
var jquery = require('jquery');

var Router = require('./AppRouter');

var data = require('../data/clubs.json');

Backbone.$ = jquery;

var Clubs = require('./collections/Clubs');
var AppView = require('./views/AppView');
console.log(AppView);
var Application = function() {

  this.clubs = new Clubs(data.clubs);

  this.appView = new AppView({
    clubs: this.clubs
  });

  this.appView.render();
  new Router({clubs: this.clubs});
  Backbone.history.start();
};

jquery(function() {
  var application = new Application();
});
