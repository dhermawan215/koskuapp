<?php

namespace App\Http\Controllers\API;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // set konfig midtrans
        \Midtrans\Config::$serverKey = \config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = \config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = \config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = \config('services.midtrans.is3ds');

        //buat instance notification
        $notification = new Notification();

        //asign variabel untuk mempermudah koding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        //cari transaksi by id

        $transaction = Transaction::findOrFail($order_id);


        //handle notif by status midtrans

        if ($status == 'capture') {

            if ($type == 'credit_card') {

                if ($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                } else {
                    $transaction->status = 'SUCCESS';
                }
            }
        } else if ($status == 'settlement') {
            $transaction->status = 'SUCCESS';
        } else if ($status == 'pending') {
            $transaction->status = 'PENDING';
        } else if ($status == 'deny') {
            $transaction->status = 'CANCELLED';
        } else if ($status == 'expire') {
            $transaction->status = 'CANCELLED';
        } else if ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }


        //simpan transaksi

        $transaction->save();
    }

    public function success()
    {
        return \view('midtrans.success');
    }

    public function unfinish()
    {
        return \view('midtrans.unfinish');
    }

    public function error()
    {
        return \view('midtrans.error');
    }
}
