<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tenant' => ['required_if:invitation,false','string', 'min:5', 'max:255', 'unique:teams,name,NULL,id'],
            'invitation' => ['required', 'in:true,false'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],
        [    'tenant.required_if' => 'The tenant field is required.',])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
              $check_exist=TeamInvitation::where('email','=',$user->email)->orderByDesc('id')->get();

              if($check_exist->count()){
                $this->joinTeam($check_exist[0]->id);
                $user->current_team_id=$check_exist[0]->team_id;
                $user->save();
              }else{
                $this->createTeam($user);
              }
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Tenants",
            'personal_team' => true,
        ]));
    }

  protected function joinTeam($invitationId){
    $model = Jetstream::teamInvitationModel();

    $invitation = TeamInvitation::where('id','=',$invitationId)->firstOrFail();
    // dd( $invitation->team->owner);
    app(AddsTeamMembers::class)->add(
      $invitation->team->owner,
      $invitation->team,
      $invitation->email,
      $invitation->role
    );

    $invitation->delete();
  }
}
