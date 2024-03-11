<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    public function index()
    {
        $student = Student::all();
        $data = [
            "status" => 200,
            "student" => $student
        ];
        return response()->json($data, 200);
    }
    public function store(request $request)
    {
        $validator = validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email"
        ]);
        if ($validator->fails()) {
            $data = [
                "status" => 400,
                "message" => "error"
            ];
            return response()->json($data, 400);
        } else {
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->save();
            $data = [
                "status" => 200,
                "message" => "Saved"
            ];
            return response()->json($data, 200);
        }
    }
}
