<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="bg-gray-50 p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-indigo-900"><i class="fas fa-user-graduate mr-2"></i> Maamulka Ardayda</h2>
            <a href="{{ url('/') }}" class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-lg font-bold hover:bg-indigo-200 transition">
                <i class="fas fa-arrow-left mr-2"></i> Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <h3 class="text-lg font-bold text-gray-700 mb-4 text-indigo-600">Diiwaangeli Arday Cusub</h3>
            <form action="{{ route('students.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                @csrf
                <input type="text" name="student_id" placeholder="ID (ST001)" class="border border-gray-200 p-2 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none" required>
                <input type="text" name="name" placeholder="Magaca" class="border border-gray-200 p-2 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none" required>
                <input type="email" name="email" placeholder="Email" class="border border-gray-200 p-2 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none" required>
                <select name="class_level" class="border border-gray-200 p-2 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                    <option value="Grade 12">Grade 12</option>
                </select>
                <select name="gender" class="border border-gray-200 p-2 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <button type="submit" class="bg-indigo-600 text-white font-bold py-2 rounded-xl hover:bg-indigo-700 transition">Save</button>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-indigo-900 text-white">
                        <th class="p-4">ID</th>
                        <th class="p-4">Magaca</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($students as $student)
                    <tr class="hover:bg-indigo-50/50 transition">
                        <td class="p-4 font-bold text-indigo-600">{{ $student->student_id }}</td>
                        <td class="p-4 text-gray-700 font-medium">{{ $student->name }}</td>
                        <td class="p-4 text-gray-500">{{ $student->email }}</td>
                        <td class="p-4 flex space-x-2">
                            <button onclick="openEditModal({{ $student }})" class="text-blue-500 hover:bg-blue-50 px-3 py-1 rounded-lg font-bold transition">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Ma hubtaa?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:bg-red-50 px-3 py-1 rounded-lg font-bold transition">
                                    <i class="fas fa-trash-alt"></i> Tirtir
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md shadow-2xl">
            <h2 class="text-2xl font-bold mb-6 text-indigo-900">Wax ka beddel Xogta Ardayga</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <input type="text" id="edit_name" name="name" class="w-full border p-3 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Magaca">
                    <input type="email" id="edit_email" name="email" class="w-full border p-3 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Email">
                    <select id="edit_class" name="class_level" class="w-full border p-3 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="Grade 10">Grade 10</option>
                        <option value="Grade 11">Grade 11</option>
                        <option value="Grade 12">Grade 12</option>
                    </select>
                    <select id="edit_gender" name="gender" class="w-full border p-3 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="flex justify-end mt-6 space-x-3">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-500 font-bold">Cancel</button>
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-xl font-bold">Update Xogta</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(student) {
            // Modal-ka soo bandhig
            document.getElementById('editModal').classList.remove('hidden');
            
            // Xogta ardayga ku rid Form-ka Modal-ka
            document.getElementById('edit_name').value = student.name;
            document.getElementById('edit_email').value = student.email;
            document.getElementById('edit_class').value = student.class_level;
            document.getElementById('edit_gender').value = student.gender;
            
            // U sheeg Form-ka halka uu u dirayo xogta (Action)
            document.getElementById('editForm').action = "/students/" + student.id;
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>