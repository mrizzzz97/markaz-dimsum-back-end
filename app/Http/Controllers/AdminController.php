<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $adminUsername = 'admin123';
    private $adminPassword = 'adminQWERTY123';

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if ($username === $this->adminUsername && $password === $this->adminPassword) {
            // Store admin login state in session
            session(['is_admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->withErrors(['Invalid credentials']);
        }
    }

    public function dashboard()
    {
        if (!session('is_admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        // List all products for admin management
        $products = \App\Models\Product::all();
        return view('admin.dashboard', compact('products'));
    }

    public function createProduct()
    {
        if (!session('is_admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return view('admin.create_product');
    }

    public function storeProduct(\Illuminate\Http\Request $request)
    {
        if (!session('is_admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } elseif ($request->input('image_url')) {
            $imagePath = $request->input('image_url');
        } else {
            $imagePath = null;
        }

        $product = new \App\Models\Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->image = $imagePath;
        $product->save();

        return redirect()->route('admin.dashboard')->with('success', 'Product added successfully.');
    }

    public function editProduct($id)
    {
        if (!session('is_admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        $product = \App\Models\Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function updateProduct(\Illuminate\Http\Request $request, $id)
    {
        if (!session('is_admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'rating' => 'required|numeric|min:0|max:5',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $product = \App\Models\Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->rating = $request->input('rating');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        } elseif ($request->input('image_url')) {
            $product->image = $request->input('image_url');
        }

        $product->save();

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        if (!session('is_admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }

    public function logout()
    {
        session()->forget('is_admin_logged_in');
        return redirect()->route('admin.login');
    }
}
