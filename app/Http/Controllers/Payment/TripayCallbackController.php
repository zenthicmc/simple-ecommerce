<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Stock;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

class TripayCallbackController extends Controller
{
    // Isi dengan private key anda
    protected $privateKey = 'aMiNq-PDzZN-ilF39-h7dqy-KawOe';

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return response()->json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $reference = $data->reference;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {
            $transaction = Transaction::where('reference', $reference)->first();

            if (!$transaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found',
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $quantity = $transaction->quantity;
                    $order_items = Stock::where('id_product', $transaction->id_product)->orderBy('created_at', 'asc')->where('available', 'true')->take($quantity)->get();

                    if (count($order_items) < $quantity) {
                        $transaction->update(['status' => 'PENDING']);

                        return response()->json([
                            'success' => false,
                            'message' => 'Insufficient stock',
                        ]);
                    }

                    else {
                        foreach ($order_items as $order_item) {
                            $order_item->isUnlimited == 'true' ? $order_item->update(['available' => 'true']) : $order_item->update(['available' => 'false']);
                            $order_item->save();
                        }

                        $transaction->update([
                            'stock' => $order_items,
                            'status' => 'PAID'
                        ]);
                    }
                    break;

                case 'EXPIRED':
                    $transaction->update(['status' => 'EXPIRED']);
                    break;

                case 'FAILED':
                    $transaction->update(['status' => 'FAILED']);
                    break;

                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid transaction status',
                    ]);
            }

            $transaction->save();
            return response()->json(['success' => true]);
        }
    }
}