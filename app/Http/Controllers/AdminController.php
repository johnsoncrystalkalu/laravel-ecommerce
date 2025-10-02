<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Pest\Mutate\Mutators\Visibility\FunctionPublicToProtected;

class AdminController extends Controller
{
    public function addCategory(){
        return view('admin.addcategory');
    }

    public function postAddCategory(Request $request){

        $category = new Category();
        $category->category = $request->category;
        $category->save();
        return redirect()->back()->with('message', 'Added successfully');
    }

    public function viewCategory(){
        $category = Category::all();
        return view('admin.viewcategory', compact('category'));
    }

    public function deleteCategory($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('message', 'Category deleted successfully');
    }

    public function updateCategory($id){
        $category = Category::findOrFail($id);
        return view ('admin.updatecategory', compact('category'));
    }

    public function postUpdateCategory(Request $request, $id){

        $category = Category::findOrFail($id);
        $category->category = $request->category;
        $category->save();
        return redirect()->route('admin.viewcategory')->with('message', 'Category edited successfully');
    }

    public function addProduct(){
        $categories = Category::all();
        return view('admin.addproduct', compact('categories'));
    }

    public function postAddProduct(Request $request){
        $product = new Product();
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_category = $request->product_category;
        $image = $request->product_image;

        if($image){
            $image_name = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
            $request->product_image->move('products', $image_name);
            $product->product_image = $image_name;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product was added successfully');
    }

    public function viewProduct(){
        $product = Product::paginate(5);

        return view('admin.viewproduct', compact('product'));
    }

    public function deleteProduct($id){

        $product = Product::findOrFail($id);
        if ($product->product_image && file_exists(public_path('products/' . $product->product_image))) {
            unlink(public_path('products/' . $product->product_image));
        }
        $product->delete();
        return redirect()->back()->with('message', 'Product deleted successfully');


    }
}
