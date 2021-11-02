<?php
namespace App\Traits;
 
use Illuminate\Support\Facades\DB;

/**
 * 	开放平台辅助工具
 */
class DopenWechat
{
    public $t;//开放平台的数据对象

    public $Dhttp;//访问对象

    function __construct($t)
    {
        $this->t = $t;
        $this->Dhttp = new Dhttp('open_wechat_'.$this->t['id'].'.txt');

        $b = $this->Dhttp->Dhttp("https://open.weixin.qq.com");
        if (stripos($b->body,$this->t['user']['user_name'])==false) {
            $b = $this->Dhttp->Dhttp("https://open.weixin.qq.com/cgi-bin/login",['account'=>$this->t['user']['user_name'],'passwd'=>md5($this->t['user']['dpassword']),'lang'=>'zh_CN','f'=>'json','ajax'=>1,'key'=>'1'],'https://open.weixin.qq.com/');
            $back = json_decode($b->body,true);
            if ($back['nick_name']==$this->t['user']['user_name']) {
                $this->t['token'] = $back['base_resp']['token'];
                DB::table('deep_owechat')->where(['id'=>$this->t['id']])->update(["token"=>$this->t['token']]);
               
            }
        }else{
            $login_token = DB::table('deep_owechat')->where(['id'=>$this->t['id']])->first(); 
            //$login_token = M("owechat","deep_")->where(['id'=>$this->t['id']])->find(); 
            $this->t['token'] = $login_token->token;
        }
    }
    //通过APPID获取第三方URL的剩余修改次数
    public function GetSy($appid=""){
        $url = "https://open.weixin.qq.com/cgi-bin/component_acct?action=modify&t=manage/plugin_modify&appid=".$appid."&token=".$this->t['token'];
        $b = $this->Dhttp->Dhttp($url);
        preg_match("/(\d)次机会/",$b->body,$m);
        return $m[1];
    }
    //申请第三方
    public function sqdisanfang($d="")
    {
        // 获取下载文件的文件内容
        $fileurl = "https://open.weixin.qq.com/cgi-bin/component_acct?action=download_confirmfile&token=".$this->t['token']."&lang=zh_CN";
        $b = $this->Dhttp->Dhttp($fileurl);
        $h = $b->headers; 
        //匹配出名称
        preg_match("/=([^\.]*)/",$h['content-disposition'],$back);
        //保存文件到文件验证类
        //$file_t = \app\models\DeepFileauth::find()->where('filename=:filename',[':filename'=>$back[1].".txt"])->one();
        //$file_path = "/www/wwwroot/all.com/verify_file/";
        $file_path = public_path().'/verify_file/'; 
        file_put_contents($file_path.$back[1].".txt",$b->body);
        // echo "已经保存好验证文件";
        // 开始提交第三方平台资料
        //$nwxlist = D("WxOpenPlats")->add(['name'=>"---"]);
        $nwxlist = DB::table("WxOpenPlats")->insertGetId(['name'=>"---"]);
        $referer = "https://open.weixin.qq.com/cgi-bin/component_acct?t=manage/createBizPlugin&action=create&lang=zh_CN&token=".$this->t['token'];
        //$oname = sprintf($this->getCode(1,6)."平台%s",$this->t['id']);
        $oname = "D".$nwxlist;
        // $oname = "平台G";
        $b = $this->Dhttp->Dhttp("https://open.weixin.qq.com/cgi-bin/component_acct",['name'=>$oname,'token'=>$this->t['token'],'lang'=>'zh_CN','f'=>'json','ajax'=>'1','action'=>'check_name','key'=>'check_name'],$referer);
        // 应该是验证名称类的操作
        // var_dump($b->body);die;
        $back=($b->body);
        if (!(isset($back['base_resp']) && isset($back['base_resp']['err_msg']) && ($back['base_resp']['err_msg'])=="ok")) {
            // 文件验证不通过的时候是这样的，但是暂时不处理
            //echo Yii::$app->Dhelper->echoJSON(false,$b->body);return;
        }
        $official_site = $this->getCode(1,8).".com";
        $send_body = ['sns_domain'=>$this->t['domainlist'],'token'=>$this->t['token'],'lang'=>'zh_CN','f'=>'json','ajax'=>1,'action'=>'check_domain_by_scene','key'=>'check_domain_by_scene'];
        $b = $this->Dhttp->Dhttp("https://open.weixin.qq.com/cgi-bin/component_acct",$send_body,$referer);
        $backdata = json_decode($b->body,true);
        if(isset($backdata['base_resp']) && $backdata['base_resp']['err_msg']!="ok"){
            if($backdata['base_resp']['ret']=="1054"){
                echo "访问不到域名指向下的文件,如果确认已经生效可以多点击几次";die;
            }
        }
        //好像是绑定域名验证类的操作
        $d = []; 
        // string(71) "{"base_resp":{"ret":1054,"err_msg":"default","from":"","lang":"zh_CN"}}"
        $d['auth_token'] = $this->getCode(1,32);
        $d['auth_domain'] = config('url.MP_LOGIN_DOMAIN');
        $d['symmetric_key'] = $this->getCode(1,43);
        $d['share_domain'] = config('url.MP_LOGIN_DOMAIN');
        $d['encodingAesKey'] = $d['symmetric_key'];
        $d['name'] = $nwxlist;
        $d['desc'] = "D".$nwxlist;
        $d['gzh_name'] = $nwxlist;
        $d["white_ip"]=$this->t['iplist'];
        $d["sns_domain"]=$this->t['domainlist'];
        $d['token'] = $this->t['token'];
        $d["white_acct"] = $this->t["gzhlist"];
        //$d['appid'] = $oname."简介";
        //$nwxlist = D("WxOpenPlats")->add($d);
        $icon_url = "http://mmbiz.qpic.cn/mmbiz_png/VPtJAWJntQ99y1xdSoHWyBMjtG4YHjc3zpiaeGgdmqPf4zvaFkjicibz1iaOWPuTT2jU4L9wW4ia3SQ9NniaTY30Nk5Q/0?wx_fmt=png";
        $d['ticket_url'] = "http://".config('url.MP_LOGIN_DOMAIN')."/api.php?s=open/verify_ticket&id=".$nwxlist;
        $d['msg_url'] = "http://".config('url.MP_LOGIN_DOMAIN').'/opensdk/$APPID$';
        $d['official_site'] = $official_site;
        $d['icon_url'] = $icon_url;
        $send_body = ['name'=>$oname,"desc"=>$d['desc'],'official_site'=>$official_site,'icon_url'=>$icon_url,'auth_token'=>$this->t['token'],'auth_domain'=>$d['auth_domain'],'ticket_url'=>$d['ticket_url'],'msg_url'=>$d['msg_url'],'white_ip'=>$d['white_ip'],'white_acct'=>$d['white_acct'],'category_list'=>'4','symmetric_key'=>$d['symmetric_key'],'sns_domain'=>$d['sns_domain'],'tag_id_list'=>"1001",'token'=>$this->t['token'],'f'=>"json",'ajax'=>'1','action'=>'create','key'=>'create',"white_mp"=>$this->t['gzhlist']];
        //var_dump($send_body);die;
        $b = $this->Dhttp->Dhttp("https://open.weixin.qq.com/cgi-bin/component_acct",$send_body,$referer);
        $urlmap = explode(";",$d['sns_domain']);

        $idmap = [];
        $save_data = [];
        //var_dump($b->body);die;
        // string(94) "{"base_resp":{"ret":0,"err_msg":"ok","lang":""},"err_code":0,"err_msg":"ok","invalid_acct":[]}"
        $back = json_decode($b->body,true);
        //var_dump($back);die;
        if(isset($back['base_resp']) && $back['base_resp']['err_msg']=="ok" && $back['err_msg']=="ok"){
            // 申请成功后，处理保存事宜
            $b = $this->Dhttp->Dhttp("https://open.weixin.qq.com/cgi-bin/applist?t=manage/list&page=0&num=20&openapptype=2048&token=".$this->t['token']."&lang=zh_CN");
            preg_match("/applist([^;]*)/",$b->body,$c);
            //var_dump($c);die;
            preg_match_all("/\[\{([^\]]*)]/",$c[1],$cd);
            //var_dump($cd);die;
            $appidmap = json_decode($cd[0][1],true);
            foreach ($appidmap as $key => $value) {
                if($value['name']==$oname){
                    $save_data['appid'] = $value['appid'];
                    $save_data['share_domain'] = isset($urlmap[0])?"http://".$urlmap[0]:"";
                    $save_data['rk_domain'] = isset($urlmap[1])?"http://".$urlmap[1]:"";
                    $save_data['b_domain'] = isset($urlmap[2])?"http://".$urlmap[2]:"";
                    $save_data['zhid'] = $this->t['id'];
                    $save_data['iplist']=$this->t['iplist'];
                    $save_data['gzhlist']=$this->t['gzhlist'];
                    $save_data['domain']=$d['sns_domain'];
                    $save_data['zhanghao'] = $this->t['user']['user_name'];
                    $save_data['mima'] = $this->t['user']['dpassword'];
                    $n = array_merge($d,$save_data);
                    //var_dump($n);
                    //var_dump($save_data);die;
                    //D("WxOpenPlats")->where(['id'=>$nwxlist])->save($n);
                    DB::table('WxOpenPlats')->where(['id'=>$nwxlist])->update($n);
                }
            }
            echo sprintf("第三方平台申请成功！申请名称为：%s,请登录复制APPSECRET", $oname);die;
 
        }else{ 
            //D("WxOpenPlats")->where(['id'=>$nwxlist])->delete();
            DB::table('WxOpenPlats')->where(['id'=>$nwxlist])->delete();
            echo "第三方平台申请失败！".json_encode($back); die;
           
        }
    }
    //删除命令  https://open.weixin.qq.com/cgi-bin/component_acct    appid=wx9728a0a0b7cbf881&action=del_component&token=e166cd9d430f96a8a647d80857137bc4996128c5&lang=zh_CN&f=json&ajax=1&key=1
    public function deletedsf($appid="")
    {
        $referer = "https://open.weixin.qq.com/cgi-bin/component_acct?t=manage/createBizPlugin&action=create&lang=zh_CN&token=".$this->t['token'];
        $b = $this->Dhttp->Dhttp("https://open.weixin.qq.com/cgi-bin/component_acct",['appid'=>$appid,'action'=>'del_component','token'=>$this->t['token'],'lang'=>'zh_CN','f'=>"json","ajax"=>1,"key"=>1],$referer);
        $backdata = json_decode($b->body,true);
        if($backdata['base_resp']['err_msg']!="ok"){
            echo "未能在公众平台删除，请登录手动删除";die;
        }
    }
    // 修改命令
    public function Changedsf($d)
    {
        $icon_url = "http://mmbiz.qpic.cn/mmbiz_png/VPtJAWJntQ99y1xdSoHWyBMjtG4YHjc3zpiaeGgdmqPf4zvaFkjicibz1iaOWPuTT2jU4L9wW4ia3SQ9NniaTY30Nk5Q/0?wx_fmt=png";
        $referer = "https://open.weixin.qq.com/cgi-bin/component_acct?t=manage/createBizPlugin&action=create&lang=zh_CN&token=".$this->t['token'];
        $url = "https://open.weixin.qq.com/cgi-bin/component_acct";
        $send_body = [
            'name'=>$d['name'],
            'desc'=>"D_".$d['id'],
            'official_site'=>$this->getCode(1,8).".com",
            'icon_url'=>$icon_url,
            'auth_token'=>$this->t['token'],
            'auth_domain'=>config('url.MP_LOGIN_DOMAIN'),
            'ticket_url'=>"http://".config('url.MP_LOGIN_DOMAIN')."/api.php?s=open/verify_ticket&id=".$d['id'],
            'msg_url'=>"http://".config('url.MP_LOGIN_DOMAIN').'/opensdk/$APPID$',
            'white_ip'=>$d['iplist'],
            'white_acct'=>$d['gzhlist'],
            'category_list'=>'4',
            'symmetric_key'=>$d['encodingaeskey'],
            'sns_domain'=>$d['domain'],
            'tag_id_list'=>'1001',
            'appid'=>$d['appid'],
            'token'=>$this->t['token'],
            'lang'=>'zh_CN',
            'f'=>'json',
            'ajax'=>'1',
            'action'=>'modify',
            'key'=>'modify'
        ];
        //var_dump($send_body);die;

        $b = $this->Dhttp->Dhttp($url,$send_body,$referer);
        $backdata = json_decode($b->body,true);
        if ($backdata['base_resp']['err_msg']!="ok" || $backdata['err_code']!="0") {
            echo $b->body;die;
        }
    }
    private $code_map =['0123456789','abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ0123456789','的一是在了不和有大这主中人上为们地个用工时要动国产以我到他会作来分生对于学下级就年阶义发成部民可出能方进同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批如应形想制心样干都向变关点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫康遵牧遭幅园腔订香肉弟屋敏恢忘衣孙龄岭骗休借丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩'];//随机因子
    // 输出json数据
    public function echoJSON($status=false,$msg="",$bakcurl="",$other_data=array())
    {
        return Json::encode(['status'=>$status,'msg'=>$msg,'backurl'=>$bakcurl,'other_data'=>$other_data]);
    }
    /**
     * [getCode 获取随机字符]
     * @param  integer $code_type [字符类型,0=数字,1=字符串+数字,2=汉子]
     * @param  integer $dlen      [长度]
     * @return [type]             [混合后的字符串]
     */
    public function getCode($code_type=0,$dlen=4) {
        $charset = $this->code_map[$code_type];
        $charset_a =[];
        $code = [];
        if ($code_type==2) {
            $zhongwenku_size = mb_strlen($this->code_map[$code_type],"UTF-8");
            $zhongwenku = array();
            for( $i=0; $i<$zhongwenku_size; $i++){
                $charset_a[$i] = mb_substr($this->code_map[$code_type], $i,1,"UTF-8");
            }
            $charset = $charset_a;
        }
        if ($code_type==2) {
            $_len = count($charset)-1;
        } else {
            $_len = strlen($charset)-1;
        }
        for ($i=0;$i<$dlen;$i++) {
            $code[] = $charset[mt_rand(0,$_len)];
        }
        $string_code = "";
        foreach ($code as $key => $value){
            $string_code.=$value;
        };
        if ($code_type==2) {
            return $string_code;
        } else {
            return $string_code;
        }
    } 
}


