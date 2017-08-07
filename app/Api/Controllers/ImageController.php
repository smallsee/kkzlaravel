<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\ReplyTransformer;
use Dingo\Api\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends BaseController
{
    private $reply;

    public function __construct()
    {
        $reply = new ReplyTransformer();

        $this->reply = $reply;
    }

    public function upload(Request $request){


        $file = $request->file('file');
        $width = $request->input('width',300);
        $height = $request->input('height',300);
        $img = Image::make($file);
        $newName = date('His').mt_rand(100,999).'.jpg';
        $img->resize($width, $height);
        $dirname = base_path().'/public/uploads/'.date('Ymd');
        $dir = iconv("UTF-8", "GBK", $dirname);
        $ImgSrc = $dirname.'/'.$newName;
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
            $img->save($ImgSrc);
        } else {
            $img->save($ImgSrc);
        }
        $returnSrc = asset('').'uploads/'.date('Ymd').'/'.$newName;


        return $this->reply->data(0,$returnSrc);

    }

    public function delete(Request $request){

        $file = base_path().'/public/'.str_replace(asset(''),'',$request->get('file'));


        if (is_file($file)){
            unlink($file);
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(2,'图片删除失败');
        }

    }



}