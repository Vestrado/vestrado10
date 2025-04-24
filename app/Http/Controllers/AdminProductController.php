<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function __construct()
    {
        // Restrict access to admins only
        //$this->middleware('auth'); // Adjust based on your admin authentication
        // Add admin check, e.g., $this->middleware('role:admin');
    }

    // Show the form to add a product
    public function create()
    {
        return view('admincreate');
    }

    // Store the new product
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'prod_name' => 'required|string|max:255',
            'prod_desc' => 'required|string',
            'pts' => 'required|numeric|min:0',
            'lots' => 'required|numeric|min:0',
            'material' => 'nullable|string',
            'sku' => 'required|string|unique:vestrado.product,sku',
            'prod_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'size' => 'nullable|array', // If sizes are multiple inputs
            'size.*' => 'string', // Validate each size
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('prod_img')) {
            $file = $request->file('prod_img');
            $filename = time() . '_' . $file->getClientOriginalName(); // Unique filename
            $file->move(public_path('products'), $filename); // Move to public/assets/images
            $imagePath = $filename; // Store only the filename in the database
        }
        //$imagePath="paragons.png";

        // Prepare sizes (e.g., as JSON or comma-separated string)
        $size = $request->size ? implode(',', $request->size) : null;


        // Insert the product
        DB::connection('vestrado')->table('product')->insert([
            'prod_name' => $validated['prod_name'],
            'prod_desc' => $validated['prod_desc'],
            'prod_img' => $imagePath,
            'material' => $validated['material'],
            'sku' => $validated['sku'],
            'size' => $size,
            'pts' => $validated['pts'],
            'lots' => $validated['lots'],
        ]);

        return redirect()->route('admin.products.create')->with('success', 'Product added successfully!');
    }
}
