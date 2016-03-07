<?php

require_once 'Person.php';

$peter = new Person('Peter', 'Sacco', '09.03.1968');
$name = $peter->getName();
$surname = $peter->getSurname();
$birthday = $peter->getBirthday();

$peter->setAddress('Bernerstrasse Nord 152');
$peter->setZipcode(8064);
$peter->setResidence('Zürich');
$peter->setPhoneNumber('044-444 44 44');
$peter->setFavouriteColor('music');

$address = $peter->getAddress();
$zipcode = $peter->getZipcode();
$residence = $peter->getResidence();
$phoneNumber = $peter->getPhoneNumber();
$favouriteColor = $peter->getFavouriteColor();

printf("\n\n");
printf("Details for %s %s\n", $name, $surname);
printf("\n");
printf("Address: %s\n", $address);
printf("living in: %d %s\n", $zipcode, $residence);
printf("Phone Number: %s\n", $phoneNumber);
printf("\n");
printf("His favourite Colour is: %s\n", $favouriteColor);