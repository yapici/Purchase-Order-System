var PageCore;

$(window).load(function () {
    PageCore.init();
});

PageCore = {
    settings: {
        windowHeigth: ""
    },
    init: function () {
        this.settings.windowHeight = $(window).height();
    }
};