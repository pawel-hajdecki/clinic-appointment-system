<?php
namespace app\services;

use app\transfer\User;
use app\transfer\VisitReason;
use app\transfer\Doctor;
use core\App;
use DateTime;
use app\transfer\Appointment;
use core\Utils;

class DatabaseUtils{
	public static function DB_toDateTime($datetime_str) {
       $format = 'Y-m-d H:i:s';
       $dateTime = DateTime::createFromFormat($format, $datetime_str);
       return $dateTime;
    }

    public static function DB_DateTimeToString($datetime) {
       $format = 'Y-m-d H:i:s';
       return $datetime->format($format);
    }

    public static function DB_NowToString() {
       return date('Y-m-d H:i:s');
    }

    public static function getVisitReasons($onlyEnabled = false): array{
        try {
            $where = ['ORDER' => ['visitreason.namevisitreason' => 'ASC']];
            if ($onlyEnabled) {
                $where['isenable'] = 1;
            }
            return array_map(
            function($visitReason) { return new VisitReason($visitReason); },
            App::getDB()->select('visitreason', [
                'visitreason.idvisitreason(visitReasonId)',
                'visitreason.namevisitreason(visitReasonName)',
                'isenable(isEnable)'
            ], $where));
        } catch (\Exception $e) {
            Utils::addErrorMessage("Wystąpił błąd podczas wczytywania przyczyn wizyt.");
            return [];
        }
    }

	public static function getDoctors($includeDescription = false, $includeSpecializations = false): array{
		try {
			$joins = [
				'[><]role_user' => ['iduser' => 'iduser'],
				'[><]role' => ['role_user.idrole' => 'idrole']
			];
			
			$columns = [
				'system_user.iduser(id)',
				'system_user.nameuser(name)',
				'system_user.surname',
				'system_user.photourl(photourl)'
			];
			
			if ($includeSpecializations) {
				$joins['[>]doctor_specialization'] = ['iduser' => 'iddoctor'];
				$joins['[>]specialization'] = ['doctor_specialization.idspecialization' => 'idspecialization'];
				$columns['specializations'] = App::getDB()->raw('GROUP_CONCAT(DISTINCT specialization.namespecialization ORDER BY specialization.namespecialization SEPARATOR \', \')');
			}
			
			if ($includeDescription) {
				$joins['[>]doctorinfo'] = ['iduser' => 'iduser'];
				$columns[] = 'doctorinfo.description';
			}
			
			return array_map(
				function($doctor) { return new Doctor($doctor); },
				App::getDB()->select('system_user', $joins, $columns, [
					'role.namerole' => 'doctor',
					'GROUP' => 'system_user.iduser',
					'role_user.withdrawaldatetime' => null,
					'ORDER' => ['system_user.surname' => 'ASC', 'system_user.nameuser' => 'ASC'],
				])
			);
		} catch (\Exception $e) {
            Utils::addErrorMessage("Wystąpił błąd podczas wczytywania listy lekarzy.");
			return [];
		}
	}

    public static function getPatients($onlyActive = false): array{
        try {
            $where = [
                'role.namerole' => 'patient',
                'role_user.withdrawaldatetime' => null,
                'ORDER' => ['system_user.surname' => 'ASC', 'system_user.nameuser' => 'ASC']
            ];
            if ($onlyActive) {
                $where['status.namestatus'] = 'active';
            }
            return array_map(
                function($patient) { return new User($patient); },
                App::getDB()->select('system_user', [
                    '[><]role_user' => ['iduser' => 'iduser'],
                    '[><]role' => ['role_user.idrole' => 'idrole'],
                    '[>]useraccountstatus(status)' => ['idstatus' => 'idstatus']
                ], [
                    'system_user.iduser(id)',
                    'system_user.nameuser(name)',
                    'system_user.surname',
                    'system_user.pesel',
                    'status.namestatus(status)'
                ], $where)
            );
        } catch (\Exception $e) {
            Utils::addErrorMessage("Wystąpił błąd podczas wczytywania listy pacjentów.");
            return [];
        }
    }

	public static function getReceptionists(): array{
		try {
			return array_map(
				function($user) { return new User($user); },
				App::getDB()->select('system_user', [
					'[><]role_user' => ['iduser' => 'iduser'],
					'[><]role' => ['role_user.idrole' => 'idrole'],
					'[>]useraccountstatus(status)' => ['idstatus' => 'idstatus']
				], [
					'system_user.iduser(id)',
					'system_user.nameuser(name)',
					'system_user.surname',
					'system_user.login',
					'status.namestatus(status)'
				], [
					'role.namerole' => 'receptionist',
					'role_user.withdrawaldatetime' => null,
					'ORDER' => ['system_user.surname' => 'ASC', 'system_user.nameuser' => 'ASC']
				])
			);
		} catch (\Exception $e) {
            Utils::addErrorMessage("Wystąpił błąd podczas wczytywania listy recepcjonistów.");
			return [];
		}
	}

    public static function cancellAppointment($id){
        try {
            App::getDB()->update('appointment', [
                'patientiduser' => null,
                'idvisitreason' => null,
                'reservedbyiduser' => null,
                'customvisitreason' => null,
                'reservationdatetime' => null,
                'isavailable' => true
            ], [
                'idappointment' => $id
            ]);
        } catch (\Exception $e) {
            Utils::addErrorMessage("Wystąpił błąd podczas anulowania wizyty.");
        }
    }

