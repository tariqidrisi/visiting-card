<?php
use App\Models\Company;

if (! function_exists('getWeekDays')) {
    function getWeekDays() {
        $days = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday"
        ];

        return $days;
    }
}

if (! function_exists('getCompany')) {
    function getCompany() {
        $company = Company::first();

        if ($company) {
            $id = $company->id;
        } else {
            $id = '';
        }

        return $id;
    }
}
