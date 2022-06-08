<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- CSS Navbar dan Layouts -->
    <link rel="stylesheet" href="{{ asset('admin/admin.css') }}" />

    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

    <!-- chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Admin | {{ $title }}</title>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class="icon">
                <img src="{{ asset('admin/img/logo.jpeg') }}" alt="" width="28px" />
            </i>
            <div class="logo_name">
                <h2>SULUK</h2>
                <h6>BOOK STORE</h6>
            </div>
            <i class="las la-bars" id="btn"></i>
        </div>
        <ul class="nav-list">
            <li class="{{ $title == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="las la-home"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li class="{{ $title == 'kelolabuku' ? 'active' : '' }}">
                <a href="{{ route('kelolabuku') }}">
                    <i class="las la-book"></i>
                    <span class="links_name">Kelola Data Buku</span>
                </a>
                <span class="tooltip">Kelola Data Buku</span>
            </li>
            <li class="{{ $title == 'kelolatransaksi' ? 'active' : '' }}">
                <a href="{{ route('kelolatransaksi') }}">
                    <i class="las la-comment-dollar"></i>
                    <span class="links_name">Kelola Data Transaksi</span>
                </a>
                <span class="tooltip">Kelola Data Transaksi</span>
            </li>
            <li class="{{ $title == 'kelolapelanggan' ? 'active' : '' }}">
                <a href="{{ route('kelolapelanggan') }}">
                    <i class="las la-user-circle"></i>
                    <span class="links_name">Kelola Akun Pelanggan</span>
                </a>
                <span class="tooltip">Kelola Akun Pelanggan</span>
            </li>


            <li class="profile">
                <div class="profile-details">
                    <img src="img/profile.png" alt="pp" />
                    <div class="name_job">
                        <div class="name">Fauzan Pradana</div>
                        <div class="job">Admin</div>
                    </div>
                </div>
                <i class="las la-sign-out-alt" id="log_out"></i>
            </li>
        </ul>
    </div>

    <!-- EDIT HERE -->
    <section class="home-section p-4">
        @yield('content')
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- custom js -->
    <script src="script.js"></script>

    <!-- Custom js for DASHBOARD ADMIN -->
    <script src="{{ asset('admin/admin.js') }}"></script>
</body>

</html>