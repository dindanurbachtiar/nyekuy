<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - Dashboard</title>
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

        .customer-btn {
            background: #8B1538;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .customer-btn:hover {
            background: #A91B47;
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
            background: #8B1538;
            color: white;
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
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
                <span>{{ date('j F Y') }}</span>
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
                            <th>KODE_MENU</th>
                            <th>HARGA</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr onclick="selectMenu('Kerupuk Oren', 'A001', 2000)">
                            <td>Kerupuk Oren</td>
                            <td>A001</td>
                            <td>Rp. 2.000</td>
                            <td><button class="edit-btn">Edit</button></td>
                        </tr>
                        <tr onclick="selectMenu('Kerupuk Inul', 'A002', 2000)">
                            <td>Kerupuk Inul</td>
                            <td>A002</td>
                            <td>Rp. 2.000</td>
                            <td><button class="edit-btn">Edit</button></td>
                        </tr>
                        <tr onclick="selectMenu('Kerupuk Bunga', 'A003', 2000)">
                            <td>Kerupuk Bunga</td>
                            <td>A003</td>
                            <td>Rp. 2.000</td>
                            <td><button class="edit-btn">Edit</button></td>
                        </tr>
                        <tr onclick="selectMenu('Mie Golosor', 'A004', 2000)">
                            <td>Mie Golosor</td>
                            <td>A004</td>
                            <td>Rp. 2.000</td>
                            <td><button class="edit-btn">Edit</button></td>
                        </tr>
                        <tr onclick="selectMenu('Mie Ayam', 'A005', 2000)">
                            <td>Mie Ayam</td>
                            <td>A005</td>
                            <td>Rp. 2.000</td>
                            <td><button class="edit-btn">Edit</button></td>
                        </tr>
                        <tr onclick="selectMenu('Ceker', 'A006', 3000)">
                            <td>Ceker</td>
                            <td>A006</td>
                            <td>Rp. 3.000</td>
                            <td><button class="edit-btn">Edit</button></td>
                        </tr>
                        <tr onclick="selectMenu('Tulang', 'A007', 3000)">
                            <td>Tulang</td>
                            <td>A007</td>
                            <td>Rp. 3.000</td>
                            <td><button class="edit-btn">Edit</button></td>
                        </tr>
                        <tr onclick="selectMenu('Cilok', 'A008', 2000)">
                            <td>Cilok</td>
                            <td>A008</td>
                            <td>Rp. 2.000</td>
                            <td><button class="edit-btn">Edit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Order Section -->
            <div class="order-section">
                <button class="customer-btn" onclick="selectCustomer()">Wanda</button>

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
                            <tr>
                                <td>Kerupuk Oren</td>
                                <td>1</td>
                                <td>Rp. 2.000</td>
                                <td><button class="delete-btn" onclick="removeItem(this)">🗑</button></td>
                            </tr>
                            <tr>
                                <td>Mi Golosor</td>
                                <td>1</td>
                                <td>Rp. 2.000</td>
                                <td><button class="delete-btn" onclick="removeItem(this)">🗑</button></td>
                            </tr>
                            <tr>
                                <td>Tulang</td>
                                <td>1</td>
                                <td>Rp. 3.000</td>
                                <td><button class="delete-btn" onclick="removeItem(this)">🗑</button></td>
                            </tr>
                            <tr>
                                <td>Cilok</td>
                                <td>1</td>
                                <td>Rp. 2.000</td>
                                <td><button class="delete-btn" onclick="removeItem(this)">🗑</button></td>
                            </tr>
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
                            <span id="totalAmount">Rp. 9.000</span>
                        </div>
                    </div>

                    <button class="order-btn" onclick="processOrder()">Pesan</button>
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
                <form id="addMenuForm" onsubmit="submitNewMenu(event)">
                    <div class="form-group">
                        <label class="form-label">Kode Menu</label>
                        <input type="text" class="form-input" id="menuCode" placeholder="Contoh: A009" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama menu</label>
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

    <script>
        let selectedMenu = null;
        let orderItems = [];
        let total = 9000;

        function goBack() {
            window.history.back();
        }

        function selectMenu(name, code, price) {
            selectedMenu = {
                name,
                code,
                price
            };
            // Highlight selected row (optional)
            document.querySelectorAll('.menu-table tr').forEach(row => {
                row.style.backgroundColor = '';
            });
            event.currentTarget.style.backgroundColor = '#e3f2fd';
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

            // Add to order items array
            orderItems.push({
                name: selectedMenu.name,
                price: selectedMenu.price,
                quantity: quantity,
                total: itemTotal
            });

            // Update UI
            updateOrderTable();
            updateTotal();

            // Reset quantity
            document.getElementById('quantity').value = 1;
            selectedMenu = null;

            // Remove highlight
            document.querySelectorAll('.menu-table tr').forEach(row => {
                row.style.backgroundColor = '';
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
                    <td>Rp. ${item.total.toLocaleString()}</td>
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
            document.getElementById('totalAmount').textContent = `Rp. ${total.toLocaleString()}`;
        }

        function processOrder() {
            if (orderItems.length === 0) {
                alert('Belum ada item yang dipilih!');
                return;
            }

            // Process order logic here
            alert(`Pesanan berhasil! Total: Rp. ${total.toLocaleString()}`);

            // Reset form
            orderItems = [];
            updateOrderTable();
            updateTotal();
        }

        function selectCustomer() {
            // Open customer selection modal/page
            alert('Pilih customer');
        }

        // Modal Functions
        function openAddMenuModal() {
            document.getElementById('addMenuModal').classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeAddMenuModal() {
            document.getElementById('addMenuModal').classList.remove('active');
            document.body.style.overflow = 'auto';
            // Reset form
            document.getElementById('addMenuForm').reset();
        }

        function submitNewMenu(event) {
            event.preventDefault();

            const menuCode = document.getElementById('menuCode').value;
            const menuName = document.getElementById('menuName').value;
            const menuPrice = parseInt(document.getElementById('menuPrice').value);

            // Validate if menu code already exists
            const existingCodes = Array.from(document.querySelectorAll('#menuTable tbody tr td:nth-child(2)')).map(td => td
                .textContent);
            if (existingCodes.includes(menuCode)) {
                alert('Kode menu sudah ada! Gunakan kode yang berbeda.');
                return;
            }

            // Add new menu to table
            const tbody = document.querySelector('#menuTable tbody');
            const newRow = tbody.insertRow();
            newRow.onclick = () => selectMenu(menuName, menuCode, menuPrice);
            newRow.innerHTML = `
                <td>${menuName}</td>
                <td>${menuCode}</td>
                <td>Rp. ${menuPrice.toLocaleString()}</td>
                <td><button class="edit-btn">Edit</button></td>
            `;

            // Here you would typically send data to server
            // fetch('/api/menu', {
            //     method: 'POST',
            //     headers: { 'Content-Type': 'application/json' },
            //     body: JSON.stringify({ code: menuCode, name: menuName, price: menuPrice })
            // });

            alert('Menu berhasil ditambahkan!');
            closeAddMenuModal();
        }

        // Close modal when clicking outside
        document.getElementById('addMenuModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeAddMenuModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeAddMenuModal();
            }
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#menuTable tbody tr');

            rows.forEach(row => {
                const name = row.cells[0].textContent.toLowerCase();
                const code = row.cells[1].textContent.toLowerCase();

                if (name.includes(searchTerm) || code.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Initialize with default items
        orderItems = [{
            name: 'Kerupuk Oren',
            price: 2000,
            quantity: 1,
            total: 2000
        },
        {
            name: 'Mi Golosor',
            price: 2000,
            quantity: 1,
            total: 2000
        },
        {
            name: 'Tulang',
            price: 3000,
            quantity: 1,
            total: 3000
        },
        {
            name: 'Cilok',
            price: 2000,
            quantity: 1,
            total: 2000
        }
        ];
    </script>
</body>

</html>