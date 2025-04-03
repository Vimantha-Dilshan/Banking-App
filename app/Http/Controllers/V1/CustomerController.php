<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Customer\GetCustomerRequest;
use App\Http\Requests\V1\Customer\StoreCustomerRequest;
use App\Http\Resources\V1\CustomerManagement\CreateCustomerResource;
use App\Http\Resources\V1\CustomerManagement\GetCustomerResource;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\CustomerDebitCard;

/**
 * @group Customer Management
 *
 * @authenticated
 */
class CustomerController extends Controller
{
    /**
     * Get Customer Details
     *
     * Retrieve a specific customer and related information based on request parameters.
     *
     * @queryParam include string Comma-separated list of related resources to include. Possible values: accounts, creditCards, debitCards, loans, fixedDeposits. Example: creditCards,debitCards,loans,accounts,fixedDeposits
     *
     * @responseFile storage/response/customer-management/get-customer.json
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

    /**
     * Create New Customer
     *
     * Creates a new customer along with an optional account and debit card details.
     *
     * @bodyParam salutation string nullable The salutation of the customer. Must be one of "MR", "MISS", "MRS", "REV". Example: MR
     * @bodyParam firstName string required The first name of the customer. Max 255 characters. Example: Joe
     * @bodyParam lastName string required The last name of the customer. Max 255 characters. Example: Root
     * @bodyParam occupation string nullable The occupation of the customer. Max 255 characters. Example: Athlete
     * @bodyParam employerName string nullable The employer name of the customer. Max 255 characters. Example: England Cricket Board (ECB)
     * @bodyParam email string required The email address of the customer. Must be unique. Example: joe.root@ecb.com.uk
     * @bodyParam phone string nullable The phone number of the customer. Max 20 characters. Example: +44 20 7123 4567
     * @bodyParam nationalId string required The national ID of the customer. Must be unique. Example: QQ123456B
     * @bodyParam addressLine1 string required The primary address line. Max 255 characters. Example: 5931 Derick Grove
     * @bodyParam addressLine2 string nullable The secondary address line. Max 255 characters. Example: Suite 751
     * @bodyParam city string required The city of the customer. Max 255 characters. Example: London
     * @bodyParam postalCode string nullable The postal code of the customer. Example: GU16 7HF
     * @bodyParam province string nullable The province/state of the customer. Max 255 characters. Example: London
     * @bodyParam country string nullable The country of the customer. Max 255 characters. Example: England
     * @bodyParam dateOfBirth date required The date of birth of the customer (YYYY-MM-DD). Example: 1990-12-30
     * @bodyParam gender string required The gender of the customer. Must be one of "MALE", "FEMALE", "OTHER". Example: MALE
     * @bodyParam isVip boolean nullable Whether the customer is a VIP. Defaults to false. Example: true
     * @bodyParam disabled boolean nullable Whether the customer is disabled. Example: false
     * @bodyParam notes string nullable Additional notes about the customer. Example: Loerum ipsum
     * @bodyParam account array nullable Account details if the customer has an associated account.
     * @bodyParam account.accountType integer required The type of account. Example: 66
     * @bodyParam account.accountNumber string required The unique account number. Example: 101099518837
     * @bodyParam account.balance float required The initial balance of the account. Example: 10000
     * @bodyParam account.branch string nullable The branch associated with the account. Example: North London
     * @bodyParam account.notes string nullable Additional notes about the account. Example: Loerum ipsum
     * @bodyParam account.debitCard array nullable Debit card details if the customer has an associated card.
     * @bodyParam account.debitCard.type string required The type of debit card. Example: AMEX
     * @bodyParam account.debitCard.cardholderName string required The name of the cardholder. Example: JOE ROOT
     * @bodyParam account.debitCard.notes string nullable Additional notes about the debit card. Example: Loerum ipsum
     *
     * @responseFile storage/response/customer-management/create-customer-with-account.json
     *
     * @response 422 {
     *     "error": "Invalid parameters"
     * }
     */
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
            CustomerAccount::create([
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
                CustomerDebitCard::create([
                    'customer_id' => $customer->id,
                    'linked_account' => $request->account['accountNumber'],
                    'card_type' => $request->account['debitCard']['type'],
                    'status' => CustomerDebitCard::STATUS_ACTIVE,
                    'expiry_date' => now()->addYears(4)->format('m/Y'),
                    'cardholder_name' => $request->account['debitCard']['cardholderName'],
                    'notes' => $request->account['debitCard']['notes'] ?? null,
                ]);
            }
        }

        return CreateCustomerResource::make($customer);
    }
}
