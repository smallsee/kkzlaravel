<?php
namespace App\Repositories\Eloquent;
use App\Category;


class CategoryRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Category::class;
    }


    public function deleteCategory($id){
        $category = $this->model->where('parent_id',$id)->first();

        if ($category) {
            return 0;
        }else{
            return 1;
        }
    }

    public function updateCategory(array $attributes) {


        $category = $this->model->where('parent_id',$attributes['id'])->first();

        if ($category) {
            return 0;
        }else{

            $category = $this->model->find($attributes['id']);
            $category->title = $attributes['title'];
            $category->parent_id = $attributes['parent_id'];
            $category->save();

            return $category;
        }
    }

    public function getTree($data, $pid=0){
        $arr = [];
        if (empty($data)){
            return '';
        }
        foreach ($data as $key => $v){
            if ($v['parent_id'] == $pid){
                $arr[] = $v;
                $arr = array_merge($arr,self::getTree($data,$v['id']));
            }
        }
        return $arr;
    }

    public function setPrefix($data, $p = "|---"){
        $arr = [];
        $num = 1;
        $prefix = [0 => 1];
        while($val = current($data)){
            $key = key($data);
            if ($key > 0){
                if ($data[$key -1]['parent_id'] != $val['parent_id']);
                $num++;
            }
            if (array_key_exists($val['parent_id'],$prefix)){
                $num = $prefix[$val['parent_id']];
            }
            $val['title'] = str_repeat($p, $num).$val['title'];
            $prefix[$val['parent_id']] = $num;
            $arr[] = $val;
            next($data);
        }
        return $arr;

    }

    public function getTreeData(){
        $data_array = $this->model->get()->toArray();
        $getTreeData = $this->getTree($data_array);
        return $this->setPrefix($getTreeData);
    }

    public function getTreeDataNo(){
        $data_array = $this->model->get()->toArray();
        $getTreeData = $this->getTree($data_array);
        return $getTreeData;
    }

}