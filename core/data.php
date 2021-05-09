<?php

return [
    "memberID" => $dbRemData['memberID'] ?? 1,
    "username" => $dbRemData['username'] ?? "visitor",
    "password" => $dbRemData['password'] ?? '123456789',
    "email" => $dbRemData['email'] ?? "test@seznam.cz",
    "active" => $dbRemData['active'] ?? "YES",
    "permission" => $dbRemData['permission'] ?? 'visit',
    "name" => $dbRemData['name'] ?? null,
    "surname" => $dbRemData['surname'] ?? null,
    "avatar" => $dbRemData['avatar'] ?? "empty_profile.png",
    "age" => $dbRemData['age'] ?? null,
    "location" => $dbRemData['location'] ?? null,
    "resetToken" => $dbRemData['resetToken'] ?? null,
    "resetComplete" => $dbRemData['resetComplete'] ?? null,
    "bookmark" => $dbRemData['bookmark'] ?? "0",
    "remeber" => $dbRemData['remember'] ?? null,
    "visible" => $dbRemData['visible'] ?? ""
    ];
