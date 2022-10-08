<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Fatura #{{ $order->id }}</title>

    <style>
        *{ font-family: DejaVu Sans !important; font-size: 12px !important;}
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1, h2, h3, h4, h5, h6, p, span, label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

<table class="order-details">
    <thead>
    <tr>
        <th width="50%" colspan="2">
            <h2 class="text-start">JFeel E-Ticaret</h2>
        </th>
        <th width="50%" colspan="2" class="text-end company-data">
            <span>Fatura Id: #{{ $order->id }}</span> <br>
            <span>Tarih: {{ date("d-m-Y") }}</span> <br>
            <span>İl / İlçe : {{ $order->province ."/".$order->county }}</span> <br>
            <span>Adres: {{ $order->address }}</span> <br>
        </th>
    </tr>
    <tr class="bg-blue">
        <th width="50%" colspan="2">Sipariş Detayları</th>
        <th width="50%" colspan="2">Kullanıcı Detayları</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Sipariş Id:</td>
        <td>{{ $order->id }}</td>

        <td>İsim Soyisim:</td>
        <td>{{ $order->full_name }}</td>
    </tr>
    <tr>
        <td>Sipariş Numarası:</td>
        <td>{{ $order->tracking_no }}</td>

        <td>E-mail:</td>
        <td>{{ $order->email }}</td>
    </tr>
    <tr>
        <td>Sipariş Tarihi:</td>
        <td>{{ $order->created_at }}</td>

        <td>Telefon:</td>
        <td>{{ $order->phone }}</td>
    </tr>
    <tr>
        <td>Sipariş Durumu:</td>
        <td>
            @if($order->status_message == 'in progress')
                <span class="text-uppercase">İşleniyor</span>
            @elseif($order->status_message == 'completed')
                <span class="text-uppercase">Tamamlandı</span>
            @elseif($order->status_message == 'pending')
                <span class="text-uppercase">Bekleniyor</span>
            @elseif($order->status_message == 'cancelled')
                <span class="text-uppercase">İptal Edildi</span>
            @else
                <span class="text-uppercase">Dağıtımda</span>
            @endif
        </td>
        <td>Adres:</td>
        <td>{{ $order->address }}</td>


    </tr>
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th class="no-border text-start heading" colspan="5">
            Sipariş Ürünleri
        </th>
    </tr>
    <tr class="bg-blue">
        <th>ID</th>
        <th>Ürün</th>
        <th>Renk</th>
        <th>Birim Fiyatı</th>
        <th>Adet</th>
        <th>Toplam</th>
    </tr>
    </thead>
    <tbody>
    @php $totalPrice = 0; @endphp
    @forelse($order->orderItems as $orderItem)
        <tr>
            <td width="10%">{{ $orderItem->id }}</td>
            <td width="10%">{{ $orderItem->products->name }}</td>
            <td width="10%">
                @if($orderItem->productColors)
                    @if($orderItem->productColors->colors)
                        <span> {{ $orderItem->productColors->colors->name }}</span>
                    @endif
                @else
                    <span>Renk Yok</span>
                @endif
            </td>
            <td width="10%">{{ $orderItem->price }} TL</td>
            <td width="10%">{{ $orderItem->quantity }}</td>
            <td width="15%">{{ $orderItem->quantity*$orderItem->price }} TL</td>
            @php $totalPrice+=$orderItem->quantity*$orderItem->price; @endphp
        </tr>
    @empty
        <tr>
            <td colspan="6">Sipariş Bulunmamaktadır.</td>
        </tr>
    @endforelse
    <tr>
        <td colspan="5" class="total-heading">Toplam Tutar:</td>
        <td colspan="1" class="total-heading">{{ $totalPrice }} TL</td>
    </tr>

    </tbody>
</table>

<br>
<p class="text-center">
    JFeel ile alışveriş yaptığınız için teşekkür ederiz
</p>

</body>
</html>