/**
 * 基础类
 */
class Dhttp
{
    public $basePath = "";
    public $cookies_file;
    public $errorMsg;
    public function __construct($cookiesfile)
    {
        $this->basePath = public_path().'/tongji/';
        $this->cookies_file = $cookiesfile;
    }
    // 保存cookies
    public function SaveCookies($data=array())
    {
        if(is_array($data)){
            file_put_contents($this->basePath.$this->cookies_file,is_array($data)?json_encode($data):$data);
        }
    }
    // 读取cookies
    public function GetCookies()
    {
        $file_name = $this->basePath.$this->cookies_file;
        if (is_file($file_name)) {
            $c = file_get_contents($file_name);
            return empty($c)?[]:json_decode($c,true);
        } else {
            return [];
        }
    }
    // 基础post方法，
    public function Dhttp($url="",$post_data=array(),$referer="")
    {
        $h = HttpRequest::newSession();
        $ocookies = $this->GetCookies();
        $h->cookies = $ocookies;
        if (empty($post_data)) {
            if(!empty($referer)){$h->referer($referer);}
            $r = $h->get($url);
        } else {
            $h->params($post_data);
            if(!empty($referer)){$h->referer($referer);}
            $r = $h->post($url);
        }

        $ncookies = $r->cookies;
        foreach ($ncookies as $key => $value) {
            $ocookies[$key] = $value['value'];
        }
        $this->SaveCookies($ocookies);
        return $r;
    }
    // 下载图片
    public function DownloadImg($url,$img_name="",$referer="")
    {
        $download = new Download($url);
        $download->http->cookies = $this->GetCookies();
        $download->http->referer($referer);
        $this->errorMsg = $download->errorMsg;
        return $download->download($this->basePath.$img_name);
    }
}
class Download
{
    /**
     * HttpRequest
     * @var HttpRequest
     */
    public $http;

