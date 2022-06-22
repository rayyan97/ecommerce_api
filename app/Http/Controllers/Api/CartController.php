<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponVerify;
use App\Http\Requests\StoreCart;
use App\Http\Resources\CartProducts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CartProducts::collection(Cart::where('user_id', Auth::user()->id)->with('products')->get());
        $total_cart['total_cart'] = $this->CartTotal($data);
        $data->additional($total_cart);

        return $data;
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
    public function store(StoreCart $request)
    {

        $input = $request->validated();
        $input['user_id'] = Auth::user()->id;
        $cart = Cart::create($input);
        return CartProducts::collection(Cart::where('id', $cart->id)->with('products')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        $data['data'][0] = $cart;
        return $data;
    }
    public function CartTotal($data = null)
    {

        $data = $data ?? Cart::where('user_id', Auth::user()->id)->get();
        $total_cart['total_cart'] = 0.0;
        foreach ($data as $key => $value) {
            $total_cart['total_cart'] = round($total_cart['total_cart'] + ($value['quantity'] * $value['price']), 2);
        }
        return $total_cart['total_cart'];
    }

    public function increaseQuantity($id)
    {
        $cart = Cart::findorfail($id);
        $increament = $cart->increment('quantity');
        $data['data'][0]['product_total'] =  round($cart->quantity *  $cart->price, 2);
        $total = $this->CartTotal();
        $data['data'][0]['cart_total'] = $total;
        return $data;
    }
    public function decreaseQuantity($id)
    {
        $cart = Cart::findorfail($id);
        $increament = $cart->decrement('quantity');
        $data['data'][0]['product_total'] =  round($cart->quantity *  $cart->price, 2);
        $total = $this->CartTotal();
        $data['data'][0]['cart_total'] = $total;
        return $data;
    }

    public function verifyCoupon(CouponVerify $request)
    {
        $input = $request->validated();

        try {
            $voucher = auth()->user()->redeemCode($input['code']);
            $total = $this->CartTotal();
            $data['data']['message'] = 'Coupon Added Successfully';
            $data['data']['code'] = 200;
            $data['data']['discount_percent'] = $voucher->data->get('discount_percent');
            $data['data']['discount_price'] = round($total * ($voucher->data->get('discount_percent') / 100), 2);
            $data['data']['updated_cart_total'] = round(($total - $data['data']['discount_price']), 2);
            return response()->json($data);
        } catch (\Exception $ex) {
            $data['data']['message'] = $ex->getMessage();
            $data['data']['code'] = 500;
            return response()->json($data);
        }
    }

    public function generateBill(Request $request)
    {
        $customer = new Buyer([
            'name'          => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item);

        return $invoice->stream();
    }
}
