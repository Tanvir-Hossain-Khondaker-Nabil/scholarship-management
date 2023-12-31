<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Member;
use App\Models\Student;
use App\Models\Institute;
use App\Models\StudentClass;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StudentRequest;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data     = [
            'title'     => "Institute",
            'sub_title' => "Index",
            'header'    => "List Class",
        ];
        $students = Student::with('institute')->with('student_class')->get();

        return view('admin.content.register.index', compact('students'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutes      = Institute::where('status', 1)->get();
        $student_classes = StudentClass::where('status', 1)->get();
        $areas           = Area::where('status', 1)->get();
        $members         = Member::get();
        return view('frontend.register', compact('institutes', 'student_classes', 'areas', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        if ($request->validated('institute_id')) {
            $student_data['institute_name'] = Institute::find($request->validated('institute_id'))->name;
        }
        if ($request->validated('student_class_id')) {
            $student_data['student_class_name'] = StudentClass::find($request->validated('student_class_id'))->name;
        }
        if ($request->validated('area_id')) {
            $student_data['area_name'] = Area::find($request->validated('area_id'))->name;
        }
        if ($request->file('image')) {
            if (isset($student_data['image']) && file_exists(public_path('upload/profile/' . $student_data['image']))) {
                unlink('upload/profile/' . $student_data['image']);
            }
            $student_data['image'] = time() . "-profile." . $request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->save('upload/profile/' . $student_data['image']);
            // $request->file('image')->move(public_path('upload/profile/'), $student_data['image']);
        } else {
            $student_data['image'] = session()->get('student_data')['image'];
        }
        if ($request->validated('check_address') == 'on') {
            $student_data['permanent_address']             = $request->validated('present_address');
            $student_data['permanent_address_village']     = $request->validated('present_address_village');
            $student_data['permanent_address_post_office'] = $request->validated('present_address_post_office');
            $student_data['permanent_address_thana']       = $request->validated('present_address_thana');
            $student_data['permanent_address_district']    = $request->validated('present_address_district');
        }

        session()->put('student_data', array_merge($request->validated(), $student_data));
        session()->put('success', 'Item created successfully.');

        $data = [
            'title'   => "Class",
            'student' => session()->get('student_data'),
        ];

        return view('frontend.view', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {

        $institutes      = Institute::where('status', 1)->pluck('name', 'id');
        $student_classes = StudentClass::where('status', 1)->pluck('name', 'id');

        $data = [
            'title'           => "Class",
            'student'         => $student,
            'institutes'      => $institutes,
            'student_classes' => $student_classes,
        ];
        return view('frontend.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $institutes      = Institute::where('status', 1)->get();
        $student_classes = StudentClass::where('status', 1)->get();

        $areas   = Area::where('status', 1)->get();
        $members = Member::get();

        $data = [
            'title'           => "Class",
            'sub_title'       => "Edit",
            'header'          => "Edit Class",
            'student'         => $student,
            'areas'           => $areas,
            'institutes'      => $institutes,
            'student_classes' => $student_classes,
            'members'         => $members,
        ];

        return view('admin.content.student.edit', $data);
    }
    public function studentEditSession()
    {
        $institutes      = Institute::where('status', 1)->get();
        $student_classes = StudentClass::where('status', 1)->get();
        $areas           = Area::where('status', 1)->get();
        $members         = Member::get();

        $data = [
            'title'           => "Class",
            'student'         => session()->get('student_data'),
            'areas'           => $areas,
            'institutes'      => $institutes,
            'student_classes' => $student_classes,
            'members'         => $members,
        ];

        return view('frontend.register_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        if ($request->file('image')) {
            $path = public_path('upload/profile/');
            unlink($path . $student->image);
            $student_data['image'] = time() . "-profile." . $request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->save('upload/profile/' . $student_data['image']);
            $request->file('image')->move(public_path('upload/profile/'), $student_data['image']);
        } else {
            $student_data['image'] = $student->image;
        }

        if ($request->validated('check_address') == 'on') {
            $student_data['permanent_address']             = $request->validated('present_address');
            $student_data['permanent_address_village']     = $request->validated('present_address_village');
            $student_data['permanent_address_post_office'] = $request->validated('present_address_post_office');
            $student_data['permanent_address_thana']       = $request->validated('present_address_thana');
            $student_data['permanent_address_district']    = $request->validated('present_address_district');
        }

        $student->update(array_merge($request->validated(), $student_data));

        session()->put('success', 'Item Updated successfully.');

        return redirect()->route('students.index', [$student->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $deleteOldImage = $student->image;
        if (file_exists($deleteOldImage)) {
            unlink($deleteOldImage);
        }

        $student->delete();
        session()->put('success', 'Item Deleted successfully.');
        return redirect()->back();
    }

    public function printStudentInfo(Student $student)
    {
        return view('frontend.download', compact('student'));
        $pdf = Pdf::loadView('frontend.download', compact('student'));
        return $pdf->download($student->name . time() . '.pdf');
    }


    public function studentConfirmRegistration()
    {
        $studentData = session()->get('student_data');
        unset($studentData['institute_name']);
        unset($studentData['student_class_name']);
        unset($studentData['area_name']);
        unset($studentData['check_address']);
        if (Student::latest()->first()?->registration_no) {
            $currentRegNo = Student::latest()->first()?->registration_no;
            $currentYear  = substr($currentRegNo, 0, 4);
            if ($currentYear === date('Y')) {
                $studentData['registration_no'] = $currentRegNo + 1;
            } else {
                $studentData['registration_no'] = date('Y') . '0001';
            }
        } else {
            $studentData['registration_no'] = date('Y') . '0001';
        }
        if (session()->get('student_data'))
            $student = Student::create($studentData);
        // digitext Sms Api Start

        // $message = [
        //     "secret"   => "0a496de72f6caaca71b4e4b568dde4f364253e37",
        //     // your API secret from (Tools -> API Keys) page
        //     "mode"     => "devices",
        //     "device"   => "00000000-0000-0000-d57d-f30cb6a89289",
        //     "sim"      => 1,
        //     "priority" => 1,
        //     "phone"    => $student->mobile,
        //     "message"  => "Student Reg Number " . $student->registration_no
        // ];

        // $cURL = curl_init("https://digitext.digi5.net/api/send/sms");
        // curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
        // $response = curl_exec($cURL);
        // curl_close($cURL);

        // digitext Sms Api End

        // mim Sms Api Start

        // mim Sms Api End


        session()->forget('student_data');
        $data = [
            'title'   => "Class",
            'student' => $student ?? null,
        ];
        return view('frontend.confirm', $data);
    }

    public function studentCancelRegistration()
    {

        if (session()->exists('student_data')) {
            if (session()->get('student_data')['image']) {
                $path = public_path('upload/profile/');
                unlink($path . session()->get('student_data')['image']);
            }
            session()->forget('student_data');
        }
        return view('frontend.cancel');
    }
}
