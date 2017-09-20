<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\HomeVideoTransformer;
use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\VideoTransformer;
use App\Repositories\Eloquent\VideoRepository;
use Dingo\Api\Http\Request;



class VideoController extends BaseController
{

    private $video;
    private $reply;

    public function __construct(VideoRepository $video)
    {
        $this->middleware('jwt.auth')->except(['index','show','homeIndex','homeRecommend','search','hot']);

        $reply = new ReplyTransformer();

        $this->video = $video;
        $this->reply = $reply;
    }



    public function hot(Request $request) {
        $video = $this->video->findHotAll(10);
        $video->load('files','commits');
        if(! $video){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->collection($video, new HomeVideoTransformer())->addMeta('errno', 0);
    }

    public function homeIndex(){


        $video = $this->video->findAll();
        $video->load('files','commits');

        if(! $video){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->collection($video, new HomeVideoTransformer())->addMeta('errno', 0);
    }

    public function homeRecommend(Request $request) {

        $akiraList = $request->get('akiraList');
        $tagList = $request->get('tagList');

        return $video = $this->video->findRecommendAll($tagList, $akiraList);
    }

    public function index() {
        $video = $this->video->findAll();
        $video->load('files','commits');


        if(! $video){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->collection($video, new VideoTransformer())->addMeta('errno', 0);
    }

    public function show($id) {
        $video = $this->video->findById($id);
        $video->load('files','commits');
        if(! $video){
            return $this->reply->error(1,'视频没有数据');
        }

        return $this->response->item($video, new VideoTransformer)->addMeta('errno', 0);
    }

    public function store(Request $request){

        $video = $this->video->createVideoWithOther($request->all());

        if (!$video) {
            $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function destroy($id){

        $video  = $this->video->deleteById($id);

        if ($video){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }

    public function update($id,Request $request){
        $video  = $this->video->updateVideoWithOther($request->all());

        if (!$video) {
            $this->reply->error(3,'修改失败');
        }

        return $this->reply->data(0,'修改成功');
    }


}