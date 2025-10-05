<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Pest\Mutate\Mutators\Visibility\FunctionPublicToProtected;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $image_path = public_path('products/'.$product->product_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $product->delete();
        return redirect()->back()->with('message', 'Product deleted successfully');
    }

    public function updateProduct($id){

        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.updateproduct', compact('product', 'categories'));
    }

    public function postUpdateProduct(Request $request, $id){
        $product = Product::findOrFail($id);
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_category = $request->product_category;
        $image = $request->product_image;

        if($image){

        $image_path = public_path('products/'.$product->product_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
            $image_name = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
            $request->product_image->move('products', $image_name);
            $product->product_image = $image_name;

        }
        $product->save();

        return redirect()->route('admin.viewproduct')->with('message', 'Product Edited successfully');
    }

    public function postSearchProduct(Request $request){
        $search = $request->search;
        $product = Product::where('product_title', 'LIKE', '%'.$search.'%')
        ->orWhere('product_description', 'LIKE', '%'.$search.'%')
        ->paginate(2);

        return view('admin.viewproduct', compact('product'));
    }

    public function viewOrder(){
        $orders = Order::paginate(10);

        return view ('admin.vieworders', compact('orders'));
    }

    public function postChangeOrderStatus(Request $request, $id){

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('message', 'order changed successfully');
    }

    public function downloadPDF($id){
        $orders = Order::findOrFail(($id));
        $data = $orders;
        $pdf = Pdf::loadView('admin.invoice', compact('data'));
        return $pdf->download('invoice.pdf');
    }
}



