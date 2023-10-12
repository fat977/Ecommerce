<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Events\NewProduct;
use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ImportProduct;
use App\Http\Requests\Dashboard\Product\StoreProductRequest;
use App\Http\Requests\Dashboard\Product\UpdateProductRequest;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Http\traits\media;
use App\Imports\ProductImport;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Spec;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    use media;
    /**
     * Display a listing of the resource.
     */
    public $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        //
        //$products = Product::with('category','brand')->get();
        //dd($products);
        $products = $this->productService->getProducts();
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $brands = Brand::select('id','name_en','name_ar')->where('status',1)->get();
        $categories = Category::select('id','name_en','name_ar')->where('status',1)->get();
        return view('dashboard.products.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
        $data = $request->validated();
        //dd($data);
        if(!empty($data->image)){
            $data['image'] = $this->uploadImage($request->image,'public/products');
        }
        //$product = Product::create($data);
        $product = $this->productService->createProduct($data);
       /*  Event::dispatch(new NewProduct($product));
        $product->specs()->sync($request->specs); */
        if($request->page =='back'){
            return redirect()->back()->with('success','Product is created successfully');
        }else{
            return redirect()->route('admin.products.index');
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $product = Product::with('specs','offers')->findOrFail($id);
       
        //dd($product);
        return view('dashboard.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        $specs = Spec::all();
        $brands = Brand::select('id','name_en','name_ar')->where('status',1)->get();
        $categories = Category::select('id','name_en','name_ar')->where('status',1)->get();
        return view('dashboard.products.edit',compact('categories','brands','product','specs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request,$id)
    {
        //
        $product = Product::findOrFail($id);
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            // delete image
            if ($product->image != null) {
                Storage::disk('local')->delete('public/products/' . $product->image);
            }

            $data['image'] = $this->uploadImage($request->image,'public/products');
            $product->update(['image' => $data['image']]);
        }
        //$product->update($data);
        $this->productService->updataProduct($id,$data);
        //$product->specs()->sync($request->specs);
        return redirect()->back()->with('success','Product is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        /* $product = Product::findOrFail($id);
        if($product->image != null){
            Storage::disk('local')->delete('public/products/'.$product->image);
        }
        $product->delete(); */
        $this->productService->deleteProduct($id);
        return redirect()->back()->with('success','Product is deleted successfully');
    }

    public function export(){
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function import(Request $request){
        /* $validated = $request->validated();
        dd($validated); */
        Excel::import(new ProductImport,'Products.xlsx');
        app('flasher')->addSuccess('File is imported successfully.');
    }
}
