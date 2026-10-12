<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SDPC Static Asset / CDN Base URL
    |--------------------------------------------------------------------------
    |
    | By default, empty string uses local assets under public/assets/...
    | When moving videos/thumbnails to a CDN later, set SDPC_ASSET_CDN_URL
    | in .env (e.g., https://cdn.sdpcindore.com) without trailing slash.
    |
    */
    'asset_cdn_url' => rtrim(env('SDPC_ASSET_CDN_URL', ''), '/'),

    /*
    |--------------------------------------------------------------------------
    | Clinic & Doctor Profile Information (Verified Static Details)
    |--------------------------------------------------------------------------
    */
    'app_name' => 'SDPC',
    'clinic_full_name' => 'SDPC Physiotherapy & Rehabilitation Center',
    'tagline' => 'Move Free. Live Pain-Free.',

    'doctor' => [
        'name' => 'Dr. Mahesh Sahu',
        'specialty' => 'Physiotherapist',
        'rating' => '4.9',
        'reviews_count' => 211,
        'reviews_label' => '4.9 stars (211 Google reviews)',
        'phone_display' => '098933 62477',
        'phone_e164' => '+919893362477',
        'tel_link' => 'tel:+919893362477',
        'whatsapp_link' => 'https://wa.me/919893362477',
        'address' => '584C, near Briliant School, Khatiwala Tank, Indore, Madhya Pradesh 452014',
        'city' => 'Indore, Madhya Pradesh',
        'hours' => 'Open daily, closes at 9 PM',
        'map_link' => 'https://maps.google.com/?q=584C+near+Briliant+School+Khatiwala+Tank+Indore+452014',
        'profile_link' => 'https://www.skedoc.com/indore/doctor/dr-mahesh-sahu-physiotherapist',
        'photo' => '/assets/images/dr-mahesh-sahu.svg',
        'summary' => 'Dedicated physiotherapy care in Indore focused on personalized movement restoration, pain relief, post-surgical recovery, and long-term physical wellness.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Key Physiotherapy Benefits (Displayed on Home & About)
    |--------------------------------------------------------------------------
    */
    'benefits' => [
        [
            'title' => 'Targeted Pain Relief',
            'description' => 'Evidence-guided manual therapy, electro-modalities, and therapeutic exercises to address root causes of joint and muscle pain.',
            'icon' => 'bi-shield-check',
        ],
        [
            'title' => 'Improved Mobility & Posture',
            'description' => 'Restore natural joint range of motion, spinal alignment, and flexibility for effortless daily activities.',
            'icon' => 'bi-person-walking',
        ],
        [
            'title' => 'Faster Post-Surgery Recovery',
            'description' => 'Structured rehabilitation protocols after orthopedic or spinal procedures to rebuild strength safely.',
            'icon' => 'bi-heart-pulse',
        ],
        [
            'title' => 'Fall Prevention & Balance',
            'description' => 'Specialized vestibular and balance training for seniors and neurological recovery patients.',
            'icon' => 'bi-compass',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | All 19 Required Treatment Categories
    |--------------------------------------------------------------------------
    */
    'categories' => [
        [
            'slug' => 'acupuncture',
            'name' => 'Acupuncture',
            'icon' => 'bi-bullseye',
            'short_desc' => 'Targeted stimulation to ease muscular tension, trigger points, and chronic localized pain.',
            'featured' => false,
        ],
        [
            'slug' => 'aquatic-physiotherapy',
            'name' => 'Aquatic Physiotherapy',
            'icon' => 'bi-droplet-half',
            'short_desc' => 'Low-impact buoyancy-assisted movement guidance for sensitive joints and weight-bearing recovery.',
            'featured' => false,
        ],
        [
            'slug' => 'arthritis-treatment',
            'name' => 'Arthritis Treatment',
            'icon' => 'bi-bandaid',
            'short_desc' => 'Gentle joint mobilization, stiffness reduction, and protective strengthening for osteoarthritis and rheumatoid care.',
            'featured' => true,
        ],
        [
            'slug' => 'back-pain',
            'name' => 'Back Pain',
            'icon' => 'bi-person-standing',
            'short_desc' => 'Comprehensive lumbar and thoracic spine care for sciatica, disc bulge, and postural strain.',
            'featured' => true,
        ],
        [
            'slug' => 'balance-exercise-therapy',
            'name' => 'Balance Exercise Therapy',
            'icon' => 'bi-distribute-vertical',
            'short_desc' => 'Proprioceptive and stability exercises to improve coordination and prevent falls.',
            'featured' => false,
        ],
        [
            'slug' => 'foot-and-ankle-pain',
            'name' => 'Foot and Ankle Pain',
            'icon' => 'bi-footprints',
            'short_desc' => 'Rehabilitation for plantar fasciitis, ankle sprains, Achilles stiffness, and gait mechanics.',
            'featured' => false,
        ],
        [
            'slug' => 'geriatric-physiotherapy',
            'name' => 'Geriatric Physiotherapy',
            'icon' => 'bi-person-heart',
            'short_desc' => 'Age-friendly mobility, joint comfort, and functional independence programs for older adults.',
            'featured' => true,
        ],
        [
            'slug' => 'heat-therapy',
            'name' => 'Heat Therapy',
            'icon' => 'bi-thermometer-sun',
            'short_desc' => 'Therapeutic thermal modalities to boost circulation, relax spasms, and prepare tissues for stretching.',
            'featured' => false,
        ],
        [
            'slug' => 'hip-pain',
            'name' => 'Hip Pain',
            'icon' => 'bi-universal-access',
            'short_desc' => 'Targeted hip flexor, gluteal, and pelvic stabilization for bursitis, impingement, and stiffness.',
            'featured' => false,
        ],
        [
            'slug' => 'hydrotherapy-training',
            'name' => 'Hydrotherapy Training',
            'icon' => 'bi-water',
            'short_desc' => 'Water-resistance conditioning principles to improve endurance with minimal joint compression.',
            'featured' => false,
        ],
        [
            'slug' => 'knee-pain',
            'name' => 'Knee Pain',
            'icon' => 'bi-activity',
            'short_desc' => 'Quadriceps and hamstring biomechanics, patellar tracking, and ligament recovery programs.',
            'featured' => true,
        ],
        [
            'slug' => 'neurological-physiotherapy',
            'name' => 'Neurological Physiotherapy',
            'icon' => 'bi-diagram-3',
            'short_desc' => 'Neuro-rehabilitation for stroke recovery, nerve injuries, motor control, and functional retraining.',
            'featured' => true,
        ],
        [
            'slug' => 'paediatric-physiotherapy',
            'name' => 'Paediatric Physiotherapy',
            'icon' => 'bi-emoji-smile',
            'short_desc' => 'Supportive motor milestone development, posture care, and movement therapy for children.',
            'featured' => false,
        ],
        [
            'slug' => 'physical-therapy',
            'name' => 'Physical Therapy',
            'icon' => 'bi-heart-pulse-fill',
            'short_desc' => 'Holistic musculoskeletal assessment, manual therapy, and customized functional recovery plans.',
            'featured' => false,
        ],
        [
            'slug' => 'post-surgical-rehabilitation',
            'name' => 'Post-Surgical Rehabilitation',
            'icon' => 'bi-clipboard2-pulse',
            'short_desc' => 'Step-by-step recovery after joint replacement, ACL reconstruction, fracture fixation, or spine surgery.',
            'featured' => true,
        ],
        [
            'slug' => 'shoulder-pain',
            'name' => 'Shoulder Pain',
            'icon' => 'bi-arrows-move',
            'short_desc' => 'Rotator cuff strengthening, frozen shoulder mobilization, and scapular alignment therapy.',
            'featured' => true,
        ],
        [
            'slug' => 'spinal-injuries',
            'name' => 'Spinal Injuries',
            'icon' => 'bi-layers-half',
            'short_desc' => 'Careful spinal stabilization, decompression postures, and core support for cervical and lumbar care.',
            'featured' => false,
        ],
        [
            'slug' => 'therapeutic-exercise',
            'name' => 'Therapeutic Exercise',
            'icon' => 'bi-lightning-charge',
            'short_desc' => 'Guided progressive stretching, strengthening, and corrective home exercise routines.',
            'featured' => true,
        ],
        [
            'slug' => 'vestibular-rehabilitation',
            'name' => 'Vestibular Rehabilitation',
            'icon' => 'bi-arrow-repeat',
            'short_desc' => 'Gaze stabilization and habituation exercises for vertigo, dizziness, and inner-ear balance disorders.',
            'featured' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Predefined Physiotherapy Videos Library
    |--------------------------------------------------------------------------
    |
    | Note: 'is_sample_demo' clearly marks whether an embedded procedural canvas/MP4
    | sample stream is used when a clinic recording hasn't been dropped into
    | public/assets/videos/ yet.
    |
    */
    'videos' => [
        [
            'slug' => 'lower-back-pain-relief-core-stretches',
            'title' => 'Lower Back Pain Relief & Gentle Lumbar Stretches',
            'category' => 'Back Pain',
            'category_slug' => 'back-pain',
            'short_description' => 'Safe daily pelvic tilts, knee-to-chest stretches, and lumbar decompression movements for lower back stiffness.',
            'full_description' => 'This guided session demonstrates foundational lower back mobility exercises designed to reduce morning stiffness, ease postural lumbar tension, and gently engage deep core stabilizers. Ideal for desk workers and individuals recovering from mild mechanical back strain.',
            'duration' => '06:45',
            'published_date' => '2026-09-28',
            'thumbnail' => '/assets/videos/thumbnails/back-pain.svg',
            'video_file' => '/assets/videos/back-pain-demo.mp4',
            'has_local_mp4' => false,
            'sample_badge' => 'Sample Rehab Demonstration',
            'featured' => true,
            'benefits' => [
                'Reduces muscular tightness across the lumbar spine',
                'Improves pelvic mobility and spinal alignment',
                'Supports gentle circulation to lower back tissues',
            ],
            'safety_instructions' => [
                'Perform all movements slowly on a firm mat or carpeted floor.',
                'Stop immediately if you feel sharp, radiating pain down your legs (sciatica).',
                'Breathe naturally and avoid holding your breath during stretches.',
            ],
            'steps' => [
                'Lie on your back with knees bent and feet flat on the mat.',
                'Gently flatten your lower back against the floor (Pelvic Tilt) and hold for 5 seconds.',
                'Bring one knee slowly toward your chest, keeping the other foot planted, for 15–20 seconds.',
            ],
        ],
        [
            'slug' => 'knee-strengthening-osteoarthritis-care',
            'title' => 'Knee Strengthening & Joint Protection Routine',
            'category' => 'Knee Pain',
            'category_slug' => 'knee-pain',
            'short_description' => 'Low-impact quadriceps setting, straight-leg raises, and seated knee extensions to support knee stability.',
            'full_description' => 'Strong muscles around the knee joint absorb daily shock and protect cartilage. This structured sequence focuses on isometric quad sets, controlled straight-leg raises, and gentle range-of-motion exercises suitable for knee pain and early arthritis management.',
            'duration' => '08:15',
            'published_date' => '2026-10-04',
            'thumbnail' => '/assets/videos/thumbnails/knee-pain.svg',
            'video_file' => '/assets/videos/knee-pain-demo.mp4',
            'has_local_mp4' => false,
            'sample_badge' => 'Sample Rehab Demonstration',
            'featured' => true,
            'benefits' => [
                'Strengthens the quadriceps without excessive joint shear',
                'Enhances patellar tracking and knee joint stability',
                'Helps ease stiffness when climbing stairs or standing up',
            ],
            'safety_instructions' => [
                'Do not lock or hyperextend your knee forcefully.',
                'Keep movements smooth and controlled—avoid jerky kicks.',
                'Consult Dr. Mahesh Sahu before adding ankle weights.',
            ],
            'steps' => [
                'Sit upright with your leg extended and a small rolled towel under the knee.',
                'Press the back of your knee gently down into the towel to tighten the thigh muscle for 5 seconds.',
                'Follow with slow seated knee extensions holding for 3 seconds at the top.',
            ],
        ],
        [
            'slug' => 'frozen-shoulder-pendulum-wall-mobility',
            'title' => 'Frozen Shoulder Mobility & Pendulum Exercises',
            'category' => 'Shoulder Pain',
            'category_slug' => 'shoulder-pain',
            'short_description' => 'Gentle Codman pendulum swings, finger wall-walks, and scapular setting for stiff or painful shoulders.',
            'full_description' => 'Adhesive capsulitis (frozen shoulder) and rotator cuff stiffness respond best to consistent, pain-free mobilization. This guide covers gravity-assisted pendulum swings and progressive wall finger-walks to restore overhead reach safely.',
            'duration' => '05:30',
            'published_date' => '2026-09-15',
            'thumbnail' => '/assets/videos/thumbnails/shoulder-pain.svg',
            'video_file' => '/assets/videos/shoulder-pain-demo.mp4',
            'has_local_mp4' => false,
            'sample_badge' => 'Sample Rehab Demonstration',
            'featured' => true,
            'benefits' => [
                'Uses gravity to gently distract and lubricate the shoulder joint',
                'Gradually improves forward flexion and abduction range',
                'Reduces compensatory neck and upper-trap tension',
            ],
            'safety_instructions' => [
                'Let your arm hang completely relaxed during pendulum circles.',
                'Walk your fingers up the wall only to the point of a mild stretch, never sharp pain.',
                'Keep your shoulders relaxed away from your ears.',
            ],
            'steps' => [
                'Lean forward slightly supporting your unaffected arm on a table.',
                'Gently sway your body so the affected arm moves in small 15cm circles for 1 minute.',
                'Stand facing a wall and walk your fingers slowly upward, marking your daily progress.',
            ],
        ],
        [
            'slug' => 'post-surgical-joint-recovery-early-mobility',
            'title' => 'Post-Surgical Early Ankle Pumps & Circulation Protocol',
            'category' => 'Post-Surgical Rehabilitation',
            'category_slug' => 'post-surgical-rehabilitation',
            'short_description' => 'Essential early-stage circulation, ankle dorsiflexion pumps, and gentle isometric activation after orthopedic surgery.',
            'full_description' => 'During early post-surgical rehabilitation, maintaining healthy blood flow and preventing joint stiffness are top priorities. This educational guide covers gentle ankle pumps, heel slides, and deep breathing techniques commonly prescribed in early recovery.',
            'duration' => '07:10',
            'published_date' => '2026-08-22',
            'thumbnail' => '/assets/videos/thumbnails/post-surgical.svg',
            'video_file' => '/assets/videos/post-surgical-demo.mp4',
            'has_local_mp4' => false,
            'sample_badge' => 'Sample Rehab Demonstration',
            'featured' => false,
            'benefits' => [
                'Promotes lower-limb venous return and reduces swelling',
                'Maintains ankle and knee joint gliding during bed rest',
                'Prepares muscles for progressive weight-bearing phases',
            ],
            'safety_instructions' => [
                'Always follow your surgeon and physiotherapist’s specific weight-bearing restrictions.',
                'Do not remove surgical braces or dressings unless instructed.',
                'Report any unusual calf swelling, redness, or fever immediately.',
            ],
            'steps' => [
                'Lie comfortably with legs supported on pillows as advised.',
                'Point your toes slowly upward toward your shin, then downward away from you 15 times every hour.',
                'Perform gentle gluteal and thigh squeezes for 5 seconds each.',
            ],
        ],
        [
            'slug' => 'arthritis-hand-wrist-joint-warmups',
            'title' => 'Arthritis Joint Warm-Up & Morning Stiffness Relief',
            'category' => 'Arthritis Treatment',
            'category_slug' => 'arthritis-treatment',
            'short_description' => 'Smooth, low-load active range-of-motion movements to ease morning joint stiffness and nourish cartilage.',
            'full_description' => 'Synovial fluid circulates best when joints move gently through their comfortable range. This routine provides a calm, rhythmic sequence for wrists, fingers, knees, and ankles to ease morning arthritis stiffness.',
            'duration' => '05:50',
            'published_date' => '2026-07-19',
            'thumbnail' => '/assets/videos/thumbnails/arthritis.svg',
            'video_file' => '/assets/videos/arthritis-demo.mp4',
            'has_local_mp4' => false,
            'sample_badge' => 'Sample Rehab Demonstration',
            'featured' => false,
            'benefits' => [
                'Eases morning joint stiffness within 5–10 minutes',
                'Encourages natural synovial fluid lubrication',
                'Protects delicate finger, wrist, and knee joints',
            ],
            'safety_instructions' => [
                'During an acute inflammatory flare-up (hot, swollen joint), reduce repetitions and avoid resistance.',
                'Consider applying a warm compress for 10 minutes before starting.',
                'Move smoothly without forcing end-range pressure.',
            ],
            'steps' => [
                'Begin seated comfortably with forearms supported.',
                'Gently make a loose fist, then spread fingers wide 10 times.',
                'Perform slow ankle circles and seated knee marches for 1 minute each.',
            ],
        ],
        [
            'slug' => 'vestibular-balance-gaze-stabilization',
            'title' => 'Balance & Vestibular Gaze Stabilization Routine',
            'category' => 'Vestibular Rehabilitation',
            'category_slug' => 'vestibular-rehabilitation',
            'short_description' => 'Seated and standing balance retraining with VOR (vestibulo-ocular reflex) focus exercises for steadiness.',
            'full_description' => 'Designed for patients experiencing mild unsteadiness or recovering from inner-ear balance issues, this session introduces safe seated gaze stabilization and supported standing weight shifts.',
            'duration' => '06:20',
            'published_date' => '2026-10-09',
            'thumbnail' => '/assets/videos/thumbnails/balance-vestibular.svg',
            'video_file' => '/assets/videos/vestibular-demo.mp4',
            'has_local_mp4' => false,
            'sample_badge' => 'Sample Rehab Demonstration',
            'featured' => true,
            'benefits' => [
                'Improves visual focus during head movements',
                'Builds confidence and postural stability while standing',
                'Supports fall prevention in daily environments',
            ],
            'safety_instructions' => [
                'Always stand near a sturdy counter, wall, or chair back—and have a family member nearby if prone to dizziness.',
                'Pause and sit down until symptoms settle if mild dizziness occurs.',
                'Perform in a well-lit room free of floor rugs or tripping hazards.',
            ],
            'steps' => [
                'Sit upright and hold a thumb or target card at arm’s length in front of your eyes.',
                'Keep your eyes focused on the target while gently turning your head side-to-side for 30 seconds.',
                'Practice supported tandem stance (one foot slightly ahead of the other) near a stable support.',
            ],
        ],
        [
            'slug' => 'cervical-spine-neck-posture-therapeutic-exercise',
            'title' => 'Cervical Chin Tucks & Neck Posture Correction',
            'category' => 'Therapeutic Exercise',
            'category_slug' => 'therapeutic-exercise',
            'short_description' => 'Correct forward-head posture and upper trapezius strain with deep neck flexor activation and scapular retractions.',
            'full_description' => 'Long hours on phones and computers place heavy stress on the cervical spine. Learn how to perform proper chin tucks, levator scapulae stretches, and shoulder blade squeezes to relieve neck and upper back fatigue.',
            'duration' => '04:55',
            'published_date' => '2026-06-11',
            'thumbnail' => '/assets/videos/thumbnails/therapeutic-exercise.svg',
            'video_file' => '/assets/videos/neck-posture-demo.mp4',
            'has_local_mp4' => false,
            'sample_badge' => 'Sample Rehab Demonstration',
            'featured' => false,
            'benefits' => [
                'Counteracts tech-neck and forward-head posture',
                'Strengthens deep cervical flexor muscles',
                'Relieves tension headaches and upper shoulder tightness',
            ],
            'safety_instructions' => [
                'Draw your chin straight back horizontally—do not tilt your head down toward your chest.',
                'Avoid pulling forcefully on your head during side neck stretches.',
                'Stop if you feel tingling or numbness in your arms or fingers.',
            ],
            'steps' => [
                'Sit tall looking straight ahead with ears aligned over your shoulders.',
                'Gently glide your chin straight backward (making a subtle double chin) and hold for 5 seconds.',
                'Squeeze your shoulder blades gently together and down for 10 repetitions.',
            ],
        ],
        [
            'slug' => 'foot-ankle-plantar-fasciitis-rehab',
            'title' => 'Foot & Ankle Mobility for Plantar Fasciitis & Sprains',
            'category' => 'Foot and Ankle Pain',
            'category_slug' => 'foot-and-ankle-pain',
            'short_description' => 'Towel curls, calf stretches, and plantar fascia arch massage techniques for heel and ankle comfort.',
            'full_description' => 'Heel pain in the morning and recurring ankle stiffness often stem from tight calf muscles and weakened intrinsic foot arches. This video walks through daily arch strengthening and calf flexibility drills.',
            'duration' => '05:40',
            'published_date' => '2026-09-02',
            'thumbnail' => '/assets/videos/thumbnails/foot-ankle.svg',
            'video_file' => '/assets/videos/foot-ankle-demo.mp4',
            'has_local_mp4' => false,
            'sample_badge' => 'Sample Rehab Demonstration',
            'featured' => false,
            'benefits' => [
                'Relieves plantar fascia tension under the heel and arch',
                'Improves ankle dorsiflexion and calf flexibility',
                'Strengthens intrinsic foot muscles for better arch support',
            ],
            'safety_instructions' => [
                'Keep your back heel flat on the floor during standing calf stretches.',
                'Use gentle pressure when rolling your foot arch over a ball or bottle.',
                'Wear supportive footwear when walking on hard floors.',
            ],
            'steps' => [
                'Sit and cross your affected foot over the opposite knee, gently pulling the toes back to stretch the arch for 20 seconds.',
                'Place a small towel on the floor and scrunch it toward you using only your toes.',
                'Perform a standing wall calf stretch for 30 seconds on each side.',
            ],
        ],
    ],
];