    /**
     * 下载地址
     * @var string
     */
    public $url;

    /**
     * 参数
     * @var string
     */
    public $params;

    /**
     * 请求方法
     * @var string
     */
    public $method;

    /**
     * HttpResponse
     *
     * @var HttpResponse
     */
    public $response;

    /**
     * 断点续传是否开启，默认为自动检测。常量BreakContinue::
     * @var int
     */
    public $breakContinue = BreakContinue::AUTO;

    /**
     * 文件大小
     * @var int
     */
    public $fileSize;

    /**
     * 是否开启断点续传
     * @var bool
     */
    public $isBreakContinue;
    public $errorMsg;
    /**
     * 每个分块大小，单位：字节，默认为1M
     * @var int
     */
    public $blockSize = 1048576;

    public function __construct($url, $params = array(), $method = 'GET')
    {
        $this->url = $url;
        $this->params = $params;
        $this->method = $method;
        $this->http = new HttpRequest();
    }

    /**
     * 获取文件大小，单位：字节。
     * @return mixed
     */
    public function getFileSize()
    {
        $this->response = $this->http->headers(array(
            'Range'	=>	'bytes=0-1',
        ))->options(array(
            CURLOPT_NOBODY	=>	true
        ))->send($this->url, $this->params, $this->method);
        if(isset($this->response->headers['Content-Range']))
        {
            list(, $length) = explode('/', $this->response->headers['Content-Range']);
            return (int)$length;
        }
        else
        {
            return false;
        }
    }

    public function download($filename)
    {
        $this->fileSize = $this->getFileSize();
        if($this->fileSize)
        {
            $canBreakContinue = isset($this->response->headers['Content-Range']);
            switch($this->breakContinue)
            {
                case BreakContinue::AUTO:
                    $this->isBreakContinue = $canBreakContinue;
                    break;
                case BreakContinue::ON:
                    $this->isBreakContinue = (true === $canBreakContinue);
                    break;
                case BreakContinue::OFF:
                    $this->isBreakContinue = false;
                    break;
            }
        }
        else
        {
            $canBreakContinue = $this->isBreakContinue = false;
        }
        $this->http->options(array(
            CURLOPT_NOBODY	=>	false
        ));
        if($this->isBreakContinue)
        {
            $fp = fopen($filename, 'a+');
            if(false === $fp)
            {
                $this->errorMsg = "打开本地文件失败";
                return false;
            }
            $begin = filesize($filename);
            if(false === $begin)
            {
                $this->errorMsg = "获取本地文件大小失败";
                return false;
                // throw new \Exception('获取本地文件大小失败');
            }
            while($begin < $this->fileSize)
            {
                $length = min($this->fileSize - $begin, $this->blockSize);
                $this->response = $this->http->headers(array(
                    'Range'	=>	'bytes=' . $begin . '-' . ($begin + $length),
                ))->send($this->url, $this->params, $this->method);
                if(false === fwrite($fp, $this->response->body))
                {
                    fclose($fp);
                    $this->errorMsg = "文件写入失败";
                    return false;
                    // throw new \Exception('文件写入失败');
                }
                $begin += $this->response->headers['Content-Length'];
                $this->trigger('progressChanged', array(
                    'length'			=>	$this->fileSize,
                    'completeLength'	=>	$begin,
                    'percent'			=>	$begin / $this->fileSize,
                ));
            }
            fclose($fp);
        }
        else
        {
            $this->http->download($filename, $this->url, $this->params, $this->method);
        }
        return true;
    }
}


