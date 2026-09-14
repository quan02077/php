<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function indexDb()
    {
        $gender = request('gender'); // 'male' | 'female' | null
        $query = Student::query()->orderBy('id', 'desc');
        if ($gender) {
            $query->where('gender', $gender);
        }
        $students = $query->paginate(5)->appends(compact('gender'));
        return view('students.index_db', compact('students', 'gender'));
    }
    public function create(){
        return view('students.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'nullable|integer|min:16',
            'gender' => 'required|in:male,female', 
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.max' => 'Họ tên không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã tồn tại trong hệ thống.',
            'age.integer' => 'Tuổi phải là một số nguyên.',
            'age.min' => 'Tuổi phải từ 16 trở lên.',
            'gender.in' => 'Giới tính không hợp lệ.',
        ]);

        Student::create($validated);

        return redirect('/students/db')->with('success', 'Tạo mới thành công');
    }
}
