<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::latest()->paginate(10);
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(StorePetRequest $request)
    {
        Pet::create($request->validated());
        return redirect()->route('pets.index')->with('success', 'Thú cưng đã được thêm thành công!');
    }

    public function show(Pet $pet)
    {
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        return view('pets.edit', compact('pet'));
    }

    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $pet->update($request->validated());
        return redirect()->route('pets.index')->with('success', 'Thông tin thú cưng đã được cập nhật!');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()->route('pets.index')->with('success', 'Thú cưng đã được xóa!');
    }
};