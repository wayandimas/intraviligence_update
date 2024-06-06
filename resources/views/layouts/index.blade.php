<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="text-wrap text-center d-flex align-items-center order-md-last">
                            <div class="text w-100">
                                <img src="assets/images/img_login.png" class="w-100" alt=""
                                    style="  max-width: 100%;height: auto;" />
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4" style="font-size: 48px">
                                        Login
                                    </h3>
                                </div>
                            </div>
                            <h3 style="color: #757575; font-size: 20px">
                                Welcome back!
                            </h3>
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{ route('login.post') }}" class="signin-form" method="POST">
                                @csrf @if ($errors->first('login'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('login') }}
                                    </div>
                                @endif
                                <div class="form-group mb-3">
                                    <label for="countries" class="label">User ID</label>

                                    <select class="form-control" aria-label="Default select example" name="user"
                                        id="user">
                                        <option selected disabled="disabled">
                                            User ID
                                        </option>
                                        @foreach ($datas as $key => $data)
                                            <option value="{{ $data->nama }}">
                                                {{ $data->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        id="password" required />
                                </div>
                                <input type="hidden" name="device_id" id="device_id">
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary submit px-3">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Isi footer, misalnya informasi tambahan, tautan, dll. -->
                <p>&copy; 2023 Developed By Teknik Komputer dan Jaringan PNUP.</p>
            </div>
        </div>
    </div>
</footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/2.1.0/fingerprint2.min.js"></script>
    <script>
        // Generate a browser fingerprint using Fingerprint.js
        new Fingerprint2().get(function(result) {
            // Store the fingerprint in a hidden input field
            document.getElementById('device_id').value = result;
        });
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
