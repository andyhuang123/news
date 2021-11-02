<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\StoreBlogSubscribePost;
use App\Models\BlogMessage;
use App\Models\BlogSubscribe;
use App\Models\BlogTag;
use App\Models\BlogNav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogNavArticle;
use App\Models\BlogNotice;
use Illuminate\Support\Facades\DB;
use App\Events\TagEvent; 
use Illuminate\Support\Facades\Event;
use App\Services\TaobaoService;
use Illuminate\Support\Facades\Cache; 

class ArticleController extends Controller
{
    
    public function __construct(Request $request)
    {
        $a_id   = $request->route('nav_id');
        if($a_id ==39){
            $this->middleware('auth');
        }
       
    }
    public function index(Request $request)
    {
        $random_article = [];
        
        $show_article   = []; 
        
        $nav_id       = $request->route('nav_id');
        
        $search_title = $request->input('search_title');
        
        $tag_content  = $request->input('tag_content');
        
        $orderby       = $request->input('order');
        
        $page  = $request->input('page') ? $request->input('page') : 1 ;
        
        $article_model = new BlogNavArticle();
       
        $tagModel      = new BlogTag();

        $where_all_article = array(
            ['article_show', '=', 1]
        );
        if (trim($nav_id)) {
            $where_all_article[] = ['nav_id', '=', $nav_id];
        }
      
        $where_tag = array();
        
        if ($tag_content) {
            //点击标签时，该标签自增1
            $tag_aid = $tagModel::where('tag_content', '=', $tag_content)->pluck('a_id', 'id');
            if ($tag_aid->count()) {
                $where_tag = function ($query) use ($tag_aid) {
                    $query->whereIn('id', $tag_aid->toArray());
                };
                //这里自增标签点击量
                $tag_id = $tag_aid->keys(); 
                $tags = $tagModel::whereIn('id', $tag_id)->get();
                Event::dispatch(new TagEvent($tags));
            }
        }
        $key_ = 'id';
        $value_ = 'desc';
        if($orderby=='recent'){
             $key_ = 'updated_at';
             $value_ = 'desc';
        }else if($orderby=='click'){
            $key_ =  'article_click';
            $value_ = 'desc';
        }else if($orderby=='goodlike'){
            $key_ =  'goodlike';
            $value_ = 'desc';
        }
        $keyword = strip_tags(trim($search_title));

        if(!empty($keyword)){   
            $show_article = BlogNavArticle::search($keyword)->paginate(30); 

        }else{

            $show_article = BlogNavArticle::where($where_all_article)
                            ->where($where_tag)
                            ->orderBy('article_sort', 'desc')
                            ->orderBy('is_top', 'desc') 
                            ->orderBy($key_, $value_)
                            ->paginate(30);  
        }
        
        //判断是否传入所属导航id
        if ($nav_id) {
             $nav = BlogNav::find($nav_id); 
             $nav_title = $nav->nav_title;
            //获取随机4条文章
            $random_article = $article_model::where('article_show', 1)->where('nav_id', $nav_id)->whereRaw("id >= (select floor(rand() * (select max(id) from `blog_nav_article`)))")->take(4)->get();
            //获取热门文章
            $hot_article = $article_model::where('article_show', 1)->where('nav_id', $nav_id)->orderBy('article_click', 'desc')->take(10)->get();
        } else {
            $nav_title = '文章列表';
            //获取随机4条文章
            $random_article = $article_model::where('article_show', 1)->whereRaw("id >= (select floor(rand() * (select max(id) from `blog_nav_article`)))")->take(4)->get();
            //获取热门文章
            $hot_article = $article_model::where('article_show', 1)->orderBy('article_click', 'desc')->take(10)->get();
        }
         
        //获取最新的公告2条
        $notice_model = new BlogNotice();
        $notice_list  = $notice_model::where('notice_show', 1)->orderBy('notice_sort', 'desc')->orderBy('id', 'desc')->take(1)->get();
        //背景颜色
        $background_color = array('blue', 'green', 'blue', 'brown', 'purple', 'orange', 'green', 'orange');
        
        //shuffle($background_color);
        //按钮颜色
        $button_color = array('btn-primary', 'btn-info', 'btn-success', 'btn-danger', 'btn-warning', 'btn-default','btn-danger','btn-success','btn-success','btn-success');
        
        shuffle($button_color);
        //星期数组
        $week_list = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');

        //统计多少次阅读
        $article_click = $article_model::where($where_all_article)->where($where_tag)->sum('article_click');
        //统计留言条数
        $message_model = new BlogMessage();
        $total_msg     = $message_model->count();
        //标签云
        // $tag_result = $tagModel::select(DB::raw('count(a_id) as article_count, FLOOR(0 + (RAND() * 6)) as tag_color,tag_content,sum(tag_click) as sum_click'))
        //                 ->groupBy('tag_content')
        //                 ->orderBy('sum_click', 'desc')
        //                 ->take(50)
        //                 ->get();
        $tag_result= Cache::remember('tag_key_title', 120, function () use($tagModel) {
            return $tagModel::select(DB::raw('count(a_id) as article_count, FLOOR(0 + (RAND() * 6)) as tag_color,tag_content,sum(tag_click) as sum_click'))
                    ->groupBy('tag_content')
                    ->orderBy('sum_click', 'desc')
                    ->take(50)
                    ->get();
        });
        $tag_color  = define_badge_color(); 
        //淘宝客
        $page = rand(1,10);  
      
        // 食品	13375
        // 家居家装	13368	 	 男装	13372	 	 运动户外	13376
        // 数码家电	13369	 	  
        $me_arr = ['13369','13376','13375','13372'];
        $me_id = $me_arr[rand(0,3)]; 
        $tabo = new TaobaoService;    
        $ads = $tabo->getwuliaomax($page,"10",$me_id);   
        if($show_article && empty($tag_content)){  
            
            if(!empty($ads)){  
                $rand_arr = $ads[rand(0,3)];  
                $rand_one = [];
                $rand_one['article_title'] =  $rand_arr->title;
                $rand_one['tag'] =  'ad';
                $rand_one['tag_url'] =  $rand_arr->click_url ?? '';
                $rand_one['ad_img'] =  $rand_arr->pict_url;
                $rand_one['created_at'] =  now();  
                $ad_one = (object)$rand_one;
    
                #指定位置插入数组
                $rand_arr = $ads[rand(4,6)];  
                $rand_three = [];
                $rand_three['article_title'] =  $rand_arr->title;
                $rand_three['tag'] =  'ad';
                $rand_three['tag_url'] =  $rand_arr->click_url ?? '';
                $rand_three['ad_img'] =  $rand_arr->pict_url;
                $rand_three['created_at'] =  now();  
                $ad_two = (object)$rand_three; 

                 #指定位置插入数组
                 $rand_arr = $ads[rand(7,9)];  
                 $rand_four = [];
                 $rand_four['article_title'] =  $rand_arr->title;
                 $rand_four['tag'] =  'ad';
                 $rand_four['tag_url'] =  $rand_arr->click_url ?? '';
                 $rand_four['ad_img'] =  $rand_arr->pict_url;
                 $rand_four['created_at'] =  now();  
                 $ad_last = (object)$rand_four; 
 

            }else{
                $ad_one = [];
                $ad_two = []; 
                $ad_last = []; 
            }

        }else{
            $ad_one = [];
            $ad_two = []; 
            $ad_last = []; 
        }
        if($this->isMobile()){
        //跳转移动端页面
           $ispc = false; 
        }else{
        //跳转PC端页面
           $ispc = true; 
        }
       
        return view('home.article.index', compact('random_article', 'show_article', 'background_color', 'hot_article', 'button_color', 'notice_list', 'week_list', 'search_title', 'tag_result', 'tag_color', 'article_click', 'total_msg','orderby','key_','ads','nav_title','ad_one','ad_two','ad_last','ispc'));    
        
        
    }
    
   
    /**
     * 订阅我
     */
    public function subscribe(StoreBlogSubscribePost $request)
    {
        $email_name          = $request->input('email_name');
        $blogModel           = new BlogSubscribe();
        $blogModel->email    = $email_name;
        $blogModel->ip       = $request->getClientIp();
        $blogModel->is_pass  = 1;
        $blogModel->add_mode = 1;
        $blogModel->save();

        $result = array(
            'status' => 1,
            'msg'    => '订阅成功',
            'result' => []
        );
        return response()->json($result);
    }
 public  function isMobile(){ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
  } 
}
