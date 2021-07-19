<?php

namespace App;

use App\Models\Avatar;
use App\Models\Token;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BIOMIX
{
    const LOREM = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, assumenda
        consectetur dolore doloremque illo natus? Harum hic illo incidunt molestias qui?
        Dolores fuga iusto minima minus, nesciunt placeat quam voluptas!";
    public static $PROJECT_FEATURES = [
        ["icon" => "fa fa-laptop-medical", "name" => "Medical Diagnosis",
            "description" => "In this section you can insert your symptoms and get your disease depending on deep learning."],
        ["icon" => "fa fa-syringe", "name" => "Radiology Diagnosis",
            "description" => "In this section you can insert your scan image and get it's diagnosis."],
        ["icon" => "fa fa-hand-holding-medical", "name" => "Medical Advices",
            "description" => "In this section you can get your medical advices to improve your health."],
    ];
    public static $PROJECT_SUMMARY = "Biomix is an integrated system that will represent a bright spot in the medical field
        according to different features which can the project provided for both patients,
        doctors, and totally for the medical system. Biomix is a new way and technique that
        depends on modern technologies representing on Machine Learning, Robot Operating System
        and Android Development to predict diseases in which users insert them through
        interaction screens, measuring vital signs which help in prediction and Knowing the
        patient’s health condition, determine the type of cancer (Malignant or Benign) according
        to the input picture of X-Ray image and have a personal record for all the previous
        information for every patient have an account on our mobile application.";
    public static $USER_DASHBOARD_ELEMENTS = [
        ["name" => "Symptoms", "url" => "/user/symptoms", "icon" => "fa fa-head-side-cough"],
        ["name" => "Sensors and Readings", "url" => "/user/sensor-readings", "icon" => "fa fa-weight"],
        ["name" => "Breast Cancer", "url" => "/user/breast-cancer", "icon" => "fa fa-child"],
    ];

    public static $USER_GENDERS = ["Male", "Female", "Other"];
    public static $USER_ROLES = ["User", "Admin"];

    public static function getAvatarModelLatestID()
    {
        $record = Avatar::latest()->orderBy('id', 'DESC')->first();
        return $record ? ($record->id + 1) : 1;
    }

    public static function getSupervisors()
    {
        return [
            ["avatar" => (asset("assets/members/default.png")), "title" => "Doctor", "name" => "Mahmoud M. Saafan"],
            ["avatar" => (asset("assets/members/default.png")), "title" => "Assistant Lecturer", "name" => "Hossam Magdy Balaha"],
        ];
    }

    public static function getTeamMembers()
    {
        return [
            ["avatar" => (asset("assets/members/default.png")), "name" => "NAME HERE", "description" => "Team Leader"],
            ["avatar" => (asset("assets/members/default.png")), "name" => "NAME HERE", "description" => "Team Leader"],
            ["avatar" => (asset("assets/members/default.png")), "name" => "NAME HERE", "description" => "Team Leader"],
            ["avatar" => (asset("assets/members/default.png")), "name" => "NAME HERE", "description" => "Team Leader"],
            ["avatar" => (asset("assets/members/default.png")), "name" => "NAME HERE", "description" => "Team Leader"],
            ["avatar" => (asset("assets/members/default.png")), "name" => "NAME HERE", "description" => "Team Leader"],
            ["avatar" => (asset("assets/members/default.png")), "name" => "NAME HERE", "description" => "Team Leader"],
        ];
    }

    public static function getTokenModelLatestID()
    {
        $record = Token::latest()->orderBy('id', 'DESC')->first();
        return $record ? ($record->id + 1) : 1;
    }

    public static function getUserModelLatestID()
    {
        $record = User::latest()->orderBy('id', 'DESC')->first();
        return $record ? ($record->id + 1) : 1;
    }

    public static function makeAvatar($avatarFile)
    {
        if ($avatarFile) {
            $avatarName = md5(time()) . "." . $avatarFile->getClientOriginalExtension();
            Storage::disk('public')->put('assets/uploads/avatars/' . $avatarName, File::get($avatarFile));

            $newRecordID = Avatar::latest()->orderBy('id', 'DESC')->first();
            $newRecordID = $newRecordID ? ($newRecordID->id + 1) : 1;

            $newAvatar = new Avatar();
            $newAvatar->id = $newRecordID;
            $newAvatar->path = $avatarName;
            $newAvatar->extension = $avatarFile->getClientOriginalExtension();
            $newAvatar->size = File::size($avatarFile);
            $newAvatar->save();

            return $newAvatar;
        }
        return null;
    }
}

