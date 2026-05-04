<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function (Request $request) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['user_id'])) {
        $user = User::find($_SESSION['user_id']);
        if ($user) {
            if ($user->role === 'dokter') {
                return redirect('/dokter/dashboard');
            } elseif ($user->role === 'perawat') {
                return redirect('/perawat/dashboard');
            }
            return redirect('/dashboard');
        }
    }

    $error = $request->query('error');
    $message = $error === 'invalid' ? '<div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border-left: 4px solid #dc2626;">❌ Email atau password salah. Silakan coba lagi.</div>' : '';
    $csrf_token = csrf_token();

    return <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Rumah Sakit</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .login-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 420px;
            padding: 3rem 2rem;
            animation: slideIn 0.3s ease-out;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .logo-section h1 {
            font-size: 1.75rem;
            color: #1f2937;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }
        .logo-section p {
            color: #6b7280;
            font-size: 0.95rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            color: #374151;
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .form-group input::placeholder {
            color: #9ca3af;
        }
        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .submit-btn:active {
            transform: translateY(0);
        }
        .error-message {
            background: #fee2e2;
            color: #991b1b;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid #dc2626;
            font-size: 0.95rem;
        }
        .footer-text {
            text-align: center;
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo-icon">🏥</div>
            <h1>Rumah Sakit</h1>
            <p>Sistem Manajemen Pasien</p>
        </div>

        {$message}

        <form method="POST" action="/login">
            <input type="hidden" name="_token" value="{$csrf_token}">
            
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    placeholder="Masukkan email Anda"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    placeholder="Masukkan password Anda"
                    required
                >
            </div>

            <button type="submit" class="submit-btn">Login →</button>
        </form>

        <div class="footer-text">
            <p>© 2026 Rumah Sakit. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>
HTML;
});

Route::post('/login', function (Request $request) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $user = User::authenticate(
        $request->input('email'),
        $request->input('password')
    );

    if (! $user) {
        return redirect('/login?error=invalid');
    }

    $_SESSION['user_id'] = $user->id;

    if ($user->role === 'dokter') {
        return redirect('/dokter/dashboard');
    } elseif ($user->role === 'perawat') {
        return redirect('/perawat/dashboard');
    }

    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    $user = User::current();

    if (! $user) {
        return redirect('/login');
    }

    return view('dashboard', ['user' => $user]);
})->middleware('auth');

Route::get('/dokter/dashboard', function () {
    $user = User::current();
    return view('doctor-dashboard', ['user' => $user]);
})->middleware('dokter')->name('dokter.dashboard');

Route::get('/perawat/dashboard', function () {
    $user = User::current();
    return view('nurse-dashboard', ['user' => $user]);
})->middleware('perawat')->name('perawat.dashboard');

Route::get('/logout', function () {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    unset($_SESSION['user_id']);

    return redirect('/login');
})->name('logout');

Route::get('/rekam-medis', function () {
    $user = User::current();

    return <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekam Medis</title>
</head>
<body>
    <h1>Rekam Medis</h1>
    <p>Halo {$user->name}, Anda login sebagai {$user->role}.</p>
    <p>Hanya dokter dan perawat dapat melihat halaman rekam medis.</p>
    <p><a href="/logout">Logout</a></p>
</body>
</html>
HTML;
})->middleware('dokter_or_perawat');
