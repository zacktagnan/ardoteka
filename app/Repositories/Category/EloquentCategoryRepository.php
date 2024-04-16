<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Traits\Eloquent\CRUDOperations;
use Exception;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    use CRUDOperations;

    protected string $model = Category::class;

    protected function checkIfItHasRelationsWith(Category $category): void
    {
        if ($category->wines()->exists()) {
            throw new Exception(__('No es posible eliminar esta CATEGORÍA por tener Vinos asociados'));
        }
    }
}
