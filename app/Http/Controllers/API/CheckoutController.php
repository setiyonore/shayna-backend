<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Http\Requests\API\CheckoutRequest;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request){
        $data = $request->except('transaction_details');
        $data['uuid'] = 'TRX'.mt_rand(10000,99999).mt_rand(100,999);
//        TRX12334445566432
        $transaction = Transaction::query()->create($data);

        foreach ($request->transaction_details as $product){
            $details[] = new TransactionDetail([
               'transactions_id' => $transaction->id,
                'products_id' => $product
            ]);
            Product::query()->find($product)->decrement('quantity');
        }
        $transaction->details()->saveMany($details);
        return ResponseFormatter::success($transaction);
    }
}
