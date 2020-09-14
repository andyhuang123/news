<?php

namespace App\Http\Controllers\home;

use App\Http\Requests\StoreArticleMsgPost;
use App\Models\BlogMessage;
use App\Models\BlogNavArticle;
use App\Models\Favorites; 
use App\Models\User;  
use App\Models\BlogSubscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\sendModel;
use App\Events\OrderEvent; 
use Illuminate\Support\Facades\Event; 
use Illuminate\Support\Facades\DB;
use App\Services\TaobaoService;

class ArticleDetailController extends Controller
{
    
    /**
     * 文章详情
     */
    public function index(Request $request)
    {
        $a_id           = $request->route('aid');
        
        $articleModel   = new BlogNavArticle();
          
        $article_result = $articleModel::find($a_id); 
        
        if(!$article_result){
            return view('error.404');
        }
        
        //获取上一篇文章
        $previousPostID = $articleModel::where('article_show', 1)->where('nav_id', $article_result->nav_id)->where('id', '<', $a_id)->max('id');
        
        $previousPostID = empty($previousPostID) ? $a_id : $previousPostID;
        
        //获取下一篇文章
        $nextPostID = $articleModel::where('article_show', 1)->where('nav_id', $article_result->nav_id)->where('id', '>', $a_id)->min('id');
        
        $nextPostID = empty($nextPostID) ? $a_id : $nextPostID;
        
        //获取本篇文章url
        $article_url = url()->current();
        //获取本篇文章所属留言
        $article_message = BlogMessage::with('owner')->where('foreign_id', $a_id)->orderBy('id', 'desc')->paginate(6);
         
        //获取留言的背景色
        $bg_arr = define_background();
        //获取徽章颜色
        $badge_arr = define_badge_color();
         
        //监听阅读量
        Event::dispatch(new OrderEvent($article_result));
        
        //是否收藏
         if (session('uid')) { // 未登录的话，跳到登录页
            $uid = session('uid');
            $user = User::where('token',$uid)->first();
            $favorite = new Favorites();
            $arctle = $favorite::where(['user_id'=>$user->id,'article_id'=>$a_id])->first();
            
            if($arctle){
                $is_favorit = true;
            }else{
                $is_favorit = false; 
            }
         }else{
             $is_favorit = false; 
         }
         //推荐 ::inRandomOrder()
         $recommend_article = $articleModel::where(['article_show'=> 1,'tag'=>'blog'])->orderBy(DB::raw('RAND()'))->take(5)->get();
         //ads
         $page = rand(1,15); 
         $taobao = new TaobaoService;
         $ads = $taobao->hotwuliao($page,$pagesiz="4");
         return view('home.article_details.index', compact('article_result', 'article_url', 'badge_arr', 'previousPostID', 'nextPostID', 'article_message', 'bg_arr','is_favorit','recommend_article','ads'));
    }

