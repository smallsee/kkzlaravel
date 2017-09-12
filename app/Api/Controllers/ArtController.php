<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\ArtTransformer;
use App\Api\Transformers\ReplyTransformer;
use App\Repositories\Eloquent\ArtRepository;
use Dingo\Api\Http\Request;

class ArtController extends BaseController
{

    private $art;
    private $reply;

    public function __construct(ArtRepository $art)
    {
        $reply = new ReplyTransformer();
        $this->art = $art;
        $this->reply = $reply;
    }

    public function index(){

        $art = $this->art->findAll();
        $art->load('user');
        if(! $art){
            return $this->reply->error(1,'类型没有数据');
        }
        return $this->collection($art, new ArtTransformer())->addMeta('errno', 0);
    }

    public function hot(Request $request) {

        $art = $this->art->findHotAll(10);
        $art->load('user');

        if(! $art){
            return $this->reply->error(1,'文章没有数据');
        }

        return $this->collection($art, new ArtTransformer())->addMeta('errno', 0);
    }

    public function store(Request $request){

        $art = $this->art->createArt($request->all());


        if (!$art) {
            $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function show($id) {
        $art = $this->art->findById($id);
        $art->load('user');
        if(! $art){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->response->item($art, new ArtTransformer())->addMeta('errno', 0);
    }

    public function update($id,Request $request){
        $art  = $this->art->updateArt($request->all());

        if (!$art) {
            $this->reply->error(3,'修改失败');
        }

        return $this->reply->data(0,'修改成功');
    }


    public function destroy($id){

        $video  = $this->art->deleteById($id);

        if ($video){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }


}