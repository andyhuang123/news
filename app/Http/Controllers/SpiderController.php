<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\MultipleUrlContextLoader;

class SpiderController extends Controller
{
    public function flushOnce()
    {
        $datasUrl = [];
        for ($page = 1; $page < 2; $page++) {
            $datasUrl[] = "http://www.seedblog.cn/?page=$page";
        }
        $loader = new MultipleUrlContextLoader();
        $loader->setUrls($datasUrl);
        $loader->setCookie(config('app.cookie', ''));
        $loader->setUserAgent(config('app.userAgent', ''));
        $loader->setReffer(config('app.reffer', ''));
        $loader->loadContent();
        $unitsUrl = [];
        $fileNames = [];
        $newArtital = 0;
       // dd($loader->getContents());
        foreach ($loader->getContents() as $k => $context) {
            $data = $this->getListFromResult($context);
            dd($data);
            if (false == $data) {
                break;
            }
            foreach ($data['docs'] as $unit) {
                $fileName = $this->getFileName($unit);
                if (file_exists('markdown/' . $fileName)) {
                    continue;
                }
                $unitsUrl[] = $unit['url'];
                $fileNames[] = $fileName;
                $newArtital++;
            }
            if ($newArtital == 0) {
                Log::info('NO UPDATE, PAGE: '.$page.'.');
            } else {
                Log::info('UPDATE: ' . $newArtital . ', PAGE: ' . $page);
            }
        }
        $loader->setUrls($unitsUrl);
        $loader->loadContent();
        foreach ($loader->getContents() as $k => $unit) {
            $context = $this->getMarkdownTextFromResult($unit);
            try {
                file_put_contents('markdown/' . $fileNames[$k], $context);
            } catch (\Exception $e) {
                file_put_contents('markdown/' . hash('sha256', $fileNames[$k]) . '.md' , $context);
            }
        }
    }
    public function getFileName($unit)
    {
        if (is_array($unit)) {
            if (isset($unit['pubtime']) && isset($unit['title'])) {
                $dateInfo = explode(' ', $unit['pubtime']);
                if ('UTF-8' != mb_detect_encoding($unit['title'], mb_detect_order(), false)) {
                    $afterConvert = mb_convert_encoding($unit['title'], 'UTF-8', 'GBK, GB2312, ISO-8859-1, UTF-8');
                } else {
                    $afterConvert = $unit['title'];
                }
                return $dateInfo[0] . ' ' . $unit['title'] . '.md';
            }
        }
        return false;
    }

    public function getMarkdownText($url)
    {
        $context = $this->curlGet($url);
        if (empty($context)) {
            Log::error('[CURL]' . $this->curlError);
            $this->curlError = '';
            return '';
        }
        if ('UTF-8' != mb_detect_encoding($context, mb_detect_order(), false)) {
            $afterConvert = mb_convert_encoding($context, 'UTF-8', 'GBK, GB2312, ISO-8859-1, UTF-8');
        } else {
            $afterConvert = $context;
        }
        if (mb_stripos($afterConvert, '<title>')) {
            $titleStart = mb_substr($afterConvert, mb_stripos($afterConvert, '<title>') + 7, mb_strlen($afterConvert) - mb_stripos($afterConvert, '<title>') - 7);
            $title = mb_substr($titleStart, 0, mb_stripos($titleStart, '</title>'));
        } else {
            $title = 'unknow';
        }
        $m = $afterConvert;
        $dataset = [];
        while ($p = mb_stripos($m, '<p>')) {
            $left = mb_substr($m, 0, $p);
            $right = mb_substr($m, $p + 3, mb_strlen($m) - $p - 3);
            $left = trim(str_ireplace(PHP_EOL, '', str_ireplace('</p>', '', $left)));
            if (mb_substr_count($left, '<') >= 2) {
                $left = mb_substr($left, 0, mb_strpos($left, '<'));
            }
            if (!empty($left)) {
                $dataset[] = $left;
            }
            $m = $right;
        }
        unset($dataset[0]);
        $body = '# ' . $title . PHP_EOL;
        foreach ($dataset as $p) {
            $body .= PHP_EOL . $p . PHP_EOL;
        }
        return $body;
    }

