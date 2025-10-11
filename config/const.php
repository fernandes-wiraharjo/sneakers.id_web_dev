<?php

return [
    'transaction' => [
        'midtrans_status' => [
            'PENDING',        // menunggu customer menyelesaikan pembayaran
            'CAPTURE',        // transaksi kartu kredit berhasil diotorisasi
            'SETTLEMENT',     // pembayaran diterima dan dana sudah settle
            'DENY',           // pembayaran ditolak
            'CANCEL',         // transaksi dibatalkan
            'EXPIRE',         // customer tidak melakukan pembayaran sampai batas waktu
            'FAILURE',        // transaksi gagal
            'REFUND',         // pembayaran dikembalikan (refund penuh)
            'PARTIAL_REFUND', // pembayaran dikembalikan sebagian
            'CHARGEBACK',     // transaksi digugat/dispute oleh bank
        ],
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
