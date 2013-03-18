<?php
App::uses('AppController', 'Controller');
class AdminController extends AppController {
    public $name = 'Admin';

    public function index() {
        $this->render("menu");
    }

}
