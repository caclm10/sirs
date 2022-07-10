<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/app.css">

    <style>
        body {
            background: rgb(152, 222, 211);
            background: linear-gradient(140deg, rgba(152, 222, 211, 1) 29%, rgba(94, 170, 168, 1) 67%);
        }

    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer>
    </script>
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js" defer></script>
</head>

<body>
    <div class="d-flex h-100 container">
        <main class="m-auto card px-5 py-4 w-100 shadow-lg" style="max-width:450px;">
            <div class="d-flex justify-content-center mb-4">
                <img src="/images/logo.png" alt="logo">
            </div>

            <div class="text-center mb-4">
                <h2 class="fs-5 mb-0" style="font-weight: 700;">Website</h2>
                <h1 class="fs-4 text-uppercase" style="font-weight:400">SMA Swasta Eria</h1>
            </div>

            <form action="/masuk" method="POST" class="mb-5">
                @csrf
                <div class="form-floating mb-3 relative">
                    <span class="iconify" data-icon="carbon:identification"></span>
                    <input type="text" class="form-control ps-5 @error('nomor') is-invalid @enderror" name="nomor"
                        id="nomor" placeholder="NIS/NIP" value="{{ old('nomor') }}">
                    <label for="nomor" class="form-label" style="padding-left: 55px;">NIS/NIP</label>
                    @error('nomor')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3 relative">
                    <span class="iconify" data-icon="carbon:locked"></span>
                    <input type="password" class="form-control ps-5 @error('password') is-invalid @enderror"
                        name="password" id="password" placeholder="Password">
                    <label for="password" class="form-label" style="padding-left: 55px;">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary text-uppercase">Login</button>
                </div>
            </form>
        </main>
    </div>
</body>

</html>
