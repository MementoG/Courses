define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
    'use strict';
    return Component.extend({
        storeQty: ko.observable(''),
        isLoading: ko.observable(false),
        isVisible: ko.observable(false),
        id: '',
        url: '',
        initialize: function () {
            this._super();
            this.isVisible(false);
            return this;
        },
        getQty: function () {
            this.isLoading(true);
            var self = this;
            var response = {};
            $.ajax({
                url: self.url,
                type: 'post',
                dataType: 'json',
                data: { "id" : self.id }
            }).done(function (data) {
                    response = JSON.parse(data);
                    if (response.qty) {
                        self.isVisible(true);
                        self.storeQty(response.qty);
                    }
                }).always(function () {
                self.isLoading(false);
            });
        }
    });
});
