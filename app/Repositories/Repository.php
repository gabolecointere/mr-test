<?php

namespace App\Repositories;

use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

abstract class Repository {

	public $model;
	public $rulesStore = [];
	public $rulesUpdate = [];
	public $rulesDestroy = [];
	public $closureStoreModel;
	protected $restrictionsNotToDelete = [];
	public $restrictionsNotToDeleteMessage;

	public function __construct()
	{
		$this->model = new $this->model;
	}

	abstract public function closureStoreModel($model, $request): Model;
	abstract public function closureUpdateModel($model, $request, $id): Model;
	abstract public function restrictionNotToDelete($request, $id);

	protected function addRestrict(string $model, string $key, string $message, $closure = null)
	{
		$this->restrictionsNotToDelete[] = compact('model', 'key', 'message', 'closure');
	}

	public function canClearWithRestrictionsNotToDelete(Request $request, int $id)
	{
		foreach($this->restrictionsNotToDelete as $value)
		{
			$model = new $value['model'];
			$query = $model->newQuery();
			$query = $query->where($value['key'], $id);

			if (! is_null($value['closure']))
				$query = $value['closure']($query);

			if ($query->count() > 0)
			{
				$this->restrictionsNotToDeleteMessage = $value['message'];

				return false;
			}
		}

		return true;
	}

	public function all()
	{
		return $this->model->all();
	}

	public function create(Request $request)
	{
		$this->request = $request;

		return DB::transaction(function (){

			$resource = new $this->model($this->request->all());
			$resource = $this->closureStoreModel($resource, $this->request);
			$resource->save();
			$resource->fresh();

			if (method_exists($this, 'callBackStoreModel'))
				$this->callBackStoreModel($resource, $this->request);

			return $resource;
		});
	}

	public function update(Request $request, $id)
	{
		$this->id = $id;
		$this->request = $request;

		return DB::transaction(function (){

			$resource = $this->model->find($this->id);
			$resource->fill($this->request->all());
			$resource = $this->closureUpdateModel($resource, $this->request, $this->id);
			$resource->save();
			$resource->fresh();

			if (method_exists($this, 'callBackUpdateModel'))
				$this->callBackUpdateModel($resource, $this->request);

			return $resource;
		});
	}

	public function find(Request $request, $id)
	{
		return $this->model->find($id);
	}

	public function delete(Request $request, $id)
	{
		$this->request = $request;
		$this->id = $id;

		return DB::transaction(function (){

			$resource = $this->model->find($this->id);
			$resource->delete();

			if (method_exists($this, 'callBackDestroyModel'))
					$this->callBackDestroyModel($resource, $this->request);

			return $resource;
		});
	}

	public function getRulesStore(Request $request)
	{
		return $this->rulesStore;
	}

	public function __call($method, $params)
	{		
		$query = $this->model->newQuery();

		return call_user_func_array([$query, $method], $params);
	}
}