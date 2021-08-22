<?php


namespace App\Repositories;


use App\Models\CoreModel;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends AbstractRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function view(CoreModel $model)
    {
        return $model->with(['comments' => function ($query){
            $query->where('layer', 1);
        }, 'comments.toComments', 'comments.toComments.toComments'])->get();
    }
}
