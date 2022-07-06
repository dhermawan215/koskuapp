<?php

namespace App\Http\Controllers\API;

use Exception;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Kontrakan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionRestController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $transaction_number = $request->input('transaction_number');
        $limit = $request->input('limit');
        $status = $request->input('status');

        //filter by id
        if ($id) {
            $transactionData = Transaction::with('user', 'kontrakan')->find($id);
            if ($transactionData) {
                return ResponseFormatter::success(
                    $transactionData,
                    'Data Transaksi Berhasil Diambil'
                );
            } else {
                return ResponseFormatter::error(
                    \null,
                    'Data Kosong',
                    404
                );
            }
        }

        $transactionData = Transaction::with('user', 'kontrakan')->where('users_id', Auth::user()->id);

        if ($transaction_number) {
            $transactionData->where('transaction_number', $transaction_number);
        }

        if ($status) {
            $transactionData->where('status', $status);
        }

        return ResponseFormatter::success(
            $transactionData->paginate($limit),
            'Data Transaksi Berhasil Diambil'
        );
    }

    public function update(Request $request, $id)
    {
        $transactionData = Transaction::findOrFail($id);

        $transactionData->update($request->all());
        return ResponseFormatter::success($transactionData, 'Data Berhasil diperbaharui');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'total' => 'required',
            'status' => 'required',
            'payment_method' => 'required',
            'payment_picture' => 'required|file|image'
        ]);

        if ($request->hasFile('payment_picture')) {
            $path = $request->file('payment_picture')->store('public/transactions');
        }

        $user = Auth::user()->id;
        $kode = 'TRSC/' . $user . '/' . \date('Ymd') . '/' . \date('his');
        $transactionData = Transaction::create([
            'users_id' => $user,
            'kontrakan_id' => $request->kontrakan_id,
            'transaction_number' => $kode,
            'total' => $request->total,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'payment_picture' => $path,
            'payment_url' => ''
        ]);

        $transactionGetData = Transaction::with('user', 'kontrakan')->where('users_id', $user)->get();
        return ResponseFormatter::success($transactionGetData, 'Transaksi Berhasil');
    }

    public function checkoutAuto(Request $request)
    {

        $request->validate(
            [
                'users_id' => 'required|exists:users,id',
                'kontrakan_id' => 'required|exists:kontrakan,id',
                'total' => 'required',
                'status' => 'required|in:PENDING,CANCELLED,FAILED,SUCCESS',
            ]
        );

        $user = Auth::user()->id;
        $kos   = $request->kontrakan_id;
        $kode = 'TRSC/' . $user . '/' . $kos  . '/' . \date('Ymd') . '/' . \date('his');
        $metode = "Auto Midtrans";

        $transaction = Transaction::create(
            [
                'users_id' => $request->users_id,
                'kontrakan_id' => $request->kontrakan_id,
                'transaction_number' => $kode,
                'total' => $request->total,
                'status' => $request->status,
                'payment_method' => $metode,
                'payment_url' => ''

            ]
        );

        //konfigurasi midtrans
        \Midtrans\Config::$serverKey = \config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = \config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = \config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = \config('services.midtrans.is3ds');

        ///memanggil transaksi  yang dibuat

        $transaction = Transaction::with(['Kontrakan', 'user'])->find($transaction->id);

        //membuat transaksi midtrans

        $midtrans = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => (int) $transaction->total,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => [],
        ];

        //memanggil midtrans

        try {
            //panggil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            // return API

            return ResponseFormatter::success($transaction, 'Transaksi Berhasil');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e, 'Transaksi Gagal');
        }
    }
}
