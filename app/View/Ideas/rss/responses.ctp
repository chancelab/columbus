<?php

$this->set('channel', array (
	'title' => 'Columbus-Responses',
	'link' => '/',
	'description' => 'ChanceLab\'s Idea Manager'
));

echo $this->rss->items($ideaResponses, 'transformRSS');

function transformRSS($ideaResponse){
	return array(
		'title' => $ideaResponse['IdeaResponse']['body'],
		'link' => array('action' => 'view', $ideaResponse['Idea']['id']),
		'guid' => array('action' => 'view', $ideaResponse['Idea']['id']),
		'description' => $ideaResponse['Idea']['title'],
		'pubDate' => $ideaResponse['IdeaResponse']['created']
	);
}

?>
