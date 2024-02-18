<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceRequest;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->get('q');
        $categoryName = $request->get('category');

        $query = Service::query();

        if ($keyword) {
            $query->where('title', 'LIKE', "%$keyword%");
        }

        if ($categoryName) {
            $category = Category::where('name', $categoryName)->first();

            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $services = $query->paginate(12)->withQueryString();

        return view('search', [
            'q' => $keyword,
            'category' => $categoryName,
            'services' => $services,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::pluck('label', 'id')->all();

        return view('service.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateServiceRequest $request)
    {
        $service = Service::create($this->extractValidatedData(new Service(), $request));

        to_route('service.show', ['service' => $service]);
    }

    public function extractValidatedData(Service $service, CreateServiceRequest $request): array
    {
        $validated = $request->safe()->merge(['user_id' => auth()->id()])->toArray();

        /**
         * @var UploadedFile | null $miniature
         */
        $miniature = $validated['miniature'];

        if ($miniature === null || $miniature->getError()) {
            return $validated;
        }

        if ($service->miniature) {
            Storage::disk('public')->delete($service->miniature);
        }

        $validated['miniature'] = $miniature->store('miniatures', 'public');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view("service.show", compact("service"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $categories = Category::pluck('label', 'id')->all();

        return view("service.edit", compact(["service", "categories"]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateServiceRequest $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service, Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        dd($service);
    }
}
