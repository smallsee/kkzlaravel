<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\ReplyTransformer;
use App\Repositories\Eloquent\CategoryRepository;
use Dingo\Api\Http\Request;

class CategoryController extends BaseController
{

    private $category;
    private $reply;

    public function __construct(CategoryRepository $category)
    {
        $reply = new ReplyTransformer();
        $this->category = $category;
        $this->reply = $reply;
    }



    public function index(Request $request){

        $type = $request->get('type','');

        if ($type){
            $category = $this->category->getTreeData();
        }else{
            $category = $this->category->getTreeDataNo();
        }


        if(! $category){
            return $this->reply->error(1,'类型没有数据');
        }
        return $this->reply->data(0,$category);
    }

    public function store(Request $request){

        $category = $this->category->create($request->all());


        if (!$category) {
            $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function update($id,Request $request){


        $category  = $this->category->updateCategory($request->all());


        if ($category) {
            return $this->reply->data(0,'修改成功');
        }
        return $this->reply->error(3,'修改失败或者有子集的父级不能变成等级');

    }

    public function destroy($id){


        $canCategory  = $this->category->deleteCategory($id);


        if ($canCategory){
            $category  = $this->category->deleteByIdTrue($id);
            if ($category){
                return $this->reply->data(0,'删除成功');
            }else{
                return $this->reply->error(4,'未知原因删除失败');
            }

        }else{
            return $this->reply->error(5,'该分类下面还有子类不能删除');
        }
    }



}