<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SMS PRO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 font-sans flex text-slate-900">

    <div class="w-64 h-screen bg-slate-900 text-white p-5 sticky top-0 hidden lg:flex flex-col shadow-2xl">
        <div class="flex items-center gap-3 mb-10 px-2">
            <i class="fa-solid fa-graduation-cap text-3xl text-blue-400"></i>
            <h2 class="text-2xl font-black tracking-wider">SMS <span class="text-blue-400">PRO</span></h2>
        </div>

        <nav class="space-y-2 flex-1">
            <a href="#" class="flex items-center gap-3 p-3 bg-blue-600 rounded-xl transition shadow-lg text-white font-bold">
                <i class="fa-solid fa-chart-line w-5"></i> Dashboard
            </a>
            <a href="{{ route('students.index') }}" class="flex items-center gap-3 p-3 hover:bg-slate-800 rounded-xl transition text-slate-300 hover:text-white">
                <i class="fa-solid fa-user-graduate w-5"></i> Students
            </a>
            <a href="{{ route('teachers.index') }}" class="flex items-center gap-3 p-3 hover:bg-slate-800 rounded-xl transition text-slate-300 hover:text-white">
                <i class="fa-solid fa-user-tie w-5"></i> Teachers
            </a>
            <a href="{{ route('courses.index') }}" class="flex items-center gap-3 p-3 hover:bg-slate-800 rounded-xl transition text-slate-300 hover:text-white">
                <i class="fa-solid fa-book-open w-5"></i> Courses
            </a>
            <a href="{{ route('enrollments.index') }}" class="flex items-center gap-3 p-3 hover:bg-slate-800 rounded-xl transition text-slate-300 hover:text-white">
                <i class="fa-solid fa-file-signature w-5"></i> Enrollments
            </a>
            <a href="{{ route('attendances.index') }}" class="flex items-center gap-3 p-3 hover:bg-slate-800 rounded-xl transition text-slate-300 hover:text-white">
                <i class="fa-solid fa-calendar-check w-5"></i> Attendance
            </a>
        </nav>

        <div class="pt-5 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 p-3 text-red-400 hover:bg-red-500/10 w-full rounded-xl transition font-bold text-sm text-left">
                    <i class="fa-solid fa-right-from-bracket w-5"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="flex-1 flex flex-col min-h-screen">
        
        <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 px-8 py-4 flex justify-between items-center shadow-sm">
            <div class="flex items-center gap-4">
                <button class="lg:hidden text-slate-600 text-xl"><i class="fa-solid fa-bars"></i></button>
                <div class="relative hidden md:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-sm"></i>
                    <input type="text" placeholder="Search data..." class="pl-10 pr-4 py-2 bg-gray-50 border-none rounded-xl text-sm w-72 focus:ring-2 focus:ring-blue-500 transition">
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800">Admin Panel</p>
                    <p class="text-[10px] text-green-500 font-bold uppercase">Online</p>
                </div>
                <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" class="w-10 h-10 rounded-xl border border-gray-100 shadow-sm">
            </div>
        </nav>

        <main class="p-8">
            <header class="mb-10">
                <h1 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Analytics Overview</h1>
                <p class="text-slate-500">Monitoring courses, enrollments and system performance.</p>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center group hover:border-blue-500 transition duration-300">
                    <div>
                        <p class="text-gray-400 text-[10px] font-black uppercase mb-1 tracking-widest">Students</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $studentCount }}</h3>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition"><i class="fa-solid fa-users text-xl"></i></div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center group hover:border-green-500 transition duration-300">
                    <div>
                        <p class="text-gray-400 text-[10px] font-black uppercase mb-1 tracking-widest">Teachers</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $teacherCount }}</h3>
                    </div>
                    <div class="bg-green-50 p-4 rounded-xl text-green-600 group-hover:bg-green-600 group-hover:text-white transition"><i class="fa-solid fa-user-tie text-xl"></i></div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center group hover:border-orange-500 transition duration-300">
                    <div>
                        <p class="text-gray-400 text-[10px] font-black uppercase mb-1 tracking-widest">Courses</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $courseCount }}</h3>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-xl text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition"><i class="fa-solid fa-book-open text-xl"></i></div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center group hover:border-purple-500 transition duration-300">
                    <div>
                        <p class="text-gray-400 text-[10px] font-black uppercase mb-1 tracking-widest">Enrollments</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $enrollmentCount }}</h3>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-xl text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition"><i class="fa-solid fa-file-signature text-xl"></i></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2 uppercase text-[11px] tracking-widest text-gray-400">
                        <i class="fa-solid fa-chart-bar text-blue-500"></i> Growth Analytics
                    </h3>
                    <canvas id="barChart" height="200"></canvas>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2 uppercase text-[11px] tracking-widest text-gray-400">
                        <i class="fa-solid fa-chart-pie text-orange-500"></i> Course Distribution
                    </h3>
                    <div class="max-w-[250px] mx-auto">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 uppercase text-[10px] tracking-widest text-gray-400">
                            <i class="fa-solid fa-user-plus text-blue-600 mr-2"></i> Recent Enrollments
                        </h3>
                        <a href="{{ route('enrollments.index') }}" class="text-[10px] font-black text-blue-600 uppercase hover:underline">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50 text-gray-400 text-[9px] uppercase tracking-widest font-black">
                                    <th class="px-6 py-3">Student ID</th>
                                    <th class="px-6 py-3">Course</th>
                                    <th class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-bold text-slate-700">#STU-990</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 font-medium">Software Engineering</td>
                                    <td class="px-6 py-4"><span class="bg-blue-50 text-blue-600 text-[9px] font-black px-2 py-1 rounded-full uppercase">Enrolled</span></td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-bold text-slate-700">#STU-882</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 font-medium">Graphic Design</td>
                                    <td class="px-6 py-4"><span class="bg-blue-50 text-blue-600 text-[9px] font-black px-2 py-1 rounded-full uppercase">Enrolled</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 uppercase text-[10px] tracking-widest text-gray-400">
                            <i class="fa-solid fa-book text-orange-500 mr-2"></i> Active Courses
                        </h3>
                        <a href="{{ route('courses.index') }}" class="text-[10px] font-black text-blue-600 uppercase hover:underline">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50 text-gray-400 text-[9px] uppercase tracking-widest font-black">
                                    <th class="px-6 py-3">Course Name</th>
                                    <th class="px-6 py-3">Duration</th>
                                    <th class="px-6 py-3">Level</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-bold text-slate-700">PHP Laravel</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 font-medium">6 Months</td>
                                    <td class="px-6 py-4"><span class="bg-orange-50 text-orange-600 text-[9px] font-black px-2 py-1 rounded uppercase tracking-tighter">Advanced</span></td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-bold text-slate-700">UI/UX Design</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 font-medium">3 Months</td>
                                    <td class="px-6 py-4"><span class="bg-orange-50 text-orange-600 text-[9px] font-black px-2 py-1 rounded uppercase tracking-tighter">Intermediate</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                datasets: [{
                    label: 'Enrollments',
                    data: [12, 19, 13, 15, 22, 10],
                    backgroundColor: '#3b82f6',
                    borderRadius: 8
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { display: false }, x: { grid: { display: false } } } }
        });

        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Pending', 'Closed'],
                datasets: [{
                    data: [70, 20, 10],
                    backgroundColor: ['#10b981', '#3b82f6', '#ef4444'],
                    borderWidth: 0,
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } }, cutout: '80%' }
        });
    </script>
</body>
</html>