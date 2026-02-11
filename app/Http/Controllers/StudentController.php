<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // 1. READ: Soo bandhig liiska ardayda
    public function index(Request $request) {
        $search = $request->input('search');
        $query = DB::table('students');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('student_id', 'LIKE', "%{$search}%");
            });
        }

        $students = $query->latest()->get();
        return view('students.index', compact('students', 'search'));
    }

    // 2. CREATE PAGE: Soo bandhig foomka lagu daro ardayga (Kani ayaa kaa maqnaa)
    public function create() {
        return view('students.create');
    }

    // 3. STORE: Keydi xogta ardayga cusub
    public function store(Request $request) {
        $data = $request->validate([
            'student_id'    => 'required|unique:students',
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:students',
            'gender'        => 'required',
            'class_level'   => 'required',
            'date_of_birth' => 'nullable|date',
            'parent_phone'  => 'nullable|string',
            'address'       => 'nullable|string',
        ]);

        DB::table('students')->insert(array_merge($data, [
            'created_at' => now(), 
            'updated_at' => now()
        ]));

        return redirect()->route('students.index')->with('success', 'Student registered successfully!');
    }

    // 4. EDIT PAGE
    public function edit($id) {
        $student = DB::table('students')->where('id', $id)->first();
        return view('students.edit', compact('student'));
    }

    // 5. UPDATE
    public function update(Request $request, $id) {
        $data = $request->validate([
            'student_id'    => 'required|unique:students,student_id,'.$id,
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:students,email,'.$id,
            'gender'        => 'required',
            'class_level'   => 'required',
            'parent_phone'  => 'nullable|string',
            'address'       => 'nullable|string',
        ]);

        DB::table('students')->where('id', $id)->update(array_merge($data, [
            'updated_at' => now()
        ]));

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    // 6. DELETE
    public function destroy($id) {
        DB::table('students')->where('id', $id)->delete();
        return back()->with('success', 'Student record deleted!');
    }
}