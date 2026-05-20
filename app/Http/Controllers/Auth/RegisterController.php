<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donor;
use App\Models\Hospital;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        $rules = [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', 'in:donor,hospital'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'city'     => ['nullable', 'string', 'max:100'],
            'state'    => ['nullable', 'string', 'max:100'],
        ];

        if (isset($data['role']) && $data['role'] === 'hospital') {
            $rules['hospital_name']        = ['required', 'string', 'max:255'];
            // accepts BOTH field names — whichever your form sends
            $rules['registration_number']  = ['nullable', 'string', 'max:100'];
            $rules['license_number']       = ['nullable', 'string', 'max:100'];
        }

        return Validator::make($data, $rules);
    }

    protected function create(array $data)
    {
        // Accept either registration_number or license_number
        $licenseNumber = $data['registration_number']
                      ?? $data['license_number']
                      ?? 'N/A';

        // 1. Create user
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
            'phone'    => $data['phone']  ?? null,
            'address'  => $data['city']   ?? null,
        ]);

        // 2. If donor — create donor profile
        if ($data['role'] === 'donor') {
            Donor::create([
                'user_id'     => $user->id,
                'name'        => $data['name'],
                'blood_group' => 'O+',
                'age'         => 18,
                'gender'      => 'male',
                'phone'       => $data['phone'] ?? '',
                'address'     => $data['state'] ?? '',
                'city'        => $data['city']  ?? '',
                'status'      => 'active',
            ]);
        }

        // 3. If hospital — create hospital profile
        if ($data['role'] === 'hospital') {
            Hospital::create([
                'user_id'        => $user->id,
                'name'           => $data['hospital_name']     ?? $data['name'],
                'license_number' => $licenseNumber,
                'phone'          => $data['phone']             ?? '',
                'address'        => $data['hospital_address']  ?? $data['city'] ?? '',
                'city'           => $data['city']              ?? '',
                'status'         => 'active',
            ]);
        }

        return $user;
    }
}
