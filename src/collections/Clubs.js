var Backbone = require('backbone');
var Club = require('../models/Club');

var Clubs = Backbone.Collection.extend({

  model: Club,

  comparator: 'id'

});

module.exports = Clubs;
