<?php


// The file is not used
function validatePhoneNumbers($phoneNumber)
{
    if(preg_match('/^[0-9]{10}+$/', $phoneNumber)) 
    {
        return true;
    } 
    else 
    {
        return false;
    }
}

?>