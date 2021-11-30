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
function userStatus($user)
{
    switch ($user) 
    {
        case '0':
            $output = "waiting";
            break;

        case '1':
            $output = "approved";
            break;

        default:
            $output = "waiting";
            break;
    }
    return $output;
}
function userAccess($user)
{
    switch ($user) 
    {
        case '0':
            $output = "default";
            break;

        case '1':
            $output = "admin";
            break;

        default:
            $output = "default";
            break;
    }
    return $output;
}

?>