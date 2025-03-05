<?php

namespace App\Imports;

use Auth;
use App\Models\StudentEnroll;
use App\Models\StudentAttendance;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendancesImport implements ToCollection, WithHeadingRow
{
    protected $data;

    /**
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.date' => 'required|date',
            '*.student_id' => 'required',
            '*.attendance' => 'required',
        ])->validate();


        foreach ($rows as $row) {

            if($row['attendance'] == 'P'){$attendance = 1;}
            elseif($row['attendance'] == 'A'){$attendance = 2;}
            elseif($row['attendance'] == 'L'){$attendance = 3;}
            elseif($row['attendance'] == 'H'){$attendance = 4;}
            else{$attendance = 2;}

            $student_id = $row['student_id'];
            $subject = $this->data['subject'];


            // Enrolls
            $enroll = StudentEnroll::where('session_id', $this->data['session']);
            $enroll->with('student')->whereHas('student', function ($query) use ($student_id){
                $query->where('student_id', $student_id);
            });
            $enroll->with('subjects')->whereHas('subjects', function ($query) use ($subject){
                $query->where('subject_id', $subject);
            });
            $student = $enroll->first();


            if(isset($student)){
            // Attendance Update
            StudentAttendance::updateOrCreate(
                [
                'student_enroll_id'    => $student->id,
                'subject_id'    => $this->data['subject'],
                'date'    => $row['date'],
                ],[
                'student_enroll_id'    => $student->id,
                'subject_id'    => $this->data['subject'],
                'date'    => $row['date'],
                'attendance'    => $attendance,
                'note'    => $row['note'],
                'created_by'     => Auth::guard('web')->user()->id,
            ]);
            }
        }
    }
}
