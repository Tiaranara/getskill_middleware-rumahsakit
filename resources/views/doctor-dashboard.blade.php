<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Dokter</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: system-ui, -apple-system, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 2rem 0; color: #1f2937; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
        .header { background: white; border-radius: 12px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,.1); }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .user-info h1 { font-size: 1.875rem; margin-bottom: .5rem; }
        .badge { display: inline-block; padding: .5rem 1rem; background: #3b82f6; color: white; border-radius: 9999px; font-weight: 600; font-size: .875rem; }
        .logout-btn { padding: .75rem 1.5rem; background: #ef4444; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; }
        .logout-btn:hover { background: #dc2626; }
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 2rem; }
        .card { background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,.1); }
        .card-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; color: #1f2937; border-bottom: 3px solid #3b82f6; padding-bottom: .75rem; }
        .stat-box { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 8px; text-align: center; margin-bottom: 1rem; }
        .stat-number { font-size: 2.5rem; font-weight: 700; }
        .stat-label { font-size: .875rem; opacity: .9; }
        .menu-list { list-style: none; }
        .menu-list li { padding: .75rem 0; border-bottom: 1px solid #e5e7eb; }
        .menu-list li:last-child { border-bottom: none; }
        .menu-list a { color: #3b82f6; text-decoration: none; font-weight: 500; }
        .menu-list a:hover { text-decoration: underline; }
        .action-button { display: inline-block; padding: .75rem 1.25rem; background: #3b82f6; color: white; border-radius: 8px; text-decoration: none; margin-top: .75rem; margin-right: .5rem; font-weight: 600; }
        .action-button:hover { background: #2563eb; }
        .table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        .table th { background: #f3f4f6; padding: .75rem; text-align: left; font-weight: 600; border-bottom: 2px solid #e5e7eb; }
        .table td { padding: .75rem; border-bottom: 1px solid #e5e7eb; }
        .table tbody tr:hover { background: #f9fafb; }
        .badge-urgent { background: #fee2e2; color: #991b1b; padding: .25rem .75rem; border-radius: 4px; font-size: .75rem; font-weight: 600; }
        .badge-normal { background: #dbeafe; color: #1e40af; padding: .25rem .75rem; border-radius: 4px; font-size: .75rem; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="user-info">
                    <h1>Dashboard Dokter</h1>
                    <p>Selamat datang, <strong>{{ $user->name ?? 'Dokter' }}</strong></p>
                    <span class="badge">👨‍⚕️ Dokter Hinara Keylana</span>
                </div>
                <a href="/logout" class="logout-btn">Logout</a>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="dashboard-grid">
            <!-- Statistik Pasien -->
            <div class="card">
                <div class="card-title">📊 Statistik Pasien</div>
                <div class="stat-box">
                    <div class="stat-number">15</div>
                    <div class="stat-label">Total Pasien</div>
                </div>
                <div class="stat-box" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="stat-number">4</div>
                    <div class="stat-label">Pasien Baru Hari Ini</div>
                </div>
            </div>

            <!-- Jadwal Konsultasi -->
            <div class="card">
                <div class="card-title">📅 Jadwal Konsultasi</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Jam</th>
                            <th>Pasien</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>09:00</td>
                            <td>Budi Santoso</td>
                        </tr>
                        <tr>
                            <td>10:30</td>
                            <td>Siti Nurhaliza</td>
                        </tr>
                        <tr>
                            <td>14:00</td>
                            <td>Ahmad Wijaya</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Menu Akses -->
            <div class="card">
                <div class="card-title">⚙️ Menu Akses Cepat</div>
                <ul class="menu-list">
                    <li><a href="/dokter/pasien">👥 Kelola Pasien</a></li>
                    <li><a href="/dokter/rekam-medis">📋 Rekam Medis Pasien</a></li>
                    <li><a href="/dokter/resep">💊 Buat Resep</a></li>
                    <li><a href="/dokter/catatan-medis">📝 Tulis Catatan Medis</a></li>
                    <li><a href="/dokter/jadwal">🗓️ Kelola Jadwal</a></li>
                </ul>
            </div>
        </div>

        <!-- Aksi Utama -->
        <div class="card" style="margin-bottom: 2rem;">
            <div class="card-title">🎯 Aksi Penting</div>
            <a href="/dokter/pasien" class="action-button">Lihat Semua Pasien</a>
            <a href="/dokter/resep/baru" class="action-button">Buat Resep Baru</a>
            <a href="/dokter/catatan-medis/baru" class="action-button">Catat Medis Baru</a>
            <a href="/dokter/jadwal/buat" class="action-button">Buat Jadwal Konsultasi</a>
        </div>

        <!-- Daftar Pasien Terbaru -->
        <div class="card">
            <div class="card-title">📋 Pasien Terbaru</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Budi Santoso</td>
                        <td>Sakit kepala</td>
                        <td><span class="badge-normal">Baru</span></td>
                        <td><a href="/dokter/pasien/1" class="action-button" style="margin: 0; padding: .5rem 1rem; font-size: .875rem;">Lihat</a></td>
                    </tr>
                    <tr>
                        <td>Siti Nurhaliza</td>
                        <td>Demam tinggi</td>
                        <td><span class="badge-urgent">Urgent</span></td>
                        <td><a href="/dokter/pasien/2" class="action-button" style="margin: 0; padding: .5rem 1rem; font-size: .875rem;">Lihat</a></td>
                    </tr>
                    <tr>
                        <td>Ahmad Wijaya</td>
                        <td>Pemeriksaan rutin</td>
                        <td><span class="badge-normal">Follow-up</span></td>
                        <td><a href="/dokter/pasien/3" class="action-button" style="margin: 0; padding: .5rem 1rem; font-size: .875rem;">Lihat</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
