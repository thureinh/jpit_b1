<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::where('is_Teacher', 0)->get();
        return view('student.showall_students', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('student.show_student', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = User::where('id', $id)->first();
        return view('student.edit_student', ['student' => $student]);      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = User::find($id);
        if($request->hasFile('profile'))
        {
            $new_profile = $request->file('profile');
            $old_profile = User::where('id', $id)->get('profile_pic')->first();
            Storage::delete($old_profile->profile_pic);
            $path = Storage::putFile('profile_images', $new_profile);
            $student->profile_pic = $path;
        }
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->phone = $request->phone;
        $student->dateofbirth = $request->dob;
        $student->address = $request->address;
        $student->batch_no = $request->batch;
        $student->roll_no = $request->roll;
        if(!is_null($request->password))
        {
            $student->password = $request->password;
        }
        $student->save();
        return redirect()->route('students.show', ['student' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
