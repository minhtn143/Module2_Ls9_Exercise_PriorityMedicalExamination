<?php
include_once "Patient.php";
include_once "Queue.php";
include_once "Element.php";

$patientQueue = new Queue();
//hiển thị danh sách khám
echo $patientQueue->showQueue() . "<br>";
//thêm bệnh nhân
$patientQueue->enqueue("Smith", 5);
$patientQueue->enqueue("Jones", 4);
$patientQueue->enqueue("Fehrenbach", 6);
$patientQueue->enqueue("Brown", 1);
$patientQueue->enqueue("Ingram", 1);
//bệnh nhân vượt quá giói hạn nên ko đc thêm vào
$patientQueue->enqueue("Paul", 4);
echo "<br>";
// hiện danh sách bệnh nhân hiện có
echo "PATIENT LIST QUEUE <br>";
print_r($patientQueue->showQueue());
echo "<br>";

echo "The patient was examined<br>";
print_r($patientQueue->dequeue());
echo "<br>";

print_r($patientQueue->dequeue());
echo "<br>";

echo "PATIENT LIST QUEUE <br>";
print_r($patientQueue->showQueue());
echo "<br>";


