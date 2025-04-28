<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      width: 80mm;
      margin: 0 auto;
      padding: 10px;
    }
    .wrapper {
      width: 100%;
    }
    header {
      text-align: center;
      margin-bottom: 10px;
    }
    header h3 {
      margin: 0;
      font-size: 14px;
      font-weight: bold;
    }
    header p {
      margin: 2px 0;
      font-size: 10px;
    }
    .divider {
      border-top: 1px dashed #000;
      margin: 5px 0;
    }
    .item-row {
      display: flex;
      justify-content: space-between;
      margin: 3px 0;
    }
    .left {
      text-align: left;
    }
    .right {
      text-align: right;
    }
    .grandtotal {
      font-weight: bold;
      margin-top: 5px;
    }
    .payment-section {
      margin-top: 10px;
    }
    .highlight {
      font-weight: bold;
    }
  </style>
</head>
<body onload="window.print()">
  <div class="wrapper">
    <header>
      <h3>PT MENCARI CINTA SEJATI</h3>
      <p>Jl Antara, Rt 02 Rw 09 Pondok Gede</p>
      <p>No Tlpn. 0895383140377</p>
    </header>
    
    <div class="divider"></div>
    
    <div>
      <div>Tanggal : {{date("d M Y", strtotime($order->order_date))}}</div>
      <div>No Transaksi: {{$order->order_code}}</div>
    </div>
    
    <div class="divider"></div>
    
    @foreach ($orderDetails as $orderDetail)
    <div class="item-row">
      <div class="left">{{$orderDetail->product->product_name ?? ''}}</div>
      <div class="right">{{number_format($orderDetail->order_subtotal)}}</div>
    </div>
    <div class="item-row">
      <div class="left">{{$orderDetail->qty}} x {{number_format($orderDetail->order_price)}}</div>
      <div class="right"></div>
    </div>
    @endforeach
    
    <div class="divider"></div>
    
    <div class="item-row grandtotal">
      <div class="left">TOTAL</div>
      <div class="right">{{number_format($order->order_amount)}}</div>
    </div>
    
    <div class="payment-section">
      <div class="item-row">
        <div class="left">TUNAI</div>
        <div class="right">{{number_format($tunai)}}</div>
      </div>
      <div class="item-row highlight">
        <div class="left">KEMBALI</div>
        <div class="right">{{number_format($order->order_change)}}</div>
      </div>
    </div>
    
    <div class="divider"></div>
    
    <div style="text-align: center; margin-top: 15px;">
      <p>Terima kasih atas kunjungan Anda</p>
      <p>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</p>
    </div>
  </div>
</body>
</html>