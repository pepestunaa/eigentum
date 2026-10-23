<?php
 
namespace App\Http\Controllers;
 
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Midtrans\CallbackService;
 
class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;

        if (!$callback->getOrder()) {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Order tidak ditemukan',
                ], 404);
        }
 
        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();
 
            if ($callback->isSuccess()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => 2,
                ]);
            }
 
            if ($callback->isExpire()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => 3,
                ]);
            }
 
            if ($callback->isCancelled()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => 4,
                ]);
            }
 
            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }

    public function finish(Request $request)
    {
        $orderId = $request->input('order_id');
        $order = $orderId ? Order::where('number', $orderId)->first() : null;

        if ($order) {
            return redirect()->route('detailorder', $order->id);
        }

        return redirect()->route('beranda');
    }
}