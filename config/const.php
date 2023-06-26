<?php

return [
    'transaction' => [
        'xendit_status' => [
            'PENDING', //still pending to be processed.
            'PAID', // transaction has been paided
            'SETTLED', // transaction money is settled to xendit
            'EXPIRED', // transaction will be canceled due expiration
            'SUCCESS', // success send and arrive
            'FAILED', // ya failed
            'VOIDED', // transaksi voided
            'REVERSED' //dibatalkan xendit
        ],
        'shipping_status' => [
            'ORDER ACCEPTED', // order diterima
            'PACKING', // sedang dikemas
            'SHIPPED', // dikirim
            'ON DELIVERY', // sedang di kirim
            'DELIVERED', // terkirim
            'COMPLETED', // selesai
            'CANCELLED', // dibatalkan
        ]
    ],
];
