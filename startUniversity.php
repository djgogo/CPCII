<?php
require_once __DIR__ . '/bootstrap.php';

$university = new University('Cambridge');
$stuffId = $university->generateRandomNumericFiveCharacterStuffId();
$lecturer = New Lecturer($stuffId);

printf ("\nLecturer: %s got his Stuff-Id: %s and starts to teach the students", $lecturer, $lecturer->getStuffId());

$enrollmentNumber = new EnrollmentNumber();
$student = new Student($enrollmentNumber);

printf ("\nStudent: %s is enrolled at University of %s\n", $student->getEnrollmentNumber(), $university->getName());