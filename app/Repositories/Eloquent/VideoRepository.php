<?php
namespace App\Repositories\Eloquent;
use App\Akira;
use App\Tag;
use App\Video;
use App\VideoAkira;
use App\VideoFile;
use App\VideoTag;

class VideoRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Video::class;
    }

    public function createVideoWithOther(array $attributes){

        $akiras = $attributes['akira'];
        $tags = $attributes['tag'];
        $files = $attributes['files'];
        $is_new = $attributes['is_new'];

        $video_data = [
            'title' => $attributes['title'],
            'thumb' => $attributes['thumb'],
            'introduction' => $attributes['introduction'],
            'episodes' => count($files) ? count($files) : '未知集数',
            'language' => $attributes['language'],
            'version' => 'TV版',
            'address' => $attributes['address'],
            'is_new' => $is_new ? 1 : 0,
            'update_date' => $is_new ? $attributes['update_date'] : '未知时间',
            'status' => 1,
            'issue_date' => $attributes['issue_date'],
            'tag' => implode(',',$tags),
            'akira' => implode(',',$akiras),
        ];

        $video  = $this->model->create($video_data);

        foreach ($tags as $tag){
            $tag_id = Tag::where('name', $tag)->first()->id;
            $video_tag = VideoTag::firstOrCreate([
                'tag_id' =>  $tag_id,
                'video_id' =>  $video->id
            ]);
        }

        foreach ($akiras as $akira){
            $akira_id = Akira::where('name', $akira)->first()->id;
            $video_akira = VideoAkira::firstOrCreate([
                'akira_id' =>  $akira_id,
                'video_id' =>  $video->id
            ]);
        }
        foreach ($files as $file){
                VideoFile::firstOrCreate([
                    'file_name' =>  $file['file_name'],
                    'file_url' =>   $file['file_url'],
                    'file_thumb' =>  asset('').'images/default.png',
                    'video_id' => $video->id
                ]);
        }

        return $video;
    }


    public function updateVideoWithOther(array $attributes) {
        $akiras = $attributes['akira'];
        $tags = $attributes['tag'];
        $files = $attributes['files'];
        $is_new = $attributes['is_new'];

        $video = $this->model->find($attributes['id']);

        $video_data = [
            'title' => $attributes['title'],
            'thumb' => $attributes['thumb'],
            'introduction' => $attributes['introduction'],
            'episodes' => count($files) ? count($files) : '未知集数',
            'language' => $attributes['language'],
            'version' => 'TV版',
            'address' => $attributes['address'],
            'is_new' => $is_new ? 1 : 0,
            'update_date' => $is_new ? $attributes['update_date'] : '未知时间',
            'status' => 1,
            'issue_date' => $attributes['issue_date'],
            'tag' => implode(',',$tags),
            'akira' => implode(',',$akiras),
        ];

        $video->update($video_data);


        VideoTag::where('video_id',$video->id)->delete();
        VideoAkira::where('video_id',$video->id)->delete();
        VideoFile::where('video_id',$video->id)->delete();

        foreach ($tags as $tag){
            $tag_id = Tag::where('name', $tag)->first()->id;
            $video_tag = VideoTag::firstOrCreate([
                'tag_id' =>  $tag_id,
                'video_id' =>  $video->id
            ]);
        }

        foreach ($akiras as $akira){
            $akira_id = Akira::where('name', $akira)->first()->id;
            $video_akira = VideoAkira::firstOrCreate([
                'akira_id' =>  $akira_id,
                'video_id' =>  $video->id
            ]);
        }
        foreach ($files as $file){
            VideoFile::firstOrCreate([
                'file_name' =>  $file['file_name'],
                'file_url' =>   $file['file_url'],
                'file_thumb' =>  asset('').'images/default.png',
                'video_id' => $video->id
            ]);
        }


        return $video;



    }

    public function findById($id)
    {
        $video = $this->model->find($id);
        $video->increment('see');
        return $video;
    }

    public function findHotAll(){
        return $this->model->orderBy('see','desc')->take(10)->get();
    }


    public function findLikeTitle($title){
        return $this->model->where('title','like','%'.$title.'%')->get();
    }


}