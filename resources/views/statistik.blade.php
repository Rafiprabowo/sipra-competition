
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIKA 2025</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: white;
            color: black;
        }
    
        header {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
            background: #EE3637;
            flex-wrap: wrap;
        }
    
        .logo-container {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
    
        .logo-container img {
            height: 50px;
            margin-right: 10px;
        }
    
        nav {
            flex: 1;
            text-align: center;
        }
    
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }
    
        nav ul li {
            margin: 0 10px;
        }
    
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
    
        nav ul li a:hover {
            background-color: #F67630;
        }
    
        .masuk-button {
            background-color: #FFBC29;
            padding: 8px 15px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }
    
        .masuk-button:hover {
            background-color: #FFBC29;
        }
    
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 10px;
        }
    
        th, td {
            padding: 10px;
            text-align: left;
        }
    
        th {
            cursor: pointer;
            background-color: #f2f2f2;
            position: sticky;
            top: 0;
            z-index: 1;
        }
    
        th.sortable:hover {
            background-color: #ddd;
        }
    
        th.sorted-asc::after {
            content: "▲";
            font-size: 12px;
            margin-left: 5px;
        }
    
        th.sorted-desc::after {
            content: "▼";
            font-size: 12px;
            margin-left: 5px;
        }
    
        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
    
        .pagination button {
            background-color: #EE3637;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 0 5px;
            cursor: pointer;
            border-radius: 5px;
        }
    
        .pagination button.disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
    
        .pagination button.active {
            background-color: #FFBC29;
        }
    </style>
    
