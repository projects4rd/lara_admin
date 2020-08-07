"use strict";
var RDUserAdd = (function() {
    var e, t, r;
    return {
        init: function() {
            var n;
            (e = $("#rd_user_add_form")),
                (r = new RDWizard("rd_user_add_user", {
                    startStep: 1,
                    clickableSteps: !0
                })).on("beforeNext", function(e) {
                    !0 !== t.form() && e.stop();
                }),
                r.on("change", function(e) {
                    RDUtil.scrollTop();
                }),
                (t = e.validate({
                    ignore: ":hidden",
                    rules: {
                        profile_avatar: {},
                        profile_first_name: {
                            required: !0
                        },
                        profile_last_name: {
                            required: !0
                        },
                        profile_phone: {
                            required: !0
                        },
                        profile_email: {
                            required: !0,
                            email: !0
                        }
                    },
                    invalidHandler: function(e, t) {
                        RDUtil.scrollTop(),
                            swal.fire({
                                title: "",
                                text:
                                    "There are some errors in your submission. Please correct them.",
                                type: "error",
                                buttonStyling: !1,
                                confirmButtonClass:
                                    "btn btn-brand btn-sm btn-bold"
                            });
                    },
                    submitHandler: function(e) {}
                })),
                (n = e.find('[data-rdwizard-type="action-submit"]')).on(
                    "click",
                    function(r) {
                        r.preventDefault(),
                            t.form() &&
                                (RDApp.progress(n),
                                e.ajaxSubmit({
                                    success: function() {
                                        RDApp.unprogress(n),
                                            swal.fire({
                                                title: "",
                                                text:
                                                    "The application has been successfully submitted!",
                                                type: "success",
                                                confirmButtonClass:
                                                    "btn btn-secondary"
                                            });
                                    }
                                }));
                    }
                ),
                new RDAvatar("rd_user_add_avatar");
        }
    };
})();
jQuery(document).ready(function() {
    RDUserAdd.init();
});
