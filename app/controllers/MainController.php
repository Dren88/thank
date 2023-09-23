<?php


namespace app\controllers;


use app\models\Department;
use System\Controller;
use System\Pagination;

class MainController extends Controller
{
    public function indexAction()
    {
        $thanks = $this->model->getCountThank();
        $title = 'Список тех, кому сказали спасибо';
        $key = 'user_from_id';
        $total = $this->model->getCount();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $pagination = new Pagination($page, PER_PAGE, $total);
        $departments = (new Department())->getAll();
        $this->set(compact( 'thanks', 'departments', 'title', 'key', 'total', 'pagination'));
    }

    public function getThanksAction()
    {
        $thanks = $this->model->getCountThank('user_to_id');
        $title = 'Список поблагодаривших';
        $key = 'user_to_id';
        $this->view = 'index';
        $total = $this->model->getCount();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $pagination = new Pagination($page, PER_PAGE, $total);
        $departments = (new Department())->getAll();
        $this->set(compact( 'thanks', 'departments', 'title', 'key', 'total', 'pagination'));
    }


}