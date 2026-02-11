import React from 'react';
import { Link } from '@inertiajs/react';

export default function Dashboard() {
    return (
        <div className="flex h-screen bg-gray-100">
            {/* Sidebar */}
            <div className="w-64 bg-indigo-900 text-white p-6">
                <h2 className="text-2xl font-bold mb-8">SMS System</h2>
                <nav className="space-y-4 text-lg">
                    <Link href="/students" className="block hover:text-indigo-300">👨‍🎓 Students</Link>
                    <Link href="/teachers" className="block hover:text-indigo-300">👨‍🏫 Teachers</Link>
                    <Link href="/courses" className="block hover:text-indigo-300">📚 Courses</Link>
                    <Link href="/enrollments" className="block hover:text-indigo-300">📝 Enrollments</Link>
                    <Link href="/attendances" className="block hover:text-indigo-300">📅 Attendance</Link>
                </nav>
            </div>

            {/* Main Content */}
            <div className="flex-1 p-10">
                <h1 className="text-3xl font-bold text-gray-800">Welcome to Student Management Dashboard</h1>
                <div className="grid grid-cols-3 gap-6 mt-8">
                    <div className="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500">
                        <h3 className="text-gray-500">Total Students</h3>
                        <p className="text-3xl font-bold">120</p>
                    </div>
                    <div className="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500">
                        <h3 className="text-gray-500">Total Teachers</h3>
                        <p className="text-3xl font-bold">15</p>
                    </div>
                    <div className="bg-white p-6 rounded-xl shadow-md border-l-4 border-yellow-500">
                        <h3 className="text-gray-500">Active Courses</h3>
                        <p className="text-3xl font-bold">8</p>
                    </div>
                </div>
            </div>
        </div>
    );
}