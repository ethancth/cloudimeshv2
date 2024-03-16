<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\RemoveTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
      Jetstream::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', 'Administrator', [
            'create',
            'read',
            'update',
            'delete',
        ])->description('Administrator users can perform any action.');

        Jetstream::role('requester', 'Requester', [
            'read',
            'create',
            'update',
            'read.project',
            'create.project',
            'update.project',
            'delete.project',
        ])->description('Requester users have the ability to read, create, and update.');

      Jetstream::role('approver', 'Approver', [
        'read',
        'create',
        'update',
        'read.project',
        'create.project',
        'update.project',
        'delete.project',
        'approve.project.lv1',
        'reject.project.lv1',
        'approve.project.lv2',
        'reject.project.lv2',
      ])->description('Approver users have the ability to read, create, update, and approve level 2 Project.');

      Jetstream::role('granter', 'Granter', [
        'read',
        'create',
        'update',
        'read.project',
        'create.project',
        'update.project',
        'delete.project',
        'approve.project.lv2',
        'reject.project.lv2',
      ])->description('Granter users have the ability to read, create, update, and approve level 2 Project ');
    }
}
