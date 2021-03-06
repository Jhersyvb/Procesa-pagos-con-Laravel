<label class="mt-3">Card details:</label>

<div class="form-group form-row">
    <div class="col-5">
        <input type="text" id="cardNumber" class="form-control" data-checkout="cardNumber" placeholder="Card Number">
    </div>

    <div class="col-2">
        <input type="text" class="form-control" data-checkout="securityCode" placeholder="CVC">
    </div>

    <div class="col-1"></div>

    <div class="col-1">
        <input type="text" class="form-control" data-checkout="cardExpirationMonth" placeholder="MM">
    </div>

    <div class="col-1">
        <input type="text" class="form-control" data-checkout="cardExpirationYear" placeholder="YY">
    </div>
</div>

<div class="form-group form-row">
    <div class="col-5">
        <input type="text" class="form-control" data-checkout="cardholderName" placeholder="Your Name">
    </div>
    <div class="col-5">
        <input type="text" class="form-control" data-checkout="cardholderEmail" placeholder="email@example.com"
            name="email">
    </div>
</div>

<div class="form-group form-row">
    <div class="col-2">
        <select class="custom-select" data-checkout="docType"></select>
    </div>
    <div class="col-3">
        <input type="text" class="form-control" data-checkout="docNumber" placeholder="Document">
    </div>
</div>

<div class="form-group form-row">
    <div class="col">
        <small class="form-text text-muted">Your payment will be converted
            to {{ strtoupper(config('services.mercadopago.base_currency')) }}</small>
    </div>
</div>

<div class="form-group form-row">
    <div class="col">
        <small class="form-text text-danger" id="paymentErrors" role="alert"></small>
    </div>
</div>

<input type="hidden" id="cardNetwork" name="card_network">
<input type="hidden" id="cardToken" name="card_token">

@push('scripts')
    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
    <script>
        const mercadoPago = window.Mercadopago;

        mercadoPago.setPublishableKey('{{ config('services.mercadopago.key') }}');

        mercadoPago.getIdentificationTypes();
    </script>

    <script>
        document.getElementById('cardNumber').addEventListener('keyup', guessPaymentMethod);
        document.getElementById('cardNumber').addEventListener('change', guessPaymentMethod);

        function guessPaymentMethod(event) {
            let cardNumber = document.getElementById('cardNumber').value;

            if (cardNumber.length >= 6) {
                let bin = cardNumber.substring(0, 6);
                mercadoPago.getPaymentMethod({
                    'bin': bin
                }, setPaymentMethod);
            }
        }

        function setPaymentMethod(status, response) {
            if (status == 200) {
                let paymentMethodId = response[0].id;
                let cardNetwork = document.getElementById('cardNetwork');
                cardNetwork.value = paymentMethodId;
            } else {
                alert(`payment method info error: ${response}`);
            }
        }
    </script>

    <script>
        const mercadoPagoForm = document.getElementById('paymentForm');

        mercadoPagoForm.addEventListener('submit', function (e) {
            if (mercadoPagoForm.elements.payment_platform.value === "{{ $paymentPlatform->id }}") {
                e.preventDefault();

                mercadoPago.createToken(mercadoPagoForm, function (status, response) {
                    if (status != 200 && status != 201) {
                        const errors = document.getElementById('paymentErrors');

                        errors.textContent = response.cause[0].description;
                    } else {
                        const cardToken = document.getElementById('cardToken');

                        cardToken.value = response.id;

                        mercadoPagoForm.submit();
                    }
                });
            }
        });
    </script>
@endpush
