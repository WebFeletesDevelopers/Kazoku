<?php
include_once 'PDO/database.php';

/**
 * Checkea si el usuario está logueado
 * @return bool
 */
function isLogged()
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        if ($_SESSION['loggedin'] === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

/**
 * Checkea si la cuenta está confirmada, si no lo está comprueba en la BD si lo está
 */
function isConfirmed()
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        if ($_SESSION['Confirmado'] === TRUE) {
            return TRUE;
        } else {
            $sql = "SELECT * FROM users WHERE username = '" . $_SESSION['uname'] . "'";
            $bd = create();
            $query = $bd->query($sql);
            $usuario = $query->fetchObject();
            $_SESSION['Confirmado'] = $usuario->Confirmado;
            if ($_SESSION['Confirmado'] == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    } else {
        return FALSE;
    }
}

function isAdmin()
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        if ($_SESSION['Rango'] == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function isProfe()
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        if ($_SESSION['Rango'] == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}
function isPadre()
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        if ($_SESSION['Rango'] == 2) {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}
function isAlumno()
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        if ($_SESSION['Rango'] == 3) {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}
function cerrarSesion(){
    $_SESSION = [];
    session_destroy();
    session_unset();
    header('Location: index.php');
}
