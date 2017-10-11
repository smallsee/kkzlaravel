<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\ShopTransformer;
use App\Repositories\Eloquent\ShopRepository;
use Dingo\Api\Http\Request;

class ShopController extends BaseController
{

    private $shop;
    private $reply;

    public function __construct(ShopRepository $shop)
    {
        $reply = new ReplyTransformer();
        $this->shop = $shop;
        $this->reply = $reply;
    }



    public function index(){

        $shop = $this->shop->findAll();
        $shop->load('user');

        if(! $shop){
            return $this->reply->error(1,'类型没有数据');
        }
        return $this->collection($shop, new ShopTransformer())->addMeta('errno', 0);
    }

    public function show($id) {
        $shop = $this->shop->findById($id);
        $shop->load('user');
        if(! $shop){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->response->item($shop, new ShopTransformer())->addMeta('errno', 0);
    }

    public function store(Request $request){


        $shop = $this->shop->createShop($request->all());

        if (!$shop) {
            $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function destroy($id){

        $shop  = $this->shop->deleteById($id);

        if ($shop){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }

}