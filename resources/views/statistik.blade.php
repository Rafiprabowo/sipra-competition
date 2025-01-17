
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIKA 2025</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            background: #030000;
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
            text-align: center;
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

        .oval {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            color: white;
            text-align: center;
        }

        .green {
            background-color: #2ed8b6; /* Warna hijau */
        }

        .red {
            background-color: #FF5370; /* Warna merah */
        }

    </style>
    
</head>
<body>
    <header style="padding: 5px">
        <div class="logo-container">
            <img src="{{ asset('img/LOGO 2.png') }}" alt="Logo 1" style="margin-left: 50px;">
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
        <h1 style="text-align: center; margin-top:3%;">DATA STATISTIK</h1>
    </div>
    <div style="display: flex; justify-content: center; padding-top: 20px; gap: 20px; flex-wrap: wrap;">
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

    <h2 style="text-align: center; padding-top:30px;">Pangkalan Sudah Validasi</h2>
    <table id="table-participants" style="text-align: center;">
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
                        echo "<tr><td>" . $row["nama"]. "</td><td>" . $row["pangkalan"]. "</td><td><span class='oval green'>Sudah Validasi</span></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <h2 style="text-align: center; padding-top:30px;">Pangkalan Belum Validasi</h2>
    <table id="table-participants2" style="margin-bottom: 5%;">
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
                        echo "<tr><td>" . $row["nama"]. "</td><td>" . $row["pangkalan"]. "</td><td><span class='oval red'>Belum Validasi</span></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <footer style="background-color: #030000; color: #ffffff; padding: 20px; text-align: center;">
        <div style="margin-bottom: 20px;">
            <img src="{{ asset('img/LOGO 1.png') }}" alt="Logo 1" style="width:100px;">
        </div>
        <div style="margin-bottom: 20px;">
            <a href="https://www.facebook.com/arvegatu.esempeempat" style="margin: 0 10px; color: #ffffff; text-decoration: none;" title="Facebook">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://www.youtube.com/@arvegatuscout1995" style="margin: 0 10px; color: #ffffff; text-decoration: none;" title="Youtube">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="+62 341 551289" style="margin: 0 10px; color: #ffffff; text-decoration: none;" title="Phone">
                <i class="fa fa-phone"></i>
            </a>
            <a href="https://www.instagram.com/arvegatuscout/" style="margin: 0 10px; color: #ffffff; text-decoration: none;" title="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
        <div style="margin-bottom: 20px;">
            <p>LOGIKA II ©2025. All rights reserved.</p>
            <p>SMP Negeri 4 Malang</p>
        </div>
    </footer>
    
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

        $('#table-participants').DataTable({
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: true
         });

            $('#table-participants2').DataTable({
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: true
            });
    });
</script>

    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Bundle (termasuk Popper.js) -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- SB Admin 2 (menggunakan Bootstrap) -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    
    <!-- DataTables -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
