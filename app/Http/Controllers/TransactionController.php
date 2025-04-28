<?php

namespace App\Http\Controllers;

use App\Models\Categoris;
use App\Models\orderDetails;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//harus ada ini untuk menghapus file poto
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Orders";

        //panggil semua data bases Orders dmana id DESC
        $datas = Orders::orderBy('id', 'desc')->get();
        //print_r = return
        // return $datas;
        return view('pos.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['Products'] = Products::orderBy('id', 'desc')->get()->map(function ($res) {
            return [
                'id' => $res->id,
                'name' => $res->product_name,
                'price' => (int)$res->product_price,
                'image' => asset('storage/' . $res->product_photo),
                'option' => null,
            ];
        });
        return view('pos.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $cartItems = json_decode($request->cart, true);
            $cash = $request->cash;
            $total = $request->total;
            $change = $request->change;

            $order = new Orders();
            $order->order_code = 'TWPOS-KS-' . time();
            $order->order_date = now();
            $order->order_amount = $total;
            $order->order_change = $change;
            $order->order_status = 1;
            $order->save();

            foreach ($cartItems as $item) {
                $product = Products::findOrFail($item['productId']); // Perhatikan key-nya 'productId' bukan 'product_id'

                // Buat order detail
                $orderDetail = new OrderDetails();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $item['productId'];
                $orderDetail->qty = $item['qty'];
                $orderDetail->order_price = $item['price'];
                $orderDetail->order_subtotal = $item['price'] * $item['qty'];
                $orderDetail->save();

                // Kurangi stok
                if (!$product->decreaseStock($item['qty'])) {
                    throw new \Exception('Stok tidak mencukupi untuk produk: ' . $product->product_name);
                }
            }

            DB::commit();

            return redirect()->to('pos')->with('success', 'Transaksi berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //order
        $order = Orders::findOrFail($id);
        $orderDetails = orderDetails::with('product')->where('order_id', $id)->get();
        $title = "Order Details Of " . $order->order_code;
        return view('pos.show', compact('order', 'orderDetails', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Products::find($id);
        $categories = Categoris::orderBy('id', 'desc')->get();
        return view('products.edit', compact('edit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = [
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $request->is_active,
        ];

        $product = Products::find($id);
        if ($request->hasFile('product_photo')) {
            //jika gambar sudah ada dan mau diubah maka gambar kita hapus di ganti oleh gambar baru
            if ($product->product_photo) {
                File::delete(public_path('storage/' . $product->photo));
            }
            $photo = $request->file('product_photo')->store('product', 'public');
            $data['product_photo'] = $photo;
        }

        $product->update($data);
        Alert::toast('Data Change Success', 'success');
        return redirect()->to('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::find($id);
        File::delete(public_path('storage/' . $product->product_photo));
        Products::where('id', $id)->delete();
        return redirect()->to('product');
    }

    public function getProduct($category_id)
    {

        $product = Products::where('category_id', $category_id)->get();
        $response = ['status' => 'succes', 'message' => 'fetch product success', 'data' => $product];
        return response()->json($response, 200);
    }

    public function print($id)
    {
        $order = Orders::findOrFail($id);
        $orderDetails = OrderDetails::with('product')->where('order_id', $id)->get();
        $tunai = $order->order_amount + $order->order_change;

        return view('pos.print-struk', compact('order', 'orderDetails', 'tunai'));
    }
}
