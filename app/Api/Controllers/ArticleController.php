<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;


use App\Api\Transformers\ArticleTransformer;
use App\Api\Transformers\ReplyTransformer;
use App\Repositories\Eloquent\ArticleRepository;
use Dingo\Api\Http\Request;

class ArticleController extends BaseController
{

    private $article;
    private $reply;

    public function __construct(ArticleRepository $article)
    {
        $reply = new ReplyTransformer();
        $this->article = $article;
        $this->reply = $reply;
    }

    public function index(){

        $art = $this->article->findAll();
        $art->load('user');
        if(! $art){
            return $this->reply->error(1,'类型没有数据');
        }
        return $this->collection($art, new ArticleTransformer())->addMeta('errno', 0);
    }

    public function store(Request $request){
        $article =  $this->article->createArticleAndTopic($request->all());

        if (!$article) {
            $this->reply->error(3,'添加失败');
        }

        return $this->reply->data(0,'添加成功');
    }

    public function destroy($id){

        $article  = $this->article->deleteById($id);

        if ($article){
            return $this->reply->data(0,'删除成功');
        }else{
            return $this->reply->error(4,'未知原因删除失败');
        }
    }

    public function update($id,Request $request){


        $article  = $this->article->updateArticleAndTopic($request->all());

        if (!$article) {
            $this->reply->error(3,'修改失败');
        }

        return $this->reply->data(0,'修改成功');
    }




}