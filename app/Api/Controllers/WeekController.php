<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;

use App\Api\Transformers\ReplyTransformer;
use App\Api\Transformers\WeekTransformer;
use App\Repositories\Eloquent\WeekRepository;


class WeekController extends BaseController
{

    private $week;
    private $reply;

    public function __construct(WeekRepository $week)
    {
        $reply = new ReplyTransformer();

        $this->week = $week;
        $this->reply = $reply;
    }

    public function index(){

        $week = $this->week->findAll();


        if(! $week){
            return $this->reply->error(1,'周末没有数据');
        }
        return $this->collection($week, new WeekTransformer())->addMeta('errno', 0);
    }


}