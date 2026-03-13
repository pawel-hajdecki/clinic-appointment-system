<?php
namespace app\forms;

class DoctorForm {
    public $name;
    public $surname;
    public $photoUrl;
    public $description;
    public $specializations;
    public $newSpecializations;
    public $newSpecializationsRaw;

    public function __construct() {
        $this->specializations = [];
        $this->newSpecializations = [];
        $this->newSpecializationsRaw = '';
    }

    public function preload($doctor_tb) {
        if(!$doctor_tb) return;
        $this->name = $doctor_tb['name'] ?? null;
        $this->surname = $doctor_tb['surname'] ?? null;
        $this->photoUrl = $doctor_tb['photourl'] ?? null;
        $this->description = $doctor_tb['description'] ?? null;
    }
}
