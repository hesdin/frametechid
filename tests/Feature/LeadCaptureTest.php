<?php

use App\Models\Lead;

test('public visitors can submit a lead form from the website', function () {
    $this->post(route('leads.capture'), [
        'name' => 'Rizal',
        'business_name' => 'Makassar Digital',
        'phone_number' => '081234567890',
        'email' => 'rizal@example.test',
        'service_interest' => 'Jasa Pembuatan Aplikasi Web',
        'message' => 'Kami butuh aplikasi internal untuk operasional tim penjualan di Makassar.',
    ])->assertRedirect();

    $this->assertDatabaseHas('leads', [
        'name' => 'Rizal',
        'status' => Lead::STATUS_NEW,
        'source' => 'website',
    ]);
});
