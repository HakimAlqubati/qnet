@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <div class="font-sans">

        <!-- Header Section -->
        <header class="bg-orange-500 text-white p-4 flex justify-between items-center">

            <!-- User Info Section -->
            <div class="text-sm text-right space-y-1">
                <div>الاسم: <span class="font-semibold">محمد علي</span></div>
                <div>ID: <span class="font-semibold">12345</span></div>
                <div>رتبة الراتب: <span class="font-semibold">فضية</span></div>
                <div>رتبة الفريق: <span class="font-semibold">ذهبية</span></div>
            </div>

            <!-- Social and Logout Icons -->
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22 12c0-5.522-4.477-10-10-10s-10 4.478-10 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54v-2.891h2.54v-2.215c0-2.506 1.492-3.891 3.777-3.891 1.094 0 2.238.194 2.238.194v2.466h-1.26c-1.244 0-1.631.772-1.631 1.563v1.883h2.773l-.443 2.891h-2.33v6.987c4.781-.75 8.438-4.887 8.438-9.878z" />
                    </svg>
                </a>
                <a href="#" class="hover:text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22.23 5.924c-.805.357-1.67.598-2.577.706a4.503 4.503 0 0 0 1.984-2.487 8.952 8.952 0 0 1-2.858 1.093 4.487 4.487 0 0 0-7.642 3.066c0 .352.041.694.116 1.02-3.726-.187-7.03-1.973-9.241-4.685a4.505 4.505 0 0 0-.608 2.257c0 1.556.793 2.929 2.007 3.731a4.487 4.487 0 0 1-2.033-.563v.056c0 2.172 1.542 3.978 3.59 4.388a4.501 4.501 0 0 1-2.024.076 4.5 4.5 0 0 0 4.207 3.13 8.988 8.988 0 0 1-5.578 1.923c-.361 0-.719-.021-1.071-.062a12.658 12.658 0 0 0 6.854 2.009c8.229 0 12.731-6.823 12.731-12.732 0-.194-.004-.387-.013-.578a9.072 9.072 0 0 0 2.223-2.309z" />
                    </svg>
                </a>
                <a href="#" class="hover:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M23.954 4.569c-.885.394-1.833.656-2.828.775a4.93 4.93 0 0 0 2.165-2.724 9.863 9.863 0 0 1-3.127 1.196 4.915 4.915 0 0 0-8.384 4.482 13.965 13.965 0 0 1-10.141-5.144 4.821 4.821 0 0 0-.665 2.475 4.928 4.928 0 0 0 2.188 4.105 4.901 4.901 0 0 1-2.224-.616v.061a4.927 4.927 0 0 0 3.946 4.827 4.897 4.897 0 0 1-2.212.084 4.928 4.928 0 0 0 4.6 3.418 9.868 9.868 0 0 1-6.102 2.104c-.397 0-.786-.023-1.17-.069a13.936 13.936 0 0 0 7.548 2.212c9.057 0 14.001-7.506 14.001-14.001 0-.213-.005-.425-.014-.636a10.012 10.012 0 0 0 2.457-2.548z" />
                    </svg>
                </a>
                <button class="text-sm text-white bg-red-600 hover:bg-red-700 px-2 py-1 rounded">تسجيل الخروج</button>
            </div>
        </header>

        <!-- Navigation Section -->
        <nav style="direction: rtl" class="bg-gray-100 p-4">
            <div class="flex justify-center space-x-8 text-sm font-medium">
                <a href="#" class="hover:text-orange-500">لوحة التحكم</a>
                <a href="#" class="hover:text-orange-500">الإعلانات</a>
                <a href="#" class="hover:text-orange-500">التقارير</a>
                <a href="#" class="hover:text-orange-500">النقاط</a>
                <a href="#" class="hover:text-orange-500">أدوات الأعمال</a>
            </div>
        </nav>

        <section style="direction: rtl" class="grid grid-cols-3 gap-4 p-6">
            <!-- Announcements Section -->
            <div class="col-span-2 bg-white p-4 shadow-md rounded-md">
                <h3 class="text-xl font-bold border-b pb-2 mb-4">إعلانات</h3>
                <p class="text-gray-700">آخر الإعلانات المضافة هنا. يمكن عرض التفاصيل المتعلقة بالأخبار المهمة والفعاليات.
                </p>
            </div>

            <!-- Important News Section -->
            <div class="bg-white p-4 shadow-md rounded-md">
                <h3 class="text-xl font-bold border-b pb-2 mb-4">إعلان هام</h3>
                <p class="text-gray-700 mb-4">تفاصيل الإعلان الهام يمكن أن تضاف هنا.</p>
                <a href="#" class="text-blue-600 hover:underline">المزيد من الأخبار</a>
            </div>
        </section>
        <nav style="direction: rtl" class="bg-gray-100 p-4 rounded-md shadow-md mx-auto">
            <ul class="flex space-x-4 text-gray-700 font-medium">
                <li><a href="#" class="hover:text-blue-600">تتبع الشحنة</a></li>
                <li><a href="#" class="hover:text-blue-600">الطلب والدفع</a></li>
                <li><a href="#" class="hover:text-blue-600">
                        مدقق البطاقات الإلكترونية
                    </a></li>
                <li><a href="#" class="hover:text-blue-600">حسابي</a></li>
                <li><a href="#" class="hover:text-blue-600">GR - حسب التاريخ</a></li>
                <li><a href="#" class="hover:text-blue-600">GR - مرئي</a></li>
            </ul>
        </nav>
        <!-- Main Content Section -->
        <main style="direction: rtl" class="max-w-7xl mx-auto mt-6 p-4 grid grid-cols-1 lg:grid-cols-4 gap-6">




            <!-- Column 4: RSP Section -->
            <div class="col-span-1 bg-white p-4 rounded-md shadow">
                <h3 class="text-lg font-semibold">RSP Calculator</h3>
                .........
            </div>

            <!-- Column 3: Weekly Summary -->
            <div class="col-span-1 bg-white p-4 rounded-md shadow">
                <h3 class="text-lg font-semibold">اللجان
                </h3>
                <p>الأسبوع: <strong>16</strong> | 2025</p>
            </div>


            <!-- Column 2: Planner Section -->
            <div class="col-span-1 bg-white p-4 rounded-md shadow">
                <h3 class="text-lg font-semibold">الخطط</h3>
                <p>
                    انقر هنا للمشاهدة
                </p>
            </div>


            <!-- Column 1: BV Section -->
            <div class="col-span-1 bg-white p-4 rounded-md shadow">
                <h3 class="text-lg font-semibold">عداد الـ BV</h3>
                <div class="space-y-2">
                    <p>الأسبوع: <strong>2</strong> | <strong>2025</strong></p>
                    <div>
                        <p>BV اليسار: <span>00.00</span></p>
                        <p>BV اليمين: <span>00.00</span></p>
                    </div>
                </div>
            </div>
            <!-- Table Section -->
            <div class="col-span-1 lg:col-span-4 bg-white p-4 rounded-md shadow mt-6">
                <h3 class="text-lg font-semibold">جدول الأعضاء المدرجين تحتك</h3>
                <table class="w-full border-collapse border border-gray-200 mt-4 text-center">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="border border-gray-300 p-2">رقم العضو</th>
                            <th class="border border-gray-300 p-2">الدولة</th>
                            <th class="border border-gray-300 p-2">اسم العضو</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 p-2">00123</td>
                            <td class="border border-gray-300 p-2">السعودية</td>
                            <td class="border border-gray-300 p-2">علي محمد</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-2">00124</td>
                            <td class="border border-gray-300 p-2">مصر</td>
                            <td class="border border-gray-300 p-2">محمود علي</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <div class="container mx-auto px-8 mt-8">
            <div class="grid grid-cols-6 gap-4 bg-gray-100 p-4 rounded-md shadow-md text-center">
                <div class="p-4 bg-white rounded shadow">
                    <p class="font-bold">الكشف الشخصي الخاص بي</p>
                </div>
                <div class="p-4 bg-white rounded shadow">
                    <p class="font-bold">نشاطي وأدواتي</p>
                </div>
                <div class="p-4 bg-white rounded shadow">
                    <p class="font-bold">أدواتي</p>
                </div>
                <div class="p-4 bg-white rounded shadow">
                    <p class="font-bold">لوحة التحكم (خاصة بي)</p>
                </div>
                <div class="p-4 bg-white rounded shadow">
                    <p class="font-bold">معاملاتي</p>
                </div>
                <div class="p-4 bg-white rounded shadow">
                    <p class="font-bold">حسابي</p>
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <footer class="bg-orange-500 text-white p-3 text-center">
            &copy; 2025 QNET. جميع الحقوق محفوظة
        </footer>

    </div>
@endsection
