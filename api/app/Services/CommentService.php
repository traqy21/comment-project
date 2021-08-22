<?php


namespace App\Services;


use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Log;

class CommentService extends AbstractService
{
    public function __construct(CommentRepository $repository)
    {
        parent::__construct($repository);
    }

    public function create($data)
    {
        $toCommentId = (isset($data['to_comment_id'])) ? $data['to_comment_id'] : null;
        if(!is_null($toCommentId)){
            //get to comment id
            $parentComment = $this->repository->find('id', $toCommentId);
            Log::debug('layer', [$parentComment->layer]);
            $data['layer'] = $parentComment->layer + 1;

            if($data['layer'] > 3){
                return $this->response(400, 'create.400');
            }

        } else {
            $data['layer'] = 1;
        }

        return parent::create($data); // TODO: Change the autogenerated stub
    }
}