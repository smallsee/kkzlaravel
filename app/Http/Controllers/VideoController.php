<?php

namespace App\Http\Controllers;

use App\Akira;
use App\Tag;
use App\Video;
use App\VideoAkira;
use App\VideoFile;
use App\VideoTag;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    //
    public function mysql(){
        $json_string = file_get_contents('articleexport.json');

// 把JSON字符串转成PHP数组
        $data = json_decode($json_string, true);
        foreach ($data as $item){

//            dd(strstr($item['akira'][0],"\n") == false);

            foreach ($item['tag'] as $tag){
                $tag = Tag::firstOrCreate(['name' => $tag]);
            }

            if (strstr($item['akira'][0],"\n") == false){
                foreach ($item['akira'] as $akira){
                    $akira = Akira::firstOrCreate(['name' => $akira]);
                }
            }else{
                $akira = Akira::firstOrCreate(['name' => '未知声优']);
            }


            $count = 0;

            $video_data = [
                'title' => $item['title'],
                'thumb' => asset('').$item['local_thumb'],
                'introduction' => $item['abstract'],
                'episodes' => $item['episodes'],
                'language' => $item['language'],
                'version' => $item['version'],
                'address' => $item['address'],
                'is_new' => $item['is_new'] === 'F' ? false : true,
                'update_date' => $item['is_new'] === 'F' ? '未知时间' : $item['is_new'],
                'status' => 1,
                'issue_date' => $item['created_at'],
                'tag' => implode(',',$item['tag']),
                'akira' => strstr($item['akira'][0],"\n") == false ? implode(',',$item['akira']) : '未知声优',
            ];



            if (Video::where('title',$item['title'])->first()){
                $video = Video::where('title',$item['title'])->first();
            }else{
                $video = Video::create($video_data);

                foreach ($item['tag'] as $tag){
                    $tag_id = Tag::where('name', $tag)->first()->id;
                    VideoTag::firstOrCreate([
                        'tag_id' =>  $tag_id,
                        'video_id' =>  $video->id
                    ]);
                }

                if (strstr($item['akira'][0],"\n") == false){
                    foreach ($item['akira'] as $akira){
                        $akira_id = Akira::where('name', $akira)->first()->id;
                        VideoAkira::firstOrCreate([
                            'akira_id' =>  $akira_id,
                            'video_id' =>  $video->id
                        ]);
                    }
                }else{
                    $akira_id = Akira::where('name', '未知声优')->first()->id;
                    VideoAkira::firstOrCreate([
                        'akira_id' =>  $akira_id,
                        'video_id' =>  $video->id
                    ]);
                }

                foreach ($item['file_url'] as $file_url){

                    $file_name = isset($item['file_name'][$count]) ? $item['file_name'][$count] : '';


                    VideoFile::firstOrCreate([
                        'file_name' =>  $file_name,
                        'file_url' =>   $file_url,
                        'file_thumb' =>  $item['file_thumb'][$count],
                        'video_id' => $video->id
                    ]);
                    $count += 1;

                }
            }


        }
        dd('创建完毕');

    }
}
