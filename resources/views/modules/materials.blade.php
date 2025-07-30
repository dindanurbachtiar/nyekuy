<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahan Baku - Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* CSS ANDA YANG ASLI - DENGAN PENYESUAIAN GRID SANGAT MINIMAL */
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
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .left-header {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .menu-section {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
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

        .right-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .add-btn {
            width: 45px;
            height: 45px;
            background: white;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .add-btn:hover {
            background: #f8f9fa;
            border-color: #8B1538;
            color: #8B1538;
        }

        .search-container {
            position: relative;
            width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            border-color: #8B1538;
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            width: 35px;
            height: 35px;
            background: #f8f9fa;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* STRUKTUR GRID PALING UMUM UNTUK KEDUA TABEL (5 KOLOM) */
        .table-header {
            background: #e9ecef;
            padding: 15px 20px;
            display: grid;
            /* Default 5 kolom: Kode, Nama, Stok, Harga, Aksi */
            grid-template-columns: 150px 1fr 100px 150px 180px;
            gap: 20px;
            font-weight: 600;
            color: #495057;
            font-size: 14px;
        }

        .table-row {
            padding: 15px 20px;
            display: grid;
            /* Default 5 kolom */
            grid-template-columns: 150px 1fr 100px 150px 180px;
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

        .material-code {
            background: #e9ecef;
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 600;
            color: #495057;
            text-align: center;
            font-size: 14px;
        }

        .material-name {
            font-weight: 500;
            color: #333;
        }

        .material-qty {
            font-weight: 500;
            color: #666;
        }

        .material-price {
            font-weight: 500;
            color: #666;
        }

        /* Kolom yang disembunyikan secara default akan diatur JS */
        .hidden-col {
            display: none;
        }


        .show-seblak,
        .show-minuman {
            background: #8B1538;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .show-seblak.active,
        .show-minuman.active {
            background: #A91B47;
        }

        .show-seblak:hover,
        .show-minuman:hover {
            background: #A91B47;
        }

        .show-seblak:disabled,
        .show-minuman:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .edit-btn {
            background: #8B1538;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }


        .delete-btn:hover {
            background: #b02a37;
        }


        .edit-btn:hover {
            background: #A91B47;
        }

        /* Modal Styles (tidak berubah) */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 0;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            background: #f8f9fa;
            padding: 20px 25px;
            border-radius: 16px 16px 0 0;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .modal-back-btn {
            width: 35px;
            height: 35px;
            background: white;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }

        .modal-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }


        .form-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            border-color: #8B1538;
            background: white;
        }

        .modal-submit-btn {
            width: 100%;
            background: #8B1538;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .modal-submit-btn:hover {
            background: #A91B47;
        }

        @media (max-width: 1024px) {
            .container {
                padding: 15px;
            }

            .search-container {
                width: 250px;
            }

            /* Media Queries untuk table-header dan table-row umum (5 kolom) */
            .table-header,
            .table-row {
                grid-template-columns: 100px 1fr 80px 100px 70px;
                /* Default untuk 5 kolom */
                gap: 15px;
                font-size: 14px;
            }
        }

        @media (max-width: 768px) {
            .right-header {
                flex-direction: column;
                gap: 10px;
            }

            .search-container {
                width: 200px;
            }

            /* Media Queries untuk table-header dan table-row umum (5 kolom) */
            .table-header,
            .table-row {
                grid-template-columns: 70px 1fr 50px 70px 50px;
                /* Default untuk 5 kolom */
                gap: 10px;
                font-size: 12px;
            }

            .material-code {
                font-size: 12px;
                padding: 6px 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="left-header">
                <button class="back-btn" onclick="window.location.href='{{ route('dashboard') }}'">
                    <i class="fas fa-arrow-left"></i>
                </button>

                <h1 class="page-title">Bahan Baku</h1>
            </div>

            <div class="right-header">
                <button class="add-btn" onclick="openAddModal()">
                    <i class="fas fa-plus"></i>
                </button>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Cari Kode/Nama Bahan" id="searchInput">
                    <button class="search-btn"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>


        <div class="menu-section">
            <div style="margin-bottom: 20px;">
                <button class="show-seblak active" id="btnShowSeblak" onclick="showTable('seblak')">Bahan Baku
                    Seblak</button>
                <button class="show-minuman" id="btnShowMinuman" onclick="showTable('minuman')">Bahan Baku
                    Minuman</button>
            </div>

            <div id="tableSeblak" style="display: block;">
                <div class="table-header"> {{-- Menggunakan class table-header umum --}}
                    <div>KODE</div>
                    <div>NAMA BAHAN</div>
                    <div>STOK</div>
                    <div id="headerSeblakHarga">HARGA</div> {{-- Tambah ID untuk sembunyikan/tampilkan --}}
                    <div>AKSI</div>
                </div>
                <div id="seblakTableContent">
                    @foreach($bahanBakus as $bahan)
                        <div class="table-row"> {{-- Menggunakan class table-row umum --}}
                            <div class="material-code">{{ $bahan->kode_bahan }}</div>
                            <div class="material-name">{{ $bahan->nama_bahan_baku }}</div>
                            <div class="material-qty">{{ $bahan->stok }}</div>
                            <div class="material-price">{{ number_format($bahan->harga, 0, ',', '.') }}</div>
                            {{-- Tampilkan Harga --}}
                            <div class="actions">
                                <button class="edit-btn" onclick="openEditModal(this)" data-type="bahan_baku"
                                    data-kode="{{ $bahan->kode_bahan }}" data-nama="{{ $bahan->nama_bahan_baku }}"
                                    data-stok="{{ $bahan->stok }}" data-harga="{{ $bahan->harga }}">Edit</button>
                                <form action="{{ url('/bahan-baku/' . $bahan->kode_bahan) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"
                                        onclick="return confirm('Yakin ingin menghapus bahan ini?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="tableMinuman" style="display: none;">
                <div class="table-header"> {{-- Menggunakan class table-header umum --}}
                    <div>KODE</div>
                    <div>NAMA MINUMAN</div>
                    <div>STOK</div>
                    <div>HARGA</div>
                    <div>AKSI</div>
                </div>
                <div id="minumanTableContent">
                    @foreach($menus as $menu)
                        <div class="table-row"> {{-- Menggunakan class table-row umum --}}
                            <div class="material-code">{{ $menu->kode_menu }}</div>
                            <div class="material-name">{{ $menu->nama_menu }}</div>
                            <div class="material-qty">{{ $menu->stok }}</div>
                            <div class="material-price">Rp. {{ number_format($menu->harga, 0, ',', '.') }}</div>
                            <div class="actions">
                                <button class="edit-btn" onclick="openEditModal(this)" data-type="menu"
                                    data-kode="{{ $menu->kode_menu }}" data-nama="{{ $menu->nama_menu }}"
                                    data-stok="{{ $menu->stok }}" data-harga="{{ $menu->harga }}">Edit</button>
                                <form action="{{ url('/menu-minuman/' . $menu->kode_menu) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"
                                        onclick="return confirm('Yakin ingin menghapus menu ini?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Modal Tambah --}}
        <div class="modal-overlay" id="addModal">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="modal-back-btn" onclick="closeAddModal()"><i class="fas fa-arrow-left"></i></button>
                    <h3 class="modal-title" id="addModalTitle">Tambah Bahan Baku</h3>
                </div>
                <div class="modal-body">
                    <form id="addForm" method="POST" action="">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" id="addCodeLabel">Kode Bahan</label>
                            <input type="text" class="form-input" id="addCode" name="kode_bahan" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" id="addNameLabel">Nama Bahan</label>
                            <input type="text" class="form-input" id="addName" name="nama_bahan_baku" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" id="addStokLabel">QTY</label>
                            <input type="number" class="form-input" id="addStok" name="stok" min="0" required>
                        </div>
                        <div class="form-group" id="addHargaGroup">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-input" id="addHarga" name="harga" min="0">
                        </div>
                        <button type="submit" class="modal-submit-btn">TAMBAH</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Edit --}}
        <div class="modal-overlay" id="editModal">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="modal-back-btn" onclick="closeEditModal()"><i class="fas fa-arrow-left"></i></button>
                    <h3 class="modal-title" id="editModalTitle">Edit Bahan Baku</h3>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label" id="editCodeLabel">Kode Bahan</label>
                            <input type="text" class="form-input" id="editCode" name="kode_bahan" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label" id="editNameLabel">Nama Bahan</label>
                            <input type="text" class="form-input" id="editName" name="nama_bahan_baku" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" id="editStokLabel">QTY</label>
                            <input type="number" class="form-input" id="editStok" name="stok" min="0" required>
                        </div>
                        <div class="form-group" id="editHargaGroup">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-input" id="editHarga" name="harga" min="0">
                        </div>
                        <button type="submit" class="modal-submit-btn">SIMPAN</button>
                    </form>
                    <form id="deleteForm" method="POST" style="margin-top: 10px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="modal-submit-btn" style="background-color: crimson;"
                            onclick="return confirm('Yakin ingin menghapus item ini?')">HAPUS</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Script --}}
        <script>
            let currentTable = 'seblak'; // Track which table is currently active

            function showTable(type) {
                document.getElementById('btnShowSeblak').classList.remove('active');
                document.getElementById('btnShowMinuman').classList.remove('active');

                // Ambil elemen header dan row container
                let headerElementSeblak = document.querySelector('#tableSeblak .table-header');
                let rowsContainerSeblak = document.getElementById('seblakTableContent');
                let headerElementMinuman = document.querySelector('#tableMinuman .table-header');
                let rowsContainerMinuman = document.getElementById('minumanTableContent');

                // Ambil semua div kolom di header dan row masing-masing tabel
                const seblakHeaderCols = headerElementSeblak.querySelectorAll('div');
                const minumanHeaderCols = headerElementMinuman.querySelectorAll('div');

                const allSeblakRows = document.querySelectorAll('#seblakTableContent .table-row');
                const allMinumanRows = document.querySelectorAll('#minumanTableContent .table-row');


                if (type === 'seblak') {
                    document.getElementById('tableSeblak').style.display = 'block';
                    document.getElementById('tableMinuman').style.display = 'none';
                    document.getElementById('btnShowSeblak').classList.add('active');

                    // Atur display untuk kolom Harga di header seblak
                    seblakHeaderCols[3].style.display = 'block'; // Harga

                    // Atur display untuk kolom Harga di setiap baris seblak
                    allSeblakRows.forEach(row => {
                        row.querySelector('.material-price').style.display = 'block'; // Harga
                    });

                    // Set form fields for Seblak (Tambah)
                    document.getElementById('addModalTitle').textContent = 'Tambah Bahan Baku';
                    document.getElementById('addCodeLabel').textContent = 'Kode Bahan';
                    document.getElementById('addCode').name = 'kode_bahan';
                    document.getElementById('addNameLabel').textContent = 'Nama Bahan';
                    document.getElementById('addName').name = 'nama_bahan_baku';
                    document.getElementById('addStokLabel').textContent = 'QTY';
                    document.getElementById('addStok').name = 'stok';
                    document.getElementById('addHargaGroup').style.display = 'block'; // Tampilkan harga untuk bahan baku
                    document.getElementById('addHarga').setAttribute('required', 'required');
                    document.getElementById('addHarga').name = 'harga';
                    document.getElementById('addForm').action = "{{ url('/bahan-baku') }}";

                    currentTable = 'seblak';
                } else if (type === 'minuman') {
                    document.getElementById('tableSeblak').style.display = 'none';
                    document.getElementById('tableMinuman').style.display = 'block';
                    document.getElementById('btnShowMinuman').classList.add('active');

                    // Semua kolom di tabel minuman akan selalu terlihat (5 kolom)
                    // Ini tidak perlu manipulasi display di sini karena mereka semua ada

                    // Set form fields for Minuman (Tambah)
                    document.getElementById('addModalTitle').textContent = 'Tambah Menu Minuman';
                    document.getElementById('addCodeLabel').textContent = 'Kode Menu';
                    document.getElementById('addCode').name = 'kode_menu';
                    document.getElementById('addNameLabel').textContent = 'Nama Menu';
                    document.getElementById('addName').name = 'nama_menu';
                    document.getElementById('addStokLabel').textContent = 'Stok';
                    document.getElementById('addStok').name = 'stok';
                    document.getElementById('addHargaGroup').style.display = 'block';
                    document.getElementById('addHarga').setAttribute('required', 'required');
                    document.getElementById('addHarga').name = 'harga';
                    document.getElementById('addForm').action = "{{ url('/menu-minuman') }}";

                    currentTable = 'minuman';
                }
                document.getElementById('searchInput').value = '';
                filterTableRows('');
            }

            function openAddModal() {
                document.getElementById('addForm').reset();
                document.getElementById('addCode').readOnly = false;
                document.getElementById('addHarga').value = '';
                document.getElementById('addStok').value = '';
                showTable(currentTable);
                document.getElementById('addModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeAddModal() {
                document.getElementById('addModal').classList.remove('active');
                document.body.style.overflow = 'auto';
            }

            function openEditModal(button) {
                const type = button.getAttribute("data-type");
                const kode = button.getAttribute("data-kode");
                const nama = button.getAttribute("data-nama");
                const stok = button.getAttribute("data-stok");
                const harga = button.getAttribute("data-harga");

                document.getElementById("editCode").value = kode;
                document.getElementById("editStok").value = stok;
                document.getElementById("editHarga").value = harga;

                document.getElementById("deleteForm").action = (type === 'bahan_baku' ? "{{ url('/bahan-baku') }}/" :
                    "{{ url('/menu-minuman') }}/") + kode;

                if (type === 'bahan_baku') {
                    document.getElementById('editModalTitle').textContent = 'Edit Bahan Baku';
                    document.getElementById('editCodeLabel').textContent = 'Kode Bahan';
                    document.getElementById('editCode').name = 'kode_bahan';
                    document.getElementById('editNameLabel').textContent = 'Nama Bahan';
                    document.getElementById('editName').name = 'nama_bahan_baku';
                    document.getElementById('editName').value = nama;
                    document.getElementById('editStokLabel').textContent = 'QTY';
                    document.getElementById('editStok').name = 'stok';
                    document.getElementById('editHargaGroup').style.display = 'block';
                    document.getElementById('editHarga').setAttribute('required', 'required');
                    document.getElementById('editHarga').name = 'harga';
                    document.getElementById("editForm").action = "{{ url('/bahan-baku') }}/" + kode;
                } else if (type === 'menu') {
                    document.getElementById('editModalTitle').textContent = 'Edit Menu Minuman';
                    document.getElementById('editCodeLabel').textContent = 'Kode Menu';
                    document.getElementById('editCode').name = 'kode_menu';
                    document.getElementById('editNameLabel').textContent = 'Nama Menu';
                    document.getElementById('editName').name = 'nama_menu';
                    document.getElementById('editName').value = nama;
                    document.getElementById('editStokLabel').textContent = 'Stok';
                    document.getElementById('editStok').name = 'stok';
                    document.getElementById('editHargaGroup').style.display = 'block';
                    document.getElementById('editHarga').value = harga;
                    document.getElementById('editHarga').setAttribute('required', 'required');
                    document.getElementById('editHarga').name = 'harga';
                    document.getElementById("editForm").action = "{{ url('/menu-minuman') }}/" + kode;
                }

                document.getElementById("editModal").classList.add("active");
                document.body.style.overflow = "hidden";
            }


            function closeEditModal() {
                document.getElementById("editModal").classList.remove('active');
                document.body.style.overflow = 'auto';
            }

            // Escape modal
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeAddModal();
                    closeEditModal();
                }
            });

            // Search filter logic
            document.getElementById('searchInput').addEventListener('input', function (e) {
                filterTableRows(e.target.value.toLowerCase());
            });

            function filterTableRows(searchTerm) {
                let rows;
                let currentTableContentId;
                if (currentTable === 'seblak') {
                    currentTableContentId = 'seblakTableContent';
                } else if (currentTable === 'minuman') {
                    currentTableContentId = 'minumanTableContent';
                }
                rows = document.querySelectorAll(`#${currentTableContentId} .table-row`);

                rows.forEach(row => {
                    const code = row.querySelector('.material-code').textContent.toLowerCase();
                    const name = row.querySelector('.material-name').textContent.toLowerCase();

                    const qtyOrStok = row.querySelector('.material-qty').textContent.toLowerCase();

                    let price = '';
                    if (row.querySelector('.material-price')) {
                        price = row.querySelector('.material-price').textContent.toLowerCase();
                    }

                    const searchableContent = [code, name, qtyOrStok];
                    if (price) searchableContent.push(price);

                    const display = searchableContent.some(text => text.includes(searchTerm));
                    row.style.display = display ? 'grid' : 'none';
                });
            }

            // Initialize table display and button active state on page load
            document.addEventListener('DOMContentLoaded', () => {
                showTable('seblak'); // Default to seblak table
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('
                success ') }}',
                    confirmButtonColor: '#8B1538'
                });
            @elseif(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('
                error ') }}',
                    confirmButtonColor: '#8B1538'
                });
            @endif
        </script>

</body>

</html>