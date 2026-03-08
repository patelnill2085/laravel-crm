# 🏢 Laravel CRM System

A modern, full-featured CRM (Customer Relationship Management) system built with Laravel, featuring role-based access control, lead management, and an interactive Kanban board.

## ✨ Features

- 🔐 **Authentication** — Secure login/logout system
- 👥 **Role-Based Access Control** — Admin, Manager, Staff roles
- 👤 **Customer Management** — Full CRUD with status tracking
- 🎯 **Lead Management** — Track leads through sales pipeline
- 📋 **Kanban Board** — Drag & drop leads across stages
- 📊 **Dashboard** — Real-time stats and recent activity
- 📱 **Responsive Design** — Works on all devices

## 🖥️ Screenshots

### Dashboard
![Dashboard](screenshots/dashboard.png)

### Kanban Board
![Kanban](screenshots/kanban.png)

### Customers
![Customers](screenshots/customers.png)

## 🛠️ Tech Stack

- **Backend** — Laravel 10, PHP 8.1
- **Frontend** — Blade, Tailwind CSS
- **Database** — MySQL
- **Auth** — Laravel Breeze
- **Drag & Drop** — jQuery UI

## ⚙️ Installation

1. **Clone the repository**
```bash
git clone https://github.com/patelnill2085/laravel-crm.git
cd laravel-crm
```

2. **Install dependencies**
```bash
composer install
npm install && npm run build
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database setup**
```bash
# Create database named: crm_system
php artisan migrate
php artisan db:seed --class=UserSeeder
```

5. **Run the application**
```bash
php artisan serve
```

6. **Open in browser**
```
http://127.0.0.1:8000
```

## 👤 Default Login Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@crm.com | password123 |
| Manager | manager@crm.com | password123 |
| Staff | staff@crm.com | password123 |

## 📁 Project Structure
```
├── app/Http/Controllers/
│   ├── DashboardController.php
│   ├── CustomerController.php
│   └── LeadController.php
├── app/Models/
│   ├── Customer.php
│   ├── Lead.php
│   └── User.php
├── app/Http/Middleware/
│   └── RoleMiddleware.php
└── resources/views/
    ├── dashboard.blade.php
    ├── customers/
    └── leads/
```

## 🔐 Role Permissions

| Feature | Admin | Manager | Staff |
|---------|-------|---------|-------|
| View Dashboard | ✅ | ✅ | ✅ |
| Manage Customers | ✅ | ✅ | ❌ |
| Manage Leads | ✅ | ✅ | ✅ |
| Kanban Board | ✅ | ✅ | ✅ |

## 📞 Contact

Built by [Nill Patel](https://github.com/patelnill2085)