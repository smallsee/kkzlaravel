<?php
namespace App\Repositories\Eloquent;
use App\Art;
use JWTAuth;

class ArtRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Art::class;
    }

    public function createArt(array $attributes){
         $images = $attributes['thumbList'];

        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }


        $art_data = [
            'title' => $attributes['title'],
            'images' => json_encode($images),
            'status' => 1,
            'user_id' => $user->id,
        ];

        return $this->model->create($art_data);
    }

    public function updateArt(array $attributes){
        $images = $attributes['thumbList'];

        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
        $art  = $this->model->find($attributes['id']);

        if (!$art){
            return response()->json(['user_not_found'], 404);
        }
        $art['title'] = $attributes['title'];
        $art['images'] = json_encode($images);
        $art->save();

        return $art;
    }


    public function findById($id)
    {
        $art = $this->model->find($id);
        $art->increment('see');
        return $art;
    }

}