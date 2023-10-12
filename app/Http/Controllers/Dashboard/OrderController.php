<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //

    public function index(Request $request){
        //$this->authorizeResource(Admin::class, 'admin');
        if ($request->has('history')) {
            $orders = Order::query()->where('status',1)->get();
        }else{
            $orders = Order::query()->where('status',0)->orderByDesc('id')->get();
        }
        return view('dashboard.orders.index',compact('orders'));
    }

    public function viewOrder($id){
        $order = Order::with('address','products')->where('id',$id)->first();
        $admin_id =Auth::guard('admin')->user()->id;
        $getNotificationId = DB::table('notifications')->where('data->id',$id)->where('notifiable_id',$admin_id)->pluck('id');
        //dd($getNotificationId);
        DB::table('notifications')->where('id',$getNotificationId)->update([
            'read_at'=>now()
        ]);
        return view('dashboard.orders.view-order',compact('order','getNotificationId'));
    }

    public function updateOrder(Request $request,$id){
        Order::query()->where('id',$id)->update(['status'=> $request->input('status')]);
        return redirect()->route('admin.orders.index')->with('success','Order is updated successfully');
    }

    public function MarkAsRead_all(){
        $userUnReadNotifications = Auth::guard('admin')->user()->unreadNotifications;
        if($userUnReadNotifications){
            $userUnReadNotifications->markAsRead();
            return redirect()->back();
        }
    }
}