    public function getMarkdownTextFromResult($context)
    {
        if (empty($context)) {
            Log::error('[CURL]' . $this->curlError);
            $this->curlError = '';
            return '';
        }
        if ('UTF-8' != mb_detect_encoding($context, mb_detect_order(), false)) {
            $afterConvert = mb_convert_encoding($context, 'UTF-8', 'GBK, GB2312, ISO-8859-1, UTF-8');
        } else {
            $afterConvert = $context;
        }
        if (mb_stripos($afterConvert, '<title>')) {
            $titleStart = mb_substr($afterConvert, mb_stripos($afterConvert, '<title>') + 7, mb_strlen($afterConvert) - mb_stripos($afterConvert, '<title>') - 7);
            $title = mb_substr($titleStart, 0, mb_stripos($titleStart, '</title>'));
        } else {
            $title = 'unknow';
        }
        $m = $afterConvert;
        $dataset = [];
        while ($p = mb_stripos($m, '<p>')) {
            $left = mb_substr($m, 0, $p);
            $right = mb_substr($m, $p + 3, mb_strlen($m) - $p - 3);
            $left = trim(str_ireplace(PHP_EOL, '', str_ireplace('</p>', '', $left)));
            if (mb_substr_count($left, '<') >= 2) {
                $left = mb_substr($left, 0, mb_strpos($left, '<'));
            }
            if (!empty($left)) {
                $dataset[] = $left;
            }
            $m = $right;
        }
        unset($dataset[0]);
        $body = '# ' . $title . PHP_EOL;
        foreach ($dataset as $p) {
            $body .= PHP_EOL . $p . PHP_EOL;
        }
        return $body;
    }

    public function getList(int $pager = 1, int $pagenum = 8)
    {
        $result = $this->curlGet("http://channel.chinanews.com/cns/cjs/fortune.shtml?pager=$pager&pagenum=$pagenum&_=" . (1000 * time()), config('app.cookie'), config('app.reffer'), config('app.userAgent'));
        if (empty($this->curlError)) {
            $result = ltrim($result, 'specialcnsdata = ');
            $result = mb_substr($result, 0, 1 + mb_strrpos($result, '}'));
            $data = json_decode($result, true);
            if (is_null($data)) {
                Log::error('[JSON_DECODE]' . serialize($result));
            }
            return $data;
        }
        Log::error('[CURL]' . $this->curlError);
        $this->curlError = '';
        return false;
    }

    public function getListFromResult($result)
    {
       
        if (empty($result)) {
            return false;
        }
        $result = ltrim($result, 'specialcnsdata = ');
        $result = mb_substr($result, 0, 1 + mb_strrpos($result, '}'));
        $data = json_decode($result, true);
        dd($data);
        if (is_null($data)) {
            Log::error('[JSON_DECODE]' . serialize($result));
        }
        return $data;
    }

    public function curlGet(string $url, string $cookie = '', string $refer = '', string $ua = '')
    {
        if (is_null($this->curl)) {
            $h = curl_init();
            curl_setopt($h, CURLOPT_AUTOREFERER, true);
            curl_setopt($h, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($h, CURLOPT_FORBID_REUSE, false);
            curl_setopt($h, CURLOPT_FRESH_CONNECT, false);
            curl_setopt($h, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($h, CURLOPT_CONNECTTIMEOUT, 60);
            curl_setopt($h, CURLOPT_DNS_CACHE_TIMEOUT, 60 * 5);
            curl_setopt($h, CURLOPT_MAXCONNECTS, 10);
            curl_setopt($h, CURLOPT_MAXREDIRS, 20);
            curl_setopt($h, CURLOPT_TIMEOUT, 60 * 2);
            curl_setopt($h, CURLOPT_REFERER, 'http://fortune.chinanews.com/');
            curl_setopt($h, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36');
            curl_setopt($h, CURLOPT_HTTPHEADER, ['Content-type: text/html; charset=UTF-8']);
            $this->curl = $h;
        } else {
            $h = $this->curl;
        }
        curl_setopt($h, CURLOPT_URL, $url);
        if (!empty($cookie)) {
            curl_setopt($h, CURLOPT_COOKIE, $cookie);
        }
        if (!empty($refer)) {
            curl_setopt($h, CURLOPT_REFERER, $refer);
        }
        if (!empty($ua)) {
            curl_setopt($h, CURLOPT_USERAGENT, $ua);
        }
        $data = curl_exec($h);
        if (false === $data) {
            $this->curlError = curl_error($h);
        }
        return $data;
    }
}
