<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Answer;
use App\Models\QuestionUserList;
use App\Models\Department;
use App\Models\DepartmentList;
use App\Models\Info;
use App\Models\InfoContent;
use App\Models\User;
use App\Models\UserList;
use App\Notifications\Survey;
use App\Notifications\CreateAccountApp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Registered;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize("notClient");

        $departmentId = $request->input('department_id');

        if ($departmentId) {
            // Filter department list based on the selected department
            $filteredDepartmentLists = DepartmentList::where('department_id', $departmentId)->get();

            // Get the user IDs from the filtered department list
            $userIds = $filteredDepartmentLists->pluck('user_id');

            // Query users based on the filtered user IDs
            $clients = User::whereIn('id', $userIds)->where("user_type_id", 2)->get();
        } else {
            // If no department selected, fetch all clients with user_type_id 2
            $clients = User::where("user_type_id", 2)->get();
        }

        $departments = Department::all();
        $departmentLists = DepartmentList::whereIn('user_id', $clients->pluck('id'))->get();
        $userLists = UserList::whereIn('client_id', $clients->pluck('id'))->get();
        $mentors = User::where("user_type_id", 1)
            ->orWhere("user_type_id", 3)
            ->get();

        return view("clients.index", compact("clients", "departments", "departmentLists", "mentors", "userLists"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize("adminOrDep");

        $departments = Department::all();
        $departmentLists = DepartmentList::all();
        $mentors = User::where("user_type_id", 1)
            ->orWhere("user_type_id", 3)
            ->get();
        return view(
            "clients.create",
            compact("departments", "departmentLists", "mentors")
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        Gate::authorize("adminOrDep");

        $request->request->add(["user_type_id" => 2]);
        $request->request->add(["password" => bcrypt("veranderMij")]);
        $user = User::create($request->all());

        event(new Registered($user));
        $user->notify(new CreateAccountApp(env('APP_URL') . "/user#Pass"));

        for ($i = 0; $i <= $request->totalDep; $i++) {
            $department = $request->input("department" . $i);
            $mentor = $request->input("mentor" . $i);
            if ($department != null) {
                DepartmentList::create([
                    "user_id" => User::latest()->first()->id,
                    "department_id" => $department,
                    "role_id" => 2,
                ]);
                UserList::create([
                    "client_id" => User::latest()->first()->id,
                    "mentor_id" => $mentor,
                ]);
            }
        }

        $msg = "New Client Created successful! ";
        return redirect("clients")->with("msg", $msg);
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
        Gate::authorize("adminOrDep");

        $client = User::find($id);
        $departments = Department::all();
        $departmentsList = DepartmentList::all();
        $usersList = UserList::where("client_id", $id)->get();
        $userDepartments = DepartmentList::where("user_id", $id)->get();
        $surveys = InfoContent::where("info_id", 1)->get();
        $mentors = User::where("user_type_id", 1)
            ->orWhere("user_type_id", 3)
            ->get();
        return view(
            "clients.edit",
            compact(
                "client",
                "departments",
                "departmentsList",
                "mentors",
                "userDepartments",
                "usersList",
                "surveys"
            )
        );
    }

    public function sendSurvey(Request $request, $id)
    {
        $survey = $request->input('survey_id');
        $url = InfoContent::find($survey)->first()->url;
        $url = $url . urlencode($id);

        User::find($id)->notify(new Survey($url));
        User::find($id)->update(["survey" => now()]);

        return redirect()->back();
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
        Gate::authorize("adminOrDep");

        $client = User::find($id);
        $client->update($request->all());

        DepartmentList::Where("user_id", $id)->delete();
        UserList::Where("client_id", $id)->delete();
        for ($i = 0; $i <= $request->totalDep; $i++) {
            $department = $request->input("department" . $i);
            $mentor = $request->input("mentor" . $i);
            if ($department != null) {
                DepartmentList::create([
                    "user_id" => $id,
                    "department_id" => $department,
                    "role_id" => 2,
                ]);
                UserList::create([
                    "client_id" => $id,
                    "mentor_id" => $mentor,
                ]);
            }
        }

        $msg = "Client Updated successful! ";
        return redirect("clients")->with("msg", $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize("adminOrDep");

        DepartmentList::where("user_id", $id)->delete();
        UserList::where("client_id", $id)->delete();
        Answer::where("user_id", $id)->delete();
        QuestionUserList::where("user_id", $id)->delete();
        $client = User::find($id);
        $client->delete();

        $msg = "Client Deleted successful! ";
        return redirect("clients")->with("msg", $msg);
    }
}