class BreakContinue
{
    const AUTO = 1;

    const ON = 2;

    const OFF = 3;
}



class HttpRequest
{
    /**
     * CURL操作对象，`curl_init()`的返回值
     * @var resource
     */
    public $handler;

    /**
     * 需要请求的Url地址
     * @var string
     */
    public $url;

    /**
     * 发送内容，可以是字符串、数组、`HttpRequestMultipartBody`
     * @var mixed
     */
    public $content;

    /**
     * `curl_setopt_array()`所需要的第二个参数
     * @var array
     */
    public $options = array();

    /**
     * 请求头
     * @var array
     */
    public $headers = array();

    /**
     * Cookies
     * @var array
     */
    public $cookies = array();

    /**
     * 保存Cookie文件的文件名，为空不保存
     * @var string
     */
    public $cookieFileName = '';

    /**
     * 失败重试次数，默认为0
     * @var int
     */
    public $retry = 0;

    /**
     * 是否使用代理，默认false
     * @var bool
     */
    public $useProxy = false;

    /**
     * 代理设置
     * @var array
     */
    public $proxy = array();

    /**
     * 是否验证证书
     * @var bool
     */
    public $isVerifyCA = false;

    /**
     * CA根证书路径
     * @var string
     */
    public $caCert;

    /**
     * 连接超时时间，单位：毫秒
     * @var int
     */
    public $connectTimeout = 30000;

    /**
     * 总超时时间，单位：毫秒
     * @var int
     */
    public $timeout = 0;

    /**
     * 下载限速，为0则不限制，单位：字节
     * @var int
     */
    public $downloadSpeed;

    /**
     * 上传限速，为0则不限制，单位：字节
     * @var int
     */
    public $uploadSpeed;

    /**
     * 用于连接中需要的用户名
     * @var string
     */
    public $username;

    /**
     * 用于连接中需要的密码
     * @var string
     */
    public $password;

    /**
     * 请求结果保存至文件的配置
     * @var mixed
     */
    public $saveFileOption = array();

    /**
     * 根据location自动重定向
     * @var bool
     */
    public $followLocation = true;

    /**
     * 最大重定向次数
     * @var int
     */
    public $maxRedirects = 10;

    /**
     * 证书类型
     * 支持的格式有"PEM" (默认值), "DER"和"ENG"
     * @var string
     */
    public $certType = 'pem';

    /**
     * 一个包含 PEM 格式证书的文件名
     * @var string
     */

    public $certPath = '';
    /**
     * 使用证书需要的密码
     * @var string
     */
    public $certPassword = null;

    /**
     * certType规定的私钥的加密类型，支持的密钥类型为"PEM"(默认值)、"DER"和"ENG"
     * @var string
     */
    public $keyType = 'pem';

    /**
     * 包含 SSL 私钥的文件名
     * @var string
     */
    public $keyPath = '';

    /**
     * SSL私钥的密码
     * @var string
     */
    public $keyPassword = null;

    /**
     * 使用自定义实现的重定向，性能较差。如果不是环境不支持自动重定向，请勿设为true
     * @var bool
     */
    public static $customLocation = false;

    /**
     * 临时目录，有些特殊环境（如某国内虚拟主机）需要特别设置一下临时文件目录
     * @var string
     */
    public static $tempDir;

    /**
     * 代理认证方式
     */
    public static $proxyAuths = array(
        'basic'		=>	CURLAUTH_BASIC,
        'ntlm'		=>	CURLAUTH_NTLM
    );

    /**
     * 代理类型
     */
    public static $proxyType = array(
        'http'		=>	CURLPROXY_HTTP,
        'socks4'	=>	CURLPROXY_SOCKS4,
        'socks4a'	=>	6,	// CURLPROXY_SOCKS4A
        'socks5'	=>	CURLPROXY_SOCKS5,
    );

    /**
     * 构造方法
     * @return mixed
     */
    public function __construct()
    {
        $this->open();
        $this->cookieFileName = tempnam(null === self::$tempDir ? sys_get_temp_dir() : self::$tempDir,'');
    }

    /**
     * 析构方法
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * 打开一个新连接，初始化所有参数。一般不需要手动调用。
     * @return void
     */
    public function open()
    {
        $this->handler = curl_init();
        $this->retry = 0;
        $this->headers = $this->options = array();
        $this->url = $this->content = '';
        $this->useProxy = false;
        $this->proxy = array(
            'auth'	=>	'basic',
            'type'	=>	'http',
        );
        $this->isVerifyCA = false;
        $this->caCert = null;
        $this->connectTimeout = 30000;
        $this->timeout = 0;
        $this->downloadSpeed = null;
        $this->uploadSpeed = null;
        $this->username = null;
        $this->password = null;
        $this->saveFileOption = array();
    }

    /**
     * 关闭连接。一般不需要手动调用。
     * @return void
     */
    public function close()
    {
        if(null !== $this->handler)
        {
            curl_close($this->handler);
            $this->handler = null;
            if(is_file($this->cookieFileName))
            {
                unlink($this->cookieFileName);
            }
        }
    }

    /**
     * 创建一个新会话，等同于new
     * @return HttpRequest
     */
    public static function newSession()
    {
        return new static;
    }