    /**
     * 文章留言
     */
    public function article_msg(StoreArticleMsgPost $request)
    {
        if (!session('uid')) { // 未登录的话，跳到登录页
           $result = array(
                'status' => -1,
                'msg'    => '未登录'
            );
            return response()->json($result);
        }
        $uid = session('uid');
        $user = User::where('token',$uid)->first();
        $msg_content                 = $request->msg_content;
        $msg_blog_name               = "来自php漫游指南";
        $msg_blog_link               = "http://www.seedblog.cn";
        $msg_blog_contact            = "356300546";
        $msg_type                    = $request->msg_type;
        $foreign_id                  = $request->foreign_id;
        $user_id                    = $user->id;
        $msgIp = BlogMessage::where('msg_ip', $request->getClientIp())->whereBetween('created_at',[date('Y-m-d'),date('Y-m-d 23:59:59')])->count();
        if($msgIp > 6){
            $result = array(
                'status' => 0,
                'msg'    => '由于经常遇到恶意留言，特此每个ip限制每日留言数量为6条，十分抱歉。'
            );
            return response()->json($result);
        }

        $blogModel                   = new BlogMessage();
        $blogModel->msg_content      = $msg_content;
        $blogModel->msg_blog_name    = $msg_blog_name;
        $blogModel->msg_blog_link    = $msg_blog_link;
        $blogModel->msg_blog_contact = $msg_blog_contact;
        $blogModel->msg_ip           = $request->getClientIp();
        $blogModel->msg_show         = 1;
        $blogModel->msg_type         = $msg_type;
        $blogModel->foreign_id       = $foreign_id;
        $blogModel->user_id       = $user_id; 
        $blogModel->save();
        //获取留言的背景色
        $bg_arr = define_background();
        if ($msg_type == 3) {
            $mas_div = '<div class="card" data-background="color" data-color="' . $bg_arr[rand(0, 5)] . '"><div class="card-body"><div class="author"><a href="' . $msg_blog_link . '" target="_blank"><img src="' . asset(__STATIC_HOME__) . '/assets/img/qqhead.png" alt="..." class="avatar img-raised"><span>' . $msg_blog_name . '</span></a></div><span class="category-social pull-right"><i class="fa fa-quote-right"></i></span><div class="clearfix"></div><p class="card-description">“' . $msg_content . '”</p></div></div>';
        } else {
            $mas_div = '<div class="col-sm-12 ml-auto"><div class="card" data-background="color" data-color="' . $bg_arr[rand(0, 5)] . '"><div class="card-body"><div class="author"><a href="' . $msg_blog_link . '" target="_blank"><img src="' . asset(__STATIC_HOME__) . '/assets/img/qqhead.png" alt="..." class="avatar img-raised"><span>' .  $user->username . '</span></a></div><span class="category-social pull-right"><i class="fa fa-quote-right"></i></span><div class="clearfix"></div><p class="card-description">“' . $msg_content . '”</p></div></div></div>';
        }
        $result = array(
            'status' => 1,
            'msg'    => '留言成功',
            'result' => $mas_div
        );
        return response()->json($result);
    }
    
    
    /**
     * 点赞
     * */
     public function article_like(Request $request){ 
         $id = $request->input('id');
         $articleModel   = new BlogNavArticle();
         $info = $articleModel::find($id);
         if($info){
            $info->increment('goodlike',1);
            if($info->goodlike >100){
                $info->goodlike = "100+";
            }
            $result = array(
                'status' => 1,
                'msg'    => '点赞成功', 
                'goodlike'=> $info->goodlike
            );
              
         }else{
             $result = array(
                'status' => 0,
                'msg'    => '点赞失败'
            ); 
         }
         
       
        return response()->json($result);
         
     }
     
     /**
      *收藏文章 
      * 
      */
      public function article_favorite(Request $request){ 
          
           if(!session('uid')) {
               $result = array(
                    'status' => -1,
                    'msg'    => '未登录'
                );
                return response()->json($result);
            }
            
            $id = $request->input('id');
            
            $favorite = new Favorites();
            $uid = session('uid');
            $user = User::where('token',$uid)->first();
            $arctle = $favorite::where(['user_id'=>$user->id,'article_id'=>$id])->first();
            if(!$arctle){
                $favorite->create([
                  'user_id' => $user->id,
                  'article_id'=> $id
                ]);
                
                $result = array(
                        'status' => 1,
                        'msg'    => '收藏成功'
                );
            }else{
                $result = array(
                        'status' => 0,
                        'msg'    => '已经收藏'
                );
            }
            
            return response()->json($result);
          
      }
      
      /**
       * 
       * 订阅
       * 
       * */
       public function article_sub(Request $request){
            if(!session('uid')) {
               $result = array(
                    'status' => -1,
                    'msg'    => '未登录'
                );
                return response()->json($result);
            }
             
          
            $uid = session('uid');
            $user = User::where('token',$uid)->first();
            if($user->email){
                   
                    $blogModel           = new BlogSubscribe();
                    $info = $blogModel->where('email',$user->email)->first();
                    if($info){
                         $result = array(
                            'status' => 0,
                            'msg'    => '已经订阅',
                            'result' => []
                        ); 
                    }else{
                        $blogModel->email    = $user->email;
                        $blogModel->ip       = $request->getClientIp();
                        $blogModel->is_pass  = 1;
                        $blogModel->add_mode = 1;
                        $blogModel->save();
            
                        $result = array(
                            'status' => 1,
                            'msg'    => '订阅成功',
                            'result' => []
                        ); 
                    }
                    
                    
                    
            }else{
                    $result = array(
                        'status' => 0,
                        'msg'    => '订阅失败',
                        'result' => []
                    );
            }
             
            return response()->json($result);
    }
    

}