</head>
<body>
    <header style="padding: 5px">
        <div class="logo-container">
            <img src="{{ asset('img/LOGO 2.png') }}" alt="Logo 1">
            <img src="{{ asset('img/CENDRA 6.png') }}" alt="Logo 2">
            <img src="{{ asset('img/ROSE 2.png') }}" alt="Logo 3">
        </div>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/">Timeline</a></li>
                <li><a href="/">Kategori</a></li>
                <li><a href="/">Lokasi</a></li>
                <li><a href="/statistik">Statistik</a></li>
                <li><a href="{{ route('login') }}" class="masuk-button">Masuk</a></li>
            </ul>
        </nav>
    </header>

    <div>
        <h1 style="text-align: center; margin-top:2%;">DATA STATISTIK</h1>
    </div>
    <div style="display: flex; justify-content: center; padding-top: 40px; gap: 20px; flex-wrap: wrap;">
        <?php
            $conn = new mysqli('localhost', 'root', '', 'sipra_competition2');

            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Hitung total pangkalan
            $sql_total_pangkalan = "SELECT COUNT(*) as total FROM pembinas";
            $result_total_pangkalan = $conn->query($sql_total_pangkalan);
            $total_pangkalan = $result_total_pangkalan->fetch_assoc()['total'];

            // Hitung total pangkalan sudah diverifikasi (status = 1)
            $sql_sudah_validasi = "SELECT COUNT(*) as total FROM finalisasis WHERE status = 1";
            $result_sudah_validasi = $conn->query($sql_sudah_validasi);
            $total_sudah_validasi = $result_sudah_validasi->fetch_assoc()['total'];

            // Hitung total pangkalan belum diverifikasi (status = 0)
            $sql_belum_validasi = "SELECT COUNT(*) as total FROM finalisasis WHERE status = 0";
            $result_belum_validasi = $conn->query($sql_belum_validasi);
            $total_belum_validasi = $result_belum_validasi->fetch_assoc()['total'];
        ?>
        <div style="background: linear-gradient(45deg, #4099ff, #73b4ff); color: white; border-radius: 15px; text-align: center; width: 300px; height: 130px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
            <p style="font-size: 17px; font-weight: bold;">Total Pangkalan</p>
            <p style="font-size: 30px; font-weight: bold;"><?php echo $total_pangkalan; ?></p>
        </div>
        <div style="background: linear-gradient(45deg, #2ed8b6, #59e0c5); color: white; border-radius: 15px; text-align: center; width: 300px; height: 130px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
            <p style="font-size: 17px; font-weight: bold;">Pangkalan Sudah Diverifikasi</p>
            <p style="font-size: 30px; font-weight: bold;"><?php echo $total_sudah_validasi; ?></p>
        </div>
        <div style="background: linear-gradient(45deg, #FF5370, #ff869a); color: white; border-radius: 15px; text-align: center; width: 300px; height: 130px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
            <p style="font-size: 17px; font-weight: bold;">Pangkalan Belum Diverifikasi</p>
            <p style="font-size: 30px; font-weight: bold;"><?php echo $total_belum_validasi; ?></p>
        </div>
    </div>

    <?php
        $sql_validasi = "SELECT p.nama, p.pangkalan, f.status FROM pembinas p JOIN finalisasis f ON p.id = f.pembina_id WHERE f.status = 1";
        $result_validasi = $conn->query($sql_validasi);

        $sql_belum_validasi = "SELECT p.nama, p.pangkalan, f.status FROM pembinas p JOIN finalisasis f ON p.id = f.pembina_id WHERE f.status = 0";
        $result_belum_validasi = $conn->query($sql_belum_validasi);
    ?>

    <h2 style="text-align: center; margin-top:2%;">Pangkalan Sudah Validasi</h2>
    <table id="table-participants">
        <thead>
            <tr>
                <th>Nama Pembina</th>
                <th>Nama Pangkalan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result_validasi->num_rows > 0) {
                    while($row = $result_validasi->fetch_assoc()) {
                        echo "<tr><td>" . $row["nama"]. "</td><td>" . $row["pangkalan"]. "</td><td>Sudah Validasi</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <h2 style="text-align: center; margin-top:2%;">Pangkalan Belum Validasi</h2>
    <table id="table-participants2">
        <thead>
            <tr>
                <th>Nama Pembina</th>
                <th>Nama Pangkalan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result_belum_validasi->num_rows > 0) {
                    while($row = $result_belum_validasi->fetch_assoc()) {
                        echo "<tr><td>" . $row["nama"]. "</td><td>" . $row["pangkalan"]. "</td><td>Belum Validasi</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
                }
            ?>
        </tbody>
    </table>
    
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = document.querySelector('#table-participants');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const rowsPerPage = 5;
        let currentPage = 1;

        function renderTablePage(page) {
            tbody.innerHTML = '';
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const pageRows = rows.slice(start, end);
            pageRows.forEach(row => tbody.appendChild(row));
        }

        function createPagination() {
            const pagination = document.querySelector('.pagination');
            pagination.innerHTML = '';

            const totalPages = Math.ceil(rows.length / rowsPerPage);

            for (let i = 1; i <= totalPages; i++) {
                const button = document.createElement('button');
                button.textContent = i;
                button.classList.add(i === currentPage ? 'active' : '');

                button.addEventListener('click', () => {
                    currentPage = i;
                    renderTablePage(currentPage);
                    updatePagination();
                });

                pagination.appendChild(button);
            }
        }

        function updatePagination() {
            const buttons = document.querySelectorAll('.pagination button');
            buttons.forEach(button => {
                button.classList.remove('active');
                if (parseInt(button.textContent) === currentPage) {
                    button.classList.add('active');
                }
            });
        }

        function sortTable(column, order) {
            const sortedRows = rows.sort((a, b) => {
                const aText = a.querySelector(`td:nth-child(${column})`).textContent.trim();
                const bText = b.querySelector(`td:nth-child(${column})`).textContent.trim();

                if (!isNaN(aText) && !isNaN(bText)) {
                    return order === 'asc' ? aText - bText : bText - aText;
                }

                return order === 'asc' ? aText.localeCompare(bText) : bText.localeCompare(aText);
            });

            tbody.innerHTML = '';
            sortedRows.forEach(row => tbody.appendChild(row));
        }

        table.querySelectorAll('th.sortable').forEach((th, index) => {
            let order = 'asc';

            th.addEventListener('click', () => {
                table.querySelectorAll('th').forEach(th => th.classList.remove('sorted-asc', 'sorted-desc'));
                th.classList.add(order === 'asc' ? 'sorted-asc' : 'sorted-desc');
                sortTable(index + 1, order);
                order = order === 'asc' ? 'desc' : 'asc';
            });
        });

        renderTablePage(currentPage);
        createPagination();
    });
</script>
