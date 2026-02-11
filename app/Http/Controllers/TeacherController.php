<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    // 1. SEARCH & READ: Soo bandhig xogta iyo raadinta
    public function index(Request $request) {
        $search = $request->input('search');
        $query = DB::table('teachers');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('subject', 'LIKE', "%{$search}%")
                  ->orWhere('qualification', 'LIKE', "%{$search}%");
            });
        }

        $teachers = $query->latest()->get();
        return view('teachers.index', compact('teachers', 'search'));
    }

    // 2. CREATE: Keydi macallin cusub
    public function store(Request $request) {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:teachers',
            'phone'          => 'required|string',
            'address'        => 'required|string',
            'subject'        => 'required|string',
            'qualification'  => 'required|string',
            'salary'         => 'required|numeric',
        ]);

        DB::table('teachers')->insert(array_merge($data, [
            'created_at' => now(), 
            'updated_at' => now()
        ]));

        return back()->with('success', 'New teacher registered successfully!');
    }

    // 3. EDIT: Soo saar xogta macallinka la rabo in la beddelo
    public function edit($id) {
        $teacher = DB::table('teachers')->where('id', $id)->first();
        return view('teachers.edit', compact('teacher'));
    }

    // 4. UPDATE: Keydi isbeddelka lagu sameeyay macallinka
    public function update(Request $request, $id) {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:teachers,email,'.$id,
            'phone'          => 'required|string',
            'address'        => 'required|string',
            'subject'        => 'required|string',
            'qualification'  => 'required|string',
            'salary'         => 'required|numeric',
        ]);

        DB::table('teachers')->where('id', $id)->update(array_merge($data, [
            'updated_at' => now()
        ]));

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    // 5. DELETE: Tirtir macallinka
    public function destroy($id) {
        DB::table('teachers')->where('id', $id)->delete();
        return back()->with('success', 'Teacher record deleted!');
    }
}