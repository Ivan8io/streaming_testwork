<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OLDpayController extends Controller
{
    public function send(Request $request, $id) 
    {
        $attributes = $request->validate([
            'sum' => 'required|not_in:0',
            'payer_name' => 'required'
        ]);

        $attributes['user_id'] = $id;
        $attributes['payment_system'] = 'oldpay';

        $order_id = Payment::create($attributes)->id;

        $url = Http::post('https://old-pay.ru/api/create', [
            'name' => $attributes['payer_name'],
            'order_id' => $order_id,
            'sum' => $attributes['sum']
        ])->json()['redirect_to'];

        return redirect($url);
}

    public function process(Request $request) 
    {
        $payment_id = $request->input('payment_id');

        $check = Http::withHeaders([
            'X-Secret-Key' => $_ENV['SECRET_OLD'],
        ])->get('https://old-pay.ru/api/get-status', [
            'id' => $payment_id,
        ])->json();

        if ($check['status'] === 'success') {
            $user = Payment::where('id', $check['order_id'])->first()->user;
            $user->balance = $check['sum'];

            $user->save();
        }

    }
}
