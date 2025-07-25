<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahan Baku - Dashboard</title>
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
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .left-header {
            display: flex;
            align-items: center;
            gap: 20px;
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

        .main-content {
            background: white;
            border-radius: 16px;
            padding: 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .table-header {
            background: #e9ecef;
            padding: 15px 20px;
            display: grid;
            grid-template-columns: 200px 1fr 150px 180px;
            gap: 20px;
            font-weight: 600;
            color: #495057;
            font-size: 14px;
        }

        .table-row {
            padding: 15px 20px;
            display: grid;
            grid-template-columns: 200px 1fr 150px 180px;
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

        /* Modal Styles */
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

            .table-header,
            .table-row {
                grid-template-columns: 150px 1fr 120px 80px;
                gap: 15px;
            }

            .modal-content {
                width: 95%;
                margin: 20px;
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

            .table-header,
            .table-row {
                grid-template-columns: 120px 1fr 100px 70px;
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
                <button class="add-btn" onclick="openAddMaterialModal()">
                    <i class="fas fa-plus"></i>
                </button>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Cari Kode/Nama Bahan" id="searchInput">
                    <button class="search-btn"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="table-header">
                <div>KODE_BAHAN</div>
                <div>NAMA BAHAN</div>
                <div>QTY</div>
                <div>AKSI</div>
            </div>
            <div id="materialsTable">
                @foreach($bahanBaku as $bahan)
                    <div class="table-row">
                        <div class="material-code">{{ $bahan->kode_bahan }}</div>
                        <div class="material-name">{{ $bahan->nama_bahan_baku }}</div>
                        <div class="material-qty">{{ $bahan->stok }}</div>
                        <div class="actions">
                            <button class="edit-btn" onclick="openEditMaterialModal('{{ $bahan->kode_bahan }}')">Edit</button>
                            <form action="/bahan-baku/{{ $bahan->kode_bahan }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Yakin ingin menghapus bahan ini?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal-overlay" id="addMaterialModal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="modal-back-btn" onclick="closeAddMaterialModal()"><i class="fas fa-arrow-left"></i></button>
                <h3 class="modal-title">Tambah Bahan Baku</h3>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/bahan-baku') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Kode Bahan</label>
                        <input type="text" class="form-input" name="kode_bahan" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Bahan</label>
                        <input type="text" class="form-input" name="nama_bahan_baku" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">QTY</label>
                        <input type="text" class="form-input" name="stok" required>
                    </div>
                    <button type="submit" class="modal-submit-btn">TAMBAH</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal-overlay" id="editMaterialModal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="modal-back-btn" onclick="closeEditMaterialModal()"><i class="fas fa-arrow-left"></i></button>
                <h3 class="modal-title">Edit Bahan Baku</h3>
            </div>
            <div class="modal-body">
                <form id="editMaterialForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Kode Bahan</label>
                        <input type="text" class="form-input" id="editMaterialCode" name="kode_bahan" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Bahan</label>
                        <input type="text" class="form-input" id="editMaterialName" name="nama_bahan_baku" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">QTY</label>
                        <input type="text" class="form-input" id="editMaterialQty" name="stok" required>
                    </div>
                    <button type="submit" class="modal-submit-btn">SIMPAN</button>
                </form>
                <form id="deleteMaterialForm" method="POST" style="margin-top: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal-submit-btn" style="background-color: crimson;">HAPUS</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script>
    function openAddMaterialModal() {
        document.getElementById('addMaterialModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeAddMaterialModal() {
        document.getElementById('addMaterialModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    function openEditMaterialModal(kode) {
        console.log('Klik Edit:', kode);
        fetch(`/bahan-baku/get/${kode}`)
            .then(res => res.json())
            .then(data => {
                console.log('Data diterima:', data);
                document.getElementById('editMaterialCode').value = data.kode_bahan;
                document.getElementById('editMaterialName').value = data.nama_bahan_baku;
                document.getElementById('editMaterialQty').value = data.stok;

                document.getElementById('editMaterialForm').action = `/bahan-baku/${data.kode_bahan}`;
                document.getElementById('deleteMaterialForm').action = `/bahan-baku/${data.kode_bahan}`;

                document.getElementById('editMaterialModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            });
    }

    function closeEditMaterialModal() {
        document.getElementById('editMaterialModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Escape modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddMaterialModal();
            closeEditMaterialModal();
        }
    });

    // Search filter
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.table-row');
        rows.forEach(row => {
            const code = row.querySelector('.material-code').textContent.toLowerCase();
            const name = row.querySelector('.material-name').textContent.toLowerCase();
            row.style.display = code.includes(searchTerm) || name.includes(searchTerm) ? 'grid' : 'none';
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#8B1538'
                });
            @elseif(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#8B1538'
                });
            @endif
        </script>

</body>
</html>
