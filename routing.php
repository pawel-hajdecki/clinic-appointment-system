<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('showMainPage'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('showMainPage', 'MainPageCtrl');
Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl', ['patient', 'receptionist', 'admin']);
Utils::addRoute('showChangePasswordForm', 'ChangePasswordCtrl', ['patient', 'receptionist', 'admin']);
Utils::addRoute('changePassword', 'ChangePasswordCtrl', ['admin']);
Utils::addRoute('showChangePasswordForm', 'ChangePasswordCtrl',['admin']);

Utils::addRoute('showRegistrationForm', 'RegistrationCtrl');
Utils::addRoute('register', 'RegistrationCtrl');
Utils::addRoute('editRegistrationData', 'RegistrationCtrl', ['admin']);

Utils::addRoute('showDoctorsGrid', 'DoctorsGridCtrl');

Utils::addRoute('showDoctorDetails', 'DoctorDetailsCtrl');

Utils::addRoute('showSchedule', 'ScheduleCtrl', ['receptionist', 'patient']);
Utils::addRoute('showSchedulePart', 'ScheduleCtrl', ['receptionist', 'patient']);
Utils::addRoute('filterAppointments', 'ScheduleCtrl', ['receptionist']);
Utils::addRoute('deleteAppointment','ScheduleCtrl', ['receptionist']);
Utils::addRoute('bookAppointment','ScheduleCtrl', ['receptionist']);
Utils::addRoute('cancelAppointment','ScheduleCtrl', ['receptionist', 'patient']);

Utils::addRoute('showNewAppointmentForm', 'EditAppointmentCtrl', ['receptionist']);
Utils::addRoute('saveAppointment', 'EditAppointmentCtrl', ['receptionist']);
Utils::addRoute('editAppointment', 'EditAppointmentCtrl', ['receptionist']);

Utils::addRoute('showPredefinedVisitReasonsMan','PredefinedVisitReasonManCtrl', ['receptionist']);
Utils::addRoute('deleteVisitReason','PredefinedVisitReasonManCtrl', ['receptionist']);

Utils::addRoute('showVisitReasonForm','EditVisitReasonCtrl', ['receptionist']);
Utils::addRoute('saveVisitReason','EditVisitReasonCtrl', ['receptionist']);

Utils::addRoute('saveReservation','ReservationCtrl', ['receptionist', 'patient']);
Utils::addRoute('showReservationForm','ReservationCtrl', ['receptionist', 'patient']);

Utils::addRoute('showSelectAppointment','SelectAppointmentCtrl', ['receptionist', 'patient']);
Utils::addRoute('selectAppointment','SelectAppointmentCtrl', ['receptionist', 'patient']);

Utils::addRoute('showDoctorForm','EditDoctorCtrl', ['receptionist']);
Utils::addRoute('saveDoctor','EditDoctorCtrl', ['receptionist']);
Utils::addRoute('editDoctor','EditDoctorCtrl', ['receptionist']);
Utils::addRoute('showDoctorsMan','DoctorsManCtrl', ['receptionist']);
Utils::addRoute('deleteDoctor','DoctorsManCtrl', ['receptionist']);
Utils::addRoute('showReceptionistsMan','ReceptionistsManCtrl', ['admin']);
Utils::addRoute('deleteReceptionist','ReceptionistsManCtrl', ['admin']);

Utils::addRoute('showPatientsMan','PatientsManCtrl', ['receptionist', 'admin']);
Utils::addRoute('confirmDeclaration','PatientsManCtrl', ['receptionist']);
Utils::addRoute('deletePatient','PatientsManCtrl', ['admin']);

Utils::addRoute('showMyAccount','MyAccountCtrl', ['patient','receptionist','admin']);

