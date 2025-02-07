<?php
// Last Modified Date: 18-04-2024
// Developed By: Innovative Solution Pvt. Ltd. (ISPL)
namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
        $user = User::find($this->user);
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required',
            'username' => 'required|max:255|unique:pgsql.auth.users',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:255|unique:pgsql.auth.users',
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(), 'confirmed'],
            'roles' => 'required',
            'user_type' => 'required',
            'service_provider_id' => 'required_if:user_type,Service Provider',
            'status' => 'required',
        ];
    
        switch ($this->method()) {
            case 'POST':
                // Accessing the request data dynamically
                $roles = $this->input('roles', []); // Default to empty array if not present
                $user_type = $this->input('user_type');
    
                // Check if "Municipality - Help Desk" exists in roles
                if (in_array('Municipality - Help Desk', $roles) && $user_type === 'Help Desk') {
                    $rules['help_desk_id_2'] = 'required|integer';
                }
    
                // Check if "Service Provider - Help Desk" exists in roles
                if (in_array('Service Provider - Help Desk', $roles) && $user_type === 'Help Desk') {
                    $rules['help_desk_id_1'] = 'required|integer';
                }
    
                return $rules;  // Ensure rules are returned after being modified
    
            case 'PUT':
            case 'PATCH':
                // Define the rules for PUT and PATCH if needed
                $rules = array_merge($rules, [
                    'username' => 'required|max:255|unique:pgsql.auth.users,username,' . $user->id,
                    'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:pgsql.auth.users,email,' . $user->id,
                    'password' => ['nullable', 'required_with:password_confirmation', Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(), 'confirmed'],
                    'service_provider_id' => 'required_if:user_type,Service Provider',
                ]);
    
                return $rules;  // Ensure rules are returned after being modified
    
            default:
                break;
        }
    }
    


public function messages()
{
    return [
        'name.required' => 'The Full Name field is required.',
        'name.max' => 'The Full Name must not exceed 255 characters.',
        'gender.required' => 'The Gender field is required.',
        'username.required' => 'The Username field is required.',
        'username.max' => 'The Username must not exceed 255 characters.',
        'username.unique' => 'The Username has already been taken.',
        'email.required' => 'The Email field is required.',
        'email.regex' => 'The Email format is invalid.',
        'email.max' => 'The Email must not exceed 255 characters.',
        'email.unique' => 'The Email has already been taken.',
        'password.required' => 'The Password field is required.',
        'password.min' => 'The Password must be at least 8 characters.',
        'password.letters' => 'The Password must contain at least one letter.',
        'password.mixedCase' => 'The Password must include both uppercase and lowercase letters.',
        'password.numbers' => 'The Password must contain at least one number.',
        'password.symbols' => 'The Password must include at least one symbol.',
        'password.uncompromised' => 'The Password has been found in a data leak. Please choose a different password.',
        'password.confirmed' => 'The Confirm Password confirmation does not match.',
        'roles.required' => 'The Roles field is required.',
        'user_type.required' => 'The User Type field is required.',
        'service_provider_id.required_if' => 'The Service Provider ID is required when User Type is Service Provider.',
        'help_desk_id_2.required' => 'The Help Desk is required for Municipality Help Desk role.',
        'help_desk_id_2.integer' => 'The Help Desk must be an integer.',
        'help_desk_id_1.required' => 'The Help Desk is required for Service Provider Help Desk role.',
        'help_desk_id_1.integer' => 'The Help Desk must be an integer.',
        'status.required' => 'The Status field is required.',
    ];
}


}
