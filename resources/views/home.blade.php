<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QNET Dashboard - Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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
        }

        .user-info .last-login {
            font-size: 12px;
            color: #777;
        }

        .user-status td {
            font-size: 13px;
            padding: 2px 5px;
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
    </style>
</head>

<body>

    <!-- 🔹 Header Section -->
    <header class="container-fluid py-2 header-container">
        <div class="container d-flex justify-content-between align-items-center">


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



            <!-- Middle Section: User Info -->
            <div class="user-info text-right">
                <p class="mb-0">
                    {{ __('messages.welcome') }}
                    بك مجدداً! <strong>إكرم كريم حسين الطائي</strong></p>
                <p class="last-login">آخر تسجيل للدخول: 04 JAN 2024 - 23:56 (HKST)</p>
                <table class="table table-borderless user-status table-bordered">



                    <tr>
                        <td class="text-start">تصنيفك الحالي:</td>
                        <td class="text-end"><span class="status-text">Silver Star</span></td>
                    </tr>
                    <tr>
                        <td class="text-start">درجتك الحالي:</td>
                        <td class="text-end"><span class="status-text">Silver Star</span></td>
                    </tr>

                </table>
            </div>
            <!-- Left Section: Language Selector & Logout Button -->
            <div class="d-flex align-items-center">
                <a href="{{ route('changeLang', 'ar') }}" class="btn btn-orange me-2">🇸🇦 العربية</a>
                <a href="{{ route('changeLang', 'en') }}" class="btn btn-orange me-2">🇺🇸 English</a>
                <button class="btn btn-orange">{{ __('messages.logout') }}</button>
            </div>
        </div>
    </header>

    <!-- 🔹 Navigation Bar -->
    <nav class="top-nav text-center">
        <a href="#">مركز الإشعارات</a>
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
            <div class="banner">
                <img src="{{ url('/') . '/storage/logo/new-swapper.png' }}" alt="Jewelry Banner">
                <!-- Pagination -->
                <div class="pagination-container">
                    <span class="active">1</span>
                    <span>2</span>
                    <span>3</span>
                    <span>4</span>
                    <span>5</span>
                    <span>6</span>
                    <span>7</span>
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
                        ملخص البطاقة الإلكترونية
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
                    <span> ملخص التسوية</span>
                </a>
            </li>
        </ul>

        <!-- 🔹 Tabs Content -->
        <div class="tab-content">
            <div id="orders" class="tab-pane fade show active">

            </div>

            <div id="history" class="tab-pane fade">

            </div>

            <div id="account" class="tab-pane fade">

            </div>

            <div id="ecard" class="tab-pane fade">

            </div>

            <div id="network" class="tab-pane fade">

            </div>

            <!-- ✅ ملخص التسوية مطابق للصورة -->
            <div id="settlement" class="tab-pane fade">
                <div class="settlement-summary">
                    <div class="header">ملخص التسوية</div>
                    <table class="table settlement-table">
                        <thead>
                            <tr>
                                <th>نوع البطاقة</th>
                                <th>القيمة</th>
                                <th>الكمية</th>
                                <th>الإجمالي الفرعي (USD)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>eCard (USD)</td>
                                <td>1.00</td>
                                <td>x 0</td>
                                <td>0.00</td>
                            </tr>
                            <tr>
                                <td>eCard (USD)</td>
                                <td>5.00</td>
                                <td>x 0</td>
                                <td>0.00</td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"><strong>الإجمالي الفرعي (دولار أمريكي)</strong></td>
                                <td><strong>(USD) 670.00</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3">الرسوم (دولار أمريكي)</td>
                                <td>(USD) 20.10</td>
                            </tr>

                        </tfoot>
                    </table>
                    <div class="settlement-footer">رصيد حساب Q النهائي بعد التسوية: 29.40 (USD)</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔹 Main Dashboard Container -->
    <div class="container">
        <div class="row">
            <!-- Right Sidebar -->
            <div class="col-lg-3">
                <div class="card shadow-sm mb-3">
                    <img src="{{ url('/') . '/storage/logo/rsp_calc.png' }}" class="card-img-top"
                        alt="RSP Calculator">
                </div>
                <div class="card shadow-sm mb-3">
                    <img src="https://plus.unsplash.com/premium_photo-1683865776032-07bf70b0add1?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="card-img-top" alt="Fast Start">
                </div>
                <div class="card shadow-sm mb-3">
                    <img src="https://plus.unsplash.com/premium_photo-1683865776032-07bf70b0add1?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="card-img-top" alt="Weblearn">
                </div>
                <div class="card shadow-sm mb-3">
                    <img src="https://plus.unsplash.com/premium_photo-1683865776032-07bf70b0add1?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="card-img-top" alt="Shop Now">
                </div>
            </div>

            <!-- Left Section -->
            <div class="col-lg-9">
                <!-- 🔹 Panels Section -->
                <div class="row">

                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 h-100 d-flex flex-column">
                            <h5 class="text-center text-warning">العمولات</h5>
                            <select class="form-select mb-2">
                                <option>52</option>
                                <option>51</option>
                            </select>
                            <select class="form-select mb-2">
                                <option>2023</option>
                                <option>2022</option>
                            </select>
                            <button class="btn btn-warning w-100 mt-auto">إظهار</button>

                            <p class="paragraph_in_panel">
                                قد يتم تحصيل بعض المعاملات بناءً على أســاس جداول سياسة التمويل المحلية، تحقق من
                                <a href="#">سجل</a>
                                لمعرفة تفاصيل المعاملات، وأيضاً الاطلاع على تلك المعاملات
                                <a href="#">BV صـرفـة نقـاط</a>
                            </p>
                        </div>
                    </div>





                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 h-100 d-flex flex-column">
                            <h5 class="text-warning text-center">Your Current RSP</h5>
                            <p class="flex-grow-1 text-center"><a href="#">انقر هنا للمشاهدة</a></p>
                        </div>
                    </div>




                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 h-100 d-flex flex-column">
                            <h5 class="text-center text-warning mb-2">عداد BV</h5>
                            <div class="d-flex align-items-center mb-2">
                                <label class="me-2">أسبوع</label>
                                <select class="form-select form-select-sm w-50">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <label class="me-2">سنة</label>
                                <select class="form-select form-select-sm w-50">
                                    <option>2024</option>
                                    <option>2023</option>
                                </select>
                            </div>
                            <button class="btn btn-dark w-75 mt-auto">إظهار</button>
                        </div>
                    </div>
                </div>


                <!-- 🔹 User Info & Verification -->
                <div class="row mt-3">

                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 text-center">
                            <h5 class="text-warning">رمز رقم التعريف الشخصي</h5>
                            <input type="text" class="form-control mb-2" placeholder="أدخل رمز التعريف">
                            <button class="btn btn-warning w-100">التحقق</button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow-sm p-3">
                            <h5 class="text-warning">أعضاء جدد بشبكتي</h5>
                            <table class="table table-bordered">
                                <thead class="table-warning">
                                    <tr>
                                        <th>رقم العضوية</th>
                                        <th>الدولة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>HN747647</td>
                                        <td>Kurdistan - region of Iraq</td>
                                    </tr>
                                    <tr>
                                        <td>HN739813</td>
                                        <td>Kurdistan - region of Iraq</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>

            </div> <!-- End of Left Section -->
        </div> <!-- End of Row -->
    </div> <!-- End of Container -->

</body>

</html>
