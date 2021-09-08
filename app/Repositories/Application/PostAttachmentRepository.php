<?php

namespace App\Repositories\Application;

use App\Models\PostAttachment;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class PostAttachmentRepository extends Repository {

	public $model = PostAttachment::class;

	public $rulesStore = [
        'post_id' => 'required|integer|exists:posts,id',
        'url' => 'required|url|max:255',
    ];

    public $rulesUpdate = [
        'post_id' => 'required|integer|exists:posts,id',
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