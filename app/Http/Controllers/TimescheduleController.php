<?php

namespace App\Http\Controllers;

use App\Models\timeschedule;
use App\Models\Subjects;
use App\Models\Teachers;
use Illuminate\Http\Request;
use \DB;

class TimescheduleController extends Controller
{
    //
    public function getAllSchedules () {
        $allSchedules = timeschedule::all();
        return response()->json(['allSchedules'=>$allSchedules], 200);
    }

    public function addSchedule (Request $request) {
        $timeschedule = new timeschedule();

        $timeschedule->type = $request->input('type');
        $timeschedule->spdate = $request->input('spdate');
        $timeschedule->from = $request->input('from');
        $timeschedule->to = $request->input('to');
        $timeschedule->review = $request->input('review');
        $timeschedule->day = $request->input('day');
        $timeschedule->tid = $request->input('tid');
        $timeschedule->sid = $request->input('sid');
        $timeschedule->cid = $request->input('cid');

        $timeschedule->save();
        return response()->json(['return'=>$timeschedule, 'response'=>true], 201);
    }

    public function deleteSchedule ($id) {
        $timeschedule = timeschedule::find($id);

        if(!$timeschedule) {
            return response()->json([
                "message"=>"timeschedule not found !", 404 
            ]);
        }
        $timeschedule->delete();
        return response()->json([
            "message"=>"timeschedule Deleted !", 201
        ]);
    }

    public function editSchedule (Request $request, $id) {
        $timeschedule = timeschedule::find($id);
        if(!$timeschedule) {
            return response()->json([
                "message"=>"timeschedule not found !", 404 
            ]);
        }

        $timeschedule->type = $request->input('type');
        $timeschedule->spdate = $request->input('spdate');
        $timeschedule->from = $request->input('from');
        $timeschedule->to = $request->input('to');
        $timeschedule->review = $request->input('review');
        $timeschedule->day = $request->input('day');
        $timeschedule->tid = $request->input('tid');
        $timeschedule->sid = $request->input('sid');
        $timeschedule->cid = $request->input('cid');

        $timeschedule->save();
        return response()->json(['return'=>$timeschedule, 'response'=>true], 200);
    }


    public function getRelatedAll () {
        return response()->json(['allSchedules'=>(
            DB::table('timeschedules')
            ->join('teachers', 'teachers.id', 'timeschedules.tid')
            ->join('subjects', 'subjects.id', 'timeschedules.sid')
            ->get())] , 200);
        
    }
}
