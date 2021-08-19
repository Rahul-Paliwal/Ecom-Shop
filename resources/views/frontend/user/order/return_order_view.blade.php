@extends('frontend.main_master')
@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
        @include('frontend.common.user_sidebar')
                <br><br>
                <div class="col-md-1"></div>
            <div class="col-md-9">
                <div class="table-responsive">
                    <table  class="table table-hover">
                        <thead style="background:#d8d5d5;">
                            <tr>
                            <td class="col-md-1">
                                    <label for="">Date</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="">Total</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Payment</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Invoice</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Return Reason</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Order Status</label>
                                </td>
                            </tr>
                                
                            </thead>
                        <tbody style="background:#d5eff39c;">
                            
                            @forelse($orders as $order)
                            <tr>
                                <td class="col-md-1">
                                    <label for="">{{$order->order_date}}</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="">₹{{$order->amount}}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">{{$order->payment_method}}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">{{$order->invoice_no}}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">{{$order->return_reason}}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">
                                    @if($order->return_order==0)    
                                       <span class="badge badge-pill badge-warning" style="background:#418089;">No Return Request</span>
                                    @elseif($order->return_order==1)   
                                       <span class="badge badge-pill badge-warning" style="background:#800000;">Pending</span>
                                       <span class="badge badge-pill badge-warning" style="background:red;">Return Requested</span>
                                    @elseif($order->return_order==2)
                                      <span class="badge badge-pill badge-warning" style="background:#008000;">Success</span>
                                    @endif  
                                </label>
                                </td>
                               
                            </tr>

                            @empty
                            <h2 class="text-danger">No Any Order!  </h2>
                            @endforelse
                        </tbody>
                    </table>
                </div>  
            </div>
       
        </div>
    </div>

</div>

@endsection