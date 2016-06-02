<?php
require_once __DIR__ . '/bootstrap.php';

/* University */
$university = new University('Cambridge');

/* Lecturers */
$staffId = $university->generateRandomNumericFiveDigitsStaffId();
$lecturer01 = New Lecturer($staffId, 'John Doe');
printf ("\nLecturer %s with Stuff-Id %s starts at University of %s",
    $lecturer01->getName(), $lecturer01->getStaffId(), $university->getName());
$staffId = $university->generateRandomNumericFiveDigitsStaffId();
$lecturer02 = New Lecturer($staffId, 'Lisa Millet');
printf ("\nLecturer %s with Stuff-Id %s starts at University of %s",
    $lecturer02->getName(), $lecturer02->getStaffId(), $university->getName());
$staffId = $university->generateRandomNumericFiveDigitsStaffId();
$lecturer03 = New Lecturer($staffId, 'Arnold Schwarzenegger');
printf ("\nLecturer %s with Stuff-Id %s starts at University of %s",
    $lecturer03->getName(), $lecturer03->getStaffId(), $university->getName());

/* Create Courses and their Modules  */
$moduleFactory = new ModuleFactory();
$moduleRepository = new ModuleRepository();

$moduleRepository->addModule($moduleFactory->createEntityRelationshipModellingModule($lecturer02));
$moduleRepository->addModule($moduleFactory->createWebDevelopmentModule($lecturer01));
$moduleRepository->addModule($moduleFactory->createDatabaseSystemsModule($lecturer03));
$moduleRepository->addModule($moduleFactory->createFirstLevelSupportModule($lecturer03));
$moduleRepository->addModule($moduleFactory->createNetworkInfrastructureModule($lecturer02));
$moduleRepository->addModule($moduleFactory->createCreditRiskManagementModule($lecturer02));
$moduleRepository->addModule($moduleFactory->createEnergyMarketsModule($lecturer01));
$moduleRepository->addModule($moduleFactory->createForeignExchangeModule($lecturer01));
$moduleRepository->addModule($moduleFactory->createPensionFinanceModule($lecturer01));
$moduleRepository->addModule($moduleFactory->createBehaviouralFinanceModule($lecturer03));
$moduleRepository->addModule($moduleFactory->createColloquialEnglishModule($lecturer02));
$moduleRepository->addModule($moduleFactory->createColloquialEnglishModule($lecturer01));

$courseBuilder = new CourseBuilder($moduleRepository);
$computingCourse = $courseBuilder->build(new ComputingCourse());
printf ("\n\nCourse %s created", $computingCourse->getName());
$financeAndInvestmentCourse = $courseBuilder->build(new FinanceAndInvestmentCourse());
printf ("\nCourse %s created", $financeAndInvestmentCourse->getName());

printf ("\n");
printf ("\nCourse %s includes following Modules:", $computingCourse->getName());
foreach ($computingCourse->getModules() as $module) {
    printf ("\n - %s :: Lecturer: %s", $module->getName(), $module->getLecturer()->getName());
}
printf ("\n");
printf ("\nCourse %s includes following Modules:", $financeAndInvestmentCourse->getName());
foreach ($financeAndInvestmentCourse->getModules() as $module) {
    printf ("\n - %s :: Lecturer: %s", $module->getName(), $module->getLecturer()->getName());
}
printf ("\n");

/* Students */
$student01 = new Student(new EnrollmentNumber(), 'Harry Potter');
printf ("\nStudent %s with EnrollmentNumber %s started at University of %s",
    $student01->getName(), $student01->getEnrollmentNumber(), $university->getName());
$student02 = new Student(new EnrollmentNumber(), 'Lara Croft');
printf ("\nStudent %s with EnrollmentNumber %s started at University of %s\n",
    $student02->getName(), $student02->getEnrollmentNumber(), $university->getName());

/* Enrol Students to courses */
$computingCourse->enrolStudent(new Student(new EnrollmentNumber(), 'Harry Brown'));
$computingCourse->enrolStudent(new Student(new EnrollmentNumber(), 'Indiana Jones'));
$computingCourse->enrolStudent(new Student(new EnrollmentNumber(), 'James Bond'));
$computingCourse->enrolStudent(new Student(new EnrollmentNumber(), 'Larry Laffer'));
printf ("\nFollowing Students enrolled in Course %s", $computingCourse->getName());
foreach ($computingCourse->getEnrolledStudents() as $student) {
    printf ("\n - %s", $student->getName());
}
printf ("\n");

$financeAndInvestmentCourse->enrolStudent($student01);
$financeAndInvestmentCourse->enrolStudent($student02);
printf ("\nFollowing Students enrolled in Course %s", $financeAndInvestmentCourse->getName());
foreach ($financeAndInvestmentCourse->getEnrolledStudents() as $student) {
    printf ("\n - %s", $student->getName());
}
printf ("\n");

/* change Lecturer for a Module */
