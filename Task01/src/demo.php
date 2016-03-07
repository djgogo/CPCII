<?php

require_once 'Person.php';

// Instantiate new Person
$peter = new Person('Peter', 'Sacco', '09.03.1968');
$name = $peter->getName();
$surname = $peter->getSurname();
$birthday = $peter->getBirthday();

// Catch exception if zipcode is invalid and print error message
try {
    $peter->setZipCode(123456);
}catch (\Exception $e) {
    printf("\nInvalid zip code - please enter again!");
}
$peter->setAddress('Bernerstrasse Nord 152');
$peter->setResidence('Zürich');
$peter->setPhoneNumber('044-444 44 44');
$peter->setFavouriteColor('music');

// Check if PhoneNumber has been called
if (!$peter->askedForTelNumber()){
    printf("\n");
    printf("..Phone Number hasn't been called!\n");
}else {
    printf("..Phone Number has been called!\n");
}

// get all other Person Details
$address = $peter->getAddress();
$zipcode = $peter->getZipCode();
$residence = $peter->getResidence();
$phoneNumber = $peter->getPhoneNumber();
$favouriteColor = $peter->getFavouriteColor();

// Print out all Details
printf("\n");
printf("Details for %s %s\n", $name, $surname);
printf("\n");
printf("Address: %s\n", $address);
printf("living in: %d %s\n", $zipcode, $residence);
printf("Phone Number: %s\n", $phoneNumber);
printf("\n");
printf("His favourite Colour is: %s\n", $favouriteColor);

if ($peter->askedForTelNumber()){
    printf("..Phone Number has been called!\n");
}
