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
        	return 'Invalid signature';
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return 'Invalid callback event, no action was taken';
        }

        $data = json_decode($json);
        $uniqueRef = $data->reference;
        $status = strtoupper((string) $data->status);

        /*
        |--------------------------------------------------------------------------
        | Proses callback untuk closed payment
        |--------------------------------------------------------------------------
        */
        if (1 === (int) $data->is_closed_payment) {
            $transaction = Transaction::where('reference', $uniqueRef)->first();
			$product = Product::where('id', $transaction->id_product)->first();
       		$stock = Stock::where('id_product', $product->id)->where('available', 'true')->first();

            if (!$transaction) {
                return 'No invoice found for this unique ref: ' . $uniqueRef;
            }

			if ($stock && $status === 'PAID') {
                $count = $transaction->quantity;
                for ($i = 0; $i < $count; $i++) {
                    $stock = Stock::where('id_product', $product->id)->where('available', 'true')->first();
                    // update transaction stock without removing previous value
                    $transaction->update([
                        'stock' => $transaction->stock . $stock->content
                    ]);
                    $stock->isUnlimited == 'true' ? $stock->update(['available' => 'true']) : $stock->update(['available' => 'false']);
                }

                $payload = [
                    'iss' => env('APP_NAME'),
                    'aud' => $transaction->reference,
                    'iat' => time(),
                    'exp' => time() + 60 * 60 * 24 * 30,
                ];

                $review_code = JWT::encode($payload, env('JWT_KEY'), 'HS256');
                $transaction->update([
                    'status' => 'PAID',
                    'review_code' => $review_code
                ]);

                Mail::to($transaction->email)->send(new OrderShipped($transaction));
                return response()->json([
                    'success' => true,
                    'message' => 'Payment success, please check your email',
                    'transaction' => $transaction,
                ]);

            } else {
                $transaction->update(['status' => 'Pending']);
                return response()->json([
                    'success' => true,
                    'message' => 'Stock is not available, please contact admin'
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Proses callback untuk open payment
        |--------------------------------------------------------------------------
        */
        $transaction = Transaction::where('reference', $uniqueRef)
            ->where('status', 'UNPAID')
            ->first();

        if (!$transaction) {
            return 'Invoice not found or current status is not UNPAID';
        }

        if ((int) $data->total_price !== (int) $transaction->total_price) {
            return 'Invalid price, Expected: ' . $transaction->total_price . ' - Received: ' . $data->total_price;
        }

        switch ($data->status) {
            case 'PAID':
				$transaction->update(['status' => $status]);
           		return response()->json(['success' => true]);

            case 'EXPIRED':
                $transaction->update(['status' => 'EXPIRED']);
                return response()->json(['success' => true]);

            case 'FAILED':
                $transaction->update(['status' => 'FAILED']);
                return response()->json(['success' => true]);

            default:
                return response()->json(['error' => 'Unrecognized payment status']);
        }
    }
}