    /**
     * 设置请求地址
     * @param string $url 请求地址
     * @return HttpRequest
     */
    public function url($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * 设置发送内容，requestBody的别名
     * @param mixed $content 发送内容，可以是字符串、数组、HttpRequestMultipartBody
     * @return HttpRequest
     */
    public function content($content)
    {
        return $this->requestBody($content);
    }

    /**
     * 设置参数，requestBody的别名
     * @param mixed $params 发送内容，可以是字符串、数组、HttpRequestMultipartBody
     * @return HttpRequest
     */
    public function params($params)
    {
        return $this->requestBody($params);
    }

    /**
     * 设置请求主体
     * @param mixed $requestBody 发送内容，可以是字符串、数组、HttpRequestMultipartBody
     * @return HttpRequest
     */
    public function requestBody($requestBody)
    {
        $this->content = $requestBody;
        return $this;
    }

    /**
     * 批量设置CURL的Option
     * @param array $options curl_setopt_array()所需要的第二个参数
     * @return HttpRequest
     */
    public function options($options)
    {
        foreach($options as $key => $value)
        {
            $this->options[$key] = $value;
        }
        return $this;
    }

    /**
     * 设置CURL的Option
     * @param int $option 需要设置的CURLOPT_XXX选项
     * @param mixed $value 值
     * @return HttpRequest
     */
    public function option($option, $value)
    {
        $this->options[$option] = $value;
        return $this;
    }

    /**
     * 批量设置请求头
     * @param array $headers
     * @return HttpRequest
     */
    public function headers($headers)
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * 设置请求头
     * @param string $header 请求头名称
     * @param string $value 值
     * @return HttpRequest
     */
    public function header($header, $value)
    {
        $this->headers[$header] = $value;
        return $this;
    }

    /**
     * 设置Accept
     * @param string $accept
     * @return HttpRequest
     */
    public function accept($accept)
    {
        $this->headers['Accept'] = $accept;
        return $this;
    }

    /**
     * 设置Accept-Language
     * @param string $acceptLanguage
     * @return HttpRequest
     */
    public function acceptLanguage($acceptLanguage)
    {
        $this->headers['Accept-Language'] = $acceptLanguage;
        return $this;
    }

    /**
     * 设置Accept-Encoding
     * @param string $acceptEncoding
     * @return HttpRequest
     */
    public function acceptEncoding($acceptEncoding)
    {
        $this->headers['Accept-Encoding'] = $acceptEncoding;
        return $this;
    }

    /**
     * 设置Accept-Ranges
     * @param string $acceptRanges
     * @return HttpRequest
     */
    public function acceptRanges($acceptRanges)
    {
        $this->headers['Accept-Ranges'] = $acceptRanges;
        return $this;
    }

    /**
     * 设置Cache-Control
     * @param string $cacheControl
     * @return HttpRequest
     */
    public function cacheControl($cacheControl)
    {
        $this->headers['Cache-Control'] = $cacheControl;
        return $this;
    }

    /**
     * 批量设置Cookies
     * @param array $cookies 键值对应数组
     * @return HttpRequest
     */
    public function cookies($cookies)
    {
        $this->cookies = array_merge($this->cookies, $cookies);
        return $this;
    }

    /**
     * 设置Cookie
     * @param string $name 名称
     * @param string $value 值
     * @return HttpRequest
     */
    public function cookie($name, $value)
    {
        $this->cookies[$name] = $value;
        return $this;
    }

    /**
     * 设置Content-Type
     * @param string $contentType
     * @return HttpRequest
     */
    public function contentType($contentType)
    {
        $this->headers['Content-Type'] = $contentType;
        return $this;
    }

    /**
     * 设置Range
     * @param string $range
     * @return HttpRequest
     */
    public function range($range)
    {
        $this->headers['Range'] = $range;
        return $this;
    }

    /**
     * 设置Referer
     * @param string $referer
     * @return HttpRequest
     */
    public function referer($referer)
    {
        $this->headers['Referer'] = $referer;
        return $this;
    }

    /**
     * 设置User-Agent
     * @param string $userAgent
     * @return HttpRequest
     */
    public function userAgent($userAgent)
    {
        $this->headers['User-Agent'] = $userAgent;
        return $this;
    }

    /**
     * 设置User-Agent，userAgent的别名
     * @param string $userAgent
     * @return HttpRequest
     */
    public function ua($userAgent)
    {
        return $this->userAgent($userAgent);
    }

    /**
     * 设置失败重试次数，状态码非200时重试
     * @param string $retry
     * @return HttpRequest
     */
    public function retry($retry)
    {
        $this->retry = $retry < 0 ? 0 : $retry;   //至少请求1次，即重试0次
        return $this;
    }

    /**
     * 代理
     * @param string $server 代理服务器地址
     * @param int $port 代理服务器端口
     * @param string $type 代理类型，支持：http、socks4、socks4a、socks5
     * @param string $auth 代理认证方式，支持：basic、ntlm。一般默认basic
     * @return HttpRequest
     */
    public function proxy($server, $port, $type = 'http', $auth = 'basic')
    {
        $this->useProxy = true;
        $this->proxy = array(
            'server'	=>	$server,
            'port'		=>	$port,
            'type'		=>	$type,
            'auth'		=>	$auth,
        );
        return $this;
    }

    /**
     * 设置超时时间
     * @param int $timeout 总超时时间，单位：毫秒
     * @param int $connectTimeout 连接超时时间，单位：毫秒
     * @return HttpRequest
     */
    public function timeout($timeout = null, $connectTimeout = null)
    {
        if(null !== $timeout)
        {
            $this->timeout = $timeout;
        }
        if(null !== $connectTimeout)
        {
            $this->connectTimeout = $connectTimeout;
        }
        return $this;
    }

    /**
     * 限速
     * @param int $download 下载速度，为0则不限制，单位：字节
     * @param int $upload 上传速度，为0则不限制，单位：字节
     * @return HttpRequest
     */
    public function limitRate($download = 0, $upload = 0)
    {
        $this->downloadSpeed = $download;
        $this->uploadSpeed = $upload;
        return $this;
    }

    /**
     * 设置用于连接中需要的用户名和密码
     * @param string $username 用户名
     * @param string $password 密码
     * @return HttpRequest
     */
    public function userPwd($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        return $this;
    }

    /**
     * 保存至文件的设置
     * @param string $filePath 文件路径
     * @param string $fileMode 文件打开方式，默认w+
     * @return HttpRequest
     */
    public function saveFile($filePath, $fileMode = 'w+')
    {
        $this->saveFileOption['filePath'] = $filePath;
        $this->saveFileOption['fileMode'] = $fileMode;
        return $this;
    }

    /**
     * 获取文件保存路径
     * @return string
     */
    public function getSavePath()
    {
        return $this->saveFileOption['savePath'];
    }

    /**
     * 设置SSL证书
     * @param string $path 一个包含 PEM 格式证书的文件名
     * @param string $type 证书类型，支持的格式有”PEM”(默认值),“DER”和”ENG”
     * @param string $password 使用证书需要的密码
     * @return HttpRequest
     */
    public function sslCert($path, $type = null, $password = null)
    {
        $this->certPath = $path;
        if(null !== $type)
        {
            $this->certType = $type;
        }
        if(null !== $password)
        {
            $this->certPassword = $password;
        }
        return $this;
    }

    /**
     * 设置SSL私钥
     * @param string $path 包含 SSL 私钥的文件名
     * @param string $type certType规定的私钥的加密类型，支持的密钥类型为”PEM”(默认值)、”DER”和”ENG”
     * @param string $password SSL私钥的密码
     * @return HttpRequest
     */
    public function sslKey($path, $type = null, $password = null)
    {
        $this->keyPath = $path;
        if(null !== $type)
        {
            $this->keyType = $type;
        }
        if(null !== $password)
        {
            $this->keyPassword = $password;
        }
        return $this;
    }

    /**
     * 发送请求，所有请求的老祖宗
     * @param string $url 请求地址，如果为null则取url属性值
     * @param array $requestBody 发送内容，可以是字符串、数组、`HttpRequestMultipartBody`，如果为空则取content属性值
     * @param array $method 请求方法，GET、POST等
     * @return HttpResponse
     */
    public function send($url = null, $requestBody = array(), $method = 'GET')
    {
        if(null !== $url)
        {
            $this->url = $url;
        }
        if(!empty($requestBody))
        {
            if(is_array($requestBody))
            {
                $this->content = http_build_query($requestBody, '', '&');
            }
            else if($requestBody instanceof HttpRequestMultipartBody)
            {
                $this->content = $requestBody->content();
                $this->contentType(sprintf('multipart/form-data; boundary=%s', $requestBody->getBoundary()));
            }
            else
            {
                $this->content = $requestBody;
            }
        }
        $options = array(
            // 请求方法
            CURLOPT_CUSTOMREQUEST	=> $method,
            // 返回内容
            CURLOPT_RETURNTRANSFER	=> true,
            // 返回header
            CURLOPT_HEADER			=> true,
            // 发送内容
            CURLOPT_POSTFIELDS		=> $this->content,
            // 保存cookie
            CURLOPT_COOKIEFILE		=> $this->cookieFileName,
            CURLOPT_COOKIEJAR		=> $this->cookieFileName,
            // 自动重定向
            CURLOPT_FOLLOWLOCATION	=> self::$customLocation ? false : $this->followLocation,
            // 最大重定向次数
            CURLOPT_MAXREDIRS		=> $this->maxRedirects,
        );
        // 自动解压缩支持
        if(isset($this->headers['Accept-Encoding']))
        {
            $options[CURLOPT_ENCODING] = $this->headers['Accept-Encoding'];
        }
        else
        {
            $options[CURLOPT_ENCODING] = '';
        }
        curl_setopt_array($this->handler, $options);
        $this->parseSSL();
        $this->parseOptions();
        $this->parseProxy();
        $this->parseHeaders();
        $this->parseCookies();
        $this->parseNetwork();
        $count = 0;
        do{
            curl_setopt($this->handler, CURLOPT_URL, $url);
            for($i = 0; $i <= $this->retry; ++$i)
            {
                $response = new HttpResponse($this->handler, curl_exec($this->handler));
                $httpCode = $response->httpCode();
                // 状态码为5XX或者0才需要重试
                if(!(0 === $httpCode || (5 === (int)($httpCode/100))))
                {
                    break;
                }
            }
            if(self::$customLocation && (301 === $httpCode || 302 === $httpCode) && ++$count <= $this->maxRedirects)
            {
                $url = $response->headers['Location'];
            }
            else
            {
                break;
            }
        }while(true);
        // 关闭保存至文件的句柄
        if(isset($this->saveFileOption['fp']))
        {
            fclose($this->saveFileOption['fp']);
            $this->saveFileOption['fp'] = null;
        }
        return $response;
    }

    /**
     * GET请求
     * @param string $url 请求地址，如果为null则取url属性值
     * @param array $requestBody 发送内容，可以是字符串、数组、`HttpRequestMultipartBody`，如果为空则取content属性值
     * @return HttpResponse
     */
    public function get($url = null, $requestBody = array())
    {
        if(!empty($requestBody))
        {
            if(strpos($url, '?'))
            {
                $url .= '&';
            }
            else
            {
                $url .= '?';
            }
            $url .= http_build_query($requestBody, '', '&');
        }
        return $this->send($url, array(), 'GET');
    }

    /**
     * POST请求
     * @param string $url 请求地址，如果为null则取url属性值
     * @param array $requestBody 发送内容，可以是字符串、数组、`HttpRequestMultipartBody`，如果为空则取content属性值
     * @return HttpResponse
     */
    public function post($url = null, $requestBody = array())
    {
        return $this->send($url, $requestBody, 'POST');
    }

    /**
     * HEAD请求
     * @param string $url 请求地址，如果为null则取url属性值
     * @param array $requestBody 发送内容，可以是字符串、数组、`HttpRequestMultipartBody`，如果为空则取content属性值
     * @return HttpResponse
     */
    public function head($url = null, $requestBody = array())
    {
        return $this->send($url, $requestBody, 'HEAD');
    }

    /**
     * PUT请求
     * @param string $url 请求地址，如果为null则取url属性值
     * @param array $requestBody 发送内容，可以是字符串、数组、`HttpRequestMultipartBody`，如果为空则取content属性值
     * @return HttpResponse
     */
    public function put($url = null, $requestBody = array())
    {
        return $this->send($url, $requestBody, 'PUT');
    }

    /**
     * PATCH请求
     * @param string $url 请求地址，如果为null则取url属性值
     * @param array $requestBody 发送内容，可以是字符串、数组、`HttpRequestMultipartBody`，如果为空则取content属性值
     * @return HttpResponse
     */
    public function patch($url = null, $requestBody = array())
    {
        return $this->send($url, $requestBody, 'PATCH');
    }

    /**
     * DELETE请求
     * @param string $url 请求地址，如果为null则取url属性值
     * @param array $requestBody 发送内容，可以是字符串、数组、`HttpRequestMultipartBody`，如果为空则取content属性值
     * @return HttpResponse
     */
    public function delete($url = null, $requestBody = array())
    {
        return $this->send($url, $requestBody, 'DELETE');
    }

    /**
     * 直接下载文件
     * @param string $fileName 保存路径
     * @param string $url 下载文件地址
     * @param array $requestBody 发送内容，可以是字符串、数组、`HttpRequestMultipartBody`，如果为空则取content属性值
     * @param string $method 请求方法，GET、POST等，一般用GET
     * @return HttpResponse
     */
    public function download($fileName, $url = null, $requestBody = array(), $method = 'GET')
    {
        $result = $this->saveFile($fileName)->send($url, $requestBody, $method);
        $this->saveFileOption = array();
        return $result;
    }

    /**
     * 处理Options
     * @return void
     */
    protected function parseOptions()
    {
        curl_setopt_array($this->handler, $this->options);
        // 请求结果保存为文件
        if(isset($this->saveFileOption['filePath']) && null !== $this->saveFileOption['filePath'])
        {
            curl_setopt_array($this->handler, array(
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => false,
            ));
            $filePath = $this->saveFileOption['filePath'];
            $last = substr($filePath, -1, 1);
            if('/' === $last || '\\' === $last)
            {
                // 自动获取文件名
                $filePath .= basename($this->url);
            }
            $this->saveFileOption['savePath'] = $filePath;
            $this->saveFileOption['fp'] = fopen($filePath, isset($this->saveFileOption['fileMode']) ? $this->saveFileOption['fileMode'] : 'w+');
            curl_setopt($this->handler, CURLOPT_FILE, $this->saveFileOption['fp']);
        }
    }

    /**
     * 处理代理
     * @return void
     */
    protected function parseProxy()
    {
        if($this->useProxy)
        {
            curl_setopt_array($this->handler, array(
                CURLOPT_PROXYAUTH	=> self::$proxyAuths[$this->proxy['auth']],
                CURLOPT_PROXY		=> $this->proxy['server'],
                CURLOPT_PROXYPORT	=> $this->proxy['port'],
                CURLOPT_PROXYTYPE	=> 'socks5' === $this->proxy['type'] ? (defined('CURLPROXY_SOCKS5_HOSTNAME') ? CURLPROXY_SOCKS5_HOSTNAME : self::$proxyType[$this->proxy['type']]) : self::$proxyType[$this->proxy['type']],
            ));
        }
    }

    /**
     * 处理Headers
     * @return void
     */
    protected function parseHeaders()
    {
        curl_setopt($this->handler, CURLOPT_HTTPHEADER, $this->parseHeadersFormat());
    }

    /**
     * 处理Cookie
     * @return void
     */
    protected function parseCookies()
    {
        $content = '';
        foreach($this->cookies as $name => $value)
        {
            $content .= "{$name}={$value}; ";
        }
        curl_setopt($this->handler, CURLOPT_COOKIE, $content);
    }

    /**
     * 处理成CURL可以识别的headers格式
     * @return array
     */
    protected function parseHeadersFormat()
    {
        $headers = array();
        foreach($this->headers as $name => $value)
        {
            $headers[] = $name . ':' . $value;
        }
        return $headers;
    }

    /**
     * 处理SSL
     * @return void
     */
    protected function parseSSL()
    {
        if($this->isVerifyCA)
        {
            curl_setopt_array($this->handler, array(
                CURLOPT_SSL_VERIFYPEER	=> true,
                CURLOPT_CAINFO			=> $this->caCert,
                CURLOPT_SSL_VERIFYHOST	=> 2,
            ));
        }
        else
        {
            curl_setopt_array($this->handler, array(
                CURLOPT_SSL_VERIFYPEER	=> false,
                CURLOPT_SSL_VERIFYHOST	=> 0,
            ));
        }
        if('' !== $this->certPath)
        {
            curl_setopt_array($this->handler, array(
                CURLOPT_SSLCERT			=> $this->certPath,
                CURLOPT_SSLCERTPASSWD	=> $this->certPassword,
                CURLOPT_SSLCERTTYPE		=> $this->certType,
            ));
        }
        if('' !== $this->keyPath)
        {
            curl_setopt_array($this->handler, array(
                CURLOPT_SSLKEY			=> $this->keyPath,
                CURLOPT_SSLKEYPASSWD	=> $this->keyPassword,
                CURLOPT_SSLKEYTYPE		=> $this->keyType,
            ));
        }
    }

    /**
     * 处理网络相关
     * @return void
     */
    protected function parseNetwork()
    {
        // 用户名密码处理
        if('' != $this->username)
        {
            $userPwd = $this->username . ':' . $this->password;
        }
        else
        {
            $userPwd = '';
        }
        curl_setopt_array($this->handler, array(
            // 连接超时
            CURLOPT_CONNECTTIMEOUT_MS		=> $this->connectTimeout,
            // 总超时
            CURLOPT_TIMEOUT_MS				=> $this->timeout,
            // 下载限速
            CURLOPT_MAX_RECV_SPEED_LARGE	=> $this->downloadSpeed,
            // 上传限速
            CURLOPT_MAX_SEND_SPEED_LARGE	=> $this->uploadSpeed,
            // 连接中用到的用户名和密码
            CURLOPT_USERPWD					=> $userPwd,
        ));
    }
}


class HttpResponse
{
    /**
     * CURL操作对象，`curl_init()`的返回值
     * @var resource
     */
    public $handler;

