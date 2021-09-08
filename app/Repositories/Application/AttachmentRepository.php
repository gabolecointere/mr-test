<?php

namespace App\Repositories\Application;

use App\Models\Attachment;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class AttachmentRepository extends Repository {

	public $model = Attachment::class;

	public $rulesStore = [
        'attachmentable_type' => 'required|string',
        'attachmentable_id' => 'required|integer',
        'url' => 'required|url|max:255',
    ];

    public $rulesUpdate = [
        'attachmentable_type' => 'required|string',
        'attachmentable_id' => 'required|integer',
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