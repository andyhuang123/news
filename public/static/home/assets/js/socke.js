(function() {
    try {
        var siteol = $("#online_number")//获取填写全站在线数的元素
        //pageol = $("#online_number #page_ol");//获取填写本页在线数的元素
    } catch(e) {}
    var sitesocket = {
        newconnection: newconnection,
        socket: null,
        pinginterval: null
    }
    function ssiteol(data) { 
        
        var siteol = $("#online_number")
        siteol.html(data.num)
         
    } 
    function _(type, data) {
        return JSON.stringify({
            type: type,
            data: data
        })
    }
    function newconnection(url, callback) {
        clearInterval(this.pinginterval);
        if (this.socket && this.socket.readyState !== 3) {
            return
        } else {
            delete this.socket
        }
        var inte;
        this.socket = new WebSocket("ws://www.seedblog.cn:2346");//修改成你自己的在线服务器地址
        var so = this.socket;
        this.socket.ping = function() {
            so.send(_("mod", 'aaa'))
        };
        this.socket.onopen = function(data) {
            so.send(_("url", url));
            inte = this.pinginterval = setInterval(so.ping, 30000)
        };
        this.socket.onmessage = function(data) { 
             var msg = JSON.parse(data.data); 
             callback(msg.data);
            
        };
        this.socket.onerror = function(data) {
            clearInterval(inte);
            delete so;
            setTimeout(newconnection, 3000, url);
            callback(0)
        };
        this.socket.onclose = function(data) {
            clearInterval(inte);
            delete so;
            setTimeout(newconnection, 3000, url);
            callback(0)
        }
    }
//初始化连接
    sitesocket.newconnection("site://www.seedblog.cn", ssiteol);//使用site://前缀标识统一的被请求地址(此网站)
    //pagesocket.newconnection(window.location.href, spageol)//使用本页的href作为被请求地址
})();