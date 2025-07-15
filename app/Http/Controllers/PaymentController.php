<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function showPaymentForm(Request $request)
    {
        // Hanya metode pembayaran tunai
        $paymentMethods = [
            [
                'id' => 'cash',
                'name' => 'Tunai',
                'icon' => 'money-bill-wave',
                'color' => 'green'
            ]
        ];

        $quickAmounts = [10000, 20000, 50000, 100000];
        
        // Simulasi total pesanan - dalam implementasi nyata bisa dari session/database
         $orderTotal = $request->input('total', 0);

        return view('payment.form', compact('paymentMethods', 'quickAmounts', 'orderTotal'));
    }

    public function calculateChange(Request $request)
    {
        $orderTotal = $request->order_total;
        $paidAmount = $request->paid_amount;
        
        $change = $paidAmount - $orderTotal;
        
        return response()->json([
            'change' => $change,
            'formatted_change' => number_format($change, 0, ',', '.'),
            'is_sufficient' => $change >= 0
        ]);
    }

    public function processPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paid_amount' => 'required|numeric|min:1',
            'order_total' => 'required|numeric',
            'payment_method' => 'required|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $orderTotal = $request->order_total;
        $paidAmount = $request->paid_amount;
        $change = $paidAmount - $orderTotal;

        // Validasi uang yang dibayarkan harus cukup
        if ($change < 0) {
            return back()->with('error', 'Uang yang dibayarkan kurang dari total pesanan!')->withInput();
        }

        $paymentData = [
            'order_total' => $orderTotal,
            'paid_amount' => $paidAmount,
            'change_amount' => $change,
            'payment_method' => $request->payment_method,
            'transaction_id' => 'TXN-' . time() . '-' . rand(1000, 9999),
            'status' => 'completed',
            'payment_date' => now()
        ];

        // Simulasi proses pembayaran tunai
        $paymentResult = $this->processCashPayment($paymentData);

        if ($paymentResult['success']) {
            return redirect()->route('payment.success')->with('payment_data', $paymentData);
        } else {
            return back()->with('error', 'Pembayaran gagal. Silakan coba lagi.');
        }
    }

    private function processCashPayment($paymentData)
    {
        // Simulasi proses pembayaran tunai
        // Dalam implementasi nyata, ini bisa menyimpan ke database
        
        return [
            'success' => true,
            'transaction_id' => $paymentData['transaction_id'],
            'message' => 'Pembayaran tunai berhasil'
        ];
    }

    public function paymentSuccess()
    {
        $paymentData = session('payment_data');
        
        if (!$paymentData) {
            return redirect()->route('payment.form');
        }

        return view('payment.success', compact('paymentData'));
    }
}