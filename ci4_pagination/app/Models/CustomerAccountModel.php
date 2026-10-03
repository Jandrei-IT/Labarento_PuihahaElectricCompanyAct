<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerAccountModel extends Model
{
    protected $table = 'customer_accounts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'account_number',
        'customer_name',
        'address',
        'phone',
        'email',
        'meter_number',
        'connection_type',
        'status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'account_number' => 'required|max_length[50]',
        'customer_name'  => 'required|min_length[2]|max_length[150]',
        'address'        => 'required|min_length[5]|max_length[500]',
        'phone'          => 'required|min_length[7]|max_length[20]',
        'email'          => 'required|valid_email|max_length[150]',
        'meter_number'   => 'required|min_length[3]|max_length[50]',
        'connection_type'=> 'required|in_list[residential,commercial,industrial]',
        'status'         => 'required|in_list[active,inactive,suspended]',
    ];

    protected $validationMessages = [
        'account_number' => [
            'required' => 'The account number is required.',
        ],
        'customer_name' => [
            'required' => 'The customer name is required.',
        ],
        'address' => [
            'required' => 'Please provide the customer address.',
        ],
        'phone' => [
            'required' => 'The phone number is required.',
        ],
        'email' => [
            'required' => 'The email address is required.',
            'valid_email' => 'Please enter a valid email address.',
        ],
        'meter_number' => [
            'required' => 'The meter number is required.',
        ],
    ];

    public function getAccountsPaginated($perPage = 5)
    {
        return $this->orderBy('created_at', 'DESC')->paginate($perPage);
    }

    public function searchAccounts($keyword, $perPage = 5)
    {
        return $this->like('account_number', $keyword)
            ->orLike('customer_name', $keyword)
            ->orLike('email', $keyword)
            ->orLike('phone', $keyword)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);
    }

    public function getAccountsByStatus($status, $perPage = 5)
    {
        return $this->where('status', $status)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);
    }

    public function getAccountsByType($type, $perPage = 5)
    {
        return $this->where('connection_type', $type)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);
    }

    public function getTotalAccounts()
    {
        return $this->countAllResults();
    }

    public function getCountByStatus($status)
    {
        return $this->where('status', $status)->countAllResults();
    }
}