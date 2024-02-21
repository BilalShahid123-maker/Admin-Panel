<?php

return [
    'barber_api_url' => env('BARBER_API_URL', 'https://api.doorcutapp.com/api/barberProfile/getAll'),
    'client_api_url' => env('CLIENT_API_URL', 'https://api.doorcutapp.com/api/clientProfile/getAll'),
    'services_api_url' => env('SERVICES_API_URL', 'https://api.doorcutapp.com/api/service/getAll'),

    'auth_api_url' => env('AUTH_API_URL', 'https://api.doorcutapp.com/api/auth'),
    'edit_admin_api_url' => env('EDIT_ADMIN_API_URL', 'https://api.doorcutapp.com/api/auth/editAdmin'),

    'barber_delete_api_url' => env('BARBER_DELETE_API_URL', 'https://api.doorcutapp.com/api/barberProfile/delete'),
    'barber_approve_api_url' => env('BARBER_APPROVE_API_URL', 'https://api.doorcutapp.com/api/barberApproval/approve'),
    'barber_block_api_url' => env('BARBER_BLOCK_API_URL', 'https://api.doorcutapp.com/api/barberApproval/block'),

    'client_delete_api_url' => env('CLIENT_DELETE_API_URL', 'https://api.doorcutapp.com/api/clientProfile/delete'),

    'service_delete_api_url' => env('SERVICE_DELETE_API_URL', 'https://api.doorcutapp.com/api/service/delete'),
    'service_save_api_url' => env('SERVICE_SAVE_API_URL', 'https://api.doorcutapp.com/api/service/save'),
];
