<?php
interface OkulistInterface {
    function create();
    function getOkulistById($okulist_id);
    function readAll();
    function delete($id);
    function updateProfile($id, $firstName, $lastName, $email, $specialization);
    function isAdministrator($id);
    function isEmailUsedByAnotherOkulist($id, $email);
}
?>