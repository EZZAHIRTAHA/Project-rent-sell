<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Car;
use App\Models\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VenteController extends Controller
{
    public function index()
    {
        $cars = Car::where('quantity', '>', 1)->get();
        return view('vente.vente', compact('cars'));
    }

    public function create($car_id)
    {
        $user = auth()->user();
        $car = Car::find($car_id);
        return view('vente.create', compact('car', 'user'));
    }

    public function store(Request $request, $car_id)
    {
        $request->validate([
            'full-name' => 'required|string|max:255',
            'email' => 'required|email',
            'quantity' => 'required|integer|min:1',
        ]);

        $car = Car::findOrFail($car_id);
        $user = Auth::user();

        $quantity = $request->input('quantity');
        $unitPrice = $car->prix_vente;
        $discountPercentage = 0;

        // Handle optional coupon (if passed)
        if ($request->filled('applied_coupon')) {
            $coupon = Coupon::where('code', $request->applied_coupon)->first();
            if ($coupon && $coupon->isValid()) {
                $discountPercentage = $coupon->discount_percentage;
            }
        }

        $basePrice = $quantity * $unitPrice;
        $discountAmount = $basePrice * ($discountPercentage / 100);
        $finalPrice = $basePrice - $discountAmount;

        // Create the vente
        $vente = new Vente();
        $vente->user_id = $user->id;
        $vente->car_id = $car->id;
        $vente->quantity = $quantity;
        $vente->price_unit = $unitPrice;
        $vente->total_price = $finalPrice;
        $vente->payment_method = 'At store';
        $vente->sold_at = Carbon::now();
        $vente->save();

        // Update car stock if needed
        $car->quantity -= $quantity;
        if ($car->quantity <= 0) {
            $car->status = 'Sold';
        }
        $car->save();

        return view('thankyouVente', ['vente' => $vente]);
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
