<?php

namespace App\Http\Controllers;

use Exception;
use App\Repo\ProductRepo;
use Illuminate\Http\Request;
use App\Repo\ProductImagesRepo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $productRepo;
    public $productImagesRepo;

    public function __construct(
        ProductRepo $productRepo,
        ProductImagesRepo $productImagesRepo
    ) {
    
        $this->productRepo = $productRepo;
        $this->productImagesRepo = $productImagesRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->productRepo->all([]);
        $filter_brand = $this->productRepo->findBrand([]);
        $page = $request->all()['page'] ?? 'homepage';
        
        return view('home', compact('products', 'page', 'filter_brand'));
    }

    public function searchProductByBrand(Request $request)
    {
        try {
            $data = $request->all();
            $products = $this->productRepo->findByProductByBrand([], $data['brand'], $data['product'], $data['sku']);

            return response()->json([
                'success' => true,
                'data' => $products,
            ]);

        } catch (Exception $e) {
            Log::error('['.get_class($this).'\\'.__FUNCTION__."] Error: {$e->getMessage()},".PHP_EOL."[Stacktrace]: {$e->getTraceAsString()}");

            return response([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function searchProductByFilter(Request $request)
    {
        try {

            $data = json_decode(json_encode($request->all()['data']));
            $page = $request->all()['data']['page'] ?? '';
            $filter_brand = $this->productRepo->findBrand([]);

            $products = $this->productRepo->findProductByFilter([], $data->brand, $data->product, $data->sku);

            return view('home', compact('products', 'page', 'filter_brand'));
                      
        } catch (Exception $e) {
            Log::error('['.get_class($this).'\\'.__FUNCTION__."] Error: {$e->getMessage()},".PHP_EOL."[Stacktrace]: {$e->getTraceAsString()}");

            return response([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $newFileName = 'product-' . time() . '.' . $request->file('image')->extension();
            $path = $request->file('image')->storeAs('public/images/product', $newFileName);
    
            $this->productImagesRepo->create([
                'product_id' => 33,
                'image_url' => $path,
                'remark' => 'manual_import'
            ]);
            
            return view('home');

        } else {
            return response()->json(['error' => 'No image uploaded.'], 400);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $page, string $sku)
    {
        $products = $this->productRepo->findBySku([], $sku);

        if (!Cookie::has('view_' .collect($products)->first()['id'])) {
            Cookie::queue('view_' . collect($products)->first()['id'], true, 60); 
            $this->productRepo->update(collect($products)->first()['id'],
            [
                'view' => collect($products)->first()['view'] + 1,
            ]);
        }

        $date = $this->functionConvertDate(collect($products)->first()['updated_at']);
        $other_products = $this->productRepo->findByProductByBrand([], collect($products)->first()['brand']);
        $favorite_products = $this->productRepo->findByCategory([], collect($products)->first()['category']);
        $filter_brand = $this->productRepo->findBrand([]);

        return view('product.detail', compact('products', 'page', 'filter_brand', 'other_products', 'favorite_products', 'date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function functionConvertDate($date)
    {
        $months = ['Jan' => 'ม.ค.', 'Feb' => 'ก.พ.', 'Mar' => 'มี.ค.', 'Apr' => 'เม.ย.', 'May' => 'พ.ค.', 'Jun' => 'มิ.ย.', 'Jul' => 'ก.ค.', 'Aug' => 'ส.ค.', 'Sep' => 'ก.ย.', 'Oct' => 'ต.ค.', 'Nov' => 'พ.ย.', 'Dec' => 'ธ.ค.'];
        if (App::getLocale() == 'th') {
            $new_date = str_replace(array_keys($months), array_values($months), date('j M y', strtotime($date)));
        } else {
            $new_date = date('j M y', strtotime($date)); 
        }

        return $new_date;
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
