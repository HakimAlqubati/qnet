<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QNET Dashboard - Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            background-color: #f5f5f5;
        }

        /* 🔹 Header Styling */
        .header-container {
            background-color: white;
            border-bottom: 2px solid #ff6600;
            padding-bottom: 5px;
        }

        /* 🔹 Logout Button */
        .btn-orange {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-orange:hover {
            background-color: #e65c00;
        }

        /* 🔹 Language Selector */
        .language-selector {
            font-size: 14px;
            width: 130px;
            padding: 3px;
        }

        /* 🔹 User Info */
        .user-info {
            font-size: 14px;
            color: #444;
            width: 40%;
            text-align: left;
        }

        .user-info .last-login {
            font-size: 12px;
            color: #777;
        }

        .user-status td {
            font-size: 13px;
            padding: 2px 5px;
        }

        .user-status {
            width: 100%;
            border-collapse: collapse;
        }

        .user-status {
            font-size: 13px;
            padding: 2px 5px;
            border-top: 1px solid #ddd;
            /* Keep top border */
            border-bottom: 1px solid #ddd;
            /* Keep bottom border */
            border-left: none;
            /* Remove left border */
            border-right: none;
            /* Remove right border */
        }

        .status-text {
            font-weight: bold;
            color: #d48806;
        }

        /* 🔹 QNET Logo */
        .qnet-logo {
            width: 100px;
        }

        /* 🔹 Social Media Icons */
        .social-icons img {
            width: 24px;
            margin: 0 5px;
        }

        .top-nav {
            background-color: #ff6600;
            padding: 10px;
        }

        .top-nav a {
            color: white;
            font-weight: bold;
            padding: 10px;
            text-decoration: none;
        }

        .news-section {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .countdown span {
            background-color: black;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .announcement {
            background-color: yellow;
            padding: 10px;
            text-align: center;
            border-radius: 10px;
        }

        .paragraph_in_panel {
            background: #fff8e5;
            border: 1px solid #ffcc00;
            padding: 10px;
            font-size: 12px;
            color: #333;
            border-radius: 5px;
        }

        .countdown {
            display: flex;
            justify-content: right;
            gap: 5px;
            margin-top: 10px;
        }

        .countdown-container span {
            background-color: black;
            color: white;
            padding: 8px 12px;
            font-size: 16px;
            border-radius: 5px;
        }

        /* 🔹 تعديل صندوق الإعلان */
        .announcement {
            width: 25%;
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        /* 🔹 تحريك "إعلان هام" إلى أقصى اليسار */
        .announcement h3 {
            background-color: #ff6600;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            float: left;
            margin-left: 5px;
        }

        .announcement-content {
            clear: both;
            /* يضمن أن المحتوى لا يلتف بجانب الزر */
            padding-top: 10px;
        }

        .announcement a {
            text-decoration: none;
            font-weight: bold;
            color: #ff6600;
        }

        .announcement button {
            background-color: #444;
            color: white;
            width: 100%;
            border: none;
            padding: 8px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 14px;
        }

        .announcement button:hover {
            background-color: #333;
        }

        /* 🔹 تنسيق الصفحة العامة */
        .banner-container {
            display: flex;
            gap: 15px;
        }

        .banner {
            position: relative;
            width: 75%;
            border-radius: 10px;
            overflow: hidden;
        }

        .banner img {
            width: 100%;
            border-radius: 10px;
        }

        /* 🔹 تنسيق الأزرار السفلية */
        .pagination-container {
            display: flex;
            justify-content: right;
            margin-top: 10px;
            gap: 5px;
        }

        .pagination-container span {
            background-color: #333;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .pagination-container span.active {
            background-color: #ff6600;
        }


        /* second navbar */
        .orange-menu {
            padding: 10px;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .menu-item {
            background-color: #ffa033;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .menu-item:hover {
            background-color: #ff8800;
        }

        .icon {
            font-size: 16px;
        }


        .nav-tabs .nav-link {
            background-color: #ffa033;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px 5px 0 0;
            font-size: 14px;
        }

        .nav-tabs .nav-link.active {
            background-color: #ff8800;
            color: white;
        }

        .tab-content {
            border: 1px solid #ff8800;
            border-top: none;
            /* padding: 20px; */
            background: white;
            border-radius: 0 0 5px 5px;
        }

        .settlement-summary {
            border: 1px solid #ff6600;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .settlement-summary .header {
            background-color: #ff6600;
            color: white;
            font-weight: bold;
            padding: 10px;
            text-align: center;
        }

        .settlement-table th {
            background-color: #ff8800;
            color: white;
        }

        .settlement-table th,
        .settlement-table td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .settlement-footer {
            background-color: #ff8800;
            color: white;
            font-weight: bold;
            padding: 10px;
            text-align: center;
        }

        .nav-item {
            margin-left: 15px;
        }

        .social-icons i {
            color: rgb(255 102 0);
            font-size: 29px;
        }

        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card .btn {
            margin-top: auto;
            /* Ensures the button stays at the bottom */
        }




        .based_on_history_body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
            direction: ltr;
        }

        .based_on_history_body .table-container {
            margin: 20px auto;
            width: 50%;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .based_on_history_body table {
            width: 100%;
            border-collapse: collapse;
        }

        .based_on_history_body th,
        .based_on_history_body td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        .based_on_history_body th {
            background-color: orange;
        }

        .based_on_history_body td:first-child {
            width: 80px;
            /* Adjust width of select column */
        }

        .based_on_history_body form {
            margin: 20px;
        }

        .based_on_history_body input,
        .based_on_history_body select {
            padding: 5px;
            font-size: 16px;
        }

        .based_on_history_body button {
            padding: 6px 15px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        .based_on_history_body button:hover {
            background-color: #218838;
        }


        /** Swapper */
        /* 🔹 Banner Swapper (Image Slider) */
        /* 🔹 Fixed Swapper CSS */
        /* 🔹 Banner Swapper (Fixed Image Slider) */
        .slider {
            position: relative;
            width: 75%;
            max-width: 800px;
            /* Ensure a fixed max width */
            border-radius: 10px;
            overflow: hidden;
            height: 300px;
        }

        /* 🔹 Ensure slides display correctly */
        .slides {
            display: flex;
            width: 400%;
            /* 4 slides (4 * 100%) */
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            width: 100%;
            flex: 0 0 100%;
            /* Each slide takes full container width */
        }

        /* 🔹 Ensure images fit correctly */
        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* 🔹 Navigation Arrows */
        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 50%;
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }

        .prev:hover,
        .next:hover {
            background: black;
        }

        /* 🔹 Pagination Dots */
        .pagination-container {
            text-align: center;
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .dot {
            height: 12px;
            width: 12px;
            margin: 5px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
        }

        .active,
        .dot:hover {
            background-color: #ff6600;
        }


        /** end Swapper */
    </style>
</head>

<body>

    <!-- 🔹 Header Section -->
    <header class="container-fluid py-2 header-container">
        <div class="container d-flex justify-content-between align-items-center">


            <!-- Left Section: Language Selector & Logout Button -->
            <div class="d-flex align-items-center">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-orange">
                        {{ __('تسجيل خروج') }}
                    </button>
                </form>
                <select class="form-select me-2" style="background-color: white; border: 1px solid black;"
                    onchange="window.location.href=this.value">
                    <option value="{{ route('changeLang', 'ar') }}">🇸🇦 العربية</option>
                    <option value="{{ route('changeLang', 'en') }}">🇺🇸 English</option>
                </select>

            </div>




            <!-- Middle Section: User Info -->
            <div class="user-info text-left">
                <p class="mb-0">
                    {{-- {{ __('messages.welcome') }} --}}
                    {{ 'مرحباً ' }}
                    بك مجدداً! <strong>
                        {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                    </strong></p>
                <p class="last-login">آخر تسجيل للدخول: 04 JAN 2024 - 23:56 (HKST)</p>
                <table class="table table-borderless user-status table-bordered">



                    <tr>
                        <td class="text-start">رتبة الراتب:</td>
                        <td class="text-end"><span class="status-text">
                                {{ auth()->user()->rank->name ?? 'غير محدد' }}
                            </span></td>
                    </tr>
                    <tr>
                        <td class="text-start">رتبة الفريق:</td>
                        <td class="text-end"><span class="status-text">
                                {{ auth()->user()->teamRank->name ?? 'غير محدد' }}
                            </span></td>
                    </tr>




                </table>
            </div>

            <!-- Right Section: Logo & Social Media -->
            <div class="align-items-center">
                <div>
                    <img src="{{ url('/') . '/storage/logo/logo.svg' }}" alt="QNET Logo" class="qnet-logo">
                </div>

                <div class="social-icons ms-3">
                    <a href="https://www.youtube.com/subscription_center?add_user=qnetofficial">
                        <i class=" fab fa-youtube"></i>
                    </a>
                    <a href="https://www.facebook.com/share/151BYK4ggx/">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/qnetofficial?igsh=MWY0OTZraGE5aWVvZg==">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

        </div>
    </header>

    <!-- 🔹 Navigation Bar -->
    <nav class="top-nav text-center">
        <a href="#">مركز التعليمات</a>
        <a href="#">حجم المبيعات - GR</a>
        <a href="#">حساب RSP</a>
        <a href="#">فحص النقاط الإلكترونية</a>
        <a href="#">طلباتي</a>
    </nav>

    <!-- 🔹 News Section -->
    <div class="container my-4">
        <div class="banner-container">

            <!-- Announcement Section -->
            <div class="announcement">
                <h3>إعلان هام</h3>
                <div class="announcement-content">
                    <img src="{{ url('/') . '/storage/logo/side-add.png' }}" alt="Important Announcement"
                        class="img-fluid">
                    <p>Sales Month Calendar 2024</p>
                    <a href="#">...Click here</a>
                    <button>المزيد من الأخبار</button>
                </div>
            </div>


            <!-- Banner Section -->
            <!-- 🔹 Banner Swapper (Fixed Image Slider) -->
            <div class="slider">
                <div class="slides">
                    <div class="slide"><img
                            src="https://fastly.picsum.photos/id/237/200/300.jpg?hmac=TmmQSbShHz9CdQm0NkEjx1Dyh_Y984R9LpNrpvH2D_U"
                            alt="Image 1"></div>
                    <div class="slide"><img
                            src="https://fastly.picsum.photos/id/866/200/300.jpg?hmac=rcadCENKh4rD6MAp6V_ma-AyWv641M4iiOpe1RyFHeI"
                            alt="Image 2"></div>
                    <div class="slide"><img
                            src="https://fastly.picsum.photos/id/237/200/300.jpg?hmac=TmmQSbShHz9CdQm0NkEjx1Dyh_Y984R9LpNrpvH2D_U"
                            alt="Image 3"></div>
                    <div class="slide"><img
                            src="https://fastly.picsum.photos/id/866/200/300.jpg?hmac=rcadCENKh4rD6MAp6V_ma-AyWv641M4iiOpe1RyFHeI"
                            alt="Image 4"></div>
                </div>

                <!-- Navigation Arrows -->
                <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
                <button class="next" onclick="moveSlide(1)">&#10095;</button>

                <!-- Pagination Dots -->
                <div class="pagination-container">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    <span class="dot" onclick="currentSlide(4)"></span>
                </div>
            </div>




        </div>


    </div>


    <div class="container my-3">
        <!-- 🔹 Tabs Navigation -->
        <ul class="nav nav-tabs justify-content-center" id="settlementTabs">
            <li class="nav-item">

                <a class="nav-link active" data-bs-toggle="tab" href="#orders">
                    <span class="icon">💬</span>
                    <span>
                        الطلب والدفع
                    </span>
                </a>
            </li>
            <li class="nav-item">

                <a class="nav-link" data-bs-toggle="tab" href="#history">
                    <span class="icon">💬</span>
                    <span>
                        حسب التاريخ - GR
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#account">
                    <span class="icon">💬</span>
                    <span>حساب Q</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#ecard">
                    <span class="icon">💬</span>
                    <span>
                        مدقق البطاقة الإلكترونية
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#network">
                    <span class="icon">💬</span>
                    <span>
                        شبكتي الافتراضية
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#settlement">
                    <span class="icon">💬</span>
                    <span> دليل التسوية</span>
                </a>
            </li>
        </ul>

        <!-- 🔹 Tabs Content -->
        <div class="tab-content">
            <div id="orders" class="tab-pane fade show active">

            </div>

            <div id="history" class="tab-pane fade">
                <div class="based_on_history_body">

                    <form id="nameForm">
                        <select id="sideSelect">
                            <option value="L">L</option>
                            <option value="R">R</option>
                        </select>
                        <input type="text" id="nameInput" placeholder="ادخل الاسم" required>
                        <button type="submit">إضافة</button>
                    </form>

                    <div id="tablesContainer"></div> <!-- This will hold all generated tables -->



                </div>

            </div>

            <div id="account" class="tab-pane fade">

            </div>

            <div id="ecard" class="tab-pane fade">
                <div class="based_on_history_body">
                    <div class="table-container">
                        <table>
                            <thead>
                                <th colspan="100%">.</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="network" class="tab-pane fade">

            </div>

            <!-- ✅ ملخص التسوية مطابق للصورة -->
            <!-- ✅ دليل التسوية (Settlement Guide) -->
            <div id="settlement" class="tab-pane fade">
                <div class="settlement-summary">
                    <div class="header">ملخص التسوية</div>
                    <table class="table settlement-table">
                        <thead>
                            <tr>
                                <th>نوع البطاقة</th>
                                <th>القيمة (USD)</th>
                                <th>الكمية</th>
                                <th>الإجمالي الفرعي (USD)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- صف نموذج لـ eCard بقيمة 1.00 -->
                            <tr>
                                <td>eCard (USD)</td>
                                <td class="dollar-value">1.00</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" value="0"
                                        min="0" step="1" style="width:80px;" data-dollar="1.00">
                                </td>
                                <td class="subtotal">0.00</td>
                            </tr>
                            <!-- صف نموذج لـ eCard بقيمة 5.00 -->
                            <tr>
                                <td>eCard (USD)</td>
                                <td class="dollar-value">5.00</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" value="0"
                                        min="0" step="1" style="width:80px;" data-dollar="5.00">
                                </td>
                                <td class="subtotal">0.00</td>
                            </tr>
                            <!-- صف نموذج لـ eCard بقيمة 10.00 -->
                            <tr>
                                <td>eCard (USD)</td>
                                <td class="dollar-value">10.00</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" value="0"
                                        min="0" step="1" style="width:80px;" data-dollar="10.00">
                                </td>
                                <td class="subtotal">0.00</td>
                            </tr>
                            <!-- صف نموذج لـ eCard بقيمة 20.00 -->
                            <tr>
                                <td>eCard (USD)</td>
                                <td class="dollar-value">20.00</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" value="0"
                                        min="0" step="1" style="width:80px;" data-dollar="20.00">
                                </td>
                                <td class="subtotal">0.00</td>
                            </tr>
                            <!-- صف نموذج لـ eCard بقيمة 50.00 -->
                            <tr>
                                <td>eCard (USD)</td>
                                <td class="dollar-value">50.00</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" value="0"
                                        min="0" step="1" style="width:80px;" data-dollar="50.00">
                                </td>
                                <td class="subtotal">0.00</td>
                            </tr>
                            <!-- صف نموذج لـ eCard بقيمة 100.00 -->
                            <tr>
                                <td>eCard (USD)</td>
                                <td class="dollar-value">100.00</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" value="0"
                                        min="0" step="1" style="width:80px;" data-dollar="100.00">
                                </td>
                                <td class="subtotal">0.00</td>
                            </tr>
                            <!-- صف نموذج لـ eCard بقيمة 200.00 -->
                            <tr>
                                <td>eCard (USD)</td>
                                <td class="dollar-value">200.00</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" value="0"
                                        min="0" step="1" style="width:80px;" data-dollar="200.00">
                                </td>
                                <td class="subtotal">0.00</td>
                            </tr>
                            <!-- صف نموذج لـ eCard بقيمة 400.00 -->
                            <tr>
                                <td>eCard (USD)</td>
                                <td class="dollar-value">400.00</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" value="0"
                                        min="0" step="1" style="width:80px;" data-dollar="400.00">
                                </td>
                                <td class="subtotal">0.00</td>
                            </tr>
                            <!-- صف نموذج لـ eCard بقيمة 500.00 -->
                            <tr>
                                <td>eCard (USD)</td>
                                <td class="dollar-value">500.00</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" value="0"
                                        min="0" step="1" style="width:80px;" data-dollar="500.00">
                                </td>
                                <td class="subtotal">0.00</td>
                            </tr>
                            <!-- صف نموذج لبطاقة جديدة بقيمة 1.00 -->
                            <tr>
                                <td>نوع جديد للبطاقة</td>
                                <td class="dollar-value">1.00</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" value="0"
                                        min="0" step="1" style="width:80px;" data-dollar="1.00">
                                </td>
                                <td class="subtotal">0.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"><strong>الإجمالي الفرعي (دولار أمريكي)</strong></td>
                                <td id="totalSubTotal"><strong>(USD) 0.00</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3">الرسوم (دولار أمريكي)</td>
                                <td id="fees">(USD) 0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="settlement-footer">رصيد حساب Q النهائي بعد التسوية: <span
                            id="finalBalance">0.00</span> (USD)</div>
                </div>
                <div class="text-center mt-3">
                    <textarea id="withdrawalNotes" class="form-control mb-2" placeholder="أدخل ملاحظات الطلب (اختياري)"></textarea>
                    <button id="submitWithdrawal" class="btn btn-warning w-100">إرسال طلب السحب</button>
                </div>

            </div>


        </div>
    </div>

    <!-- 🔹 Main Dashboard Container -->
    <div class="container">
        <div class="row">
            <!-- Right Sidebar -->
            <div class="col-lg-3">
                <div class="shadow-sm mb-3">
                    <img src="{{ url('/') . '/storage/logo/rsp_calc.png' }}" class="card-img-top"
                        alt="RSP Calculator">
                </div>
                <div class="shadow-sm mb-3">
                    <img src="https://plus.unsplash.com/premium_photo-1683865776032-07bf70b0add1?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="card-img-top" alt="Fast Start">
                </div>
                <div class="shadow-sm mb-3">
                    <img src="https://plus.unsplash.com/premium_photo-1683865776032-07bf70b0add1?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="card-img-top" alt="Weblearn">
                </div>
                <div class="shadow-sm mb-3">
                    <img src="https://plus.unsplash.com/premium_photo-1683865776032-07bf70b0add1?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="card-img-top" alt="Shop Now">
                </div>
            </div>

            <!-- Left Section -->
            <div class="col-lg-9">
                <!-- 🔹 Panels Section -->
                <div class="row">

                    <!-- 🔹 Commissions Panel (Right) -->
                    <div class="col-md-4">
                        <div class="card p-3 shadow-sm text-center border rounded-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">💰 اللجان</h6>
                                <img src="https://cdn-icons-png.flaticon.com/512/2698/2698259.png" alt="Coins Icon"
                                    width="20">
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="mb-0">الأسبوع:</label>
                                <select class="form-select form-select-sm w-50">
                                    <option>52</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="mb-0">السنة:</label>
                                <select class="form-select form-select-sm w-50">
                                    <option>2023</option>
                                </select>
                            </div>
                            <button class="btn btn-dark w-100 py-2">إظهار</button>
                            <div class="p-2 mt-3 text-start border rounded bg-light">
                                <p class="mb-0 text-muted" style="font-size: 12px;">
                                    ✅ قد يتم تحصيل بعض المعاملات بناءً على سياسة التمويل المحلية.
                                    🔹 تحقق من <a href="#" class="fw-bold text-primary">سجل</a> لمعرفة التفاصيل.
                                    🔹 <a href="#" class="fw-bold text-primary">BV صـرفـة نقـاط</a>
                                </p>
                            </div>
                        </div>
                    </div>







                    <!-- 🔹 Your Current RSP Panel (Middle) -->
                    <div class="col-md-4">
                        <div class="card p-3 shadow-sm text-center border rounded-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">📊 Your Current RSP</h6>
                                <img src="https://cdn-icons-png.flaticon.com/512/1698/1698535.png" alt="Icon"
                                    width="20">
                            </div>
                            <hr>
                            <p class="mb-3"><a href="#" class="fw-bold text-primary">انقر هنا للمشاهدة</a>
                            </p>
                        </div>
                    </div>



                    <!-- 🔹 BV Counter Panel (Left) -->
                    <div class="col-md-4">
                        <div class="card p-3 shadow-sm text-center border rounded-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">📊 عداد BV</h6>

                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="mb-0">أسبوع:</label>
                                <select id="weekSelect" class="form-select form-select-sm w-50">
                                    <option>تحميل...</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="mb-0">سنة:</label>
                                <select id="yearSelect" class="form-select form-select-sm w-50">
                                    <option>تحميل...</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="mb-0">TC:</label>
                                <select class="form-select form-select-sm w-50">
                                    <option>001</option>
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="text-center">
                                        <small class="d-block text-muted">Left BV</small>
                                        <span class="h5" id="leftBV">0</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <small class="d-block text-muted">Right BV</small>
                                        <span class="h5" id="rightBV">0</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="text-center">
                                        <small class="d-block text-muted">Left BV لجنة</small>
                                        <span class="h5" id="leftLegBV">0</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <small class="d-block text-muted">Right BV لجنة</small>
                                        <span class="h5" id="rightLegBV">0</span>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-dark w-100 py-2">إظهار</button>
                        </div>
                    </div>


                </div>


                <!-- 🔹 User Info & Verification -->
                <div class="row mt-3">

                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 text-center">
                            <h5 class="text-warning" style="text-align: left;">حساب Q</h5>
                            <input type="text" id="qcodeInput" class="form-control mb-2"
                                placeholder="أدخل رمز التعريف">
                            <button class="btn btn-warning w-100" onclick="verifyIdentifyId()">التحقق</button>
                            <div id="identifyMessage" class="mt-2"></div> <!-- Placeholder for messages -->
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card shadow-sm p-3">
                            <h5 class="text-warning">أعضاء جدد بشبكتي</h5>
                            <table class="table table-bordered">
                                <thead class="table-warning">
                                    <tr>
                                        <th>رقم العضوية</th>
                                        <th>الاسم</th>
                                        <th>الدولة</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (auth()->check())
                                        @if (Auth::user()->children->count() == 0)
                                            <tr>
                                                <td colspan="3" class="text-center">لا يوجد أعضاء في شبكتك حالياً
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach (Auth::user()->children as $child)
                                            <tr>
                                                <td>{{ $child->id }}</td>
                                                <td>{{ $child->name }}</td>
                                                <td>{{ $child->country->name ?? 'غير محدد' }}</td>
                                            </tr>
                                        @endforeach
                                    @endif



                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <div class="container mt-4">
                    <img src="{{ url('/') . '/storage/logo/footer_image.jpg' }}" alt="Bottom Banner"
                        class="img-fluid w-100 rounded shadow">
                </div>


            </div> <!-- End of Left Section -->
        </div> <!-- End of Row -->
        <div class="row">
            {{-- FOOTER TOOLS  --}}
            <!-- 🔹 Footer Tools Section -->
            <div class="container mt-4">
                <div class="row bg-dark p-3 rounded shadow-sm text-center">

                    <!-- Tool 1 -->
                    <div class="col-md-2 col-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-user-shield fa-2x text-warning"></i>
                            <span class="mt-2 text-white">حماية الحساب</span>
                        </div>
                    </div>

                    <!-- Tool 2 -->
                    <div class="col-md-2 col-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-users fa-2x text-primary"></i>
                            <span class="mt-2 text-white">مركز الدعم الفوري</span>
                        </div>
                    </div>

                    <!-- Tool 3 -->
                    <div class="col-md-2 col-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-file-alt fa-2x text-success"></i>
                            <span class="mt-2 text-white">ملاحظات</span>
                        </div>
                    </div>

                    <!-- Tool 4 -->
                    <div class="col-md-2 col-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-briefcase fa-2x text-danger"></i>
                            <span class="mt-2 text-white">إدارة الأعمال</span>
                        </div>
                    </div>

                    <!-- Tool 5 -->
                    <div class="col-md-2 col-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-globe fa-2x text-info"></i>
                            <span class="mt-2 text-white">تسجيل ويب</span>
                        </div>
                    </div>

                    <!-- Tool 6 -->
                    <div class="col-md-2 col-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-handshake fa-2x text-secondary"></i>
                            <span class="mt-2 text-white">الأمان عبر الإنترنت</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div> <!-- End of Container -->

    <script>
        document.getElementById('nameForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let nameInput = document.getElementById('nameInput');
            let sideSelect = document.getElementById('sideSelect');
            let name = nameInput.value.trim();
            let side = sideSelect.value;

            if (name !== "") {
                let tablesContainer = document.getElementById('tablesContainer');

                // Create a container for the new table
                let tableContainer = document.createElement('div');
                tableContainer.classList.add('table-container');

                // Create a new table
                let newTable = document.createElement('table');
                newTable.innerHTML = `
                    <thead>
                        <tr>
                            <th> </th>
                            <th>الاسم</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                `;

                let tbody = newTable.querySelector('tbody');

                // Add three rows with the same name
                for (let i = 0; i < 3; i++) {
                    let newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>
                            <select>
                                <option value="L" ${side === "L" ? "selected" : ""}>L</option>
                                <option value="R" ${side === "R" ? "selected" : ""}>R</option>
                            </select>
                        </td>
                        <td>${name}</td>
                    `;
                    tbody.appendChild(newRow);
                }

                // Add table to container and then to the main container
                tableContainer.appendChild(newTable);
                tablesContainer.appendChild(tableContainer);

                nameInput.value = ""; // Clear input after submission
            }
        });
    </script>

    <script>
        let slideIndex = 0;
        const slidesContainer = document.querySelector(".slides");
        const slides = document.querySelectorAll(".slide");
        const dots = document.querySelectorAll(".dot");

        function showSlide(index) {
            if (index >= slides.length) {
                slideIndex = 0;
            } else if (index < 0) {
                slideIndex = slides.length - 1;
            } else {
                slideIndex = index;
            }

            // Move the slides
            slidesContainer.style.transform = `translateX(${-slideIndex * 100}%)`;

            // Update active dot
            dots.forEach(dot => dot.classList.remove("active"));
            dots[slideIndex].classList.add("active");
        }

        function moveSlide(step) {
            showSlide(slideIndex + step);
        }

        function currentSlide(index) {
            showSlide(index - 1);
        }

        // Auto Slide
        setInterval(() => moveSlide(1), 3000);

        // Initialize
        showSlide(slideIndex);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const yearSelect = document.getElementById("yearSelect");
            const weekSelect = document.getElementById("weekSelect");
            const leftBVSpan = document.getElementById("leftBV"); // Left BV
            const rightBVSpan = document.getElementById("rightBV"); // Right BV
            const leftLegBVSpan = document.getElementById("leftLegBV"); // Left BV لجنة
            const rightLegBVSpan = document.getElementById("rightLegBV"); // Right BV لجنة
            const userId = "{{ auth()->user()->id }}"; // Get user ID from Laravel blade

            // Populate years (last 5 years)
            const currentYear = new Date().getFullYear();
            for (let i = 0; i < 5; i++) {
                let yearOption = document.createElement("option");
                yearOption.value = currentYear - i;
                yearOption.textContent = currentYear - i;
                yearSelect.appendChild(yearOption);
            }

            // Fetch weeks when the year is selected
            yearSelect.addEventListener("change", function() {
                let selectedYear = yearSelect.value;
                fetchWeeks(selectedYear);
            });

            // Fetch BV when the week is changed
            weekSelect.addEventListener("change", function() {
                let selectedYear = yearSelect.value;
                let selectedWeek = weekSelect.value;
                fetchBV(selectedYear, selectedWeek);
            });

            // Fetch weeks from API
            function fetchWeeks(year) {
                fetch(`/api/getWeeksList/${year}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        weekSelect.innerHTML = ""; // Clear existing options
                        if (data.length === 0) {
                            let option = document.createElement("option");
                            option.textContent = "لا توجد أسابيع متاحة";
                            weekSelect.appendChild(option);
                            return;
                        }

                        data.forEach(week => {
                            let option = document.createElement("option");
                            option.value = week.week_number;
                            option.textContent = `الأسبوع ${week.week_number}`;
                            weekSelect.appendChild(option);
                        });

                        // Auto-select the first week and fetch BV
                        if (data.length > 0) {
                            weekSelect.value = data[0].week_number;
                            fetchBV(year, data[0].week_number);
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching weeks:", error);
                        alert("⚠️ فشل تحميل الأسابيع. يرجى التحقق من الاتصال بالخادم.");
                    });
            }

            // Fetch BV from API
            function fetchBV(year, week) {
                fetch(`/api/bvHistory/${year}/${week}/${userId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success && data.data[year] && data.data[year][week]) {
                            let bvInfo = data.data[year][week][""][0]; // Accessing first item in array

                            // Update Left BV and Right BV
                            leftBVSpan.textContent = bvInfo.left_bv ?? "0";
                            rightBVSpan.textContent = bvInfo.right_bv ?? "0";

                            // Update Left BV لجنة and Right BV لجنة
                            leftLegBVSpan.textContent = bvInfo.left_bv ??
                                "0"; // Assuming it's the same as left_bv
                            rightLegBVSpan.textContent = bvInfo.right_bv ??
                                "0"; // Assuming it's the same as right_bv
                        } else {
                            leftBVSpan.textContent = "0";
                            rightBVSpan.textContent = "0";
                            leftLegBVSpan.textContent = "0";
                            rightLegBVSpan.textContent = "0";
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching BV:", error);
                        leftBVSpan.textContent = "0";
                        rightBVSpan.textContent = "0";
                        leftLegBVSpan.textContent = "0";
                        rightLegBVSpan.textContent = "0";
                        alert("⚠️ فشل تحميل بيانات BV. يرجى المحاولة لاحقًا.");
                    });
            }

            // Load weeks for the current year on page load
            fetchWeeks(currentYear);
        });
    </script>

    <script>
        function verifyIdentifyId() {
            const qcodeInput = document.getElementById("qcodeInput").value.trim();
            const identifyMessage = document.getElementById("identifyMessage");

            // Clear previous messages
            identifyMessage.innerHTML = "";

            if (!qcodeInput) {
                identifyMessage.innerHTML = `<span class="text-danger">⚠️ يرجى إدخال رمز التعريف.</span>`;
                return;
            }
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            // Send POST request to the backend API
            fetch("/verifyIdentifyId", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        // "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                        "X-CSRF-TOKEN": csrfToken // Include the CSRF token

                    },
                    body: JSON.stringify({
                        code_q: qcodeInput
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        identifyMessage.innerHTML = `<span class="text-success">✅ رمز التعريف صحيح!</span>`;
                    } else {
                        identifyMessage.innerHTML =
                            `<span class="text-danger">❌ رمز التعريف غير صحيح. يرجى المحاولة مرة أخرى.</span>`;
                    }
                })
                .catch(error => {
                    console.error("Error verifying identify ID:", error);
                    identifyMessage.innerHTML =
                        `<span class="text-danger">⚠️ حدث خطأ أثناء التحقق. حاول لاحقًا.</span>`;
                });
        }
    </script>
    <script>
        // دالة لحساب المجموع لكل صف والمجموع الكلي
        function calculateSubtotals() {
            let total = 0;
            // استرجاع جميع حقول الكمية
            document.querySelectorAll('.quantity-input').forEach(input => {
                let dollarValue = parseFloat(input.getAttribute('data-dollar'));
                let quantity = parseFloat(input.value) || 0;
                let subtotal = dollarValue * quantity;
                // تحديث خلية الإجمالي الفرعي في نفس الصف
                let row = input.closest('tr');
                row.querySelector('.subtotal').textContent = subtotal.toFixed(2);
                total += subtotal;
            });
            // تحديث إجمالي المبلغ في تذييل الجدول
            document.getElementById('totalSubTotal').innerHTML = `<strong>(USD) ${total.toFixed(2)}</strong>`;
            // يمكن حساب الرسوم أو الرصيد النهائي هنا إذا كانت القواعد محددة
            // كمثال:
            document.getElementById('fees').textContent = `(USD) ${ (total * 0.05).toFixed(2) }`; // مثلاً 5% رسوم
            document.getElementById('finalBalance').textContent = (total - (total * 0.05)).toFixed(2);
        }

        // الاستماع لتغيرات حقول الإدخال
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('input', calculateSubtotals);
        });

        // حساب أولي عند تحميل الصفحة
        calculateSubtotals();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById("submitWithdrawal").addEventListener("click", function() {
                function calculateSubtotals() {
                    let total = 0;

                    // استرجاع جميع حقول الكمية وحساب المجموع
                    document.querySelectorAll('.quantity-input').forEach(input => {
                        let dollarValue = parseFloat(input.getAttribute('data-dollar'));
                        let quantity = parseFloat(input.value) || 0;
                        let subtotal = dollarValue * quantity;

                        // تحديث خلية الإجمالي الفرعي في نفس الصف
                        let row = input.closest('tr');
                        row.querySelector('.subtotal').textContent = subtotal.toFixed(2);

                        total += subtotal;
                    });

                    // تحديث الإجمالي الفرعي
                    document.getElementById('totalSubTotal').innerHTML =
                        `<strong>(USD) ${total.toFixed(2)}</strong>`;

                    // حساب الرسوم والرصيد النهائي (اختياري)
                    let fees = total * 0.05; // نفترض أن الرسوم 5%
                    let finalBalance = total - fees;

                    document.getElementById('fees').textContent = `(USD) ${fees.toFixed(2)}`;
                    document.getElementById('finalBalance').textContent = finalBalance.toFixed(2);

                    // إرجاع المجموع لاستخدامه في زر السحب
                    return total;
                }

                // تنفيذ الحساب عند تغيير المدخلات
                document.querySelectorAll('.quantity-input').forEach(input => {
                    input.addEventListener('input', calculateSubtotals);
                });

                // حساب المجموع عند تحميل الصفحة
                calculateSubtotals();

                let totalAmount = calculateSubtotals(); // استرجاع المجموع المحسوب
                alert('dd' + totalAmount)
                if (totalAmount <= 0) {
                    alert("يجب إدخال كمية صالحة لإنشاء طلب السحب.");
                    return;
                }

                let requestData = {
                    amount: totalAmount, // إرسال المبلغ الكلي فقط
                    notes: document.getElementById("withdrawalNotes").value
                };

                fetch("/withdrawal", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                        body: JSON.stringify(requestData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("✅ تم تقديم طلب السحب بنجاح! المبلغ الإجمالي: " + data
                                .amount);
                            location.reload();
                        } else {
                            alert("❌ خطأ: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("❌ خطأ:", error);
                        alert("⚠️ حدث خطأ أثناء معالجة الطلب.");
                    });
            });
        });
    </script>

</body>

</html>
