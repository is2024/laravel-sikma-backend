<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $schedules = DB::table('schedules')
            ->join('subjects', 'schedules.subject_id', '=', 'subjects.id')
            ->select('subjects.title', 'schedules.id', 'schedules.hari', 'schedules.jam_mulai', 'schedules.jam_selesai', 'schedules.ruangan')
            ->where('subjects.title', 'like', '%' . $keyword . '%')
            ->orWhere('schedules.hari', 'like', '%' . $keyword . '%')
            ->paginate(10);

        return view('pages.schedules.index', compact('schedules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $subjects = Subject::get();
        $users = User::where('roles', 'mahasiswa')->get();
        $loginUser = Auth::user();
        return view('pages.schedules.create', compact('subjects', 'users', 'loginUser'));
    }

    public function store(StoreScheduleRequest $request)
    {
        Schedule::create($request->all());
        return redirect()->route('schedule.index')->with('success', 'Schedules created succesfully');
    }

    public function edit(Schedule $schedule)
    {
        $subjects = Subject::get();
        $users = User::where('roles', 'mahasiswa')->get();
        $loginUser = Auth::user();
        return view('pages.schedules.edit', compact('subjects', 'users', 'loginUser'))->with('schedule', $schedule);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $validate = $request->validated();
        $schedule->update($validate);
        return redirect(route('schedule.index'))->with('success', 'Edit Schedule Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect(route('schedule.index'))->with('success', 'Delete Schedule Successfully');
    }

    public function generateQrCode(Schedule $schedule)
    {
        return view('pages.schedules.input-qrcode')->with('schedule', $schedule);
    }

    public function generateQrCodeUpdate(Request $request, Schedule $schedule)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $schedule->update([
            'kode_absensi' => $request->code,
        ]);

        $code = $request->code;

        return view('pages.schedules.show-qrcode', compact('code'))->with('success', 'Code update succesfully');

        // $schedule = Schedule::where('id', $request->id)->first();
        // if ($schedule) {
        //     $schedule->update([
        //         'code' => $request->code,
        //     ]);
        //     return view('pages.schedules.show-qrcode', compact('schedule'))->with('success', 'Code update succesfully');
        // } else {
        //     return redirect()->route('pages.schedules.show-qrcode')->with('error', 'Code not found');
        // }
    }
}