    public static function getDoctorsAvailableAppointments($doctorId){
        try {
            return array_map(
                function ($appointment) { return new Appointment($appointment);},
                App::getDB()->select('appointment',
                [
                    'idappointment(id)',
                    'startdatetime(startDatetime)',
                    'enddatetime(endDatetime)'
                ], [
                    'startdatetime[>]' => self::DB_NowToString(),
                    'isavailable' => (int)true,
                    'iddoctor' => $doctorId,
                    'ORDER' => ['startdatetime' => 'ASC']
                ]));
        } catch (\Exception $e) {
            Utils::addErrorMessage("Wystąpił błąd podczas wczytywania dostępnych terminów.");
            return [];
        }
    }

	public static function getRoleIdByName($roleName){
		try {
			return App::getDB()->get('role', 'idrole', [
					'namerole' => $roleName
				]);
		} catch (\Exception $e) {
            Utils::addErrorMessage("Wystąpił błąd podczas pobierania informacji o roli.");
			return null;
		}
	}

    public static function getAppointments($patientId = null, $doctorId = null, $avaiable = null, $dateTimeFrom = null, $dateTimeTo = null, $limit = null, $offset = 0, &$isMore = false, $doctorNameLike = null, $patientNameLike = null): array{
        $where = [
			'ORDER' => ['appointment.startdatetime' => 'ASC', 'office.nameoffice' => 'ASC']
		];

		if($patientId !== null){
			$where['appointment.patientiduser'] = $patientId;
		}
		else if(!Utils::isEmptyString($patientNameLike)){
			$tab = explode(' ', $patientNameLike);
			if(!Utils::isEmptyString($tab[0])){
				$name = trim($tab[0]) . '%';
				$where['OR']['patient.nameuser[~]'] = $name;

			}
			if(count($tab) > 1 && !Utils::isEmptyString($tab[1])){
				$name = trim($tab[1]) . '%';
				$where['OR']['patient.surname[~]'] = $name;
			}
			else {
				$name = trim($patientNameLike) . '%';
				$where['OR']['patient.nameuser[~]'] = $name;
				$where['OR']['patient.surname[~]'] = $name;
			}
		}
		if($doctorId !== null){
			$where['appointment.iddoctor'] = $doctorId;
		}
		else if(!Utils::isEmptyString($doctorNameLike)){
			$tab = explode(' ', $doctorNameLike);
			if(!Utils::isEmptyString($tab[0])){
				$name = trim($tab[0]) . '%';
				$where['OR']['doctor.nameuser[~]'] = $name;

			}
			if(count($tab) > 1 && !Utils::isEmptyString($tab[1])){
				$name = trim($tab[1]) . '%';
				$where['OR']['doctor.surname[~]'] = $name;
			}
			else {
			$name = trim($doctorNameLike) . '%';
				$where['OR']['doctor.nameuser[~]'] = $name;
				$where['OR']['doctor.surname[~]'] = $name;
			}
		}
		if($avaiable !== null){
			$where['appointment.isavailable'] = $avaiable;
		}
		if($dateTimeFrom !== null){
			$where['appointment.startdatetime[>=]'] = $dateTimeFrom;
		}
		if($dateTimeTo !== null){
			$where['appointment.enddatetime[<=]'] = $dateTimeTo;
		}
		if($limit !== null){
			$where['LIMIT'] = [$offset, $limit + 1]; // Pobierz o jeden więcej, aby sprawdzić, czy jest więcej wyników
		}

		try{
			$appointments = App::getDB()->select('appointment', [
				'[>]system_user(patient)' => ['patientiduser' => 'iduser'],
                '[>]system_user(doctor)' => ['iddoctor' => 'iduser'],
				'[>]office' => ['appointment.idoffice' => 'idoffice'],
				'[>]visitreason' => ['idvisitreason'=>'idvisitreason']
			], [
				'appointment.idappointment(id)',
				'patient.nameuser(name)',
				'patient.surname',
				'patient.pesel',
				'appointment.reservationdatetime(reservationDatetime)',
				'visitReason' => App::getDB()->raw('CASE WHEN appointment.idvisitreason IS NOT NULL THEN visitreason.namevisitreason ELSE appointment.customvisitreason END'),
				'selfReserved' => App::getDB()->raw('CASE WHEN appointment.reservedbyiduser = appointment.patientiduser THEN 1 ELSE 0 END'),
				'appointment.startdatetime(startDatetime)',
				'appointment.enddatetime(endDatetime)', 
				'appointment.isavailable',
				'appointment.iddoctor(doctorId)',
                'doctor.nameuser(doctorName)',
                'doctor.surname(doctorSurname)',
				'office.nameoffice(officeName)'

			], $where);
            $array = array_map(function($appointment) { return new Appointment($appointment); }, $appointments);
			if($limit !== null){
				if(count($array) > $limit){
					$isMore = true;
					array_pop($array); // Usuń dodatkowy rekord użyty do sprawdzenia isMore
				} else {
					$isMore = false;
				}
			}
			return $array;
		} catch (\PDOException $e){
			Utils::addErrorMessage("Wystąpił błąd podczas wczytywania wizyt.");
            return [];
		}
        
    }
}

