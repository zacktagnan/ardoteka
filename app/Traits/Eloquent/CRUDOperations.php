<?php

namespace App\Traits\Eloquent;

use App\Services\UploadService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

trait CRUDOperations
{
    public function model(?string $slug = null): Model
    {
        if ($slug) {
            return $this->model::whereSlug($slug)->firstOrFail();
        }

        // creando una instancia vacía del modelo si aún no existe como tal
        return app($this->model);
    }

    public function paginate(array $counts = [], array $relationships = [], int $perPage = 10): LengthAwarePaginator
    {
        // $model = $this->model::query()
        //     ->with($relationships)
        //     ->withCount($counts)
        //     ->paginate($perPage);
        // ray('MODEL', $model);
        return $this->model::query()
            ->with($relationships)
            ->withCount($counts)
            ->paginate($perPage);
    }

    public function create(array $data): Model
    {
        // Primero, se guarda el archivo de imagen requerido
        // $image = UploadService::upload(data_get($data, 'image'), strtolower(class_basename($this->model)));
        $image = $this->uploadFile($data);

        return $this->model::create(array_merge($data, ['image' => $image]));
    }

    public function update(array $data, Model $model): Model
    {
        if (data_get($data, 'image')) {
            // UploadService::delete($model->image);
            $this->deleteFile($model);

            // data_set($data, 'image', UploadService::upload(data_get($data, 'image'), strtolower(class_basename($this->model))));
            data_set($data, 'image', $this->uploadFile($data));
        }

        $model->update($data);

        return $model;
    }

    public function delete(Model $model): ?bool
    {
        if (method_exists($this, 'checkIfItHasRelationsWith')) {
            $this->checkIfItHasRelationsWith($model);
        }

        // UploadService::delete($model->image);
        $this->deleteFile($model);

        return $model->delete();
    }

    private function uploadFile(array $data): string
    {
        return UploadService::upload(data_get($data, 'image'), strtolower(class_basename($this->model)));
    }

    private function deleteFile(Model $model): bool
    {
        return UploadService::delete($model->image);
    }
}
