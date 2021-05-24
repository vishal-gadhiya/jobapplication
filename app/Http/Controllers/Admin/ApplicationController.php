<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Education;
use App\Models\City;
use App\Models\Skill;
use App\Models\UserEducation;
use App\Models\UserExperience;
use App\Models\UserLanguage;
use App\Models\UserSkill;
use App\Models\UserPreference;
use Carbon\Carbon;
use Exception;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Applications/Index', [
            'users' => User::latest()->get()
        ]);
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
        $userData = $request->personal_details;

        $education   = $request->education_details;

        $experiences = $request->work_experience;

        $languages   = $request->languages;

        $skills      = $request->skills;

        $preference  = $request->preference;

        try {

            $user = User::findOrFail($userData['id']);

            $user->fill([
                'name'           => $userData['name'],
                'email'          => $userData['email'],
                'address'        => $userData['address'],
                'gender'         => $userData['gender'],
                'contact_number' => $userData['contact']
            ]);

            if ($user->save()) {

                UserEducation::where('id', $education['id'])->update([
                    'education_id' => (int) $education['qualification'],
                    'name'         => $education['board_university'], 
                    'year'         => $education['year'],
                    'percentage'   => (float) $education['percentage'], 
                ]);

                if (count($experiences) > 0) {

                    foreach ($experiences as $experience) {

                        UserExperience::where('id', $experience['id'])->update([
                            'company_name' => $experience['company'],
                            'designation'  => $experience['designation'],
                            'from'         => $experience['fromDate'],
                            'to'           => $experience['toDate'],
                        ]);
                    }

                }

                if (count($languages) > 0) {

                    foreach ($languages as $lang) {
                        
                        UserLanguage::where('id', $lang['id'])->update([
                            'is_checked'  => (int) $lang['is_checked'] === UserLanguage::IS_CHECKED,
                            'is_read'     => (int) $lang['read'] === UserLanguage::IS_READ,
                            'is_write'    => (int) $lang['write'] === UserLanguage::IS_WRITE,
                            'is_speak'    => (int) $lang['speak'] === UserLanguage::IS_SPEAK,
                        ]);
                    }

                }

                if (count($skills) > 0) {

                    foreach ($skills as $skill) {
                        
                        UserSkill::where('id', $skill['id'])->update([
                            'is_checked'  => (int) $skill['is_checked'] === UserSkill::IS_CHECKED,
                            'is_beginer'  => (int) $skill['type'] === UserSkill::TYPE_BEGINER,
                            'is_mediator' => (int) $skill['type'] === UserSkill::TYPE_MEDIATOR,
                            'is_expert'   => (int) $skill['type'] === UserSkill::TYPE_EXPERT,
                        ]);
                    }
                }

                UserPreference::where('id', $preference['id'])->update([
                    'city_id'       => (int) $preference['location'],
                    'expected_ctc'  => (float) $preference['expected_ctc'],
                    'current_ctc'   => (float) $preference['current_ctc'],
                    'notice_period' => $preference['notice_period'],
                ]);

                return redirect()->route('admin.applications.index')->withSuccess('Aplication Updated Successfully.');

            } else {

                return redirect()->back()->withError('Something went wrong please try again.');
            }

        } catch (Exception $e) {
            
            return redirect()->back()->withError('Something went wrong please try again.');
        }
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
        /*echo "<pre>";print_r(User::with(['education', 'experiences', 'languages.language', 'skills.skill', 'preference'])->findOrFail($id)->toArray());exit;*/
        return Inertia::render('Admin/Applications/Edit', [
            'user'       => User::with(['education', 'experiences', 'languages.language', 'skills.skill', 'preference'])->findOrFail($id),
            'educations' => Education::all(),
            'locations'  => City::all()
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            if (User::findOrFail($id)->delete()) {

                return redirect()->route('admin.applications.index')->withSuccess('Aplication Deleted Successfully.');
            }

            return redirect()->back()->withError('Something went wrong please try again.');
            
        } catch (Exception $e) {
            
            return redirect()->back()->withError('Something went wrong please try again.');
        }
        
    }
}
