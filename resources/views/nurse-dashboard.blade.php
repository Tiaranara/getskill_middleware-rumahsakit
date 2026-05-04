<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Perawat</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: system-ui, -apple-system, sans-serif; background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); min-height: 100vh; padding: 2rem 0; color: #1f2937; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
        .header { background: white; border-radius: 12px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,.1); }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .user-info h1 { font-size: 1.875rem; margin-bottom: .5rem; }
        .badge { display: inline-block; padding: .5rem 1rem; background: #06b6d4; color: white; border-radius: 9999px; font-weight: 600; font-size: .875rem; }
        .logout-btn { padding: .75rem 1.5rem; background: #ef4444; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; }
        .logout-btn:hover { background: #dc2626; }
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 2rem; }
        .card { background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,.1); }
        .card-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; color: #1f2937; border-bottom: 3px solid #06b6d4; padding-bottom: .75rem; }
        .stat-box { background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; padding: 1.5rem; border-radius: 8px; text-align: center; margin-bottom: 1rem; }
        .stat-number { font-size: 2.5rem; font-weight: 700; }
        .stat-label { font-size: .875rem; opacity: .9; }
        .menu-list { list-style: none; }
        .menu-list li { padding: .75rem 0; border-bottom: 1px solid #e5e7eb; }
        .menu-list li:last-child { border-bottom: none; }
        .menu-list a { color: #06b6d4; text-decoration: none; font-weight: 500; }
        .menu-list a:hover { text-decoration: underline; }
        .action-button { display: inline-block; padding: .75rem 1.25rem; background: #06b6d4; color: white; border-radius: 8px; text-decoration: none; margin-top: .75rem; margin-right: .5rem; font-weight: 600; }
        .action-button:hover { background: #0891b2; }
        .table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        .table th { background: #f3f4f6; padding: .75rem; text-align: left; font-weight: 600; border-bottom: 2px solid #e5e7eb; }
        .table td { padding: .75rem; border-bottom: 1px solid #e5e7eb; }
        .table tbody tr:hover { background: #f9fafb; }
        .badge-critical { background: #fee2e2; color: #991b1b; padding: .25rem .75rem; border-radius: 4px; font-size: .75rem; font-weight: 600; }
        .badge-stable { background: #d1fae5; color: #065f46; padding: .25rem .75rem; border-radius: 4px; font-size: .75rem; font-weight: 600; }
        .badge-recovery { background: #fef3c7; color: #92400e; padding: .25rem .75rem; border-radius: 4px; font-size: .75rem; font-weight: 600; }
        .checklist { margin-top: 1rem; }
        .checklist-item { padding: .75rem; background: #f3f4f6; border-radius: 6px; margin-bottom: .5rem; display: flex; align-items: center; }
        .checklist-item input { margin-right: .75rem; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="user-info">
                    <h1>Dashboard Perawat</h1>
                    <p>Selamat datang, <strong>{{ $user->name ?? 'Perawat' }}</strong></p>
                    <span class="badge">👩‍⚕️ Perawat Theresa Kayra</span>
                </div>
                <a href="/logout" class="logout-btn">Logout</a>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="dashboard-grid">
            <!-- Statistik Pasien Rawat Inap -->
            <div class="card">
                <div class="card-title">🏥 Pasien Rawat Inap</div>
                <div class="stat-box">
                    <div class="stat-number">8</div>
                    <div class="stat-label">Total Pasien di Ruang Inap</div>
                </div>
                <div class="stat-box" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <div class="stat-number">6</div>
                    <div class="stat-label">Pasien Stabil</div>
                </div>
                <div class="stat-box" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <div class="stat-number">2</div>
                    <div class="stat-label">Perlu Perhatian</div>
                </div>
            </div>

            <!-- Tanda Vital Pasien -->
            <div class="card">
                <div class="card-title">❤️ Monitoring Tanda Vital</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pasien</th>
                            <th>Ruang</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Budi Santoso</td>
                            <td>A-101</td>
                            <td><span class="badge-stable">Stabil</span></td>
                        </tr>
                        <tr>
                            <td>Siti Nurhaliza</td>
                            <td>B-205</td>
                            <td><span class="badge-critical">Kritis</span></td>
                        </tr>
                        <tr>
                            <td>Ahmad Wijaya</td>
                            <td>A-102</td>
                            <td><span class="badge-recovery">Pemulihan</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Menu Akses -->
            <div class="card">
                <div class="card-title">⚙️ Menu Akses Cepat</div>
                <ul class="menu-list">
                    <li><a href="/perawat/pasien">👥 Kelola Pasien Rawat Inap</a></li>
                    <li><a href="/perawat/tanda-vital">📊 Catat Tanda Vital</a></li>
                    <li><a href="/perawat/obat">💊 Pemberian Obat</a></li>
                    <li><a href="/perawat/catatan-perawatan">📝 Catatan Perawatan</a></li>
                    <li><a href="/perawat/kebutuhan">🛠️ Kebutuhan Peralatan</a></li>
                </ul>
            </div>
        </div>

        <!-- Aksi Utama -->
        <div class="card" style="margin-bottom: 2rem;">
            <div class="card-title">🎯 Aksi Penting</div>
            <a href="/perawat/tanda-vital/cek" class="action-button">Cek Tanda Vital Pasien</a>
            <a href="/perawat/obat/pemberian" class="action-button">Catat Pemberian Obat</a>
            <a href="/perawat/catatan-perawatan/buat" class="action-button">Buat Catatan Perawatan</a>
            <a href="/perawat/kebutuhan/lapor" class="action-button">Lapor Kebutuhan</a>
        </div>

        <!-- Daftar Tugas Hari Ini -->
        <div class="card" style="margin-bottom: 2rem;">
            <div class="card-title">✅ Checklist Tugas Hari Ini</div>
            <div class="checklist">
                <div class="checklist-item">
                    <input type="checkbox"> Cek tanda vital pasien ruang A (09:00)
                </div>
                <div class="checklist-item">
                    <input type="checkbox"> Berikan obat pasien ruang B-205 (10:00)
                </div>
                <div class="checklist-item">
                    <input type="checkbox"> Ubah perban pasien A-101 (11:00)
                </div>
                <div class="checklist-item">
                    <input type="checkbox"> Cek tanda vital pasien ruang B (14:00)
                </div>
                <div class="checklist-item">
                    <input type="checkbox"> Dokumentasi catatan perawatan (15:30)
                </div>
            </div>
        </div>

        <!-- Pasien Memerlukan Perhatian -->
        <div class="card">
            <div class="card-title">⚠️ Pasien Memerlukan Perhatian Khusus</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Pasien</th>
                        <th>Ruang</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Siti Nurhaliza</td>
                        <td>B-205</td>
                        <td><span class="badge-critical">Demam 40°C</span></td>
                        <td><a href="/perawat/pasien/2" class="action-button" style="margin: 0; padding: .5rem 1rem; font-size: .875rem;">Lihat</a></td>
                    </tr>
                    <tr>
                        <td>Rudi Hartono</td>
                        <td>B-210</td>
                        <td><span class="badge-critical">Post-operasi</span></td>
                        <td><a href="/perawat/pasien/4" class="action-button" style="margin: 0; padding: .5rem 1rem; font-size: .875rem;">Lihat</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
