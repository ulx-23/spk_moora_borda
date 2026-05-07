<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SPK Moora Borda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-login {
            width: 100%;
            max-width: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .card-header {
            background-color: #fff;
            border-bottom: none;
            padding-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="card card-login border-0">
        <div class="card-header">
            <div class="text-primary mb-2">
                <i class="fas fa-chart-line fa-3x"></i>
            </div>
            <h4 class="fw-bold text-dark">SPK GDSS</h4>
            <p class="text-muted small">Silakan login untuk masuk ke sistem</p>
        </div>
        <div class="card-body p-4">
            
            <?= $this->session->flashdata('pesan'); ?>

            <form action="<?= base_url('auth/process') ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold">MASUK <i class="fas fa-sign-in-alt ms-2"></i></button>
                </div>
            </form>
        </div>
        <div class="card-footer bg-light text-center py-3">
            <small class="text-muted">&copy; 2025 Sistem Pendukung Keputusan</small>
        </div>
    </div>

</body>
</html>