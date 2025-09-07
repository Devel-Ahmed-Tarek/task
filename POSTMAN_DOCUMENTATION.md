# 📋 Employee Management System - Postman API Documentation

## 🚀 Overview

This document provides comprehensive API documentation for the Employee Management System built with Laravel 12. The API uses Laravel Sanctum for authentication and follows RESTful principles.

## 🔗 Base URL

```
http://localhost:8000/api
```

## 🔐 Authentication

The API uses **Laravel Sanctum** for token-based authentication. Include the Bearer token in the Authorization header for protected endpoints.

```
Authorization: Bearer {your_token_here}
```

---

## 📚 API Endpoints

### 🔑 Authentication Endpoints

#### 1. Register User

**POST** `/api/register`

Create a new user account.

**Request Body:**

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Response (201):**

```json
{
    "success": true,
    "message": "Account created successfully",
    "data": {
        "access_token": "1|abc123def456...",
        "token_type": "Bearer",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        }
    }
}
```

#### 2. Login User

**POST** `/api/login`

Authenticate user and get access token.

**Request Body:**

```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

**Response (200):**

```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "access_token": "1|abc123def456...",
        "token_type": "Bearer",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        }
    }
}
```

#### 3. Get Current User

**GET** `/api/me`

Get authenticated user information.

**Headers:**

```
Authorization: Bearer {token}
```

**Response (200):**

```json
{
    "success": true,
    "message": "User data retrieved successfully",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

#### 4. Logout User

**POST** `/api/logout`

Revoke current access token.

**Headers:**

```
Authorization: Bearer {token}
```

**Response (200):**

```json
{
    "success": true,
    "message": "Logout successful",
    "data": []
}
```

---

### 👥 Employee Endpoints

#### 1. Get All Employees

**GET** `/api/employees`

Retrieve paginated list of employees with optional filtering.

**Headers:**

```
Authorization: Bearer {token}
```

**Query Parameters:**

-   `page` (optional): Page number for pagination
-   `per_page` (optional): Number of items per page (default: 15)
-   `search` (optional): Search by name or email
-   `department_id` (optional): Filter by department ID

**Example Request:**

```
GET /api/employees?search=john&department_id=1&page=1&per_page=10
```

**Response (200):**

```json
{
    "success": true,
    "message": "Employees retrieved successfully",
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com",
                "department": {
                    "id": 1,
                    "name": "Engineering"
                },
                "salary": 75000.00,
                "created_at": "2024-01-01T00:00:00.000000Z",
                "updated_at": "2024-01-01T00:00:00.000000Z"
            }
        ],
        "first_page_url": "http://localhost:8000/api/employees?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://localhost:8000/api/employees?page=1",
        "links": [...],
        "next_page_url": null,
        "path": "http://localhost:8000/api/employees",
        "per_page": 15,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
}
```

#### 2. Create Employee

**POST** `/api/employees`

Create a new employee.

**Headers:**

```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**

```json
{
    "name": "Jane Smith",
    "email": "jane@example.com",
    "department_id": 1,
    "salary": 65000.0
}
```

**Response (201):**

```json
{
    "success": true,
    "message": "Employee created successfully",
    "data": {
        "id": 2,
        "name": "Jane Smith",
        "email": "jane@example.com",
        "department": {
            "id": 1,
            "name": "Engineering"
        },
        "salary": 65000.0,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

#### 3. Get Single Employee

**GET** `/api/employees/{id}`

Retrieve a specific employee by ID.

**Headers:**

```
Authorization: Bearer {token}
```

**Response (200):**

```json
{
    "success": true,
    "message": "Employee data retrieved successfully",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "department": {
            "id": 1,
            "name": "Engineering"
        },
        "salary": 75000.0,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

#### 4. Update Employee

**PUT** `/api/employees/{id}`

Update an existing employee.

**Headers:**

```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**

```json
{
    "name": "John Updated",
    "email": "john.updated@example.com",
    "department_id": 2,
    "salary": 80000.0
}
```

**Response (200):**

```json
{
    "success": true,
    "message": "Employee updated successfully",
    "data": {
        "id": 1,
        "name": "John Updated",
        "email": "john.updated@example.com",
        "department": {
            "id": 2,
            "name": "Marketing"
        },
        "salary": 80000.0,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

#### 5. Delete Employee

**DELETE** `/api/employees/{id}`

Delete an employee.

**Headers:**

```
Authorization: Bearer {token}
```

**Response (200):**

```json
{
    "success": true,
    "message": "Employee deleted successfully",
    "data": []
}
```

---

### 🏢 Department Endpoints

#### 1. Get All Departments

**GET** `/api/departments`

Retrieve paginated list of departments.

**Headers:**

```
Authorization: Bearer {token}
```

**Query Parameters:**

-   `page` (optional): Page number for pagination
-   `per_page` (optional): Number of items per page (default: 10)

**Response (200):**

```json
{
    "success": true,
    "message": "Departments retrieved successfully",
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "Engineering",
                "created_at": "2024-01-01T00:00:00.000000Z",
                "updated_at": "2024-01-01T00:00:00.000000Z"
            },
            {
                "id": 2,
                "name": "Marketing",
                "created_at": "2024-01-01T00:00:00.000000Z",
                "updated_at": "2024-01-01T00:00:00.000000Z"
            }
        ],
        "first_page_url": "http://localhost:8000/api/departments?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://localhost:8000/api/departments?page=1",
        "links": [...],
        "next_page_url": null,
        "path": "http://localhost:8000/api/departments",
        "per_page": 10,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
}
```

---

## 📝 Validation Rules

### Employee Validation

#### Create Employee

-   `name`: required, string, max 255 characters
-   `email`: required, valid email, unique in employees table
-   `department_id`: required, must exist in departments table
-   `salary`: required, numeric, minimum 0

#### Update Employee

-   `name`: required, string, max 255 characters
-   `email`: required, valid email, unique in employees table (except current employee)
-   `department_id`: required, must exist in departments table
-   `salary`: required, numeric, minimum 0

### User Validation

#### Register

-   `name`: required, string, max 255 characters
-   `email`: required, valid email, unique in users table
-   `password`: required, string, minimum 8 characters, must be confirmed

#### Login

-   `email`: required, valid email
-   `password`: required, string, minimum 6 characters

---

## ❌ Error Responses

### 401 Unauthorized

```json
{
    "success": false,
    "message": "Unauthenticated",
    "data": []
}
```

### 422 Validation Error

```json
{
    "success": false,
    "message": "Validation failed",
    "data": {
        "email": ["The email field is required."],
        "name": ["The name field is required."]
    }
}
```

### 404 Not Found

```json
{
    "success": false,
    "message": "Employee not found",
    "data": []
}
```

### 500 Server Error

```json
{
    "success": false,
    "message": "Internal server error",
    "data": []
}
```

---

## 🔧 Postman Collection Setup

### Environment Variables

Create a Postman environment with the following variables:

```
base_url: http://localhost:8000/api
token: {{your_bearer_token}}
```

### Collection Structure

1. **Authentication**

    - Register User
    - Login User
    - Get Current User
    - Logout User

2. **Employees**

    - Get All Employees
    - Create Employee
    - Get Single Employee
    - Update Employee
    - Delete Employee

3. **Departments**
    - Get All Departments

### Pre-request Scripts

Add this script to automatically set the Authorization header for protected endpoints:

```javascript
if (pm.environment.get("token")) {
    pm.request.headers.add({
        key: "Authorization",
        value: "Bearer " + pm.environment.get("token"),
    });
}
```

### Test Scripts

Add this script to automatically save the token after login:

```javascript
if (pm.response.code === 200 && pm.response.json().data.access_token) {
    pm.environment.set("token", pm.response.json().data.access_token);
}
```

---

## 🚀 Quick Start Guide

1. **Start the Laravel server:**

    ```bash
    php artisan serve
    ```

2. **Import the Postman collection** (create from this documentation)

3. **Set up environment variables** in Postman

4. **Register a new user** using the `/api/register` endpoint

5. **Login** using the `/api/login` endpoint (token will be automatically saved)

6. **Start making authenticated requests** to employee and department endpoints

---

## 📊 Sample Data

The system comes with pre-seeded data:

### Departments (8 total)

-   Human Resources
-   Engineering
-   Marketing
-   Sales
-   Finance
-   Operations
-   Customer Support
-   Product Management

### Employees (15 total)

-   Sample employees with realistic data
-   Proper department relationships
-   Salary information
-   Email addresses

---

## 🔍 Testing Tips

1. **Use the search functionality** to test filtering
2. **Test pagination** with different page sizes
3. **Validate error handling** with invalid data
4. **Test token expiration** by waiting or manually revoking tokens
5. **Use the logging service** to track API operations

---

## 📞 Support

For any issues or questions regarding the API:

1. Check the Laravel logs in `storage/logs/laravel.log`
2. Verify database connection and migrations
3. Ensure all required environment variables are set
4. Check that Laravel Sanctum is properly configured

---

**Happy Testing! 🎉**
