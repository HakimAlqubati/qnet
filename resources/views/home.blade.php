@extends('layouts.app')

@section('title', 'Home')

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        width: 90%;
        margin: auto;
        max-width: 1200px;
    }

    .top-bar {
        background-color: #ff6600;
        padding: 10px;
        color: white;
        font-size: 24px;
        font-weight: bold;
        text-align: center;
    }

    nav {
        background-color: #ff6600;
        padding: 10px 0;
        text-align: center;
    }

    nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
    }

    nav ul li {
        margin: 0 15px;
    }

    nav ul li a {
        color: white;
        text-decoration: none;
        font-size: 18px;
    }

    .main-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin: 20px auto;
    }

    .banner {
        background: white;
        padding: 20px;
        flex: 3;
        border-radius: 5px;
    }

    .banner img {
        max-width: 100%;
    }

    .cta-button {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 20px;
        background: #ff6600;
        color: white;
        text-decoration: none;
        font-size: 18px;
    }

    .pagination {
        margin-top: 10px;
        text-align: right;
    }

    .pagination span {
        display: inline-block;
        padding: 5px 10px;
        margin: 2px;
        background: #333;
        color: white;
        cursor: pointer;
        border-radius: 3px;
    }

    .pagination .active {
        background: #ff6600;
    }

    .news-section {
        flex: 1;
        background: white;
        padding: 15px;
        border-radius: 5px;
        margin-left: 20px;
    }

    .internal-section {
        padding: 0;
    }

    .news-box {
        background: #ffcc00;
        padding: 15px;
        border-radius: 5px;
        text-align: center;
    }

    .news-box h3 {
        margin: 0;
    }

    .more-news {
        margin-top: 10px;
        padding: 10px;
        background: #ff6600;
        color: white;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    footer {
        background: #333;
        color: white;
        text-align: center;
        padding: 10px;
        margin-top: 20px;
    }

    .footer-links a {
        color: white;
        text-decoration: none;
        margin: 0 10px;
    }

    .transactions-box {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        /* width: 300px; */
        width: 100%;
        padding: 15px;
        text-align: right;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        margin: auto;
    }

    .transactions-box h3 {
        font-size: 16px;
        margin: 0 0 10px;
        display: flex;
        align-items: center;
    }

    .transactions-box h3 img {
        margin-left: 5px;
        width: 20px;
    }

    .transactions-box select,
    .transactions-box button {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    .transactions-box button {
        background-color: #333;
        color: white;
        cursor: pointer;
    }

    .transactions-box p {
        background: #fff8e5;
        border: 1px solid #ffcc00;
        padding: 10px;
        font-size: 12px;
        color: #333;
        border-radius: 5px;
    }

    .transactions-box p a {
        color: blue;
        text-decoration: none;
        font-weight: bold;
    }
</style>
@section('content')

    <div>
        <div class="container">
            <header>
                <div class="top-bar">QNET</div>
                <nav>
                    <ul>
                        <li><a href="#">صفحة رئيسية</a></li>
                        <li><a href="#">إعلانات</a></li>
                        <li><a href="#">أدوات العمل</a></li>
                        <li><a href="#">تسوق</a></li>
                        <li><a href="#">LBP Shop</a></li>
                    </ul>
                </nav>
            </header>

            <section class="main-section">


                <section class="news-section">
                    <div class="news-box">
                        <h3>إعلان هام</h3>
                        <p>Sapphire Star Getaway Promo...</p>
                        <a href="#">Click here</a>
                    </div>
                    <button class="more-news">عرض المزيد من الأخبار</button>
                </section>

                <div class="banner">
                    <img src="banner-image.png" alt="Service Banner">
                    <h2>جرب بوابة الخدمة الذاتية اليوم!</h2>
                    <p>تحديث التفاصيل الخاصة بك في أقل من دقيقة</p>
                    <div class="pagination">
                        <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span>
                    </div>
                </div>
            </section>
            <section class="main-section">


                <section class="news-section internal-section">

                    <img src="rsp_calc.png" alt="">
                </section>
                <section class="news-section internal-section">
                    <div class="transactions-box">
                        <h3><img src="rsp_calc.png" alt="coins"> المعاملات</h3>
                        <label>أسبوع:</label>
                        <select>
                            <option>52</option>
                        </select>
                        <label>السنة:</label>
                        <select>
                            <option>2023</option>
                        </select>
                        <button>إظهار</button>
                        <p>
                            قد يتم تحصيل بعض المعاملات بناءً على أســاس جداول سياسة التمويل المحلية، تحقق من
                            <a href="#">سجل</a>
                            لمعرفة تفاصيل المعاملات، وأيضاً الاطلاع على تلك المعاملات
                            <a href="#">BV صـرفـة نقـاط</a>
                        </p>
                    </div>
                </section>

                <section class="news-section internal-section">
                    <div class="transactions-box">
                        <h3><img src="rsp_calc.png" alt="coins"> Your Currnet RSP</h3>
                        <p>انقر هنا للمشاهدة</p>
                    </div>
                </section>

                <section class="news-section internal-section">
                    <div class="transactions-box">
                        <h3><img src="rsp_calc.png" alt="coins">عداد BV</h3>
                        <label>أسبوع:</label>
                        <select>
                            <option>52</option>
                        </select>
                        <label>السنة:</label>
                        <select>
                            <option>2023</option>
                        </select>

                    </div>
                </section>

            </section>
            <section class="main-section">


                <section class="news-section internal-section">

                    <img src="rsp_calc.png" alt="">
                </section>
                <section class="news-section internal-section">
                    <div class="transactions-box">
                        <h3><img src="rsp_calc.png" alt="coins"> المعاملات</h3>
                        <label>أسبوع:</label>
                        <select>
                            <option>52</option>
                        </select>
                        <label>السنة:</label>
                        <select>
                            <option>2023</option>
                        </select>
                        <button>إظهار</button>
                        <p>
                            قد يتم تحصيل بعض المعاملات بناءً على أســاس جداول سياسة التمويل المحلية، تحقق من
                            <a href="#">سجل</a>
                            لمعرفة تفاصيل المعاملات، وأيضاً الاطلاع على تلك المعاملات
                            <a href="#">BV صـرفـة نقـاط</a>
                        </p>
                    </div>
                </section>

                <section class="news-section internal-section">
                    <div class="transactions-box">
                        <h3><img src="rsp_calc.png" alt="coins"> Your Currnet RSP</h3>
                        <p>انقر هنا للمشاهدة</p>
                    </div>
                </section>


            </section>

            <footer>
                <div class="footer-links">
                    <a href="#">حسابي</a>
                    <a href="#">حساب القرض</a>
                    <a href="#">فحص الرصيد</a>
                </div>
            </footer>
        </div>
    </div>
@endsection
