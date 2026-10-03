<?php

namespace App\Controllers;

use App\Models\CustomerAccountModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerAccountModel();
    }

    /**
     * Display dashboard with customer accounts list (paginated)
     */
    public function index()
    {
        $keyword = $this->request->getGet('search');
        $status = $this->request->getGet('status');
        $type = $this->request->getGet('type');
        $perPage = 5;

        if ($keyword) {
            $accounts = $this->customerModel->searchAccounts($keyword, $perPage);
        } elseif ($status) {
            $accounts = $this->customerModel->getAccountsByStatus($status, $perPage);
        } elseif ($type) {
            $accounts = $this->customerModel->getAccountsByType($type, $perPage);
        } else {
            $accounts = $this->customerModel->getAccountsPaginated($perPage);
        }

        $data = [
            'accounts' => $accounts,
            'pager' => $this->customerModel->pager,
            'total_accounts' => $this->customerModel->getTotalAccounts(),
            'active_accounts' => $this->customerModel->getCountByStatus('active'),
            'inactive_accounts' => $this->customerModel->getCountByStatus('inactive'),
            'suspended_accounts' => $this->customerModel->getCountByStatus('suspended'),
            'current_page' => $this->request->getGet('page') ?? 1,
            'search_keyword' => $keyword,
            'filter_status' => $status,
            'filter_type' => $type,
            'success' => session('success'),
            'error' => session('error'),
        ];

        return view('home/index', $data);
    }

    public function create()
    {
        return view('home/account_form', [
            'account' => [],
            'errors' => [],
            'mode' => 'create',
        ]);
    }

    public function store()
    {
        $data = $this->prepareAccountData($this->request->getPost());

        if ($this->customerModel->insert($data) === false) {
            return view('home/account_form', [
                'account' => $data,
                'errors' => $this->customerModel->errors(),
                'mode' => 'create',
            ]);
        }

        return redirect()->to('/')->with('success', 'Customer account created successfully.');
    }

    public function edit($id)
    {
        $account = $this->customerModel->find($id);

        if (!$account) {
            return redirect()->to('/')->with('error', 'Account not found.');
        }

        return view('home/account_form', [
            'account' => $account,
            'errors' => [],
            'mode' => 'edit',
        ]);
    }

    public function update($id)
    {
        $account = $this->customerModel->find($id);

        if (!$account) {
            return redirect()->to('/')->with('error', 'Account not found.');
        }

        $data = $this->prepareAccountData($this->request->getPost());
        $data['id'] = $id;

        if ($this->customerModel->save($data) === false) {
            return view('home/account_form', [
                'account' => array_merge($account, $data),
                'errors' => $this->customerModel->errors(),
                'mode' => 'edit',
            ]);
        }

        return redirect()->to('/')->with('success', 'Customer account updated successfully.');
    }

    public function delete($id)
    {
        $account = $this->customerModel->find($id);

        if (!$account) {
            return redirect()->to('/')->with('error', 'Account not found.');
        }

        $this->customerModel->delete($id);

        return redirect()->to('/')->with('success', 'Customer account deleted successfully.');
    }

    /**
     * View single account details
     */
    public function viewAccount($id)
    {
        $account = $this->customerModel->find($id);

        if (!$account) {
            return redirect()->to('/')->with('error', 'Account not found');
        }

        return view('home/view_account', ['account' => $account]);
    }

    protected function prepareAccountData(array $data): array
    {
        return [
            'account_number' => trim($data['account_number'] ?? ''),
            'customer_name' => trim($data['customer_name'] ?? ''),
            'address' => trim($data['address'] ?? ''),
            'phone' => trim($data['phone'] ?? ''),
            'email' => trim(strtolower($data['email'] ?? '')),
            'meter_number' => trim($data['meter_number'] ?? ''),
            'connection_type' => strtolower(trim($data['connection_type'] ?? '')),
            'status' => strtolower(trim($data['status'] ?? '')),
        ];
    }
}