
var form_validation = function() {
    var e = function() {
            jQuery(".form-valide").validate({
                ignore: [],
                errorClass: "invalid-feedback animated fadeInDown",
                errorElement: "div",
                errorPlacement: function(e, a) {
                    jQuery(a).parents(".form-group > div").append(e)
                },
                highlight: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                },
                rules: {
                    "val-name": {
                        required: !0,
                        minlength: 2
                    },
                    "val-address": {
                        required: !0,
                        minlength: 5
                    },
                    "val-category": {
                        required: !0
                    },
                    "val-phone": {
                        required: !0,
                        minlength: 8,
                        maxlength: 12, 
                        digits: !0
                    },
                    "val-backup1": {
                        required: !0,
                        minlength: 8,
                        maxlength: 12, 
                        digits: !0
                    },
                    "val-backup2": {
                        required: !0,
                        minlength: 8,
                        maxlength: 12, 
                        digits: !0
                    },
                    "val-viber": {
                        required: !0,
                        minlength: 8,
                        maxlength: 12, 
                        digits: !0
                    },
                    "val-messenger": {
                        required: !0,
                        url: !0
                    },
                    "val-facebook": {
                        required: !0,
                        url: !0
                    },
                    "val-profile": {
                        required: !0
                    }
                },
                messages: {
                    "val-name": {
                        required: "Please enter your shop name.",
                        minlength: "Your shop name must consist of at least 2 characters."
                    },
                    "val-address": {
                        required: "Please enter your shop address.",
                        minlength: "Your shop address must consist of at least 5 characters."
                    },
                    "val-phone": {
                        required: "Please enter backup phone number.",
                        minlength: "Your phone number must consist of at least 8 characters.",
                        maxlength: "Maximum 12 characters.",
                        digits:     "Please enter between 0 and 9."
                    },
                    "val-backup1": {
                        required: "Please enter backup phone number.",
                        minlength: "Your phone number must consist of at least 8 characters.",
                        maxlength: "Maximum 12 characters.",
                        digits:     "Please enter between 0 and 9."
                    },
                    "val-backup2": {
                        required: "Please enter backup phone number.",
                        minlength: "Your phone number must consist of at least 8 characters.",
                        maxlength: "Maximum 12 characters.",
                        digits:     "Please enter between 0 and 9."
                    },
                    "val-viber": {
                        required: "Please enter backup phone number.",
                        minlength: "Your phone number must consist of at least 8 characters.",
                        maxlength: "Maximum 12 characters.",
                        digits:     "Please enter between 0 and 9."
                    },
                    "val-category": "Please select category.",
                    "val-messenger": "Please enter your messenger url.",
                    "val-facebook": "Please enter your facebook url.",
                    "val-profile": "Please upload your shop logo or photo."

                    
                }
            })
        }
    return {
        init: function() {
            e(), a(), jQuery(".js-select2").on("change", function() {
                jQuery(this).valid()
            })
        }
    }
}();
jQuery(function() {
    form_validation.init()
});