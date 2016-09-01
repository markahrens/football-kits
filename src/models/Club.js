var Backbone = require('backbone');

var Club = Backbone.Model.extend({
  defaults: {
    id: 'key',
    name: 'Team Name',
    seasons : [{
      "year":"00-00",
      "league":"key",
      "primarySponsor":"Name",
      "primarySponsorDesc":"Description",
      "primaryColor":"F2F2F2",
      "awayColor":"F2F2F2",
      "secondaryColor":"F2F2F2"
    }],
    visible: true,
    showDetail: false
  },
});

module.exports = Club;
