<?php
    session_start();
    $_SESSION = []; // borramos información de la sesión
    header("location: /");