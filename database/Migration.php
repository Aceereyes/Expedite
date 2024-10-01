<?php
namespace Database;
class Migration {
    public const MODELS = [
        //Locations
        \Database\Migrations\Location\RegionsMigration::class,
        \Database\Migrations\Location\ProvincesMigration::class,
        \Database\Migrations\Location\MunicipalitiesMigration::class,
        \Database\Migrations\Location\BarangaysMigration::class,

        \Database\Migrations\FreelancersMigration::class,
        \Database\Migrations\PartnersMigration::class,
        
        \Database\Migrations\Freelancers\AcademicQualificationsMigration::class,
        \Database\Migrations\Freelancers\ProfessionalQualificationsMigration::class,
        \Database\Migrations\Freelancers\LanguageProficiencyMigration::class,
        \Database\Migrations\Freelancers\TrainingsAndWorkshopsMigration::class,
        \Database\Migrations\Freelancers\WorkExperiencesMigration::class,
        \Database\Migrations\Freelancers\OtherAttachmentsMigration::class,

        \Database\Migrations\JobsMigration::class,
        \Database\Migrations\JobApplicationsMigration::class,
        \Database\Migrations\InterviewSchedulesMigration::class,
        \Database\Migrations\JobOrdersMigration::class,
        \Database\Migrations\JobOrderAttachmentsMigration::class,

        
        /////////////
        //   ERP   //
        /////////////

        //HR
        \Database\Migrations\AdminsMigration::class,
        \Database\Migrations\HR\EmployeesMigration::class,
        \Database\Migrations\HR\CareersMigration::class,
        \Database\Migrations\HR\AttendancesMigration::class,
        \Database\Migrations\HR\PayrollsMigration::class,
        \Database\Migrations\HR\PayslipsMigration::class,
        \Database\Migrations\HR\LatesMigration::class,

        //CRM
        \Database\Migrations\CRM\FAQsMigration::class,
        \Database\Migrations\CRM\MessagesMigration::class,

        //FRM
        \Database\Migrations\FRM\ReceivablesMigration::class,


        \Database\Migrations\Partners\PayablesMigration::class,
        \Database\Migrations\Freelancers\ReceivablesMigration::class,        

        \Database\Migrations\Partners\QuestionsMigration::class,
    ];
}