    /**
     * 请求返回结果，包含返回头和返回主体
     * @var string
     */
    public $response;

    /**
     * 返回头, 最后一次请求的返回头
     * @var array
     */
    public $headers = array();

    /**
     * 返回头, 包含中间所有请求(即包含重定向)的返回头
     * @var array
     */
    public $allHeaders = array();

    /**
     * Cookie
     * @var array
     */
    public $cookies = array();

    /**
     * 头部内容
     * @var string
     */
    public $headerContent = '';

    /**
     * 返回结果
     * @var string
     */
    public $body = '';

    /**
     * 是否请求成功
     * @var boolean
     */
    public $success;

    /**
     * 构造方法
     */
    public function __construct($handler, $response)
    {
        $this->handler = $handler;
        $this->response = $response;
        $this->success = false !== $response;
        $this->parseResponse();
    }

    /**
     * 获取返回的主体内容
     * @param string $fromEncoding 请求返回数据的编码，如果不为空则进行编码转换
     * @param string $toEncoding 要转换到的编码，默认为UTF-8
     * @return void
     */
    public function body($fromEncoding = null, $toEncoding = 'UTF-8')
    {
        if(null === $fromEncoding)
        {
            return $this->body;
        }
        else
        {
            return mb_convert_encoding($this->body, $toEncoding, $fromEncoding);
        }
    }

