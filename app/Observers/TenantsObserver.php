<?php

namespace App\Observers;

use App\Models\Department;
use App\Models\Team;
use Illuminate\Support\Str;

class TenantsObserver
{
    /**
     * Handle the Team "created" event.
     */
    public function created(Team $team): void
    {
        //
        $records_department = [
            [
                "name"  => "Sales"
            ],
            [
                "name"  => "Marketing"
            ],
            [
                "name"  => "Human Resources"
            ],
            [
                "name"  => "Finance"
            ], [
                "name"  => "Information Technology (IT)"
            ],
            [
                "name"  => "Customer Service"
            ],
            [
                "name"  => "Research and Development (R&D)"
            ],
            [
                "name"  => "Operations"
            ],
            [
                "name"  => "Supply Chain Management"
            ],
            [
                "name"  => "Legal"
            ],
            [
                "name"  => "Quality Assurance"
            ],
            [
                "name"  => "Public Relations (PR)"
            ],
            [
                "name"  => "Administration"
            ],
            [
                "name"  => "Product Development"
            ],
            [
                "name"  => "Procurement"
            ]
        ];

        $records = [
            [
                "name"  => "SQL Server 2019",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],
            [
                "name"  => "Oracle Database 19c",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ], [
                "name"  => "Dynamics 365",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ], [
                "name"  => "Tableau Desktop 2021.x ",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ], [
                "name"  => "Adobe Experience Manager 6.5",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ], [
                "name"  => "Jira Software 8.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "Magento 2.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "WordPress 5.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "Moodle 3.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "Symantec Endpoint Protection 14.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "McAfee Endpoint Security 10.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "MySQL 8.0",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "PostgreSQL 13",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "MongoDB 4.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "MariaDB 10.5",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "Apache Cassandra 3.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "Redis 6.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ]


        ];
        foreach ($records_department as $result)
        {

            Department::create(
                [
                    'name' => $result['name'],
                    'tenant_id' => $team->id,
//                    'slug' =>  Str::slug($result['name']),
                    'is_default' =>1,
                ]);
        }
    }

    /**
     * Handle the Team "updated" event.
     */
    public function updated(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "deleted" event.
     */
    public function deleted(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "restored" event.
     */
    public function restored(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "force deleted" event.
     */
    public function forceDeleted(Team $team): void
    {
        //
    }
}
