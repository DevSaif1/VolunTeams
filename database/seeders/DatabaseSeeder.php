<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Application;
use App\Models\Certificate;
use App\Models\Opportunity;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\VolunteerHour;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. ROLES
        |--------------------------------------------------------------------------
        */

        $adminRole = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $managerRole = Role::firstOrCreate([
            'name' => 'Team Manager',
            'guard_name' => 'web',
        ]);

        $memberRole = Role::firstOrCreate([
            'name' => 'Member',
            'guard_name' => 'web',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 2. ADMIN ACCOUNT
        |--------------------------------------------------------------------------
        */

        $admin = User::updateOrCreate(
            ['email' => 'admin@volunteams.com'],
            [
                'name' => 'Saif Joudeh (Admin)',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        $admin->syncRoles([$adminRole]);


        /*
        |--------------------------------------------------------------------------
        | 3. TEAM MANAGERS
        |--------------------------------------------------------------------------
        */

        $managerData = [
            [
                'name' => 'Bashar Al-Torah (Manager)',
                'email' => 'manager@volunteams.com',
            ],
            [
                'name' => 'Ahmad Khalil (Manager)',
                'email' => 'manager2@volunteams.com',
            ],
            [
                'name' => 'Omar Hassan (Manager)',
                'email' => 'manager3@volunteams.com',
            ],
            [
                'name' => 'Lina Ahmad (Manager)',
                'email' => 'manager4@volunteams.com',
            ],
            [
                'name' => 'Yousef Saleh (Manager)',
                'email' => 'manager5@volunteams.com',
            ],
        ];

        $managers = collect();

        foreach ($managerData as $data) {
            $manager = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                ]
            );

            $manager->syncRoles([$managerRole]);

            $managers->push($manager);
        }


        /*
        |--------------------------------------------------------------------------
        | 4. 30 VOLUNTEER MEMBERS
        |--------------------------------------------------------------------------
        */

        $memberNames = [
            ['Volunteer Member', 'member@volunteams.com'],
            ['Omar Ahmad', 'omar@volunteams.com'],
            ['Yazan Ali', 'yazan@volunteams.com'],
            ['Lina Khaled', 'lina@volunteams.com'],
            ['Sara Mohammad', 'sara@volunteams.com'],
            ['Noor Ibrahim', 'noor@volunteams.com'],
            ['Ahmad Saleh', 'ahmad.saleh@volunteams.com'],
            ['Mohammad Nasser', 'mohammad.nasser@volunteams.com'],
            ['Rana Khalil', 'rana.khalil@volunteams.com'],
            ['Dana Samir', 'dana.samir@volunteams.com'],
            ['Khaled Omar', 'khaled.omar@volunteams.com'],
            ['Maya Tarek', 'maya.tarek@volunteams.com'],
            ['Zaid Hassan', 'zaid.hassan@volunteams.com'],
            ['Leen Ahmad', 'leen.ahmad@volunteams.com'],
            ['Hala Youssef', 'hala.youssef@volunteams.com'],
            ['Tareq Ali', 'tareq.ali@volunteams.com'],
            ['Reem Mahmoud', 'reem.mahmoud@volunteams.com'],
            ['Sami Adel', 'sami.adel@volunteams.com'],
            ['Farah Nabil', 'farah.nabil@volunteams.com'],
            ['Laith Hamdan', 'laith.hamdan@volunteams.com'],
            ['Jana Ibrahim', 'jana.ibrahim@volunteams.com'],
            ['Omar Khalaf', 'omar.khalaf@volunteams.com'],
            ['Nouran Saeed', 'nouran.saeed@volunteams.com'],
            ['Bilal Ahmad', 'bilal.ahmad@volunteams.com'],
            ['Razan Khalil', 'razan.khalil@volunteams.com'],
            ['Yousef Samir', 'yousef.samir@volunteams.com'],
            ['Malak Hassan', 'malak.hassan@volunteams.com'],
            ['Alaa Nasser', 'alaa.nasser@volunteams.com'],
            ['Kareem Saleh', 'kareem.saleh@volunteams.com'],
            ['Dima Omar', 'dima.omar@volunteams.com'],
        ];

        $members = collect();

        foreach ($memberNames as $data) {
            $member = User::updateOrCreate(
                ['email' => $data[1]],
                [
                    'name' => $data[0],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'is_demo_member' => $data[1] === 'member@volunteams.com',
                ]
            );

            $member->syncRoles([$memberRole]);

            $members->push($member);
        }


        /*
        |--------------------------------------------------------------------------
        | 5. TEAMS
        |--------------------------------------------------------------------------
        */

        $teamDefinitions = [
            [
                'name' => 'Green Volunteers Team',
                'manager' => $managers[0],
                'description' => 'A volunteer team focused on environmental activities, clean-up campaigns, and sustainability awareness.',
                'email' => 'green@volunteams.com',
                'phone' => '+962790000001',
                'address' => 'Amman, Jordan',
            ],
            [
                'name' => 'Community Support Team',
                'manager' => $managers[0],
                'description' => 'A team dedicated to community support, social initiatives, and helping local organizations.',
                'email' => 'community@volunteams.com',
                'phone' => '+962790000002',
                'address' => 'Amman, Jordan',
            ],
            [
                'name' => 'Education & Skills Team',
                'manager' => $managers[1],
                'description' => 'A volunteer team supporting educational activities, workshops, and knowledge-sharing initiatives.',
                'email' => 'education@volunteams.com',
                'phone' => '+962790000003',
                'address' => 'Amman, Jordan',
            ],
            [
                'name' => 'Health & Awareness Team',
                'manager' => $managers[2],
                'description' => 'A team focused on health awareness, public education, and community wellness initiatives.',
                'email' => 'health@volunteams.com',
                'phone' => '+962790000004',
                'address' => 'Amman, Jordan',
            ],
            [
                'name' => 'Youth Development Team',
                'manager' => $managers[3],
                'description' => 'A team that supports youth development, leadership activities, and community engagement.',
                'email' => 'youth@volunteams.com',
                'phone' => '+962790000005',
                'address' => 'Amman, Jordan',
            ],
            [
                'name' => 'Digital Volunteering Team',
                'manager' => $managers[4],
                'description' => 'A team focused on remote volunteering, digital skills, technology support, and online initiatives.',
                'email' => 'digital@volunteams.com',
                'phone' => '+962790000006',
                'address' => 'Online / Jordan',
            ],
        ];

        $teams = collect();

        foreach ($teamDefinitions as $definition) {
            $team = Team::updateOrCreate(
                ['name' => $definition['name']],
                [
                    'manager_id' => $definition['manager']->id,
                    'description' => $definition['description'],
                    'email' => $definition['email'],
                    'phone' => $definition['phone'],
                    'address' => $definition['address'],
                    'is_active' => true,
                ]
            );

            $teams->push($team);
        }


        /*
        |--------------------------------------------------------------------------
        | 6. TEAM MEMBERSHIPS
        |--------------------------------------------------------------------------
        |
        | Every volunteer is connected to two teams.
        | This gives the Manager dashboards meaningful data.
        |
        */

        $teamMembersMap = [];

        foreach ($teams as $index => $team) {
            $teamMembersMap[$team->id] = [];
        }

        foreach ($members as $index => $member) {
            $firstTeamIndex = $index % $teams->count();
            $secondTeamIndex = ($index + 1) % $teams->count();

            $assignedTeams = [
                $teams[$firstTeamIndex],
                $teams[$secondTeamIndex],
            ];

            foreach ($assignedTeams as $team) {
                $status = ($index % 10 === 0 && $team->id === $assignedTeams[1]->id)
                    ? 'pending'
                    : 'active';

                TeamMember::updateOrCreate(
                    [
                        'team_id' => $team->id,
                        'user_id' => $member->id,
                    ],
                    [
                        'status' => $status,
                        'joined_at' => $status === 'active'
                            ? Carbon::now()->subDays(10 + ($index * 2))
                            : null,
                    ]
                );

                $teamMembersMap[$team->id][] = $member;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | 7. OPPORTUNITIES
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        $opportunityDefinitions = [
            [
                'title' => 'Community Tree Planting Campaign',
                'team' => $teams[0],
                'description' => 'Join a community campaign to plant trees and promote environmental awareness in Amman.',
                'location' => 'Amman, Jordan',
                'type' => 'onsite',
                'start' => 14,
                'duration' => 5,
                'required' => 25,
                'hours' => 5,
                'status' => 'published',
                'active' => true,
            ],
            [
                'title' => 'Amman Community Clean-Up',
                'team' => $teams[0],
                'description' => 'Participate in a community clean-up activity and help create a cleaner public environment.',
                'location' => 'Amman, Jordan',
                'type' => 'onsite',
                'start' => 21,
                'duration' => 5,
                'required' => 20,
                'hours' => 5,
                'status' => 'published',
                'active' => true,
            ],
            [
                'title' => 'Community Support Initiative',
                'team' => $teams[1],
                'description' => 'Support a local community initiative by assisting organizers and participants.',
                'location' => 'Amman, Jordan',
                'type' => 'hybrid',
                'start' => 28,
                'duration' => 5,
                'required' => 15,
                'hours' => 5,
                'status' => 'published',
                'active' => true,
            ],
            [
                'title' => 'Food Distribution Volunteer Day',
                'team' => $teams[1],
                'description' => 'Help organize and distribute food packages to families through a community initiative.',
                'location' => 'Zarqa, Jordan',
                'type' => 'onsite',
                'start' => 35,
                'duration' => 4,
                'required' => 18,
                'hours' => 4,
                'status' => 'published',
                'active' => true,
            ],
            [
                'title' => 'Digital Skills Workshop',
                'team' => $teams[2],
                'description' => 'Help organize and support a workshop focused on digital skills and practical technology knowledge.',
                'location' => 'Online',
                'type' => 'remote',
                'start' => 42,
                'duration' => 3,
                'required' => 10,
                'hours' => 3,
                'status' => 'published',
                'active' => true,
            ],
            [
                'title' => 'University Study Support',
                'team' => $teams[2],
                'description' => 'Support students through educational guidance, study sessions, and peer learning.',
                'location' => 'Amman, Jordan',
                'type' => 'onsite',
                'start' => 49,
                'duration' => 4,
                'required' => 12,
                'hours' => 4,
                'status' => 'published',
                'active' => true,
            ],
            [
                'title' => 'Health Awareness Campaign',
                'team' => $teams[3],
                'description' => 'Participate in a community campaign promoting health awareness and healthy habits.',
                'location' => 'Amman, Jordan',
                'type' => 'onsite',
                'start' => 56,
                'duration' => 5,
                'required' => 20,
                'hours' => 5,
                'status' => 'published',
                'active' => true,
            ],
            [
                'title' => 'Community Wellness Workshop',
                'team' => $teams[3],
                'description' => 'Assist with a community wellness workshop and participant coordination.',
                'location' => 'Irbid, Jordan',
                'type' => 'hybrid',
                'start' => 63,
                'duration' => 4,
                'required' => 14,
                'hours' => 4,
                'status' => 'published',
                'active' => true,
            ],
            [
                'title' => 'Youth Leadership Program',
                'team' => $teams[4],
                'description' => 'Support a youth leadership program focused on teamwork, communication, and community engagement.',
                'location' => 'Amman, Jordan',
                'type' => 'onsite',
                'start' => 70,
                'duration' => 6,
                'required' => 20,
                'hours' => 6,
                'status' => 'published',
                'active' => true,
            ],
            [
                'title' => 'Student Leadership Meetup',
                'team' => $teams[4],
                'description' => 'Help coordinate a student leadership meetup and networking activity.',
                'location' => 'Amman, Jordan',
                'type' => 'onsite',
                'start' => 77,
                'duration' => 4,
                'required' => 15,
                'hours' => 4,
                'status' => 'published',
                'active' => true,
            ],
            [
                'title' => 'Remote Technology Support',
                'team' => $teams[5],
                'description' => 'Provide remote technical support and assistance for community digital initiatives.',
                'location' => 'Online',
                'type' => 'remote',
                'start' => 84,
                'duration' => 3,
                'required' => 12,
                'hours' => 3,
                'status' => 'draft',
                'active' => true,
            ],
            [
                'title' => 'Youth Awareness Event',
                'team' => $teams[4],
                'description' => 'Historical volunteer event used for demonstrating completed activities and reports.',
                'location' => 'Amman, Jordan',
                'type' => 'onsite',
                'start' => -45,
                'duration' => 5,
                'required' => 30,
                'hours' => 5,
                'status' => 'completed',
                'active' => false,
            ],
        ];

        $opportunities = collect();

        foreach ($opportunityDefinitions as $definition) {
            $startDate = $today->copy()->addDays($definition['start'])->setTime(9, 0);
            $endDate = $startDate->copy()->addHours($definition['duration']);
            $deadline = $startDate->copy()->subDays(4);

            $opportunity = Opportunity::updateOrCreate(
                ['title' => $definition['title']],
                [
                    'team_id' => $definition['team']->id,
                    'description' => $definition['description'],
                    'image_path' => null,
                    'location' => $definition['location'],
                    'type' => $definition['type'],
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'application_deadline' => $deadline,
                    'required_volunteers' => $definition['required'],
                    'hours' => $definition['hours'],
                    'status' => $definition['status'],
                    'is_active' => $definition['active'],
                ]
            );

            $opportunities->push($opportunity);
        }


        /*
        |--------------------------------------------------------------------------
        | 8. APPLICATIONS
        |--------------------------------------------------------------------------
        |
        | Four applications per opportunity.
        | Status distribution:
        | approved / pending / rejected / approved
        |
        */

        foreach ($opportunities as $opportunityIndex => $opportunity) {
            $teamMembers = $teamMembersMap[$opportunity->team_id] ?? [];

            if (count($teamMembers) < 4) {
                continue;
            }

            for ($i = 0; $i < 4; $i++) {
                $member = $teamMembers[($opportunityIndex + $i) % count($teamMembers)];

                $statuses = [
                    'approved',
                    'pending',
                    'rejected',
                    'approved',
                ];

                $status = $statuses[$i];

                Application::updateOrCreate(
                    [
                        'opportunity_id' => $opportunity->id,
                        'user_id' => $member->id,
                    ],
                    [
                        'reason' => 'I would like to contribute to this volunteer opportunity and gain meaningful community experience.',
                        'manager_notes' => $status === 'approved'
                            ? 'Application approved for participation.'
                            : ($status === 'rejected'
                                ? 'Application was not selected for this opportunity.'
                                : null),
                        'status' => $status,
                        'applied_at' => now()->subDays(
                            2 + (($opportunityIndex + $i) % 12)
                        ),
                    ]
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | 9. VOLUNTEER HOURS
        |--------------------------------------------------------------------------
        |
        | Remove only hours generated by this demo seeder,
        | then recreate them consistently.
        |
        */

        VolunteerHour::where('notes', 'like', '[DEMO]%')->delete();

        $historicalOpportunities = $opportunities->filter(
            fn ($opportunity) =>
                in_array($opportunity->status, ['completed', 'closed', 'published'])
                && $opportunity->start_date->isPast()
        );

        $hourCounter = 0;

        foreach ($historicalOpportunities as $opportunity) {
            $teamMembers = $teamMembersMap[$opportunity->team_id] ?? [];

            foreach (array_slice($teamMembers, 0, 4) as $member) {
                $hours = (float) $opportunity->hours;

                VolunteerHour::create([
                    'user_id' => $member->id,
                    'opportunity_id' => $opportunity->id,
                    'approved_by' => $opportunity->team->manager_id,
                    'hours' => $hours,
                    'date_logged' => $opportunity->start_date->toDateString(),
                    'notes' => '[DEMO] Verified volunteer hours for completed activity.',
                ]);

                $hourCounter++;

                if ($hourCounter >= 16) {
                    break 2;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | 10. CERTIFICATES
        |--------------------------------------------------------------------------
        */

        $certificateCounter = 1;

        foreach ($historicalOpportunities as $opportunity) {
            $approvedApplications = Application::where(
                'opportunity_id',
                $opportunity->id
            )
                ->where('status', 'approved')
                ->take(4)
                ->get();

            foreach ($approvedApplications as $application) {
                $code = sprintf(
                    'VT-DEMO-%03d',
                    $certificateCounter
                );

                Certificate::updateOrCreate(
                    [
                        'certificate_code' => $code,
                    ],
                    [
                        'user_id' => $application->user_id,
                        'opportunity_id' => $opportunity->id,
                        'issued_by' => $opportunity->team->manager_id,
                        'file_path' => 'certificates/demo/' . strtolower($code) . '.pdf',
                        'verification_url' => null,
                        'issued_at' => now()->subDays($certificateCounter),
                    ]
                );

                $certificateCounter++;

                if ($certificateCounter > 12) {
                    break 2;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | 11. ANNOUNCEMENTS
        |--------------------------------------------------------------------------
        */

        $announcementData = [
            [
                'title' => 'Welcome to VolunTeams',
                'content' => 'Welcome to VolunTeams. Explore volunteer opportunities, join teams, and track your volunteer journey.',
                'created_by' => $admin->id,
                'is_active' => true,
            ],
            [
                'title' => 'New Volunteer Opportunities Available',
                'content' => 'Several new volunteer opportunities are now available. Explore the opportunities section and submit your application.',
                'created_by' => $admin->id,
                'is_active' => true,
            ],
            [
                'title' => 'Volunteer Certificates',
                'content' => 'Certificates are issued to eligible volunteers after completing approved volunteer activities.',
                'created_by' => $managers[0]->id,
                'is_active' => true,
            ],
            [
                'title' => 'Community Service Update',
                'content' => 'Thank you to all volunteers participating in our community initiatives.',
                'created_by' => $managers[1]->id,
                'is_active' => true,
            ],
            [
                'title' => 'Upcoming Environmental Campaign',
                'content' => 'The next environmental volunteer campaign is now open for applications.',
                'created_by' => $managers[0]->id,
                'is_active' => true,
            ],
            [
                'title' => 'Digital Volunteering Opportunities',
                'content' => 'New remote volunteering activities are being prepared for volunteers interested in technology.',
                'created_by' => $managers[4]->id,
                'is_active' => true,
            ],
            [
                'title' => 'Volunteer Recognition',
                'content' => 'We appreciate the effort and dedication of all volunteers contributing to our initiatives.',
                'created_by' => $admin->id,
                'is_active' => true,
            ],
            [
                'title' => 'Previous Community Event',
                'content' => 'This announcement is kept as historical demonstration data.',
                'created_by' => $admin->id,
                'is_active' => false,
            ],
        ];

        foreach ($announcementData as $data) {
            Announcement::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }
    }
}