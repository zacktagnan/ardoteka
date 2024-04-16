<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\WineRequest;
use App\Models\Wine;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Wine\WineRepositoryInterface;

class WineController extends Controller
{
    public function __construct(private readonly WineRepositoryInterface $repository)
    {
    }

    public function index(): View
    {
        return view('wines.index', [
            'wines' => $this->repository->paginate(
                relationships: ['category'],
            ),
        ]);
    }

    public function create(): View
    {
        return view('wines.create', [
            'wine' => $this->repository->model(),
            'sectionTitle' => __('Vino Nuevo'),
            'action' => route('wines.store'),
            'method' => 'POST',
            'submit' => __('Crear'),
        ]);
    }

    public function store(WineRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());

        session()->flash('success', __('Vino creado con éxito'));

        return redirect()->route('wines.index');
    }

    public function edit(Wine $wine): View
    {
        // rd($wine);
        return view('wines.edit', [
            'wine' => $wine,
            'sectionTitle' => __('Vino a Actualizar'),
            'action' => route('wines.update', $wine),
            'method' => 'PUT',
            'submit' => __('Actualizar'),
        ]);
    }

    public function update(WineRequest $request, Wine $wine): RedirectResponse
    {
        $this->repository->update($request->validated(), $wine);

        session()->flash('success', __('Vino actualizado con éxito'));

        return redirect()->route('wines.index');
    }

    public function destroy(Wine $wine): RedirectResponse
    {
        try {
            $this->repository->delete($wine);
            session()->flash('success', __('Vino eliminado con éxito'));
        } catch (\Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }

        return redirect()->route('wines.index');
    }
}
