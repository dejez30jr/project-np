<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 3px solid #4f46e5;
            padding-bottom: 16px;
            margin-bottom: 20px;
        }
        .brand h1 {
            margin: 0;
            font-size: 20px;
            color: #4f46e5;
        }
        .brand p {
            margin: 2px 0 0;
            color: #64748b;
            font-size: 11px;
        }
        .doc-title {
            text-align: right;
            font-size: 24px;
            font-weight: bold;
            color: #1e293b;
        }
        .meta-row {
            margin-bottom: 5px;
        }
        .meta-row .label {
            color: #64748b;
            display: inline-block;
            width: 160px;
        }
        .meta-row .value {
            font-weight: 600;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
        }
        .badge-unpaid { background:#fee2e2; color:#b91c1c; }
        .badge-pending { background:#fef3c7; color:#92400e; }
        .badge-paid { background:#dcfce7; color:#15803d; }
        .badge-cancelled { background:#f1f5f9; color:#475569; }
        .badge-empty { background:#e2e8f0; color:#475569; }
        section { margin-bottom: 18px; }
        section h2 {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #4f46e5;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 6px;
            margin: 0 0 10px;
        }
        .client-detail td { padding: 3px 0; }
        .client-detail .label { color: #64748b; width: 170px; }
        table.items {
            width: 100%;
            border-collapse: collapse;
        }
        table.items th, table.items td {
            border: 1px solid #e2e8f0;
            padding: 8px 10px;
            text-align: left;
        }
        table.items th {
            background: #eef2ff;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #4f46e5;
        }
        .amount-col, .txt-right { text-align: right; }
        .total td {
            font-weight: bold;
            background: #f4f4ff;
        }
        .notes-box {
            border: 1px solid #e2e8f0;
            border-left: 4px solid #4f46e5;
            padding: 10px 12px;
            color: #475569;
            background: #fafaff;
        }
        footer {
            margin-top: 30px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
            font-size: 10px;
            color: #94a3b8;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">
            <h1>Neuron Production</h1>
            <p>Solusi Website &amp; Digital Creative</p>
        </div>
        <div class="doc-title">INVOICE</div>
    </header>

    <div class="invoice-meta">
        @if ($invoice->invoice_number)
            <div class="meta-row">
                <span class="label">Nomor Invoice</span>
                <span class="value">{{ $invoice->invoice_number }}</span>
            </div>
        @endif
        @if ($invoice->invoice_date)
            <div class="meta-row">
                <span class="label">Tanggal Invoice</span>
                <span class="value">{{ $invoice->invoice_date->format('d M Y') }}</span>
            </div>
        @endif
        @if ($invoice->deadline)
            <div class="meta-row">
                <span class="label">Deadline</span>
                <span class="value">{{ $invoice->deadline->format('d M Y') }}</span>
            </div>
        @endif
        @if ($invoice->payment_status)
            <div class="meta-row">
                <span class="label">Status Pembayaran</span>
                <span class="badge badge-{{ $invoice->payment_status ?: 'empty' }}">{{ \App\Support\PaymentStatuses::label($invoice->payment_status) }}</span>
            </div>
        @endif
    </div>

    <section>
        <h2>Ditagihkan Kepada</h2>
        <table class="client-detail">
            @if ($invoice->client)
                <tr>
                    <td class="label">Nama</td>
                    <td>{{ $invoice->client->name }}</td>
                </tr>
                @if ($invoice->client->whatsapp)
                    <tr>
                        <td class="label">WhatsApp</td>
                        <td>{{ $invoice->client->whatsapp }}</td>
                    </tr>
                @endif
                @if ($invoice->client->address)
                    <tr>
                        <td class="label">Alamat</td>
                        <td>{{ $invoice->client->address }}</td>
                    </tr>
                @endif
            @else
                <tr><td>—</td></tr>
            @endif
        </table>
    </section>

    <section>
        <h2>Detail Project</h2>
        @if ($invoice->client)
            <table class="client-detail">
                @if ($invoice->client->project_name)
                    <tr>
                        <td class="label">Nama Project</td>
                        <td>{{ $invoice->client->project_name }}</td>
                    </tr>
                @endif
                @if ($invoice->client->project_description)
                    <tr>
                        <td class="label">Deskripsi</td>
                        <td>{{ $invoice->client->project_description }}</td>
                    </tr>
                @endif
            </table>
        @endif
    </section>

    <section>
        <h2>Rincian Tagihan</h2>
        <table class="items">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th class="amount-col">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $invoice->description }}</td>
                    <td class="amount-col">Rp {{ number_format((float) $invoice->amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="total">
                    <td>Total</td>
                    <td class="amount-col">Rp {{ number_format((float) $invoice->amount, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </section>

    @if ($invoice->notes)
        <section>
            <h2>Catatan</h2>
            <div class="notes-box">{{ $invoice->notes }}</div>
        </section>
    @endif

    <footer>
        <span>Dibuat otomatis oleh sistem NP Studio</span>
        <span>Tanggal cetak: {{ now()->format('d M Y H:i') }}</span>
    </footer>
</body>
</html>
