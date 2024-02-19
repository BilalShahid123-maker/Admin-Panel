<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color:  #201b2c;; /* Light gray background */
        }

        .navbar {
            background-color: #201b2c;	 !important; /* Adjusted light red background */
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
            border-radius: 8px; /* Slight curve on edges */
        }

        .navbar-brand {
            color: black !important;
            font-size: 32px;
            font-weight: bold;
            text-decoration: none; /* Remove underline */
        }

        .navbar-brand:hover {
            text-decoration: none; /* Remove underline on hover */
        }

        /* Custom scroll styling */
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-track {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body class="">
    <div class="wrapper">
        <div class="main-panel" id="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="#">ADMIN PANEL</a>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                @yield('content')
            </div>
         
        </div>
    </div>
</body>

</html>
