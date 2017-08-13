<?php
namespace App\Repositories\Eloquent;


use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Container\Container as App;

abstract class Repository implements RepositoryInterface {

//    App容器
    protected $app;

    /*操作model*/
    protected $model;

    public function __construct(App $app) {
        $this->app = $app;
        $this->makeModel();
    }

    abstract function model();



    /**
     * 作用： 根据传入的数组创建表
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $model = new $this->model;
        return $model->create($attributes);
    }

    /**
     * 作用：根据ID选择对应值
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * 作用：找寻全部
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }


    /**
     * 作用：根据ID讲状态值更改为0
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteById($id){
        $data = $this->model->find($id);
        $data->status = 0;
        $data->save();
        return response()->json(true);
    }


    /**
     * 作用：根据传进来的ID和数组更改值
     * @param $id
     * @param array $attributes
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $attributes){
        $data = $this->findById($id);
        $data->update($attributes);
        return response()->json(true);
    }

    /**
     * 作用：传值找对应的数据表
     * @param $name
     * @param $data
     * @return mixed
     */
    public function findOne($name,$data){
        return $this->model->where($name,$data)->first();
    }

    public function createCommit($attributes){
        $model = new $this->model;
        return $model->create($attributes);
    }

    public function makeModel(){
        $model = $this->app->make($this->model());
        /*是否是Model实例*/
        $this->model = $model;
    }


}