<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Brand\BrandRepositoryInterface as BrandInterface;
use App\Repositories\Category\CategoryRepositoryInterface as CategoryInterface;
use App\Repositories\Order\OrderRepositoryInterface as OrderInterface;
use App\Repositories\Delivery\DeliveryRepositoryInterface as DeliveryInterface;
use App\Repositories\Product\ProductRepositoryInterface as ProductInterface;
use App\Repositories\Promotion\PromotionRepository as PromotionInterface;
use App\Repositories\Type\TypeRepository as TypeInterface;
use App\Repositories\Supplier\SupplierRepository as SupplierInterface;
use Validator;

class DashBoardController extends Controller
{
    public $brandInterface;
    public $categoryInterface;
    public $orderInterface;
    public $deliveryInterface;
    public $productInterface;
    public $promotionInterface;
    public $supplierInterface;
    public $typeInterface;

    public function __construct(
     Request $request,
     BrandInterface $brandInterface,
     CategoryInterface $categoryInterface,
     OrderInterface $orderInterface,
     DeliveryInterface $deliveryInterface,
     ProductInterface $productInterface,
     PromotionInterface $promotionInterface,
     SupplierInterface $supplierInterface,
     TypeInterface $typeInterface
     )
    {
        $this->middleware('auth');
        $this->brandInterface = $brandInterface;
        $this->categoryInterface = $categoryInterface;
        $this->orderInterface = $orderInterface;
        $this->deliveryInterface = $deliveryInterface;
        $this->productInterface = $productInterface;
        $this->promotionInterface = $promotionInterface;
        $this->supplierInterface = $supplierInterface;
        $this->typeInterface = $typeInterface;
    }

    public function index(Request $request)
    {
      $brands = $this->brandInterface->total();
      $categorys = $this->categoryInterface->total();
      $orders    = $this->orderInterface->total();
      $deliverys    = $this->deliveryInterface->total();
      $products    = $this->productInterface->total();
      $promotions  = $this->promotionInterface->total();
      $suppliers  = $this->supplierInterface->total();
      $types  = $this->typeInterface->total();
      $outofstocks = count($this->productInterface->restock());
      return view('welcome')->with('brands', $brands)
                            ->with('categorys', $categorys)
                            ->with('orders', $orders)
                            ->with('deliverys', $deliverys)
                            ->with('products', $products)
                            ->with('promotions', $promotions)
                            ->with('suppliers', $suppliers)
                            ->with('types', $types)
                            ->with('outofstocks', $outofstocks);
    }


}
