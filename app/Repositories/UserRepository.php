<?php

namespace App\Repositories;

use App\User;
use App\Staff;
use App\StaffDocument;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Modules\Account\Repositories\OpeningBalanceHistoryRepository;
use Modules\Setting\Model\BusinessSetting;
use App\Traits\ImageStore;
use Modules\Account\Entities\ChartAccount;
use Modules\Account\Entities\TimePeriodAccount;
use Modules\Account\Repositories\OpeningBalanceHistoryRepositoryInterface;
use App\Jobs\SignupMailJob;

class UserRepository implements  UserRepositoryInterface
{
    use ImageStore;

    public function user()
    {
        return User::with('leaves','leaveDefines')->latest()->get();
    }

    public function all($relational_keyword = [])
    {
        if (count($relational_keyword) > 0) {
            return Staff::with($relational_keyword)->latest()->get();
        }else {
            return Staff::latest()->get();
        }

    }

    public function create(array $data)
    {
        $user = User::create($data);

        // if(BusinessSetting::where('type', 'email_verification')->first()->status != 1){
        //     $user->email_verified_at = date('Y-m-d H:m:s');
        //     $user->save();
        // }
        // else {
        //     $user->sendEmailVerificationNotification();
        // }

        // dispatch(new SignupMailJob(['name' => $user->name, 'email' => $user->email]));

        $staff = new Staff;
        $staff->user_id = $user->id;
        $staff->save();
        $chart_account = new ChartAccount;
        $chart_account->level = 2;
        $chart_account->is_group = 0;
        $chart_account->name = $staff->user->name;
        $chart_account->description = null;
        $chart_account->parent_id = 6;
        $chart_account->status = 1;
        $chart_account->configuration_group_id = 4;
        $chart_account->type = 1;
        $chart_account->contactable_type = "App\User";
        $chart_account->contactable_id = $user->id;
        $chart_account->save();
        ChartAccount::findOrFail($chart_account->id)->update(['code' => '0' . $chart_account->type . '-' . $chart_account->parent_id . '-' . $chart_account->id]);
        return $staff;
    }

    public function store(array $data)
    {
        $role = explode('-', $data['role_id']);
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role_id = $role[0];

        if (isset($data['photo'])) {
            $data = Arr::add($data, 'avatar', $this->saveAvatar($data['photo']));
            $user->avatar = $data['avatar'];
        }

        $user->password = Hash::make($data['password']);
        if($user->save()){
            $staff = new Staff;
            $staff->user_id = $user->id;
            $staff->phone = $data['phone'];

            if ($role[1] != "system_user") {

                $staff->bank_name = $data['bank_name'];
                $staff->bank_branch_name = $data['bank_branch_name'];
                $staff->bank_account_name = $data['bank_account_name'];
                $staff->bank_account_no = $data['bank_account_no'];
                $staff->basic_salary = $data['basic_salary'];
                $staff->employment_type = $data['employment_type'];
                $staff->date_of_joining = Carbon::parse($data['date_of_joining'])->format('Y-m-d');
                if (!empty($data['provisional_months'])) {
                    $staff->provisional_months = $data['provisional_months'];
                }
                $staff->date_of_birth = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
                $staff->leave_applicable_date = Carbon::parse($data['leave_applicable_date'])->format('Y-m-d');
                $staff->current_address = $data['current_address'];
                $staff->permanent_address = $data['permanent_address'];
            }

            $staff->save();

            dispatch(new SignupMailJob(['name' => $user->name, 'email' => $user->email, 'password' => $data['password']]));

            return $staff;

        }
    }

    public function find($id)
    {
        return Staff::with('user')->findOrFail($id);
    }

    public function findUser($id)
    {
        return User::findOrFail($id);
    }

    public function findDocument($id)
    {
        return StaffDocument::where('staff_id', $id)->get();
    }

    public function update(array $data, $id)
    {
        $role = explode('-', $data['role_id']);
        $user = User::findOrFail($id);
        $staff = $user->staff;
            if (isset($data['photo'])) {
                $data = Arr::add($data, 'avatar', $this->saveAvatar($data['photo']));
                $user->avatar = $data['avatar'];
            }
            if (isset($data['signature_photo'])) {
                $data = Arr::add($data, 'signature', $this->saveAvatar($data['signature_photo'],120,60));
                $user->signature = $data['signature'];
            }
            $user->name = $data['name'];
            $user->role_id = $role[0];

            if (isset($data['password'])) {
                $user->password = bcrypt($data['password']);
            }
            $result = $user->save();
            if($result){
                $staff->user_id = $user->id;
                if ($role[1] != "system_user") {
                    $staff->bank_name = $data['bank_name'];
                    $staff->bank_branch_name = $data['bank_branch_name'];
                    $staff->bank_account_name = $data['bank_account_name'];
                    $staff->bank_account_no = $data['bank_account_no'];
                    $staff->basic_salary = $data['basic_salary'];
                    $staff->employment_type = $data['employment_type'];
                    $staff->date_of_joining = Carbon::parse($data['date_of_joining'])->format('Y-m-d');
                    if (!empty($data['provisional_months'])) {
                        $staff->provisional_months = $data['provisional_months'];
                    }
                    $staff->date_of_birth = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
                    $staff->current_address = $data['current_address'];
                    $staff->permanent_address = $data['permanent_address'];
                }

                $staff->phone = $data['phone'];
                $staff->save();
            }

        return $staff;
    }

    public function updateProfile(array $data, $id)
    {
        $user = User::findOrFail($id);
        if (isset($data['avatar'])) {
            $user->avatar = $this->saveAvatar($data['avatar'],60,60);
        }
        $user->name = $data['name'];
        if (array_key_exists('password',$data))
            $user->password = Hash::make($data['password']);
        $result = $user->save();
        $staff = $user->staff;
        if($result){
            $staff->phone = $data['phone'];
            if ($user->role_id != 1) {
                $staff->bank_name = $data['bank_name'];
                $staff->bank_branch_name = $data['bank_branch_name'];
                $staff->bank_account_name = $data['bank_account_name'];
                $staff->bank_account_no = $data['bank_account_no'];
                $staff->current_address = $data['current_address'];
                $staff->permanent_address = $data['permanent_address'];
            }

            $staff->save();
        }
        return $staff;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if (File::exists($user->avatar)) {
            File::delete($user->avatar);
        }
        $user->staff->delete();
        $user->delete();
    }

    public function statusUpdate($data)
    {
        $user = User::find($data['id']);
        $user->is_active = $data['status'];

        $user->save();
    }

    public function deleteStaffDoc($id)
    {
        $document = StaffDocument::findOrFail($id)->delete();
    }

    public function normalUser()
    {
        return User::where('id',Auth::id())->orwhere('role_id',3)->get();
    }

    public function userStaffs()
    {
        return Staff::whereHas('user',function($query)
        {
            $query->where('role_id',3)->where('is_active',1);
        })->get();
    }

    public function staffs($role_id)
    {
        return User::where('role_id', $role_id)->where('is_active',1)->get();
    }
}
