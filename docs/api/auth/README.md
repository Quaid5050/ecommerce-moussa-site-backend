# API Documentation

Welcome to the API documentation for the Laravel backend. This documentation will help you understand the different modules and how to interact with the APIs for your application. The API is structured in modules, and each module's documentation provides the necessary details to integrate and use the APIs effectively.

## Table of Contents
- [Authentication](#authentication)
- [Modules Overview](#modules-overview)
- [API Endpoints](#api-endpoints)

## Authentication
To interact with most of the API endpoints, you will need to authenticate. Authentication is done using a **Passport Access token**, which can be obtained by logging in through the `/auth/login` endpoint.

## Modules Overview
The Auth support the following authentication services:

    auth2 - Any Provider
    credentials - Username and Password

### How to Authenticate
1. Call the `/auth/login` endpoint with valid credentials to obtain an access token.
2. Include the token in the `Authorization` header for all requests that require authentication.
3. For the login , register and oauth endpoint, you need to pass the `client-id` in the header for the web client id or mobile client id to identify the client.
4. The `client-id` generate using the the laravel passport for generating the client id.
5. The  steps for generate the client id for mobile or web or any other client is given below.
6. Store that client ids in the client side .env of mobile or web and pass the client id in the header for the login, register and oauth endpoint.
### Steps For Generate the Client Id
```bash
php artisan passport:client
Enter the Id of the client: any encrypted id or skip for auto generate
Enter the name of the client: web or mobile or any other client
```


**Example of Header of Header:**
```bash
Authorization: Bearer {access_token}
client-id: web client id || mobile client id

```

## Auth Endpoints

The Auth module provides the following endpoints:

Base url : http://localhost:8000 or https://api.example.com

**Base Route :** `{{baseUrl}}/api-auth/user`

### [1 -  Login](#login)
| Method | Endpoint | Description              | Request | Attributes           | 
| ------ |----------| ------------------------ |-------|----------------------|
| POST   | `/login` | Login with credentials   | JSON  | !`email` !`password` |

## Headers
```json
{
  "client-id": "web client id || mobile client id"
}
```

### Request

```json
{
  "email": "johndoe@example.com",
  "password": "yourpassword"
}
```
### Response
#### **If successful, the response will be:**
```json
{
    "success": true,
    "user": {
        "id": 2,
        "name": "John Doe",
        "auth_type": "credentials",
        "created_at": "2024-10-10 20:43:08",
        "updated_at": "2024-10-10 20:43:08"
    },
    "account : if authType is credentials": {
        "email": "johndoe@gmail.com" 
    },
    "account : if authType is oauth": {
      "provider_name": "google",
      "email": ""
    },
    "accessToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5ZDM2ZjAzNi05NmNhLTRhN2UtYWU1Ny00OGVjYjliZjAxYzYiLCJqdGkiOiJiZmE3ZTJlOGJkZjZjMzc3OTY1MTIzZjU2ZmZmMGE4MjczMTJlN2M0ZTA3YjQxY2VkNWE2MWFhYTM0NTc0M2UzMThkYTg2MzAwZTQ2YTRkNSIsImlhdCI6MTcyODU5MzU4My42OTM5ODgsIm5iZiI6MTcyODU5MzU4My42OTM5OSwiZXhwIjoxNzYwMTI5NTgzLjY3MzE3MSwic3ViIjoiMiIsInNjb3BlcyI6W119.Fw-vg6pAVkNiJcAiZDkf1S3tgaUWE04fSCgq4vMeC58w1c85qL_qrmXIy3VpsbfVRuGFigc8au5sv7Vo9Axm6XfT6NDRCDhtF8R-oDgm4Yu5p5lFSydOOnITk_7kxuSEOuwtvIL4H3gjn5DzVrXsl_WzndGSjP9ufcrLOWyGY3Dz2pGfw8oBr_eOaWWFAhhfPHrZ0UrYecYG1NSJOmJlX9uwO7JgWBHmQWGJ5bSPb9NlZsG4PEkMsIbKpkmuldo3UDQDTYQfMS-pJcAYtFaUwgqCyiM25SYpa60xKHxvdgjdfpZQ3Dg7CdCNdIFZw45l6OIKKkwFWeXCD5E05iDQLhhXBqALcGi6ixkqpMhnJvScXqCKKE4lqdKBC9vNXk6Ic-564djMdoFr3YItLw0PsIxDE4JtWEUlYKcJwO56PDWb9S8UctYEAZHbHaILHYbjt2zWEA34icAIQ3v5w1nWENI7DWh8H07cAEfQUsYx7_lpIJ6r6nei-aSzmsi1uN_fE3wUtzELcnmZFz2SZpg0QYPD7QUEXwnaPFRqKI6YXs2EyJZzBKnEQ5AVvrjiteNCp_hZWc_QKCadVQZTgO5kwRdH0WHEE_JwF8KFyNkaYumy1dNR0k4b7g4iwMYSxGLm-AQYQ7-ZiZd40BQ-ua45l18qOJmjjgqGX_Jc3ZhV7Dk",
    "token_expiry": "2025-10-10T20:53:03.000000Z",
    "client-id": "9d36fe39-14e7-42d6-9320-7d8252bdcbb5",
    "message": "Login successful"
}
```
#### **If the field are invalid, the response will be:**
`status code: 422 : Unprocessable Entity`
```json
    {
      "message": "The email field is required. (and 1 more error)",
      "errors": {
        "email": [
          "The email field is required."
        ],
        "password": [
          "The password field is required."
        ]
      }
}
```
### **If the credentials are invalid, the response will be:**
`status code: 401: Unauthorized`
```json
  {
      "success": false,
      "message": "Invalid credentials",
      "errors": []
  }
```

### [2 -  Register](#register)
| Method | Endpoint | Description                         | Request | Attributes |
| ------ |----------|-------------------------------------|-------|----------|
| POST   | `/register` | Register with credentials | JSON  | !`name`  !`email` !`password` |

## Headers
```json
{
  "client-id": "web client id || mobile client id"
}
```
## Request

```json
{
  "name": "John Doe",
  "email": "johndoe@example.com",
  "password": "yourpassword"
}
```
### Response
#### **If successful, the response will be:**

```json
{
    "success": true,
    "user": {
        "id": 3,
        "name": "John Doe",
        "auth_type": "credentials",
        "created_at": "2024-10-10 21:01:40",
        "updated_at": "2024-10-10 21:01:40"
    },
    "account": {
        "email": "johndoe@gmail.com"
    },
    "accessToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5ZDM2ZjAzNi05NmNhLTRhN2UtYWU1Ny00OGVjYjliZjAxYzYiLCJqdGkiOiI1ZWY0Y2IzYzA1ZGY4NjRhNzk1OWI4OWU5Y2Q0YTNiNGY1MGUyNGQ0OTkwNDI5YTM2MWJjZWYyMGNlY2ZiZWM0OTk3YzcyNTNiYmNiMjI2OCIsImlhdCI6MTcyODU5NDEwMS4zOTQxMTgsIm5iZiI6MTcyODU5NDEwMS4zOTQxMiwiZXhwIjoxNzYwMTMwMTAxLjM5MDc5Mywic3ViIjoiMyIsInNjb3BlcyI6W119.DY5m__uy_HLidRX56wxnYMOYEAUS4JM1fSpuBAxp1cDaikxfV9I2eR7aH8Pu9C4iNueNgf8bONficfQ8gYEb2G380YnV69E8kQ9Fn8Hc0oBhBQ_dBlPTtbCIH9D8uAYNpgzbboWNX6JxzcARgMJhVI4EmxD4j2XXsgkZgMhk4L9foAeYRg38jWBG7rYnH9X86zRHu7dJcxxKBns336xGlJGNALyGExx7jZL48L9E4ZeHxqJ9rsUxkdQCtXXtIJFUC2Kn91ZAdWBU0xF8y6VR6Nx_Hecp6jyWpGuvW0bM-xkB6PUOKrEQKw2kVVhehGXSm5ga_da3IVyKhHqH04DsmhjgmrLIDUSafVrNhu4j6PW7yEEYtF4xqaTyyWJT8X4-uEv02ScBqA_5wnrnjaEObscnuzugOTmODm-JPgkkBD0ESsZWF0Vitt1Ms0-c5nD8xhtuMsUTIKdq-aV2pwepEMxtygy5ueJ-Z1i2bWnsFCjEf-Kz89mKSba36n8cXYsEC2vRD05vBeTudCBsep1IEzYOMHGzkDPdfOVaeQE8mp0cizJk4lNLGdZITw8A24NgIVO-GJPvU-n9WGUeRozppIGoMI7nQxxypsKyUU4Sw8nrGUDAO7QZknpDqGjLSVySPOs_Eik_3rLd0jfHCz6IGIHKx2hxMawtCn5aAFaNVkc",
    "token_expiry": "2025-10-10T21:01:41.000000Z",
    "client-id": "9d36fe39-14e7-42d6-9320-7d8252bdcbb5",
    "message": "User registered successfully"
}
```
#### **If the field are invalid, the response will be:**
`status code: 422 : Unprocessable Entity`

```json
   {
      "message": "The email field is required. (and 2 more errors)",
      "errors": {
        "email": [
          "The email field is required."
        ],
        "password": [
          "The password field is required."
        ],
        "name": [
          "The name field is required."
        ]
      }
  }
```
#### **If the email is already taken, the response will be:**
`status code: 422 : Unprocessable Entity`

```json
   {
      "message": "The email has already been taken.",
      "errors": {
        "email": [
          "The email has already been taken."
        ]
      }
  }
```

### [3 - OAuth](#oauth)
| Method | Endpoint | Description                         | Request | Attributes                                      |
| ------ |----------|-------------------------------------|-------|-------------------------------------------------|
| POST   | `/oauth` | Auth0 Authentication | JSON  | `email` !`provider_name` !`provider_id` !`name` |

## Headers
```json
{
  "client-id": "web client id || mobile client id"
}
```

## Request

```json
{
    "email": null,
    "provider_name": "google",
    "provider_id": "1234567890",
    "name": "John Doe"
}
```

### Response
```json
    {
        "provider_name": "google",
        "email": "email || if not email then no email field"
    }
```

### [4 - Logout](#logout)
| Method | Endpoint | Description                         | Request | Attributes |
| ------ |----------|-------------------------------------|-------|------------|
| POST   | `/logout` | Logout | JSON  | !`token`   | 

### Headers
```json
{
    "Authorization": "Bearer {access_token}"
}
```
## Response
**If successful, the response will be:**
```json
    {
        "status": true,
        "message": "Logout successful"
    }
```
**If the token is invalid or expired, the response will be:**
```json
    {
        "status": false,
        "message": "Unauthenticated"
    }
```

### [5 - User Details](#user-details)
| Method | Endpoint        | Description                         | Request | Attributes |
| ------ |-----------------|-------------------------------------|-------|------------|
| GET   | `/user-details` | Get user details | JSON  | `token`

### Headers 
```json
{
    "Authorization": "Bearer {access_token}"
}
```

### Response
```json
    {
        "user": {
          "id": 1,
          "name": "John Doe",
          "email": "",
          "auth_type": "credentials",
          "created_at": "2021-08-10T12:00:00.000000Z",
          "updated_at": "2021-08-10T12:00:00.000000Z"
        },
 
        "account : when user have oauth": {
            "provider_name": "google",
            "email": "email || if not email then no email field"
        },
        "account : when credential user ": {
          "email": "email"
        }
    }
```

