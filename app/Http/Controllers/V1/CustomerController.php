<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Customer\GetCustomerRequest;
use App\Http\Requests\V1\Customer\StoreCustomerRequest;
use App\Http\Resources\V1\CreateCustomerResource;
use App\Http\Resources\V1\GetCustomerResource;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\DebitCard;

class CustomerController extends Controller
{
    /**
     * @group Customer Management
     *
     * Get a specific customer and related information based on request parameters
     *
     * @bodyParam include array Enum: accounts, creditCards, debitCards, loans, fixedDeposits Example: creditCards,debitCards,loans,accounts,fixedDeposits
     *
     * @responseFile storage/response/customer/get-customer.json
     *
     * @response 422 {
     *     "error": "Invalid parameters"
     * }
     */
    public function show(Customer $customer, GetCustomerRequest $request)
    {
        $include = $request->include;

        if ($include) {
            if (in_array('creditCards', $include)) {
                $customer->load('creditCards');
            }
            if (in_array('debitCards', $include)) {
                $customer->load('debitCards');
            }
            if (in_array('loans', $include)) {
                $customer->load('loans');
            }
            if (in_array('accounts', $include)) {
                $customer->load('accounts', 'customerAccounts');
            }
            if (in_array('fixedDeposits', $include)) {
                $customer->load('fixedDeposits');
            }
        }

        return GetCustomerResource::make($customer);
    }

    // TODO: Create documentation
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create([
            'salutation' => $request->salutation,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'occupation' => $request->occupation,
            'employer_name' => $request->employerName,
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => $request->nationalId,
            'address_line_1' => $request->addressLine1,
            'address_line_2' => $request->addressLine2,
            'city' => $request->city,
            'postal_code' => $request->postalCode,
            'province' => $request->province,
            'country' => $request->country,
            'date_of_birth' => $request->dateOfBirth,
            'gender' => $request->gender,
            'is_vip' => $request->isVip,
            'disabled' => false,
            'notes' => $request->notes,
        ]);

        if (isset($request->account)) {
            $account = CustomerAccount::create([
                'customer_id' => $customer->id,
                'account_id' => $request->account['accountType'],
                'account_number' => $request->account['accountNumber'],
                'status' => CustomerAccount::STATUS_ACTIVE,
                'balance' => $request->account['balance'],
                'branch' => $request->account['branch'],
                'start_date' => now()->format('Y-m-d'),
                'notes' => $request->account['notes'] ?? null,
            ]);

            if (isset($request->account['debitCard'])) {
                $debitCard = DebitCard::create([
                    'customer_id' => $customer->id,
                    'linked_account' => $request->account['accountNumber'],
                    'card_type' => $request->account['debitCard']['type'],
                    'status' => DebitCard::STATUS_ACTIVE,
                    'expiry_date' => $request->account['debitCard']['expiryDate'],
                    'cardholder_name' => $request->account['debitCard']['cardholderName'],
                    'notes' => $request->account['debitCard']['notes'] ?? null,
                ]);
            }
        }

        return CreateCustomerResource::make($customer);
    }
}
