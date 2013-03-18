<?php

App::uses('AppHelper', 'View/Helper');

class MbTextHelper extends AppHelper {

	function truncate($text, $len, $ending = '...', $exact = true) {
		if (strlen($text) <= $len) {
			return $text;
		} else {
			mb_internal_encoding("UTF-8");
			if (mb_strlen($text) > $len) {
				//$len -= mb_strlen($ending);
				$len = $len -  mb_strlen($ending);
				if (!$exact) {
					$text = preg_replace('/\s+?(\S+)?$/', '', mb_substr($text, 0, $len+1));
				}
				return mb_substr($text, 0, $len).$ending;
			} else {
				return $text;
			}
		}
	}

}
