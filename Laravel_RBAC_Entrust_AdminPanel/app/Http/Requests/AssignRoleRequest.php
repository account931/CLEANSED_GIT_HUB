<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule; //for in: validation
use App\models\EntrustRbac\Role; //model for Entrust Role model


class AssignRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        //getting all existing roles from DB, get from DB only column "id". Used for validation in range {Rule::in(['admin', 'owner']) ]}, ['13', '17']
		$existingRoles = Role::select('id')->get(); 
		$rolesList  = array(); // array to contain all roles id  from DB in format ['13', '17']
		foreach($existingRoles as $n){
			array_push($rolesList, $n->id);	
		}
        
        return [
            //
            'role_sel' => [ 'required', 'string', Rule::in( $rolesList ) ] , //validation in range, i.e Rule::in(['admin', 'owner']) ] =['13', '17']

        ];
    }
    
    
    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'role_sel.required' => 'Required. We need the role to be specified',
            'role_sel.in' => 'Value has invalid range value',

		];
	}
    
    
     
    /**
     * Return validation errors 
     * @param Validator $validator
     *
     */
    public function withValidator(Validator $validator)
    {
	    if ($validator->fails()) {
            return redirect('/rbac')
			    ->withInput()
			    ->with('flashMessageFailX',"<i class='fa fa-minus-circle' style='font-size:22px;color:red'></i> Validation and assigning new role failed")
			    ->withErrors($validator);
        }
	}
}
