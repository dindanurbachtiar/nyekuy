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

        .order-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .show-seblak,
        .show-minuman {
            background: #8B1538;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-right: 10px;
            transition: all 0.3s ease;
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

        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .loading.active {
            display: block;
        }

        .cart-icon-btn {
            background: #8B1538;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 12px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .cart-icon-btn:hover {
            background: #A91B47;
        }

        .cart-count {
            background: white;
            color: #8B1538;
            border-radius: 50%;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: bold;
        }

        /* Cart Modal Specifics */
        #cartModal .modal-content {
            max-width: 600px;
            /* Lebar lebih besar untuk keranjang */
        }

        #cartModal .invoice-table {
            margin-top: 15px;
            border: 1px solid #eee;
            /* Add border for better visibility */
            border-radius: 8px;
            overflow: hidden;
        }

        #cartModal .invoice-table th,
        #cartModal .invoice-table td {
            padding: 10px 15px;
        }

        #cartModal .invoice-table th:first-child {
            border-top-left-radius: 8px;
        }

        #cartModal .invoice-table th:last-child {
            border-top-right-radius: 8px;
        }

        /* Styling for order separators in cart modal */
        .order-separator {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
            padding: 8px 15px;
            border-top: 2px solid #8B1538;
            margin-top: 15px;
            /* Add some space above the separator */
            color: #333;
        }

        .order-separator:first-of-type {
            margin-top: 0;
            /* No margin for the first separator */
            border-top: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div style="display: flex; align-items: center; gap: 20px;">
                <button class="back-btn" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h1 class="page-title">Pilih Menu</h1>
            </div>

            <div style="display: flex; align-items: center; gap: 15px;">
                <button class="cart-icon-btn" onclick="openCartModal()">
                    <i class="fas fa-shopping-cart"></i>
                    Keranjang (<span id="cartItemCount">0</span>)
                </button>
                <div class="date-widget">
                    <i class="fas fa-calendar-alt"></i>
                    <span id="currentDate"></span>
                </div>
            </div>
        </div>

        <div class="main-content">

            <div class="menu-section">

                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Cari Nama Menu/Kode Menu" id="searchInput">
                    <i class="fas fa-search search-icon"></i>
                </div>
                <div style="margin-bottom: 20px;">
                    <button class="show-seblak" onclick="showSeblak()">Seblak</button>
                    <button class="show-minuman" onclick="showMinuman()">Minuman</button>
                </div>

                <table class="menu-table" id="seblakTable" style="display: table;"> {{-- Default to Seblak --}}
                    <thead>
                        <tr>
                            <th>NAMA BAHAN</th>
                            <th>STOK</th>
                            <th>HARGA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bahanBakus as $bahan)
                            <tr
                                onclick="selectMenu('{{ $bahan->nama_bahan_baku }}', '{{ $bahan->kode_bahan }}', {{ $bahan->harga }}, 'bahan_baku')">
                                <td>{{ $bahan->nama_bahan_baku }}</td>
                                <td>{{ $bahan->stok }}</td>
                                <td>Rp. {{ number_format($bahan->harga, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <table class="menu-table" id="minumanTable" style="display: none;">
                    <thead>
                        <tr>
                            <th>NAMA MENU</th>
                            <th>STOK</th>
                            <th>HARGA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                            <tr
                                onclick="selectMenu('{{ $menu->nama_menu }}', '{{ $menu->kode_menu }}', {{ $menu->harga }}, 'menu')">
                                <td>{{ $menu->nama_menu }}</td>
                                <td>{{ $menu->stok }}</td>
                                <td>Rp. {{ number_format($menu->harga, 0, ',', '.') }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

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
                                <th></th> {{-- Kolom untuk tombol hapus --}}
                            </tr>
                        </thead>
                        <tbody id="invoiceItemsTableBody">
                        </tbody>
                    </table>

                    <div class="qty-controls">
                        <input type="number" class="qty-input" value="1" min="1" id="quantity">
                        <button class="qty-btn" onclick="changeQuantity(-1)">-</button>
                        <button class="qty-btn" onclick="changeQuantity(1)">+</button>
                        <button class="add-item-btn" onclick="addItemToInvoice()">Tambah</button>
                    </div>

                    <div class="total-section">
                        <div class="total-amount">
                            <span>Total</span>
                            <span id="totalAmount">Rp. 0</span>
                        </div>
                    </div>

                    {{-- Tombol "Pesan" sekarang akan memindahkan item dari faktur ke keranjang --}}
                    <button type="button" class="order-btn" id="orderButton"
                        onclick="addInvoiceBatchToCart()">Pesan</button>
                </div>
            </div>
        </div>
    </div>

    <div id="cartModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <button class="modal-back-btn" onclick="closeCartModal()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h3 class="modal-title">Konfirmasi Pesanan</h3>
            </div>
            <div class="modal-body">
                <p style="margin-bottom: 15px;">Nama Pelanggan: <strong id="customerNameInModal"></strong></p>
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th>MENU</th>
                            <th>QTY</th>
                            <th>HARGA</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cartModalItemsTableBody">
                    </tbody>
                </table>

                <div class="total-section">
                    <div class="total-amount">
                        <span>Total Keseluruhan</span>
                        <span id="cartModalTotalAmount">Rp. 0</span>
                    </div>
                </div>

                <div class="loading" id="checkoutLoading">
                    <i class="fas fa-spinner fa-spin"></i> Memproses pesanan...
                </div>

                <button type="button" class="modal-submit-btn" id="checkoutButton"
                    onclick="processOrderFromCart()">Lanjutkan ke Pembayaran</button>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let selectedMenu = null;
        let invoiceItems = []; // Ini adalah item yang ada di "Faktur" sementara
        let cartBatches = []; // Ini adalah array of arrays, setiap sub-array adalah "batch" pesanan dari faktur
        let currentCustomerName = ''; // Menyimpan nama pelanggan yang sedang bertransaksi

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

        document.addEventListener('DOMContentLoaded', () => {
            showSeblak(); // Default to Seblak table on load
            updateInvoiceTable(); // Initial render of the main "Faktur" table
            updateTotalInvoice(); // Initial total calculation for invoice
            updateCartItemCount(); // Initial cart count
        });

        function showSeblak() {
            document.getElementById('seblakTable').style.display = 'table';
            document.getElementById('minumanTable').style.display = 'none';
        }

        function showMinuman() {
            document.getElementById('seblakTable').style.display = 'none';
            document.getElementById('minumanTable').style.display = 'table';
        }

        function goBack() {
            window.history.back();
        }

        function selectMenu(name, code, price, type) {
            selectedMenu = {
                name,
                code,
                price,
                type
            };

            // Remove previous selection highlight
            document.querySelectorAll('.menu-table tbody tr').forEach(row => {
                row.classList.remove('selected');
            });

            // Highlight selected row
            event.currentTarget.classList.add('selected');
            // Reset quantity input to 1 when a new menu is selected
            document.getElementById('quantity').value = 1;
        }

        function changeQuantity(change) {
            const qtyInput = document.getElementById('quantity');
            let currentQty = parseInt(qtyInput.value);
            currentQty += change;
            if (currentQty < 1) currentQty = 1;
            qtyInput.value = currentQty;
        }

        function addItemToInvoice() {
            if (!selectedMenu) {
                Swal.fire('Info', 'Pilih menu terlebih dahulu!', 'info');
                return;
            }

            const quantity = parseInt(document.getElementById('quantity').value);
            const itemTotal = selectedMenu.price * quantity;

            // Check if item already exists in invoiceItems
            const existingItemIndex = invoiceItems.findIndex(item => item.code === selectedMenu.code);

            if (existingItemIndex !== -1) {
                // Update existing item
                invoiceItems[existingItemIndex].quantity += quantity;
                invoiceItems[existingItemIndex].total = invoiceItems[existingItemIndex].price * invoiceItems[
                    existingItemIndex]
                    .quantity;
            } else {
                // Add new item
                invoiceItems.push({
                    name: selectedMenu.name,
                    code: selectedMenu.code,
                    price: selectedMenu.price,
                    quantity: quantity,
                    total: itemTotal,
                    type: selectedMenu.type
                });
            }

            Swal.fire({
                icon: 'success',
                title: 'Ditambahkan!',
                text: `${selectedMenu.name} sejumlah ${quantity} berhasil ditambahkan ke faktur.`,
                showConfirmButton: false,
                timer: 1500
            });

            // Update UI for invoice
            updateInvoiceTable();
            updateTotalInvoice();

            // Reset quantity and selection after adding to invoice
            document.getElementById('quantity').value = 1;
            selectedMenu = null;
            document.querySelectorAll('.menu-table tbody tr').forEach(row => {
                row.classList.remove('selected');
            });
        }

        function updateInvoiceTable() {
            const tbody = document.getElementById('invoiceItemsTableBody');
            tbody.innerHTML = '';

            if (invoiceItems.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="4" style="text-align: center; padding: 20px; color: #777;">Belum ada item yang ditambahkan.</td></tr>`;
                return;
            }

            invoiceItems.forEach((item, index) => {
                const row = tbody.insertRow();
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>Rp. ${item.total.toLocaleString('id-ID')}</td>
                    <td><button class="delete-btn" onclick="removeInvoiceItem(${index})">🗑</button></td>
                `;
            });
        }

        function removeInvoiceItem(index) {
            invoiceItems.splice(index, 1);
            updateInvoiceTable();
            updateTotalInvoice();
        }

        function updateTotalInvoice() {
            let totalAmount = invoiceItems.reduce((sum, item) => sum + item.total, 0);
            document.getElementById('totalAmount').textContent = `Rp. ${totalAmount.toLocaleString('id-ID')}`;
        }

        function updateCartItemCount() {
            // Count total items across all batches in cartBatches
            let totalItemsInCart = 0;
            cartBatches.forEach(batch => {
                totalItemsInCart += batch.length;
            });
            document.getElementById('cartItemCount').textContent = totalItemsInCart;
        }

        // --- Logic to add invoice items batch to cart ---
        function addInvoiceBatchToCart() {
            const customerNameInput = document.getElementById('customerName');
            const customerName = customerNameInput.value.trim();

            if (!customerName) {
                Swal.fire('Peringatan', 'Silakan masukkan nama pelanggan terlebih dahulu!', 'warning');
                return;
            }

            if (invoiceItems.length === 0) {
                Swal.fire('Peringatan', 'Faktur kosong. Silakan tambahkan menu terlebih dahulu!', 'warning');
                return;
            }

            // If this is the first order for this customer, set currentCustomerName
            if (cartBatches.length === 0) {
                currentCustomerName = customerName;
            } else if (currentCustomerName !== customerName) {
                // If customer name changes, give option to clear cart or keep current customer
                Swal.fire({
                    title: 'Nama Pelanggan Berbeda',
                    text: `Anda sedang memesan untuk "${currentCustomerName}". Apakah Anda ingin memulai pesanan baru untuk "${customerName}" (ini akan mengosongkan keranjang) atau terus dengan pelanggan yang sama?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Mulai Pesanan Baru',
                    cancelButtonText: 'Lanjutkan untuk Pelanggan Lama',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User chose to start new order, clear cart and set new customer
                        cartBatches = [];
                        currentCustomerName = customerName;
                        addCurrentInvoiceItemsAsBatch();
                        Swal.fire('Pesanan Baru Dimulai',
                            `Keranjang dikosongkan. Pesanan baru untuk ${customerName} ditambahkan.`, 'info');
                    } else {
                        // User chose to continue with old customer, use existing customer name
                        customerNameInput.value = currentCustomerName; // Reset input to current customer
                        addCurrentInvoiceItemsAsBatch(); // Add items using the existing customer name
                        Swal.fire('Lanjutkan Pesanan', `Batch pesanan ditambahkan untuk ${currentCustomerName}.`,
                            'info');
                    }
                    updateInvoiceTable(); // Clear invoice table
                    updateTotalInvoice(); // Reset invoice total
                    updateCartItemCount(); // Update cart count
                });
                return; // Exit here to wait for user's decision
            }

            // If customer name is same or it's the first order, proceed to add to global cart
            addCurrentInvoiceItemsAsBatch();

            Swal.fire({
                icon: 'success',
                title: 'Batch Pesanan Ditambahkan!',
                text: 'Silakan klik tombol "Keranjang" di header untuk melanjutkan pembayaran.',
                showConfirmButton: false,
                timer: 2000
            });

            // Update UI
            updateInvoiceTable(); // Clear invoice table
            updateTotalInvoice(); // Reset invoice total
            updateCartItemCount(); // Update cart count
        }

        // Helper function to add current invoice items as a new batch to cartBatches
        function addCurrentInvoiceItemsAsBatch() {
            if (invoiceItems.length > 0) {
                cartBatches.push(JSON.parse(JSON.stringify(invoiceItems))); // Add current invoice as a new batch
                invoiceItems = []; // Clear the invoice after moving
            }
        }


        // --- Cart Modal Functions ---
        function openCartModal() {
            document.getElementById('customerNameInModal').textContent = currentCustomerName || 'Belum Ada Pelanggan';

            if (cartBatches.length === 0) { // Check cartBatches length
                Swal.fire('Peringatan', 'Keranjang belanja kosong. Silakan tambahkan pesanan terlebih dahulu!', 'warning');
                document.getElementById('cartModal').classList.remove('active');
                document.body.style.overflow = 'auto';
                return;
            }

            updateCartModalTable();
            updateCartModalTotal();
            document.getElementById('cartModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeCartModal() {
            document.getElementById('cartModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function updateCartModalTable() {
            const tbody = document.getElementById('cartModalItemsTableBody');
            tbody.innerHTML = '';

            if (cartBatches.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="4" style="text-align: center; padding: 20px; color: #777;">Keranjang kosong.</td></tr>`;
                return;
            }

            let overallItemIndex = 0; // To uniquely identify items for removal if needed
            cartBatches.forEach((batch, batchIndex) => {
                // Add a separator row for each batch
                const separatorRow = tbody.insertRow();
                separatorRow.className = 'order-separator-row'; // Add a class for potential styling
                separatorRow.innerHTML = `
                    <td colspan="4" class="order-separator">
                        Batch Pesanan ${batchIndex + 1}
                        <button class="delete-btn" style="float: right;" onclick="removeCartBatch(${batchIndex})" title="Hapus batch ini">🗑</button>
                    </td>
                `;

                batch.forEach(item => {
                    const row = tbody.insertRow();
                    row.innerHTML = `
                        <td>${item.name}</td>
                        <td>${item.quantity}</td>
                        <td>Rp. ${item.total.toLocaleString('id-ID')}</td>
                        <td></td> `;
                    overallItemIndex++;
                });
            });
        }

        function removeCartBatch(batchIndex) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Batch pesanan ke-${batchIndex + 1} ini akan dihapus dari keranjang!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    cartBatches.splice(batchIndex, 1);
                    updateCartModalTable();
                    updateCartModalTotal();
                    updateCartItemCount();
                    if (cartBatches.length === 0) {
                        closeCartModal();
                        document.getElementById('customerName').value = ''; // Clear customer name if cart is empty
                        currentCustomerName = '';
                    }
                    Swal.fire(
                        'Dihapus!',
                        'Batch pesanan telah dihapus dari keranjang.',
                        'success'
                    );
                }
            });
        }


        function updateCartModalTotal() {
            let totalModalAmount = 0;
            cartBatches.forEach(batch => {
                totalModalAmount += batch.reduce((sum, item) => sum + item.total, 0);
            });
            document.getElementById('cartModalTotalAmount').textContent = `Rp. ${totalModalAmount.toLocaleString('id-ID')}`;
        }

        function processOrderFromCart() {
            if (cartBatches.length === 0) {
                Swal.fire('Peringatan', 'Keranjang belanja kosong. Tidak ada pesanan untuk diproses.', 'warning');
                return;
            }

            if (!currentCustomerName) {
                Swal.fire('Peringatan', 'Nama pelanggan belum diatur. Mohon isi nama pelanggan pada faktur utama.',
                    'warning');
                return;
            }

            document.getElementById('checkoutLoading').classList.add('active');
            document.getElementById('checkoutButton').disabled = true;

            // Flatten all items from all batches into a single array for the backend
            let allItemsFlattened = [];
            cartBatches.forEach(batch => {
                batch.forEach(item => {
                    // Check if item already exists in the flattened list (e.g., if "Seblak A" was in multiple batches)
                    const existingItemInFlattened = allItemsFlattened.findIndex(flatItem => flatItem
                        .code === item.code);
                    if (existingItemInFlattened !== -1) {
                        allItemsFlattened[existingItemInFlattened].quantity += item.quantity;
                        // Recalculate total for this item in flattened list
                        allItemsFlattened[existingItemInFlattened].total = allItemsFlattened[
                            existingItemInFlattened].quantity * item.price;
                    } else {
                        allItemsFlattened.push(JSON.parse(JSON.stringify(item))); // Deep copy
                    }
                });
            });

            const orderData = {
                nama_pelanggan: currentCustomerName,
                items: allItemsFlattened.map(item => ({
                    kode_menu: item.code,
                    nama_menu: item.name,
                    quantity: item.quantity,
                    type: item.type
                })),
                total: allItemsFlattened.reduce((sum, item) => sum + item.total, 0)
            };

            fetch('/modules/orders/process', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(orderData)
            })
                .then(response => {
                    document.getElementById('checkoutLoading').classList.remove('active');
                    document.getElementById('checkoutButton').disabled = false;

                    if (response.redirected) {
                        // If backend redirects, it means the order was processed and payment form is next
                        cartBatches = []; // Clear the entire cart
                        currentCustomerName = ''; // Clear customer name
                        document.getElementById('customerName').value = ''; // Clear customer name input
                        updateCartItemCount();
                        closeCartModal(); // Close modal before redirect
                        window.location.href = response.url; // Redirect to payment form
                        return new Promise(() => { }); // Prevent further .then() calls
                    }
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Terjadi kesalahan server.');
                        });
                    }
                    return response.json(); // This part might not be reached if redirected
                })
                .then(data => {
                    // This block will only be reached if the backend *doesn't* redirect (unexpected for processOrder)
                    Swal.fire('Sukses', 'Pesanan berhasil diproses, namun tidak ada pengalihan.', 'success');
                    cartBatches = []; // Clear the cart
                    currentCustomerName = ''; // Clear customer name
                    document.getElementById('customerName').value = ''; // Clear customer name input
                    updateCartModalTable();
                    updateCartModalTotal();
                    updateCartItemCount();
                    closeCartModal();
                })
                .catch(error => {
                    document.getElementById('checkoutLoading').classList.remove('active');
                    document.getElementById('checkoutButton').disabled = false;
                    console.error('Error:', error);
                    Swal.fire('Error', 'Terjadi kesalahan saat memproses pesanan: ' + error.message, 'error');
                });
        }


        // Search functionality with AJAX
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', function (e) {
            clearTimeout(searchTimeout);
            const searchTerm = e.target.value;

            searchTimeout = setTimeout(() => {
                const isSeblakTableActive = document.getElementById('seblakTable').style.display ===
                    'table';
                const searchUrl = isSeblakTableActive ?
                    `/modules/orders/search-bahan?q=${encodeURIComponent(searchTerm)}` :
                    `/modules/orders/search-menu?q=${encodeURIComponent(searchTerm)}`;
                const activeTableId = isSeblakTableActive ? 'seblakTable' : 'minumanTable';
                const itemType = isSeblakTableActive ? 'bahan_baku' : 'menu';


                fetch(searchUrl)
                    .then(response => response.json())
                    .then(results => {
                        const tbody = document.querySelector(`#${activeTableId} tbody`);
                        tbody.innerHTML = '';

                        if (results.length > 0) {
                            results.forEach(item => {
                                const row = tbody.insertRow();
                                const kodeField = itemType === 'bahan_baku' ? item.kode_bahan :
                                    item.kode_menu;
                                const namaField = itemType === 'bahan_baku' ? item
                                    .nama_bahan_baku : item.nama_menu;

                                row.onclick = () => selectMenu(namaField, kodeField, item.harga,
                                    itemType);
                                row.innerHTML = `
                                    <td>${namaField}</td>
                                    <td>${item.stok}</td>
                                    <td>Rp. ${item.harga.toLocaleString('id-ID')}</td>
                                `;
                            });
                        } else {
                            const row = tbody.insertRow();
                            row.innerHTML = `
                                <td colspan="3" style="text-align: center; padding: 20px;">
                                    Tidak ada ${isSeblakTableActive ? 'bahan baku' : 'menu'} yang ditemukan.
                                </td>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                    });
            }, 300);
        });

        // Close modal when clicking outside
        document.getElementById('cartModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeCartModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeCartModal();
            }
        });

        // Initialize cart count
        updateCartItemCount();
    </script>
</body>

</html>