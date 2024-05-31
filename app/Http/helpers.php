<?php

    use App\Models\User;

    function statusReturn($prefix, $statuses, $status = null, $type = null)
    {

        if(isset($statuses[$prefix])) {
            $statusArray = $statuses[$prefix];

            return isset($statusArray[$status])
                ? ($type === 'badge' ? $statusArray[$status][1] : $statusArray[$status][0])
                : ($type === 'badge' ? array_column($statusArray, 1) : array_column($statusArray, 0));

        } else {
            return ''; // Or handle the case when $prefix is not found in $statuses
        }
    }

    function getEmployee(){
        return User::select('id', 'first_name', 'last_name')->get();
    }

    function getGenStatus($prefix, $status = null, $type = null)
    {
        $statuses = [
            'general'=> [
                '1' => ['Active', '<span class="badge bg-primary-light">Active</span>'],
                '2' => ['Inactive', '<span class="badge bg-warning-light">Inactive</span>']
            ],
            'bool'=> [
                '1' => ['Yes', '<span class="badge bg-primary-light">Yes</span>'],
                '2' => ['No', '<span class="badge bg-warning-light">No</span>'],
                '3' => ['Not Known', '<span class="badge bg-secondary-light">Not Known</span>'],
            ]
        ];

        return statusReturn($prefix, $statuses, $status, $type );
    }

    function getUserStatus($prefix, $status = null, $type = null)
    {
        $statuses = [
            'type'=> [
                '1' => ['Admin', '<span class="badge bg-primary-light">Admin</span>'],
                '2' => ['Shop', '<span class="badge bg-warning-light">Shop</span>'],
                '3' => ['Customer', '<span class="badge bg-success-light">Customer</span>']
            ],
        ];

        return statusReturn($prefix, $statuses, $status, $type );
    }

    function getPlatforms($prefix, $status = null, $type = null)
    {
        $statuses = [
            'social' => [
                '1' => ['Webchat', '<span class="badge bg-primary-light">Webchat</span>'],
                '2' => ['Messaging', '<span class="badge bg-warning-light">Messaging</span>'],
                '3' => ['ASS', '<span class="badge bg-success-light">ASS</span>']
            ],
            'usage' => [
                '1' => ['Live Journal', '<span class="badge bg-primary-light">Live Journal</span>'],
                '2' => ['A Distraction', '<span class="badge bg-warning-light">A Distraction</span>'],
                '3' => ['To Offload', '<span class="badge bg-success-light">To Offload</span>'],
                '4' => ['To Find Support', '<span class="badge bg-info-light">To Find Support</span>'],
                '5' => ['Cry For Help', '<span class="badge bg-danger-light">Cry For Help</span>'],
                '6' => ['Not Known', '<span class="badge bg-light">Not Known</span>'],
            ],
            'service_awareness' => [
                '1' => ['Internet Search', '<span class="badge bg-primary-light">Internet Search</span>'],
                '2' => ['Printed Media', '<span class="badge bg-warning-light">Printed Media</span>'],
                '3' => ['Signposted By Educational Facility', '<span class="badge bg-success-light">Signposted By Educational Facility</span>'],
                '4' => ['Signposted By NHS/Police', '<span class="badge bg-info-light">Signposted By NHS/Police</span>'],
                '5' => ['Social Media', '<span class="badge bg-danger-light">Social Media</span>'],
                '6' => ['TV/Radio', '<span class="badge bg-secondary-light">TV/Radio</span>'],
                '7' => ['Word Of Mouth', '<span class="badge bg-dark-light">Word Of Mouth</span>'],
                '8' => ['Not Known', '<span class="badge bg-light">Not Known</span>'],
                '9' => ['Other', '<span class="badge bg-primary">Other</span>']
            ],
            'outcomes' => [
                '1' => ['Action Plan', '<span class="badge bg-primary-light">Action Plan</span>'],
                '2' => ['Discussion Of Current Concerns / Reframing', '<span class="badge bg-warning-light">Discussion Of Current Concerns / Reframing</span>'],
                '3' => ['Distractions Offered', '<span class="badge bg-success-light">Distractions Offered</span>'],
                '4' => ['Emergency Services Called', '<span class="badge bg-info-light">Emergency Services Called</span>'],
                '5' => ['Ends Unexpectedly', '<span class="badge bg-danger-light">Ends Unexpectedly</span>'],
                '6' => ['Improved Mood', '<span class="badge bg-secondary-light">Improved Mood</span>'],
                '7' => ['Info Given', '<span class="badge bg-dark-light">Info Given</span>'],
                '8' => ['Self-Harm Prevented Today', '<span class="badge bg-light">Self-Harm Prevented Today</span>'],
                '9' => ['Signposted To Another Service', '<span class="badge bg-primary">Signposted To Another Service</span>'],
                '10' => ['Signposted To Rightlines Services', '<span class="badge bg-warning">Signposted To Rightlines Services</span>'],
                '11' => ['Thanks To Rightlines "I Don’t Need To Message Now"', '<span class="badge bg-success">Thanks To Rightlines "I Don’t Need To Message Now"</span>'],
                '12' => ['Understanding & Support Provided', '<span class="badge bg-info">Understanding & Support Provided</span>'],
                '13' => ['YP Offers Involvement With Rightlines Eg Poem, Post, Story', '<span class="badge bg-danger">YP Offers Involvement With Rightlines Eg Poem, Post, Story</span>'],
                '14' => ['N/A', '<span class="badge bg-light">N/A</span>'],
            ]
        ];

        return statusReturn($prefix, $statuses, $status, $type );
    }

    function getAgeBand($prefix, $status = null, $type = null)
    {
        $statuses = [
            'age' => [
                '1' => ['0-12', '<span class="badge bg-primary-light">0-12</span>'],
                '2' => ['13-15', '<span class="badge bg-primary-light">13-15</span>'],
                '3' => ['16-18', '<span class="badge bg-primary-light">16-18</span>'],
                '4' => ['19-25', '<span class="badge bg-primary-light">19-25</span>'],
                '5' => ['26-30', '<span class="badge bg-primary-light">26-30</span>'],
                '6' => ['31-35', '<span class="badge bg-primary-light">31-35</span>'],
                '7' => ['36+', '<span class="badge bg-primary-light">36+</span>'],
                '8' => ['Not Known', '<span class="badge bg-primary-light">Not Known</span>'],
            ]
        ];

        return statusReturn($prefix, $statuses, $status, $type);
    }

    function getGenderStatus($prefix, $status = null, $type = null)
    {
        $statuses = [
            'gender' => [
                '1' => ['Male', '<span class="badge bg-primary-light">Male</span>'],
                '2' => ['Female', '<span class="badge bg-warning-light">Female</span>'],
                '3' => ['Non-Binary', '<span class="badge bg-success-light">Non-Binary</span>'],
                '4' => ['Transgender', '<span class="badge bg-info-light">Transgender</span>'],
                '5' => ['Not Known', '<span class="badge bg-danger-light">Not Known</span>'],
                '6' => ['Uncertain', '<span class="badge bg-secondary-light">Uncertain</span>'],
                '7' => ['Other', '<span class="badge bg-dark-light">Other</span>']
            ],
            'sexuality' => [
                '1' => ['Straight', '<span class="badge bg-primary-light">Straight</span>'],
                '2' => ['Gay', '<span class="badge bg-warning-light">Gay</span>'],
                '3' => ['Bisexual', '<span class="badge bg-success-light">Bisexual</span>'],
                '4' => ['Asexual', '<span class="badge bg-info-light">Asexual</span>'],
                '5' => ['Not Known', '<span class="badge bg-danger-light">Not Known</span>'],
                '6' => ['Uncertain', '<span class="badge bg-secondary-light">Uncertain</span>'],
                '7' => ['Other', '<span class="badge bg-dark-light">Other</span>'],
                '8' => ['Prefer Not To Say', '<span class="badge bg-light">Prefer Not To Say</span>']
            ]
        ];

        return statusReturn($prefix, $statuses, $status, $type);
    }

    function getIssues($prefix, $status = null, $type = null)
    {
        $statuses = [
            'diagnose' => [
                '1' => ['ADHD', '<span class="badge bg-primary-light">ADHD</span>'],
                '2' => ['Anxiety', '<span class="badge bg-warning-light">Anxiety</span>'],
                '3' => ['Autistic Spectrum', '<span class="badge bg-success-light">Autistic Spectrum</span>'],
                '4' => ['Depression', '<span class="badge bg-info-light">Depression</span>'],
                '5' => ['Eating Disorder', '<span class="badge bg-danger-light">Eating Disorder</span>'],
                '6' => ['OCD', '<span class="badge bg-secondary-light">OCD</span>'],
                '7' => ['Personality Disorder', '<span class="badge bg-dark-light">Personality Disorder</span>'],
                '8' => ['PTSD', '<span class="badge bg-light">PTSD</span>'],
                '9' => ['Sleep Issues', '<span class="badge bg-primary-light">Sleep Issues</span>'],
                '10' => ['None Stated', '<span class="badge bg-warning-light">None Stated</span>'],
                '11' => ['Other', '<span class="badge bg-success-light">Other</span>']
            ],
            'trigger' => [
                '1' => ['Education / Work Issues', '<span class="badge bg-primary-light">Education / Work Issues</span>'],
                '2' => ['Inability To Self Soothe', '<span class="badge bg-warning-light">Inability To Self Soothe</span>'],
                '3' => ['Issues In The Family', '<span class="badge bg-success-light">Issues In The Family</span>'],
                '4' => ['Other Mental Health Issues', '<span class="badge bg-info-light">Other Mental Health Issues</span>'],
                '5' => ['Own Negative Feelings', '<span class="badge bg-danger-light">Own Negative Feelings</span>'],
                '6' => ['Problems With Peers', '<span class="badge bg-secondary-light">Problems With Peers</span>'],
                '7' => ['Social Media', '<span class="badge bg-dark-light">Social Media</span>'],
                '8' => ['Other', '<span class="badge bg-light">Other</span>'],
                '9' => ['Not Known', '<span class="badge bg-light">Not Known</span>'],
            ],
            'specific' => [
                '1' => ['Education Work Or Training', '<span class="badge bg-primary-light">Education Work Or Training</span>'],
                '2' => ['Mental Health And Emotional Wellbeing', '<span class="badge bg-warning-light">Mental Health And Emotional Wellbeing</span>'],
                '3' => ['Family Problems', '<span class="badge bg-success-light">Family Problems</span>'],
                '4' => ['Abuse', '<span class="badge bg-info-light">Abuse</span>'],
                '5' => ['Relationship Issues - Friends / Partners', '<span class="badge bg-danger-light">Relationship Issues - Friends / Partners</span>'],
                '6' => ['Homelessness / Housing Issues', '<span class="badge bg-secondary-light">Homelessness / Housing Issues</span>'],
                '7' => ['Physical Health', '<span class="badge bg-dark-light">Physical Health</span>'],
                '8' => ['Not Known', '<span class="badge bg-light">Not Known</span>'],
            ],
            'self_harm' => [
                '1' => ['Attempts to End Life', '<span class="badge bg-primary-light">Attempts to End Life</span>'],
                '2' => ['Burning', '<span class="badge bg-warning-light">Burning</span>'],
                '3' => ['Cutting', '<span class="badge bg-success-light">Cutting</span>'],
                '4' => ['Denial Of Self Care And Nourishment', '<span class="badge bg-info-light">Denial Of Self Care And Nourishment</span>'],
                '5' => ['Not Disclosed', '<span class="badge bg-danger-light">Not Disclosed</span>'],
                '6' => ['Other', '<span class="badge bg-secondary-light">Other</span>'],
                '7' => ['Scratching', '<span class="badge bg-dark-light">Scratching</span>'],
                '8' => ['Self Poisoning', '<span class="badge bg-light">Self Poisoning</span>']
            ],
            'contact_type' => [
                '1' => ['Known, Self Harming', '<span class="badge bg-primary-light">Known, Self Harming</span>'],
                '2' => ['Known, Not Self Harming', '<span class="badge bg-warning-light">Known, Not Self Harming</span>'],
                '3' => ['New', '<span class="badge bg-success-light">New</span>'],
                '4' => ['Not Known', '<span class="badge bg-info-light">Not Known</span>'],
                '5' => ['Persistent', '<span class="badge bg-danger-light">Persistent</span>'],
                '6' => ['Returner', '<span class="badge bg-secondary-light">Returner</span>']
            ]
        ];

        return statusReturn($prefix, $statuses, $status, $type);
    }


    function getLocation($prefix, $status = null, $type = null)
    {
        $statuses = [
            'country' => [
                '1' => ['Abroad', '<span class="badge bg-primary-light">Abroad</span>'],
                '2' => ['England', '<span class="badge bg-warning-light">England</span>'],
                '3' => ['N Ireland', '<span class="badge bg-success-light">N Ireland</span>'],
                '4' => ['Not Known', '<span class="badge bg-info-light">Not Known</span>'],
                '5' => ['Scotland', '<span class="badge bg-danger-light">Scotland</span>'],
                '6' => ['Wales', '<span class="badge bg-secondary-light">Wales</span>']
            ]
        ];

        return statusReturn($prefix, $statuses, $status, $type);
    }


