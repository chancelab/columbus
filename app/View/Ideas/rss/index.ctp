<?php

$this->set('channel', array (
	'title' => 'Columbus',
	'link' => '/',
	'description' => 'ChanceLab\'s Idea Manager'
));

echo $this->rss->items($ideas, 'transformRSS');

function transformRSS($ideas) {
	return array(
	'title' => $ideas['Idea']['title'],
	'link' => array('action' => 'view', $ideas['Idea']['id']),
	'guid' => array('action' => 'view', $ideas['Idea']['id']),
	'description' => $ideas['Idea']['body'],
	'pubDate' => $ideas['Idea']['created']
	);
}

?>
