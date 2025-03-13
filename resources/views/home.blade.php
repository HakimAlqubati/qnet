<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1000">

    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
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
        /**start style with force desktop */

        .container,
        .container-fluid {
            max-width: 1000px !important;
            /* Fixed width */
            /* width: 1000px !important; */
        }

        .d-flex {
            flex-wrap: nowrap !important;
        }

        .col-lg-3 {
            width: 25% !important;
            /* Sidebar */
        }

        .col-lg-9 {
            width: 75% !important;
            /* Main Content */
        }


        /* Prevent Bootstrap grid from stacking on smaller screens */
        .row {
            display: flex;
            flex-wrap: nowrap;
        }

        html,
        body {
            overflow-x: hidden;
        }

        .img-fluid {
            width: auto;
            max-width: 100%;
            height: auto;
            display: block;
            margin: auto;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
            object-fit: contain;
            /* or "cover" to crop instead of stretching */
        }

        .banner-container {
            display: flex;
            justify-content: center;
            align-items: center;
            /* max-width: 800px; */
            /* Adjust to proper size */
        }


        .custom-banner {
            width: auto;
            max-width: 100%;
            height: auto;
        }


        /**end style with force desktop */

        /** start new tools */
        /* Footer Tools Grid Layout */
        .footer-tools {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* 4 columns per row */
            gap: 15px;
            text-align: center;
            background-color: #222;
            padding: 20px;
            border-radius: 8px;
        }

        /* Ensure two rows by wrapping items correctly */
        .footer-tools .tool {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            padding: 15px;
            background-color: #333;
            border-radius: 8px;
            transition: 0.3s;
        }

        .footer-tools .tool i {
            font-size: 30px;
            margin-bottom: 10px;
            color: #ffa033;
        }

        .footer-tools .tool:hover {
            background-color: #ff8800;
            transform: scale(1.05);
        }

        /* Adjust for smaller screens */
        @media (max-width: 768px) {
            .footer-tools {
                grid-template-columns: repeat(2, 1fr);
                /* 2 columns per row for smaller screens */
            }
        }

        /** end new tools */
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
                    <option value="{{ route('changeLang', 'ar') }}" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>
                        🇸🇦 العربية</option>
                    <option value="{{ route('changeLang', 'en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>
                        🇺🇸 English</option>
                </select>

            </div>




            <!-- Middle Section: User Info -->
            <div class="user-info text-left">
                <p class="mb-0">
                    {{-- {{ __('messages.welcome') }} --}}
                    {{-- {{ 'مرحباً ' }} --}}
                    <p>{{ __('messages.welcome') }}</p>

                    <strong>
                        {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                    </strong></p>
                <p class="last-login">{{ __('messages.last_login') }}: 04 JAN 2024 - 23:56 (HKST)</p>
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

            <div class="row">


                <!-- Announcement Section -->
                <div class="announcement col-lg-3">
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
                {{-- <div class="slider">
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
            </div> --}}

                <div class="slider col-lg-9">
                    <img src="{{ url('/') . '/storage/logo/new-swapper.png' }}"
                        style="height: 100%; border-radius: 30px;" alt="">
                </div>
            </div>


        </div>


    </div>


    <div class="container my-3">
        <!-- 🔹 Tabs Navigation -->
        <ul class="nav nav-tabs justify-content-center" id="settlementTabs">
            <li class="nav-item">

                <a class="nav-link active" data-bs-toggle="tab" href="#shipment_trachking">
                    <span class="icon">💬</span>
                    <span>
                        تتبع الشحنة
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
                <a class="nav-link" data-bs-toggle="tab" href="#settlement">
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
            {{-- <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#settlement">
                    <span class="icon">💬</span>
                    <span> دليل التسوية</span>
                </a>
            </li> --}}
        </ul>

        <!-- 🔹 Tabs Content -->
        <div class="tab-content">

            <div id="shipment_trachking" class="tab-pane fade show"
                style="background: white; padding: 20px; text-align: left;">

                <!-- 🔹 Title Section with Two Lines -->
                <div class="text-center mb-3">
                    <h4 class="fw-bold text-warning">🛒 تتبع شحناتك</h4>
                    <p class="text-muted">اختر شركة الشحن لمعرفة حالة الطلب</p>
                </div>

                <!-- 🔹 Shipping Companies List -->
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">🚛 أرامكس</li>
                            <li class="list-group-item">✈️ فيديكس</li>
                            <li class="list-group-item">📦 دي إتش إل</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">🏢 البريد السعودي</li>
                            <li class="list-group-item">🚚 زاجل</li>
                            <li class="list-group-item">🚀 سمسا</li>
                        </ul>
                    </div>
                </div>

            </div>


            <div id="history" class="tab-pane fade">

                <div class="based_on_history_body">

                    @if (auth()->check())

                        @foreach (Auth::user()->children as $child)
                            <table style="margin-top: 20px;">
                                <thead>
                                    <tr>
                                        <th> </th>
                                        <th>الاسم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 1; $i <= 3; $i++)
                                        <tr>
                                            <td>
                                                <select>
                                                    <option value="L">L</option>
                                                    <option value="R">R</option>
                                                </select>
                                            </td>
                                            <td>{{ $child->name }}</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        @endforeach
                    @endif





                </div>

            </div>

            <div id="account" class="tab-pane fade">

            </div>

            <div id="ecard" class="tab-pane fade">
                <div class="based_on_history_body">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <span style="color: whitesmoke;">
                                            رقم البطاقة الإلكترونية
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= 9; $i++)
                                    <tr>
                                        <td>{{ $i }} <input style="width: 95%" type="text" /></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>

                    <!-- ✅ Submit Button without any operation -->
                    <button type="button" class="btn btn-warning mt-3" style="background: orange">إرسال</button>
                </div>
            </div>

            <div id="network" class="tab-pane fade">

            </div>

            <!-- ✅ ملخص التسوية مطابق للصورة -->
            <!-- ✅ دليل التسوية (Settlement Guide) -->
            <!-- Modal for confirmation -->
            <!-- Modal for confirmation -->
            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">تأكيد السحب</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="إغلاق"></button>
                        </div>
                        <div class="modal-body">
                            <p>يرجى إدخال رمز التعريف الخاص بك لتأكيد السحب.</p>
                            <input type="text" id="confirmationInput" class="form-control"
                                placeholder="أدخل رمز التعريف">
                            <small id="errorMessage" class="text-danger d-none">⚠️ رمز التعريف غير صحيح!</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="button" class="btn btn-warning" id="confirmWithdrawal">تأكيد</button>
                        </div>
                    </div>
                </div>
            </div>


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
                    <div class="settlement-footer mb-2">رصيد حساب Q الحالي:
                        <span>{{ auth()->user()->current_balance ?? '0.00' }}</span> (USD)
                    </div>
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
                                                <td>{{ $child->identify_id }}</td>
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
                <div class="container container-fluid mt-4">
                    <img src="{{ url('/') . '/storage/logo/footer_image.jpg' }}" alt="Bottom Banner"
                        class="img-fluid">
                </div>


            </div> <!-- End of Left Section -->
        </div> <!-- End of Row -->
        <div class="row">
            {{-- FOOTER TOOLS  --}}
            <!-- 🔹 Footer Tools Section -->
            <!-- 🔹 Footer Tools Section with Two Rows -->
            <div class="container mt-4">
                <div class="footer-tools">
                    <!-- First Row -->
                    <div class="tool">
                        <i class="fas fa-user-shield"></i>
                        <span>حماية الحساب</span>
                    </div>
                    <div class="tool">
                        <i class="fas fa-users"></i>
                        <span>مركز الدعم الفوري</span>
                    </div>
                    <div class="tool">
                        <i class="fas fa-file-alt"></i>
                        <span>ملاحظات</span>
                    </div>
                    <div class="tool">
                        <i class="fas fa-briefcase"></i>
                        <span>إدارة الأعمال</span>
                    </div>

                    <!-- Second Row -->
                    <div class="tool">
                        <i class="fas fa-globe"></i>
                        <span>تسجيل ويب</span>
                    </div>
                    <div class="tool">
                        <i class="fas fa-handshake"></i>
                        <span>الأمان عبر الإنترنت</span>
                    </div>
                    <div class="tool">
                        <a href="{{ url('/categories') }}" class="tool">
                            <i class="fas fa-shopping-cart"></i>
                            <span>تسوق الآن</span>
                        </a>
                    </div>
                    
                </div>
            </div>


        </div>
    </div> <!-- End of Container -->



    {{-- <script>
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
            // slidesContainer.style.transform = `translateX(${-slideIndex * 100}%)`;

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
        showSlide(0);
    </script> --}}

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
            // document.getElementById('fees').textContent = `(USD) ${ (total * 0.05).toFixed(2) }`; // مثلاً 5% رسوم
            document.getElementById('finalBalance').textContent = (total).toFixed(2);
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
            const submitWithdrawalButton = document.getElementById("submitWithdrawal");
            const confirmButton = document.getElementById("confirmWithdrawal");
            const confirmationInput = document.getElementById("confirmationInput");
            const errorMessage = document.getElementById("errorMessage");

            let totalAmount = 0;
            const userCodeQ = "{{ auth()->user()->code_q }}"; // Get `code_q` from Laravel

            function calculateSubtotals() {
                totalAmount = 0;

                document.querySelectorAll('.quantity-input').forEach(input => {
                    let dollarValue = parseFloat(input.getAttribute('data-dollar'));
                    let quantity = parseFloat(input.value) || 0;
                    totalAmount += dollarValue * quantity;
                });

                document.getElementById('totalSubTotal').innerHTML =
                    `<strong>(USD) ${totalAmount.toFixed(2)}</strong>`;
                let fees = totalAmount * 0.05;
                document.getElementById('fees').textContent = `(USD) ${fees.toFixed(2)}`;
                document.getElementById('finalBalance').textContent = (totalAmount - fees).toFixed(2);
            }

            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('input', calculateSubtotals);
            });

            calculateSubtotals();

            // Open confirmation modal
            submitWithdrawalButton.addEventListener("click", function() {
                if (totalAmount <= 0) {
                    alert("⚠️ يجب إدخال كمية صالحة لإنشاء طلب السحب.");
                    return;
                }

                confirmationInput.value = "";
                errorMessage.classList.add("d-none");
                let modal = new bootstrap.Modal(document.getElementById("confirmationModal"));
                modal.show();
            });

            // Confirm withdrawal after checking `code_q`
            confirmButton.addEventListener("click", function() {
                if (confirmationInput.value.trim() !== userCodeQ) {
                    errorMessage.classList.remove("d-none");
                    return;
                }

                let requestData = {
                    amount: totalAmount,
                    notes: document.getElementById("withdrawalNotes").value
                };

                fetch("{{ route('withdrawal.store') }}", { // Use Laravel route
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        },
                        body: JSON.stringify(requestData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(`✅ تم تقديم طلب السحب بنجاح! المبلغ الإجمالي: ${data.amount}`);
                            location.reload();
                        } else {
                            alert(`❌ خطأ: ${data.message}`);
                        }
                    })
                    .catch(error => {
                        console.error("❌ خطأ:", error);
                        alert("⚠️ حدث خطأ أثناء معالجة الطلب.");
                    });

                let modal = bootstrap.Modal.getInstance(document.getElementById("confirmationModal"));
                modal.hide();
            });
        });
    </script>

</body>

</html>