function getSituation($prefix, $status = null, $type = null)
{
    $statuses = [
        'personal' => [
            '1' => ['Feelings', '<span class="badge bg-primary-light">Feelings</span>'],
            '2' => ['Thoughts', '<span class="badge bg-warning-light">Thoughts</span>'],
            '3' => ['Triggers', '<span class="badge bg-success-light">Triggers</span>'],
            '4' => ['Choices', '<span class="badge bg-info-light">Choices</span>'],
            '5' => ['Lack Of Support - Family', '<span class="badge bg-danger-light">Lack Of Support - Family</span>'],
            '6' => ['Lack Of Support - Peers', '<span class="badge bg-secondary-light">Lack Of Support - Peers</span>'],
            '7' => ['Lack Of Support - Formal Services', '<span class="badge bg-dark-light">Lack Of Support - Formal Services</span>'],
            '8' => ['In Crisis', '<span class="badge bg-light">In Crisis</span>'],
            '9' => ['Not Known', '<span class="badge bg-light">Not Known</span>'],
        ]
    ];

    return statusReturn($prefix, $statuses, $status, $type);
}

function getPersonalSituationStatus1($prefix, $status = null, $type = null)
{
    $statuses = [
        'personal_situation' => [
            '1' => ['Feelings', '<span class="badge bg-primary-light">Feelings</span>'],
            '2' => ['Thoughts', '<span class="badge bg-warning-light">Thoughts</span>'],
            '3' => ['Triggers', '<span class="badge bg-success-light">Triggers</span>'],
            '4' => ['Choices', '<span class="badge bg-info-light">Choices</span>'],
        ]
    ];

    return statusReturn($prefix, $statuses, $status, $type);
}

?>
