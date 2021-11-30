<?php 
function redirect($to)
{
    $link = "Location: ".$to."";
    header($link);
    exit();
}
function returnID()
{
    return $_SESSION["Logged"];
}
function isLogged()
{
    if (isset($_SESSION["Logged"])) return true;
    return false;
}
function adminPerm($admin)
{
    if ($admin > 0) { return true; }
    return false;
}
function serverMode($mode)
{
    switch ($mode) 
    {
        case '0':
            $output = "Normal";
            break;

        case '1':
            $output = "Locked / Maintenance";
            break;

        default:
            $output = "Normal";
            break;
    }
    return $output;
}
function setGender($user)
{
    switch ($user) 
    {
        case '0':
            $output = "Male";
            break;

        case '1':
            $output = "Female";
            break;

        default:
            $output = "Male";
            break;
    }
    return $output;
}

?>