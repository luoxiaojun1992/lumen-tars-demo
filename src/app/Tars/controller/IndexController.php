<?php
/**
 * Created by PhpStorm.
 * User: liangchen
 * Date: 2018/5/8
 * Time: 下午2:42.
 */
namespace App\Tars\controller;

use Lxj\Laravel\Tars\Controller;

class IndexController extends Controller
{
    // curl "172.16.0.161:28887/Index/index" -i
    public function actionIndex()
    {
        $this->cookie('key', 1, 10000000, '/', 'www.github.com');
        $this->sendRaw(app('service.demo')->ping());
    }
    // curl "172.16.0.161:28887/Index/testHeader" -i
    public function actionTestHeader()
    {
        $this->header('test', 1111);
    }
    // curl "172.16.0.161:28887/Index/testStatus" -i
    public function actionTestStatus()
    {
        $this->status(401);
    }
    // Get请求
    // curl "172.16.0.161:28887/Index/get?param=1111&c=d&d=e&e=f" -i
    public function actionGet()
    {
        $param = $this->request->data['get']['param'];
        $this->sendRaw('success:'.$param);
    }
    // Post请求
    // curl -d "user=admin&passwd=12345678"  "172.16.0.161:28887/Index/post1" -i
    public function actionPost1()
    {
        // 对于content-type为application/x-www-form-urlencoded 的form data
        $admin = $this->request->data['post']['user'];
        $this->sendRaw('success:'.$admin);
    }
    // Post请求
    //curl -H "Content-Type:application/json" -X POST -d '{"user": "admin", "passwd":"12345678"}' "172.16.0.161:28887/Index/post2" -i
    public function actionPost2()
    {
        // 对于对于content-type为application/json
        $json = $this->request->data['post'];
        $admin = json_decode($json, true)['user'];
        $this->sendRaw('success:'.$admin);
    }
    // Get请求
    // curl -F "image=@profile.jpeg" -F "phone=123456789"  "172.16.0.161:28887/Index/file" -i
    public function actionFile()
    {
        $fileName = $this->request->data['files']['image']['name'];
        $type = $this->request->data['files']['image']['type'];
        $tmp_name = $this->request->data['files']['image']['tmp_name'];
        $size = $this->request->data['files']['image']['size'];
        $this->sendRaw('success:'.var_export($this->request->data['files']['image'], true));
    }
}
