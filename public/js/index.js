document.documentElement.setAttribute(
    'style',
    'font-size:' + window.innerWidth / 3.75 / 2 + 'px'
);

var vm = new Vue({
    el: '#app',
    data: function() {
        return {
            id: '',
            api: {
                getActivityInfoById: '//www.seedblog.cn/api/jd_activty_list',
                getCouponById: '//m.zudeapp.com/weixinapi/activity/getCouponById.cgi',
                getCouponBagById: '//m.zudeapp.com/weixinapi/activity/couponReceiveByIdForNewUser.cgi',
                getActivityByLink: '//www.seedblog.cn/api/jd_link_url',
            },
            apiMinTimeout: 500,
            uid: '',
            itemId: '',
            showModalToast: false,
            toastContent: '',
            curPage: 1,
            pageSize: 10,
            isMaxPage: false,
            total: 0,
            productList: [],
            tabIndex: 1,
            isTabFixed: false,
            $tabbar: null,
            $tabContainer: null,
            lazyLoadIndex: 0
        };
    },
    created: function() {
        this.uid = this.keyFromUrl('uid');
        this.type = this.keyFromUrl('type');
        this.channel = this.keyFromUrl('channel');
        this.getList();

    },
    mounted: function() {
        window.addEventListener('scroll', this.throttle(this.onScroll, 100));
        window.addEventListener('scroll', this.throttle(this.lazyLoad, 100));
        // window.addEventListener('scroll', this.throttle(this.onPage, 100));
        window.addEventListener('scroll', this.onPage);
        window.addEventListener('resize', this.onResize);
    },

    methods: {
        onPage() {
            const scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
            const bodyHeight = document.body.offsetHeight;
            const clientHeight = window.innerHeight;
            if (scrollTop + clientHeight < bodyHeight) {
                return;
            }
            if (this.isGetList) return;
            if (this.total < this.curPage * this.pageSize) {
                return;
            }

            this.curPage++;
            this.isGetList = true;
            this.getList(() => {
                this.isGetList = false;
            });
        },
        getList(cb) {

            this.getActivityInfoById(this.curPage, this.pageSize).then((data = {}) => {

                this.total = data.length;
                // if(data.rows.length < this.pageSize){
                //   this.isMaxPage = true;
                // }
                if ((this.curPage * this.pageSize) >= this.total && document.readyState == "complete") {
                    this.isMaxPage = true;
                }
                this.productList = this.productList.concat(data || []);

                cb && cb(data)
            })
        },
        keyFromUrl: function(key, url) {
            var reg = new RegExp('(^|&)' + key + '=([^&]*)(&|$)');
            // var r = decodeURIComponent((url || window.location.search).substr(1)).match(
            //   reg
            // );
            if (url) {
                url = url.replace(/\s/g, '');
            }
            var r = (url || window.location.search).substr(1).match(reg);
            if (r != null) return unescape(r[2]);
            return '';
        },


        getActivityInfoById: function(start, length) {
            return axios
                .get(this.api.getActivityInfoById, {
                    params: {
                        start: start,
                        length: length
                    }
                })
                .then(function(res) {
                    return res.data;
                });
        },

        getCouponById: function(couponId, couponType) {
            // couponId 券码or券包id
            // couponType 1 券码 2 券包
            couponType = couponType || '1';
            var that = this;
            var apiUrl =
                couponType === '1' ? this.api.getCouponById : this.api.getCouponBagById;
            axios
                .post(apiUrl, {
                    id: couponId,
                    type: couponType,
                    uid: this.uid
                })
                .then(function(res) {
                    if (res.data.err_code === -1) {
                        that.showToast('领取成功');
                    } else {
                        that.showToast(res.data.err_msg || '领取失败');
                    }
                })
                .catch(function(err) {
                    that.showToast('领取失败，请检查您的网络');
                });
        },

        routeToProductDetail: function(itemId) {
            var that = this;
            console.log(itemId);
            if (!itemId) {
                this.showToast('Item Id不能为空');
                return;
            }
            if (navigator.userAgent.indexOf('MicroMessenger') > -1) {
                wx.miniProgram.getEnv(function(res) {
                    if (res.miniprogram) {
                        wx.miniProgram.navigateTo({
                            url: '/pages/product/detail/detail?item_id=' + itemId
                        });
                    } else {
                        // console.log()
                        window.location.href =
                            'https://m.zudeapp.com/detail/' + itemId + '?type=' + that.type;
                    }
                });
            } else if (navigator.userAgent.indexOf('AlipayClient') > -1) {
                my.getEnv(function(res) {
                    if (res.miniprogram) {
                        my.navigateTo({
                            url: '/pages/product/detail/detail?item_id=' + itemId
                        });
                    } else {
                        window.location.href =
                            'https://m.zudeapp.com/detail/' + itemId + '?type=' + that.type;
                    }
                });
            } else {
                window.location.href =
                    'https://m.zudeapp.com/detail/' + itemId + '?type=' + that.type;
            }
        },

        routeToMerchantDetail: function(shopId) {
            var that = this;
            if (!shopId) {
                this.showToast('Shop Id不能为空');
                return;
            }
            if (navigator.userAgent.indexOf('MicroMessenger') > -1) {
                wx.miniProgram.getEnv(function(res) {
                    if (res.miniprogram) {
                        wx.miniProgram.navigateTo({
                            url: '/pages/merchant/detail/detail?shop_id=' + shopId
                        });
                    } else {
                        window.location.href =
                            'https://m.zudeapp.com/shop/' + shopId + '?type=' + that.type;
                    }
                });
            } else if (navigator.userAgent.indexOf('AlipayClient') > -1) {
                my.getEnv(function(res) {
                    if (res.miniprogram) {
                        my.navigateTo({
                            url: '/pages/merchant/detail/detail?shop_id=' + shopId
                        });
                    } else {
                        window.location.href =
                            'https://m.zudeapp.com/shop/' + shopId + '?type=' + that.type;
                    }
                });
            } else {
                window.location.href =
                    'https://m.zudeapp.com/shop/' + shopId + '?type=' + that.type;
            }
        },

        routeToIndex: function() {
            var that = this;
            if (navigator.userAgent.indexOf('MicroMessenger') > -1) {
                wx.miniProgram.getEnv(function(res) {
                    if (res.miniprogram) {
                        wx.miniProgram.switchTab({
                            url: '/pages/index/index'
                        });
                    } else {
                        window.location.href = 'https://m.zudeapp.com?type=' + that.type;
                    }
                });
            } else if (navigator.userAgent.indexOf('AlipayClient') > -1) {
                my.getEnv(function(res) {
                    if (res.miniprogram) {
                        my.switchTab({
                            url: '/pages/index/index'
                        });
                    } else {
                        window.location.href = 'https://m.zudeapp.com?type=' + that.type;
                    }
                });
            } else {
                window.location.href = 'https://m.zudeapp.com?type=' + that.type;
            }
        },

        routeToActivity: function(options) {
            var that = this;
            if (!options) {
                this.showToast('Url 不能为空');
                return;
            }

            var url = this.keyFromUrl('url', options);
            var query = this.keyFromUrl('query', options);

            // 取不到则默认链接为https://格式
            if (!url) {
                url = options.split('?')[0] || '';
                query = options.split('?')[1] || '';
            }

            if (navigator.userAgent.indexOf('MicroMessenger') > -1) {
                this.getActivityLink(url).then((data = {}) => {
                        window.location.href = data.clickURL;
                    })
                    // wx.miniProgram.getEnv(function(res) {
                    //   console.log(res)
                    //   if (res.miniprogram) {
                    //     wx.miniProgram.navigateTo({
                    //       url:
                    //         '/pages/web_view/web_view?url=' +
                    //         url +
                    //         '&query=isUid%3D1' +
                    //         encodeURIComponent('&' + query.replace('?', ''))
                    //     });
                    //   } else if (that.uid) {
                    //     window.location.href =
                    //       url +
                    //       '?' +
                    //       (query
                    //         ? query + '&type=' + that.type + '&uid=' + that.uid
                    //         : 'type=' + that.type + '&uid=' + that.uid);
                    //   } else {
                    //     this.getActivityLink(url).then((data = {})=>{

                //       window.location.href = data.clickURL;

                //    })
                //     // window.location.href =
                //     //   url +
                //     //   '?' +
                //     //   (query ? query + '&type=' + that.type : 'type=' + that.type);
                //   }
                // });


            } else if (navigator.userAgent.indexOf('AlipayClient') > -1) {
                my.getEnv(function(res) {
                    if (res.miniprogram) {
                        my.navigateTo({
                            url: '/pages/web_view/web_view?url=' +
                                url +
                                '&query=isUid%3D1' +
                                encodeURIComponent('&' + query.replace('?', ''))
                        });
                    } else if (that.uid) {
                        window.location.href =
                            url +
                            '?' +
                            (query ?
                                query + '&type=' + that.type + '&uid=' + that.uid :
                                'type=' + that.type + '&uid=' + that.uid);
                    } else {
                        window.location.href =
                            url +
                            '?' +
                            (query ? query + '&type=' + that.type : 'type=' + that.type);
                    }
                });
            } else if (this.uid) {
                window.location.href =
                    url +
                    '?' +
                    (query ?
                        query + '&type=' + that.type + '&uid=' + that.uid :
                        'type=' + that.type + '&uid=' + that.uid);
            } else {

                this.getActivityLink(url).then((data = {}) => {

                        window.location.href = data.clickURL;

                    })
                    // window.location.href =
                    //   url +
                    //   '?' +
                    //   (query ? query + '&type=' + that.type : 'type=' + that.type);
            }
        },
        getActivityLink: function(url) {
            return axios
                .get(this.api.getActivityByLink, {
                    params: {
                        url: url
                    }
                })
                .then(function(res) {
                    console.log(res.data)
                    return res.data;
                });
        },
        handleCouponReceive: function(coupon) {
            if (!coupon || !coupon.couponId) {
                this.showToast('Coupon Id不能为空');
                return;
            }
            var that = this;
            if (this.uid && this.uid !== 'undefined' && this.uid !== 'null') {
                // 1 券码 act 2 券包 couponId
                if (coupon.act) {
                    // if (coupon.act !== null && coupon.act !== undefined && coupon.act !== '') {
                    this.getCouponById(coupon.act, '2');
                } else {
                    this.getCouponById(coupon.couponId, '1');
                }
            } else {
                if (navigator.userAgent.indexOf('MicroMessenger') > -1) {
                    wx.miniProgram.getEnv(function(res) {
                        if (res.miniprogram) {
                            that.showToast('uid不能为空');
                        } else {
                            window.location.href =
                                'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxc8a4294fa5373ad0&redirect_uri=' +
                                encodeURIComponent(
                                    'https://m.zudeapp.com/wxCallback#wechat_redirect?type=' +
                                    that.type +
                                    '&response_type=code&scope=snsapi_userinfo&state=qichuang&return_url=' +
                                    encodeURIComponent(
                                        'https://res.zudeapp.com/activity/common/index.html?params=' +
                                        that.id +
                                        ',' +
                                        that.channel
                                    )
                                );
                        }
                    });
                } else if (navigator.userAgent.indexOf('AlipayClient') > -1) {
                    my.getEnv(function(res) {
                        if (res.miniprogram) {
                            that.showToast('uid不能为空');
                        } else {
                            window.location.href =
                                'https://openauth.alipay.com/oauth2/publicAppAuthorize.htm?app_id=2018072260811060&scope=auth_user,auth_base&redirect_uri=' +
                                encodeURIComponent(
                                    'https://m.zudeapp.com/alipayCallback?type=' +
                                    that.type +
                                    '&return_url=' +
                                    encodeURIComponent(
                                        'https://res.zudeapp.com/activity/common/index.html?params=' +
                                        that.id +
                                        ',' +
                                        that.channel
                                    )
                                );
                        }
                    });
                } else {
                    window.location.href =
                        'https://m.zudeapp.com/loginnew?type=' +
                        that.type +
                        '&callbackUrl=' +
                        encodeURIComponent(
                            'https://res.zudeapp.com/activity/common/index.html?channel=' +
                            that.channel +
                            '&id=' +
                            that.id
                        );
                }
            }
        },

        toggleLoading: function(isShow) {
            var $loading = document.getElementById('loading');
            if (isShow) {
                $loading.classList.remove('disabled');
            } else {
                $loading.classList.add('disabled');
            }
        },

        showToast: function(toastContent, timeout) {
            var that = this;
            this.showModalToast = true;
            this.toastContent = toastContent || '';
            setTimeout(function() {
                that.showModalToast = false;
            }, timeout || 1500);
        },

        showErrorPage: function() {
            document.getElementById('error').classList.remove('disabled');
        },

        showEmptyPage: function() {
            document.getElementById('empty').classList.remove('disabled');
        },

        handleTabSwitch: function(index) {
            this.tabIndex = index;
            var $tabbar = this.$tabbar || document.getElementById('tabbar');
            this.$tabbar = $tabbar;
            document.body.scrollTop =
                document.getElementById('tab_' + index).offsetTop -
                $tabbar.getBoundingClientRect().height +
                15;
            document.documentElement.scrollTop =
                document.getElementById('tab_' + index).offsetTop -
                $tabbar.getBoundingClientRect().height +
                15;

            var $tabbar_fixed =
                this.$tabbar_fixed || document.getElementById('tabbar_fixed');
            this.$tabbar_fixed = $tabbar_fixed;
            var $tabItem = document.getElementsByClassName('tab-item')[index];
            var scrollLeftPrev = $tabbar.scrollLeft;
            var scrollLeft =
                scrollLeftPrev +
                ($tabItem &&
                    $tabItem.getBoundingClientRect().left +
                    $tabItem.getBoundingClientRect().width / 2 -
                    window.innerWidth / 2);
            $tabbar.scrollLeft = scrollLeft;
            $tabbar_fixed.scrollLeft = scrollLeft;
        },

        handleClick: function(data) {

            data = data || '';
            console.log(data);
            var type = data.split(',')[0];
            console.log(type);
            // return; 

            var query = data.split(',')[1];
            console.log(query);
            // return;
            if (type === 'ProductDetail') {
                this.routeToProductDetail(query);

            } else if (type === 'Index') {
                this.routeToIndex(query);
            } else if (type === 'Activity') {
                this.routeToActivity(query);
            } else if (type === 'MerchantDetail') {
                this.routeToMerchantDetail(query);
            }
        },

        throttle: function(func, timeout) {
            var last = 0;
            var that = this;
            return function() {
                var curr = new Date().getTime();
                if (curr - timeout > last) {
                    func.apply(that, arguments);
                    last = curr;
                }
            };
        },

        onScroll: function() {
            var scrollTop =
                document.body.scrollTop || document.documentElement.scrollTop;
            var $tabbar = this.$tabbar || document.getElementById('tabbar');
            this.$tabbar = $tabbar;
            if (
                $tabbar &&
                scrollTop >= $tabbar.offsetTop &&
                !$tabbar.classList.contains('fixed')
            ) {
                this.isTabFixed = true;
            } else {
                this.isTabFixed = false;
            }

            var $tabContainer =
                this.$tabContainer || document.getElementsByClassName('tab-container');
            this.$tabContainer = $tabContainer;
            if (!$tabContainer) return;
            for (var i = 0; i < $tabContainer.length; i++) {
                var rect = $tabContainer[i].getBoundingClientRect();
                if (
                    Math.floor(rect.top) <=
                    Math.floor($tabbar.getBoundingClientRect().height) &&
                    Math.floor(rect.bottom) >
                    Math.floor($tabbar.getBoundingClientRect().height) &&
                    i !== this.tabIndex
                ) {
                    this.tabIndex = i;
                    var $tabbar = this.$tabbar || document.getElementById('tabbar');
                    this.$tabbar = $tabbar;
                    var $tabbar_fixed =
                        this.$tabbar_fixed || document.getElementById('tabbar_fixed');
                    this.$tabbar_fixed = $tabbar_fixed;
                    var $tabItem = document.getElementsByClassName('tab-item')[i];
                    var scrollLeftPrev = $tabbar.scrollLeft;
                    var scrollLeft =
                        scrollLeftPrev +
                        ($tabItem &&
                            $tabItem.getBoundingClientRect().left +
                            $tabItem.getBoundingClientRect().width / 2 -
                            window.innerWidth / 2);
                    $tabbar.scrollLeft = scrollLeft;
                    $tabbar_fixed.scrollLeft = scrollLeft;
                }
            }
        },

        onResize: function() {
            document.documentElement.setAttribute(
                'style',
                'font-size:' + window.innerWidth / 3.75 / 2 + 'px'
            );
        },

        lazyLoad: function() {
            var seeHeight = document.documentElement.clientHeight; // 可见区域高度
            var imgs = document.getElementsByTagName('img');
            for (var i = this.lazyLoadIndex; i < imgs.length; i++) {
                if (
                    imgs[i].getBoundingClientRect().top < seeHeight &&
                    imgs[i].dataset.src &&
                    imgs[i].getAttribute('src') !== imgs[i].dataset.src
                ) {
                    imgs[i].setAttribute('src', imgs[i].dataset.src);
                    this.lazyLoadIndex++;
                }
            }
        },

        scrollWithAnimate: function(scrollDistance, target) {
            target = target || document.body;
            var scrollTop_ori =
                document.documentElement.scrollTop + document.body.scrollTop;
            var scrollTop_end = scrollTop_ori + scrollDistance;
            var dScrollHeight = document.body.scrollHeight;
            if (scrollTop_end > dScrollHeight) {
                scrollTop_end = dScrollHeight;
            }
            var scrollTop_now = -1;
            var run = function() {
                setTimeout(function() {
                    var dScrollTop =
                        document.documentElement.scrollTop + document.body.scrollTop;
                    scrollTop_now = dScrollTop;
                    console.log(dScrollTop, scrollTop_end);
                    if (dScrollTop <= scrollTop_end) {
                        document.documentElement.scrollTop = dScrollTop + 10;
                        document.body.scrollTop = dScrollTop + 10;
                        dScrollTop =
                            document.documentElement.scrollTop + document.body.scrollTop;
                        if (scrollTop_now !== dScrollTop) {
                            run();
                        }
                    }
                }, 1000 / 60);
            };
            run();
        }
    }
});