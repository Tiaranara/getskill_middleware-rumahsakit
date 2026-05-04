<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Rumah Sakit</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f8fafc; margin: 0; padding: 0; color: #111827; }
        .container { max-width: 900px; margin: 0 auto; padding: 2rem; }
        .card { background: #ffffff; border-radius: 16px; box-shadow: 0 8px 24px rgba(15,23,42,.08); padding: 2rem; }
        .badge { display: inline-flex; padding: .4rem .8rem; border-radius: 9999px; font-weight: 700; font-size: .85rem; }
        .badge-doctor { background: #dbeafe; color: #1e40af; }
        .badge-nurse { background: #d1fae5; color: #065f46; }
        .actions a { display: inline-block; margin-right: .75rem; margin-top: 1rem; padding: .85rem 1.2rem; border-radius: 9999px; text-decoration: none; color: white; background: #1d4ed8; }
        .actions a.logout { background: #ef4444; }
        .section { margin-top: 1.75rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Dashboard Rumah Sakit</h1>
            <p>Halo <strong>{{ $user->name }}</strong>, Anda login sebagai <span class="badge {{ $user->role === 'dokter' ? 'badge-doctor' : 'badge-nurse' }}">{{ ucfirst($user->role) }}</span>.</p>

            <div class="section">
                @if ($user->role === 'dokter')
                    <h2>Menu Dokter</h2>
                    <ul>
                        <li>• Lihat rekam medis pasien</li>
                        <li>• Kelola jadwal konsultasi</li>
                        <li>• Tulis catatan medis</li>
                    </ul>
                @elseif ($user->role === 'perawat')
                    <h2>Menu Perawat</h2>
                    <ul>
                        <li>• Lihat dan update catatan perawatan</li>
                        <li>• Bantu proses rawat inap pasien</li>
                        <li>• Pantau kebutuhan obat dan peralatan</li>
                    </ul>
                @else
                    <h2>Peran tidak dikenali</h2>
                    <p>Hanya doctor dan perawat yang mendapat akses dashboard ini.</p>
                @endif
            </div>

            <div class="section actions">
                @if ($user->role === 'dokter')
                    <a href="/dokter/dashboard">Dashboard Dokter</a>
                @elseif ($user->role === 'perawat')
                    <a href="/perawat/dashboard">Dashboard Perawat</a>
                @endif
                @if (in_array($user->role, ['dokter', 'perawat'], true))
                    <a href="/rekam-medis">Buka Rekam Medis</a>
                @endif
                <a href="/logout" class="logout">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
