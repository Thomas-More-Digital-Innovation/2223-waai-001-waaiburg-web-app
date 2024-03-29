<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\InfoContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize("notClient");
        $info = Info::where("section_id", 5)
            ->get()
            ->first();
        $surveys = InfoContent::where("info_id", $info->id)->get();
        return view("surveys.index", compact("surveys"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize("allowAdmin");

        return view("surveys.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize("allowAdmin");

        // $request->request->add(["section_id" => 5]);
        // Info::create($request->all());

        $request->request->add(["info_id" => 1]);
        InfoContent::create($request->all());

        $msg = "New survey Created successful! ";
        return redirect("surveys")->with("msg", $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize("allowAdmin");

        $survey = InfoContent::find($id);

        return view("surveys.edit", compact("survey"));
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
        Gate::authorize("allowAdmin");

        $survey = InfoContent::find($id);
        $survey->update($request->all());

        $msg = "Survey Updated successful! ";
        return redirect("surveys")->with("msg", $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize("allowAdmin");
        $survey = InfoContent::find($id);
        $survey->delete();

        $msg = "Survey Deleted successful! ";
        return redirect("surveys/")->with("msg", $msg);
    }
}
