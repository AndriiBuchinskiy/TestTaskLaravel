<?php

namespace App\Http\Controllers;

use App\Events\UpdateUserAmount;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserController extends Controller
{

    public function index()
    {
        $users = User::with('products')->get();
        return view('users.index', compact('users'));

    }

    public function show(User $user)
    {

        $userWithProducts = User::with('products')->find($user->id);
        return view('users.show', compact('userWithProducts'));
    }

    public function edit($id)
    {

        $userWithProducts = User::with('products')->findOrFail($id);
        $products = Product::all();
        $selectedProductIds = $userWithProducts->products->pluck('id')->toArray();

        return view('users.edit', compact('userWithProducts', 'products', 'selectedProductIds'));
    }

    public function update(UpdateUserRequest $request, $id)
    {

            $user = User::findOrFail($id);

            $user->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
            ]);

            $productIds = $request->input('product_id', []);


            $existingProductIds = Product::whereIn('id', $productIds)->pluck('id')->toArray();
            $nonExistingProductIds = array_diff($productIds, $existingProductIds);

            if (!empty($nonExistingProductIds)) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['product_id' => 'One or more selected products do not exist.']);
            }

            $user->products()->sync($existingProductIds);
            event(new UpdateUserAmount($user));

            return redirect()->route('users.index')
                ->with('success', 'Users updated successfully');

    }

    public function create()
    {
        $products = Product::all();
        return view('users.create',compact('products'));
    }

    public function store(CreateUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = new User([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');


            $fileName = time() . '_' . $file->getClientOriginalName();


            $filePath = $file->storeAs('avatars', $fileName, 'public');


            $user->avatar = $fileName;
        } else {
            $user->avatar = 'placeholder.jpg';
        }

        $user->save();



        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->products()->detach();
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
