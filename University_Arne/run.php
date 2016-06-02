<?php
declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

/* Lecturer */
$staffId = new StaffId(11130);
$lecturer = New Lecturer($staffId, 'John Doe');
printf ("\nLecturer %s with Stuff-Id %s starts to teach the students\n",
    $lecturer->getName(), $lecturer->getStaffId());

/* Students */
$student01 = new Student(new Id(), 'Harry Potter');
printf ("\nStudent %s with EnrollmentNumber %s starts to study",
    $student01->getName(), $student01->getEnrollmentNumber());
$student02 = new Student(new Id(), 'Lara Croft');
printf ("\nStudent %s with EnrollmentNumber %s starts to study\n",
    $student02->getName(), $student02->getEnrollmentNumber());

/* Create Semester with related Courses */
$semester1 = new Semester201701();
printf ("\nSemester %s created", $semester1->getName());
$semester2 = new Semester201702();
printf ("\nSemester %s created", $semester2->getName());

printf ("\n\nSemester %s offers following Courses:", $semester1->getName());
foreach ($semester1->getCourses() as $course) { printf ("\n - %s", $course->getName()); }
printf ("\n\nSemester %s offers following Courses:", $semester2->getName());
foreach ($semester2->getCourses() as $course) { printf ("\n - %s", $course->getName()); }

/* Students enrol to courses */
$psychology = $semester1->getCourse('Psychology');
$psychology->enrolStudent(new Student(new Id(), 'Harry Brown'));
$psychology->enrolStudent(new Student(new Id(), 'Indiana Jones'));
$psychology->enrolStudent(new Student(new Id(), 'James Bond'));
$psychology->enrolStudent($student02);

printf ("\n\nFollowing Students enrolled in Course %s", $psychology->getName());
foreach ($psychology->getEnrolledStudents() as $student) { printf ("\n - %s", $student->getName()); }

$mathematics = $semester2->getCourse('Mathematics');
$mathematics->enrolStudent($student01);
$mathematics->enrolStudent($student02);

printf ("\n\nFollowing Students enrolled in Course %s", $mathematics->getName());
foreach ($mathematics->getEnrolledStudents() as $student) { printf ("\n - %s", $student->getName()); }
printf ("\n");



