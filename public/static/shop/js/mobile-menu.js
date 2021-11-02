(function(a) {
    function b(k, n) { if (k != "undefined") { var m = 0,
                l = k.offset(); if (typeof l != "undefined") { m = k.innerWidth();
                setTimeout(function() { a(n).children(".megamenu").css({ "max-width": m + "px" }); var v = a(n).children(".megamenu").outerWidth(),
                        r = a(n).outerWidth();
                    a(n).children(".megamenu").css({ left: "-" + (v / 2 - r / 2) + "px" }); var o = l.left,
                        p = (o + m),
                        q = a(n).offset().left,
                        t = (v / 2 > (q - o)),
                        u = ((v / 2 + q) > p); if (t) { var s = (q - o);
                        a(n).children(".megamenu").css({ left: -s + "px" }) } if (u && !t) { var s = (q - o);
                        s = s - (m - v);
                        a(n).children(".megamenu").css({ left: -s + "px" }) } }, 100) } } }

    function j() { var k = jQuery("body").innerWidth();
        k += e(); if (a(".vereesa-menu-wapper.horizontal .item-megamenu").length > 0 && k > 991) { a(".vereesa-menu-wapper.horizontal .item-megamenu").each(function() { var n = a(this),
                    m = n.children(".megamenu").data("responsive"),
                    l = n.closest(".vereesa-menu-wapper"); if (m != "") { l = n.closest(m) }
                b(l, n) }) } }

    function c() { a(".vereesa-menu-wapper.vertical.support-mega-menu").each(function() { var l = a(this).offset(),
                m = parseInt(a(this).actual("width")),
                k = l.left + m;
            a(this).find(".megamenu").each(function() { var q = a(this).data("responsive"),
                    r = a(".container"); if (q != "") { r = a(this).closest(q) } var p = parseInt(r.innerWidth()) - 30,
                    o = r.offset(),
                    n = o.left + p,
                    s = (p - m); if (l.left > n || k < o.left) { s = p } if (k > n) { s = p - (m - (k - n)) - 30 } if (s > 0) { a(this).css("max-width", s + "px") } }) }) }

    function e() { var k = jQuery('<div style="width: 100%; height:200px;">test</div>'),
            l = jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append(k),
            m = k[0],
            n = l[0];
        jQuery("body").append(n); var o = m.offsetWidth;
        l.css("overflow", "scroll"); var p = n.clientWidth;
        l.remove(); return (o - p) }

    function h() { if (!a(".vereesa-menu-clone-wrap").length && a(".vereesa-clone-mobile-menu").length > 0) { a("body").prepend('<div class="vereesa-menu-clone-wrap"><div class="vereesa-menu-panels-actions-wrap"><span class="vereesa-menu-current-panel-title">MENU</span><a class="vereesa-menu-close-btn vereesa-menu-close-panels" href="#">x</a></div><div class="vereesa-menu-panels"></div></div>') } var k = 0,
            l = Array(); if (!a(".vereesa-menu-clone-wrap .vereesa-menu-panels #vereesa-menu-panel-main").length) { a(".vereesa-menu-clone-wrap .vereesa-menu-panels").append('<div id="vereesa-menu-panel-main" class="vereesa-menu-panel vereesa-menu-panel-main"><ul class="depth-01"></ul></div>') }
        a(".vereesa-clone-mobile-menu").each(function() { var m = a(this),
                r = m,
                o = r.attr("id"),
                n = "vereesa-menu-clone-" + o; if (!a("#" + n).length) { var p = m.clone(true);
                p.find(".menu-item").addClass("clone-menu-item");
                p.find("[id]").each(function() { p.find('.vc_tta-panel-heading a[href="#' + a(this).attr("id") + '"]').attr("href", "#" + g(a(this).attr("id"), "vereesa-menu-clone-"));
                    p.find('.vereesa-menu-tabs .tabs-link a[href="#' + a(this).attr("id") + '"]').attr("href", "#" + g(a(this).attr("id"), "vereesa-menu-clone-"));
                    a(this).attr("id", g(a(this).attr("id"), "vereesa-menu-clone-")) });
                p.find(".vereesa-menu-menu").addClass("vereesa-menu-menu-clone"); var q = a(".vereesa-menu-clone-wrap .vereesa-menu-panels #vereesa-menu-panel-main ul");
                q.append(p.html());
                f(q, k) } }) }

    function f(k, l) { if (k.find(".menu-item-has-children").length) { k.find(".menu-item-has-children").each(function() { var o = a(this);
                f(o, l); var m = "vereesa-menu-panel-" + l; while (a("#" + m).length) { l++;
                    m = "vereesa-menu-panel-" + l }
                o.prepend('<a class="vereesa-menu-next-panel" href="#' + m + '" data-target="#' + m + '"></a>'); var n = a("<div>").append(o.find("> .submenu").clone()).html();
                o.find("> .submenu").remove();
                a(".vereesa-menu-clone-wrap .vereesa-menu-panels").append('<div id="' + m + '" class="vereesa-menu-panel vereesa-menu-sub-panel vereesa-menu-hidden">' + n + "</div>") }) } }

    function g(l, k) { return k + l }

    function i(k, m) { var l = new RegExp(k + "=([^&]*)", "i").exec(m); return l && l[1] || "" }

    function d() { a(document).on("click", ".menu-toggle", function() { a(".vereesa-menu-clone-wrap").addClass("open"); return false });
        a(document).on("click", ".vereesa-menu-clone-wrap .vereesa-menu-close-panels", function() { a(".vereesa-menu-clone-wrap").removeClass("open"); return false });
        a(document).on("click", function(k) { if (a("body").hasClass("rtl")) { if (k.offsetX < 0) { a(".vereesa-menu-clone-wrap").removeClass("open") } } else { if (k.offsetX > a(".vereesa-menu-clone-wrap").width()) { a(".vereesa-menu-clone-wrap").removeClass("open") } } }) }
    a(document).on("click", ".vereesa-menu-next-panel", function(l) { var k = a(this),
            p = k.closest(".menu-item"),
            q = k.closest(".vereesa-menu-panel"),
            o = k.attr("href"); if (a(o).length) { q.addClass("vereesa-menu-sub-opened");
            a(o).addClass("vereesa-menu-panel-opened").removeClass("vereesa-menu-hidden").attr("data-parent-panel", q.attr("id")); var n = p.find(".vereesa-menu-item-title").attr("title"),
                m = ""; if (a(".vereesa-menu-panels-actions-wrap .vereesa-menu-current-panel-title").length > 0) { m = a(".vereesa-menu-panels-actions-wrap .vereesa-menu-current-panel-title").html() } if (typeof n != "undefined" && typeof n != false) { if (!a(".vereesa-menu-panels-actions-wrap .vereesa-menu-current-panel-title").length) { a(".vereesa-menu-panels-actions-wrap").prepend('<span class="vereesa-menu-current-panel-title"></span>') }
                a(".vereesa-menu-panels-actions-wrap .vereesa-menu-current-panel-title").html(n) } else { a(".vereesa-menu-panels-actions-wrap .vereesa-menu-current-panel-title").remove() }
            a(".vereesa-menu-panels-actions-wrap .vereesa-menu-prev-panel").remove();
            a(".vereesa-menu-panels-actions-wrap").prepend('<a data-prenttitle="' + m + '" class="vereesa-menu-prev-panel" href="#' + q.attr("id") + '" data-cur-panel="' + o + '" data-target="#' + q.attr("id") + '"></a>') }
        l.preventDefault() });
    a(document).on("click", ".vereesa-menu-prev-panel", function(m) { var k = a(this),
            l = k.attr("data-cur-panel"),
            p = k.attr("href");
        a(l).removeClass("vereesa-menu-panel-opened").addClass("vereesa-menu-hidden");
        a(p).addClass("vereesa-menu-panel-opened").removeClass("vereesa-menu-sub-opened"); var o = a(p).attr("data-parent-panel"); if (typeof o == "undefined" || typeof o == false) { a(".vereesa-menu-panels-actions-wrap .vereesa-menu-prev-panel").remove();
            a(".vereesa-menu-panels-actions-wrap .vereesa-menu-current-panel-title").html("MAIN MENU") } else { a(".vereesa-menu-panels-actions-wrap .vereesa-menu-prev-panel").attr("href", "#" + o).attr("data-cur-panel", p).attr("data-target", "#" + o); var n = a("#" + o).find('.vereesa-menu-next-panel[data-target="' + p + '"]').closest(".menu-item").find(".vereesa-menu-item-title").attr("data-title");
            n = a(this).data("prenttitle"); if (typeof n != "undefined" && typeof n != false) { if (!a(".vereesa-menu-panels-actions-wrap .vereesa-menu-current-panel-title").length) { a(".vereesa-menu-panels-actions-wrap").prepend('<span class="vereesa-menu-current-panel-title"></span>') }
                a(".vereesa-menu-panels-actions-wrap .vereesa-menu-current-panel-title").html(n) } else { a(".vereesa-menu-panels-actions-wrap .vereesa-menu-current-panel-title").remove() } }
        m.preventDefault() });
    a(window).on("resize", function() { j();
        d();
        c() });
    window.addEventListener("load", function(k) { j();
        d();
        c();
        h() }, false) })(jQuery);