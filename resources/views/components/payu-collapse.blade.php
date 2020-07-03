<label class="mt-3">Card details:</label>

<div class="form-group form-row">
    <div class="col-5">
        <input type="text" name="card" class="form-control" placeholder="Card Number">
    </div>

    <div class="col-2">
        <input type="text" name="cvc" class="form-control" placeholder="CVC">
    </div>

    <div class="col-1"></div>

    <div class="col-1">
        <input type="text" name="mont" class="form-control" placeholder="MM">
    </div>

    <div class="col-1">
        <input type="text" name="year" class="form-control" placeholder="YY">
    </div>

    <div class="col-2">
        <select name="network" class="custom-select">
            <option selected>Select</option>
            <option value="visa">VISA</option>
            <option value="amex">AMEX</option>
            <option value="diners">DINERS</option>
            <option value="mastercard">MASTERCARD</option>
        </select>
    </div>
</div>

<div class="form-group form-row">
    <div class="col-6">
        <input type="text" name="name" class="form-control" placeholder="Your name">
    </div>
    <div class="col-6">
        <input type="text" name="email" class="form-control" placeholder="email@example.com">
    </div>
</div>

<div class="form-group form-row">
    <div class="col">
        <small class="form-text text-muted" role="alert">Your payment will be converted
            to {{ strtoupper(config('services.payu.base_currency')) }}</small>
    </div>
</div>

