<?php
define("__STATIC_HOME__","/static/home");
define("__STATIC_SHOP__","/static/shop");
define("__STATIC_UPLOADS__","/uploads");
/**
 * Desc:处理文件是本地上传还是七牛云上传的路径
 * Date:2019/11/6/006
 */
 
function processing_files($file_src){
    $new_src = '';
    if(env('UPLOAD_TYPE') == 'admin'){
        $new_src = asset(__STATIC_UPLOADS__.'/'.$file_src);
    }elseif(env('UPLOAD_TYPE') == 'qiniu'){
        $file_setting = config('filesystems');
        $new_src = 'http://'.$file_setting['disks']['qiniu']['domains']['default'].'/'.$file_src;
    }
    return $new_src;
}

/**
 * 递归无限级分类
 */
function modelTree($tree,$pid = 0,$level = 0){
    if(count($tree) == 0){
        return [];
    }
    $arr = [];
    foreach ($tree as $k => $v) {
        if($v['nav_pid'] == $pid){
            $v['level'] = $level;
            $arr[$v['id']] = $v;
            $temp_arr = modelTree($tree,$v['id'],$level+1);
            $arr  = array_merge($arr,$temp_arr);
        }
    }
    return $arr;
}

/**
 * 定义的背景色数组
 */
function define_background(){
    $bg = array('purple','orange','brown','yellow','green','blue');
    shuffle($bg);
    return $bg;
}

/**
 * Desc:定义徽章颜色
 * Date:2019/9/27/027
 */
function define_badge_color(){
    $bg = array('primary','info','success','warning','danger','default');
    shuffle($bg);
    return $bg;
}

/**
 * 转换日期，比如2019-09-21 11:54:53,只显示2019-09-21
 */
function date_conversion($old_data){
    $old_time = strtotime($old_data);
    return $new_time = date('Y-m-d',$old_time);
}

function category_nav_active($category_id)
{
    return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}

function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return Str::limit($excerpt, $length);
}

function model_admin_link($title, $model)
{
    return model_link($title, $model, 'admin');
}

function model_link($title, $model, $prefix = '')
{
    // 获取数据模型的复数蛇形命名
    $model_name = model_plural_name($model);

    // 初始化前缀
    $prefix = $prefix ? "/$prefix/" : '/';

    // 使用站点 URL 拼接全量 URL
    $url = config('app.url') . $prefix . $model_name . '/' . $model->id;

    // 拼接 HTML A 标签，并返回
    return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
}

function model_plural_name($model)
{
    // 从实体中获取完整类名，例如：App\Models\User
    $full_class_name = get_class($model);

    // 获取基础类名，例如：传参 `App\Models\User` 会得到 `User`
    $class_name = class_basename($full_class_name);

    // 蛇形命名，例如：传参 `User`  会得到 `user`, `FooBar` 会得到 `foo_bar`
    $snake_case_name = Str::snake($class_name);

    // 获取子串的复数形式，例如：传参 `user` 会得到 `users`
    return Str::plural($snake_case_name);
}
/**
 * 日历从星期日开始，通过确定每月第一天所在的星期，计算前后日期。
 *
 * @param Request $request
 * @return void
 */
function calendar(Request $request)
{
    //获取年
    $year = $request->input('year', now()->year);
    //获取月份
    $month     = $request->input('month', now()->month);
    $yearMonth = sprintf("%d-%s", $year, $month);
    //获取月份第一天所在的星期
    $firstDayOfWeek = Carbon::parse("$yearMonth-01")->dayOfWeek;

    //补全
    $day      = 0;
    $calendar = [];
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 7; $j++) {
            if ($firstDayOfWeek != 0 and $i == 0) {
                //根据月初第一天所在的星期，计算出之前几天的日子
                $day  = Carbon::parse("$yearMonth-01")->subDays($firstDayOfWeek - $j)->day;
                $date = Carbon::parse("$yearMonth-01")->subDays($firstDayOfWeek - $j)->format("Y-m-d");
            } else {
                $day++;
                $date = Carbon::parse("$yearMonth-01")->addDays($day - 1)->format("Y-m-d");
            }
            $calendar[$i][] = $date;
        }
    }

    return $calendar;
} 
/**
 * 将$data 插入关联数组 $array 的键名为 $key 的 Key 之前
 */
function wpjam_array_push($array, $data=null, $key=false){
    $data  = (array)$data;
    $offset  = ($key===false)?false:array_search($key, array_keys($array));
    $offset  = ($offset)?$offset:false;
    if($offset){
      return array_merge(
        array_slice($array, 0, $offset),
        $data,
        array_slice($array, $offset)
      );
    }else{  // 没指定 $key 或者找不到，就直接加到末尾
      return array_merge($array, $data);
    }
  }