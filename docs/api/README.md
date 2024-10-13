# API Documentation

Welcome to the API documentation for the Laravel backend. This documentation will help you understand the different modules and how to interact with the APIs for your application. The API is structured in modules, and each module's documentation provides the necessary details to integrate and use the APIs effectively.
This document provides all the necessary information to help you interact with the available APIs. It covers public and protected APIs, how to authenticate, and the base URL for API requests.

## Table of Contents
- [Base URL](#base-url)
- [Public APIs](#public-apis)
- [Protected APIs](#protected-apis)
- [Authentication and Bearer Token](#authentication-and-bearer-token)
- [Error Handling](#error-handling)
- [Testing the APIs](#testing-the-apis)

---

## Base URL

All APIs can be accessed using the following base URL: 
FOR LOCAL: `http://localhost:8000/api`
FOR PRODUCTION: `https://yourdomain.com/api`

## Public APIs
Public apis are accessible without any authentication. These APIs are used for fetching data that does not require any user-specific information.
Location: [app/routes/api.php](app/routes/api.php)

## Protected APIs
Protected APIs require authentication using a Bearer token. These APIs are used for fetching user-specific data and performing actions that require user authentication.

## For Admin 
APIs, the user must have the role of `admin` to access the endpoints.
Location: [app/routes/admin-api.php](app/routes/admin-api.php)

## For User
APIs, the user must have the role of `user` to access the endpoints with the access token.
Location: [app/routes/user-api.php](app/routes/user-api.php)


## Authentication and Bearer Token
To interact with most of the API endpoints, you will need to authenticate. Authentication is done using a **Passport Access token**, which can be obtained by logging in through the `/auth/register` or `/auth/login` endpoint.

