<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="bg-gray-50 p-10 font-sans">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-indigo-900 uppercase">
                <i class="fas fa-edit mr-2"></i> Edit Teacher
            </h2>
            <a href="{{ route('teachers.index') }}" class="text-gray-500 hover:text-gray-800 font-bold">
                <i class="fas fa-times mr-1"></i> Cancel
            </a>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ $teacher->name }}" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ $teacher->email }}" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                        <input type="text" name="phone" value="{{ $teacher->phone }}" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Primary Subject</label>
                        <input type="text" name="subject" value="{{ $teacher->subject }}" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Residential Address</label>
                    <input type="text" name="address" value="{{ $teacher->address }}" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Qualification</label>
                        <select name="qualification" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none bg-white" required>
                            <option value="Diploma" {{ $teacher->qualification == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                            <option value="Bachelor" {{ $teacher->qualification == 'Bachelor' ? 'selected' : '' }}>Bachelor Degree</option>
                            <option value="Master" {{ $teacher->qualification == 'Master' ? 'selected' : '' }}>Master Degree</option>
                            <option value="PhD" {{ $teacher->qualification == 'PhD' ? 'selected' : '' }}>PhD / Doctorate</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Monthly Salary ($)</label>
                        <input type="number" name="salary" value="{{ $teacher->salary }}" class="border border-gray-200 p-3 rounded-xl w-full focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-indigo-900 text-white font-bold rounded-xl py-4 hover:bg-indigo-800 transition shadow-lg">
                        <i class="fas fa-check-circle mr-2"></i> Update Teacher Information
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>