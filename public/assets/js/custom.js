$("#login_form").submit(function (e) {
    e.preventDefault();
    var form = $("#login_form")[0];
    var url = $("#url").val();
    var formData = new FormData(form);
    var redirect = $('meta[name="base_url"]').attr("content") + "/index";
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                window.location.href = redirect;
            } else {
                 $(".err").html("");
                $("#login_err").html(
                    ' <div class="alert alert-danger " role="alert">' +
                        data.message +
                        "</div>"
                );

                setTimeout(function () {
                    $("#login_err").html("");
                }, 3000);
            }
        },
        error: function (xhr) {
            $(".err").html("");
            $.each(xhr.responseJSON.errors, function (key, value) {
                $("." + key).append(
                    '<div class="err text-danger">' + value + "</div>"
                );
            });
        },
    });
});
(() => {
    function e(t) {
        return (e =
            "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                ? function (e) {
                      return typeof e;
                  }
                : function (e) {
                      return e &&
                          "function" == typeof Symbol &&
                          e.constructor === Symbol &&
                          e !== Symbol.prototype
                          ? "symbol"
                          : typeof e;
                  })(t);
    }
    !(function (t) {
        "use strict";
        t(document).on("click", "a[data-theme]", function () {
            t("head link#theme").attr("href", t(this).data("theme")),
                t(this).toggleClass("active").siblings().removeClass("active");
        }),
            t(document).on("click", '[data-bs-toggle="collapse"]', function () {
                t(this).toggleClass("active").siblings().removeClass("active");
            }),
            t(document).on("click", ".fullscreen-button", function () {
                t("html").addClass("fullscreen-button"),
                    (void 0 !== document.fullScreenElement &&
                        null === document.fullScreenElement) ||
                    (void 0 !== document.msFullscreenElement &&
                        null === document.msFullscreenElement) ||
                    (void 0 !== document.mozFullScreen &&
                        !document.mozFullScreen) ||
                    (void 0 !== document.webkitIsFullScreen &&
                        !document.webkitIsFullScreen)
                        ? document.documentElement.requestFullScreen
                            ? document.documentElement.requestFullScreen()
                            : document.documentElement.mozRequestFullScreen
                            ? document.documentElement.mozRequestFullScreen()
                            : document.documentElement.webkitRequestFullScreen
                            ? document.documentElement.webkitRequestFullScreen(
                                  Element.ALLOW_KEYBOARD_INPUT
                              )
                            : document.documentElement.msRequestFullscreen &&
                              document.documentElement.msRequestFullscreen()
                        : (t("html").removeClass("fullscreen-button"),
                          document.cancelFullScreen
                              ? document.cancelFullScreen()
                              : document.mozCancelFullScreen
                              ? document.mozCancelFullScreen()
                              : document.webkitCancelFullScreen
                              ? document.webkitCancelFullScreen()
                              : document.msExitFullscreen &&
                                document.msExitFullscreen());
            }),
            t(window).on("load", function (e) {
                t("#global-loader").fadeOut("slow");
            }),
            t(window).on("scroll", function (e) {
                t(this).scrollTop() > 0
                    ? t("#back-to-top").fadeIn("slow")
                    : t("#back-to-top").fadeOut("slow");
            }),
            t(document).on("click", "#back-to-top", function (e) {
                return t("html, body").animate({ scrollTop: 0 }, 0), !1;
            }),
            t(".cover-image").each(function () {
                var n = t(this).attr("data-bs-image-src");
                "undefined" !== e(n) &&
                    !1 !== n &&
                    t(this).css("background", "url(" + n + ") center center");
            }),
            t(function () {
                t(".add").on("click", function () {
                    var e = t(this).closest("div").find(".qty"),
                        n = parseInt(e.val());
                    isNaN(n) || e.val(n + 1);
                }),
                    t(".minus").on("click", function () {
                        var e = t(this).closest("div").find(".qty"),
                            n = parseInt(e.val());
                        !isNaN(n) && n > 0 && e.val(n - 1);
                    });
            }),
            t(".chart-circle").length &&
                t(".chart-circle").each(function () {
                    var e = t(this);
                    e.circleProgress({
                        fill: { color: e.attr("data-bs-color") },
                        size: e.height(),
                        startAngle: (-Math.PI / 4) * 2,
                        emptyFill: "rgba(119, 119, 142, 0.2)",
                        lineCap: "round",
                    });
                }),
            t(".modal-effect").on("click", function (e) {
                e.preventDefault();
                var n = t(this).attr("data-bs-effect");
                t("#modaldemo8").addClass(n);
            }),
            t("#modaldemo8").on("hidden.bs.modal", function (e) {
                t(this).removeClass(function (e, t) {
                    return (t.match(/(^|\s)effect-\S+/g) || []).join(" ");
                });
            });
        var n = "div.card";
        [].slice
            .call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            .map(function (e) {
                return new bootstrap.Tooltip(e);
            }),
            [].slice
                .call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                .map(function (e) {
                    return new bootstrap.Popover(e);
                });
        t(document).on("click", function (e) {
            t('[data-toggle="popover"],[data-original-title]').each(
                function () {
                    t(this).is(e.target) ||
                        0 !== t(this).has(e.target).length ||
                        0 !== t(".popover").has(e.target).length ||
                        ((
                            (t(this).popover("hide").data("bs.popover") || {})
                                .inState || {}
                        ).click = !1);
                }
            );
        }),
            t(document).on(
                "click",
                '[data-bs-toggle="card-remove"]',
                function (e) {
                    return t(this).closest(n).remove(), e.preventDefault(), !1;
                }
            ),
            t(document).on(
                "click",
                '[data-bs-toggle="card-collapse"]',
                function (e) {
                    return (
                        t(this).closest(n).toggleClass("card-collapsed"),
                        e.preventDefault(),
                        !1
                    );
                }
            ),
            t(document).on(
                "click",
                '[data-bs-toggle="card-fullscreen"]',
                function (e) {
                    return (
                        t(this)
                            .closest(n)
                            .toggleClass("card-fullscreen")
                            .removeClass("card-collapsed"),
                        e.preventDefault(),
                        !1
                    );
                }
            ),
            t(document).on("change", ".file-browserinput", function () {
                var e = t(this),
                    n = e.get(0).files ? e.get(0).files.length : 1,
                    l = e.val().replace(/\\/g, "/").replace(/.*\//, "");
                e.trigger("fileselect", [n, l]);
            }),
            t(".file-browserinput").on("fileselect", function (e, n, l) {
                var o = t(this).parents(".input-group").find(":text"),
                    c = n > 1 ? n + " files selected" : l;
                o.length ? o.val(c) : c && alert(c);
            }),
            t(".layout-setting").on("click", function (e) {
                document
                    ? t("body").toggleClass("dark-mode")
                    : (t("body").removeClass("dark-mode"),
                      t("body").addClass("light-mode"));
            });
    })(jQuery);
})();
