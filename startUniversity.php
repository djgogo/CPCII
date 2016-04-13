<?php
require_once __DIR__ . '/bootstrap.php';

/* University */
$university = new University('Cambridge');

/* Lecturers */
$stuffId = $university->generateRandomNumericFiveDigitsStaffId();
$lecturer01 = New Lecturer($stuffId, 'John Doe');
printf ("\nLecturer %s with Stuff-Id %s starts to teach the students",
    $lecturer01->getName(), $lecturer01->getStaffId());
$stuffId = $university->generateRandomNumericFiveDigitsStaffId();
$lecturer02 = New Lecturer($stuffId, 'Lisa Millet');
printf ("\nLecturer %s with Stuff-Id %s starts to teach the students",
    $lecturer02->getName(), $lecturer02->getStaffId());

/* Create Courses and their Modules  */
$moduleFactory = new ModuleFactory();
$moduleRepository = new ModuleRepository();

$moduleRepository->addModule($moduleFactory->createEntityRelationshipModellingModule());
$moduleRepository->addModule($moduleFactory->createWebDevelopmentModule());
$moduleRepository->addModule($moduleFactory->createDatabaseSystemsModule());
$moduleRepository->addModule($moduleFactory->createFirstLevelSupportModule());
$moduleRepository->addModule($moduleFactory->createNetworkInfrastructureModule());
$moduleRepository->addModule($moduleFactory->createCreditRiskManagementModule());
$moduleRepository->addModule($moduleFactory->createEnergyMarketsModule());
$moduleRepository->addModule($moduleFactory->createForeignExchangeModule());
$moduleRepository->addModule($moduleFactory->createPensionFinanceModule());
$moduleRepository->addModule($moduleFactory->createBehaviouralFinanceModule());
$moduleRepository->addModule($moduleFactory->createColloquialEnglishModule());
$moduleRepository->addModule($moduleFactory->createColloquialEnglishModule());

$courseBuilder = new CourseBuilder($moduleRepository);
$computingCourse = $courseBuilder->build(new ComputingCourse());
printf ("\n\nCourse %s created", $computingCourse->getName());
$financeAndInvestmentCourse = $courseBuilder->build(new FinanceAndInvestmentCourse());
printf ("\nCourse %s created", $financeAndInvestmentCourse->getName());

printf ("\n");
printf ("\nCourse %s includes following Modules:", $computingCourse->getName());
foreach ($computingCourse->getModules() as $module) {
    printf ("\n - %s", $module->getName());
}
printf ("\n");
printf ("\nCourse %s includes following Modules:", $financeAndInvestmentCourse->getName());
foreach ($financeAndInvestmentCourse->getModules() as $module) {
    printf ("\n - %s", $module->getName());
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