//    public static $USER_DISEASES = [
//        'Hay Fever', 'Eczema', 'Food Allergy', 'Bug-bite Allergy', 'Drug Allergy',
//        'Anaphylaxis', 'Asthama', 'Common Cold', 'Pneumonia', 'Sore Throat', 'arthritis',
//        'Osteoarthritis - Degenerative arthritis', 'Gout', 'Polymyalgia rheumatica',
//        'Necrotic inflammation', 'Keratitis', 'Closed angle glaucoma', 'Conjuctivitis, Pink Eye',
//        'Cataract', 'Sty', 'Trachoma', 'Irritable Bowel Syndrome', 'Hepatitis B', 'Celiac Disease',
//        'Hepatitis C', 'Ulcerative Colitis', 'Cirrhosis'
//    ];

//    public static $USER_SYMPTOMS = [
//        'congestion', 'runny nose', 'wheezing', 'pain in the nose', 'nasal Swelling', 'stuffy nose',
//        'itchy nose or throat', 'snoring', 'sneezing', 'decreased sense of smell', 'nose bleed', 'nose injury',
//        'tears', 'pain in the eye', 'blood congestion', 'red eyes', 'itchy eyes', 'yellowing of the eyes',
//        'poor vision', 'double vision', 'temporary loss of vision', 'mismatched pupils', 'eyelid twitching',
//        'skin changes in the eyelid', 'eyelid trembling', 'falling eyelids', 'eye glow', 'dry eyes',
//        'secretions in the eye', 'photosensitivity', 'blurred vision', 'poor night vision', 'red lump on the eye',
//        'eyelid swelling', 'stinging', 'bad breath', 'skin changes inside the mouth', 'dry mouth', 'toothache',
//        'chewing difficulty', 'gum pain', 'gum swelling', 'lip bleeding', 'unnaturally red tongue', 'burning tongue',
//        'cough', 'snoring', 'puking', 'spitting blood', 'loss of apetite', 'increased thirst', 'hard breathing',
//        'white spots on the tonsil', 'redness and swelling of the tonsils', 'mouth ulcers', 'dizziness',
//        'unconsciousness', 'nausea', 'facial pain', 'headache', 'fever', 'face Swelling', 'weak facial muscles',
//        'facial numbness', 'poor memory', 'hair loss', 'recent head injury', 'facial skin changes',
//        'neck pain', 'neck swelling', 'neck stiffnes', 'swwellin of neck veins', 'neck injury', 'throat swelling',
//        'throat pain', 'dry cough', 'cough with sputum', 'swallowing pain', 'difficulty swallowing', 'red throat',
//        'wheezing', 'runny mucus to the throat', 'itchy throat', 'hard breathing', 'enlarged lymph nodes', 'hard breathing',
//        'chest pain', 'painin the upper left corner', 'compressing pain', 'heartburn', 'heart palpitations',
//        'accelerated heartbeat', 'low heart rate', 'cough', 'rapid breathing', 'wheezing', 'chest injury', 'ear pain',
//        'hearing impairment', 'secretion leak from the ear', 'ear blockage', 'itchy ear', 'ear buzz', 'ear injury',
//        'itchy skin', 'skin peeling', 'skin redness', 'rash', 'shudder', 'skin yellowing', 'exhaustion',
//        'high temperature', 'weight Loss', 'bone pain', 'stiffness', 'bone swelling', 'decreased range of motion',
//        'joint pain', 'fluid accumulation in the joint', 'joint pain (intense)', 'muscular pain', 'stomachache',
//        'chronic diarrhea', 'chronic constipation', 'increased abdominal gases', 'flatulence', 'dark colored urine',
//        'diarrhea', 'constipation', 'excessive need to defecate', 'bloody diarrhea', 'anal bleeding'
//    ];
