<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - NYEKUY</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .back-btn {
            width: 40px;
            height: 40px;
            background: white;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: #f0f0f0;
            transform: translateX(-2px);
        }

        .page-title {
            font-size: 32px;
            font-weight: 600;
            color: #333;
        }

        .filter-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-btn {
            background-color: white;
            color: #333;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .dropdown-btn:hover {
            border-color: #8B1538;
        }

        .dropdown-btn i {
            font-size: 12px;
        }

        .search-container {
            position: relative;
            flex-grow: 1;
            max-width: 350px;
            margin-left: auto;
            /* Push to the right */
        }

        .search-input {
            width: 100%;
            padding: 12px 15px 12px 40px; 
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease;
            background: white;
        }


        .search-input:focus {
            border-color: #8B1538;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .search-text {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            pointer-events: none;
            /* Allow clicks to pass through to input */
        }

        .main-content {
            background: white;
            border-radius: 16px;
            padding: 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .table-header {
            background: #e9ecef;
            padding: 15px 20px;
            display: grid;
            grid-template-columns: 50px 120px 120px 1fr 120px;
            /* Sesuaikan lebar kolom */
            gap: 20px;
            font-weight: 600;
            color: #495057;
            font-size: 14px;
        }

        .table-row {
            padding: 15px 20px;
            display: grid;
            grid-template-columns: 50px 120px 120px 1fr 120px;
            /* Sesuaikan lebar kolom */
            gap: 20px;
            align-items: center;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.3s ease;
        }

        .table-row:hover {
            background-color: #f8f9fa;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-cell {
            color: #333;
            font-size: 14px;
        }

        .total-card-container {
            display: flex;
            justify-content: flex-end;
            padding: 0 20px 20px 0;
            /* Padding bottom and right for the card */
        }

        .total-card {
            background: #8B1538;
            color: white;
            padding: 20px 30px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .total-card-label {
            font-size: 16px;
            font-weight: 500;
        }

        .total-card-amount {
            font-size: 20px;
            font-weight: 700;
        }

        @media print {
            .header, .filter-section, .back-btn {
                display: none !important;
            }

            .print-title {
                display: block !important;
                text-align: center !important;
                font-size: 32px !important;
                font-weight: bold !important;
                margin-bottom: 10px !important;
            }

            .print-date {
                display: block !important;
                text-align: center !important;
                font-size: 14px !important;
                margin-bottom: 20px !important;
            }
        }

        .print-title {
            display: none;
        }

        .print-date {
            display: none;
        }





        @media (max-width: 1024px) {
            .container {
                padding: 15px;
            }

            .filter-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .search-container {
                margin-left: 0;
                width: 100%;
                max-width: none;
            }

            .table-header,
            .table-row {
                grid-template-columns: 40px 100px 100px 1fr 100px;
                /* Sesuaikan lebar kolom */
                gap: 10px;
                font-size: 12px;
            }

            .total-card-container {
                justify-content: center;
                padding: 0 15px 15px 15px;
            }

            .total-card {
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 28px;
            }

            .dropdown-btn,
            .search-input {
                padding: 10px 12px;
                font-size: 12px;
            }

            .search-icon,
            .search-text {
                font-size: 12px;
            }

            .table-header,
            .table-row {
                grid-template-columns: 30px 80px 80px 1fr 80px;
                /* Sesuaikan lebar kolom */
                font-size: 10px;
            }

            .total-card-label {
                font-size: 14px;
            }

            .total-card-amount {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="print-title">Laporan NYEKUY</div>
        <div class="print-date">Dicetak pada: <span id="printDate"></span></div>
        <!-- Header -->
        <div class="header">
            <button class="back-btn" onclick="goBack()">
                <i class="fas fa-arrow-left"></i>
            </button>
            <h1 class="page-title">Laporan</h1>
        </div>

        <div class="filter-section">
            <form method="GET" action="{{ route('reports.index') }}" style="display:flex; gap:10px;">
                <!-- Filter Tahun -->
                <select name="year" class="dropdown-btn">
                    <option value="">Semua Tahun</option>
                    <option value="2024" {{ request('year') == '2024' ? 'selected' : '' }}>2024</option>
                    <option value="2025" {{ request('year') == '2025' ? 'selected' : '' }}>2025</option>
                </select>
                <select name="month" class="dropdown-btn">
                    <option value="">Semua Bulan</option>
                    <option value="01" {{ request('month') == '01' ? 'selected' : '' }}>Januari</option>
                    <option value="02" {{ request('month') == '02' ? 'selected' : '' }}>Februari</option>
                    <option value="03" {{ request('month') == '03' ? 'selected' : '' }}>Maret</option>
                    <option value="04" {{ request('month') == '04' ? 'selected' : '' }}>April</option>
                    <option value="05" {{ request('month') == '05' ? 'selected' : '' }}>Mei</option>
                    <option value="06" {{ request('month') == '06' ? 'selected' : '' }}>Juni</option>
                    <option value="07" {{ request('month') == '07' ? 'selected' : '' }}>Juli</option>
                    <option value="08" {{ request('month') == '08' ? 'selected' : '' }}>Agustus</option>
                    <option value="09" {{ request('month') == '09' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ request('month') == '10' ? 'selected' : '' }}>Oktober</option>
                    <option value="11" {{ request('month') == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ request('month') == '12' ? 'selected' : '' }}>Desember</option>
                </select>

                <!-- Tombol Filter -->
                <button type="submit" style="padding:10px 15px; background:#8B1538; color:white; border:none; border-radius:8px;">
                    Filter
                </button>

                <!-- Tombol Cetak Laporan -->
                <button type="button" onclick="printReport()" style="padding:10px 15px; background:#198754; color:white; border:none; border-radius:8px;">
                    Cetak Laporan
                </button>
            </form>
        </div>



        <div class="main-content">
            <!-- Table Header -->
            <div class="table-header">
                <div>No</div> <!-- Kolom nomor -->
                <div>KODE_LAPORAN</div>
                <div>TGL_LAPORAN</div>
                <div>PENDAPATAN</div>
                <div>KODE_TRANSAKSI</div>
            </div>


            <!-- Table Body -->
        <div id="reportsTable">
            @foreach($Laporann as $Lapor)
                <div class="table-row">
                    <div>{{ $loop->iteration }}</div> <!-- Nomor -->
                    <div>{{ $Lapor->kode_laporan }}</div>
                    <div>{{ $Lapor->tgl_laporan->format('d-m-Y') }}</div>
                    <div>Rp {{ number_format($Lapor->pendapatan, 0, ',', '.') }}</div>
                    <div>{{ $Lapor->kode_transaksi }}</div>
                </div>
            @endforeach
        </div>
        </div>


        <!-- Total Pendapatan Card -->
        <div class="total-card-container">
            <div class="total-card">
                <span class="total-card-label">Total Pendapatan</span>
                <span class="total-card-amount">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
            </div>
        </div>

    </div>

    <script>
        function printReport() {
            window.print(); // Langsung cetak halaman ini
        }

        function goBack() {
            window.history.back(); // Kembali ke halaman sebelumnya
        }

        document.getElementById('printDate').textContent = new Date().toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        // Fungsi pencarian (hanya untuk tampilan, tidak ada filter backend)
        document.getElementById('searchInput').addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#reportsTable .table-row');

            rows.forEach(row => {
                // Ambil teks dari setiap sel yang relevan untuk pencarian
                const kodeLaporan = row.children[1].textContent.toLowerCase();
                const tglLaporan = row.children[2].textContent.toLowerCase();
                const kodeTransaksi = row.children[4].textContent.toLowerCase();

                if (kodeLaporan.includes(searchTerm) || tglLaporan.includes(searchTerm) || kodeTransaksi
                    .includes(searchTerm)) {
                    row.style.display = 'grid';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>