<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - Dashboard</title>
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
            justify-content: space-between;
            align-items: center;
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

        .date-widget {
            background: white;
            padding: 12px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .date-widget i {
            color: #FF5722;
            font-size: 16px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        .menu-section {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .menu-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .add-btn {
            width: 40px;
            height: 40px;
            background: #8B1538;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .add-btn:hover {
            background: #A91B47;
            transform: scale(1.05);
        }

        .search-container {
            position: relative;
            margin-bottom: 25px;
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

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .menu-table {
            width: 100%;
            border-collapse: collapse;
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
        }

        .menu-table th {
            background: #e9ecef;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            font-size: 14px;
        }

        .menu-table td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            color: #333;
        }

        .menu-table tr:last-child td {
            border-bottom: none;
        }

        .menu-table tr:hover {
            background-color: #f1f3f4;
        }

        .menu-table tbody tr {
            cursor: pointer;
        }

        .menu-table tbody tr.selected {
            background-color: #e3f2fd !important;
        }

        .edit-btn {
            background: #8B1538;
            color: white;
            border: none;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-btn:hover {
            background: #A91B47;
        }

        .order-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .customer-input {
            background: white;
            border: 2px solid #8B1538;
            padding: 15px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            outline: none;
            transition: all 0.3s ease;
        }

        .customer-input:focus {
            border-color: #A91B47;
            box-shadow: 0 0 0 3px rgba(139, 21, 56, 0.1);
        }

        .invoice-section {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            flex: 1;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .invoice-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .invoice-table th {
            background: #8B1538;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
        }

        .invoice-table td {
            padding: 12px 8px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .qty-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
        }

        .qty-btn {
            width: 35px;
            height: 35px;
            background: #333;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-input {
            width: 60px;
            height: 35px;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
        }

        .add-item-btn {
            background: #333;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .total-section {
            border-top: 2px dashed #ddd;
            padding-top: 20px;
            margin-top: 20px;
        }

        .total-amount {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .order-btn {
            width: 100%;
            background: #8B1538;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .order-btn:hover {
            background: #A91B47;
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

        td button.edit-btn {
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

        td button.edit-btn:hover {
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
            max-width: 450px;
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
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            border-color: #8B1538;
        }

        .modal-submit-btn {
            width: 100%;
            background: #8B1538;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .modal-submit-btn:hover {
            background: #A91B47;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .container {
                padding: 15px;
            }

            .modal-content {
                width: 95%;
                margin: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div style="display: flex; align-items: center; gap: 20px;">
                <button class="back-btn" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h1 class="page-title">Pilih Menu</h1>
            </div>

            <div class="date-widget">
                <i class="fas fa-calendar-alt"></i>
                <span id="currentDate"></span>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Menu Section -->
            <div class="menu-section">
                <div class="menu-header">
                    <h2 class="menu-title">Menu</h2>
                    <button class="add-btn" onclick="openAddMenuModal()">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Cari Nama Menu/Kode Menu" id="searchInput">
                    <i class="fas fa-search search-icon"></i>
                </div>

                <table class="menu-table" id="menuTable">
                    <thead>
                        <tr>
                            <th>NAMA MENU</th>
                            <th>KODE MENU</th>
                            <th>HARGA</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($menus) && count($menus) > 0)
                            @foreach($menus as $menu)
                                <tr data-kode="{{ $menu->kode_menu }}" 
                                    onclick="selectMenu('{{ $menu->nama_menu }}', '{{ $menu->kode_menu }}', {{ $menu->harga }})">
                                    <td>{{ $menu->nama_menu }}</td>
                                    <td>{{ $menu->kode_menu }}</td>
                                    <td>Rp. {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <button class="edit-btn"
                                            onclick="event.stopPropagation(); editMenu('{{ $menu->kode_menu }}', '{{ $menu->nama_menu }}', {{ $menu->harga }})">
                                            Edit
                                        </button>
                                        <button class="delete-btn"
                                            onclick="event.stopPropagation(); confirmDelete('{{ $menu->kode_menu }}')">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 20px;">
                                    Tidak ada data menu. Silakan tambah menu baru.
                                </td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>

            <!-- Order Section -->
            <div class="order-section">
                <input type="text" class="customer-input" placeholder="Nama Pelanggan" id="customerName" required>

                <div class="invoice-section">
                    <h3 class="invoice-title">Faktur</h3>

                    <table class="invoice-table">
                        <thead>
                            <tr>
                                <th>NAMA MENU</th>
                                <th>QTY</th>
                                <th>HARGA</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="orderItems">
                            <!-- Order items will be populated by JavaScript -->
                        </tbody>
                    </table>

                    <div class="qty-controls">
                        <input type="number" class="qty-input" value="1" min="1" id="quantity">
                        <button class="qty-btn" onclick="changeQuantity(-1)">-</button>
                        <button class="qty-btn" onclick="changeQuantity(1)">+</button>
                        <button class="add-item-btn" onclick="addSelectedItem()">Tambah</button>
                    </div>

                    <div class="total-section">
                        <div class="total-amount">
                            <span>Total</span>
                            <span id="totalAmount">Rp. 0</span>
                        </div>
                    </div>

                    <form id="orderForm" method="GET" action="{{ route('payment.form') }}">
                        <input type="hidden" name="order_total" id="hiddenTotal">
                        <button type="submit" class="order-btn">Pesan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Add Menu Modal -->
    <div class="modal-overlay" id="addMenuModal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="modal-back-btn" onclick="closeAddMenuModal()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h3 class="modal-title">Tambah Menu</h3>
            </div>
            <div class="modal-body">
                <div id="alertContainer"></div>
                <form id="addMenuForm" onsubmit="submitNewMenu(event)">
                    <div class="form-group">
                        <label class="form-label">Kode Menu</label>
                        <input type="text" class="form-input" id="menuCode" placeholder="Contoh: A009" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" class="form-input" id="menuName" placeholder="Contoh: Kerupuk Oren" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-input" id="menuPrice" placeholder="Contoh: 2000" required
                            min="0">
                    </div>

                    <button type="submit" class="modal-submit-btn">Tambah</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Menu Modal -->
    <div class="modal-overlay" id="editMenuModal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="modal-back-btn" onclick="closeEditMenuModal()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h3 class="modal-title">Edit Menu</h3>
            </div>
            <div class="modal-body">
                <div id="editAlertContainer"></div>
                <form id="editMenuForm" onsubmit="submitEditMenu(event)">
                    <input type="hidden" id="editMenuCode">

                    <div class="form-group">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" class="form-input" id="editMenuName" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-input" id="editMenuPrice" required min="0">
                    </div>

                    <button type="submit" class="modal-submit-btn">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let selectedMenu = null;
        let orderItems = [];
        let total = 0;

        // Update date in real-time
        function updateDateTime() {
            const now = new Date();
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', options);
        }

        // Update date every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call

        function goBack() {
            window.history.back();
        }

        function selectMenu(name, code, price) {
            selectedMenu = {
                name,
                code,
                price
            };

            // Remove previous selection
            document.querySelectorAll('.menu-table tbody tr').forEach(row => {
                row.classList.remove('selected');
            });

            // Highlight selected row
            event.currentTarget.classList.add('selected');
        }

        function changeQuantity(change) {
            const qtyInput = document.getElementById('quantity');
            let currentQty = parseInt(qtyInput.value);
            currentQty += change;
            if (currentQty < 1) currentQty = 1;
            qtyInput.value = currentQty;
        }

        function addSelectedItem() {
            if (!selectedMenu) {
                alert('Pilih menu terlebih dahulu!');
                return;
            }

            const quantity = parseInt(document.getElementById('quantity').value);
            const itemTotal = selectedMenu.price * quantity;

            // Check if item already exists in order
            const existingItemIndex = orderItems.findIndex(item => item.code === selectedMenu.code);

            if (existingItemIndex !== -1) {
                // Update existing item
                orderItems[existingItemIndex].quantity += quantity;
                orderItems[existingItemIndex].total = orderItems[existingItemIndex].price * orderItems[existingItemIndex]
                    .quantity;
            } else {
                // Add new item
                orderItems.push({
                    name: selectedMenu.name,
                    code: selectedMenu.code,
                    price: selectedMenu.price,
                    quantity: quantity,
                    total: itemTotal
                });
            }

            // Update UI
            updateOrderTable();
            updateTotal();

            // Reset quantity and selection
            document.getElementById('quantity').value = 1;
            selectedMenu = null;
            document.querySelectorAll('.menu-table tbody tr').forEach(row => {
                row.classList.remove('selected');
            });
        }

        function updateOrderTable() {
            const tbody = document.getElementById('orderItems');
            tbody.innerHTML = '';

            orderItems.forEach((item, index) => {
                const row = tbody.insertRow();
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>Rp. ${item.total.toLocaleString('id-ID')}</td>
                    <td><button class="delete-btn" onclick="removeItem(${index})">🗑</button></td>
                `;
            });
        }

        function removeItem(index) {
            orderItems.splice(index, 1);
            updateOrderTable();
            updateTotal();
        }

        function updateTotal() {
            total = orderItems.reduce((sum, item) => sum + item.total, 0);
            document.getElementById('totalAmount').textContent = `Rp. ${total.toLocaleString('id-ID')}`;
            document.getElementById('hiddenTotal').value = total;

        }

        function processOrder() {
            const customerName = document.getElementById('customerName').value.trim();

            if (!customerName) {
                alert('Silakan masukkan nama pelanggan!');
                return;
            }

            if (orderItems.length === 0) {
                alert('Belum ada item yang dipilih!');
                return;
            }

            const orderData = {
                nama_pelanggan: customerName,
                items: orderItems.map(item => ({
                    kode_menu: item.code,
                    nama_menu: item.name,
                    quantity: item.quantity
                })),
                total: total
            };

            // Send order to server
            fetch('/modules/orders/process', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(orderData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Pesanan berhasil! Kode Transaksi: ${data.kode_transaksi}`);

                        // Reset form
                        orderItems = [];
                        updateOrderTable();
                        updateTotal();
                        document.getElementById('customerName').value = '';
                    } else {
                        alert('Gagal memproses pesanan!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses pesanan!');
                });
        }

        // Modal Functions
        function openAddMenuModal() {
            document.getElementById('addMenuModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeAddMenuModal() {
            document.getElementById('addMenuModal').classList.remove('active');
            document.body.style.overflow = 'auto';
            document.getElementById('addMenuForm').reset();
            document.getElementById('alertContainer').innerHTML = '';
        }

        function openEditMenuModal() {
            document.getElementById('editMenuModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeEditMenuModal() {
            document.getElementById('editMenuModal').classList.remove('active');
            document.body.style.overflow = 'auto';
            document.getElementById('editMenuForm').reset();
            document.getElementById('editAlertContainer').innerHTML = '';
        }

        function editMenu(kodeMenu, namaMenu, harga) {
            document.getElementById('editMenuCode').value = kodeMenu;
            document.getElementById('editMenuName').value = namaMenu;
            document.getElementById('editMenuPrice').value = harga;
            openEditMenuModal();
        }

        function showAlert(message, type = 'success', containerId = 'alertContainer') {
            const alertContainer = document.getElementById(containerId);
            const alertClass = type === 'success' ? 'alert-success' : 'alert-error';

            alertContainer.innerHTML = `
                <div class="alert ${alertClass}">
                    ${message}
                </div>
            `;

            // Auto hide after 3 seconds
            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 3000);
        }

        function submitNewMenu(event) {
            event.preventDefault();

            const formData = {
                kode_menu: document.getElementById('menuCode').value,
                nama_menu: document.getElementById('menuName').value,
                harga: parseInt(document.getElementById('menuPrice').value)
            };

            // Send AJAX request to store menu
            fetch('/modules/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Add new menu to table
                        const tbody = document.querySelector('#menuTable tbody');
                        const newRow = tbody.insertRow();
                        newRow.onclick = () => selectMenu(data.data.nama_menu, data.data.kode_menu, data.data.harga);
                        newRow.innerHTML = `
                        <td>${data.data.nama_menu}</td>
                        <td>${data.data.kode_menu}</td>
                        <td>Rp. ${data.data.harga.toLocaleString('id-ID')}</td>
                        <td>
                            <button class="edit-btn" onclick="event.stopPropagation(); editMenu('${data.data.kode_menu}', '${data.data.nama_menu}', ${data.data.harga})">
                                Edit
                            </button>
                        </td>
                    `;

                        showAlert(data.message, 'success');

                        // Close modal after 2 seconds
                        setTimeout(() => {
                            closeAddMenuModal();
                        }, 2000);
                    } else {
                        showAlert('Gagal menambahkan menu!', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan saat menambahkan menu!', 'error');
                });
        }

        function submitEditMenu(event) {
            event.preventDefault();

            const kodeMenu = document.getElementById('editMenuCode').value;
            const formData = {
                nama_menu: document.getElementById('editMenuName').value,
                harga: parseInt(document.getElementById('editMenuPrice').value)
            };

            // Send AJAX request to update menu
            fetch(`/modules/orders/${kodeMenu}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update menu in table
                        const rows = document.querySelectorAll('#menuTable tbody tr');
                        rows.forEach(row => {
                            const kodeCell = row.cells[1];
                            if (kodeCell && kodeCell.textContent === kodeMenu) {
                                row.cells[0].textContent = data.data.nama_menu;
                                row.cells[2].textContent = `Rp. ${data.data.harga.toLocaleString('id-ID')}`;
                                row.onclick = () => selectMenu(data.data.nama_menu, data.data.kode_menu, data
                                    .data.harga);

                                const editBtn = row.querySelector('.edit-btn');
                                editBtn.onclick = (e) => {
                                    e.stopPropagation();
                                    editMenu(data.data.kode_menu, data.data.nama_menu, data.data.harga);
                                };
                            }
                        });

                        showAlert(data.message, 'success', 'editAlertContainer');

                        // Close modal after 2 seconds
                        setTimeout(() => {
                            closeEditMenuModal();
                        }, 2000);
                    } else {
                        showAlert('Gagal mengupdate menu!', 'error', 'editAlertContainer');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan saat mengupdate menu!', 'error', 'editAlertContainer');
                });
        }

        // Search functionality with AJAX
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', function (e) {
            clearTimeout(searchTimeout);
            const searchTerm = e.target.value;

            searchTimeout = setTimeout(() => {
                if (searchTerm.length >= 2 || searchTerm.length === 0) {
                    fetch(`/modules/orders/search?q=${encodeURIComponent(searchTerm)}`)
                        .then(response => response.json())
                        .then(menus => {
                            const tbody = document.querySelector('#menuTable tbody');
                            tbody.innerHTML = '';

                            if (menus.length > 0) {
                                menus.forEach(menu => {
                                    const row = tbody.insertRow();
                                    row.onclick = () => selectMenu(menu.nama_menu, menu
                                        .kode_menu, menu.harga);
                                    row.innerHTML = `
                                        <td>${menu.nama_menu}</td>
                                        <td>${menu.kode_menu}</td>
                                        <td>Rp. ${menu.harga.toLocaleString('id-ID')}</td>
                                        <td>
                                            <button class="edit-btn" onclick="event.stopPropagation(); editMenu('${menu.kode_menu}', '${menu.nama_menu}', ${menu.harga})">
                                                Edit
                                            </button>
                                        </td>
                                    `;
                                });
                            } else {
                                const row = tbody.insertRow();
                                row.innerHTML = `
                                    <td colspan="4" style="text-align: center; padding: 20px;">
                                        Tidak ada menu yang ditemukan.
                                    </td>
                                `;
                            }
                        })
                        .catch(error => {
                            console.error('Search error:', error);
                        });
                }
            }, 300);
        });

        // Close modal when clicking outside
        document.getElementById('addMenuModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeAddMenuModal();
            }
        });

        document.getElementById('editMenuModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeEditMenuModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeAddMenuModal();
                closeEditMenuModal();
            }
        });

        // Initialize
        updateTotal();

        // Konfirmasi Delete Menu (SweetAlert2)
        function confirmDelete(kodeMenu) {
            Swal.fire({
                title: 'Yakin hapus menu ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/modules/orders/${kodeMenu}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Terhapus!', data.message, 'success');
                            
                            // ✅ Hapus baris tabel tanpa reload
                            const row = document.querySelector(`tr[data-kode='${kodeMenu}']`);
                            if (row) row.remove();
                        } else {
                            Swal.fire('Gagal!', 'Menu gagal dihapus.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'Terjadi kesalahan saat menghapus.', 'error');
                    });
                }
            });
        }


    </script>
</body>

</html>