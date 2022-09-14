<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PaymentServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Pay with paypal.
     *
     * @test
     * @return void
     */
    public function payWithPayPal()
    {
        Storage::fake('public');

        $response = $this->post('/api/payments/pay', [
            'payment_method' => 'PayPal',
            'amount' => 1,
            'productId' => 2
        ]);

        $response->assertStatus(200);
        Storage::disk('public')->assertExists('PayPal.json');

    }


    /**
     * Pay with visa.
     *  @test
     * @return void
     */
    public function payWithVisa()
    {
        Storage::fake('public');
        $response = $this->post('/api/payments/pay', [
            'payment_method' => 'Visa',
            'amount' => 1,
            'productId' => 2
        ]);

        $response->assertStatus(200);
        Storage::disk('public')->assertExists('Visa.json');
    }

    /**
     * withdraw With paypal.
     *
     * @test
     * @return void
     */
    public function withdrawWithPayPal()
    {
        Storage::fake('public');
        $response = $this->post('/api/payments/withdraw', [
            'payment_method' => 'PayPal',
            'amount' => 1,
            'productId' => 2
        ]);

        $response->assertStatus(200);
        Storage::disk('public')->assertExists('PayPal.json');

    }


    /**
     * Withdraw with visa.
     *  @test
     * @return void
     */
    public function withdrawWithVisa()
    {
        Storage::fake('public');
        $response = $this->post('/api/payments/withdraw', [
            'payment_method' => 'Visa',
            'amount' => 1,
            'productId' => 2
        ]);

        $response->assertStatus(200);
        Storage::disk('public')->assertExists('Visa.json');

    }
}