    /**
     * 获取xml格式内容
     * @param boolean $assoc 为true时返回数组，为false时返回对象
     * @param string $fromEncoding 请求返回数据的编码，如果不为空则进行编码转换
     * @param string $toEncoding 要转换到的编码，默认为UTF-8
     * @return mixed
     */
    public function xml($assoc = false, $fromEncoding = null, $toEncoding = 'UTF-8')
    {
        $xml = simplexml_load_string($this->body($fromEncoding, $toEncoding), null, LIBXML_NOCDATA | LIBXML_COMPACT);
        if($assoc)
        {
            $xml = (array)$xml;
        }
        return $xml;
    }

    /**
     * 获取json格式内容
     * @param boolean $assoc 为true时返回数组，为false时返回对象
     * @param string $fromEncoding 请求返回数据的编码，如果不为空则进行编码转换
     * @param string $toEncoding 要转换到的编码，默认为UTF-8
     * @return mixed
     */
    public function json($assoc = false, $fromEncoding = null, $toEncoding = 'UTF-8')
    {
        return json_decode($this->body($fromEncoding, $toEncoding), $assoc);
    }

    /**
     * 获取jsonp格式内容
     * @param boolean $assoc 为true时返回数组，为false时返回对象
     * @param string $fromEncoding 请求返回数据的编码，如果不为空则进行编码转换
     * @param string $toEncoding 要转换到的编码，默认为UTF-8
     * @return mixed
     */
    public function jsonp($assoc = false, $fromEncoding = null, $toEncoding = 'UTF-8')
    {
        $jsonp = trim($this->body($fromEncoding, $toEncoding));
        if(isset($jsonp[0]) && $jsonp[0] !== '[' && $jsonp[0] !== '{') {
            $begin = strpos($jsonp, '(');
            if(false !== $begin)
            {
                $end = strrpos($jsonp, ')');
                if(false !== $end)
                {
                    $jsonp = substr($jsonp, $begin + 1, $end - $begin - 1);
                }
            }
        }
        return json_decode($jsonp, $assoc);
    }

