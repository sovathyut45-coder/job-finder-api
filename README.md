# Job Finder API (Laravel REST API)

A RESTful API built with **Laravel** for the **Job Finder Application**. This backend provides secure authentication, user profile management, saved jobs, applied jobs, dashboard statistics, and integration with external job services.

This API is designed to work with the **Job Finder Flutter App** and follows RESTful architecture with Laravel Sanctum authentication.

---

# Overview

The Job Finder API serves as the backend of the Job Finder mobile application. It manages authentication, user accounts, saved jobs, applied jobs, dashboard statistics, avatar uploads, and communicates with external job providers.

---

# Features

## Authentication

- User Registration
- User Login
- User Logout
- Laravel Sanctum Authentication
- Protected API Routes

---

## User Profile

- View Profile
- Update Profile
- Upload Avatar
- Manage Account Information

---

## Saved Jobs

- Save Job
- Get Saved Jobs
- Remove Saved Job
- Clear All Saved Jobs

---

## Applied Jobs

- Apply for Job
- Get Applied Jobs
- Update Application Status
- Update Application Notes
- Remove Applied Job
- Clear All Applied Jobs

---

## Dashboard

- Total Saved Jobs
- Total Applied Jobs
- Pending Applications
- Interview Applications
- Accepted Applications
- Rejected Applications

---

## External API Integration

- Arbeitnow Job API
- JSON Data Processing
- HTTP Request & Response Handling

---

## Database

- MySQL Database
- Eloquent ORM
- Relationships
- Migrations
- Validation

---

# Technology Stack

## Backend

- PHP 8+
- Laravel 12

## Database

- MySQL

## Authentication

- Laravel Sanctum

## Storage

- Laravel Storage

## Tools

- Git
- GitHub
- Postman
- Composer

---

# Installation

## Clone Repository

```bash
git clone https://github.com/sovathyut45-coder/job-finder-api.git
```

## Navigate to Project

```bash
cd job-finder-api
```

## Install Dependencies

```bash
composer install
```

## Create Environment File

```bash
cp .env.example .env
```

If you're using Windows:

```bash
copy .env.example .env
```

## Configure Database

Update your `.env` file.

```env
APP_NAME="Job Finder API"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_finder
DB_USERNAME=root
DB_PASSWORD=
```

## Generate Application Key

```bash
php artisan key:generate
```

## Run Database Migration

```bash
php artisan migrate
```

## Create Storage Link

```bash
php artisan storage:link
```

## Start Development Server

```bash
php artisan serve
```

The API will be available at:

```
http://127.0.0.1:8000
```

---

# API Endpoints

## Authentication

| Method | Endpoint |
|---------|----------|
| POST | /api/register |
| POST | /api/login |
| POST | /api/logout |

---

## Profile

| Method | Endpoint |
|---------|----------|
| GET | /api/profile |
| PUT | /api/profile |
| POST | /api/profile/avatar |

---

## Saved Jobs

| Method | Endpoint |
|---------|----------|
| GET | /api/saved-jobs |
| POST | /api/saved-jobs |
| DELETE | /api/saved-jobs/{id} |
| DELETE | /api/saved-jobs/clear |

---

## Applied Jobs

| Method | Endpoint |
|---------|----------|
| GET | /api/applied-jobs |
| POST | /api/applied-jobs |
| PATCH | /api/applied-jobs/{id}/status |
| PATCH | /api/applied-jobs/{id}/note |
| DELETE | /api/applied-jobs/{id} |
| DELETE | /api/applied-jobs/clear |

---

## Dashboard

| Method | Endpoint |
|---------|----------|
| GET | /api/dashboard/stats |

---

# Authentication

Protected routes require a Bearer Token.

```
Authorization: Bearer YOUR_ACCESS_TOKEN
```

---

# Project Structure

```
app/
├── Http/
│   └── Controllers/
│       └── Api/
│           ├── AppliedJobController.php
│           ├── AuthController.php
│           ├── DashboardController.php
│           ├── ProfileController.php
│           └── SavedJobController.php
│
├── Models/
│   ├── AppliedJob.php
│   ├── SavedJob.php
│   └── User.php
│
database/
├── migrations/
```

---

# API Testing

The API can be tested using:

- Postman
- Thunder Client
- Insomnia

---

# Development Practices

- RESTful API Design
- MVC Architecture
- Laravel Best Practices
- Request Validation
- Eloquent ORM
- Resourceful Controllers
- Clean Code Principles
- Version Control with Git

---

# Future Improvements

- Resume Upload
- Email Verification
- Password Reset
- Role-Based Access Control (RBAC)
- API Documentation (Swagger/OpenAPI)
- Notifications
- Advanced Job Filtering
- Search History API
- Recent Jobs API

---

# Live Demo

Backend API

```
Coming Soon
```

Flutter Application

```
Coming Soon
```

---

# Author

**Phai Sovathyut**

Computer Science Student  
Royal University of Phnom Penh (RUPP)

Email: **sovathyut45@gmail.com**

GitHub:
https://github.com/sovathyut45-coder

---

# License

This project is developed for **educational**, **learning**, and **portfolio** purposes.