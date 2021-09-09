<?php

namespace App\Repositories\Application;

use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository {

	public $model = User::class;

	public $rulesStore = [
        'name' => 'required',
        'email' => 'required|email|unique',
        'password' => 'required|string'
    ];

    public $rulesUpdate = [
        'name' => 'required',
        'email' => 'required|email|unique',
        'password' => 'required|string'
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

    public function getUsersWithPosts()
    {
        return $this
            ->with([
                "posts" => function($query){
                    $query->withCount(['post_attachments', 'comments']);
                },
                "posts.comments" => function($query){
                    $query->withCount('comment_attachments');
            }])->get();
    }
}