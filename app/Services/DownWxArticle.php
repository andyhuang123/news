<?php
namespace App\Services;
 
// use zgldh\QiniuStorage\QiniuStorage;

/**
 *  
 * 微信公众号文章采集类
 * 
 */
class DownWxArticle
{
    private $mpwxurl = 'http://mp.weixin.qq.com';
    private $wxgzherr= '公众号二维码下载失败=>';
    private $wximgerr= '图片下载失败=>';
    private $direrr  = '文件夹创建失败！';
    private $fileerr = '资源不存在！';
    private $dirurl  = '';

    /* 抓取微信公众号文章
     * $qcode    boolean 公众号二维码 false=>不下载 true=>下载
     * return
     * $content  string  内容
     * $tile     string  标题
     * $time     int     时间戳
     * $wxggh    string  微信公众号
     * $wxh      string  微信号
     * $qcode    string  公众号二维码
     * $tag      string  标签 原创
     */

    public function get_file_article($url, $dir='', $qcode=false)
    {
        $this->dirurl = $dir ? : public_path().'/uploads/'.date('Ymd', time()); 
        if (!$this->put_dir($this->dirurl)) {
            exit(json_encode(array('msg'=>$this->direrr,'code'=>500)));
        }
        $file = file_get_contents($url);
        dd($file);
        if (!$file) {
            $this->put_error_log($this->dirurl, $this->fileerr);
            exit(json_encode(array('msg'=>$this->fileerr,'code'=>500)));
        }
       
        // 内容主体 <div class="rich_media_content " id="js_content" style="visibility: visible;">
        #preg_match('/<div class="rich_media_content " id="js_content">[\s\S]*?<\/div>/', $file, $content);
        preg_match('/<div class="rich_media_content " id="js_content" style="visibility: visible;">[\s\S]*?<\/div>/', $file, $content);
        dd($content);
        // 标题
        preg_match('/<title>(.*?)<\/title>/', $file, $title);
        $title = $title?$title[1]:'';
        // 时间
        preg_match('/<em id="post-date" class="rich_media_meta rich_media_meta_text">(.*?)<\/em>/', $file, $time);
        $time = $time?strtotime($time[1]):'';
        // 公众号
        preg_match('/<a class="rich_media_meta rich_media_meta_link rich_media_meta_nickname" href="##" id="post-user">(.*?)<\/a>/', $file, $wxgzh);
        $wxgzh = $wxgzh?$wxgzh[1]:'';
        // 微信号
        preg_match('/<span class="profile_meta_value">([\s\S]*?)<\/span>/', $file, $wxh);
        $wxh   = $wxh?$wxh[1]:''; 
        // 获取标签
        preg_match('/<span id="copyright_logo" class="rich_media_meta meta_original_tag">(.*?)<\/span>/', $file, $tag);
        $tag = $tag?$tag[1]:'';
        // 图片
        /* preg_match_all('/<img.*?data-src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg|\.?]))[\'|\"].*?[\/]?>/', $content[0], $images);*/
        dd($content);
        preg_match_all('/<img.*?data-src=\"(.*?)\"(.*?)>/is', $content[0], $images);
        // 储存原地址和下载后地址 
        $old = array();
        $new = array(); 
        // 去除重复图片地址
        $images = array_unique($images[1]);
        if ($images) {
            foreach ($images as $v) {
                $filename = $this->put_file_img($this->dirurl, $v);
                if ($filename) {
                    // 图片保存成功 替换地址
                    $old[] = $v;
                    $new[] = $filename;
                } else {
                    // 失败记录日志
                    $this->put_error_log($this->dirurl, $this->wximgerr.$v);
                }
            }
            $old[] = 'data-src';
            $new[] = 'src'; 
            $content = str_replace($old, $new, $content[0]);
        }

        // 替换音频
        $content = str_replace("preview.html", "player.html", $content);
       
        //替换背景图url 
        preg_match_all( '|url\((.*)\)|U', $content, $backimg); 
        $old_one = array();
        $new_one = array();
        // 去除重复图片地址
        $backimg = array_unique($backimg[1]); 
        if ($backimg) {
            foreach ($backimg as $v) {
                $filename = $this->put_file_img($this->dirurl, $v);
                if ($filename) {
                    // 图片保存成功 替换地址
                    $old_one[] = $v;
                    $new_one[] = $filename;
                } else {
                    // 失败记录日志
                    $this->put_error_log($this->dirurl, $this->wximgerr.$v);
                }
            } 
            $old_one[] = 'url';
            $new_one[] = 'url'; 
            $content = str_replace($old_one, $new_one, $content);
        } 
        $data = array('content'=>$content,'title'=>$title,'time'=>$time,'wxgzh'=>$wxgzh,'wxh'=>$wxh,'qcode'=>$qcode?:'','tag'=>$tag?:'');
        
        return $data;
    }
    /* 抓取保存图片函数
     * return
     * $filename  string  图片地址
     */
    public function put_file_img($dir='', $image='')
    {
        // 判断图片的保存类型 截取后四位地址
        $exts = array('jpeg','png','jpg'); 
          
        $filename = uniqid().time().rand(10000, 99999); 
        $fileurl = $dir.'/'.$filename;
        $ext = substr($image, -5);
        $ext = explode('=', $ext);
        $num = count($ext);
        if($num>1){
            if (in_array($ext[1], $exts) !== false) {
                $filename .= '.'.$ext[1];
            } else {
                $filename .= '.gif';
            } 
            $souce = file_get_contents($image);  
            // // //七牛上传
            // $disk = QiniuStorage::disk('qiniu'); 
            // // 重命名文件
            // $show = $disk->exists('wx_image_'.$filename);
            // //判断文件是否存在 
            // if(!$show){
            //     // 上传到七牛
            //     $bool = $disk->put('wx_image_'.$filename,$souce);
            //     // 判断是否上传成功
            //     if ($bool) {
            //         $http = $disk->downloadUrl('wx_image_'.$filename);  
            //         return $http;
            //     }else{ 
            //         return false;
            //     }                  
            // }else{
            //     $http = $disk->downloadUrl('wx_image_'.$filename);  
            //     return $http;
            // }
            // if (file_put_contents($filename, $souce)) { 
            //     $arr =  explode('public/',$filename);
            //     $url = Article::rand_domain_new(2);
            //     $http =  'http://'.$url['data'].'/'.$arr[1]; 
            //     return $http;
            // } else {
            //     return false;
            // }

        }
        
    }
    /* 获取微信公众号文章的【点赞】【阅读】【评论】
     * 方法：将地址中的部分参数替换即可。
     *     1、s?     替换为 mp/getcomment?
     *     2、最后=  替换为 %3D
     * return
     * read_num  阅读数
     * like_num  点赞数
     * comment   评论详情
     */
    public function get_comment_article($url='')
    {
        $url = substr($url, 0, -1);
        $url = str_replace('/s', '/mp/getcomment', $url).'%3D';
        return file_get_contents($url);
    }
    /* 错误日志记录
     * $dir  string  文件路径
     * $data string  写入内容
     */
    public function put_error_log($dir, $data)
    {
        file_put_contents($dir.'/error.log', date('Y-m-d H:i:s', time()).$data.PHP_EOL, FILE_APPEND);
    }
    /* 创建文件夹
     * $dir string 文件夹路径
     */
    public function put_dir($dir='')
    {
        $bool = true;
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0755, TRUE)) {
                $bool = false;
                $this->put_error_log($dir, $this->direrr.$dir);
            }
        }
        return $bool;
    }
}