    /**
     * 获取http状态码
     * @return int
     */
    public function httpCode()
    {
        return curl_getinfo($this->handler, CURLINFO_HTTP_CODE);
    }

    /**
     * 获取请求总耗时，单位：秒
     * @return int
     */
    public function totalTime()
    {
        return curl_getinfo($this->handler, CURLINFO_TOTAL_TIME);
    }

    /**
     * 处理
     */
    protected function parseResponse()
    {
        // 分离header和body
        $headerSize = curl_getinfo($this->handler, CURLINFO_HEADER_SIZE);
        $this->headerContent = substr($this->response, 0, $headerSize);
        $this->body = substr($this->response, $headerSize);
        // PHP 7.0.0开始substr()的 string 字符串长度与 start 相同时将返回一个空字符串。在之前的版本中，这种情况将返回 FALSE 。
        if(false === $this->body)
        {
            $this->body = '';
        }
        $this->parseHeader();
        $this->parseCookie();
    }

    /**
     * 处理header
     */
    protected function parseHeader()
    {
        $rawHeaders = explode("\r\n\r\n", trim($this->headerContent), 2);
        $requestCount = count($rawHeaders);
        for($i=0; $i<$requestCount; ++$i){
            $this->allHeaders[] = $this->parseHeaderOneRequest($rawHeaders[$i]);
        }
        if($requestCount>0) $this->headers = $this->allHeaders[$requestCount-1];
    }

    /**
     * parseHeaderOneRequest
     * @param string $piece
     * @return array
     */
    protected function parseHeaderOneRequest($piece){
        $tmpHeaders = array();
        $lines = explode("\r\n", $piece);
        $linesCount = count($lines);
        //从1开始，第0行包含了协议信息和状态信息，排除该行
        for($i=1; $i<$linesCount; ++$i){
            $line = trim($lines[$i]);
            if(empty($line)||strstr($line, ':') == false) continue;
            list($key, $value) = explode(':', $line, 2);
            $key = trim($key);
            $value = trim($value);
            if(isset($tmpHeaders[$key])){
                if(is_array($tmpHeaders[$key])){
                    $tmpHeaders[$key][] = $value;
                }else{
                    $tmp = $tmpHeaders[$key];
                    $tmpHeaders[$key] = array(
                        $tmp,
                        $value
                    );
                }
            }else{
                $tmpHeaders[$key] = $value;
            }
        }
        return $tmpHeaders;
    }

    /**
     * 处理cookie
     */
    protected function parseCookie()
    {
        $count = preg_match_all('/set-cookie\s*:\s*([^\r\n]+)/i', $this->headerContent, $matches);
        for($i = 0; $i < $count; ++$i)
        {
            $list = explode(';', $matches[1][$i]);
            $count2 = count($list);
            if(isset($list[0]))
            {
                list($cookieName, $value) = explode('=', $list[0], 2);
                $cookieName = trim($cookieName);
                $this->cookies[$cookieName] = array('value'=>$value);
                for($j = 1; $j < $count2; ++$j)
                {
                    $kv = explode('=', $list[$j], 2);
                    $this->cookies[$cookieName][trim($kv[0])] = isset($kv[1]) ? $kv[1] : true;
                }
            }
        }
    }

    /**
     * 返回当前会话最后一次错误的字符串
     * @return string
     */
    public function error()
    {
        return curl_error($this->handler);
    }

    /**
     * 返回最后一次的错误代码
     * @return int
     */
    public function errno()
    {
        return curl_errno($this->handler);
    }
}