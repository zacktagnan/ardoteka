<?php

namespace App\Http\Controllers\Wine;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryRepositoryInterface $repository)
    {
    }

    public function index(): View
    {
        // Prueba para ver el resultado en el Buggregator
        // --------------------------------------------------
        // $categories = $this->repository->paginate(
        //     counts: ['wines'],
        // );
        // ray($categories);

        return view('wines.categories.index', [
            'categories' => $this->repository->paginate(
                counts: ['wines'],
            ),
        ]);
    }

    public function create(): View
    {
        return view('wines.categories.create', [
            'category' => $this->repository->model(),
            'sectionTitle' => __('Categoría Nueva'),
            'action' => route('categories.store'),
            'method' => 'POST',
            'submit' => __('Crear'),
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());

        session()->flash('success', __('Categoría creada con éxito'));

        return redirect()->route('categories.index');
    }

    public function edit(Category $category): View
    {
        // rd($category);
        return view('wines.categories.edit', [
            'category' => $category,
            'sectionTitle' => __('Categoría a Actualizar'),
            'action' => route('categories.update', $category),
            'method' => 'PUT',
            'submit' => __('Actualizar'),
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $this->repository->update($request->validated(), $category);

        session()->flash('success', __('Categoría actualizada con éxito'));

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        try {
            $this->repository->delete($category);
            session()->flash('success', __('Categoría eliminada con éxito'));
        } catch (\Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }

        return redirect()->route('categories.index');
    }
}
