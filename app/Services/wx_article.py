import requests
from bs4 import BeautifulSoup
import urllib.request
import time
import os
import urllib.error

class download(object):
    def __init__(self):
        self.chapter_name = []
        self.href_list = []
        self.head = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3493.3 Safari/537.36',
            'Accept': '*/*',
            'connection': 'keep-alive',
            'accept-encoding': 'zip, deflate, br',
            'accept-language': 'zh-CN,zh;q=0.9'
        }

    def get_url(self):
        for i in range(1):
            url = 'https://blog.csdn.net/rlnLo2pNEfx9c/article/list/%s' % (i + 1)
       
            strhtml = requests.get(url, params='html',headers=self.head)
           
            soup = BeautifulSoup(strhtml.content, 'lxml')

            data = soup.select("main div.article-list > div.article-item-box > h4 > a[href]") 
            # print(data)
            # exit();  
            for item in data: 
                result = {
                    'title': item.get_text().strip()[18:-1],
                    'URL': item.get('href'),
                    # 'URL' : re.findall('\d+',item.get('href'))
                }
                self.chapter_name.append(result.get('title'))
                self.href_list.append(result.get('URL'))

    def readSigleArticle(self,herf):
        if(herf=='https://blog.csdn.net/yoyo_liyy/article/details/89485805'):
            self.href_list.remove(herf)
        else:
            try:
                req = urllib.request.Request(herf)
                urllib.request.urlopen(req)

                singleURL = herf

                strhtml = requests.get(singleURL, params='html',headers=self.head)
                
                soup = BeautifulSoup(strhtml.content, 'lxml')
               
                data = soup.find('div', id='article_content')
                
                # print(data.text) 
                # exit() 
                return str(data.text)
                

            except urllib.error.HTTPError:
                print(herf+ '=访问页面出错')
                time.sleep(2)
            except urllib.error.URLError:
                print(herf + '=访问页面出错')
                time.sleep(2)

    def write(self,strd,num):
        folder_path = './CSDN'
       
        if os.path.exists(folder_path) == False:
            os.makedirs(folder_path)
       
        path = folder_path+'/{}'.format(num)
        txtPath = path + '/{}'.format(num) + '.txt'
        print(num)
        # exit()
        if os.path.exists(path) == False:
            os.makedirs(path)
            open(txtPath, 'w')
            
        with open(txtPath, 'a', encoding='utf-8') as f: 
                f.write(strd) 
                

if __name__ == '__main__':
    dl = download()
    dl.get_url()
    i = 0
    for url in dl.href_list: 
         i = i + 1 
         strd = dl.readSigleArticle(url) 
         dl.write(strd,i)