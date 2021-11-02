<?php
/**
 * Created by PhpStorm.
 * User: 10922
 * Date: 2019/2/10
 * Time: 0:09
 */

namespace App\Traits;

trait CheckWx {

	public $client;

	public function ininClient() {

		$this->client = curl_init();
		curl_setopt_array($this->client, [
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_TIMEOUT => 5,
		]);
	}

	public function dealDomain($url) {
		if (stripos($url, '{random}') !== false) {
			$seg = array_reverse(explode('.', $url));
			$n_a = [];
			foreach ($seg as $item) {
				if (stripos($item, '{random}') !== false) {
					break;
				}

				$n_a[] = $item;
			}
			return implode('.', array_reverse($n_a));
		}
		return $url;
	}

	public function httpGet($url) {

		curl_setopt($this->client, CURLOPT_URL, $url);

		return curl_exec($this->client);
	}

	public function isOk($url) {
		$url = $this->dealDomain($url);
		$this->info($url);

		$result = $this->httpGet('http://api.monkeyapi.com/?appkey=7DD50096E7046A9B49A1F926E3413D82&url=' . $url);
		$result = json_decode($result, true);

		$this->info(implode("\n", $result));

		if (isset($result['code']) && $result['data'] == 2) {
			return false;
		}
		return true;
	}
}