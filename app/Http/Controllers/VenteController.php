<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VenteController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('vente.vente', compact('cars'));
    }

    public function create()
    {
        $cars = Car::all();
        $users = User::all();
        return view('cars_ventes.create', compact('cars', 'users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|exists:cars,id',
            'user_id' => 'nullable|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'price_unit' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string|max:255',
            'sold_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['total_price'] = $data['price_unit'] * $data['quantity'];

        $vente = Vente::create($data);

        return response()->json(['message' => 'Vente created successfully', 'vente' => $vente]);
    }

    public function show($id)
    {
        $vente = Vente::with(['car', 'user'])->findOrFail($id);
        return response()->json($vente);
    }

    public function edit($id)
    {
        $vente = Vente::findOrFail($id);
        $cars = Car::all();
        $users = User::all();
        return view('cars_ventes.edit', compact('vente', 'cars', 'users'));
    }

    public function update(Request $request, $id)
    {
        $vente = Vente::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'car_id' => 'required|exists:cars,id',
            'user_id' => 'nullable|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'price_unit' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string|max:255',
            'sold_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['total_price'] = $data['price_unit'] * $data['quantity'];

        $vente->update($data);

        return response()->json(['message' => 'Vente updated successfully', 'vente' => $vente]);
    }

    public function destroy($id)
    {
        $vente = Vente::findOrFail($id);
        $vente->delete();

        return response()->json(['message' => 'Vente deleted successfully']);
    }
}
