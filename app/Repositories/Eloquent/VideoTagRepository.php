<?php
namespace App\Repositories\Eloquent;
use App\VideoTag;

class VideoTagRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return VideoTag::class;
    }



}