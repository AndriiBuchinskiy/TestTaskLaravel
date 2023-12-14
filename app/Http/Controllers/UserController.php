<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function index(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'page' => 'integer|min:1',
            'count' => 'integer|min:1',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'fails' => $validator->errors(),
            ], 422);
        }

        $page = $request->input('page', 1);
        $count = $request->input('count', 5);

        $users = User::orderByDesc('registration_timestamp')
            ->paginate($count, ['*'], 'page', $page);


        if ($page > $users->lastPage()) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found',
            ], 404);
        }

        $userResourceCollection = UserResource::collection($users);


        return view('users.index', compact('userResourceCollection'));
    }


    public function show($id)
    {

         try {
                $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'User not found'], 404);
    }
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

        return view('users.create');
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
