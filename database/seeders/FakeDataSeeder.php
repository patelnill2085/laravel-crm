<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Seeder;

class FakeDataSeeder extends Seeder
{
    public function run(): void
    {
        // Customers
        $customers = [
            ['name' => 'Rahul Sharma', 'email' => 'rahul@gmail.com', 'phone' => '9876543210', 'company' => 'Tech Solutions Pvt Ltd', 'status' => 'active', 'notes' => 'Very interested in premium plan'],
            ['name' => 'Priya Patel', 'email' => 'priya@yahoo.com', 'phone' => '9823456789', 'company' => 'Digital Dreams', 'status' => 'active', 'notes' => 'Follow up next week'],
            ['name' => 'Amit Singh', 'email' => 'amit@hotmail.com', 'phone' => '9712345678', 'company' => 'StartUp Hub', 'status' => 'prospect', 'notes' => 'Interested in basic plan'],
            ['name' => 'Sneha Mehta', 'email' => 'sneha@gmail.com', 'phone' => '9634567890', 'company' => 'Creative Agency', 'status' => 'active', 'notes' => 'Long term client'],
            ['name' => 'Vikram Joshi', 'email' => 'vikram@gmail.com', 'phone' => '9556789012', 'company' => 'Global Exports', 'status' => 'inactive', 'notes' => 'Contract ended'],
            ['name' => 'Anjali Desai', 'email' => 'anjali@gmail.com', 'phone' => '9478901234', 'company' => 'Fashion House', 'status' => 'prospect', 'notes' => 'New lead from website'],
            ['name' => 'Rohan Gupta', 'email' => 'rohan@gmail.com', 'phone' => '9390123456', 'company' => 'Food Chain Ltd', 'status' => 'active', 'notes' => 'Upgraded to premium'],
        ];

        foreach ($customers as $customer) {
            Customer::create([...$customer, 'created_by' => 1]);
        }

        // Leads
        $leads = [
            ['name' => 'Kavya Nair', 'email' => 'kavya@gmail.com', 'phone' => '9812345670', 'source' => 'Google Ads', 'status' => 'new', 'notes' => 'Came from search ad', 'assigned_to' => 2],
            ['name' => 'Arjun Reddy', 'email' => 'arjun@gmail.com', 'phone' => '9723456781', 'source' => 'Referral', 'status' => 'contacted', 'notes' => 'Called twice', 'assigned_to' => 3],
            ['name' => 'Pooja Iyer', 'email' => 'pooja@gmail.com', 'phone' => '9634567892', 'source' => 'Social Media', 'status' => 'qualified', 'notes' => 'Budget approved', 'assigned_to' => 2],
            ['name' => 'Sanjay Kumar', 'email' => 'sanjay@gmail.com', 'phone' => '9545678903', 'source' => 'Website', 'status' => 'converted', 'notes' => 'Deal closed!', 'assigned_to' => 1],
            ['name' => 'Meera Shah', 'email' => 'meera@gmail.com', 'phone' => '9456789014', 'source' => 'Cold Call', 'status' => 'lost', 'notes' => 'Went with competitor', 'assigned_to' => 3],
            ['name' => 'Raj Malhotra', 'email' => 'raj@gmail.com', 'phone' => '9367890125', 'source' => 'Google Ads', 'status' => 'new', 'notes' => 'Just enquired', 'assigned_to' => 2],
            ['name' => 'Divya Chopra', 'email' => 'divya@gmail.com', 'phone' => '9278901236', 'source' => 'Referral', 'status' => 'contacted', 'notes' => 'Meeting scheduled', 'assigned_to' => 1],
            ['name' => 'Nikhil Verma', 'email' => 'nikhil@gmail.com', 'phone' => '9189012347', 'source' => 'LinkedIn', 'status' => 'qualified', 'notes' => 'Very interested', 'assigned_to' => 3],
        ];

        foreach ($leads as $lead) {
            Lead::create($lead);
        }
    }
}