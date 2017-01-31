<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyAmenity;
use App\Models\Property;
use App\Models\Amenity;

class PropertyAmenityController extends Controller
{
    protected $user;
	/**
	 * Class Constructor
	 */
	public function __construct()
	{
		$this->middleware('adaccess');
		\Auth::loginUsingId(1);
		$this->user = \Auth::user()->user_id;
	}

	/**
	* Function that saves the changes in the amenities
	* related to the property.
	*
	*/
	public function save()
	{
		try {
			$this->validate(request(), [
					'property' => 'required|numeric',
					'selectedAmenities' => 'array'
			]);
			if (!$this->hasAmenityParameters()) {
				return ["message" => "There is nothing to change."];
			}
			$property = $this->getPropertyAmenities(request("property"));
			/**
			* If the property does not any amenities yet.
			* We will assign all the selected amenities,
			* else if there are amenities we will check
			* if it is re-assigned or being removed.
			*/
			if (!$property->count()) {
				return $this->assignAmenities(request("selectedAmenities"));
			} else {
				$this->checkAssignments($property, request("selectedAmenities"), request("unselectedAmenities"));
			}

		} catch (Exception $exception) {
			return ["message" => "Something went wrong."];
		}
	}

	public function checkAssignments(PropertyAmenity $property, array $selectedAmenities, array $unselectedAmenities)
	{
		// code..
	}

	/**
	* A class function that will assign the unassigned amenities
	* to the property.
	* @return void
	*/
	public function assignAmenities(array $amenities)
	{
		try {
		foreach ($amenities as $amenity) {
					PropertyAmenity::insert([
							'property_amenity_property_id' => request('property'),
							'property_amenity_amenity_id' => $amenity,
							'created_by' => $this->user
						]);
				} // foreach
				return ["message" => "Successfully assigned new amenities."];
		} catch (Exception $e) {
				return ["message" => "Failure to assign new amenities."];
		}
	}

	/**
	* Returns the model instance of PropertyAmenity of
	* a specific property.
	*
	* @param int $property
	* @return PropertyAmenity $propertyAmenity
	*/
	public function getPropertyAmenities($property)
	{
		return $propertyAmenity = PropertyAmenity::where('property_amenity_property_id', $property)->get();
	}

	/**
	* Function that checks if the user has made an
	* action with the form.
	*
	*/
	public function hasAmenityParameters()
	{
		return ((request("selectedAmenities") || request("unselectedAmenities")) ? true : false);
	}

	public function audit($action = '')
	{
		return \App\AuditTrail::create([
				'audit_user' => $this->user,
				'audit_action' => $action
			]);
	}
}
