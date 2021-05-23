<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Education;
use App\Models\Language;
use App\Models\Skill;
use App\Models\City;
use App\Models\UserEducation;
use App\Models\UserSkill;
use App\Models\UserLanguage;
use App\Models\UserExperience;
use App\Models\UserPreference;
use Carbon\Carbon;
use Exception;

class ApplicationController extends Controller
{
    
    public function index()
    {
        return Inertia::render('User/Applications/Index', [
        	'educations' => Education::all(),
        	'languages'  => Language::all(),
        	'skills' 	 => Skill::all(),
        	'locations'	 => City::all()
        ]);
    }

    public function store(Request $request)
    {
    	$userData = $request->personal_details;

    	$education 	 = $request->education_details;

    	$experiences = $request->work_experience;

    	$languages 	 = $request->languages;

    	$skills 	 = $request->skills;

    	$preference  = $request->preference;

    	try {

	    	$user = User::create([
	    		'name' 			 => $userData['name'],
	    		'email'		     => $userData['email'],
	    		'address' 		 => $userData['address'],
	    		'gender' 		 => $userData['gender'],
	    		'contact_number' => $userData['contact']
	    	]);

	    	if (!empty($user)) {

	    		$user->education()->save(new UserEducation([
	    			'education_id' => (int) $education['qualification'],
	    			'name'		   => $education['board_university'], 
	    			'year'		   => Carbon::parse($education['year'])->year,
	    			'percentage'   => (float) $education['percentage'], 
	    		]));

	    		if (count($experiences) > 0) {
	    			$exps = array();
	    			foreach ($experiences as $experience) {

	    				array_push($exps, new UserExperience([
	    					'company_name' => $experience['company'],
	    					'designation'  => $experience['designation'],
	    					'from'		   => Carbon::parse($experience['fromDate']),
	    					'to' 		   => Carbon::parse($experience['toDate']),
	    				]));
	    			}

	    			$user->experiences()->saveMany($exps);
	    		}

	    		if (count($languages) > 0) {
	    			$langs = array();
	    			foreach ($languages as $lang) {
	    				
	    				array_push($langs, new UserLanguage([
	    					'language_id' => (int) $lang['id'],
	    					'is_checked'  => $lang['is_checked'],
	    					'is_read'	  => $lang['read'],
	    					'is_write'	  => $lang['write'],
	    					'is_speak'	  => $lang['speak'],
	    				]));
	    			}

	    			$user->languages()->saveMany($langs);
	    		}

	    		if (count($skills) > 0) {
	    			$skls = array();
	    			foreach ($skills as $skill) {
	    				
	    				array_push($skls, new UserSkill([
	    					'skill_id' 	  => (int) $skill['id'],
	    					'is_checked'  => $lang['is_checked'],
	    					'is_beginer'  => (int) $skill['type'] === Skill::TYPE_BEGINER,
	    					'is_mediator' => (int) $skill['type'] === Skill::TYPE_MEDIATOR,
	    					'is_expert'	  => (int) $skill['type'] === Skill::TYPE_EXPERT,
	    				]));
	    			}

	    			$user->skills()->saveMany($skls);
	    		}

	    		$user->preference()->save(new UserPreference([
	    			'city_id' 		=> (int) $preference['location'],
	    			'expected_ctc'  => (float) $preference['expected_ctc'],
	    			'current_ctc' 	=> (float) $preference['current_ctc'],
	    			'notice_period' => $preference['notice_period'],
	    		]));

	    		return redirect()->back()->withSuccess('Aplication Submitted Successfully.');

	    	} else {

	    		return redirect()->back()->withError('Something went wrong please try again.');
	    	}

    	} catch (Exception $e) {
    		
    		return redirect()->back()->withError('Something went wrong please try again.');
    	}
    }

}
