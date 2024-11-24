@extends('layouts.app2')

@section('title', '| Payment Details')

@section('content')
    <div class="content-wrapper">
        <div class="container-full">

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Order: #{{ $paymentData['order_id'] }}</h5>
                    </div>
                    <div class="card-body">
                        <!-- Price and Amount Section -->
                        <p><strong>Price:</strong> {{ $paymentData['price_amount'] }} {{ strtoupper($paymentData['price_currency']) }}</p>
                        <p><strong>Amount:</strong> {{ $paymentData['pay_amount'] }} {{ strtoupper($paymentData['pay_currency']) }}
                            <span class="badge badge-danger">{{ strtoupper($paymentData['pay_currency']) }}</span> <!-- Badge with payment currency -->
                        </p>

                        <!-- Address and QR Code Section -->
                        <p><strong>Address:</strong> {{ $paymentData['pay_address'] }}</p>
                        <div class="text-center">
                            {!! QrCode::size(200)->generate($payment_link) !!}
                        </div>

                        <!-- Payment Status Section -->
                        <div class="status-section mt-4">
                            <p><strong>Status:</strong>
                                <span class="text-warning">{{ $paymentData['payment_status'] }}</span>
                                </p>
                        </div>

                        <!-- Permanent Link Section -->
                        <div class="mt-3">
                            <p><strong>Share a permanent link to a hosted page:</strong></p>
                            <a href="{{ $payment_link }}" target="_blank">
                                {{ $payment_link }}
                            </a>
                            <button class="btn btn-light btn-sm" onclick="copyLink()">Copy</button>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="" class="btn btn-secondary">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>

    <!-- Copy link to clipboard function -->
    <script>
        function copyLink() {
            var copyText = "{{ $payment_link }}";
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = copyText;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            alert("Link copied to clipboard!");
        }
    </script>
@endsection
