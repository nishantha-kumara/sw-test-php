<?php

namespace App\Repositories;

class AppRepository implements Repository
{

    // override function [repository]
    public function makeDataSet()
    {
        $dataSet = [];

        $users = json_decode(file_get_contents(public_path('json-store/users.json')), true);
        $organizations = json_decode(file_get_contents(public_path('json-store/organizations.json')), true);
        $tickets = json_decode(file_get_contents(public_path('json-store/tickets.json')), true);

        foreach ($users as $u =>  $user) {
            foreach ($organizations as $organization) {
                if (isset($user['organization_id']) && $user['organization_id'] == $organization['_id']) {
                    foreach ($tickets as  $ticket) {
                        if (isset($ticket['organization_id']) && $organization['_id'] == $ticket['organization_id']) {
                            $organization['tickets'][] =  $ticket;
                        }
                    }
                    $user['organizations'][] = $organization;
                    $dataSet[$u] = $user;
                }
            }
        }

        return $dataSet;
    }

    // override function [repository]
    public function filterData($query)
    {
        $response = [];
        $query = strtolower($query);

        foreach ($this->makeDataSet() as $data) {
            if (strtolower($data['name']) == $query) {
                $response[] = $data;
            }
            foreach ($data['organizations'] as $organization) {
                if (strtolower($organization['name']) == $query) {
                    $response[] = $data;
                }
                foreach ($organization['tickets'] as  $ticket) {
                    if (strtolower($ticket['_id']) == $query) {
                        $response[] = $data;
                    }
                }
            }
        }

        return $response;
    }
}
