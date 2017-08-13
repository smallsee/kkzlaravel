<?php
namespace App\Repositories\Eloquent;

use App\Commit;

class CommitRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Commit::class;
    }



}