<?php
class Attachment extends AppModel {

    public $actsAs = array(
        'Upload.Upload' => array(
            'photo_user' => array(
                'thumbnailSizes' => array(
                    'thumb150' => '150x150',
                    'thumb80' => '80x80',
                ),
                'thumbnailMethod' => 'php',
                'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size'),
                //'mimetypes' => array('image/jpeg', 'image/gif', 'image/png'),
                //'extensions' => array('jpg', 'jpeg', 'JPG', 'JPEG', 'gif', 'GIF', 'png', 'PNG'),
                //'maxSize' => 2097152, //32MB
            ),
            'photo_menu' => array(
                'thumbnailSizes' => array(
                    'thumb' => '100x100'
                ),
                'thumbnailMethod' => 'php',
                'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size')
            ),
        ),
    );


    public $belongsTo = array(
        'Idea' => array(
            'className' => 'Idea',
            'foreignKey' => 'foreign_key',
        ),
    );
}
