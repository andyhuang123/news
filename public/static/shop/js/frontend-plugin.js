jQuery(document).ready(function(a) {
    function n() {
        if (a(".vereesa-google-maps").length <= 0) { return }
        a(".vereesa-google-maps").each(function() {
            var I = a(this),
                y = I.attr("id"),
                J = I.attr("data-title_maps"),
                E = I.attr("data-phone"),
                w = I.attr("data-email"),
                K = parseInt(I.attr("data-zoom"), 10),
                z = I.attr("data-latitude"),
                A = I.attr("data-longitude"),
                v = I.attr("data-address"),
                C = I.attr("data-map-type"),
                F = I.attr("data-pin-icon"),
                D = true,
                G = I.attr("data-saturation"),
                x = I.attr("data-hue"),
                B = I.data("map-style"),
                H;
            if (D == true) { var H = [{ stylers: [{ hue: x }, { invert_lightness: false }, { saturation: G }, { lightness: 1 }, { featureType: "landscape.man_made", stylers: [{ visibility: "on" }] }] }, { featureType: "all", elementType: "labels.text.fill", stylers: [{ saturation: 36 }, { color: "#000000" }, { lightness: 40 }] }, { featureType: "all", elementType: "labels.text.stroke", stylers: [{ visibility: "on" }, { color: "#000000" }, { lightness: 16 }] }, { featureType: "all", elementType: "labels.icon", stylers: [{ visibility: "off" }] }, { featureType: "administrative", elementType: "geometry.fill", stylers: [{ color: "#000000" }, { lightness: 20 }] }, { featureType: "administrative", elementType: "geometry.stroke", stylers: [{ color: "#000000" }, { lightness: 17 }, { weight: 1.2 }] }, { featureType: "landscape", elementType: "geometry", stylers: [{ color: "#000000" }, { lightness: 20 }] }, { featureType: "poi", elementType: "geometry", stylers: [{ color: "#000000" }, { lightness: 21 }] }, { featureType: "road.highway", elementType: "geometry.fill", stylers: [{ color: "#000000" }, { lightness: 17 }] }, { featureType: "road.highway", elementType: "geometry.stroke", stylers: [{ color: "#000000" }, { lightness: 29 }, { weight: 0.2 }] }, { featureType: "road.arterial", elementType: "geometry", stylers: [{ color: "#000000" }, { lightness: 18 }] }, { featureType: "road.local", elementType: "geometry", stylers: [{ color: "#000000" }, { lightness: 16 }] }, { featureType: "transit", elementType: "geometry", stylers: [{ color: "#000000" }, { lightness: 19 }] }, { featureType: "water", elementType: "geometry", stylers: [{ color: "#000000" }, { lightness: 17 }] }] }
            var Q;
            var L = new google.maps.LatLngBounds();
            var R = { zoom: K, panControl: true, zoomControl: true, mapTypeControl: true, scaleControl: true, draggable: true, scrollwheel: false, mapTypeId: google.maps.MapTypeId[C], styles: H };
            Q = new google.maps.Map(document.getElementById(y), R);
            Q.setTilt(45);
            var T = [];
            var P = [];
            if (z != "" && A != "") {
                T[0] = [v, z, A];
                P[0] = [v]
            }
            var O = new google.maps.InfoWindow(),
                S, N;
            for (N = 0; N < T.length; N++) {
                var U = new google.maps.LatLng(T[N][1], T[N][2]);
                L.extend(U);
                S = new google.maps.Marker({ position: U, map: Q, title: T[N][0], icon: F });
                Q.fitBounds(L)
            }
            var M = google.maps.event.addListener((Q), "bounds_changed", function(V) {
                this.setZoom(K);
                google.maps.event.removeListener(M)
            })
        })
    }
    a(document).ready(function() { n() });

    function p() {
        var v = ".vereesa-nav-toggle";
        a(v).each(function() {
            var w = a(this);
            w.children(".menu-item.parent").each(function() {
                var x = a(this).find(".submenu");
                a(this).children(".toggle-submenu").on("click", function() {
                    a(this).parent().children(".submenu").slideToggle(500);
                    w.find(".submenu").not(x).slideUp(500);
                    a(this).parent().toggleClass("show-submenu");
                    w.find(".menu-item.parent").not(a(this).parent()).removeClass("show-submenu")
                });
                var y = a(this).find(".submenu");
                y.children(".menu-item.parent").each(function() {
                    var z = a(this).find(".submenu");
                    a(this).children(".toggle-submenu").on("click", function() {
                        a(this).parent().parent().find(".submenu").not(z).slideUp(500);
                        a(this).parent().children(".submenu").slideToggle(500);
                        a(this).parent().parent().find(".menu-item.parent").not(a(this).parent()).removeClass("show-submenu");
                        a(this).parent().toggleClass("show-submenu")
                    })
                })
            })
        })
    }
    a(document).on("click", ".bar-open-menu", function() {
        a(this).toggleClass("active");
        a(this).closest(".main-header").find(".header-nav").toggleClass("show-menu");
        return false
    });
    a(document).on("click", ".block-title", function() {
        a(this).closest(".block-nav-categori").toggleClass("active");
        a(this).closest(".block-nav-categori").find(".verticalmenu-content").toggleClass("show-up");
        return false
    });
    a(document).on("click", ".bar-open-menu,.vertical-menu-overlay", function() { a("body").toggleClass("vertical-menu-open"); return false });
    a(document).on("click", ".error-404 .toggle-hightlight", function() { a(this).closest(".text-404").find(".search-form").toggleClass("open"); return false });

    function j() {
        a(".vereesa-mini-cart .minicart-items").mCustomScrollbar();
        a(".vereesa-mini-cart .minicart-items").change(function() { a(".vereesa-mini-cart .minicart-items").mCustomScrollbar() })
    }

    function k() {
        a(".header.vertical-style .header-nav .container-wapper").mCustomScrollbar();
        a(".header.vertical-style .header-nav .container-wapper").change(function() { a(".header.vertical-style .header-nav .container-wapper").mCustomScrollbar() })
    }

    function u() { a(".quick-install").simpleLightboxVideo() }

    function s() { var v = a(window).innerWidth(); if (v < 992) { a(".sevice-item.style-1").removeClass("equal-container").find(".equal-element").removeAttr("style") } else { a(".sevice-item.style-1").addClass("equal-container") } }

    function l() {
        if (a.arcticmodal) {
            a.arcticmodal("setDefault", {
                type: "ajax",
                ajax: { cache: false },
                afterOpen: function(w) {
                    var v = a(".modal_window");
                    v.find(".custom_select").customSelect();
                    v.find(".product_preview .owl_carousel").owlCarousel({ margin: 10, themeClass: "thumbnails_carousel", nav: true, navText: [], rtl: window.ISRTL ? true : false });
                    Core.events.productPreview();
                    addthis.toolbox(".addthis_toolbox")
                }
            })
        }
        if (a("#size_chart").length > 0) { a("#size_chart").fancybox() }
        if (a.fancybox) { a.fancybox.defaults.direction = { next: "left", prev: "right" } }
        if (a(".fancybox_item").length) { a(".fancybox_item").fancybox({ openEffect: "elastic", closeEffect: "elastic", helpers: { overlay: { css: { background: "rgba(0,0,0, .6)" } }, thumbs: { width: 50, height: 50 } } }) }
        if (a(".fancybox_item_media").length) { a(".fancybox_item_media").fancybox({ openEffect: "none", closeEffect: "none", helpers: { media: {} } }) }
        if (a("#img_zoom").length) {
            a("#img_zoom").elevateZoom({ zoomType: "inner", gallery: "thumbnails", galleryActiveClass: "active", cursor: "crosshair", responsive: true, easing: true, zoomWindowFadeIn: 500, zoomWindowFadeOut: 500, lensFadeIn: 500, lensFadeOut: 500 });
            a(".open_qv").on("click", function(v) {
                var w = a(this).siblings("img").data("elevateZoom");
                a.fancybox(w.getGalleryList());
                v.preventDefault()
            })
        }
    }
    a(".chosen-select").chosen({ disable_search_threshold: 10 });

    function q() { var v = a(".masonry-grid").isotope({ itemSelector: ".grid-item", percentPosition: true, layoutMode: "masonry", masonry: { columnWidth: ".grid-sizer" } }) }

    function m() {
        a(document).on("click", ".header-control .close", function() { a(this).closest(".vereesa-dropdown").removeClass("open") });
        a(document).on("click", function(x) { var w = a(x.target).closest(".vereesa-dropdown"); var v = a(".vereesa-dropdown"); if (w.length > 0) { v.not(w).removeClass("open"); if (a(x.target).is('[data-vereesa="vereesa-dropdown"]') || a(x.target).closest('[data-vereesa="vereesa-dropdown"]').length > 0) { w.toggleClass("open"); return false } } else { a(".vereesa-dropdown").removeClass("open") } })
    }

    function r() {
        a(document).on("click", ".header-device-mobile .item.has-sub>a", function() {
            a(this).closest(".header-device-mobile").find(".item").removeClass("open");
            a(this).closest(".item").addClass("open");
            return false;
        });
        a(document).on("click", ".header-device-mobile .item .close", function() { a(this).closest(".item").removeClass("open"); return false });
        a(document).on("click", "*", function(v) { if (!a(v.target).closest(".header-device-mobile").length) { a(".header-device-mobile").find(".item").removeClass("open") } })
    }

    function o() {
        a(".owl-slick").not(".slick-initialized").each(function() {
            var x = a(this),
                w = x.data("responsive"),
                v = [];
            if (a("body").hasClass("rtl")) { v.rtl = true }
            if (x.hasClass("slick-vertical")) {
                v.prevArrow = '<span class="pe-7s-angle-up"></span>';
                v.nextArrow = '<span class="pe-7s-angle-down"></span>'
            } else {
                v.prevArrow = '<span class="fa fa-angle-left"></span>';
                v.nextArrow = '<span class="fa fa-angle-right"></span>'
            }
            v.responsive = w;
            v.cssEase = "linear";
            x.slick(v);
            x.on("afterChange", function(z, A, y) {
                x.find(".slick-active:first").addClass("first-slick");
                x.find(".slick-active:last").addClass("last-slick")
            });
            x.on("beforeChange", function(z, A, y) {
                x.find(".slick-slide").removeClass("last-slick");
                x.find(".slick-slide").removeClass("first-slick")
            });
            if (x.hasClass("slick-vertical")) {
                equal_elems();
                setTimeout(function() { x.slick("setPosition") }, 0)
            }
            x.find(".slick-active:first").addClass("first-slick");
            x.find(".slick-active:last").addClass("last-slick")
        })
    }

    function t() {
        a(document).on("click", ".vereesa-tabs .tab-link a", function() {
            var w = a(this).attr("href");
            var v = a(this).data("animate");
            v = (v == undefined || v == "") ? "" : v;
            if (v == "") { return false }
            a(w).find(".product-list-owl .owl-item.active, .product-list-grid .product-item").each(function(y) {
                var A = a(this);
                var z = a(this).attr("style");
                z = (z == undefined) ? "" : z;
                var x = y * 400;
                A.attr("style", z + ";-webkit-animation-delay:" + x + "ms;-moz-animation-delay:" + x + "ms;-o-animation-delay:" + x + "ms;animation-delay:" + x + "ms;").addClass(v + " animated").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function() {
                    A.removeClass(v + " animated");
                    A.attr("style", z)
                })
            })
        })
    }

    function f() {
        var w = parseFloat(jQuery("body").innerWidth());
        w += d();
        if (w > 991) {
            if (a("body").hasClass("home-newletter")) {
                var v = a(".kt-popup-newsletter");
                a.magnificPopup.open({ items: { src: v, type: "inline" } })
            }
        }
    }

    function g() {
        var v = parseFloat(jQuery("body").innerWidth());
        v += d();
        if (v > 992) {
            // a(document).on("click", ".quick-wiew-button", function() {
            //     alert('hello');
            //     h();
            //     return false
            // })
        }
    }

    function h() {
        a(".slider-for").slick({ slidesToShow: 1, slidesToScroll: 1, arrows: false, fade: true, asNavFor: ".slider-nav" });
        a(".slider-nav").slick({ slidesToShow: 3, slidesToScroll: 1, asNavFor: ".slider-for", dots: false, focusOnSelect: true, infinite: true, prevArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>', nextArrow: '<i class="fa fa-angle-right " aria-hidden="true"></i>', })
    }
    a(window).on("scroll", function() { if (a(window).scrollTop() > 1000) { a(".backtotop").addClass("show") } else { a(".backtotop").removeClass("show") } });
    a(document).on("click", "a.backtotop", function() { a("html, body").animate({ scrollTop: 0 }, 800) });
    a(".slider-range-price").each(function() {
        var x = a(this).data("min");
        var w = a(this).data("max");
        var z = a(this).data("unit");
        var B = a(this).data("value-min");
        var A = a(this).data("value-max");
        var v = a(this).data("label-result");
        var y = a(this);
        a(this).slider({
            range: true,
            min: x,
            max: w,
            values: [B, A],
            slide: function(C, E) {
                var D = " <span>" + z + E.values[0] + " </span>  <span> " + z + E.values[1] + "</span>";
                y.closest(".price-slider-wrapper").find(".price-slider-amount").html(D)
            }
        })
    });
    a(document).on("click", ".quantity .quantity-plus, .quantity .quantity-minus", function(x) {
        var v = a(this).closest(".quantity").find(".qty"),
            w = parseFloat(v.val()),
            y = parseFloat(v.attr("max")),
            z = parseFloat(v.attr("min")),
            A = v.attr("step");
        if (!w || w === "" || w === "NaN") { w = 0 }
        if (y === "" || y === "NaN") { y = "" }
        if (z === "" || z === "NaN") { z = 0 }
        if (A === "any" || A === "" || A === undefined || parseFloat(A) === "NaN") { A = 1 }
        if (a(this).is(".quantity-plus")) { if (y && (y == w || w > y)) { v.val(y) } else { v.val(w + parseFloat(A)) } } else { if (z && (z == w || w < z)) { v.val(z) } else { if (w > 0) { v.val(w - parseFloat(A)) } } }
        v.trigger("change");
        x.preventDefault()
    });

    function b() {
        setTimeout(function() {
            a(".equal-container").each(function() {
                var v = a(this);
                if (v.find(".equal-element").length) {
                    v.find(".equal-element").css({ height: "auto" });
                    var w = 0;
                    v.find(".equal-element").each(function() { var x = a(this).height(); if (w < x) { w = x } });
                    v.find(".equal-element").height(w)
                }
            })
        }, 1000)
    }
    a(window).load(function() { b() });
    a(window).on("resize", function() { b() });
    c();

    function c() {
        a(".owl-carousel.has-thumbs").owlCarousel({ loop: true, items: 1, thumbs: true, thumbImage: true, thumbContainerClass: "owl-thumbs", thumbItemClass: "owl-thumb-item" });
        a(".owl-carousel").each(function(z, y) {
            var x = a(this).data();
            x.navText = ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'];
            var w = a(this).data("animateout");
            var v = a(this).data("animatein");
            var C = parseFloat(a(this).data("slidespeed"));
            if (typeof w != "undefined") { x.animateOut = w }
            if (typeof v != "undefined") { x.animateIn = v }
            if (typeof(C) != "undefined") { x.smartSpeed = C }
            if (a("body").hasClass("rtl")) { x.rtl = true }
            var B = a(this);
            B.on("initialized.owl.carousel", function(D) {
                var F = parseInt(B.find(".owl-item.active").length);
                var E = 0;
                B.find(".owl-item").removeClass("item-first item-last");
                setTimeout(function() { B.find(".owl-item.active").each(function() { E++; if (E == 1) { a(this).addClass("item-first") } if (E == F) { a(this).addClass("item-last") } }) }, 100)
            });
            B.on("refreshed.owl.carousel", function(D) {
                var F = parseInt(B.find(".owl-item.active").length);
                var E = 0;
                B.find(".owl-item").removeClass("item-first item-last");
                setTimeout(function() { B.find(".owl-item.active").each(function() { E++; if (E == 1) { a(this).addClass("item-first") } if (E == F) { a(this).addClass("item-last") } }) }, 100)
            });
            B.on("change.owl.carousel", function(D) {
                var F = parseInt(B.find(".owl-item.active").length);
                var E = 0;
                B.find(".owl-item").removeClass("item-first item-last");
                setTimeout(function() { B.find(".owl-item.active").each(function() { E++; if (E == 1) { a(this).addClass("item-first") } if (E == F) { a(this).addClass("item-last") } }) }, 100);
                B.addClass("owl-changed");
                setTimeout(function() { B.removeClass("owl-changed") }, x.smartSpeed)
            });
            B.on("drag.owl.carousel", function(D) {
                B.addClass("owl-changed");
                setTimeout(function() { B.removeClass("owl-changed") }, x.smartSpeed)
            });
            B.owlCarousel(x);
            if (a(window).width() < 992) {
                var A = a(".item-background");
                A.each(function(D) {
                    if (a(".item-background").attr("data-background")) {
                        a(this).css("background-image", "url(" + a(this).data("background") + ")");
                        a(this).css("height", a(this).closest(".owl-carousel").data("height") + "px");
                        a(".slide-img").css("display", "none")
                    }
                })
            }
        })
    }

    function d() {
        var v = jQuery('<div style="width: 100%; height:200px;">test</div>'),
            w = jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append(v),
            x = v[0],
            y = w[0];
        jQuery("body").append(y);
        var z = parseFloat(x.offsetWidth);
        w.css("overflow", "scroll");
        var A = parseFloat(y.clientWidth);
        w.remove();
        return (z - A)
    }
    e();

    function e() {
        var y = parseFloat(jQuery("body").innerWidth());
        y += d();
        if (y > 990) {
            if (a(".container-wapper .main-menu").length > 0) {
                var v = a(".main-menu-wapper");
                if (v != "undefined") {
                    var x = 0;
                    x = parseFloat(v.innerWidth());
                    var w = 0;
                    w = v.offset();
                    setTimeout(function() {
                        a(".main-menu .menu-item-has-children").each(function(C, B) {
                            a(B).children(".mega-menu").css({ width: x + "px" });
                            var I = parseFloat(a(B).children(".mega-menu").outerWidth());
                            var E = parseFloat(a(B).outerWidth());
                            a(B).children(".mega-menu").css({ left: "-" + (I / 2 - E / 2) + "px" });
                            var z = w.left;
                            var A = (z + x);
                            var D = a(B).offset().left;
                            var G = (I / 2 > (D - z));
                            var H = ((I / 2 + D) > A);
                            if (G) {
                                var F = (D - z);
                                a(B).children(".mega-menu").css({ left: -F + "px" })
                            }
                            if (H && !G) {
                                var F = (D - z);
                                F = F - (x - I);
                                a(B).children(".mega-menu").css({ left: -F + "px" })
                            }
                        })
                    }, 100)
                }
            }
        }
    }

    function i() {
        if (a(".vereesa-countdown").length > 0) {
            var v = ["Years", "Months", "Weeks", "Days", "Hrs", "Mins", "Secs"];
            var w = '<span class="box-count day"><span class="number">{dnn}</span> <span class="text">Days</span></span><span class="box-count hrs"><span class="number">{hnn}</span> <span class="text">Hrs</span></span><span class="box-count min"><span class="number">{mnn}</span> <span class="text">Mins</span></span><span class="box-count secs"><span class="number">{snn}</span> <span class="text">Secs</span></span>';
            a(".vereesa-countdown").each(function() {
                var x = new Date(a(this).data("y"), a(this).data("m") - 1, a(this).data("d"), a(this).data("h"), a(this).data("i"), a(this).data("s"));
                a(this).countdown({ until: x, labels: v, layout: w })
            })
        }
    }
    a(window).scroll(function() { j() });
    a(window).resize(function() {
        g();
        q();
        e();
        s();
        l();
        j()
    });
    a(window).load(function() {
        f();
        g();
        r();
        s();
        j()
    });
    q();
    m();
    o();
    s();
    t();
    l();
    u();
    e();
    j();
    i();
    p();
    k()
});