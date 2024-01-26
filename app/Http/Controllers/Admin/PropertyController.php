<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use App\Models\Property;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\PropertyFormRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.properties.index', [
            'properties' => Property::latest()->paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $property = new Property();
        $property->fill([
            'title' => 'Propriété de ...',
            'surface' => 25,
            'price' => 14_000,
            'address' => 'Adresse de ma propriété',
            'description' => "Bel appartement. Sympa pour une jeune famille !",
            'rooms' => 4,
            'bedrooms' => 2,
            'floor' => 0,
            'city' => 'Manchester',
            'postal_code' => 12101998,
            'sold' => false,
        ]);

        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $property =  Property::create(Arr::except($request->validated(), ['options', 'images']));
        $property->options()->sync($request->validated('options'));
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $url = $image->store('public/images');
                $property->images()->create([
                    'url' =>  $url,
                ]);
            }
        }
        return to_route('admin.property.index')->with('success', 'Propriété ajoutée avec succès !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->update(Arr::except($request->validated(), ['options', 'images']));
        $property->options()->sync($request->validated('options'));
        if ($request->hasFile('images')) {
            foreach ($property->images as $image) {
                Storage::delete($image->url);
                $image->delete();
            }
            foreach ($request->file('images') as $image) {
                $url = $image->store('public/images');
                $property->images()->create([
                    'url' => $url,
                ]);
            }
        }
        return to_route('admin.property.index')->with('success', 'Propriété Modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return to_route('admin.property.index')->with('success', 'Propriété supprimée avec succès !');
    }
}
