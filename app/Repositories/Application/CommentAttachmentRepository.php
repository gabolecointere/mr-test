<?php

namespace App\Repositories\Application;

use App\Models\CommentAttachment;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class CommentAttachmentRepository extends Repository {

	public $model = CommentAttachment::class;

	public $rulesStore = [
        'comment_id' => 'required|integer|exists:comments,id',
        'url' => 'required|url|max:255',
    ];

    public $rulesUpdate = [
        'comment_id' => 'required|integer|exists:comments,id',
        'url' => 'required|url|max:255',
    ];

    public function closureStoreModel($model, $request): Model
    {
    	return $model;
    }

    public function closureUpdateModel($model, $request, $id): Model
    {
    	return $model;
    }

    public function restrictionNotToDelete($request, $id)
    {

    }
}