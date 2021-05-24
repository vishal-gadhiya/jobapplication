<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Education;
use App\Models\Language;
use App\Models\UserLanguage;
use App\Models\UserSkill;
use App\Models\Skill;
use App\Models\City;
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

	    		$user->education()->create([
	    			'education_id' => (int) $education['qualification'],
	    			'name'		   => $education['board_university'], 
	    			'year'		   => $education['year'],
	    			'percentage'   => (float) $education['percentage'], 
	    		]);

	    		if (count($experiences) > 0) {
	    			$exps = array();
	    			foreach ($experiences as $experience) {

	    				array_push($exps, [
	    					'company_name' => $experience['company'],
	    					'designation'  => $experience['designation'],
	    					'from'		   => $experience['fromDate'],
	    					'to' 		   => $experience['toDate'],
	    				]);
	    			}

	    			$user->experiences()->createMany($exps);
	    		}

	    		if (count($languages) > 0) {
	    			$langs = array();
	    			foreach ($languages as $lang) {
	    				
	    				array_push($langs, [
	    					'language_id' => (int) $lang['id'],
	    					'is_checked'  => (int) $lang['is_checked'] === UserLanguage::IS_CHECKED,
	    					'is_read'	  => (int) $lang['read'] === UserLanguage::IS_READ,
	    					'is_write'	  => (int) $lang['write'] === UserLanguage::IS_WRITE,
	    					'is_speak'	  => (int) $lang['speak'] === UserLanguage::IS_SPEAK,
	    				]);
	    			}

	    			$user->languages()->createMany($langs);
	    		}

	    		if (count($skills) > 0) {
	    			$skls = array();
	    			foreach ($skills as $skill) {
	    				
	    				array_push($skls, [
	    					'skill_id' 	  => (int) $skill['id'],
	    					'is_checked'  => (int) $skill['is_checked'] === UserSkill::IS_CHECKED,
	    					'is_beginer'  => (int) $skill['type'] === UserSkill::TYPE_BEGINER,
	    					'is_mediator' => (int) $skill['type'] === UserSkill::TYPE_MEDIATOR,
	    					'is_expert'	  => (int) $skill['type'] === UserSkill::TYPE_EXPERT,
	    				]);
	    			}

	    			$user->skills()->createMany($skls);
	    		}

	    		$user->preference()->create([
	    			'city_id' 		=> (int) $preference['location'],
	    			'expected_ctc'  => (float) $preference['expected_ctc'],
	    			'current_ctc' 	=> (float) $preference['current_ctc'],
	    			'notice_period' => $preference['notice_period'],
	    		]);

	    		return redirect()->back()->withSuccess('Aplication Submitted Successfully.');

	    	} else {

	    		return redirect()->back()->withError('Something went wrong please try again.');
	    	}

    	} catch (Exception $e) {
    		
    		return redirect()->back()->withError('Something went wrong please try again.');
    	}
    }

}
