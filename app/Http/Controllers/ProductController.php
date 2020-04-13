<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface as ProductInterface;
use App\Repositories\Category\CategoryRepository as CategoryInterface;
use App\Repositories\Promotion\PromotionRepository as PromotionInterface;
use App\Repositories\Brand\BrandRepository as BrandInterface;
use App\Repositories\Type\TypeRepository as TypeInterface;
use App\Repositories\Supplier\SupplierRepository as SupplierInterface;
use Validator;

class ProductController extends Controller
{
    public $productInterface;
    public $categoryInterface;
    public $brandInterface;
    public $promotionInterface;
    public $supplierInterface;
    public $typeInterface;

    public function __construct(Request $request,
    ProductInterface $productInterface,
    CategoryInterface $categoryInterface,
    BrandInterface $brandInterface,
    PromotionInterface $promotionInterface,
    SupplierInterface $supplierInterface,
    TypeInterface $typeInterface
    )
    {
        $this->middleware('auth');
        $this->productInterface = $productInterface;
        $this->categoryInterface = $categoryInterface;
        $this->brandInterface = $brandInterface;
        $this->promotionInterface = $promotionInterface;
        $this->supplierInterface = $supplierInterface;
        $this->typeInterface = $typeInterface;
    }

    public function index(Request $request)
    {

      $products = $this->productInterface->getAll();
      $categories = $this->categoryInterface->getAll();
      $promotions = $this->promotionInterface->getAll();
      $types = $this->typeInterface->getAll();
      $brands = $this->brandInterface->getAll();
      return view('setups.product.index')->with('products', $products)
                                         ->with('categories', $categories)
                                         ->with('brands', $brands)
                                         ->with('types', $types)
                                         ->with('promotions', $promotions);
    }

    public function restocklist(Request $request)
    {
      $suppliers = $this->supplierInterface->getAll();
      $products = $this->productInterface->restock();
      return view('setups.product.restock')->with('products', $products)
                                           ->with('suppliers', $suppliers);
    }

    public function restock(Request $request)
    {
      $product =  $this->productInterface->find($request->id);
      $temp['quantity'] = $product->quantity + $request->quantity;
      if ($this->productInterface->update($temp, $request->id)) {
        return "success";
      }
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'size'          =>  'required',
            'description'   =>  'required',
            'category'   =>  'required',
            'price'         =>  'required',
            'quantity'      =>  'required',
            'brand'      =>  'required',
            'type'      =>  'required',
        ]);

      if ($validator->fails()) {
        return response('Validation Failed', 400)
                    ->header('Content-Type', 'application/json');
      }

     $product['name'] = $request->name;
     $product['size'] = $request->size;
     $product['description'] = $request->description;
     $product['category_id'] = $request->category;
     try {
        $product['promotion_id'] = $request->promotion;
     } catch (\Exception $e) {

     }
     $product['brand_id'] = $request->brand;
     $product['price'] = $request->price;
     $product['quantity'] = $request->quantity;
     $product['type_id'] = $request->type;
     $image= $request->file('img');
     $imagePath = public_path('/images/products/');
     $image->move($imagePath, $request->name. '.' . $image->getClientOriginalExtension());
     $product['image'] = '/images/products/'.$request->name .'.'.$image->getClientOriginalExtension() ;
     $result = $this->productInterface->store($product);

     if (isset($result)) {
        return \Response::json($result);
     }else{
        return \Response::json($result);
     }
    }

    public function destroy($id)
    {
        $product = $this->productInterface->find($id);
        if (!empty($product)) {
          $this->productInterface->destroy($id);
          return redirect('/product');
        }
    }

    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'size'          =>  'required',
            'description'   =>  'required',
            'category'   =>  'required',
            'price'         =>  'required',
            'quantity'      =>  'required',
            'brand'      =>  'required',
            'type'      =>  'required',
        ]);

      if ($validator->fails()) {
        return response($validator->errors(), 400)
                    ->header('Content-Type', 'application/json');
      }

     $product['name'] = $request->name;
     $product['size'] = $request->size;
     $product['description'] = $request->description;
     $product['category_id'] = $request->category;
     try {
        $product['promotion_id'] = $request->promotion;
     } catch (\Exception $e) {

     }
     $product['brand_id'] = $request->brand;
     $product['price'] = $request->price;
     $product['quantity'] = $request->quantity;
     $product['type_id'] = $request->type;
     if ($request->file('img')!=null) {
       $image= $request->file('img');
       $imagePath = public_path('/images/products/');
       $image->move($imagePath, $request->name. '.' . $image->getClientOriginalExtension());
       $product['image'] = '/images/products/'.$request->name .'.'.$image->getClientOriginalExtension() ;
     }

      $searchproduct = $this->productInterface->find($id);
      if (!empty($searchproduct)) {
        if ($this->productInterface->update($product,$id)) {
            return \Response::json(true);
        }else{
            return \Response::json(true);
        }
      }
    }

    public function find($id)
    {
      return $this->productInterface->find($id);
    }
}
