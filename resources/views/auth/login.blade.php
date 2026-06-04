<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - SIPENSA</title>

<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Suez+One&display=swap" rel="stylesheet">

<style>

/* =========================================================
   BASE
========================================================= */

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    font-family: 'Segoe UI', sans-serif;
    background: url('/bg-sekolah.jpg') no-repeat center center / cover;
    min-height: 100vh;
}

.brand-font{
    font-family: 'Suez One', serif;
    font-size: 20px;
    letter-spacing: 0.5px;
}

/* =========================================================
   OVERLAY
========================================================= */

.overlay{
    position: fixed;
    inset: 0;
    background: rgba(10,127,46,.55);
    z-index: 1;
}

/* =========================================================
   NAVBAR
========================================================= */

.navbar{
    background: #086a25;
    height: 64px;
    position: relative;
    z-index: 3;
    box-shadow: 0 2px 12px rgba(0,0,0,.15);
}

.navbar a{
    color: white !important;
}

.navbar-brand{
    display: flex;
    align-items: center;
    gap: 10px;
}

.navbar-brand span{
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* =========================================================
   LOGIN WRAPPER
========================================================= */

.login-wrapper{
    min-height: calc(100vh - 64px);
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 2;
    padding: 24px 16px;
}

/* =========================================================
   LOGIN CARD
========================================================= */

.login-card{
    background: #f8f9fa;
    border-radius: 20px;
    padding: 40px 36px;
    width: 100%;
    max-width: 460px;
    box-shadow: 0 20px 60px rgba(0,0,0,.25);

    animation: fadeUp .5s ease both;
}

/* Header card */
.login-header{
    text-align: center;
    margin-bottom: 28px;
}

.login-header .icon-wrap{
    width: 60px;
    height: 60px;
    border-radius: 16px;
    background: #0a7f2e;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin: 0 auto 14px;
}

.login-header h5{
    font-size: 20px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 4px;
}

.login-header p{
    font-size: 14px;
    color: #6b7280;
}

/* Form label */
.form-label{
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}

/* Input */
.form-control{
    height: 50px;
    border-radius: 12px;
    border: 1.5px solid #e5e7eb;
    font-size: 15px;
    padding: 0 16px;
    background: white;
    box-shadow: none !important;
    transition: border-color .2s;
}

.form-control:focus{
    border-color: #0a7f2e;
    background: white;
}

.form-control::placeholder{
    color: #9ca3af;
    font-size: 14px;
}

/* Password wrapper */
.input-password{
    position: relative;
}

.input-password .form-control{
    padding-right: 48px;
}

.toggle-password{
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #9ca3af;
    font-size: 18px;
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
    transition: color .2s;
}

.toggle-password:hover{
    color: #0a7f2e;
}

/* Remember me */
.form-check-input:checked{
    background-color: #0a7f2e;
    border-color: #0a7f2e;
}

.form-check-label{
    font-size: 14px;
    color: #6b7280;
}

/* Error */
.error-msg{
    font-size: 12px;
    color: #dc2626;
    margin-top: 5px;
}

/* Tombol Login */
.btn-login{
    height: 50px;
    border-radius: 12px;
    background: #0a7f2e;
    color: white;
    border: none;
    font-size: 16px;
    font-weight: 600;
    width: 100%;
    letter-spacing: 0.3px;
    transition: .2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-login:hover{
    background: #086a25;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(10,127,46,.3);
}

.btn-login:active{
    transform: translateY(0);
}

/* =========================================================
   ANIMASI
========================================================= */

@keyframes fadeUp{
    from{
        opacity: 0;
        transform: translateY(24px);
    }
    to{
        opacity: 1;
        transform: translateY(0);
    }
}

/* =========================================================
   RESPONSIVE — TABLET (769px – 1024px)
========================================================= */

@media(min-width:769px) and (max-width:1024px){

    .login-card{
        max-width: 440px;
        padding: 36px 32px;
    }

}

/* =========================================================
   RESPONSIVE — MOBILE (≤ 768px)
========================================================= */

@media(max-width:768px){

    .brand-font{
        font-size: 16px;
    }

    .navbar-brand img{
        width: 32px;
    }

    .login-wrapper{
        align-items: center;
        padding: 16px;
    }

    .login-card{
        padding: 22px 18px;
        border-radius: 16px;
        max-width: 340px;
    }

    .login-header{
        margin-bottom: 18px;
    }

    .login-header .icon-wrap{
        width: 44px;
        height: 44px;
        font-size: 20px;
        border-radius: 12px;
        margin-bottom: 10px;
    }

    .login-header h5{
        font-size: 16px;
        margin-bottom: 2px;
    }

    .login-header p{
        font-size: 12px;
    }

    .form-label{
        font-size: 13px;
        margin-bottom: 4px;
    }

    .form-control{
        height: 42px;
        font-size: 13px;
        border-radius: 10px;
    }

    .mb-3{
        margin-bottom: 10px !important;
    }

    .mb-4{
        margin-bottom: 14px !important;
    }

    .form-check-label{
        font-size: 13px;
    }

    .btn-login{
        height: 42px;
        font-size: 14px;
        border-radius: 10px;
    }

}

/* =========================================================
   RESPONSIVE — SMALL MOBILE (≤ 400px)
========================================================= */

@media(max-width:400px){

    .brand-font{
        font-size: 14px;
    }

    .navbar-brand img{
        width: 28px;
    }

    .login-card{
        padding: 24px 16px;
    }

    .login-header h5{
        font-size: 16px;
    }

    .login-header p{
        font-size: 13px;
    }

}

</style>
</head>

<body>

<!-- OVERLAY -->
<div class="overlay"></div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">

        <a class="navbar-brand text-white brand-font" href="/">
            <img src="/logo.png" width="40" alt="Logo">
            <span>SIPENSA</span>
        </a>

    </div>
</nav>

<!-- LOGIN -->
<div class="login-wrapper">
    <div class="login-card">

        <!-- Header -->
        <div class="login-header">
            <div class="icon-wrap">
                <i class="bi bi-shield-lock"></i>
            </div>
            <h5>Masuk ke SIPENSA</h5>
            <p>Gunakan akun sekolah kamu untuk login</p>
        </div>

        <!-- Alert error Laravel -->
        @if($errors->any())
        <div class="alert alert-danger py-2 px-3 mb-3" style="border-radius:10px; font-size:14px;">
            <i class="bi bi-exclamation-circle me-1"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="email@sekolah.sch.id"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-password">
                    <input
                        type="password"
                        name="password"
                        id="passwordInput"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password"
                        required
                    >
                    <button type="button" class="toggle-password" id="togglePwd" aria-label="Lihat password">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Ingat saya</label>
            </div>

            <!-- Tombol -->
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>

        </form>

    </div>
</div>

<script>
/* Toggle show/hide password */
const togglePwd   = document.getElementById('togglePwd');
const passwordInput = document.getElementById('passwordInput');
const eyeIcon     = document.getElementById('eyeIcon');

togglePwd.addEventListener('click', () => {
    const isHidden = passwordInput.type === 'password';
    passwordInput.type = isHidden ? 'text' : 'password';
    eyeIcon.className  = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
});
</script>

</body>
</html>