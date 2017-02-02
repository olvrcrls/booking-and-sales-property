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
					'toggledAmenities' => 'array'
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
				return $this->assignAmenities(request("toggledAmenities"));
			} else {
				$this->checkAssignments(request("toggledAmenities"));
			}

		} catch (Exception $exception) {
			return ["message" => "Something went wrong."];
		}
	}

	public function checkAssignments($toggledAmenities)
	{
		// loops the selected or toggled amenities from the modal and check
		// the assignment of amenities to the corresponding property.
		foreach ($toggledAmenities as $amenity) {
			$propertyAmenity = PropertyAmenity::where('property_amenity_amenity_id', $amenity)
								->where('property_amenity_property_id', request("property"))
								->get();
			if ($propertyAmenity->count()) { // checks if the amenity is already assigned to the property.
				if ($propertyAmenity->property_amenity_active) { 
				// if the amenity is not yet removed. this will deactivate the amenity from the property.
					$propertyAmenity->property_amenity_active = false;
					$propertyAmenity->modified_date = date('Y-m-d h:i:s');
					$propertyAmenity->modified_by = $this->user;
					$propertyAmenity->save();
					$this->audit("An amenity, '{$propertyAmenity->amenities->amenity_name}', of '{$propertyAmenity->properties->property_name}' has been removed.");
				} else {
				// if the amenity is already removed. this will re-activate the amenity from the property.
					$propertyAmenity->property_amenity_active = true;
					$propertyAmenity->modified_date = date('Y-m-d h:i:s');
					$propertyAmenity->modified_by = $this->user;
					$propertyAmenity->save();
					$this->audit("An amenity, '{$propertyAmenity->amenities->amenity_name}', of '{$propertyAmenity->properties->property_name}' has been restored.");
				}
			} else { // if the amenity is not yet assigned to the property. this will assign the amenity to the property.
				$new_propertyAmenity = PropertyAmenity::create([
						'property_amenity_property_id' => request("property"),
						'property_amenity_amenity_id' => $amenity,
						'created_by' => $this->user
					]);
				$this->audit("A new amenity, '{$new_propertyAmenity->amenities->amenity_name}', has been assigned to '{$new_propertyAmenity->properties->property_name}'.");
			}
		} //foreach
		return ["message" => "Successfully toggled amenities."];
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
			$property = Property::select('property_id', 'property_name')->where('property_id', request('property'))->get();
			$this->audit("Assigned amenities to '{$property->property_name}'.");
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
		return (request("toggledAmenities") ? true : false);
	}

	/**
	* Audits the action taken of the currently logged in
	* user with access.
	*
	* @param string $action
	* @return  \App\AuditTrail
	*/
	public function audit($action = '')
	{
		return \App\AuditTrail::create([
				'audit_user' => $this->user,
				'audit_action' => $action
			]);
	}
}
