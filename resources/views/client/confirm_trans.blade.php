@extends('layouts.app2')

@section('title', '| V75 Pro Dashboard')

@section('content')
    <style>
        .disabled {
            pointer-events: none;
            opacity: 0.6;
        }
        #countdown {
            font-weight: bold;
            color: red;
        }
    </style>

    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#"><i class="mdi mdi-home-outline"></i></a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">Compte</li>
                                    <li class="breadcrumb-item active" aria-current="page">Transaction</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <section class="content">
                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title text-info" style="font-weight: 500;">Transaction</h3>
                            </div>
                            <div class="box-body">
                                <p class="text-gray-600">
                                    Veuillez fournir le numéro de transaction dans un délai de
                                    <span id="countdown">1:30</span> !
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title text-info">Entrer le numéro de transaction</h4>
                                @if (Session::has('error'))
                                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                @endif
                                @if (Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif
                            </div>

                            <form class="form-horizontal" action="{{ route('client.confirmation') }}" method="post" id="transaction_form">
                                @csrf

                                <div class="box-body">
                                    <div class="alert alert-info" style="cursor: pointer;" id="usdtAccount" onclick="copyToClipboard('usdtAccount')">
                                        <strong>Compte USDT :</strong> <span>{{ $usdtAccount }}</span>
                                        <small class="text-muted">(Cliquez pour copier)</small>
                                    </div>


                                    <div class="form-group row">
                                        <label for="transaction_number" class="col-sm-2 form-label">Numéro de transaction :</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="transaction_number" name="transaction_number" placeholder="123456789" required>
                                        </div>
                                    </div>

                                    <input type="hidden" id="transaction_id" name="transaction_id" value="{{ $trans->id }}">
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info">Soumettre</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            const textToCopy = element.textContent || element.innerText;

            navigator.clipboard.writeText(textToCopy).then(() => {
                alert("Compte USDT copié dans le presse-papiers !");
            }).catch(err => {
                console.error("Erreur lors de la copie :", err);
            });
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const countdownElement = document.getElementById('countdown');
            const form = document.getElementById('transaction_form');
            const transactionId = document.getElementById('transaction_id').value;
            const cancelButton = document.getElementById('cancel_button');
            let timeLeft = 90;

            // Countdown timer
            const countdownTimer = setInterval(() => {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;

                countdownElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

                if (timeLeft <= 0) {
                    clearInterval(countdownTimer);
                    form.classList.add('disabled');
                    countdownElement.textContent = "Temps écoulé";
                    cancelTransaction(transactionId);
                }
                timeLeft--;
            }, 1000);

            // Cancel transaction function
            const cancelTransaction = async (transactionId) => {
                try {
                    const response = await fetch(`/client/invest/cancel/${transactionId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }
                    });
                    const data = await response.json();
                    if (data.success) {
                        alert('Transaction annulée avec succès.');
                        window.location.href = '{{ route('client.deposits') }}';
                    } else {
                        alert('Erreur lors de l\'annulation de la transaction.');
                    }
                } catch (error) {
                    console.error('Erreur lors de l\'annulation :', error);
                }
            };

            // Cancel button event listener
            cancelButton.addEventListener('click', () => cancelTransaction(transactionId));

            // Automatically cancel transaction on page unload
            window.addEventListener('beforeunload', () => cancelTransaction(transactionId));
        });
    </script>
@endsection
