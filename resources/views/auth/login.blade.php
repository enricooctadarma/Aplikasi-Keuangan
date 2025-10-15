<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #007bff;">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg" style="width: 350px;">
            <div class="card-header text-white text-center" style="background-color: #0056b3;">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn text-white" style="background-color: #007bff;">Login</button>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    <a href="{{ route('register') }}" class="text-primary">Belum punya akun? Daftar di sini</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
