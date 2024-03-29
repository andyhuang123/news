/*
 * fancyBox - jQuery Plugin
 * version: 2.1.5 (Fri, 14 Jun 2013)
 * @requires jQuery v1.6 or later
 *
 * Examples at http://fancyapps.com/fancybox/
 * License: www.fancyapps.com/fancybox/#license
 *
 * Copyright 2012 Janis Skarnelis - janis@fancyapps.com
 *
 */
(function(q, d, a, o) { var h = a("html"),
        p = a(q),
        b = a(d),
        e = a.fancybox = function() { e.open.apply(this, arguments) },
        i = navigator.userAgent.match(/msie/i),
        c = null,
        n = d.createTouch !== o,
        k = function(r) { return r && r.hasOwnProperty && r instanceof a },
        m = function(r) { return r && a.type(r) === "string" },
        j = function(r) { return m(r) && r.indexOf("%") > 0 },
        l = function(r) { return (r && !(r.style.overflow && r.style.overflow === "hidden") && ((r.clientWidth && r.scrollWidth > r.clientWidth) || (r.clientHeight && r.scrollHeight > r.clientHeight))) },
        f = function(s, r) { var t = parseInt(s, 10) || 0; if (r && j(s)) { t = e.getViewport()[r] / 100 * t } return Math.ceil(t) },
        g = function(s, r) { return f(s, r) + "px" };
    a.extend(e, { version: "2.1.5", defaults: { padding: 15, margin: 20, width: 800, height: 600, minWidth: 100, minHeight: 100, maxWidth: 9999, maxHeight: 9999, pixelRatio: 1, autoSize: true, autoHeight: false, autoWidth: false, autoResize: true, autoCenter: !n, fitToView: true, aspectRatio: false, topRatio: 0.5, leftRatio: 0.5, scrolling: "auto", wrapCSS: "", arrows: true, closeBtn: true, closeClick: false, nextClick: false, mouseWheel: true, autoPlay: false, playSpeed: 3000, preload: 3, modal: false, loop: true, ajax: { dataType: "html", headers: { "X-fancyBox": true } }, iframe: { scrolling: "auto", preload: true }, swf: { wmode: "transparent", allowfullscreen: "true", allowscriptaccess: "always" }, keys: { next: { 13: "left", 34: "up", 39: "left", 40: "up" }, prev: { 8: "right", 33: "down", 37: "right", 38: "down" }, close: [27], play: [32], toggle: [70] }, direction: { next: "left", prev: "right" }, scrollOutside: true, index: 0, type: null, href: null, content: null, title: null, tpl: { wrap: '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>', image: '<img class="fancybox-image" src="{href}" alt="img" />', iframe: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + (i ? ' allowtransparency="true"' : "") + "></iframe>", error: '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>', closeBtn: '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>', next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>', prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>' }, openEffect: "fade", openSpeed: 250, openEasing: "swing", openOpacity: true, openMethod: "zoomIn", closeEffect: "fade", closeSpeed: 250, closeEasing: "swing", closeOpacity: true, closeMethod: "zoomOut", nextEffect: "elastic", nextSpeed: 250, nextEasing: "swing", nextMethod: "changeIn", prevEffect: "elastic", prevSpeed: 250, prevEasing: "swing", prevMethod: "changeOut", helpers: { overlay: true, title: true }, onCancel: a.noop, beforeLoad: a.noop, afterLoad: a.noop, beforeShow: a.noop, afterShow: a.noop, beforeChange: a.noop, beforeClose: a.noop, afterClose: a.noop }, group: {}, opts: {}, previous: null, coming: null, current: null, isActive: false, isOpen: false, isOpened: false, wrap: null, skin: null, outer: null, inner: null, player: { timer: null, isActive: false }, ajaxLoad: null, imgPreload: null, transitions: {}, helpers: {}, open: function(r, s) { if (!r) { return } if (!a.isPlainObject(s)) { s = {} } if (false === e.close(true)) { return } if (!a.isArray(r)) { r = k(r) ? a(r).get() : [r] }
            a.each(r, function(x, u) { var y = {},
                    v, B, t, C, z, w, A; if (a.type(u) === "object") { if (u.nodeType) { u = a(u) } if (k(u)) { y = { href: u.data("fancybox-href") || u.attr("href"), title: u.data("fancybox-title") || u.attr("title"), isDom: true, element: u }; if (a.metadata) { a.extend(true, y, u.metadata()) } } else { y = u } }
                v = s.href || y.href || (m(u) ? u : null);
                B = s.title !== o ? s.title : y.title || "";
                t = s.content || y.content;
                C = t ? "html" : (s.type || y.type); if (!C && y.isDom) { C = u.data("fancybox-type"); if (!C) { z = u.prop("class").match(/fancybox\.(\w+)/);
                        C = z ? z[1] : null } } if (m(v)) { if (!C) { if (e.isImage(v)) { C = "image" } else { if (e.isSWF(v)) { C = "swf" } else { if (v.charAt(0) === "#") { C = "inline" } else { if (m(u)) { C = "html";
                                        t = u } } } } } if (C === "ajax") { w = v.split(/\s+/, 2);
                        v = w.shift();
                        A = w.shift() } } if (!t) { if (C === "inline") { if (v) { t = a(m(v) ? v.replace(/.*(?=#[^\s]+$)/, "") : v) } else { if (y.isDom) { t = u } } } else { if (C === "html") { t = v } else { if (!C && !v && y.isDom) { C = "inline";
                                t = u } } } }
                a.extend(y, { href: v, type: C, content: t, title: B, selector: A });
                r[x] = y });
            e.opts = a.extend(true, {}, e.defaults, s); if (s.keys !== o) { e.opts.keys = s.keys ? a.extend({}, e.defaults.keys, s.keys) : false }
            e.group = r; return e._start(e.opts.index) }, cancel: function() { var r = e.coming; if (!r || false === e.trigger("onCancel")) { return }
            e.hideLoading(); if (e.ajaxLoad) { e.ajaxLoad.abort() }
            e.ajaxLoad = null; if (e.imgPreload) { e.imgPreload.onload = e.imgPreload.onerror = null } if (r.wrap) { r.wrap.stop(true, true).trigger("onReset").remove() }
            e.coming = null; if (!e.current) { e._afterZoomOut(r) } }, close: function(r) { e.cancel(); if (false === e.trigger("beforeClose")) { return }
            e.unbindEvents(); if (!e.isActive) { return } if (!e.isOpen || r === true) { a(".fancybox-wrap").stop(true).trigger("onReset").remove();
                e._afterZoomOut() } else { e.isOpen = e.isOpened = false;
                e.isClosing = true;
                a(".fancybox-item, .fancybox-nav").remove();
                e.wrap.stop(true, true).removeClass("fancybox-opened");
                e.transitions[e.current.closeMethod]() } }, play: function(r) { var s = function() { clearTimeout(e.player.timer) },
                t = function() { s(); if (e.current && e.player.isActive) { e.player.timer = setTimeout(e.next, e.current.playSpeed) } },
                v = function() { s();
                    b.unbind(".player");
                    e.player.isActive = false;
                    e.trigger("onPlayEnd") },
                u = function() { if (e.current && (e.current.loop || e.current.index < e.group.length - 1)) { e.player.isActive = true;
                        b.bind({ "onCancel.player beforeClose.player": v, "onUpdate.player": t, "beforeLoad.player": s });
                        t();
                        e.trigger("onPlayStart") } }; if (r === true || (!e.player.isActive && r !== false)) { u() } else { v() } }, next: function(s) { var r = e.current; if (r) { if (!m(s)) { s = r.direction.next }
                e.jumpto(r.index + 1, s, "next") } }, prev: function(s) { var r = e.current; if (r) { if (!m(s)) { s = r.direction.prev }
                e.jumpto(r.index - 1, s, "prev") } }, jumpto: function(t, s, u) { var r = e.current; if (!r) { return }
            t = f(t);
            e.direction = s || r.direction[(t >= r.index ? "next" : "prev")];
            e.router = u || "jumpto"; if (r.loop) { if (t < 0) { t = r.group.length + (t % r.group.length) }
                t = t % r.group.length } if (r.group[t] !== o) { e.cancel();
                e._start(t) } }, reposition: function(s, t) { var r = e.current,
                v = r ? r.wrap : null,
                u; if (v) { u = e._getPosition(t); if (s && s.type === "scroll") { delete u.position;
                    v.stop(true, true).animate(u, 200) } else { v.css(u);
                    r.pos = a.extend({}, r.dim, u) } } }, update: function(s) { var t = (s && s.type),
                r = !t || t === "orientationchange"; if (r) { clearTimeout(c);
                c = null } if (!e.isOpen || c) { return }
            c = setTimeout(function() { var u = e.current; if (!u || e.isClosing) { return }
                e.wrap.removeClass("fancybox-tmp"); if (r || t === "load" || (t === "resize" && u.autoResize)) { e._setDimension() } if (!(t === "scroll" && u.canShrink)) { e.reposition(s) }
                e.trigger("onUpdate");
                c = null }, (r && !n ? 0 : 300)) }, toggle: function(r) { if (e.isOpen) { e.current.fitToView = a.type(r) === "boolean" ? r : !e.current.fitToView; if (n) { e.wrap.removeAttr("style").addClass("fancybox-tmp");
                    e.trigger("onUpdate") }
                e.update() } }, hideLoading: function() { b.unbind(".loading");
            a("#fancybox-loading").remove() }, showLoading: function() { var r, s;
            e.hideLoading();
            r = a('<div id="fancybox-loading"><div></div></div>').click(e.cancel).appendTo("body");
            b.bind("keydown.loading", function(t) { if ((t.which || t.keyCode) === 27) { t.preventDefault();
                    e.cancel() } }); if (!e.defaults.fixed) { s = e.getViewport();
                r.css({ position: "absolute", top: (s.h * 0.5) + s.y, left: (s.w * 0.5) + s.x }) } }, getViewport: function() { var r = (e.current && e.current.locked) || false,
                s = { x: p.scrollLeft(), y: p.scrollTop() }; if (r) { s.w = r[0].clientWidth;
                s.h = r[0].clientHeight } else { s.w = n && q.innerWidth ? q.innerWidth : p.width();
                s.h = n && q.innerHeight ? q.innerHeight : p.height() } return s }, unbindEvents: function() { if (e.wrap && k(e.wrap)) { e.wrap.unbind(".fb") }
            b.unbind(".fb");
            p.unbind(".fb") }, bindEvents: function() { var r = e.current,
                s; if (!r) { return }
            p.bind("orientationchange.fb" + (n ? "" : " resize.fb") + (r.autoCenter && !r.locked ? " scroll.fb" : ""), e.update);
            s = r.keys; if (s) { b.bind("keydown.fb", function(u) { var t = u.which || u.keyCode,
                        v = u.target || u.srcElement; if (t === 27 && e.coming) { return false } if (!u.ctrlKey && !u.altKey && !u.shiftKey && !u.metaKey && !(v && (v.type || a(v).is("[contenteditable]")))) { a.each(s, function(w, x) { if (r.group.length > 1 && x[t] !== o) { e[w](x[t]);
                                u.preventDefault(); return false } if (a.inArray(t, x) > -1) { e[w]();
                                u.preventDefault(); return false } }) } }) } if (a.fn.mousewheel && r.mouseWheel) { e.wrap.bind("mousewheel.fb", function(x, u, v, w) { var z = x.target || null,
                        y = a(z),
                        t = false; while (y.length) { if (t || y.is(".fancybox-skin") || y.is(".fancybox-wrap")) { break }
                        t = l(y[0]);
                        y = a(y).parent() } if (u !== 0 && !t) { if (e.group.length > 1 && !r.canShrink) { if (w > 0 || v > 0) { e.prev(w > 0 ? "down" : "left") } else { if (w < 0 || v < 0) { e.next(w < 0 ? "up" : "right") } }
                            x.preventDefault() } } }) } }, trigger: function(r, s) { var u, t = s || e.coming || e.current; if (!t) { return } if (a.isFunction(t[r])) { u = t[r].apply(t, Array.prototype.slice.call(arguments, 1)) } if (u === false) { return false } if (t.helpers) { a.each(t.helpers, function(v, w) { if (w && e.helpers[v] && a.isFunction(e.helpers[v][r])) { e.helpers[v][r](a.extend(true, {}, e.helpers[v].defaults, w), t) } }) }
            b.trigger(r) }, isImage: function(r) { return m(r) && r.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i) }, isSWF: function(r) { return m(r) && r.match(/\.(swf)((\?|#).*)?$/i) }, _start: function(t) { var r = {},
                v, s, x, u, w;
            t = f(t);
            v = e.group[t] || null; if (!v) { return false }
            r = a.extend(true, {}, e.opts, v);
            u = r.margin;
            w = r.padding; if (a.type(u) === "number") { r.margin = [u, u, u, u] } if (a.type(w) === "number") { r.padding = [w, w, w, w] } if (r.modal) { a.extend(true, r, { closeBtn: false, closeClick: false, nextClick: false, arrows: false, mouseWheel: false, keys: null, helpers: { overlay: { closeClick: false } } }) } if (r.autoSize) { r.autoWidth = r.autoHeight = true } if (r.width === "auto") { r.autoWidth = true } if (r.height === "auto") { r.autoHeight = true }
            r.group = e.group;
            r.index = t;
            e.coming = r; if (false === e.trigger("beforeLoad")) { e.coming = null; return }
            x = r.type;
            s = r.href; if (!x) { e.coming = null; if (e.current && e.router && e.router !== "jumpto") { e.current.index = t; return e[e.router](e.direction) } return false }
            e.isActive = true; if (x === "image" || x === "swf") { r.autoHeight = r.autoWidth = false;
                r.scrolling = "visible" } if (x === "image") { r.aspectRatio = true } if (x === "iframe" && n) { r.scrolling = "scroll" }
            r.wrap = a(r.tpl.wrap).addClass("fancybox-" + (n ? "mobile" : "desktop") + " fancybox-type-" + x + " fancybox-tmp " + r.wrapCSS).appendTo(r.parent || "body");
            a.extend(r, { skin: a(".fancybox-skin", r.wrap), outer: a(".fancybox-outer", r.wrap), inner: a(".fancybox-inner", r.wrap) });
            a.each(["Top", "Right", "Bottom", "Left"], function(y, z) { r.skin.css("padding" + z, g(r.padding[y])) });
            e.trigger("onReady"); if (x === "inline" || x === "html") { if (!r.content || !r.content.length) { return e._error("content") } } else { if (!s) { return e._error("href") } } if (x === "image") { e._loadImage() } else { if (x === "ajax") { e._loadAjax() } else { if (x === "iframe") { e._loadIframe() } else { e._afterLoad() } } } }, _error: function(r) { a.extend(e.coming, { type: "html", autoWidth: true, autoHeight: true, minWidth: 0, minHeight: 0, scrolling: "no", hasError: r, content: e.coming.tpl.error });
            e._afterLoad() }, _loadImage: function() { var r = e.imgPreload = new Image();
            r.onload = function() { this.onload = this.onerror = null;
                e.coming.width = this.width / e.opts.pixelRatio;
                e.coming.height = this.height / e.opts.pixelRatio;
                e._afterLoad() };
            r.onerror = function() { this.onload = this.onerror = null;
                e._error("image") };
            r.src = e.coming.href; if (r.complete !== true) { e.showLoading() } }, _loadAjax: function() { var r = e.coming;
            e.showLoading();
            e.ajaxLoad = a.ajax(a.extend({}, r.ajax, { url: r.href, error: function(s, t) { if (e.coming && t !== "abort") { e._error("ajax", s) } else { e.hideLoading() } }, success: function(s, t) { if (t === "success") { r.content = s;
                        e._afterLoad() } } })) }, _loadIframe: function() { var r = e.coming,
                s = a(r.tpl.iframe.replace(/\{rnd\}/g, new Date().getTime())).attr("scrolling", n ? "auto" : r.iframe.scrolling).attr("src", r.href);
            a(r.wrap).bind("onReset", function() { try { a(this).find("iframe").hide().attr("src", "//about:blank").end().empty() } catch (t) {} }); if (r.iframe.preload) { e.showLoading();
                s.one("load", function() { a(this).data("ready", 1); if (!n) { a(this).bind("load.fb", e.update) }
                    a(this).parents(".fancybox-wrap").width("100%").removeClass("fancybox-tmp").show();
                    e._afterLoad() }) }
            r.content = s.appendTo(r.inner); if (!r.iframe.preload) { e._afterLoad() } }, _preloadImages: function() { var t = e.group,
                s = e.current,
                w = t.length,
                r = s.preload ? Math.min(s.preload, w - 1) : 0,
                v, u; for (u = 1; u <= r; u += 1) { v = t[(s.index + u) % w]; if (v.type === "image" && v.href) { new Image().src = v.href } } }, _afterLoad: function() { var r = e.coming,
                x = e.current,
                w = "fancybox-placeholder",
                t, s, z, y, v, u;
            e.hideLoading(); if (!r || e.isActive === false) { return } if (false === e.trigger("afterLoad", r, x)) { r.wrap.stop(true).trigger("onReset").remove();
                e.coming = null; return } if (x) { e.trigger("beforeChange", x);
                x.wrap.stop(true).removeClass("fancybox-opened").find(".fancybox-item, .fancybox-nav").remove() }
            e.unbindEvents();
            t = r;
            s = r.content;
            z = r.type;
            y = r.scrolling;
            a.extend(e, { wrap: t.wrap, skin: t.skin, outer: t.outer, inner: t.inner, current: t, previous: x });
            v = t.href; switch (z) {
                case "inline":
                case "ajax":
                case "html":
                    if (t.selector) { s = a("<div>").html(s).find(t.selector) } else { if (k(s)) { if (!s.data(w)) { s.data(w, a('<div class="' + w + '"></div>').insertAfter(s).hide()) }
                            s = s.show().detach();
                            t.wrap.bind("onReset", function() { if (a(this).find(s).length) { s.hide().replaceAll(s.data(w)).data(w, false) } }) } } break;
                case "image":
                    s = t.tpl.image.replace("{href}", v); break;
                case "swf":
                    s = '<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + v + '"></param>';
                    u = "";
                    a.each(t.swf, function(A, B) { s += '<param name="' + A + '" value="' + B + '"></param>';
                        u += " " + A + '="' + B + '"' });
                    s += '<embed src="' + v + '" type="application/x-shockwave-flash" width="100%" height="100%"' + u + "></embed></object>"; break } if (!(k(s) && s.parent().is(t.inner))) { t.inner.append(s) }
            e.trigger("beforeShow");
            t.inner.css("overflow", y === "yes" ? "scroll" : (y === "no" ? "hidden" : y));
            e._setDimension();
            e.reposition();
            e.isOpen = false;
            e.coming = null;
            e.bindEvents(); if (!e.isOpened) { a(".fancybox-wrap").not(t.wrap).stop(true).trigger("onReset").remove() } else { if (x.prevMethod) { e.transitions[x.prevMethod]() } }
            e.transitions[e.isOpened ? t.nextMethod : t.openMethod]();
            e._preloadImages() }, _setDimension: function() { var T = e.getViewport(),
                S = 0,
                t = false,
                s = false,
                Y = e.wrap,
                R = e.skin,
                C = e.inner,
                u = e.current,
                U = u.width,
                w = u.height,
                J = u.minWidth,
                I = u.minHeight,
                G = u.maxWidth,
                E = u.maxHeight,
                P = u.scrolling,
                Q = u.scrollOutside ? u.scrollbarWidth : 0,
                D = u.margin,
                W = f(D[1] + D[3]),
                y = f(D[0] + D[2]),
                X, z, Z, A, N, K, M, L, O, V, x, H, F, B, r;
            Y.add(R).add(C).width("auto").height("auto").removeClass("fancybox-tmp");
            X = f(R.outerWidth(true) - R.width());
            z = f(R.outerHeight(true) - R.height());
            Z = W + X;
            A = y + z;
            N = j(U) ? (T.w - Z) * f(U) / 100 : U;
            K = j(w) ? (T.h - A) * f(w) / 100 : w; if (u.type === "iframe") { B = u.content; if (u.autoHeight && B.data("ready") === 1) { try { if (B[0].contentWindow.document.location) { C.width(N).height(9999);
                            r = B.contents().find("body"); if (Q) { r.css("overflow-x", "hidden") }
                            K = r.outerHeight(true) } } catch (v) {} } } else { if (u.autoWidth || u.autoHeight) { C.addClass("fancybox-tmp"); if (!u.autoWidth) { C.width(N) } if (!u.autoHeight) { C.height(K) } if (u.autoWidth) { N = C.width() } if (u.autoHeight) { K = C.height() }
                    C.removeClass("fancybox-tmp") } }
            U = f(N);
            w = f(K);
            O = N / K;
            J = f(j(J) ? f(J, "w") - Z : J);
            G = f(j(G) ? f(G, "w") - Z : G);
            I = f(j(I) ? f(I, "h") - A : I);
            E = f(j(E) ? f(E, "h") - A : E);
            M = G;
            L = E; if (u.fitToView) { G = Math.min(T.w - Z, G);
                E = Math.min(T.h - A, E) }
            H = T.w - W;
            F = T.h - y; if (u.aspectRatio) { if (U > G) { U = G;
                    w = f(U / O) } if (w > E) { w = E;
                    U = f(w * O) } if (U < J) { U = J;
                    w = f(U / O) } if (w < I) { w = I;
                    U = f(w * O) } } else { U = Math.max(J, Math.min(U, G)); if (u.autoHeight && u.type !== "iframe") { C.width(U);
                    w = C.height() }
                w = Math.max(I, Math.min(w, E)) } if (u.fitToView) { C.width(U).height(w);
                Y.width(U + X);
                V = Y.width();
                x = Y.height(); if (u.aspectRatio) { while ((V > H || x > F) && U > J && w > I) { if (S++ > 19) { break }
                        w = Math.max(I, Math.min(E, w - 10));
                        U = f(w * O); if (U < J) { U = J;
                            w = f(U / O) } if (U > G) { U = G;
                            w = f(U / O) }
                        C.width(U).height(w);
                        Y.width(U + X);
                        V = Y.width();
                        x = Y.height() } } else { U = Math.max(J, Math.min(U, U - (V - H)));
                    w = Math.max(I, Math.min(w, w - (x - F))) } } if (Q && P === "auto" && w < K && (U + X + Q) < H) { U += Q }
            C.width(U).height(w);
            Y.width(U + X);
            V = Y.width();
            x = Y.height();
            t = (V > H || x > F) && U > J && w > I;
            s = u.aspectRatio ? (U < M && w < L && U < N && w < K) : ((U < M || w < L) && (U < N || w < K));
            a.extend(u, { dim: { width: g(V), height: g(x) }, origWidth: N, origHeight: K, canShrink: t, canExpand: s, wPadding: X, hPadding: z, wrapSpace: x - R.outerHeight(true), skinSpace: R.height() - w }); if (!B && u.autoHeight && w > I && w < E && !s) { C.height("auto") } }, _getPosition: function(u) { var r = e.current,
                w = e.getViewport(),
                t = r.margin,
                x = e.wrap.width() + t[1] + t[3],
                s = e.wrap.height() + t[0] + t[2],
                v = { position: "absolute", top: t[0], left: t[3] }; if (r.autoCenter && r.fixed && !u && s <= w.h && x <= w.w) { v.position = "fixed" } else { if (!r.locked) { v.top += w.y;
                    v.left += w.x } }
            v.top = g(Math.max(v.top, v.top + ((w.h - s) * r.topRatio)));
            v.left = g(Math.max(v.left, v.left + ((w.w - x) * r.leftRatio))); return v }, _afterZoomIn: function() { var r = e.current; if (!r) { return }
            e.isOpen = e.isOpened = true;
            e.wrap.css("overflow", "visible").addClass("fancybox-opened");
            e.update(); if (r.closeClick || (r.nextClick && e.group.length > 1)) { e.inner.css("cursor", "pointer").bind("click.fb", function(s) { if (!a(s.target).is("a") && !a(s.target).parent().is("a")) { s.preventDefault();
                        e[r.closeClick ? "close" : "next"]() } }) } if (r.closeBtn) { a(r.tpl.closeBtn).appendTo(e.skin).bind("click.fb", function(s) { s.preventDefault();
                    e.close() }) } if (r.arrows && e.group.length > 1) { if (r.loop || r.index > 0) { a(r.tpl.prev).appendTo(e.outer).bind("click.fb", e.prev) } if (r.loop || r.index < e.group.length - 1) { a(r.tpl.next).appendTo(e.outer).bind("click.fb", e.next) } }
            e.trigger("afterShow"); if (!r.loop && r.index === r.group.length - 1) { e.play(false) } else { if (e.opts.autoPlay && !e.player.isActive) { e.opts.autoPlay = false;
                    e.play() } } }, _afterZoomOut: function(r) { r = r || e.current;
            a(".fancybox-wrap").trigger("onReset").remove();
            a.extend(e, { group: {}, opts: {}, router: false, current: null, isActive: false, isOpened: false, isOpen: false, isClosing: false, wrap: null, skin: null, outer: null, inner: null });
            e.trigger("afterClose", r) } });
    e.transitions = { getOrigPosition: function() { var r = e.current,
                s = r.element,
                v = r.orig,
                w = {},
                y = 50,
                t = 50,
                u = r.hPadding,
                z = r.wPadding,
                x = e.getViewport(); if (!v && r.isDom && s.is(":visible")) { v = s.find("img:first"); if (!v.length) { v = s } } if (k(v)) { w = v.offset(); if (v.is("img")) { y = v.outerWidth();
                    t = v.outerHeight() } } else { w.top = x.y + (x.h - t) * r.topRatio;
                w.left = x.x + (x.w - y) * r.leftRatio } if (e.wrap.css("position") === "fixed" || r.locked) { w.top -= x.y;
                w.left -= x.x }
            w = { top: g(w.top - u * r.topRatio), left: g(w.left - z * r.leftRatio), width: g(y + z), height: g(t + u) }; return w }, step: function(t, s) { var w, u, y, v = s.prop,
                r = e.current,
                z = r.wrapSpace,
                x = r.skinSpace; if (v === "width" || v === "height") { w = s.end === s.start ? 1 : (t - s.start) / (s.end - s.start); if (e.isClosing) { w = 1 - w }
                u = v === "width" ? r.wPadding : r.hPadding;
                y = t - u;
                e.skin[v](f(v === "width" ? y : y - (z * w)));
                e.inner[v](f(v === "width" ? y : y - (z * w) - (x * w))) } }, zoomIn: function() { var r = e.current,
                v = r.pos,
                s = r.openEffect,
                t = s === "elastic",
                u = a.extend({ opacity: 1 }, v);
            delete u.position; if (t) { v = this.getOrigPosition(); if (r.openOpacity) { v.opacity = 0.1 } } else { if (s === "fade") { v.opacity = 0.1 } }
            e.wrap.css(v).animate(u, { duration: s === "none" ? 0 : r.openSpeed, easing: r.openEasing, step: t ? this.step : null, complete: e._afterZoomIn }) }, zoomOut: function() { var r = e.current,
                s = r.closeEffect,
                t = s === "elastic",
                u = { opacity: 0.1 }; if (t) { u = this.getOrigPosition(); if (r.closeOpacity) { u.opacity = 0.1 } }
            e.wrap.animate(u, { duration: s === "none" ? 0 : r.closeSpeed, easing: r.closeEasing, step: t ? this.step : null, complete: e._afterZoomOut }) }, changeIn: function() { var r = e.current,
                u = r.nextEffect,
                x = r.pos,
                v = { opacity: 1 },
                s = e.direction,
                t = 200,
                w;
            x.opacity = 0.1; if (u === "elastic") { w = s === "down" || s === "up" ? "top" : "left"; if (s === "down" || s === "right") { x[w] = g(f(x[w]) - t);
                    v[w] = "+=" + t + "px" } else { x[w] = g(f(x[w]) + t);
                    v[w] = "-=" + t + "px" } } if (u === "none") { e._afterZoomIn() } else { e.wrap.css(x).animate(v, { duration: r.nextSpeed, easing: r.nextEasing, complete: e._afterZoomIn }) } }, changeOut: function() { var v = e.previous,
                t = v.prevEffect,
                u = { opacity: 0.1 },
                r = e.direction,
                s = 200; if (t === "elastic") { u[r === "down" || r === "up" ? "top" : "left"] = (r === "up" || r === "left" ? "-" : "+") + "=" + s + "px" }
            v.wrap.animate(u, { duration: t === "none" ? 0 : v.prevSpeed, easing: v.prevEasing, complete: function() { a(this).trigger("onReset").remove() } }) } };
    e.helpers.overlay = { defaults: { closeClick: true, speedOut: 200, showEarly: true, css: {}, locked: !n, fixed: true }, overlay: null, fixed: false, el: a("html"), create: function(r) { r = a.extend({}, this.defaults, r); if (this.overlay) { this.close() }
            this.overlay = a('<div class="fancybox-overlay"></div>').appendTo(e.coming ? e.coming.parent : r.parent);
            this.fixed = false; if (r.fixed && e.defaults.fixed) { this.overlay.addClass("fancybox-overlay-fixed");
                this.fixed = true } }, open: function(r) { var s = this;
            r = a.extend({}, this.defaults, r); if (this.overlay) { this.overlay.unbind(".overlay").width("auto").height("auto") } else { this.create(r) } if (!this.fixed) { p.bind("resize.overlay", a.proxy(this.update, this));
                this.update() } if (r.closeClick) { this.overlay.bind("click.overlay", function(t) { if (a(t.target).hasClass("fancybox-overlay")) { if (e.isActive) { e.close() } else { s.close() } return false } }) }
            this.overlay.css(r.css).show() }, close: function() { var s, r;
            p.unbind("resize.overlay"); if (this.el.hasClass("fancybox-lock")) { a(".fancybox-margin").removeClass("fancybox-margin");
                s = p.scrollTop();
                r = p.scrollLeft();
                this.el.removeClass("fancybox-lock");
                p.scrollTop(s).scrollLeft(r) }
            a(".fancybox-overlay").remove().hide();
            a.extend(this, { overlay: null, fixed: false }) }, update: function() { var s = "100%",
                r;
            this.overlay.width(s).height("100%"); if (i) { r = Math.max(d.documentElement.offsetWidth, d.body.offsetWidth); if (b.width() > r) { s = b.width() } } else { if (b.width() > p.width()) { s = b.width() } }
            this.overlay.width(s).height(b.height()) }, onReady: function(s, r) { var t = this.overlay;
            a(".fancybox-overlay").stop(true, true); if (!t) { this.create(s) } if (s.locked && this.fixed && r.fixed) { if (!t) { this.margin = b.height() > p.height() ? a("html").css("margin-right").replace("px", "") : false }
                r.locked = this.overlay.append(r.wrap);
                r.fixed = false } if (s.showEarly === true) { this.beforeShow.apply(this, arguments) } }, beforeShow: function(s, r) { var u, t; if (r.locked) { if (this.margin !== false) { a("*").filter(function() { return (a(this).css("position") === "fixed" && !a(this).hasClass("fancybox-overlay") && !a(this).hasClass("fancybox-wrap")) }).addClass("fancybox-margin");
                    this.el.addClass("fancybox-margin") }
                u = p.scrollTop();
                t = p.scrollLeft();
                this.el.addClass("fancybox-lock");
                p.scrollTop(u).scrollLeft(t) }
            this.open(s) }, onUpdate: function() { if (!this.fixed) { this.update() } }, afterClose: function(r) { if (this.overlay && !e.coming) { this.overlay.fadeOut(r.speedOut, a.proxy(this.close, this)) } } };
    e.helpers.title = { defaults: { type: "float", position: "bottom" }, beforeShow: function(s) { var r = e.current,
                u = r.title,
                w = s.type,
                v, t; if (a.isFunction(u)) { u = u.call(r.element, r) } if (!m(u) || a.trim(u) === "") { return }
            v = a('<div class="fancybox-title fancybox-title-' + w + '-wrap">' + u + "</div>"); switch (w) {
                case "inside":
                    t = e.skin; break;
                case "outside":
                    t = e.wrap; break;
                case "over":
                    t = e.inner; break;
                default:
                    t = e.skin;
                    v.appendTo("body"); if (i) { v.width(v.width()) }
                    v.wrapInner('<span class="child"></span>');
                    e.current.margin[2] += Math.abs(f(v.css("margin-bottom"))); break }
            v[(s.position === "top" ? "prependTo" : "appendTo")](t) } };
    a.fn.fancybox = function(s) { var r, v = a(this),
            u = this.selector || "",
            t = function(w) { var A = a(this).blur(),
                    x = r,
                    y, z; if (!(w.ctrlKey || w.altKey || w.shiftKey || w.metaKey) && !A.is(".fancybox-wrap")) { y = s.groupAttr || "data-fancybox-group";
                    z = A.attr(y); if (!z) { y = "rel";
                        z = A.get(0)[y] } if (z && z !== "" && z !== "nofollow") { A = u.length ? a(u) : v;
                        A = A.filter("[" + y + '="' + z + '"]');
                        x = A.index(this) }
                    s.index = x; if (e.open(A, s) !== false) { w.preventDefault() } } };
        s = s || {};
        r = s.index || 0; if (!u || s.live === false) { v.unbind("click.fb-start").bind("click.fb-start", t) } else { b.undelegate(u, "click.fb-start").delegate(u + ":not('.fancybox-item, .fancybox-nav')", "click.fb-start", t) }
        this.filter("[data-fancybox-start=1]").trigger("click"); return this };
    b.ready(function() { var r, s; if (a.scrollbarWidth === o) { a.scrollbarWidth = function() { var u = a('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo("body"),
                    t = u.children(),
                    v = t.innerWidth() - t.height(99).innerWidth();
                u.remove(); return v } } if (a.support.fixedPosition === o) { a.support.fixedPosition = (function() { var t = a('<div style="position:fixed;top:20px;"></div>').appendTo("body"),
                    u = (t[0].offsetTop === 20 || t[0].offsetTop === 15);
                t.remove(); return u }()) }
        a.extend(e.defaults, { scrollbarWidth: a.scrollbarWidth(), fixed: a.support.fixedPosition, parent: a("body") });
        r = a(q).width();
        h.addClass("fancybox-lock-test");
        s = a(q).width();
        h.removeClass("fancybox-lock-test");
        a("<style type='text/css'>.fancybox-margin{margin-right:" + (s - r) + "px;}</style>").appendTo("head") }) }(window, document, jQuery));