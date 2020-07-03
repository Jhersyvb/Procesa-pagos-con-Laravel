<?php

use App\PaymentPlatform;
use Illuminate\Database\Seeder;

class PaymentPlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentPlatform::create([
            'name' => 'PayPal',
            'image' => 'images/payment-platforms/paypal.jpg',
        ]);

        PaymentPlatform::create([
            'name' => 'Stripe',
            'image' => 'images/payment-platforms/stripe.jpg',
        ]);

        PaymentPlatform::create([
            'name' => 'MercadoPago',
            'image' => 'images/payment-platforms/mercadopago.jpg',
        ]);
    }
}
