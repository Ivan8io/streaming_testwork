<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class XYZpaymentsController extends Controller
{
    public function send(Request $request, $id) 
    {
        $attributes = $request->validate([
            'sum' => 'required|not_in:0',
            'payer_name' => 'nullable'
        ]);

        $attributes['user_id'] = $id;
        $attributes['payment_system'] = 'xyzpayment';

        $order_id = Payment::create($attributes)->id;        

        if ($attributes['payer_name']) {
            return redirect("https://xyz-payment.ru/pay?sum={$attributes['sum']}&order_id={$order_id}&name={$attributes['payer_name']}");
        }
        return redirect("https://xyz-payment.ru/pay?sum={$attributes['sum']}&order_id={$order_id}");
    }

    public function process(Request $request) 
    {
        if ($request->sign === $_ENV['SECRET_XYZ']) {
            $user = Payment::where('id', $request->order_id)->first()->user;
            $user->balance = $request->sum;

            $user->save();
        }

    }
}
