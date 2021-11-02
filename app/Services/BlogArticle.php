<?php
namespace App\Services;
 
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

/**
 *  
 * 微信公众号文章采集类
 * 
 */
class BlogArticle
{


     public function getcontent($url){

        $client = new Client();
        
        $crawler = $client->request('GET', $url);
        
        $chapter = $crawler->filter('div.article-content')->html();

        return $chapter;

     }

     public function scrapePHPUnitDe($url) {
            $client = new Client();
            $crawler = $client->request('GET', 'https://phpunit.de/manual/current/en/index.html');
            $toc = $crawler->filter('.toc');
            file_put_contents(base_path('resources/docs/').'index.html', $toc->html());

            $crawler->filter('.toc > dt a')->each(function($node) use ($client) {
                $href = $node->attr('href');

                // $this->info("Scraped: " . $href);

                $crawler = $client->request('GET', $href);
                $chapter = $crawler->filter('.col-md-8 .chapter, .col-md-8 .appendix')->html();
                file_put_contents(base_path('resources/docs/').$href, $chapter);
            });
      }

}