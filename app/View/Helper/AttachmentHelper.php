<?php

App::uses('AppHelper', 'View/Helper');

class AttachmentHelper extends AppHelper {
	public function renderFileTag($obj) {
		$file = $obj['Attachment'];
		$resulet = '';
		$filepath = DS . str_replace(WWW_ROOT, '', $file['dir']) . $file['name'];
		switch($file['type']) {
			case 'image/jpeg':
			case 'image/png':
			case 'image/gif':
			case 'image/bmp':
				$result = '<a class="attachfile img" id="attach_' . $file['id'] . '" href="' . $filepath . '" target="_blank"><img class="thumbnail" src="' . $filepath . '"></a>';
				break;
			case 'video/avi':
			case 'video/mpeg':
			case 'video/mpg':
			case 'video/mp4':
			case 'video/mp2':
			case 'video/quicktime':
			case 'video/x-msvideo':
				$result = '<video class="attachfile mov" controls preload="none" id="attach_' . $file['id'] . '" src="' . $filepath . '"></video>';
				break;
			default:
				$result = '<a class="attachfile default" id="attach_' . $file['id'] . '" href="' . $filepath . '" target="_blank"><img class="thumbnail" src="' . Router::url('/', true) . 'img/etc_file_icon.jpg" /><br />'. $file['name'] . '</a>';
				break;
		}

		return $result;
	}
}
