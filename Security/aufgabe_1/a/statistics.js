var statistics = {
    trackUserView: function(payload) {
        alert( 'trackUserView: ' + JSON.stringify(payload));
    },
    trackUserMail: function(payload) {
        alert( 'trackUserMail: ' + encodeURI(JSON.stringify(payload)));
    }
};
